<?php

namespace App\Http\Controllers\user\main;

use App\Http\Controllers\Controller;
use App\Models\PuModel;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{

    function index()
    {
        if (session('login') != true) {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $permohonanValid = PuModel::where('user_id', session('user_id'))
            ->where('status', 1)->count();
        $permohonanTidakValid = PuModel::where('user_id', session('user_id'))
            ->where('status', 0)->count();
        $permohonanProses = PuModel::where('user_id', session('user_id'))
            ->where('status', 2)->count();
        $totalPermohonan = PuModel::where('user_id', session('user_id'))->count();
        $data = [
            'profile_photo' => $dataUser['profile_photo'],
            'permohonanValid' => $permohonanValid,
            'permohonanTidakValid' => $permohonanTidakValid,
            'permohonanProses' => $permohonanProses,
            'totalPermohonan' => $totalPermohonan
        ];
        return view('user.main.dashboard', $data);
    }

    function createPermohonan()
    {
        if (session('login') == true) {
            $dataUser = User::where('user_id', session('user_id'))->first();
            $data = [
                'profile_photo' => $dataUser['profile_photo']
            ];
            return view('user.permohonan.create', $data);
        } else {
            return redirect('login');
        }
    }
}
