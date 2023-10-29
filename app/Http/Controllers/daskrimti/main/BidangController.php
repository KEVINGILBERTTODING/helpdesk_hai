<?php

namespace App\Http\Controllers\daskrimti\main;

use App\Http\Controllers\Controller;
use App\Models\BidangModel;
use App\Models\DaskrmtiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
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
            $dataBidang = BidangModel::get();
            $data = [
                'dataBidang' => $dataBidang,
                'dataDaskrimti' => $dataDaskrimti
            ];

            return view('daskrimti.master.master_bidang', $data);
        } catch (\Throwable $th) {
            return redirect()->route('daskrimtiDashboard')->with('failed', 'Gagal memuat data layanan');
        }
    }

    function insertBidang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bidang' => 'required|string|max:80',
        ], [
            'nama_bidang.required' => 'Nama bidang tidak boleh kosong',
            'nama_bidang.string' => 'Nama bidang harus berupa karakter huruf dan angka',
        ]);

        if ($validator->fails()) {
            return redirect()->route('bidang')->with('failed', $validator->errors()->first())->withInput();
        }

        try {
            $data = [
                'nama_bidang' => $request->input('nama_bidang'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $insert = BidangModel::insert($data);
            if ($insert) {
                return redirect()->route('bidang')->with('success', 'Berhasil menambahkan bidang baru');
            } else {
                return redirect()->route('bidang')->with('failed', 'Gagal menambahkan bidang baru');
            }
        } catch (\Throwable $th) {
            return redirect()->route('bidang')->with('failed', 'Terjadi kesalahan');
        }
    }

    // function updateLayanan(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'layanan_id' => 'required|integer',
    //         'nama_layanan' => 'required|string|max:80',
    //         'description' => 'required|string',
    //         'status' => 'required|integer',
    //     ], [
    //         'nama_layanan.required' => 'Nama layanan tidak boleh kosong',
    //         'nama_layanan.string' => 'Nama layanan harus berupa karakter huruf dan angka',
    //         'description.required' => 'Deskripsi tidak boleh kosong',
    //         'description.string' => 'Deskripsi harus berupa karakter huruf dan angka',
    //         'status.required' => 'Status tidak boleh kosong',
    //         'status.integer' => 'Terjadi kesalahan',
    //         'layanan_id.required' => 'Terjadi kesalahan',
    //         'layanan_id.integer' => 'Terjadi kesalahan',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('layanan')->with('failed', $validator->errors()->first());
    //     }

    //     try {
    //         $data = [
    //             'nama_layanan' => $request->input('nama_layanan'),
    //             'description' => $request->input('description'),
    //             'status' => $request->input('status'),
    //             'updated_at' => date('Y-m-d H:i:s')
    //         ];
    //         $update = LayananModel::where('layanan_id', $request->input('layanan_id'))->update($data);
    //         if ($update) {
    //             return redirect()->route('layanan')->with('success', 'Berhasil mengubah data layanan');
    //         } else {
    //             return redirect()->route('layanan')->with('failed', 'Gagal mengubah data layanan');
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->route('layanan')->with('failed', 'Terjadi kesalahan');
    //     }
    // }

    // function deleteLayanan($layananId)
    // {


    //     try {
    //         $delete = LayananModel::where('layanan_id', $layananId)->delete();
    //         if ($delete) {
    //             return redirect()->route('layanan')->with('success', 'Berhasil menghapus data layanan');
    //         } else {
    //             return redirect()->route('layanan')->with('failed', 'Gagal menghapus data layanan');
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->route('layanan')->with('failed', 'Terjadi kesalahan');
    //     }
    // }
}
