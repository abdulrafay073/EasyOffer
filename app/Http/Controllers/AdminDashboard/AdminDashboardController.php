<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        try {



            return view('admin-dashboard.dashboard');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
