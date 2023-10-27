<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    use HasFactory;
    protected $table = 'notification';

    function getNotification($userId)
    {
        $notification = NotificationModel::select(
            'notification.*'
        )
            ->where('notification.user_id', $userId)
            ->orderBy('notif_id', 'desc')
            ->get();

        return $notification;
    }
}
