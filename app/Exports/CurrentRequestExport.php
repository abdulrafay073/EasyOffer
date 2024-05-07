<?php

namespace App\Exports;

use App\Models\Buyer;
use App\Models\BuyerListing;
use App\Models\BuyerMakeRequest;
use App\Models\BuyerMakeRequestDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CurrentRequestExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
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
                    'date' => date('d-M-Y', strtotime($item->created_at)),
                ];
            }
        }

        return new Collection($dataArray);
    }

    // Tables Headings
    public function headings(): array
    {
        return [
            'ID',
            'Request ID #',
            'Reqeust ProdID',
            'Customer Name',
            'Product Name',
            'Product Quantity',
            'Date',
        ];
    }
}
