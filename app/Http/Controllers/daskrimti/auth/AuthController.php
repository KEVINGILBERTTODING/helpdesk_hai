<?php

namespace App\Http\Controllers\daskrimti\auth;

use App\Http\Controllers\Controller;
use App\Models\DaskrmtiModel;
use App\Notifications\resetPasswordDaskrimti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function index()
    {
        return view('daskrimti.auth.login');
    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password.string' => 'Kata sandi tidak valid',
        ]);

        if ($validator->fails()) {
            return redirect()->route('daskrimti')->with('failed', $validator->errors()->first());
        }

        try {

            $email = $request->input('email');
            $password = $request->input('password');
            $validateUser = DaskrmtiModel::where('email', $email)->first();
            if ($validateUser) {
                if (Hash::check($password, $validateUser['password'])) {
                    $request->session()->put('login', TRUE);
                    $request->session()->put('role', 'daskrimti');
                    $request->session()->put('daskrimti_id', $validateUser['daskrimti_id']);
                    return redirect()->route('daskrimtiDashboard');
                } else {
                    return redirect()->route('daskrimti')->with('failed', 'Kata sandi salah');
                }
            } else {
                return redirect()->route('daskrimti')->with('failed', 'Email belum terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect()->route('daskrimti')->with('failed', $th->getMessage());
        }
    }

    function logOut()
    {
        session()->flush();
        return redirect()->route('daskrimti');
    }

    function forgetPassword()
    {
        return view('daskrimti.auth.forget_password');
    }

    function sendResetPasswordToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $validateEmail = DaskrmtiModel::where('email', $request->input('email'))->first();
            if ($validateEmail) {

                $dataDaskrimti = [
                    'daskrimti_id' => $validateEmail['daskrimti_id'],
                    'name' => $validateEmail['name'],
                ];

                $validateEmail->notify(new resetPasswordDaskrimti($dataDaskrimti));
                return redirect()->back()->with('success', 'Token berhasil terkirim. Periksa email Anda');
            } else {
                return redirect()->back()->with('failed', 'Email belum terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    function newPassword($daskrimtiId)
    {
        if ($daskrimtiId == null || $daskrimtiId == "") {
            return redirect()->route('daskrimti');
        }

        try {
            $data = [
                'daskrimti_id' => Crypt::decrypt($daskrimtiId)
            ];
            return view('daskrimti.auth.update_password', $data);
        } catch (\Throwable $th) {
            return redirect()->route('daskrimti');
        }
    }
    function updatePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'daskrimti_id' => 'required|integer|',
            'new_password' => 'required|string',
            'password_verify' => 'required|string',

        ], [
            'daskrimti_id.required' => 'Terjadi kesalahan',
            'daskrimti_id.integer' => 'Terjadi kesalahan',
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
                $dataDaskrimti = [
                    'password' => Hash::make($request->input('password_verify')),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $update = DaskrmtiModel::where('daskrimti_id', $request->input('daskrimti_id'))->update($dataDaskrimti);
                if ($update) {
                    return redirect()->route('daskrimti')->with('success', 'Berhasil reset kata sandi');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah kata sandi')->withInput();
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan')->withInput();
        }
    }
}
