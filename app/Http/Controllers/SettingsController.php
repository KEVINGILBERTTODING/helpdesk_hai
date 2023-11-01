<?php

namespace App\Http\Controllers;

use App\Models\AppModel;
use App\Models\DaskrmtiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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


    function updateBanner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'header1' => 'required|string',
            'header_desc1' => 'required|string',
            'header2' => 'required|string',
            'header_desc2' => 'required|string',
        ], [
            'header1.required' => 'Header utama tidak boleh kosong',
            'header1.string' => 'Header utama tidak harus berupa huruf dan angka',
            'header_desc1.required' => 'Deskripsi header utama tidak boleh kosong',
            'header_desc1.string' => 'Deskripsi header utama tidak harus berupa huruf dan angka',
            'header2.required' => 'Header kedua tidak boleh kosong',
            'header2.string' => 'Header kedua tidak harus berupa huruf dan angka',
            'header_desc2.required' => 'Deskripsi header kedua tidak boleh kosong',
            'header_desc2.string' => 'Deskripsi header kedua tidak harus berupa huruf dan angka',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        if ($request->hasFile('img_banner1') && $request->hasFile('img_banner2')) {
            $validatorImg = Validator::make($request->all(), [
                'img_banner1' => 'required|image|mimes:png,jpg,jpeg|max:5000',
                'img_banner2' => 'required|image|mimes:png,jpg,jpeg|max:5000',
            ], [
                'img_banner1.required' => 'Gambar banner utama tidak boleh kosong',
                'img_banner1.image' => 'Gambar banner utama tidak valid',
                'img_banner1.mimes' => 'Format gambar banner utama tidak valid',
                'img_banner1.max' => 'Ukuran gambar banner utama tidak boleh lebih dari 5 MB',
                'img_banner2.required' => 'Gambar banner kedua tidak boleh kosong',
                'img_banner2.image' => 'Gambar banner kedua tidak valid',
                'img_banner2.mimes' => 'Format gambar banner kedua tidak valid',
                'img_banner2.max' => 'Ukuran gambar banner kedua tidak boleh lebih dari 5 MB',

            ]);

            if ($validatorImg->fails()) {
                return redirect()->back()->with('failed', $validatorImg->errors());
            }


            try {

                $fileBanner1 = $request->file('img_banner1');
                $fileBanner2 = $request->file('img_banner2');
                $fileNameBanner1 = 'Banner_1.' . $fileBanner1->getClientOriginalExtension();
                $fileNameBanner2 = 'Banner_2.' . $fileBanner2->getClientOriginalExtension();
                $fileBanner1->move('template/landing_page/img', $fileNameBanner1);
                $fileBanner2->move('template/landing_page/img', $fileNameBanner2);
                $data = [

                    'header1' => $request->input('header1'),
                    'header_desc1' => $request->input('header_desc1'),
                    'header2' => $request->input('header2'),
                    'header_desc2' => $request->input('header_desc2'),
                    'img_banner1' => $fileNameBanner1,
                    'img_banner2' => $fileNameBanner2,
                ];

                $update =  AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data banner');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data banner');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        } else if ($request->hasFile('img_banner1') && !$request->hasFile('img_banner2')) {
            $validatorImg = Validator::make($request->all(), [
                'img_banner1' => 'required|image|mimes:png,jpg,jpeg|max:5000'
            ], [
                'img_banner1.required' => 'Gambar banner utama tidak boleh kosong',
                'img_banner1.image' => 'Gambar banner utama tidak valid',
                'img_banner1.mimes' => 'Format gambar banner utama tidak valid',
                'img_banner1.max' => 'Ukuran gambar banner utama tidak boleh lebih dari 5 MB'

            ]);

            if ($validatorImg->fails()) {
                return redirect()->back()->with('failed', $validatorImg->errors());
            }


            try {

                $fileBanner1 = $request->file('img_banner1');
                $fileNameBanner1 = 'Banner_1.' . $fileBanner1->getClientOriginalExtension();
                $fileBanner1->move('template/landing_page/img', $fileNameBanner1);
                $data = [

                    'header1' => $request->input('header1'),
                    'header_desc1' => $request->input('header_desc1'),
                    'header2' => $request->input('header2'),
                    'header_desc2' => $request->input('header_desc2'),
                    'img_banner1' => $fileNameBanner1,

                ];

                $update =  AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data banner');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data banner');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        } else if (!$request->hasFile('img_banner1') && $request->hasFile('img_banner2')) {
            $validatorImg = Validator::make($request->all(), [
                'img_banner2' => 'required|image|mimes:png,jpg,jpeg|max:5000'
            ], [
                'img_banner2.required' => 'Gambar banner kedua tidak boleh kosong',
                'img_banner2.image' => 'Gambar banner kedua tidak valid',
                'img_banner2.mimes' => 'Format gambar banner kedua tidak valid',
                'img_banner2.max' => 'Ukuran gambar banner kedua tidak boleh lebih dari 5 MB',

            ]);

            if ($validatorImg->fails()) {
                return redirect()->back()->with('failed', $validatorImg->errors());
            }


            try {


                $fileBanner2 = $request->file('img_banner2');
                $fileNameBanner2 = 'Banner_2.' . $fileBanner2->getClientOriginalExtension();
                $fileBanner2->move('template/landing_page/img', $fileNameBanner2);
                $data = [

                    'header1' => $request->input('header1'),
                    'header_desc1' => $request->input('header_desc1'),
                    'header2' => $request->input('header2'),
                    'header_desc2' => $request->input('header_desc2'),
                    'img_banner2' => $fileNameBanner2,
                ];

                $update =  AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data banner');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data banner');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        } else {
            $data = [
                'header1' => $request->input('header1'),
                'header_desc1' => $request->input('header_desc1'),
                'header2' => $request->input('header2'),
                'header_desc2' => $request->input('header_desc2'),
            ];

            try {
                $update =  AppModel::where('app_id', 1)->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data banner');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data banner');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        }
    }
}
