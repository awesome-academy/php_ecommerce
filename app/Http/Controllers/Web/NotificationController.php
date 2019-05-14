<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        if (Auth::user()->unreadNotifications()->get()->markAsRead()) {
            return response()->json([
                'status' => trans('common.notification.status.mark_all_read'),
            ]);
        }
    }

    public function markSingleAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        if ($notification) {
            $notification->markAsRead();

            return response()->json([
                'status' => trans('common.notification.status.mark_single_read_success'),
            ]);
        } else {
            return response()->json([
                'status' => trans('common.notification.status.mark_single_read_fail'),
            ]);
        }
    }

    public function removeAll()
    {
        if (Auth::user()->notifications()->delete()) {
            return response()->json([
                'status' => trans('common.notification.status.remove_all'),
            ]);
        }
    }
}
