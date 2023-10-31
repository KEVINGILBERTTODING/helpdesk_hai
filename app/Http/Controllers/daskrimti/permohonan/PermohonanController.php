<?php

namespace App\Http\Controllers\daskrimti\permohonan;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use App\Models\BidangModel;
use App\Models\DaskrmtiModel;
use App\Models\PuModel;
use App\Models\User;
use App\Models\UserModel;
use App\Notifications\replyEmailNotification;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PermohonanController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function semuaPermohonan()
    {
        $permohonanModel = new PuModel();
        $dataPermohonan = $permohonanModel->getPermohonan(3);
        $dataDaskrimti = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->first();
        $dataBidang = BidangModel::get();
        $data = [
            'dataBidang' => $dataBidang,
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
            $user = User::where('email', $email)->first();
            $dataUser = UserModel::where('user_id', $request->input('user_id'))->first();
            $dataDaskrimti = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->first();
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

            $dataNotifEmail = [
                'subject' => 'Permohonan Terkonfirmasi',
                'nama_lengkap' => $dataUser['name'],
                'content' => 'Permohonan yang telah Anda ajukan telah berhasil dikonfirmasi oleh Daskrimti. Klik tombol dibawah ini untuk melihat detail permohonan.',
                'permohonan_id' => $permohonanId,
                'balasan' => $request->input('balasan'),
                'daskrimti_name' => $dataDaskrimti['name']

            ];

            $puModel = new PuModel();
            $transaction = $puModel->acceptPermohonan($dataBalasan, $dataNotification, $dataPermohonan);
            if ($dataNotifEmail != null) {
                $user->notify(new replyEmailNotification($dataNotifEmail));
            } else {
                return redirect()->route('semuaPermohonan')->with('failed', 'Terjadi Kesalahan');
            }

            if ($transaction) {
                return redirect()->route('semuaPermohonan')->with('success', 'Permohonan selesai');
            } else {
                return redirect()->route('semuaPermohonan')->with('failed', 'Terjadi Kesalahan');
            }
        } catch (\Throwable $th) {
            return redirect()->route('semuaPermohonan')->with('failed', $th->getMessage());
        }
    }

    function rejectPermohonan(Request $request)
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
            $user = User::where('email', $email)->first();
            $dataUser = UserModel::where('user_id', $request->input('user_id'))->first();
            $dataDaskrimti = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->first();
            $dataBalasan = [
                'permohonan_id' => $permohonanId,
                'daskrimti_id' => session('daskrimti_id'),
                'balasan' => $request->input('balasan'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $dataPermohonan = [
                'status' => 0
            ];

            $dataNotification = [
                'user_id' => $request->input('user_id'),
                'permohonan_id' => $permohonanId,
                'type' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $dataNotifEmail = [
                'subject' => 'Permohonan Ditolak',
                'nama_lengkap' => $dataUser['name'],
                'content' => 'Permohonan yang telah Anda ajukan telah ditolak oleh Daskrimti. Klik tombol dibawah ini untuk melihat detail permohonan.',
                'permohonan_id' => $permohonanId,
                'balasan' => $request->input('balasan'),
                'daskrimti_name' => $dataDaskrimti['name']

            ];




            $puModel = new PuModel();
            $transaction = $puModel->rejectPermohonan($dataBalasan, $dataNotification, $dataPermohonan);
            if ($dataNotifEmail != null) {
                $user->notify(new replyEmailNotification($dataNotifEmail));
            } else {
                return redirect()->route('semuaPermohonan')->with('failed', 'Terjadi Kesalahan');
            }
            if ($transaction) {
                return redirect()->route('semuaPermohonan')->with('success', 'Permohonan ditolak');
            } else {
                return redirect()->route('semuaPermohonan')->with('failed', 'Terjadi Kesalahan');
            }
        } catch (\Throwable $th) {
            return redirect()->route('semuaPermohonan')->with('failed', $th->getMessage());
        }
    }

    function filterPermohonan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|integer',
            'date_from' => 'required|date',
            'date_end' => 'required|date',
            'status' => 'required|integer',
            'bidang_id' => 'required|integer',


        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $puModel = new PuModel();
            $dataDaskrimti = DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->first();
            $dataBidang = BidangModel::get();
            $namaBidang = BidangModel::where('bidang_id', $request->input('bidang_id'))->first();
            $dataPermohonan = $puModel->filterPermohonan($request->input('date_from'), $request->input('date_end'), $request->input('bidang_id'), $request->input('status'));
            if ($dataPermohonan && !$dataPermohonan->isEmpty()) {
                $data = [
                    'dataPermohonan' => $dataPermohonan,
                    'dataDaskrimti' => $dataDaskrimti,
                    'dataBidang' => $dataBidang,
                    'dateFrom' => $request->input('date_from'),
                    'dateEnd' => $request->input('date_end'),
                    'status' => $request->input('status'),
                    'nama_bidang' => $namaBidang['nama_bidang'],
                    'bidang_id' => $request->input('bidang_id')
                ];
                return view('daskrimti.permohonan.filter_permohonan', $data);
            } else {
                return redirect()->back()->with('failed', 'Tidak ada data permohonan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function createPdf(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required|integer',
            'date_from' => 'required|date',
            'date_end' => 'required|date',
            'status' => 'required|integer',
            'bidang_id' => 'required|integer',


        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {

            $puModel = new PuModel();
            $namaBidang = BidangModel::where('bidang_id', $request->input('bidang_id'))->first();
            $dataPermohonan = $puModel->filterPermohonan($request->input('date_from'), $request->input('date_end'), $request->input('bidang_id'), $request->input('status'));
            $main_logo = public_path('template/landing_page/img/img_login.png');
            if ($dataPermohonan && !$dataPermohonan->isEmpty()) {
                $data = [
                    'title' => 'Kejati jateng',
                    'dataPermohonan' => $dataPermohonan,
                    'date_start' => $request->input('date_from'),
                    'date_end' => $request->input('date_end'),
                    'status' => $request->input('status'),
                    'nama_bidang' => $namaBidang['nama_bidang'],
                    'main_logo' => $main_logo,
                    'nama_daskrimti' => DaskrmtiModel::where('daskrimti_id', session('daskrimti_id'))->first()['name'],
                    'address' => AppModel::where('app_id', 1)->first()['address']
                ];
                $pdf = FacadePdF::loadView('daskrimti/permohonan/report_pdf', $data);
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('Laporan_' . $namaBidang['nama_bidang'] . '_' . $request->input('date_from') . '-' . $request->input('date_end') . '.pdf');
            } else {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }
}
