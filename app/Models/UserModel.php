<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'users';

    function getAllUsers()
    {
        $data = UserModel::select(
            'users.*',
            'bidang.nama_bidang'
        )
            ->leftJoin('bidang', 'users.bidang_id', '=', 'bidang.bidang_id')
            ->get();

        return $data;
    }
}
