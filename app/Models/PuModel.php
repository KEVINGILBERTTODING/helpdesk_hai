<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PuModel extends Model
{
    use HasFactory;
    protected $table = 'permohonan';

    function getDetailPermohonan($id)
    {
        $data = PuModel::select(
            'permohonan.*',
            'users.name as nama',
            'users.email',
            'layanan.nama_layanan',
            'type.nama_type',
            'balasan_permohonan.balasan',
            'balasan_permohonan.created_at as tgl_balasan'
        )
            ->join('users', 'permohonan.user_id', '=', 'users.user_id')
            ->join('layanan', 'permohonan.layanan_id', '=', 'layanan.layanan_id')
            ->join('type', 'permohonan.type_id', '=', 'type.type_id')
            ->leftJoin('balasan_permohonan', 'permohonan.permohonan_id', '=', 'balasan_permohonan.permohonan_id')
            ->where('permohonan.permohonan_id', $id)
            ->first();
        return $data;
    }

    function search(string $query, int $status)
    {
        if ($status == 3) { // semua
            $data = PuModel::select(
                'permohonan.*'
            )

                ->where('permohonan.subject', 'LIKE', '%' . $query . '%')
                ->where('permohonan.user_id', session('user_id'))
                ->get();
            return $data;
        } else {
            $data = PuModel::select(
                'permohonan.*'
            )

                ->where('permohonan.subject', 'LIKE', '%' . $query . '%')
                ->where('permohonan.user_id', session('user_id'))
                ->where('permohonan.status', $status)
                ->get();
            return $data;
        }
    }

    function getPermohonan($status)
    {
        if ($status == 3) { // all permohonan

            $data = PuModel::select(
                'permohonan.*',
                'users.name as nama_lengkap',
                'users.nrp',
                'users.profile_photo',
                'users.email',
                'bidang.nama_bidang',
                'layanan.nama_layanan',
                'type.nama_type',
                'balasan_permohonan.balasan'
            )

                ->leftJoin('layanan', 'permohonan.layanan_id', '=', 'layanan.layanan_id')
                ->leftJoin('type', 'permohonan.type_id', '=', 'type.type_id')
                ->join('users', 'permohonan.user_id', '=', 'users.user_id')
                ->leftJoin('balasan_permohonan', 'permohonan.permohonan_id', '=', 'balasan_permohonan.permohonan_id')
                ->leftJoin('bidang', 'users.bidang_id', '=', 'bidang.bidang_id')
                ->orderBy('permohonan.permohonan_id', 'desc')
                ->get();
            return $data;
        } else {

            $data = PuModel::select(
                'permohonan.*',
                'users.name as nama_lengkap',
                'users.nrp',
                'users.profile_photo',
                'users.email',
                'bidang.nama_bidang',
                'layanan.nama_layanan',
                'type.nama_type'
            )
                ->leftJoin('bidang', 'permohonan.bidang_id', '=', 'bidang.bidang_id')
                ->leftJoin('layanan', 'permohonan.layanan_id', '=', 'layanan.layanan_id')
                ->leftJoin('type', 'permohonan.type_id', '=', 'type.type_id')
                ->join('users', 'permohonan.user_id', '=', 'users.user_id')
                ->where('permohonan.status', $status)
                ->get();
            return $data;
        }
    }

    function acceptPermohonan($dataBalasan, $dataNotification, $dataPermohonan)
    {
        DB::beginTransaction();

        try {
            PuModel::where('permohonan_id', $dataNotification['user_id'])->update($dataPermohonan);
            $checkBalasan = BalasanModel::where('permohonan_id', $dataNotification['permohonan_id'])->first();

            if ($checkBalasan) {
                BalasanModel::where('permohonan_id', $dataNotification['permohonan_id'])->update($dataBalasan);
            } else {
                BalasanModel::insert($dataBalasan);
            }

            NotificationModel::insert($dataNotification);

            DB::commit(); // Konfirmasi transaksi jika tidak ada kesalahan
            return true; // Transaksi berhasil
        } catch (\Throwable $th) {
            DB::rollBack(); // Batalkan transaksi jika terjadi kesalahan
            // Handle kesalahan atau buat pesan kesalahan jika diperlukan
            return false; // Terjadi kesalahan
        }
    }
}
