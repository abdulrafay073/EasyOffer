<?php

namespace App\Http\Controllers\AdminDashboard\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification(){
        try {
            return view('admin-dashboard.notification.notification');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }
}