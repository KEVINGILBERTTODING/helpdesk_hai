<?php

namespace App\Http\Controllers\user\main;

use App\Http\Controllers\Controller;
use App\Models\CityModel;
use App\Models\LayananModel;
use App\Models\PuModel;
use App\Models\TypeModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    function index()
    {
        if (session('login') != true) {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $permohonanValid = PuModel::where('user_id', session('user_id'))
            ->where('status', 1)->count();
        $permohonanTidakValid = PuModel::where('user_id', session('user_id'))
            ->where('status', 0)->count();
        $permohonanProses = PuModel::where('user_id', session('user_id'))
            ->where('status', 2)->count();
        $totalPermohonan = PuModel::where('user_id', session('user_id'))->count();
        $data = [
            'profile_photo' => $dataUser['profile_photo'],
            'permohonanValid' => $permohonanValid,
            'permohonanTidakValid' => $permohonanTidakValid,
            'permohonanProses' => $permohonanProses,
            'totalPermohonan' => $totalPermohonan
        ];
        return view('user.main.dashboard', $data);
    }

    function createPermohonan()
    {
        if (session('login') == true) {
            $dataUser = User::where('user_id', session('user_id'))->first();
            $type = TypeModel::where('status', 1)->get();
            $layanan = LayananModel::where('status', 1)->get();
            $city = CityModel::get();
            $data = [
                'profile_photo' => $dataUser['profile_photo'],
                'type' => $type,
                'layanan' => $layanan,
                'city' => $city,
                'address' => $dataUser['address']
            ];
            return view('user.permohonan.create', $data);
        } else {
            return redirect('login');
        }
    }

    function insertPermohonan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'department_id' => 'required|integer',
            'city_id' => 'required|integer',
            'layanan_id' => 'required|integer',
            'type_id' => 'required|integer',
            'address' => 'required|string',
            'subject' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('createPermohonan')->with('failed', 'Terjadi kesalahan');
        }

        try {
            $dataUser = [
                'address' => $request->input('address')
            ];

            // update data user
            UserModel::where('user_id', session('user_id'))->update($dataUser);

            if ($request->hasFile('evidence')) { // jika ada file
                $file = $request->file('evidence');
                $fileName = time() . "_" . session('user_id')   . "." . $file->getClientOriginalExtension();
                $file->move('data/file', $fileName);
                $data = [
                    'user_id' => session('user_id'),
                    'city_id' => $request->input('city_id'),
                    'department_id' => $request->input('department_id'),
                    'subject' => $request->input('subject'),
                    'layanan_id' => $request->input('layanan_id'),
                    'keterangan' => $request->input('description'),
                    'address' => $request->input('address'),
                    'file' => $fileName,
                    'type_id' => $request->input('type_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $insert = PuModel::insert($data);
                if ($insert) {
                    return redirect('processPermohonan')->with('success', 'Berhasil membuat permohonan baru');
                } else {
                    return redirect('createPermohonan')->with('failed', 'Gagal mengajukan permohonan');
                }
            } else {
                $data = [
                    'user_id' => session('user_id'),
                    'city_id' => $request->input('city_id'),
                    'department_id' => $request->input('department_id'),
                    'subject' => $request->input('subject'),
                    'layanan_id' => $request->input('layanan_id'),
                    'keterangan' => $request->input('description'),
                    'file' => null,
                    'address' => $request->input('address'),
                    'type_id' => $request->input('type_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $insert = PuModel::insert($data);
                if ($insert) {
                    return redirect('processPermohonan')->with('success', 'Berhasil membuat permohonan baru');
                } else {
                    return redirect('createPermohonan')->with('failed', 'Gagal mengajukan permohonan');
                }
            }
        } catch (\Throwable $th) {
            return redirect('createPermohonan')->with('failed', $th->getMessage());
        }
    }

    function allPermohonan()
    {
        if (session('login') != true) {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $dataPermohonan = PuModel::where('user_id', session('user_id'))
            ->orderBy('pm_id', 'desc')
            ->get();
        $data = [
            'profile_photo' => $dataUser['profile_photo'],
            'dataPermohonan' => $dataPermohonan
        ];
        return view('user.permohonan.all_permohonan', $data);
    }

    function processPermohonan()
    {
        if (session('login') != true) {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $dataPermohonan = PuModel::where('user_id', session('user_id'))->where('status', 2)
            ->orderBy('pm_id', 'desc')
            ->get();
        $data = [
            'profile_photo' => $dataUser['profile_photo'],
            'dataPermohonan' => $dataPermohonan
        ];
        return view('user.permohonan.process_permohonan', $data);
    }
}
