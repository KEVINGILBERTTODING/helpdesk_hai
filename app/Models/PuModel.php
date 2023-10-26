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
            'department.nama_department',
            'users.name as nama',
            'users.email',
            'layanan_masyarakat.nama_layanan',
            'city.nama as nama_kota',
            'type.nama_type',
        )
            ->join('department', 'permohonan.department_id', '=', 'department.department_id')
            ->join('users', 'permohonan.user_id', '=', 'users.user_id')
            ->join('layanan_masyarakat', 'permohonan.layanan_id', '=', 'layanan_masyarakat.layanan_id')
            ->join('city', 'permohonan.city_id', '=', 'city.city_id')
            ->join('type', 'permohonan.type_id', '=', 'type.type_id')
            ->where('permohonan.permohonan_id', $id)
            ->first();
        return $data;
    }
}
