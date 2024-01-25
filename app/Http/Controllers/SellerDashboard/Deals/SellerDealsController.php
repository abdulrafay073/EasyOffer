<?php

namespace App\Http\Controllers\SellerDashboard\Deals;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Seller;
use App\Models\Buyer;
use App\Models\BuyerListing;

use App\Models\BuyerMakeRequest;
use App\Models\BuyerMakeRequestDetail;

use App\Models\BmrProceed;

use App\Models\SellerPlacedBid;
use App\Models\SellerPlacedBidDetail;

use App\Models\SalesMarketingOrder;
use App\Models\CommercialOrder;
use App\Models\LogisticOrder;

use App\Models\OrderProcessingStages;

class SellerDealsController extends Controller
{
    // Current Deal Tab
    public function currentDeals(){
        try {

            $user = Auth::user();
            $seller = Seller::where('user_id', $user->id)->first();

            $dataArray = [];
            $data = LogisticOrder::where('supplier_contactperson', $seller->comp_name_1)->where('order_processing_cancel', 0)->get();
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

            return view('seller-dashboard.deals.current-deals')->with(compact('dataArray'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function currentDealViewDetail($id){
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

            return view('seller-dashboard.deals.current-deals-viewdetail')->with(compact('logData','commData','commbuyer','commseller','data', 'buyer', 'seller', 'orderprocess'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function purchaseConfirm(Request $request){
        try {

            $data = OrderProcessingStages::create(
                [
                    'logisticorder_id' => $request->logistic_id,
                    'is_purchase_confirm' => 1, 
                    // 'created_by' => $user->id,
                    // 'updated_by' => $user->id,
                ]
            );
        
            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Purchase Deal Confirmed";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;  
            // dd($id);
            $url = 'seller/current-deal-viewdetail/'.$id;
            // dd($url);
            
            return redirect($url)->with('sellerpurchaseconfirm', 'Purchase has been confirmed successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function purchaseCancel(Request $request){
        try {

            $data = OrderProcessingStages::create(
                [
                    'logisticorder_id' => $request->logistic_id,
                    'is_purchase_cancel' => 1, 
                    // 'created_by' => $user->id,
                    // 'updated_by' => $user->id,
                ]
            );
        
            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Purchase Deal Cancelled";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;  
            // dd($id);
            $url = 'seller/current-deal-viewdetail/'.$id;
            // dd($url);
            
            return redirect($url)->with('sellerpurchasecancel', 'Purchase has been cancelled successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function shipmentDocs(Request $request){
        try {

            if(isset($request->invfile)){
                $invfile = $request->invfile->store('public/ShipmentDocument');
                $invfile = '/storage' . substr($invfile,6);    
            }
            else{
                $invfile = "";
            }

            if(isset($request->packingfile)){
                $pckfile = $request->packingfile->store('public/ShipmentDocument');
                $pckfile = '/storage' . substr($pckfile,6);    
            }
            else{
                $pckfile = "";
            }

            if(isset($request->coafile)){
                $coafile = $request->coafile->store('public/ShipmentDocument');
                $coafile = '/storage' . substr($coafile,6);    
            }
            else{
                $coafile = "";
            }

            if(isset($request->blfile)){
                $blfile = $request->blfile->store('public/ShipmentDocument');
                $blfile = '/storage' . substr($blfile,6);    
            }
            else{
                $blfile = "";
            }

            if(isset($request->awbfile)){
                $awbfile = $request->awbfile->store('public/ShipmentDocument');
                $awbfile = '/storage' . substr($awbfile,6);    
            }
            else{
                $awbfile = "";
            }

            if(isset($request->ftafile)){
                $ftafile = $request->ftafile->store('public/ShipmentDocument');
                $ftafile = '/storage' . substr($ftafile,6);    
            }
            else{
                $ftafile = "";
            }

            if(isset($request->gmpfile)){
                $gmpfile = $request->gmpfile->store('public/ShipmentDocument');
                $gmpfile = '/storage' . substr($gmpfile,6);    
            }
            else{
                $gmpfile = "";
            }

            if(isset($request->formthreefile)){
                $form3file = $request->formthreefile->store('public/ShipmentDocument');
                $form3file = '/storage' . substr($form3file,6);    
            }
            else{
                $form3file = "";
            }

            if(isset($request->formsevenfile)){
                $form7file = $request->formsevenfile->store('public/ShipmentDocument');
                $form7file = '/storage' . substr($form7file,6);    
            }
            else{
                $form7file = "";
            }

            $data = OrderProcessingStages::where('logisticorder_id', $request->logistic_id)->firstOrFail();  //update
            $data->ship_invoice_file = $invfile;
            $data->ship_packing_file = $pckfile;
            $data->ship_coa_file = $coafile;
            $data->ship_bl_file = $blfile;
            $data->ship_awb_file = $awbfile;
            $data->ship_fta_file = $ftafile;
            $data->ship_gmp_file = $gmpfile;
            $data->ship_form3_file = $form3file;
            $data->ship_form7_file = $form7file;
            $data->ship_trackingid = $request->trackingid;
            $data->ship_materialtrackingid = $request->materialtrackingid;
            $data->updated_at = Carbon::now();
            $data->save();
        
            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Shipment Docs Completed";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;  
            // dd($id);
            $url = 'seller/current-deal-viewdetail/'.$id;
            // dd($url);
            
            return redirect($url)->with('shipmentdocs', 'Shipment Docs has been done successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Current-Request Tab
    public function currentRequests(){
        try {

            $user = Auth::user();

            $dataArray = [];
            $getReqIds = BmrProceed::where('seller_id', $user->id)->where('is_placedbid_by_seller', 0)->where('is_reject_by_seller', 0)->get();
            foreach($getReqIds as $items){
            
                $data = BuyerMakeRequest::where('id', $items->buyer_make_request_id)->where('is_proceed', 1)->where('is_reject', 0)->get();
                foreach($data as $item){

                    $customer = Buyer::where('id', $item->buyer_id)->first();
                    $detail = BuyerMakeRequestDetail::where('makerequest_id', $item->id)->first();
                    $product = BuyerListing::where('id', $detail->product_id)->first();

                    $dataArray[] = [
                        'id' => $item->id,
                        'reqId' => $item->request_id,
                        'buyer_reqId' => $item->buyer_request_id,
                        'customername' => $customer->comp_name_1,
                        'prod_name' => $product->name,
                        'prod_qty' => $detail->qty,
                        'date' => $item->created_at,
                    ];
                }
            }
            // dd($dataArray);
            
            return view('seller-dashboard.deals.current-requests')->with(compact('dataArray'));
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function currentViewDetail($id){
        try {

            $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $id)->first();
            
            $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
                        ->select('buyer_listings.name','buyer_make_request_details.id','buyer_make_request_details.customer_name','buyer_make_request_details.qty','buyer_make_request_details.shipping_method','buyer_make_request_details.payment_method','buyer_make_request_details.origin','buyer_make_request_details.required','buyer_make_request_details.description','buyer_make_request_details.certification','buyer_make_request_details.sample_or_real','buyer_make_request_details.price','buyer_make_request_details.timeduration')                                
                        ->where('buyer_make_request_details.makerequest_id', $id)
                        ->get();

            return view('seller-dashboard.deals.current-viewdetail')->with(compact('data', 'requestid'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    //create
    public function currentPlacedBid($id){
        try {

            $requestid = BuyerMakeRequest::select('id','buyer_request_id','buyer_id')->where('id', $id)->first();
            
            $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
                        ->select('buyer_listings.name','buyer_make_request_details.id','buyer_make_request_details.customer_name','buyer_make_request_details.qty','buyer_make_request_details.shipping_method','buyer_make_request_details.payment_method','buyer_make_request_details.origin','buyer_make_request_details.required','buyer_make_request_details.description','buyer_make_request_details.certification','buyer_make_request_details.sample_or_real','buyer_make_request_details.price','buyer_make_request_details.timeduration')                                
                        ->where('buyer_make_request_details.makerequest_id', $id)
                        ->get();

                        // dd($data);

            $getBuyer = Buyer::select('user_id')->where('id', $requestid->buyer_id)->first();
            // $buyerProducts = BuyerListing::where('is_active', 1)->where('user_id', $getBuyer->user_id)->get();
            $buyerProducts = BuyerListing::where('is_active', 1)->get();

            return view('seller-dashboard.deals.current-placedbid')->with(compact('requestid','data','buyerProducts'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function currentRequestSubmit(Request $request){
        try {

            $user = Auth::user();
            
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
        

            $seller = Seller::where('user_id', $user->id)->firstOrFail();
            // dd($seller);

            $req = BmrProceed::where('buyer_make_request_id', $request->requestid)->where('seller_id', $seller->user_id)->firstOrFail();  //update
            $req->is_placedbid_by_seller = 1;
            $req->updated_at = Carbon::now();
            $req->save();

            $data = SellerPlacedBid::create(
                [
                    'seller_id' => $seller->id,
                    'placedbid_against_makerequest_id' => $request->requestid,   
                    'buyer_request_id' => $request->autorequestid,   
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ]
            );

            // Multiple Add Row / Remove Row - Batch Insert
            for ($i = 0; $i < count($request->customername) ; $i++) {

                if(isset($request->sampleorreal[$i])){
                    $samplereal = 1;
                }
                else{
                    $samplereal = 0;
                }

                $requestItems[] = [
                    'placedbid_id' => $data->id,
                    'customer_name' => $request->customername[$i],
                    'product_id' => $request->product[$i],
                    'qty' => $request->qty[$i],
                    'shipping_method' => $request->shipping[$i] ?? '',
                    'payment_method' => $request->payment[$i] ?? '',
                    'origin' => $request->origin[$i] ?? '',
                    'required' => $request->required[$i] ?? '',
                    'description' => $request->description[$i] ?? '',
                    'certification' => $request->certification[$i] ?? '',
                    'sample_or_real' => $samplereal,
                    'price' => $request->price[$i],
                    'timeduration' => $request->timeduration[$i] ?? '',
                ];
            }

            if (is_array($requestItems)) {
                // dd($requestItems);
                SellerPlacedBidDetail::insert($requestItems);
            }
            
            return redirect('seller/current-requests')->with('placedbid', 'Bid has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestReject(Request $request){
        try {

            $user = Auth::user();
        
            $req = BmrProceed::where('seller_id', $user->id)->where('buyer_make_request_id', $request->requestid)->firstOrFail();  //update
            $req->is_reject_by_seller = 1;
            $req->is_reject_by_seller_reason = $request->note;
            $req->updated_at = Carbon::now();
            $req->save();
            
            return redirect('seller/current-requests')->with('currrentrequestrejected_byseller', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}