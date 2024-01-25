@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Deals</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Rejected Requests</li>
                <li class="breadcrumb-item active" aria-current="page"> Re-Request</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Request ProdID # {{ $requestid->buyer_request_id }}</h4>

                    <form action="{{ route('rejected-re-requests-submit') }}" method="POST">
                        @csrf

                        <input type="hidden" value="{{ $requestid->id }}" name="requestid">
                        <input type="hidden" value="{{ $requestid->buyer_request_id }}" name="autorequestid">

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
                                        <th hidden>Time Duration</th>
                                        <th>Origin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $item)
                                    <tr class="text-center">
                                        <td hidden>
                                            <input type="text" class="form-control" name="customername[]"
                                                style="width:200px" value="{{ $item['customer_name'] }}" readonly>
                                        </td>
                                        <td>
                                            <select class="form-control" name="product[]" style="width:200px" readonly>
                                                <option selected disabled>Select Product</option>
                                                @foreach($buyerProducts as $data)

                                                @if($item['name'] == $data['name'])
                                                <option selected value="{{ $data['id'] }}">{{ $data['name'] }}</option>
                                                @endif

                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="description[]"
                                                value="{{ $item['description'] }}" style="width:200px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="qty[]"
                                                value="{{ $item['qty'] }}" style="width:100px">
                                        </td>
                                        <td>
                                            <select class="form-control" name="shipping[]" style="width:200px">
                                                <option selected disabled>Select Shipping</option>
                                                @if($item['shipping_method'] == "By Air")
                                                <option selected value="By Air">By Air</option>
                                                <option value="By Sea">By Sea</option>
                                                <option value="By Road">By Road</option>
                                                @elseif($item['shipping_method'] == "By Sea")
                                                <option value="By Air">By Air</option>
                                                <option selected value="By Sea">By Sea</option>
                                                <option value="By Road">By Road</option>
                                                @else
                                                <option value="By Air">By Air</option>
                                                <option value="By Sea">By Sea</option>
                                                <option selected value="By Road">By Road</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="payment[]" style="width:200px">
                                                <option selected disabled>Select Payment</option>
                                                @if($item['payment_method'] == "LC")
                                                <option selected value="LC">LC</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="required[]" style="width:200px">
                                                <option selected disabled>Select Required</option>
                                                @if($item['required'] == "Local")
                                                <option selected value="Local">Local</option>
                                                <option value="Import">Import</option>
                                                @else
                                                <option value="Local">Local</option>
                                                <option selected value="Import">Import</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="certification[]"
                                                value="{{ $item['certification'] }}" style="width:200px">
                                        </td>
                                        <td>
                                            @if($item['sample_or_real'] == 1)
                                            <input type="checkbox" checked class="form-control" name="sampleorreal[]"
                                                disabled>
                                            @else
                                            <input type="checkbox" class="form-control" name="sampleorreal[]" disabled>
                                            @endif
                                        </td>
                                        <td hidden>
                                            <input type="text" class="form-control" name="price[]"
                                                value="{{ $item['price'] }}" style="width:150px">
                                        </td>
                                        <td hidden>
                                            <input type="text" class="form-control" name="timeduration[]"
                                                value="{{ $item['timeduration'] }}" style="width:150px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="origin[]"
                                                value="{{ $item['origin'] }}" style="width:150px">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn text-white btn-rounded mt-5 mb-3"
                            style="background-color:#232475">
                            Add Re-Request
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection