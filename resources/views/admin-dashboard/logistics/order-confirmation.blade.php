@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Logistics</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Confirmation Orders List</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Current Deals</h4> -->
                    <div class="table-responsive d-block mt-4 pb-4">
                        <table class="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1; text-align:center">
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Commercial Person Name</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($data as $item)
                                <tr class="text-center">
                                    <td>{{ $count++ }}</td>
                                    <td>{{date('d-M-Y', strtotime($item['created_at']))}}</td>
                                    <td>{{ $item['commercialperson_name'] }}</td>
                                    <td>{{ $item['productname'] }}</td>
                                    <td>{{ $item['price'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td class="px-2">
                                        <a href="{{ route('logistics-order-viewdetails', $item['id']) }}"
                                            class="btn text-white btn-rounded" style="background-color:#232475">
                                            View Detail
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