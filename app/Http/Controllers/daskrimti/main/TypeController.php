<?php

namespace App\Http\Controllers\daskrimti\main;

use App\Http\Controllers\Controller;
use App\Models\DaskrmtiModel;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
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
            $dataType = TypeModel::get();
            $data = [
                'dataType' => $dataType,
                'dataDaskrimti' => $dataDaskrimti
            ];

            return view('daskrimti.master.master_type', $data);
        } catch (\Throwable $th) {
            return redirect()->route('daskrimtiDashboard')->with('failed', 'Gagal memuat data tipe');
        }
    }

    function insertType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_type' => 'required|string|max:80',
        ], [
            'nama_type.required' => 'Nama tipe tidak boleh kosong',
            'nama_type.string' => 'Nama tipe harus berupa karakter huruf dan angka',
        ]);

        if ($validator->fails()) {
            return redirect()->route('type')->with('failed', $validator->errors()->first())->withInput();
        }

        try {
            $data = [
                'nama_type' => $request->input('nama_type'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $insert = TypeModel::insert($data);
            if ($insert) {
                return redirect()->route('type')->with('success', 'Berhasil menambahkan tipe baru');
            } else {
                return redirect()->route('type')->with('failed', 'Gagal menambahkan tipe baru');
            }
        } catch (\Throwable $th) {
            return redirect()->route('type')->with('failed', 'Terjadi kesalahan');
        }
    }

    function updateType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_id' => 'required|integer',
            'nama_type' => 'required|string|max:80',
            'status' => 'required|integer',
        ], [
            'nama_type.required' => 'Nama tipe tidak boleh kosong',
            'nama_type.string' => 'Nama tipe harus berupa karakter huruf dan angka',
            'status.required' => 'Status tidak boleh kosong',
            'status.integer' => 'Terjadi kesalahan',
            'type_id.required' => 'Terjadi kesalahan',
            'type_id.integer' => 'Terjadi kesalahan',
        ]);

        if ($validator->fails()) {
            return redirect()->route('type')->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'nama_type' => $request->input('nama_type'),
                'status' => $request->input('status'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $update = TypeModel::where('type_id', $request->input('type_id'))->update($data);
            if ($update) {
                return redirect()->route('type')->with('success', 'Berhasil mengubah data tipe');
            } else {
                return redirect()->route('type')->with('failed', 'Gagal mengubah data tipe');
            }
        } catch (\Throwable $th) {
            return redirect()->route('type')->with('failed', 'Terjadi kesalahan');
        }
    }

    function deleteType($typeId)
    {
        try {
            $delete = TypeModel::where('type_id', $typeId)->delete();
            if ($delete) {
                return redirect()->route('type')->with('success', 'Berhasil menghapus data tipe');
            } else {
                return redirect()->route('type')->with('failed', 'Gagal menghapus data tipe');
            }
        } catch (\Throwable $th) {
            return redirect()->route('type')->with('failed', 'Terjadi kesalahan');
        }
    }
}
