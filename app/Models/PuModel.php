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
            'alasan_permohonan.alasan',
            'alasan_permohonan.created_at as tgl_alasan'
        )
            ->join('users', 'permohonan.user_id', '=', 'users.user_id')
            ->join('layanan', 'permohonan.layanan_id', '=', 'layanan.layanan_id')
            ->join('type', 'permohonan.type_id', '=', 'type.type_id')
            ->leftJoin('alasan_permohonan', 'permohonan.permohonan_id', '=', 'alasan_permohonan.permohonan_id')
            ->where('permohonan.permohonan_id', $id)
            ->first();
        return $data;
    }
}
