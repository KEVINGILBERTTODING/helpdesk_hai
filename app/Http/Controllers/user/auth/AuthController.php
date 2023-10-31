<?php

namespace App\Http\Controllers\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nrp' => 'required|integer',
            'password' => 'required|string|min:8'
        ], [
            'nrp.required' => 'NRP tidak boleh kosong.',
            'nrp.integer' => 'NRP hanya boleh berupa angka.',
            'password.required' => 'Kata sandi tidak boleh kosong.',
            'password.min' => 'Kata sandi tidak boleh kurang dari 8 karakter.'
        ]);
        if ($validator->fails()) {
            return redirect('login')->with('error', $validator->errors()->first());
        }
        try {
            $nrp = $request->input('nrp');
            $password = $request->input('password');
            $authValidate = UserModel::where('nrp', $nrp)->first();
            if ($authValidate) {
                if ($authValidate['status'] != 1) {
                    return redirect('login')->with('error', 'Akun telah dinonaktifkan oleh Admin');
                } else {
                    if (Hash::check($password, $authValidate['password'])) {
                        $request->session()->put('login', TRUE);
                        $request->session()->put('role', 'staff');
                        $request->session()->put('user_id', $authValidate['user_id']);
                        $request->session()->put('name', $authValidate['name']);
                        $request->session()->put('nrp', $authValidate['nrp']);
                        return redirect('dashboard');
                    } else {
                        return redirect('login')->with('error', 'Kata sandi salah');
                    }
                }
            } else {
                return redirect('login')->with('error', 'NRP belum terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect('login')->with('error', 'Terjadi kesalahan');
        }
    }

    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect('login')->with('error', 'Terjadi kesalahan');
        }
        $email = $request->input('email');
        $name = $request->input('name');
        $password = $request->input('password');


        $validate = User::where('email', $email)->first();
        if ($validate == null) {
            $dataUser = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $insert = User::insert($dataUser);
            if ($insert) {
                return redirect('login')->with('success', 'Berhasil mendaftar');
            } else {
                return redirect('login')->with('error', 'Gagal mendaftar');
            }
        } else {
            return redirect('login')->with('error', 'Email telah terdaftar');
        }
    }

    function resetPassword($userId)
    {

        if ($userId == null || $userId == "") {
            return redirect()->route('login');
        }

        try {
            $data = [
                'userId' => Crypt::decrypt($userId)
            ];
            return view('user.auth.update_password', $data);
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
    }

    function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|',
            'new_password' => 'required|string',
            'password_verify' => 'required|string',

        ], [
            'user_id.required' => 'Terjadi kesalahan',
            'user_id.integer' => 'Terjadi kesalahan',
            'new_password.required' => 'Kata sandi tidak boleh kosong',
            'password_verify.required' => 'Kata sandi tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first())->withInput();
        }

        try {
            if ($request->input('new_password') != $request->input('password_verify')) { // update profile with password
                return redirect()->back()->with('failed', 'Password tidak sesuai')->withInput();
            } else {
                $dataUser = [
                    'password' => Hash::make($request->input('password_verify')),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $update = User::where('user_id', $request->input('user_id'))->update($dataUser);
                if ($update) {
                    return redirect()->route('login')->with('success', 'Berhasil mengubah kata sandi');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah kata sandi')->withInput();
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan')->withInput();
        }
    }


    function logout()
    {
        session()->flush();
        return redirect('login');
    }
}
