<?php

namespace App\Http\Controllers\daskrimti\main;

use App\Http\Controllers\Controller;
use App\Models\DaskrmtiModel;
use App\Models\PuModel;
use Illuminate\Http\Request;

class DaskrimtiController extends Controller
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
            $permohonanValid = PuModel::where('status', 1)->count();
            $permohonanTidakValid = PuModel::where('status', 0)->count();
            $permohonanProses = PuModel::where('status', 2)->count();
            $totalPermohonan = PuModel::count();
            $data = [
                'dataDaskrimti' => $dataDaskrimti,
                'permohonanValid' => $permohonanValid,
                'permohonanTidakValid' => $permohonanTidakValid,
                'permohonanProses' => $permohonanProses,
                'totalPermohonan' => $totalPermohonan,
            ];
            return view('daskrimti.dashboard.dashboard', $data);
        } catch (\Throwable $th) {
            return redirect()->route('/');
        }
    }
}
