<?php

namespace App\Http\Controllers;

use App\Models\AppModel;
use App\Models\DaskrmtiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
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
            return redirect()->back()->with('failed', $validator->errors()->first())->withInput();
        }

        try {
            if ($request->hasFile('img_about_us1') && $request->hasFile('img_about_us2')) {
                $validatorImg = Validator::make($request->all(), [
                    'img_about_us1' => 'required|image|mimes:png,jpg,jpeg|max:3050',
                    'img_about_us2' => 'required|image|mimes:png,jpg,jpeg|max:3050',
                ], [
                    'img_about_us1.required' => 'Gambar 1 tidak boleh kosong',
                    'img_about_us1.image' => 'Gambar 1 tidak valid',
                    'img_about_us1.mimes' => 'Gambar 1 format tidak valid',
                    'img_about_us1.size' => 'Gambar 1 ukuran gambar terlalu besar',
                    'img_about_us2.required' => 'Gambar 2 tidak boleh kosong',
                    'img_about_us2.image' => 'Gambar 2 tidak valid',
                    'img_about_us2.mimes' => 'Gambar 2 format tidak valid',
                    'img_about_us2.size' => 'Gambar 2 ukuran gambar terlalu besar',
                ]);

                if ($validatorImg->fails()) {
                    return redirect()->back()->with('failed', $validator->errors()->first());;
                }


                $fileImg1 = $request->file('img_about_us1');
                $fileImg2 = $request->file('img_about_us2');
                $extension1 = $fileImg1->getClientOriginalExtension();
                $extension2 = $fileImg2->getClientOriginalExtension();
                $fileName1 = 'About_us1' . '.' . $extension1;
                $fileName2 = 'About_us2' . '.' . $extension2;
                $fileImg1->move('template/landing_page/img', $fileName1);
                $fileImg2->move('template/landing_page/img', $fileName2);
                $data = [
                    'email' => $request->input('email'),
                    'telp' => $request->input('telepon'),
                    'url_instagram' => $request->input('url_instagram'),
                    'url_facebook' => $request->input('url_facebook'),
                    'url_x' => $request->input('url_x'),
                    'about_us' => $request->input('app_desc'),
                    'img_about_us1' => $fileName1,
                    'img_about_us2' => $fileName2,
                ];

                $update = AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data')->withInput();
                }
            } else  if ($request->hasFile('img_about_us1') && !$request->hasFile('img_about_us2')) {
                $validatorImg = Validator::make($request->all(), [
                    'img_about_us1' => 'required|image|mimes:png,jpg,jpeg|max:3050'
                ], [
                    'img_about_us1.required' => 'Gambar 1 tidak boleh kosong',
                    'img_about_us1.image' => 'Gambar 1 tidak valid',
                    'img_about_us1.mimes' => 'Gambar 1 format tidak valid',
                    'img_about_us1.size' => 'Gambar 1 ukuran gambar terlalu besar'
                ]);

                if ($validatorImg->fails()) {
                    return redirect()->back()->with('failed', $validator->errors()->first());;
                }


                $fileImg1 = $request->file('img_about_us1');
                $extension1 = $fileImg1->getClientOriginalExtension();
                $fileName1 = 'About_us1' . '.' . $extension1;
                $fileImg1->move('template/landing_page/img', $fileName1);
                $data = [
                    'email' => $request->input('email'),
                    'telp' => $request->input('telepon'),
                    'url_instagram' => $request->input('url_instagram'),
                    'url_facebook' => $request->input('url_facebook'),
                    'url_x' => $request->input('url_x'),
                    'about_us' => $request->input('app_desc'),
                    'img_about_us1' => $fileName1
                ];

                $update = AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data')->withInput();
                }
            } else  if (!$request->hasFile('img_about_us1') && $request->hasFile('img_about_us2')) {
                $validatorImg = Validator::make($request->all(), [
                    'img_about_us2' => 'required|image|mimes:png,jpg,jpeg|max:3050'
                ], [
                    'img_about_us2.required' => 'Gambar 1 tidak boleh kosong',
                    'img_about_us2.image' => 'Gambar 1 tidak valid',
                    'img_about_us2.mimes' => 'Gambar 1 format tidak valid',
                    'img_about_us2.size' => 'Gambar 1 ukuran gambar terlalu besar'
                ]);

                if ($validatorImg->fails()) {
                    return redirect()->back()->with('failed', $validator->errors()->first());;
                }


                $fileImg2 = $request->file('img_about_us2');
                $extension1 = $fileImg2->getClientOriginalExtension();
                $fileName2 = 'About_us2' . '.' . $extension1;
                $fileImg2->move('template/landing_page/img', $fileName2);
                $data = [
                    'email' => $request->input('email'),
                    'telp' => $request->input('telepon'),
                    'url_instagram' => $request->input('url_instagram'),
                    'url_facebook' => $request->input('url_facebook'),
                    'url_x' => $request->input('url_x'),
                    'about_us' => $request->input('app_desc'),
                    'img_about_us2' => $fileName2
                ];

                $update = AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data')->withInput();
                }
            } else {
                $data = [
                    'email' => $request->input('email'),
                    'telp' => $request->input('telepon'),
                    'url_instagram' => $request->input('url_instagram'),
                    'url_facebook' => $request->input('url_facebook'),
                    'url_x' => $request->input('url_x'),
                    'about_us' => $request->input('app_desc'),
                ];

                $update = AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data')->withInput();
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput();
        }
    }
}
