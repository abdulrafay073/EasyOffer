<?php

namespace App\Http\Controllers\SellerDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SellerDashboardController extends Controller
{
    public function index(){
        try {
            return view('seller-dashboard.dashboard');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    // Need to create Bid Controller
    public function createBid(){
        try {
            return view('seller-dashboard.bids.create-bid');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }
    
    public function placedBids(){
        try {
            return view('seller-dashboard.bids.placed-bids');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    // Need to create Notification Controller
    public function notification(){
        try {
            return view('seller-dashboard.notification.notification');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    // Need to create Profile Controller
    public function updateProfile(){
        try {
            return view('seller-dashboard.profile.update-profile');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

}