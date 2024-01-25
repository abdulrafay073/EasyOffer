<?php

namespace App\Http\Controllers\BuyerDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BuyerDashboardController extends Controller
{
    public function index(){
        try {
            return view('buyer-dashboard.dashboard');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    // Need to create Notification Controller
    public function notification(){
        try {
            return view('buyer-dashboard.notification.notification');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

}