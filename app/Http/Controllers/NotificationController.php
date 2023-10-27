<?php

namespace App\Http\Controllers;

use App\Models\NotificationModel;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function markAllRead()
    {
        if (session('login') != true) {
            return redirect()->route('login');
        }

        try {
            $data = [
                'is_read' => 1
            ];
            $update = NotificationModel::where('is_read', 0)->where('user_id', session('user_id'))->update($data);
            if ($update) {
                return redirect()->route('dashboard')->with('success', 'Berhasil menandai notifikasi');
            } else {
                return redirect()->route('dashboard')->with('failed', 'Gagal menandai notifikasi');
            }
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('failed', $th->getMessage());
        }
    }

    function delete()
    {
        if (session('login') != true) {
            return redirect()->route('login');
        }

        try {

            $update = NotificationModel::where('user_id', session('user_id'))->delete();
            if ($update) {
                return redirect()->route('dashboard')->with('success', 'Berhasil menghapus notifikasi');
            } else {
                return redirect()->route('dashboard')->with('failed', 'Gagal menghapus notifikasi');
            }
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('failed', 'Gagal menghapus notifikasi');
        }
    }
}
