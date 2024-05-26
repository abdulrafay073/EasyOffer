<?php

namespace App\Http\Controllers\AdminDashboard\OrderPossibility;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\BuyerListing;
use App\Models\BuyerMakeRequest;
use App\Models\BuyerMakeRequestDetail;
use App\Models\SalesMarketingOrder;
use App\Models\Seller;
use Illuminate\Http\Request;

class OrderPossibilityController extends Controller
{
    public function orderPossibilityBuyerByInquiry()
    {
        try {

            $data = BuyerMakeRequest::orderByDesc('id')->get();

            $dataArray = [];
            foreach ($data as $item) {

                $detail = BuyerMakeRequestDetail::where('makerequest_id', $item->id)->first();
                $product = BuyerListing::where('id', $detail->product_id)->first();

                $dataArray[] = [
                    'buyer_request_id' => $item->buyer_request_id,
                    'customer' => $detail->customer_name,
                    'product' => $product->name,
                    'qty' => $detail->qty,
                    'daterequest' => date('d-M-Y', strtotime($item->created_at))
                ];
            }

            return view('admin-dashboard.orderpossibility.buyer-by-inquiry')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function orderPossibilityBuyerByOrder()
    {
        try {

            $data = SalesMarketingOrder::orderByDesc('id')->get();

            $dataArray = [];
            foreach ($data as $item) {

                $buyer = Buyer::where('id', $item->buyer_id)->first();
                $seller = Seller::where('id', $item->seller_id)->first();

                $dataArray[] = [
                    'buyer' => $buyer->comp_name_1,
                    // 'seller' => $seller->comp_name_1,
                    'product' => $item->productname,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'orderdate' => date('d-M-Y', strtotime($item->created_at))
                ];
            }

            return view('admin-dashboard.orderpossibility.buyer-by-order')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function orderPossibilitySellerByOrder()
    {
        try {

            $data = SalesMarketingOrder::orderByDesc('id')->get();

            $dataArray = [];
            foreach ($data as $item) {

                $seller = Seller::where('id', $item->seller_id)->first();

                $dataArray[] = [
                    // 'buyer' => $seller->comp_name_1,
                    'seller' => $seller->comp_name_1,
                    'product' => $item->productname,
                    'qty' => $item->qty,
                    'price' => $item->price,
                    'orderdate' => date('d-M-Y', strtotime($item->created_at))
                ];
            }

            return view('admin-dashboard.orderpossibility.seller-by-order')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }

    public function orderPossibilityProductByInquiry()
    {
        try {

            $data = BuyerListing::withoutTrashed()->get();

            $dataArray = [];
            foreach ($data as $item) {

                $count = BuyerMakeRequestDetail::where('product_id', $item->id)->count();

                $dataArray[] = [
                    'name' => $item->name,
                    'prod_count' => $count,
                ];
            }

            return view('admin-dashboard.orderpossibility.product-by-inquiry')->with(compact('dataArray'));
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_message_error', 'Something went wrong!');
        }
    }
}
