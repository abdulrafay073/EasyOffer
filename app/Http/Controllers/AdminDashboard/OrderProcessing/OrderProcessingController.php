<?php

namespace App\Http\Controllers\AdminDashboard\OrderProcessing;

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

use App\Models\OrderProcessingStages;

class OrderProcessingController extends Controller
{
    // Running Deals Tab
    public function runningDeals(){
        try {

            $dataArray = [];
            $data = LogisticOrder::where('is_ready_for_orderprocessing', 1)->where('order_processing_cancel', 0)->where('status', '!=', 'Order Completed')->where('status', '!=', 'Purchase Deal Cancelled')->where('status', '!=', 'Sale Deal Cancelled')->get();
            foreach($data as $item){

                $comdata = CommercialOrder::where('id', $item->commercialorder_id)->first();
                $saledata = SalesMarketingOrder::where('id', $comdata->salemarketingorder_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'marketingperson_name' => $saledata->marketingperson_name,
                    'commercialperson_name' => $comdata->commercialperson_name,
                    'status' => $item->status,
                    'date' => $item->created_at,
                ];
            }

            return view('admin-dashboard.orderprocessing.running-deals')->with(compact('dataArray'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function runningDealViewDetail($id){
        try {

            $logData = LogisticOrder::where('id', $id)->first();
            // $logbuyer = Buyer::where('id', $logData->buyer_id)->first();
            // $logseller = Seller::where('id', $logData->seller_id)->first(); 

            $commData = CommercialOrder::where('id', $logData->commercialorder_id)->first();
            $commbuyer = Buyer::where('id', $commData->buyer_id)->first();
            $commseller = Seller::where('id', $commData->seller_id)->first();

            $data = SalesMarketingOrder::where('id', $commData->salemarketingorder_id)->first();
            $buyer = Buyer::where('id', $data->buyer_id)->first();
            $seller = Seller::where('id', $data->seller_id)->first();

            $orderprocess = OrderProcessingStages::where('logisticorder_id', $logData->id)->first();

            return view('admin-dashboard.orderprocessing.running-deals-viewdetail')->with(compact('logData','commData','commbuyer','commseller','data', 'buyer', 'seller', 'orderprocess'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function runningDealsCancel(Request $request){
        try {
        
            $deal = LogisticOrder::where('id', $request->logistic_orderid)->firstOrFail();  //update
            $deal->order_processing_cancel = 1;
            $deal->order_processing_cancelreason = $request->note;
            $deal->status = "Order Cancelled";
            $deal->updated_at = Carbon::now();
            $deal->save();
            
            return redirect('admin/running-deals')->with('runningdealcancel', 'Deal has been cancelled successfully !');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Cancel Deals Tab
    public function canceledDeals(){
        try {

            $dataArray = [];
            $data = LogisticOrder::where('is_ready_for_orderprocessing', 1)
                                    ->whereIn('status', ['Order Cancelled', 'Purchase Deal Cancelled', 'Sale Deal Cancelled'])
                                    ->get();
                                    
            foreach($data as $item){

                $comdata = CommercialOrder::where('id', $item->commercialorder_id)->first();
                $saledata = SalesMarketingOrder::where('id', $comdata->salemarketingorder_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'marketingperson_name' => $saledata->marketingperson_name,
                    'commercialperson_name' => $comdata->commercialperson_name,
                    'status' => $item->status,
                    'date' => $item->created_at,
                    'cancelreason' => $item->order_processing_cancelreason,
                ];
            }

            return view('admin-dashboard.orderprocessing.canceled-deals')->with(compact('dataArray'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function canceledDealViewDetail($id){
        try {

            $logData = LogisticOrder::where('id', $id)->first();
            // $logbuyer = Buyer::where('id', $logData->buyer_id)->first();
            // $logseller = Seller::where('id', $logData->seller_id)->first(); 

            $commData = CommercialOrder::where('id', $logData->commercialorder_id)->first();
            $commbuyer = Buyer::where('id', $commData->buyer_id)->first();
            $commseller = Seller::where('id', $commData->seller_id)->first();

            $data = SalesMarketingOrder::where('id', $commData->salemarketingorder_id)->first();
            $buyer = Buyer::where('id', $data->buyer_id)->first();
            $seller = Seller::where('id', $data->seller_id)->first();

            return view('admin-dashboard.orderprocessing.canceled-deals-viewdetail')->with(compact('logData','commData','commbuyer','commseller','data', 'buyer', 'seller'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    // Completed Deals Tab
    public function completedDeals(){
        try {

            $dataArray = [];
            $data = LogisticOrder::where('is_ready_for_orderprocessing', 1)->where('order_processing_cancel', 0)->where('status', 'Order Completed')->get();
            foreach($data as $item){

                $comdata = CommercialOrder::where('id', $item->commercialorder_id)->first();
                $saledata = SalesMarketingOrder::where('id', $comdata->salemarketingorder_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'marketingperson_name' => $saledata->marketingperson_name,
                    'commercialperson_name' => $comdata->commercialperson_name,
                    'status' => $item->status,
                    'date' => $item->created_at,
                ];
            }
            
            return view('admin-dashboard.orderprocessing.completed-deals')->with(compact('dataArray'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function completedDealViewDetail($id){
        try {

            $logData = LogisticOrder::where('id', $id)->first();
            // $logbuyer = Buyer::where('id', $logData->buyer_id)->first();
            // $logseller = Seller::where('id', $logData->seller_id)->first(); 

            $commData = CommercialOrder::where('id', $logData->commercialorder_id)->first();
            $commbuyer = Buyer::where('id', $commData->buyer_id)->first();
            $commseller = Seller::where('id', $commData->seller_id)->first();

            $data = SalesMarketingOrder::where('id', $commData->salemarketingorder_id)->first();
            $buyer = Buyer::where('id', $data->buyer_id)->first();
            $seller = Seller::where('id', $data->seller_id)->first();

            $orderprocess = OrderProcessingStages::where('logisticorder_id', $logData->id)->first();

            return view('admin-dashboard.orderprocessing.completed-deals-viewdetail')->with(compact('logData','commData','commbuyer','commseller','data', 'buyer', 'seller', 'orderprocess'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }
}