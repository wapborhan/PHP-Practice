<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;
use Hash;
use Auth;

class NotificationController extends Controller
{
    public function notifications()
    {
        $notifications = Auth::user()->allNotifications;
        return view('backend.notifications.index', compact('notifications') );
    }

    public function notification($id)
    {

        $notification = \Auth::user()->notifications()->where('id',$id)->first();
        if($notification->read_at == null){
            $notification->markAsRead();
        }

        return redirect($notification->data['message']['url']);
    }
}
