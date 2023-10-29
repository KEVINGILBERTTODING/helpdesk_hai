<?php

namespace App\Http\Controllers\daskrimti\main;

use App\Http\Controllers\Controller;
use App\Models\BidangModel;
use App\Models\DaskrmtiModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
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
            $userModel = new UserModel();
            $dataUsers = $userModel->getAllUsers();
            $dataBidang = BidangModel::where('status', 1)->get();
            $data = [
                'dataUsers' => $dataUsers,
                'dataDaskrimti' => $dataDaskrimti,
                'dataBidang' => $dataBidang
            ];

            return view('daskrimti.master.master_users', $data);
        } catch (\Throwable $th) {
            return redirect()->route('daskrimtiDashboard')->with('failed', 'Gagal memuat data pengguna');
        }
    }

    function insertUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nrp' => 'required|integer|unique:users,nrp',
            'name' => 'required|string',
            'bidang_id' => 'required|integer',
            'email' => 'required|email|unique:users,email',
        ], [
            'nrp.required' => 'NRP tidak boleh kosong',
            'nrp.integer' => 'NRP hanya boleh berupa angka',
            'nrp.unique' => 'NRP telah terdaftar',
            'name.required' => 'Nama lengkap tidak boleh kosong',
            'name.string' => 'Nama lengkap hanya boleh berupa huruf dan angka',
            'bidang_id.required' => 'Bidang tidak boleh kosong',
            'bidang_id.integer' => 'Bidang tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email telah terdaftar',

        ]);

        if ($validator->fails()) {
            return redirect()->route('users')->with('failed', $validator->errors()->first())->withInput();
        }

        try {
            $data = [
                'nrp' => $request->input('nrp'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('nrp')),
                'name' => $request->input('name'),
                'bidang_id' => $request->input('bidang_id'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $insert = UserModel::insert($data);
            if ($insert) {
                return redirect()->route('users')->with('success', 'Berhasil menambahkan staff baru');
            } else {
                return redirect()->route('users')->with('failed', 'Gagal menambahkan staff baru');
            }
        } catch (\Throwable $th) {
            return redirect()->route('users')->with('failed', 'Terjadi kesalahan');
        }
    }

    // function updateType(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'type_id' => 'required|integer',
    //         'nama_type' => 'required|string|max:80',
    //         'status' => 'required|integer',
    //     ], [
    //         'nama_type.required' => 'Nama tipe tidak boleh kosong',
    //         'nama_type.string' => 'Nama tipe harus berupa karakter huruf dan angka',
    //         'status.required' => 'Status tidak boleh kosong',
    //         'status.integer' => 'Terjadi kesalahan',
    //         'type_id.required' => 'Terjadi kesalahan',
    //         'type_id.integer' => 'Terjadi kesalahan',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('type')->with('failed', $validator->errors()->first());
    //     }

    //     try {
    //         $data = [
    //             'nama_type' => $request->input('nama_type'),
    //             'status' => $request->input('status'),
    //             'updated_at' => date('Y-m-d H:i:s')
    //         ];
    //         $update = TypeModel::where('type_id', $request->input('type_id'))->update($data);
    //         if ($update) {
    //             return redirect()->route('type')->with('success', 'Berhasil mengubah data tipe');
    //         } else {
    //             return redirect()->route('type')->with('failed', 'Gagal mengubah data tipe');
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->route('type')->with('failed', 'Terjadi kesalahan');
    //     }
    // }

    // function deleteType($typeId)
    // {
    //     try {
    //         $delete = TypeModel::where('type_id', $typeId)->delete();
    //         if ($delete) {
    //             return redirect()->route('type')->with('success', 'Berhasil menghapus data tipe');
    //         } else {
    //             return redirect()->route('type')->with('failed', 'Gagal menghapus data tipe');
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->route('type')->with('failed', 'Terjadi kesalahan');
    //     }
    // }
}
