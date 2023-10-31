<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class DaskrmtiModel extends Authenticatable
{

    use HasFactory, Notifiable;
    protected $table = 'daskrimti';
    protected $fillable = [
        'daskrimti_id',
        'name',
        'email',
        'password',
    ];
}
