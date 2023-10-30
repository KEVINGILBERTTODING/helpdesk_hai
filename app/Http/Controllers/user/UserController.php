<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\NotificationModel;
use App\Models\PuModel;
use App\Models\User;
use App\Models\UserModel;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function profile()
    {
        if (session('login') != true) {
            return redirect()->route('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $permohonanValid = PuModel::where('user_id', session('user_id'))
            ->where('status', 1)->count();
        $permohonanTidakValid = PuModel::where('user_id', session('user_id'))
            ->where('status', 0)->count();
        $totalPermohonan = PuModel::where('user_id', session('user_id'))->count();
        $notifModel = new NotificationModel();
        $dataNotification = $notifModel->getNotification(session('user_id'));
        $data = [
            'dataNotification' => $dataNotification,
            'dataUser' => $dataUser,
            'totalPermohonan' => $totalPermohonan,
            'permohonanSelesai' => $permohonanValid,
            'permohonanDitolak' => $permohonanTidakValid
        ];

        return view('user.profile.profile', $data);
    }

    function updateProfilPhoto(Request $request)
    {
        if (session('login') != true) {
            return redirect()->route('login');
        }

        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpg,jpeg|max:5000'

        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->with('failed', 'Gambar tidak valid');
        }

        try {
            if ($request->hasFile('image')) {
                $userId = session('user_id');
                $file = $request->file('image');
                $fileName = $userId  . "." . $file->getClientOriginalExtension();
                $file->move('data/profile_photo', $fileName);
                $data = [
                    'profile_photo' => $fileName,
                    'updated_at' =>  date('Y-m-d H:i:s')
                ];
                $update = UserModel::where('user_id', $userId)->update($data);
                if ($update) {
                    return redirect()->route('profile')->with('success', 'Berhasil mengubah foto profil');
                } else {
                    return redirect()->route('profile')->with('failed', 'Gagal mengubah foto profil');
                }
            } else {
                return redirect()->route('profile')->with('failed', 'Anda belum memilih foto');
            }
        } catch (\Throwable $th) {
            return redirect()->route('profile')->with('failed', 'Terjadi kesalahan');
        }
    }

    function updateProfile(Request $request)
    {
        if (session('login') != true) {
            return redirect('login');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',

        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid'
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->with('failed', $validator->errors()->first());
        }

        try {
            if ($request->input('password') != null) { // update profile with password
                $dataUser = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $update = User::where('user_id', session('user_id'))->update($dataUser);
                if ($update) {
                    return redirect()->route('profile')->with('success', 'Berhasil mengubah profil');
                } else {
                    return redirect()->route('profile')->with('failed', 'Gagal mengubah profil');
                }
            } else {
                $dataUser = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $update = User::where('user_id', session('user_id'))->update($dataUser);
                if ($update) {
                    return redirect()->route('profile')->with('success', 'Berhasil mengubah profil');
                } else {
                    return redirect()->route('profile')->with('failed', 'Gagal mengubah profil');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->route('profile')->with('failed', 'Terjadi kesalahan');
        }
    }

    function forgetPassword()
    {
        return view('user.auth.send_token_password');
    }

    function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->route('forgetPassword')->withInput()->with('failed', 'Email tidak valid');
        }

        try {
            $user = User::where('email', $request->input('email'))->first();
            if ($user) {

                if ($user) {
                    $dataUser = [
                        'name' => $user['name'],
                        'user_id' => $user['user_id']
                    ];
                    $user->notify(new EmailNotification($dataUser));
                    return redirect()->route('forgetPassword')->with('success', 'Link berhasil terkirim');
                } else {
                    return redirect()->route('forgetPassword')->withInput()->with('failed', 'Gagal mengirim link');
                }
            } else {
                return redirect()->route('forgetPassword')->withInput()->with('failed', 'Email belum terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect()->route('forgetPassword')->withInput()->with('failed', $th->getMessage());
        }
    }
}
