@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> In Process Request </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Current Deals</h4> -->
                    <div class="table-responsive d-block mt-4 pb-4">
                        <table class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1" class="text-center">
                                    <th>ID #</th>
                                    <th>Reqeust ID #</th>
                                    <th>Reqeust ProdID</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($dataArray as $item)
                                <tr class="text-center">
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item['reqId']  }}</td>
                                    <td>{{ $item['buyer_reqId']  }}</td>
                                    <td>{{ $item['customername'] }}</td>
                                    <td>{{ $item['prod_name'] }}</td>
                                    <td>{{ $item['prod_qty'] }}</td>
                                    <td>{{ date('d-M-Y', strtotime($item['date'])) }}</td>
                                    <td class="px-2">
                                        <a href="{{ route('inprocess-viewdetail', $item['id']) }}" class="btn text-white btn-rounded" style="background-color:#00CCCD">
                                            View Detail
                                        </a>
                                        <a href="{{ route('inprocess-viewbid', $item['id']) }}" class="btn text-white btn-rounded" style="background-color:#232475">
                                            View Quotation
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection