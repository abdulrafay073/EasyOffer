@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Quotation </li>
                <li class="breadcrumb-item active" aria-current="page"> View Quotation Response</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Request ID # {{ $getreqid->request_id }}</h4>

                    <div class="table-responsive d-block mt-4 pb-4">
                        <table class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>ID #</th>
                                    <th>Reqeust ProdID</th>
                                    <th>Seller Name</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @if(count($dataArray) > 0)
                                @foreach($dataArray as $item)
                                <tr class="text-center">
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item['buyer_reqId']  }}</td>
                                    <td>{{ $item['sellername'] }}</td>
                                    <td>{{ $item['customername'] }}</td>
                                    <td>{{ $item['prod_name'] }}</td>
                                    <td>{{ $item['prod_qty'] }}</td>
                                    <td>{{ $item['prod_price'] + $item['admin_margin'] }}</td>
                                    <td>{{ date('d-M-Y', strtotime($item['date'])) }}</td>
                                    <td>
                                        @if($item['is_buyer_accept'] == 1)
                                            <button class="btn btn-success btn-rounded">Accepted</button>
                                        @elseif($item['is_buyer_rebid'] == 1)
                                            <button class="btn btn-danger btn-rounded">Request for Requotation</button>
                                        @elseif($item['is_buyer_reject'] == 1)
                                            <button class="btn btn-danger btn-rounded">Rejected</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">No Quotation Response Available</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection