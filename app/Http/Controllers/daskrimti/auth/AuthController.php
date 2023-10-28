<?php

namespace App\Http\Controllers\daskrimti\auth;

use App\Http\Controllers\Controller;
use App\Models\DaskrmtiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
}
