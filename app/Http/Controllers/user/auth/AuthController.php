<?php

namespace App\Http\Controllers\user\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
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
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect('login')->with('error', $validator->errors()->first());
        }
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $authValidate = UserModel::where('email', $email)->first();
            if ($authValidate) {
                if (Hash::check($password, $authValidate['password'])) {
                    return 'berhasil';
                } else {
                    return redirect('login')->with('error', 'Kata sandi salah');
                }
            } else {
                return redirect('login')->with('error', 'Email belum terdaftar');
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
                return 'berhasil mendaftar';
            } else {
                return redirect('login')->with('error', 'Gagal mendaftar');
            }
        } else {
            return redirect('login')->with('error', 'Email telah terdaftar');
        }
    }
}
