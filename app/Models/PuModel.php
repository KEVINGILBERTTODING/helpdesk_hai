<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
