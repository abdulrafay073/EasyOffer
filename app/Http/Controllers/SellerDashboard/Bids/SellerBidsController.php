<?php

namespace App\Http\Controllers\SellerDashboard\Bids;

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

class SellerBidsController extends Controller
{
    // Current Bids Tab
    public function currentBids(){
        try {
            $user = Auth::user();
            $seller = Seller::where('user_id', $user->id)->first();
            
            $data = SellerPlacedBid::where('seller_id', $seller->id)->get();
            // dd($data);
            
            $dataArray = [];
            foreach($data as $item){
                
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
                    'proceed' => $item->is_proceed,
                    'date' => $item->created_at,
                ];
            }     
            // dd($dataArray);

            return view('seller-dashboard.bids.current-bids')->with(compact('dataArray'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function currentBidDetail($id){
        try {
            
            $requestid = SellerPlacedBid::select('buyer_request_id')->where('id', $id)->first();
            
            $data = SellerPlacedBidDetail::join('buyer_listings', 'seller_placed_bid_details.product_id', 'buyer_listings.id')
                        ->select('buyer_listings.name','seller_placed_bid_details.id','seller_placed_bid_details.customer_name','seller_placed_bid_details.qty','seller_placed_bid_details.shipping_method','seller_placed_bid_details.payment_method','seller_placed_bid_details.origin','seller_placed_bid_details.required','seller_placed_bid_details.description','seller_placed_bid_details.certification','seller_placed_bid_details.sample_or_real','seller_placed_bid_details.price','seller_placed_bid_details.timeduration')                                
                        ->where('seller_placed_bid_details.placedbid_id', $id)
                        ->get();

            return view('seller-dashboard.bids.current-bids-detail')->with(compact('data', 'requestid'));
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function currentBidResponse($id)
    {
        try {
            
            $data = SellerPlacedBid::where('id', $id)->first();

            if($data != ""){
                $is_send_response = $data->is_send_response;
                $is_send_response_note = $data->is_send_response_note;
            }else{
                $is_send_response = "";
                $is_send_response_note = "";
            }

            return response()->json(['bidresponse'=>$is_send_response, 'bidresponsenote'=>$is_send_response_note]);
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
            
        }
    }

    // Pending Bids Tab
    public function pendingBids(){
        try {
            $user = Auth::user();
            $seller = Seller::where('user_id', $user->id)->first();

            $data = SellerPlacedBid::where('seller_id', $seller->id)->where('is_buyer_accept', 0)->where('is_buyer_rebid', 0)->where('is_buyer_reject', 0)->where('is_proceed', 0)->where('is_send_response', 0)->get();
            
            $dataArray = [];
            foreach($data as $item){
                
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
                    'proceed' => $item->is_proceed,
                    'date' => $item->created_at,
                ];
            }     
            // dd($dataArray); 

            return view('seller-dashboard.bids.pending-bids')->with(compact('dataArray'));
        }catch(\Exception $e){
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function pendingBidDetail($id){
        try {
            
            $requestid = SellerPlacedBid::select('buyer_request_id')->where('id', $id)->first();
            
            $data = SellerPlacedBidDetail::join('buyer_listings', 'seller_placed_bid_details.product_id', 'buyer_listings.id')
                        ->select('buyer_listings.name','seller_placed_bid_details.id','seller_placed_bid_details.customer_name','seller_placed_bid_details.qty','seller_placed_bid_details.shipping_method','seller_placed_bid_details.payment_method','seller_placed_bid_details.origin','seller_placed_bid_details.required','seller_placed_bid_details.description','seller_placed_bid_details.certification','seller_placed_bid_details.sample_or_real','seller_placed_bid_details.price','seller_placed_bid_details.timeduration')                                
                        ->where('seller_placed_bid_details.placedbid_id', $id)
                        ->get();

            return view('seller-dashboard.bids.pending-bids-detail')->with(compact('data', 'requestid'));
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error','Something went wrong!');
        }
    }

    public function pendingBidCancel(Request $request){
        try {
        
            SellerPlacedBid::destroy($request->placedbidid);
            
            return redirect('seller/pending-bids')->with('sellerbidcancel', 'Bid has been Cancelled successfully !');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}