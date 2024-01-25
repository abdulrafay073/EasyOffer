@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Sample Request</li>
                <li class="breadcrumb-item active" aria-current="page"> View Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Request ProdID # {{ $requestid->buyer_request_id }}</h4>
                    <div class="table-responsive d-block mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th hidden>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Shipping Method</th>
                                    <th>Payment Method</th>
                                    <th>Required (local, import)</th>
                                    <th>Certification</th>
                                    <th>Sample or Real Purchase Check</th>
                                    <th hidden>Price</th>
                                    <th hidden>TimeDuration</th>
                                    <th>Origin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr class="text-center">
                                    <td hidden>{{ $item['customer_name'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['description'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>{{ $item['shipping_method'] }}</td>
                                    <td>{{ $item['payment_method'] }}</td>
                                    <td>{{ $item['required'] }}</td>
                                    <td>{{ $item['certification'] }}</td>
                                    <td>
                                        @if($item['sample_or_real'] == 1)
                                        Yes
                                        @else
                                        No
                                        @endif
                                    </td>
                                    <td hidden>{{ $item['price'] }}</td>
                                    <td hidden>{{ $item['timeduration'] }}</td>
                                    <td>{{ $item['origin'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection