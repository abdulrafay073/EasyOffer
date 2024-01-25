<?php

namespace App\Http\Controllers\BuyerDashboard\MakeRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Buyer;
use App\Models\BuyerListing;
use App\Models\BuyerMakeRequest;
use App\Models\BuyerMakeRequestDetail;

class BuyerMakeRequestController extends Controller
{
    public function index(){
        try {

            $user = Auth::user();
            
            $data = BuyerListing::where('is_active', 1)->where('user_id', $user->id)->get();

            return view('buyer-dashboard.request.create-request')->with(compact('user','data'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    //create
    public function old_createRequest(Request $request){
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
            
            $ReqId = BuyerMakeRequest::orderBy('buyer_request_id', 'DESC')->first();
            if($ReqId == null){
                $newReqId = "10001";  //Initialize the series
            }else{

                $oldno = (int)$ReqId->buyer_request_id;
                $newReqId = $oldno + 1;
            }

            $buyer = Buyer::where('user_id', $user->id)->firstOrFail();
            // dd($buyer);

            $data = BuyerMakeRequest::create(
                [
                    'buyer_id' => $buyer->id,
                    'buyer_request_id' => $newReqId,   
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
            
            return redirect('buyer/make-request')->with('makerequest', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function createRequest(Request $request){
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

            // this is request id
            $CommonId = BuyerMakeRequest::orderBy('request_id', 'DESC')->first();
                if($CommonId == null){
                    $newCommonId = "90001";  //Initialize the series
                }else{

                    $oldno = (int)$CommonId->request_id;
                    $newCommonId = $oldno + 1;
                }

            // dd(count($request->customername));
            for ($i = 0; $i < count($request->customername) ; $i++) {
            
                // this is product request id
                $ReqId = BuyerMakeRequest::orderBy('buyer_request_id', 'DESC')->first();
                if($ReqId == null){
                    $newReqId = "10001";  //Initialize the series
                }else{

                    $oldno = (int)$ReqId->buyer_request_id;
                    $newReqId = $oldno + 1;
                }

                $buyer = Buyer::where('user_id', $user->id)->firstOrFail();
                // dd($buyer);

                $data = BuyerMakeRequest::create(
                    [
                        'buyer_id' => $buyer->id,
                        'buyer_request_id' => $newReqId,   
                        'request_id' => $newCommonId,   
                        'created_by' => $user->id,
                        'updated_by' => $user->id,
                    ]
                );

                if(isset($request->sampleorreal[$i])){
                    $samplereal = 1;
                }
                else{
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
            
            return redirect('buyer/make-request')->with('makerequest', 'Request has been submitted successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}