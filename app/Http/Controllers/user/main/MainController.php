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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

use function PHPUnit\Framework\fileExists;

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
            $data = [
                'profile_photo' => $dataUser['profile_photo'],
                'type' => $type,
                'layanan' => $layanan
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
            'layanan_id' => 'required|integer',
            'type_id' => 'required|integer',
            'subject' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('createPermohonan')->with('failed', 'Terjadi kesalahan');
        }

        try {


            if ($request->hasFile('evidence')) { // jika ada file
                $validatorFile = Validator::make($request->all(), [
                    'evidence' => 'required|mimes:png,jpg,jpeg,pdf|max:10000',
                ]);

                if ($validatorFile->fails()) {
                    return redirect('createPermohonan')->with('failed', 'File tidak valid');
                }

                $file = $request->file('evidence');
                $fileName = time() . "_" . session('user_id')   . "." . $file->getClientOriginalExtension();
                $file->move('data/file', $fileName);
                $data = [
                    'user_id' => session('user_id'),
                    'department_id' => $request->input('department_id'),
                    'subject' => $request->input('subject'),
                    'layanan_id' => $request->input('layanan_id'),
                    'keterangan' => $request->input('description'),
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
            return redirect('createPermohonan')->with('failed', 'Terjadi kesalahan');
        }
    }

    function allPermohonan()
    {
        if (session('login') != true) {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $dataPermohonan = PuModel::where('user_id', session('user_id'))
            ->orderBy('permohonan_id', 'desc')
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
            ->orderBy('permohonan_id', 'desc')
            ->get();
        $data = [
            'profile_photo' => $dataUser['profile_photo'],
            'dataPermohonan' => $dataPermohonan
        ];
        return view('user.permohonan.process_permohonan', $data);
    }

    function detailPermohonan($id)
    {

        if (session('login') != true) {
            return redirect('login');
        }
        try {

            $puModel = new PuModel();
            $dataPermohonan = $puModel->getDetailPermohonan(Crypt::decrypt($id));
            $dataUser = User::where('user_id', session('user_id'))->first();

            if ($dataPermohonan == null || $dataPermohonan['user_id'] != session('user_id')) {
                return redirect('dashboard')->with('failed', 'Terjadi kesalahan dalam memuat detail permohonan');
            }

            $data = [
                'dataPermohonan' => $dataPermohonan,
                'profile_photo' => $dataUser['profile_photo']
            ];

            return view('user.permohonan.detail', $data);
        } catch (\Throwable $th) {
            return redirect('dashboard')->with('failed', 'Terjadi kesalahan dalam memuat detail permohonan');
        }
    }

    function downloadFilePermohonan($fileName)
    {
        $path = public_path('data/file/' . $fileName);
        if (fileExists($path)) {
            return response()->download($path);
        } else {
            return abort(404);
        }
    }
}
