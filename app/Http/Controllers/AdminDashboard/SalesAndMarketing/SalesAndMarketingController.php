<?php

namespace App\Http\Controllers\AdminDashboard\SalesAndMarketing;

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

use App\Models\SellerPlacedBid;
use App\Models\SellerPlacedBidDetail;


use App\Models\SalesMarketingOrder;

class SalesAndMarketingController extends Controller
{
    public function saleBuyers()
    {
        try {
            return view('admin-dashboard.salesandmarketing.buyers');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Make Request Tab
    public function saleMakeRequest()
    {
        try {

            $data = BuyerListing::where('is_active', 1)->get();

            $buyers = Buyer::all();

            return view('admin-dashboard.salesandmarketing.make-request')->with(compact('data', 'buyers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleMakeRequestSubmit(Request $request)
    {
        try {

            // $user = Auth::user();

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

            // this is request id
            $CommonId = BuyerMakeRequest::orderBy('request_id', 'DESC')->first();
            if ($CommonId == null) {
                $newCommonId = "90001";  //Initialize the series
            } else {

                $oldno = (int)$CommonId->request_id;
                $newCommonId = $oldno + 1;
            }

            // dd(count($request->customername));
            for ($i = 0; $i < count($request->customername); $i++) {

                // this is product request id
                $ReqId = BuyerMakeRequest::orderBy('buyer_request_id', 'DESC')->first();
                if ($ReqId == null) {
                    $newReqId = "10001";  //Initialize the series
                } else {

                    $oldno = (int)$ReqId->buyer_request_id;
                    $newReqId = $oldno + 1;
                }

                $buyer = Buyer::where('comp_name_1', $request->customername[$i])->firstOrFail();
                // dd($buyer);

                $data = BuyerMakeRequest::create(
                    [
                        'buyer_id' => $buyer->id,
                        'buyer_request_id' => $newReqId,
                        'request_id' => $newCommonId,
                        'created_by' => 1,
                        'updated_by' => 1,
                    ]
                );

                if (isset($request->sampleorreal[$i])) {
                    $samplereal = 1;
                } else {
                    $samplereal = 0;
                }

                $requestItems = BuyerMakeRequestDetail::create(
                    [
                        'makerequest_id' => $data->id,
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
                        // 'price' => $request->price[$i],
                        // 'timeduration' => $request->timeduration[$i],
                        'price' => "",
                        'timeduration' => "",
                    ]
                );
            }

            return redirect('admin/sale-make-request')->with('makerequest', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    // Forwarded Quotation Request Tab
    public function saleQuotationRequest()
    {
        try {
            $data = BuyerMakeRequest::where('is_proceed', 1)->where('is_reject', 0)->get()->unique('request_id');

            $dataArray = [];
            foreach ($data as $item) {

                $customer = Buyer::where('id', $item->buyer_id)->first();
                $detail = BuyerMakeRequestDetail::where('makerequest_id', $item->id)->first();
                $product = BuyerListing::where('id', $detail->product_id)->first();

                $dataArray[] = [
                    'id' => $item->id,
                    'reqId' => $item->request_id,
                    'customername' => $customer->comp_name_1,
                    'date' => $item->created_at,
                ];
            }
            // dd($dataArray);

            return view('admin-dashboard.salesandmarketing.quotation-requests')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleQuotationViewDetail($id)
    {
        try {

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

            return view('admin-dashboard.salesandmarketing.quotation-viewdetail')->with(compact('dataArray', 'getreqid'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleQuotationViewBid($id)
    {
        try {

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

            return view('admin-dashboard.salesandmarketing.quotation-viewbid')->with(compact('dataArray', 'getreqid'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleListing()
    {
        try {
            return view('admin-dashboard.salesandmarketing.listing');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleInProcessRequest()
    {
        try {
            return view('admin-dashboard.salesandmarketing.inprocess-request');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleRequestDetail()
    {
        try {
            return view('admin-dashboard.salesandmarketing.request-detail');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    //Order Confirmation Form Tab
    public function saleOrder()
    {
        try {

            $buyer = Buyer::where('is_active', 1)->get();
            $seller = Seller::where('is_active', 1)->get();

            return view('admin-dashboard.salesandmarketing.order-confirmation')->with(compact('buyer', 'seller'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleOrderSubmit(Request $request)
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

            //checkbox value
            if (isset($request->preshipmentcoa)) {
                $preshipmentcoa = 1;
            } else {
                $preshipmentcoa = 0;
            }
            if (isset($request->shipmentafteradc)) {
                $shipmentafteradc = 1;
            } else {
                $shipmentafteradc = 0;
            }
            if (isset($request->dml)) {
                $dml = 1;
            } else {
                $dml = 0;
            }
            if (isset($request->preshipmentdocs)) {
                $preshipmentdocs = 1;
            } else {
                $preshipmentdocs = 0;
            }
            if (isset($request->lables)) {
                $lables = 1;
            } else {
                $lables = 0;
            }
            if (isset($request->gmp)) {
                $gmp = 1;
            } else {
                $gmp = 0;
            }
            if (isset($request->certifictes)) {
                $certifictes = 1;
            } else {
                $certifictes = 0;
            }
            if (isset($request->imagebeforeshipment)) {
                $imagebeforeshipment = 1;
            } else {
                $imagebeforeshipment = 0;
            }
            if (isset($request->moa)) {
                $moa = 1;
            } else {
                $moa = 0;
            }
            if (isset($request->preinformcharges)) {
                $preinformcharges = 1;
            } else {
                $preinformcharges = 0;
            }
            if (isset($request->stability)) {
                $stability = 1;
            } else {
                $stability = 0;
            }
            if (isset($request->safta)) {
                $safta = 1;
            } else {
                $safta = 0;
            }
            if (isset($request->materialavailability)) {
                $materialavailability = 1;
            } else {
                $materialavailability = 0;
            }
            if (isset($request->dmf)) {
                $dmf = 1;
            } else {
                $dmf = 0;
            }

            $data = SalesMarketingOrder::create(
                [
                    'marketingperson_name' => $request->mpname,
                    'buyer_id' => $request->customername,
                    'seller_id' => $request->suppliername,
                    'productname' => $request->pname,
                    'price' => $request->price,
                    'qty' => $request->qty,
                    'paymentterm' => $request->paymentterm,
                    'mfgname' => $request->mfgname,
                    'shipmentmode' => $request->shipmentmode,
                    'shipmentintimation' => $request->shipmentintimation,
                    'pssrequirement' => $request->pssrequirement,
                    'shipmentrequirement' => $request->shipmentrequirement,
                    'customershipmenttime' => $request->customershipmenttime,
                    'lcdate' => $request->lcdate,
                    'indentcustomer' => $request->indentcustomer,
                    'tosupplier' => $request->tosupplier,
                    'preshipmentcoa' => $preshipmentcoa,
                    'shipmentafteradc' => $shipmentafteradc,
                    'dml' => $dml,
                    'preshipmentdocs' => $preshipmentdocs,
                    'lables' => $lables,
                    'gmp' => $gmp,
                    'certifictes' => $certifictes,
                    'imagebeforeshipment' => $imagebeforeshipment,
                    'moa' => $moa,
                    'preinformcharges' => $preinformcharges,
                    'stability' => $stability,
                    'safta' => $safta,
                    'materialavailability' => $materialavailability,
                    'dmf' => $dmf,
                    'created_by' => 1,
                    'updated_by' => 1,
                ]
            );

            return redirect('admin/sale-order-confirmation')->with('saleorder', 'Order has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleRunningDeals()
    {
        try {
            return view('admin-dashboard.salesandmarketing.running-deal');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function saleEmailMarketing()
    {
        try {
            return view('admin-dashboard.salesandmarketing.email-marketing');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function salePreviousEmail()
    {
        try {
            return view('admin-dashboard.salesandmarketing.previous-email');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
