<?php

namespace App\Http\Controllers\daskrimti\main;

use App\Http\Controllers\Controller;
use App\Models\DaskrmtiModel;
use App\Models\PuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DaskrimtiController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {

        try {
            $daskrimtiId = session('daskrimti_id');
            $dataDaskrimti = DaskrmtiModel::where('daskrimti_id', $daskrimtiId)->first();
            $permohonanValid = PuModel::where('status', 1)->count();
            $permohonanTidakValid = PuModel::where('status', 0)->count();
            $permohonanProses = PuModel::where('status', 2)->count();
            $totalPermohonan = PuModel::count();
            $data = [
                'dataDaskrimti' => $dataDaskrimti,
                'permohonanValid' => $permohonanValid,
                'permohonanTidakValid' => $permohonanTidakValid,
                'permohonanProses' => $permohonanProses,
                'totalPermohonan' => $totalPermohonan,
            ];
            return view('daskrimti.dashboard.dashboard', $data);
        } catch (\Throwable $th) {
            return redirect()->route('/');
        }
    }

    function profile()
    {

        $dataDaskrimti = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->first();

        $data = [
            'dataDaskrimti' => $dataDaskrimti
        ];

        return view('daskrimti.profile.profile', $data);
    }

    function updateProfilPhoto(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpg,jpeg|max:5000'

        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', 'Gambar tidak valid');
        }

        try {
            if ($request->hasFile('image')) {
                $daskrimtiId = session('daskrimti_id');
                $file = $request->file('image');
                $fileName = 'Daskrimti-' . $daskrimtiId  . "." . $file->getClientOriginalExtension();
                $file->move('data/profile_photo', $fileName);
                $data = [
                    'profile_photo' => $fileName,
                    'updated_at' =>  date('Y-m-d H:i:s')
                ];
                $update = DaskrmtiModel::where('daskrimti_id', $daskrimtiId)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah foto profil');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah foto profil');
                }
            } else {
                return redirect()->back()->with('failed', 'Anda belum memilih foto');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function updateProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',

        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            if ($request->input('password') != null) { // update profile with password
                $dataDaskrimti = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $update = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->update($dataDaskrimti);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah profil');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah profil');
                }
            } else {
                $dataDaskrimti = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $update = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->update($dataDaskrimti);

                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah profil');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah profil');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
