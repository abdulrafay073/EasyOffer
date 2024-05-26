@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Order Possibility</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buyer By Inquiry </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Buyer By Inquiry</h3>

                    <div class="table-responsive d-block mt-4 mb-4">
                        <table class="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>S.NO#</th>
                                    <th>Request ID</th>
                                    <th>Customer Name</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Date Of Request</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @forelse($dataArray as $item)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item['buyer_request_id'] }}</td>
                                    <td>{{ $item['customer'] }}</td>
                                    <td>{{ $item['product'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>{{ $item['daterequest'] }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Data Available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection