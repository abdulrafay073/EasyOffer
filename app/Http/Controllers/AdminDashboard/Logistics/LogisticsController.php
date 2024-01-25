<?php

namespace App\Http\Controllers\AdminDashboard\Logistics;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Seller;
use App\Models\Buyer;

use App\Models\SalesMarketingOrder;
use App\Models\CommercialOrder;
use App\Models\LogisticOrder;

class LogisticsController extends Controller
{
    public function logisticOrders(){
        try {

            $data = CommercialOrder::where('is_logistics_orderform_filled', 0)->where('is_active', 1)->get();

            return view('admin-dashboard.logistics.order-confirmation')->with(compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function orderViewDetails($id){
        try {

            $commData = CommercialOrder::where('id', $id)->first();
            $commbuyer = Buyer::where('id', $commData->buyer_id)->first();
            $commseller = Seller::where('id', $commData->seller_id)->first();

            $data = SalesMarketingOrder::where('id', $commData->salemarketingorder_id)->first();

            $buyer = Buyer::where('id', $data->buyer_id)->first();
            $seller = Seller::where('id', $data->seller_id)->first();

            $buyerlist = Buyer::where('is_active', 1)->get();
            $sellerlist = Seller::where('is_active', 1)->get();

            return view('admin-dashboard.logistics.order-viewdetail')->with(compact('commData','commbuyer','commseller','data', 'buyer', 'seller', 'buyerlist', 'sellerlist'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function logisticOrderSubmit(Request $request){
        try {
            
            // dd($request->all());

            // *validation
            $validator = Validator::make($request->all(), [ 
                // 'customer_name' => 'required',   
            ]);
            if ($validator->fails()) { 
                return response()->json(
                    [
                        'error'=>$validator->errors(),
                        'message'=>$validator->errors()->first()
                    ], 
                    $this->badRequest
                );            
            }

            $data = LogisticOrder::create(
                [
                    'commercialorder_id' => $request->commercialorderid,
                    'instruction_from_customer' => $request->instructionfromcustomer,
                    'instruction_from_supplier' => $request->instructionfromsupplier,   
                    'remarks' => $request->instructionremarks,   
                    'indent_sendto_customer' => $request->indenttocustomer,   
                    'indent_sendto_supplier' => $request->indenttosupplier,   
                    'sc_required' => $request->screquired,   
                    'ca_required' => $request->carequired,   
                    'reason' => $request->reason,   
                    'customer_contactperson' => $request->customercontactperson,   
                    'supplier_contactperson' => $request->suppliercontactperson,   
                    'is_ready_for_orderprocessing' => 1,
                    'created_by' => 1,
                    'updated_by' => 1,
                ]
            );

            $order = CommercialOrder::where('id', $request->commercialorderid)->firstOrFail();  //update
            $order->is_logistics_orderform_filled = 1;
            $order->updated_at = Carbon::now();
            $order->save();
            
            return redirect('admin/logistic-orders')->with('logisticorder', 'Order has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
