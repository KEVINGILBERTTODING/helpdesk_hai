<?php

namespace App\Http\Controllers\daskrimti\permohonan;

use App\Http\Controllers\Controller;
use App\Models\DaskrmtiModel;
use App\Models\PuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermohonanController extends Controller
{
    function semuaPermohonan()
    {
        $permohonanModel = new PuModel();
        $dataPermohonan = $permohonanModel->getPermohonan(3);

        $dataDaskrimti = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->first();
        $data = [
            'dataPermohonan' => $dataPermohonan,
            'dataDaskrimti' => $dataDaskrimti
        ];

        return view('daskrimti.permohonan.all_permohonan', $data);
    }

    function acceptPermohonan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'balasan' => 'required|string',
            'permohonan_id' => 'required|integer',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()->route('semuaPermohonan')->with('failed', $validator->errors()->first());
        }

        try {
            $email = $request->input('email');
            $permohonanId = $request->input('permohonan_id');
            $dataBalasan = [
                'permohonan_id' => $permohonanId,
                'daskrimti_id' => session('daskrimti_id'),
                'balasan' => $request->input('balasan'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $dataPermohonan = [
                'status' => 1
            ];

            $dataNotification = [
                'user_id' => $request->input('user_id'),
                'permohonan_id' => $permohonanId,
                'type' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $puModel = new PuModel();
            $transaction = $puModel->acceptPermohonan($dataBalasan, $dataNotification, $dataPermohonan);
            if ($transaction) {
                return redirect()->route('semuaPermohonan')->with('success', 'Permohonan selesai');
            } else {
                return redirect()->route('semuaPermohonan')->with('failed', 'Terjadi Kesalahan');
            }
        } catch (\Throwable $th) {
            return redirect()->route('semuaPermohonan')->with('failed', $th->getMessage());
        }
    }
}
