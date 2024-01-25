<?php

namespace App\Http\Controllers\AdminDashboard\SystemSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function termsAndConditions(){
        try {
            return view('admin-dashboard.systemsetting.term-and-condition');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function rolesManagement(){
        try {
            return view('admin-dashboard.systemsetting.role-management');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function paymentMethodManagement(){
        try {
            return view('admin-dashboard.systemsetting.payment-method');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function shippingMethodManagement(){
        try {
            return view('admin-dashboard.systemsetting.shipping-method');
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }
}