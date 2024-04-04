<?php

namespace App\Http\Controllers\BuyerDashboard\Deals;

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

class BuyerDealsController extends Controller
{
    // Current Deal Tab
    public function currentDeals()
    {
        try {

            $user = Auth::user();
            $buyer = Buyer::where('user_id', $user->id)->first();

            $dataArray = [];
            $data = LogisticOrder::where('customer_contactperson', $buyer->comp_name_1)->where('order_processing_cancel', 0)->get();
            foreach ($data as $item) {

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

            return view('buyer-dashboard.deals.current-deals')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentDealViewDetail($id)
    {
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

            return view('buyer-dashboard.deals.current-deals-viewdetail')->with(compact('logData', 'commData', 'commbuyer', 'commseller', 'data', 'buyer', 'seller', 'orderprocess'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleConfirm(Request $request)
    {
        try {

            $data = OrderProcessingStages::where('logisticorder_id', $request->logistic_id)->firstOrFail();  //update
            $data->is_sale_confirm = 1;
            $data->updated_at = Carbon::now();
            $data->save();

            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Sale Deal Confirmed";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;
            // dd($id);
            $url = 'buyer/current-deal-viewdetail/' . $id;
            // dd($url);

            return redirect($url)->with('buyersaleconfirm', 'Sale has been confirmed successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleCancel(Request $request)
    {
        try {

            $data = OrderProcessingStages::where('logisticorder_id', $request->logistic_id)->firstOrFail();  //update
            $data->is_sale_cancel = 1;
            $data->updated_at = Carbon::now();
            $data->save();

            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Sale Deal Cancelled";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;
            // dd($id);
            $url = 'buyer/current-deal-viewdetail/' . $id;
            // dd($url);

            return redirect($url)->with('buyersalecancel', 'Sale has been cancelled successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function lcIssue(Request $request)
    {
        try {

            if (isset($request->lcdoc)) {
                $lcfile = $request->lcdoc->store('public/LCDocument');
                $lcfile = '/storage' . substr($lcfile, 6);
            } else {
                $lcfile = "";
            }

            $data = OrderProcessingStages::where('logisticorder_id', $request->logistic_id)->firstOrFail();  //update
            $data->lc_issue_file = $lcfile;
            $data->lc_issue_note = $request->note;
            $data->updated_at = Carbon::now();
            $data->save();

            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "LC Issued";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;
            // dd($id);
            $url = 'buyer/current-deal-viewdetail/' . $id;
            // dd($url);

            return redirect($url)->with('lcissue', 'Lc has been issued successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function paymentIssue(Request $request)
    {
        try {

            if (isset($request->payreceipt)) {
                $payfile = $request->payreceipt->store('public/PaymentIssueDocument');
                $payfile = '/storage' . substr($payfile, 6);
            } else {
                $payfile = "";
            }

            $data = OrderProcessingStages::where('logisticorder_id', $request->logistic_id)->firstOrFail();  //update
            $data->payment_issue_file = $payfile;
            $data->payment_issue_note = $request->note;
            $data->updated_at = Carbon::now();
            $data->save();

            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Payment Issued";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;
            // dd($id);
            $url = 'buyer/current-deal-viewdetail/' . $id;
            // dd($url);

            return redirect($url)->with('paymentissue', 'Payment Receipt has been issued successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function materialConfirmation(Request $request)
    {
        try {

            $data = OrderProcessingStages::where('logisticorder_id', $request->logistic_id)->firstOrFail();  //update
            $data->material_confirm = 1;
            $data->updated_at = Carbon::now();
            $data->save();

            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Material Received";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;
            // dd($id);
            $url = 'buyer/current-deal-viewdetail/' . $id;
            // dd($url);

            return redirect($url)->with('materialreceived', 'Material has been received successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function marginReceived(Request $request)
    {
        try {

            if (isset($request->marginreceived)) {
                $marginfile = $request->marginreceived->store('public/MarginReceivedDocument');
                $marginfile = '/storage' . substr($marginfile, 6);
            } else {
                $marginfile = "";
            }

            $data = OrderProcessingStages::where('logisticorder_id', $request->logistic_id)->firstOrFail();  //update
            $data->margin_received_file = $marginfile;
            $data->updated_at = Carbon::now();
            $data->save();

            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Margin Received";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;
            // dd($id);
            $url = 'buyer/current-deal-viewdetail/' . $id;
            // dd($url);

            return redirect($url)->with('marginreceived', 'Margin has been received successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function feedback(Request $request)
    {
        try {

            $data = OrderProcessingStages::where('logisticorder_id', $request->logistic_id)->firstOrFail();  //update
            $data->feedback_note = $request->note;
            $data->updated_at = Carbon::now();
            $data->save();

            $log = LogisticOrder::where('id', $request->logistic_id)->firstOrFail();  //update
            $log->status = "Order Completed";
            $log->updated_at = Carbon::now();
            $log->save();

            $id = (int)$request->logistic_id;
            // dd($id);
            $url = 'buyer/current-deal-viewdetail/' . $id;
            // dd($url);

            return redirect($url)->with('feedback', 'Feedback has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Current Request Tab
    public function currentRequests()
    {
        try {
            $user = Auth::user();
            $buyer = Buyer::where('user_id', $user->id)->first();

            $data = BuyerMakeRequest::where('is_proceed', 1)->where('is_reject', 0)->where('buyer_id', $buyer->id)->get()->unique('request_id');

            $dataArray = [];
            foreach ($data as $item) {

                $customer = Buyer::where('id', $item->buyer_id)->first();
                $detail = BuyerMakeRequestDetail::where('makerequest_id', $item->id)->first();
                $product = BuyerListing::where('id', $detail->product_id)->first();

                // $check_bid_status = SellerPlacedBid::where('placedbid_against_makerequest_id', $item->id)->where('is_buyer_accept', 0)->where('is_buyer_rebid', 0)->where('is_buyer_reject', 0)->first();
                // if($check_bid_status != null){

                $dataArray[] = [
                    'id' => $item->id,
                    'reqId' => $item->request_id,
                    'customername' => $customer->comp_name_1,
                    'date' => $item->created_at,
                ];
                // }
            }
            // dd($dataArray);

            return view('buyer-dashboard.deals.current-requests')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentViewDetail($id)
    {
        try {

            // old one separate product detail
            // $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $id)->first();

            // $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
            //             ->select('buyer_listings.name','buyer_make_request_details.id','buyer_make_request_details.customer_name','buyer_make_request_details.qty','buyer_make_request_details.shipping_method','buyer_make_request_details.payment_method','buyer_make_request_details.origin','buyer_make_request_details.required','buyer_make_request_details.description','buyer_make_request_details.certification','buyer_make_request_details.sample_or_real','buyer_make_request_details.price','buyer_make_request_details.timeduration')                                
            //             ->where('buyer_make_request_details.makerequest_id', $id)
            //             ->get();


            //new one with all product detail
            $getreqid = BuyerMakeRequest::where('id', $id)->first();
            $getids = BuyerMakeRequest::where('request_id', $getreqid->request_id)->get();
            // dd($getids);

            $dataArray = [];
            foreach ($getids as $item) {

                $detail = BuyerMakeRequestDetail::where('makerequest_id', $item->id)->first();
                $product = BuyerListing::where('id', $detail->product_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'buyer_reqId' => $item->buyer_request_id,
                    'customer_name' => $product->customer_name,
                    'name' => $product->name,
                    'description' => $detail->description,
                    'qty' => $detail->qty,
                    'shipping_method' => $detail->shipping_method,
                    'payment_method' => $detail->payment_method,
                    'required' => $detail->required,
                    'certification' => $detail->certification,
                    'sample_or_real' => $detail->sample_or_real,
                    'price' => $detail->price,
                    'timeduration' => $detail->timeduration,
                    'origin' => $detail->origin,
                ];
            }
            // dd($dataArray);

            // return view('buyer-dashboard.deals.current-viewdetail')->with(compact('data', 'requestid'));
            return view('buyer-dashboard.deals.current-viewdetail')->with(compact('dataArray', 'getreqid'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentViewBid($id)
    {
        try {
            // old one separate quotation
            // $data = SellerPlacedBid::where('placedbid_against_makerequest_id', $id)->where('is_buyer_accept', 0)->where('is_buyer_rebid', 0)->where('is_buyer_reject', 0)->get();

            // $dataArray = [];
            // foreach($data as $item){

            //     $seller = Seller::where('id', $item->seller_id)->first();
            //     $detail = SellerPlacedBidDetail::where('placedbid_id', $item->id)->first();   
            //     $reqId = BuyerMakeRequest::where('id', $item->placedbid_against_makerequest_id)->first();
            //     $product = BuyerListing::where('id', $detail->product_id)->first();

            //     $dataArray[] = [
            //         'id' => $item->id,
            //         'reqId' => $reqId->request_id,
            //         'buyer_reqId' => $item->buyer_request_id,
            //         'sellername' => $seller->comp_name_1,
            //         'customername' => $detail->customer_name,  //buyername
            //         'prod_name' => $product->name,
            //         'prod_qty' => $detail->qty,
            //         'prod_price' => $detail->price,
            //         'proceed' => $item->is_proceed,
            //         'date' => $item->created_at,
            //     ];
            // }     
            // // dd($dataArray); 


            //new one with quotation form
            $getreqid = BuyerMakeRequest::where('id', $id)->first();
            $getids = BuyerMakeRequest::where('request_id', $getreqid->request_id)->get();
            // dd($getids);

            $dataArray = [];
            foreach ($getids as $item) {

                $data = SellerPlacedBid::where('placedbid_against_makerequest_id', $item->id)->where('is_proceed', 1)->where('admin_margin', '!=', "")->where('admin_forward_quot_to_buyer', 1)->first();

                if ($data != "") {

                    $seller = Seller::where('id', $data->seller_id)->first();
                    $detail = SellerPlacedBidDetail::where('placedbid_id', $item->id)->first();
                    $product = BuyerListing::where('id', $detail->product_id)->first();

                    $dataArray[] = [
                        'id' => $data->id,
                        'buyer_reqId' => $data->buyer_request_id,
                        'sellername' => $seller->comp_name_1,
                        'customername' => $detail->customer_name,  //buyername
                        'prod_name' => $product->name,
                        'prod_qty' => $detail->qty,
                        'prod_price' => $detail->price,
                        'admin_margin' => $data->admin_margin,
                        'buyer_accept' => $data->is_buyer_accept,
                        'buyer_rebid' => $data->is_buyer_rebid,
                        'buyer_reject' => $data->is_buyer_reject,
                        'date' => $item->created_at,
                    ];
                }
            }
            // dd($dataArray);

            return view('buyer-dashboard.deals.current-viewbid')->with(compact('dataArray', 'getreqid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentViewBidDetail($id)
    {
        try {

            $requestid = SellerPlacedBid::select('buyer_request_id')->where('id', $id)->first();

            $data = SellerPlacedBidDetail::join('buyer_listings', 'seller_placed_bid_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'seller_placed_bid_details.id', 'seller_placed_bid_details.customer_name', 'seller_placed_bid_details.qty', 'seller_placed_bid_details.shipping_method', 'seller_placed_bid_details.payment_method', 'seller_placed_bid_details.origin', 'seller_placed_bid_details.required', 'seller_placed_bid_details.description', 'seller_placed_bid_details.certification', 'seller_placed_bid_details.sample_or_real', 'seller_placed_bid_details.price', 'seller_placed_bid_details.timeduration')
                ->where('seller_placed_bid_details.placedbid_id', $id)
                ->get();

            return view('buyer-dashboard.deals.current-viewbid-detail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentBidAccept(Request $request)
    {
        try {

            $bid = SellerPlacedBid::where('id', $request->placedbidid)->firstOrFail();  //update
            $bid->is_buyer_accept = 1;
            $bid->updated_at = Carbon::now();
            $bid->save();

            $route = SellerPlacedBid::where('id', $request->placedbidid)->first();

            $id = (int)$route->placedbid_against_makerequest_id;
            // dd($id);
            $url = 'buyer/current-viewbids/' . $id;
            // dd($url);

            return redirect($url)->with('buyerbidaccept', 'Bid has been Accepted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentBidReBid(Request $request)
    {
        try {

            $bid = SellerPlacedBid::where('id', $request->placedbidid)->firstOrFail();  //update
            $bid->is_buyer_rebid = 1;
            $bid->is_buyer_rebid_note = $request->note;
            $bid->updated_at = Carbon::now();
            $bid->save();

            $route = SellerPlacedBid::where('id', $request->placedbidid)->first();

            $id = (int)$route->placedbid_against_makerequest_id;
            // dd($id);
            $url = 'buyer/current-viewbids/' . $id;
            // dd($url);

            return redirect($url)->with('buyerrebidsubmit', 'Re-Bid has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentBidReject(Request $request)
    {
        try {

            $bid = SellerPlacedBid::where('id', $request->placedbidid)->firstOrFail();  //update
            $bid->is_buyer_reject = 1;
            $bid->is_buyer_reject_reason = $request->note;
            $bid->updated_at = Carbon::now();
            $bid->save();

            $route = SellerPlacedBid::where('id', $request->placedbidid)->first();

            $id = (int)$route->placedbid_against_makerequest_id;
            // dd($id);
            $url = 'buyer/current-viewbids/' . $id;
            // dd($url);

            return redirect($url)->with('buyerbidreject', 'Bid has been Rejected successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Pending Request Tab
    public function pendingRequests()
    {
        try {
            $user = Auth::user();
            $buyer = Buyer::where('user_id', $user->id)->first();

            $data = BuyerMakeRequest::where('is_proceed', 0)->where('is_reject', 0)->where('buyer_id', $buyer->id)->get();

            $dataArray = [];
            foreach ($data as $item) {

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
                    'reason' => $item->is_reject_reason,
                    'date' => $item->created_at,
                ];
            }
            // dd($dataArray);

            return view('buyer-dashboard.deals.pending-requests')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function pendingViewDetail($id)
    {
        try {

            $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $id)->first();

            $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'buyer_make_request_details.id', 'buyer_make_request_details.customer_name', 'buyer_make_request_details.qty', 'buyer_make_request_details.shipping_method', 'buyer_make_request_details.payment_method', 'buyer_make_request_details.origin', 'buyer_make_request_details.required', 'buyer_make_request_details.description', 'buyer_make_request_details.certification', 'buyer_make_request_details.sample_or_real', 'buyer_make_request_details.price', 'buyer_make_request_details.timeduration')
                ->where('buyer_make_request_details.makerequest_id', $id)
                ->get();

            return view('buyer-dashboard.deals.pending-viewdetail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function deleteMakeRequest(Request $request)
    {
        try {

            BuyerMakeRequest::destroy($request->makerequestid);

            return redirect('buyer/pending-requests')->with('buyerdeleterequest', 'Request has been deleted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Rejected Request Tab
    public function rejectedRequests()
    {
        try {
            $user = Auth::user();
            $buyer = Buyer::where('user_id', $user->id)->first();

            $data = BuyerMakeRequest::where('is_reject', 1)->where('buyer_id', $buyer->id)->get();

            $dataArray = [];
            foreach ($data as $item) {

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
                    'reason' => $item->is_reject_reason,
                    'date' => $item->created_at,
                ];
            }
            // dd($dataArray);

            return view('buyer-dashboard.deals.rejected-requests')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function rejectedViewDetail($id)
    {
        try {

            $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $id)->first();

            $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'buyer_make_request_details.id', 'buyer_make_request_details.customer_name', 'buyer_make_request_details.qty', 'buyer_make_request_details.shipping_method', 'buyer_make_request_details.payment_method', 'buyer_make_request_details.origin', 'buyer_make_request_details.required', 'buyer_make_request_details.description', 'buyer_make_request_details.certification', 'buyer_make_request_details.sample_or_real', 'buyer_make_request_details.price', 'buyer_make_request_details.timeduration')
                ->where('buyer_make_request_details.makerequest_id', $id)
                ->get();

            return view('buyer-dashboard.deals.rejected-viewdetail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function rejectedReRequest($id)
    {
        try {

            $requestid = BuyerMakeRequest::select('id', 'buyer_request_id', 'buyer_id')->where('id', $id)->first();

            $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'buyer_make_request_details.id', 'buyer_make_request_details.customer_name', 'buyer_make_request_details.qty', 'buyer_make_request_details.shipping_method', 'buyer_make_request_details.payment_method', 'buyer_make_request_details.origin', 'buyer_make_request_details.required', 'buyer_make_request_details.description', 'buyer_make_request_details.certification', 'buyer_make_request_details.sample_or_real', 'buyer_make_request_details.price', 'buyer_make_request_details.timeduration')
                ->where('buyer_make_request_details.makerequest_id', $id)
                ->get();

            // dd($data);

            $getBuyer = Buyer::select('user_id')->where('id', $requestid->buyer_id)->first();
            $buyerProducts = BuyerListing::where('is_active', 1)->where('user_id', $getBuyer->user_id)->get();

            return view('buyer-dashboard.deals.rejected-re-request')->with(compact('requestid', 'data', 'buyerProducts'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function rejectedReRequestSubmit(Request $request)
    {
        try {

            $user = Auth::user();

            // *validation
            $validator = Validator::make($request->all(), [
                // 'customer_name' => 'required',   
            ]);
            if ($validator->fails()) {
                return response()->json(
                    [
                        'error' => $validator->errors(),
                        'message' => $validator->errors()->first()
                    ],
                    $this->badRequest
                );
            }

            $data = BuyerMakeRequest::where('id', $request->requestid)->firstOrFail();  //update
            $data->is_reject = 0;
            $data->is_reject_reason = Null;
            $data->updated_at = Carbon::now();
            $data->save();

            // first rows delete and resubmit
            $rows = BuyerMakeRequestDetail::where('makerequest_id', $request->requestid)->forceDelete();

            // Multiple Add Row / Remove Row - Batch Insert
            for ($i = 0; $i < count($request->customername); $i++) {

                if (isset($request->sampleorreal[$i])) {
                    $samplereal = 1;
                } else {
                    $samplereal = 0;
                }

                $requestItems[] = [
                    'makerequest_id' => $data->id,
                    'customer_name' => $request->customername[$i],
                    'product_id' => $request->product[$i],
                    'qty' => $request->qty[$i],
                    'shipping_method' => $request->shipping[$i],
                    'payment_method' => $request->payment[$i],
                    'origin' => $request->origin[$i],
                    'required' => $request->required[$i],
                    'description' => $request->description[$i],
                    'certification' => $request->certification[$i],
                    'sample_or_real' => $samplereal,
                    // 'price' => $request->price[$i],
                    // 'timeduration' => $request->timeduration[$i],
                    'price' => "",
                    'timeduration' => "",
                ];
            }

            if (is_array($requestItems)) {
                // dd($requestItems);
                BuyerMakeRequestDetail::insert($requestItems);
            }

            return redirect('buyer/rejected-requests')->with('buyerrequestsubmit', 'Re-Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
