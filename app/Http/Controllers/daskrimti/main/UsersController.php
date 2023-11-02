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
            'nrp' => 'required|numeric|unique:users,nrp',
            'name' => 'required|string',
            'bidang_id' => 'required|integer',
            'email' => 'required|email|unique:users,email',
        ], [
            'nrp.required' => 'NRP tidak boleh kosong',
            'nrp.numeric' => 'NRP hanya boleh berupa angka',
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



    function updateUsers(Request $request)
    {
        $userId = $request->input('user_id');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'nrp' => 'required|numeric|unique:users,nrp,' .  $userId . ',user_id',
            'name' => 'required|string',
            'bidang_id' => 'required|integer',
            'email' => 'required|email|unique:users,email,' . $userId . ',user_id',
            'status' => 'required|integer',
        ], [
            'user_id.required' => 'Terjadi kesalahan',
            'user_id.integer' => 'Terjadi kesalahan',
            'nrp.required' => 'NRP tidak boleh kosong',
            'nrp.numeric' => 'NRP hanya boleh berupa angka',
            'nrp.unique' => 'NRP telah terdaftar',
            'name.required' => 'Nama lengkap tidak boleh kosong',
            'name.string' => 'Nama lengkap hanya boleh berupa huruf dan angka',
            'bidang_id.required' => 'Bidang tidak boleh kosong',
            'bidang_id.integer' => 'Bidang tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email telah terdaftar',
            'status.required' => 'Anda belum memilih status',
            'status.integer' => 'Terjadi kesalahan',

        ]);

        if ($validator->fails()) {
            return redirect()->route('users')->with('failed', $validator->errors()->first())->withInput();
        }

        try {
            $data = [
                'nrp' => $request->input('nrp'),
                'email' => $request->input('email'),
                'name' => $request->input('name'),
                'bidang_id' => $request->input('bidang_id'),
                'status' => $request->input('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $insert = UserModel::where('user_id', $request->input('user_id'))->update($data);
            if ($insert) {
                return redirect()->route('users')->with('success', 'Berhasil mengubah data staff');
            } else {
                return redirect()->route('users')->with('failed', 'Gagal mengubah ata staff');
            }
        } catch (\Throwable $th) {
            return redirect()->route('users')->with('failed', $th->getMessage());
        }
    }


    function deleteUser($userId)
    {
        try {
            $delete = UserModel::where('user_id', $userId)->delete();
            if ($delete) {
                return redirect()->route('users')->with('success', 'Berhasil menghapus data staff');
            } else {
                return redirect()->route('users')->with('failed', 'Gagal menghapus data staff');
            }
        } catch (\Throwable $th) {
            return redirect()->route('users')->with('failed', 'Terjadi kesalahan');
        }
    }
}
