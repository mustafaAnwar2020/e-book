<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(){
        $notify = auth()->user()->unreadNotifications;
        return view('users.notifications.index')->with('notifications',$notify);
    }

    public function update(Request $request, DatabaseNotification $notification){
        $notification->markAsRead();
        return redirect()->route('notifications.index');
    }

    public function destroy(){
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->route('notifications.index');
    }
}
