<?php

namespace App\Http\Controllers\user\auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect('login')->with('error', 'Terjadi kesalahan');
        }
        try {
            $email = $request->input('email');
            $authValidate = UserModel::where('email', $email)->first();
            if ($authValidate) {
                return 'berhasil';
            } else {
                return redirect('login')->with('error', 'Email belum terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect('login')->with('error', 'Terjadi kesalahan');
        }
    }
}
