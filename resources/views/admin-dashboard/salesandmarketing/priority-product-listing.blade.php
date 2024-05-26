@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sales And Marketing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Priority Product Listing </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Current Deals</h4> -->

                    <form action="{{ route('sale-priority-product-search') }}" method="GET">
                        <div class="row justify-content-md-center mt-2">
                            <div class="col-md-4">
                                <label><b>Product Name</b></label>
                                <select name="pname" id="pname" class="js-example-basic-single" style="width: 100%">
                                    <option selected disabled>Select Product</option>
                                    @foreach ($data as $product)
                                    <option value="{{ $product->name }}" {{ request('pname') == $product->name ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label><b>Seller Name</b></label>
                                <select name="sellerid" id="seller" class="js-example-basic-single" style="width: 100%">
                                    <option selected disabled>Select Seller</option>
                                    @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}" {{ request('sellerid') == $seller->id ? 'selected' : '' }}>
                                        {{ $seller->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="submit" class="btn text-white btn-rounded mt-1" style="background-color: #232475"><i class="mdi mdi-magnify menu-icon"></i>
                                    Search
                                </button>
                                <a href="{{ route('sale-priority-product-list') }}" class="btn text-white btn-rounded mt-1" style="background-color:#00CCCD"><i class="mdi mdi-refresh menu-icon"></i> Clear</a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive d-block mt-5 mb-4">
                        <table class="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>ID</th>
                                    <th>Seller Name</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th hidden>Certifications</th>
                                    <th>Capacity</th>
                                    <th hidden>Intermediate Manufacturing</th>
                                </tr>
                            </thead>
                            <tbody id="listingData">
                                @php $count = 1 @endphp
                                @forelse($dataArray as $item)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item['seller_name'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['description'] }}</td>
                                    <td>{{ number_format($item['price'], 2) }}</td>
                                    <td hidden>{{ $item['certification'] }}</td>
                                    <td>{{ $item['capacity'] }}</td>
                                    <td hidden>
                                        @if($item['intermediate_manufacturing'] == 1)
                                        Yes
                                        @else
                                        No
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center"> No Listing Available </td>
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