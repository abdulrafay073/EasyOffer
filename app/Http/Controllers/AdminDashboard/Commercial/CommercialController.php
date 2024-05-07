<?php

namespace App\Http\Controllers\AdminDashboard\Commercial;

use App\Exports\CurrentRequestExport;
use App\Exports\CurrentViewHistoryExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
use Maatwebsite\Excel\Facades\Excel;

class CommercialController extends Controller
{
    // Current-Request Tab
    public function currentRequests()
    {
        try {

            $data = BuyerMakeRequest::where('is_proceed', 0)->where('is_reject', 0)->get();

            $dataArray = [];
            foreach ($data as $item) {

                $detail = BuyerMakeRequestDetail::where('makerequest_id', $item->id)->where('sample_or_real', 0)->first();

                if ($detail != null) {

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
                        // 'proceed' => $item->is_proceed,
                        'date' => $item->created_at,
                    ];
                }
            }
            // dd($dataArray); 

            return view('admin-dashboard.commercial.current-request')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestExcelExport()
    {
        return Excel::download(new CurrentRequestExport, 'current-requests.xlsx');
    }

    public function currentViewDetail($id)
    {
        try {

            $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $id)->first();

            $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'buyer_make_request_details.id', 'buyer_make_request_details.customer_name', 'buyer_make_request_details.qty', 'buyer_make_request_details.shipping_method', 'buyer_make_request_details.payment_method', 'buyer_make_request_details.origin', 'buyer_make_request_details.required', 'buyer_make_request_details.description', 'buyer_make_request_details.certification', 'buyer_make_request_details.sample_or_real', 'buyer_make_request_details.price', 'buyer_make_request_details.timeduration')
                ->where('buyer_make_request_details.makerequest_id', $id)
                ->get();

            return view('admin-dashboard.commercial.current-viewdetail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentViewHistory($id)
    {
        try {

            $id = $id;
            $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $id)->first();

            $detail = BuyerMakeRequestDetail::where('makerequest_id', $id)->first();
            $product = BuyerListing::where('id', $detail->product_id)->first();

            $data = SalesMarketingOrder::where('productname', $product->name)->get();

            $dataArray = [];
            foreach ($data as $item) {

                $buyer = Buyer::where('id', $item->buyer_id)->first();
                $seller = Seller::where('id', $item->seller_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'buyer' => $buyer->comp_name_1,
                    'seller' => $seller->comp_name_1,
                    'name' => $item->productname,
                    'qty' => $item->qty,
                    'price' => $item->price,
                ];
            }

            $buyers = Buyer::withTrashed()->get();

            return view('admin-dashboard.commercial.current-viewhistory')->with(compact('id', 'requestid', 'dataArray', 'product', 'buyers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentViewHistorySearch($prodName, $buyerId)
    {
        try {

            $data = SalesMarketingOrder::where('productname', $prodName)->where('buyer_id', $buyerId)->get();

            $dataArray = [];
            foreach ($data as $item) {

                $buyer = Buyer::where('id', $item->buyer_id)->first();
                $seller = Seller::where('id', $item->seller_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'buyer' => $buyer->comp_name_1,
                    'seller' => $seller->comp_name_1,
                    'name' => $item->productname,
                    'qty' => $item->qty,
                    'price' => $item->price,
                ];
            }

            return response()->json(['data' => $dataArray]);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentViewHistoryExcelExport($id)
    {
        return Excel::download(new CurrentViewHistoryExport($id), 'current-view-history.xlsx');
    }

    public function currentViewHistoryDetail($id)
    {
        try {

            $data = SalesMarketingOrder::where('id', $id)->first();
            $buyer = Buyer::where('id', $data->buyer_id)->first();
            $seller = Seller::where('id', $data->seller_id)->first();

            $commData = CommercialOrder::where('salemarketingorder_id', $data->id)->first();
            $commbuyer = Buyer::where('id', $commData->buyer_id)->first();
            $commseller = Seller::where('id', $commData->seller_id)->first();

            $logData = LogisticOrder::where('commercialorder_id', $commData->id)->first();

            $orderprocess = OrderProcessingStages::where('logisticorder_id', $logData->id)->first();

            return view('admin-dashboard.commercial.current-viewhistory-detail')->with(compact('data', 'buyer', 'seller', 'commData', 'commbuyer', 'commseller', 'logData', 'orderprocess'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestsDirectQuotation($id)
    {
        try {

            $getprod = BuyerMakeRequestDetail::where('makerequest_id', $id)->first();
            $data = SellerPlacedBidDetail::where('product_id', $getprod->product_id)->get();

            $dataArray = [];
            foreach ($data as $item) {

                $bid = SellerPlacedBid::where('id', $item->placedbid_id)->first();
                $seller = Seller::where('id', $bid->seller_id)->first();
                $product = BuyerListing::where('id', $item->product_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'sellername' => $seller->comp_name_1,
                    'prod_name' => $product->name,
                    'prod_qty' => $item->qty,
                    'prod_price' => $item->price,
                    'date' => $item->created_at,
                ];
            }
            // dd($dataArray); 

            return view('admin-dashboard.commercial.current-request-direct-quotation')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestsDirectQuotationSubmit(Request $request)
    {
        try {

            $data = SellerPlacedBid::where('id', $request->placedbidid)->firstOrFail();  //update
            $data->is_proceed = 1;
            $data->admin_margin = $request->adminmargin;
            $data->updated_at = Carbon::now();
            $data->save();

            return redirect('admin/current-requests')->with('adminbidproceed', 'Bid has been proceed successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestsProceed($id)
    {
        try {

            $requestid = BuyerMakeRequest::select('id', 'buyer_request_id')->where('id', $id)->first();

            $seller = User::join('sellers', 'users.id', 'sellers.user_id')
                ->where('users.is_active', 1)->where('users.is_accept', 1)->where('is_reject', 0)
                ->select('users.id as userid', 'sellers.id', 'sellers.comp_name_1', 'sellers.comp_email_1', 'sellers.comp_contact_1', 'sellers.designation_1', 'sellers.dob_1', 'sellers.comp_name_2', 'sellers.comp_email_2', 'sellers.comp_contact_2', 'sellers.designation_2', 'sellers.dob_2', 'sellers.comp_name_3', 'sellers.comp_email_3', 'sellers.comp_contact_3', 'sellers.designation_3', 'sellers.dob_3', 'sellers.comp_office_address', 'sellers.comp_factory_address', 'sellers.comp_ownername', 'sellers.upload_certification', 'sellers.ntn', 'sellers.gst', 'sellers.comp_general_certification', 'sellers.is_tmc', 'sellers.is_active')
                ->get();

            return view('admin-dashboard.commercial.current-request-proceed')->with(compact('seller', 'requestid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestsProceedSubmit(Request $request)
    {
        try {

            if (is_array($request['sellerIds'])) {        //Batch Insert
                foreach ($request['sellerIds'] as $ids) {
                    $bmrRow[] = [
                        'buyer_make_request_id' => $request->makerequestId,
                        'seller_id' => $ids,
                    ];
                }
                BmrProceed::insert($bmrRow);
            }

            $req = BuyerMakeRequest::where('id', $request->makerequestId)->firstOrFail();  //update
            $req->is_proceed = 1;
            $req->updated_at = Carbon::now();
            $req->save();

            // Sending Order Email start
            if (is_array($request['sellerIds'])) {
                foreach ($request['sellerIds'] as $ids) {

                    $seller = Seller::where('user_id', $ids)->first();

                    $data = [
                        "name" => $seller->comp_name_1,
                    ];

                    $to_name = $seller->comp_name_1;
                    $to_email = $seller->comp_email_1;
                    Mail::send('admin-dashboard.email.request-proceed', ["email_data" => $data], function ($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)->subject("New Request");
                        $message->from("hafizabdulrafay7@gmail.com", "Admin");
                    });
                }
            }
            // Sending Order Email end

            return response()->json(['success' => 'Data submitted successfully']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestsPlacedBid($id)
    {
        try {

            $data = SellerPlacedBid::where('placedbid_against_makerequest_id', $id)->get();

            $dataArray = [];
            foreach ($data as $item) {

                $seller = Seller::where('id', $item->seller_id)->first();
                $detail = SellerPlacedBidDetail::where('placedbid_id', $item->id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'buyer_reqId' => $item->buyer_request_id,
                    'sellername' => $seller->comp_name_1,
                    'customername' => $detail->customer_name,  //buyername
                    'proceed' => $item->is_proceed,
                    'date' => $item->created_at,
                ];
            }
            // dd($dataArray); 

            return view('admin-dashboard.commercial.current-request-placebid')->with(compact('dataArray'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestsPlacedBidViewDetail($id)
    {
        try {

            $requestid = SellerPlacedBid::select('buyer_request_id')->where('id', $id)->first();

            $data = SellerPlacedBidDetail::join('buyer_listings', 'seller_placed_bid_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'seller_placed_bid_details.id', 'seller_placed_bid_details.customer_name', 'seller_placed_bid_details.qty', 'seller_placed_bid_details.shipping_method', 'seller_placed_bid_details.payment_method', 'seller_placed_bid_details.origin', 'seller_placed_bid_details.required', 'seller_placed_bid_details.description', 'seller_placed_bid_details.certification', 'seller_placed_bid_details.sample_or_real', 'seller_placed_bid_details.price', 'seller_placed_bid_details.timeduration')
                ->where('seller_placed_bid_details.placedbid_id', $id)
                ->get();

            return view('admin-dashboard.commercial.current-request-placebid-viewdetail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestsPlacedBidProceed(Request $request)
    {
        try {

            $req = SellerPlacedBid::where('id', $request->placedbidid)->firstOrFail();  //update
            $req->is_proceed = 1;
            $req->updated_at = Carbon::now();
            $req->save();

            $route = SellerPlacedBid::where('id', $request->placedbidid)->first();

            $id = (int)$route->placedbid_against_makerequest_id;
            // dd($id);
            $url = 'admin/current-requests-placebid/' . $id;
            // dd($url);

            return redirect($url)->with('bidplacedproceed', 'Bid has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function currentRequestReject(Request $request)
    {
        try {

            $req = BuyerMakeRequest::where('id', $request->requestid)->firstOrFail();  //update
            $req->is_reject = 1;
            $req->is_reject_reason = $request->note;
            $req->updated_at = Carbon::now();
            $req->save();

            return redirect('admin/current-requests')->with('currrentrequestrejected', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }


    // Sample-Request Tab
    public function sampleRequests()
    {
        try {

            $data = BuyerMakeRequest::where('is_proceed', 0)->where('is_reject', 0)->get();

            $dataArray = [];
            foreach ($data as $item) {

                $detail = BuyerMakeRequestDetail::where('makerequest_id', $item->id)->where('sample_or_real', 1)->first();

                if ($detail != null) {

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
                        'proceed' => $item->is_proceed,
                        'date' => $item->created_at,
                    ];
                }
            }
            // dd($dataArray);


            return view('admin-dashboard.commercial.sample-request')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function sampleViewDetail($id)
    {
        try {

            $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $id)->first();

            $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'buyer_make_request_details.id', 'buyer_make_request_details.customer_name', 'buyer_make_request_details.qty', 'buyer_make_request_details.shipping_method', 'buyer_make_request_details.payment_method', 'buyer_make_request_details.origin', 'buyer_make_request_details.required', 'buyer_make_request_details.description', 'buyer_make_request_details.certification', 'buyer_make_request_details.sample_or_real', 'buyer_make_request_details.price', 'buyer_make_request_details.timeduration')
                ->where('buyer_make_request_details.makerequest_id', $id)
                ->get();

            return view('admin-dashboard.commercial.sample-viewdetail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function sampleRequestsProceed($id)
    {
        try {

            $requestid = BuyerMakeRequest::select('id', 'buyer_request_id')->where('id', $id)->first();

            $seller = User::join('sellers', 'users.id', 'sellers.user_id')
                ->where('users.is_active', 1)->where('users.is_accept', 1)->where('is_reject', 0)
                ->select('users.id as userid', 'sellers.id', 'sellers.comp_name_1', 'sellers.comp_email_1', 'sellers.comp_contact_1', 'sellers.designation_1', 'sellers.dob_1', 'sellers.comp_name_2', 'sellers.comp_email_2', 'sellers.comp_contact_2', 'sellers.designation_2', 'sellers.dob_2', 'sellers.comp_name_3', 'sellers.comp_email_3', 'sellers.comp_contact_3', 'sellers.designation_3', 'sellers.dob_3', 'sellers.comp_office_address', 'sellers.comp_factory_address', 'sellers.comp_ownername', 'sellers.upload_certification', 'sellers.ntn', 'sellers.gst', 'sellers.comp_general_certification', 'sellers.is_tmc', 'sellers.is_active')
                ->get();

            return view('admin-dashboard.commercial.sample-request-proceed')->with(compact('seller', 'requestid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function sampleRequestsProceedSubmit(Request $request)
    {
        try {

            if (is_array($request['sellerIds'])) {        //Batch Insert
                foreach ($request['sellerIds'] as $ids) {
                    $bmrRow[] = [
                        'buyer_make_request_id' => $request->makerequestId,
                        'seller_id' => $ids,
                    ];
                }
                BmrProceed::insert($bmrRow);
            }

            $req = BuyerMakeRequest::where('id', $request->makerequestId)->firstOrFail();  //update
            $req->is_proceed = 1;
            $req->updated_at = Carbon::now();
            $req->save();

            return response()->json(['success' => 'Data submitted successfully']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function sampleRequestReject(Request $request)
    {
        try {

            $req = BuyerMakeRequest::where('id', $request->requestid)->firstOrFail();  //update
            $req->is_reject = 1;
            $req->is_reject_reason = $request->note;
            $req->updated_at = Carbon::now();
            $req->save();

            return redirect('admin/sample-requests')->with('samplerequestrejected', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }


    // InProcess-Request Tab
    public function inprocessRequests()
    {
        try {

            $data = BuyerMakeRequest::where('is_proceed', 1)->where('is_reject', 0)->get();

            $dataArray = [];
            foreach ($data as $item) {

                $checkadmin_margin = SellerPlacedBid::where('placedbid_against_makerequest_id', $item->id)->where('admin_margin', '!=', "")->first();
                if ($checkadmin_margin == "") {

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

            return view('admin-dashboard.commercial.inprocess-request')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function inprocessViewDetail($id)
    {
        try {

            $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $id)->first();

            $data = BuyerMakeRequestDetail::join('buyer_listings', 'buyer_make_request_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'buyer_make_request_details.id', 'buyer_make_request_details.customer_name', 'buyer_make_request_details.qty', 'buyer_make_request_details.shipping_method', 'buyer_make_request_details.payment_method', 'buyer_make_request_details.origin', 'buyer_make_request_details.required', 'buyer_make_request_details.description', 'buyer_make_request_details.certification', 'buyer_make_request_details.sample_or_real', 'buyer_make_request_details.price', 'buyer_make_request_details.timeduration')
                ->where('buyer_make_request_details.makerequest_id', $id)
                ->get();

            return view('admin-dashboard.commercial.inprocess-viewdetail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function inprocessViewBid($id)
    {
        try {

            $data = SellerPlacedBid::where('placedbid_against_makerequest_id', $id)->where('is_proceed', 0)->get();

            $dataArray = [];
            foreach ($data as $item) {

                $seller = Seller::where('id', $item->seller_id)->first();
                $detail = SellerPlacedBidDetail::where('placedbid_id', $item->id)->first();
                $reqId = BuyerMakeRequest::where('id', $item->placedbid_against_makerequest_id)->first();
                $product = BuyerListing::where('id', $detail->product_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'reqId' => $reqId->request_id,
                    'buyer_reqId' => $item->buyer_request_id,
                    'sellername' => $seller->comp_name_1,
                    'customername' => $detail->customer_name,  //buyername
                    'prod_name' => $product->name,
                    'prod_qty' => $detail->qty,
                    'prod_price' => $detail->price,
                    'date' => $item->created_at,
                ];
            }
            // dd($dataArray); 

            return view('admin-dashboard.commercial.inprocess-viewbid')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function inprocessViewBidDetail($id)
    {
        try {

            $requestid = SellerPlacedBid::select('buyer_request_id')->where('id', $id)->first();

            $data = SellerPlacedBidDetail::join('buyer_listings', 'seller_placed_bid_details.product_id', 'buyer_listings.id')
                ->select('buyer_listings.name', 'seller_placed_bid_details.id', 'seller_placed_bid_details.customer_name', 'seller_placed_bid_details.qty', 'seller_placed_bid_details.shipping_method', 'seller_placed_bid_details.payment_method', 'seller_placed_bid_details.origin', 'seller_placed_bid_details.required', 'seller_placed_bid_details.description', 'seller_placed_bid_details.certification', 'seller_placed_bid_details.sample_or_real', 'seller_placed_bid_details.price', 'seller_placed_bid_details.timeduration')
                ->where('seller_placed_bid_details.placedbid_id', $id)
                ->get();

            return view('admin-dashboard.commercial.inprocess-viewbid-detail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function inprocessViewBidProceed(Request $request)
    {
        try {

            $data = SellerPlacedBid::where('id', $request->placedbidid)->firstOrFail();  //update
            $data->is_proceed = 1;
            $data->admin_margin = $request->adminmargin;
            $data->updated_at = Carbon::now();
            $data->save();

            $route = SellerPlacedBid::where('id', $request->placedbidid)->first();

            $id = (int)$route->placedbid_against_makerequest_id;
            // dd($id);
            $url = 'admin/inprocess-viewbid/' . $id;
            // dd($url);

            // return redirect($url)->with('adminbidproceed', 'Bid has been proceed successfully !');
            return redirect('admin/inprocess-requests')->with('adminbidproceed', 'Bid has been proceed successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function inprocessViewBidDelete(Request $request)
    {
        try {

            SellerPlacedBid::destroy($request->placedbidid);  // delete

            // $route = SellerPlacedBid::where('id', $request->placedbidid)->first();

            // $id = (int)$route->placedbid_against_makerequest_id;  
            // // dd($id);
            // $url = 'admin/inprocess-viewbid/'.$id;
            // // dd($url);

            return redirect('admin/inprocess-requests')->with('adminbiddelete', 'Bid has been proceed successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function inprocessViewBidResponse($id)
    {
        try {

            $data = SellerPlacedBid::where('id', $id)->first();

            if ($data != "") {
                $is_accept = $data->is_buyer_accept;
                $is_rebid = $data->is_buyer_rebid;
                $is_rebid_note = $data->is_buyer_rebid_note;
                $is_reject = $data->is_buyer_reject;
                $is_reject_reason = $data->is_buyer_reject_reason;
            } else {
                $is_accept = "";
                $is_rebid = "";
                $is_rebid_note = "";
                $is_reject = "";
                $is_reject_reason = "";
            }

            return response()->json(['bidaccept' => $is_accept, 'bidrebid' => $is_rebid, 'bidrebidnote' => $is_rebid_note, 'bidreject' => $is_reject, 'bidrejectreason' => $is_reject_reason]);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function inprocessViewBidSendResponse(Request $request)
    {
        try {

            $data = SellerPlacedBid::where('id', $request->placedbidid)->firstOrFail();  //update
            $data->is_send_response = 1;
            $data->is_send_response_note = $request->note;
            $data->updated_at = Carbon::now();
            $data->save();

            $route = SellerPlacedBid::where('id', $request->placedbidid)->first();

            $id = (int)$route->placedbid_against_makerequest_id;
            // dd($id);
            $url = 'admin/inprocess-viewbid/' . $id;
            // dd($url);

            return redirect($url)->with('adminbidsendresponse', 'Response has been send successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }


    // Rejected-Request Tab
    public function rejectedRequests()
    {
        try {

            $data = BuyerMakeRequest::where('is_reject', 1)->get();

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

            return view('admin-dashboard.commercial.rejected-request')->with(compact('dataArray'));
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

            return view('admin-dashboard.commercial.rejected-viewdetail')->with(compact('data', 'requestid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Quotation Tab
    public function getQuotations()
    {
        try {

            $data = BuyerMakeRequest::where('is_proceed', 1)->where('is_reject', 0)->get()->unique('request_id');
            // dd($data);
            $dataArray = [];
            foreach ($data as $item) {

                $customer = Buyer::where('id', $item->buyer_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'reqId' => $item->request_id,
                    'customername' => $customer->comp_name_1,
                    'date' => $item->created_at,
                ];
            }
            // dd($dataArray); 

            return view('admin-dashboard.commercial.quotation')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function quotationViewDetail($id)
    {
        try {

            $getreqid = BuyerMakeRequest::where('id', $id)->first();
            $getids = BuyerMakeRequest::where('request_id', $getreqid->request_id)->get();
            // dd($getids);

            $dataArray = [];
            foreach ($getids as $item) {

                $data = SellerPlacedBid::where('placedbid_against_makerequest_id', $item->id)->where('is_proceed', 1)->where('admin_margin', '!=', "")->where('admin_forward_quot_to_buyer', 0)->first();

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
                        'date' => $item->created_at,
                    ];
                }
            }
            // dd($dataArray);

            return view('admin-dashboard.commercial.quotation-viewdetail')->with(compact('dataArray', 'getreqid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function quotationsForwardToBuyer(Request $request)
    {
        try {

            if (is_array($request['quotIds'])) {        //Batch Insert
                foreach ($request['quotIds'] as $ids) {

                    $quot = SellerPlacedBid::where('id', $ids)->firstOrFail();  //update
                    $quot->admin_forward_quot_to_buyer = 1;
                    $quot->updated_at = Carbon::now();
                    $quot->save();
                }
            }

            return response()->json(['success' => 'Data submitted successfully']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Quotation Response Tab
    public function getQuotationResponse()
    {
        try {

            $data = BuyerMakeRequest::where('is_proceed', 1)->where('is_reject', 0)->get()->unique('request_id');
            // dd($data);
            $dataArray = [];
            foreach ($data as $item) {

                $customer = Buyer::where('id', $item->buyer_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'reqId' => $item->request_id,
                    'customername' => $customer->comp_name_1,
                    'date' => $item->created_at,
                ];
            }
            // dd($dataArray); 

            return view('admin-dashboard.commercial.quotation-response')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function quotationResponseViewDetail($id)
    {
        try {

            $getreqid = BuyerMakeRequest::where('id', $id)->first();
            $getids = BuyerMakeRequest::where('request_id', $getreqid->request_id)->get();
            // dd($getids);

            $dataArray = [];
            foreach ($getids as $item) {

                $data = SellerPlacedBid::where('placedbid_against_makerequest_id', $item->id)->where('is_proceed', 1)->where('admin_margin', '!=', "")->where('admin_forward_quot_to_buyer', 1)->where('is_buyer_accept', 1)->Orwhere('is_buyer_rebid', 1)->Orwhere('is_buyer_rebid', 1)->first();

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
                        'date' => $item->created_at,
                        'is_buyer_accept' => $data->is_buyer_accept,
                        'is_buyer_rebid' => $data->is_buyer_rebid,
                        'is_buyer_reject' => $data->is_buyer_reject,
                    ];
                }
            }
            // dd($dataArray);

            return view('admin-dashboard.commercial.quotation-response-viewdetail')->with(compact('dataArray', 'getreqid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Order-Confirmation Tab
    public function index()
    {
        try {
            $data = SalesMarketingOrder::where('is_commercial_orderform_filled', 0)->where('is_active', 1)->get();

            return view('admin-dashboard.commercial.order-confirmation')->with(compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function orderViewDetail($id)
    {
        try {

            $data = SalesMarketingOrder::where('id', $id)->first();

            $buyer = Buyer::where('id', $data->buyer_id)->first();
            $seller = Seller::where('id', $data->seller_id)->first();

            $buyerlist = Buyer::where('is_active', 1)->get();
            $sellerlist = Seller::where('is_active', 1)->get();

            return view('admin-dashboard.commercial.order-viewdetail')->with(compact('data', 'buyer', 'seller', 'buyerlist', 'sellerlist'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function orderConfirmationSubmit(Request $request)
    {
        try {

            // dd($request->all());

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

            $data = CommercialOrder::create(
                [
                    'salemarketingorder_id' => $request->salesmarketingorderid,
                    'commercialperson_name' => $request->cpname,
                    'buyer_id' => $request->customername,
                    'seller_id' => $request->suppliername,
                    'productname' => $request->pname,
                    'price' => $request->price,
                    'qty' => $request->qty,
                    'shipmentmode' => $request->shipmentmode,
                    'paymentterm' => $request->paymentterm,
                    'origin' => $request->origin,
                    'materialavailability' => $request->materialavailability,
                    'mfgname' => $request->mfgname,
                    'commissiondecided' => $request->commission,
                    'supplierinstructions' => $request->supplierinstruction,
                    'indentcustomer' => $request->indentcustomer,
                    'tosupplier' => $request->tosupplier,
                    'created_by' => 1,
                    'updated_by' => 1,
                ]
            );

            $order = SalesMarketingOrder::where('id', $request->salesmarketingorderid)->firstOrFail();  //update
            $order->is_commercial_orderform_filled = 1;
            $order->updated_at = Carbon::now();
            $order->save();

            return redirect('admin/order-confirmation-list')->with('commercialorder', 'Order has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
