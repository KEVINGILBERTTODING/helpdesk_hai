<?php

namespace App\Http\Controllers\daskrimti\main;

use App\Http\Controllers\Controller;
use App\Models\DaskrmtiModel;
use App\Models\LayananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
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
            $dataLayanan = LayananModel::get();
            $data = [
                'dataLayanan' => $dataLayanan,
                'dataDaskrimti' => $dataDaskrimti
            ];

            return view('daskrimti.master.master_layanan', $data);
        } catch (\Throwable $th) {
            return redirect()->route('daskrimtiDashboard')->with('failed', 'Gagal memuat data layanan');
        }
    }

    function insertLayanan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:80',
            'description' => 'required|string'
        ], [
            'nama_layanan.required' => 'Nama layanan tidak boleh kosong',
            'nama_layanan.string' => 'Nama layanan harus berupa karakter huruf dan angka',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.string' => 'Deskripsi harus berupa karakter huruf dan angka',
        ]);

        if ($validator->fails()) {
            return redirect()->route('layanan')->with('failed', $validator->errors()->first())->withInput();
        }

        try {
            $data = [
                'nama_layanan' => $request->input('nama_layanan'),
                'description' => $request->input('description'),
                'created_at' => date('Y-m-d H:i:s')
            ];
            $insert = LayananModel::insert($data);
            if ($insert) {
                return redirect()->route('layanan')->with('success', 'Berhasil menambahkan layanan baru');
            } else {
                return redirect()->route('layanan')->with('failed', 'Gagal menambahkan layanan baru')->withInput();
            }
        } catch (\Throwable $th) {
            return redirect()->route('layanan')->with('failed', 'Terjadi kesalahan')->withInput();
        }
    }
}
