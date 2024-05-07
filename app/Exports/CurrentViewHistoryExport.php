<?php

namespace App\Exports;

use App\Models\Buyer;
use App\Models\BuyerListing;
use App\Models\BuyerMakeRequest;
use App\Models\BuyerMakeRequestDetail;
use App\Models\SalesMarketingOrder;
use App\Models\Seller;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CurrentViewHistoryExport implements FromCollection, WithHeadings
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $requestid = BuyerMakeRequest::select('buyer_request_id')->where('id', $this->id)->first();

        $detail = BuyerMakeRequestDetail::where('makerequest_id', $this->id)->first();
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

        return new Collection($dataArray);
    }

    // Tables Headings
    public function headings(): array
    {
        return [
            'ID',
            'Buyer Name',
            'Seller Name',
            'Product Name',
            'Quantity',
            'Price',
        ];
    }
}
