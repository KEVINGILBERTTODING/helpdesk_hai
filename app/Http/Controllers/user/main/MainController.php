<?php

namespace App\Http\Controllers\user\main;

use App\Http\Controllers\Controller;
use App\Models\BidangModel;
use App\Models\CityModel;
use App\Models\LayananModel;
use App\Models\NotificationModel;
use App\Models\PuModel;
use App\Models\TypeModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Type\Integer;

use function PHPUnit\Framework\fileExists;

class MainController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    function index()
    {
        if (session('login') != true && session('role') != 'staff') {
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
        $notifModel = new NotificationModel();
        $dataNotification = $notifModel->getNotification(session('user_id'));
        $data = [
            'dataUser' => $dataUser,
            'permohonanValid' => $permohonanValid,
            'permohonanTidakValid' => $permohonanTidakValid,
            'permohonanProses' => $permohonanProses,
            'totalPermohonan' => $totalPermohonan,
            'dataNotification' => $dataNotification
        ];
        return view('user.main.dashboard', $data);
    }

    function createPermohonan()
    {
        if (session('login') == true) {
            $dataUser = User::where('user_id', session('user_id'))->first();
            if ($dataUser['email'] == null) {
                return redirect()->route('dashboard')->with('failed', 'Harap mengisi alamat email Anda pada menu profil');
            }
            $type = TypeModel::where('status', 1)->get();
            $layanan = LayananModel::where('status', 1)->get();
            $notifModel = new NotificationModel();
            $dataNotification = $notifModel->getNotification(session('user_id'));
            $data = [
                'dataUser' => $dataUser,
                'type' => $type,
                'layanan' => $layanan,
                'dataNotification' => $dataNotification

            ];
            return view('user.permohonan.create', $data);
        } else {
            return redirect('login');
        }
    }

    function insertPermohonan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'layanan_id' => 'required|integer',
            'type_id' => 'required|integer',
            'subject' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect('createPermohonan')->with('failed', 'Terjadi kesalahan');
        }

        try {


            if ($request->hasFile('evidence')) { // jika ada file
                $validatorFile = Validator::make($request->all(), [
                    'evidence' => 'required|mimes:png,jpg,jpeg,pdf|max:10000',
                ]);

                if ($validatorFile->fails()) {
                    return redirect('createPermohonan')->with('failed', 'File tidak valid')->withInput();
                }

                $file = $request->file('evidence');
                $fileName = time() . "_" . session('user_id')   . "." . $file->getClientOriginalExtension();
                $file->move('data/file', $fileName);
                $data = [
                    'user_id' => session('user_id'),
                    'subject' => $request->input('subject'),
                    'layanan_id' => $request->input('layanan_id'),
                    'keterangan' => $request->input('description'),
                    'file' => $fileName,
                    'type_id' => $request->input('type_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $insert = PuModel::insert($data);
                if ($insert) {
                    return redirect('processPermohonan')->with('success', 'Berhasil membuat permohonan baru');
                } else {
                    return redirect('createPermohonan')->with('failed', 'Gagal mengajukan permohonan');
                }
            } else {
                $data = [
                    'user_id' => session('user_id'),
                    'subject' => $request->input('subject'),
                    'layanan_id' => $request->input('layanan_id'),
                    'keterangan' => $request->input('description'),
                    'file' => null,
                    'type_id' => $request->input('type_id'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $insert = PuModel::insert($data);
                if ($insert) {
                    return redirect('processPermohonan')->with('success', 'Berhasil membuat permohonan baru');
                } else {
                    return redirect('createPermohonan')->with('failed', 'Gagal mengajukan permohonan');
                }
            }
        } catch (\Throwable $th) {
            return redirect('createPermohonan')->with('failed', 'Terjadi kesalahan');
        }
    }

    function allPermohonan()
    {
        if (session('login') != true && session('role') != 'staff') {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $dataPermohonan = PuModel::where('user_id', session('user_id'))
            ->orderBy('permohonan_id', 'desc')
            ->get();
        $notifModel = new NotificationModel();
        $dataNotification = $notifModel->getNotification(session('user_id'));
        $data = [
            'dataNotification' => $dataNotification,
            'dataUser' => $dataUser,
            'dataPermohonan' => $dataPermohonan,
        ];
        return view('user.permohonan.all_permohonan', $data);
    }

    function processPermohonan()
    {
        if (session('login') != true && session('role') != 'staff') {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $dataPermohonan = PuModel::where('user_id', session('user_id'))->where('status', 2)
            ->orderBy('permohonan_id', 'desc')
            ->get();
        $notifModel = new NotificationModel();
        $dataNotification = $notifModel->getNotification(session('user_id'));
        $data = [
            'dataNotification' => $dataNotification,
            'dataUser' => $dataUser,
            'dataPermohonan' => $dataPermohonan
        ];
        return view('user.permohonan.process_permohonan', $data);
    }

    function successPermohonan()
    {
        if (session('login') != true && session('role') != 'staff') {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $dataPermohonan = PuModel::where('user_id', session('user_id'))->where('status', 1)
            ->orderBy('permohonan_id', 'desc')
            ->get();
        $notifModel = new NotificationModel();
        $dataNotification = $notifModel->getNotification(session('user_id'));
        $data = [
            'dataNotification' => $dataNotification,
            'dataUser' => $dataUser,
            'dataPermohonan' => $dataPermohonan
        ];
        return view('user.permohonan.success_permohonan', $data);
    }

    function failedPermohonan()
    {
        if (session('login') != true && session('role') != 'staff') {
            return redirect('login');
        }
        $dataUser = User::where('user_id', session('user_id'))->first();
        $dataPermohonan = PuModel::where('user_id', session('user_id'))->where('status', 0)
            ->orderBy('permohonan_id', 'desc')
            ->get();
        $notifModel = new NotificationModel();
        $dataNotification = $notifModel->getNotification(session('user_id'));
        $data = [
            'dataNotification' => $dataNotification,
            'dataUser' => $dataUser,
            'dataPermohonan' => $dataPermohonan
        ];
        return view('user.permohonan.failed_permohonan', $data);
    }

    function detailPermohonan($id)
    {

        if (session('login') != true && session('role') != 'staff') {
            return redirect('login');
        }
        try {

            $puModel = new PuModel();
            $dataPermohonan = $puModel->getDetailPermohonan(Crypt::decrypt($id));
            $dataUser = User::where('user_id', session('user_id'))->first();
            $namaBidang = BidangModel::where('bidang_id', $dataUser['bidang_id'])->first();

            if ($dataPermohonan == null || $dataPermohonan['user_id'] != session('user_id')) {
                return redirect('dashboard')->with('failed', 'Terjadi kesalahan dalam memuat detail permohonan');
            }

            $notifModel = new NotificationModel();
            $dataNotification = $notifModel->getNotification(session('user_id'));
            $data = [
                'dataNotification' => $dataNotification,
                'dataPermohonan' => $dataPermohonan,
                'dataUser' => $dataUser,
                'nama_bidang' => $namaBidang['nama_bidang']
            ];

            return view('user.permohonan.detail', $data);
        } catch (\Throwable $th) {
            return redirect('dashboard')->with('failed', 'Terjadi kesalahan dalam memuat detail permohonan');
        }
    }

    function downloadFilePermohonan($fileName)
    {
        $path = public_path() . "/data/file/" . $fileName;


        if (file_exists($path)) {
            // Determine the appropriate content type based on the file extension.
            $fileExtension = pathinfo($path, PATHINFO_EXTENSION);
            $contentType = $this->getContentType($fileExtension);

            if ($contentType) {
                // Set the content type header.


                $headers = [
                    'Content-Type: ' . $contentType,
                ];

                ob_end_clean();

                // Return the file for download.
                return response()->download($path, $fileName, $headers);
            }
        } else {
            return abort(404);
        }
    }

    function downloadFileBalasan($fileName)
    {
        $path = public_path() . "/data/file_balasan/" . $fileName;


        if (file_exists($path)) {
            // Determine the appropriate content type based on the file extension.
            $fileExtension = pathinfo($path, PATHINFO_EXTENSION);
            $contentType = $this->getContentType($fileExtension);

            if ($contentType) {
                // Set the content type header.


                $headers = [
                    'Content-Type: ' . $contentType,
                ];

                ob_end_clean();

                // Return the file for download.
                return response()->download($path, $fileName, $headers);
            }
        } else {
            return abort(404);
        }
    }

    // Function to determine the content type based on the file extension.
    private function getContentType($fileExtension)
    {
        switch ($fileExtension) {
            case 'pdf':
                return 'application/pdf';
            case 'jpg':
            case 'png':
            case 'jpeg':
                return 'image/jpeg';
                // Add more cases for other file types if needed.
            default:
                return false; // Unknown file type.
        }
    }


    function deletePermohonan($id)
    {
        if (session('login') != true && session('role') != 'staff') {
            return redirect('login');
        }
        try {
            $deletePermohonan = PuModel::where('permohonan_id', $id)->delete();
            if ($deletePermohonan) {
                return redirect()->route('allPermohonan')->with('success', 'Berhasil menghapus data');
            } else {
                return redirect()->route('allPermohonan')->with('failed', 'Gagal menghapus data');
            }
        } catch (\Throwable $th) {
            return redirect()->route('allPermohonan')->with('failed', 'Terjadi kesalahan');
        }
    }

    function updatePermohonan($id)
    {

        if (session('login') != true && session('role') != 'staff') {
            return redirect('login');
        }
        try {

            $puModel = new PuModel();
            $dataPermohonan = $puModel->getDetailPermohonan(Crypt::decrypt($id));
            $dataUser = User::where('user_id', session('user_id'))->first();
            $namaBidang = BidangModel::where('bidang_id', $dataUser['bidang_id'])->where('status', 1)->first();
            $dataType = TypeModel::where('status', 1)->get();
            $dataLayanan = LayananModel::where('status', 1)->get();
            if ($dataPermohonan == null || $dataPermohonan['user_id'] != session('user_id')) {
                return redirect()->route('detailPermohonan', $id)->with('failed', 'Terjadi kesalahan dalam memuat detail permohonan');
            }
            $notifModel = new NotificationModel();
            $dataNotification = $notifModel->getNotification(session('user_id'));
            $data = [
                'dataNotification' => $dataNotification,
                'dataPermohonan' => $dataPermohonan,
                'dataUser' => $dataUser,
                'nama_bidang' => $namaBidang['nama_bidang'],
                'data_type' => $dataType,
                'data_layanan' => $dataLayanan
            ];

            return view('user.permohonan.update', $data);
        } catch (\Throwable $th) {
            return redirect()->route('detailPermohonan', $id)->with('failed', 'Terjadi kesalahan dalam memuat detail permohonan');
        }
    }

    function updateData(Request $request)
    {
        if (session('login') != true && session('role') != 'staff') {
            return redirect('login');
        }
        $validator = Validator::make($request->all(), [
            'permohonan_id' => 'integer|required',
            'layanan_id' => 'required|integer',
            'type_id' => 'required|integer',
            'subject' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('detailPermohonan', Crypt::encrypt($request->input('permohonan_id')))->with('failed', 'Terjadi kesalahan');
        }

        try {


            if ($request->hasFile('evidence')) { // jika ada file
                $validatorFile = Validator::make($request->all(), [
                    'evidence' => 'required|mimes:png,jpg,jpeg,pdf|max:10000',
                ]);

                if ($validatorFile->fails()) {
                    return redirect()->route('detailPermohonan', Crypt::encrypt($request->input('permohonan_id')))->with('failed', 'File tidak valid');
                }

                $file = $request->file('evidence');
                $fileName = time() . "_" . session('user_id')   . "." . $file->getClientOriginalExtension();
                $file->move('data/file', $fileName);
                $data = [
                    'subject' => $request->input('subject'),
                    'layanan_id' => $request->input('layanan_id'),
                    'keterangan' => $request->input('description'),
                    'file' => $fileName,
                    'type_id' => $request->input('type_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $update = PuModel::where('permohonan_id', $request->input('permohonan_id'))->update($data);

                if ($update) {
                    return redirect()->route('detailPermohonan', Crypt::encrypt($request->input('permohonan_id')))->with('success', 'Berhasil mengubah permohonan');
                } else {
                    return redirect()->route('detailPermohonan', Crypt::encrypt($request->input('permohonan_id')))->with('failed', 'Gagal mengubah permohonan');
                }
            } else {
                $data = [

                    'subject' => $request->input('subject'),
                    'layanan_id' => $request->input('layanan_id'),
                    'keterangan' => $request->input('description'),
                    'type_id' => $request->input('type_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $update = PuModel::where('permohonan_id', $request->input('permohonan_id'))->update($data);
                if ($update) {
                    return redirect()->route('detailPermohonan', Crypt::encrypt($request->input('permohonan_id')))->with('success', 'Berhasil mengubah permohonan');
                } else {
                    return redirect()->route('detailPermohonan', Crypt::encrypt($request->input('permohonan_id')))->with('failed', 'Gagal mengubah permohonan');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->route('detailPermohonan', Crypt::encrypt($request->input('permohonan_id')))->with('failed', 'Terjadi kesalahan');
        }
    }

    function search(Request $request)
    {
        if (session('login') != true && session('role') != 'staff') {
            return redirect()->route('login');
        }




        $validator = Validator::make($request->all(), [
            'query' => 'required|string',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $puModel = new PuModel();
            $dataUser = User::where('user_id', session('user_id'))->first();
            $notifModel = new NotificationModel();
            $dataNotification = $notifModel->getNotification(session('user_id'));
            $dataPermohonan = $puModel->search($request->input('query'), $request->input('status'));

            $data = [
                'dataNotification' => $dataNotification,
                'dataPermohonan' => $dataPermohonan,
                'dataUser' => $dataUser
            ];

            return view('user.permohonan.search_permohonan', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
