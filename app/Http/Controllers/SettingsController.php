<?php

namespace App\Http\Controllers;

use App\Models\AppModel;
use App\Models\DaskrmtiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    function index()
    {
        $dataDaskrimti = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $data = [
            'dataDaskrimti' => $dataDaskrimti,
            'dataApp' => $dataApp
        ];
        return view('daskrimti.settings.master_app', $data);
    }

    function updateAboutUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'telepon' => 'required',
            'url_instagram' => 'required',
            'url_facebook' => 'required',
            'url_x' => 'required',
            'url_x' => 'required',
            'app_desc' => 'required'
        ], [
            'email.required' => 'Alamat email tidak boleh kosong',
            'email.email' => 'Alamat email tidak valid',
            'telepon.required' => 'Telepon tidak boleh kosong',
            'url_instagram.required' => 'Url instagram tidak boleh kosong',
            'url_facebook.required' => 'Url facebook tidak boleh kosong',
            'url_x.required' => 'Url x tidak boleh kosong',
            'app_desc.required' => 'Deskripsi aplikasi tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            if ($request->hasFile('img_about_us1') || $request->hasFile('img_about_us1')) {
            } else {
                $data = [
                    'email' => $request->input('email'),
                    'telp' => $request->input('telepon'),
                    'email' => $request->input('url_instagram'),
                    'email' => $request->input('url_facebook'),
                    'email' => $request->input('url_x'),
                    'email' => $request->input('app_desc'),
                ];

                $update = AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
