<?php

namespace App\Http\Controllers\daskrimti\main;

use App\Http\Controllers\Controller;
use App\Models\DaskrmtiModel;
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
            $data = [
                'dataDaskrimti' => $dataDaskrimti
            ];
            return view('daskrimti.dashboard.dashboard', $data);
        } catch (\Throwable $th) {
            return redirect()->route('/');
        }
    }
}
