@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Current Request</li>
                <li class="breadcrumb-item active" aria-current="page"> View History</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-md-center mt-2">
                        <div class="col-md-4">
                            <label><b>Product Name</b></label>
                            <select name="pname" id="pname" class="js-example-basic-single" style="width: 100%">
                                <option disabled>Select Product</option>
                                <option value="{{ $product->name }}" selected>{{ $product->name }}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label><b>Buyer Name</b></label>
                            <select name="buyer" id="buyer" class="js-example-basic-single" style="width: 100%">
                                <option selected disabled>Select Buyer</option>
                                @foreach ($buyers as $buyer)
                                <option value="{{ $buyer->id }}">{{ $buyer->comp_name_1 }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mt-4">
                            <button id="searchBtn" type="button" class="btn text-white btn-rounded mt-1" style="background-color: #232475"><i class="mdi mdi-magnify menu-icon"></i>
                                Search
                            </button>
                        </div>

                        <div hidden class="col-md-3 mt-4">
                            <a href="{{ route('com-current-viewhistory-excelexport', $id) }}" class="btn text-white btn-rounded" style="background-color:#237549;">
                                <i class="mdi mdi-download menu-icon"></i> Excel Export
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive d-block mt-5">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>Buyer Name</th>
                                    <th>Seller Name</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="historyData">
                                @forelse($dataArray as $item)
                                <tr class="text-center">
                                    <td>{{ $item['buyer'] }}</td>
                                    <td>{{ $item['seller'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>{{ $item['price'] }}</td>
                                    <td>
                                        <a href="{{ route('com-current-viewhistorydetail', $item['id']) }}" class="btn text-white btn-rounded" style="background-color:#00CCCD">
                                            View Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No History Available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    // current buyer password match ajax
    $('#searchBtn').on('click', function() {
        var prodName = $('#pname').val();
        var buyerId = $('#buyer').val();
        // console.log(prodName);
        // console.log(buyerId);

        $.ajax({
            type: "GET",
            url: "/admin/current-viewhistorysearch/" + prodName + "/" + buyerId,
            dataType: "json",

            success: function(response) {
                console.log(response);

                $('#historyData').html('');

                var content = '';
                if (response.data === null || response.data.length === 0) {

                    content += '<tr>';
                    content += '<td colspan="6" class="text-center"> No History Available </td>';
                    content += '</tr>';
                } else {

                    for (var i = 0; i < response.data.length; i++) {
                        content += '<tr>';
                        content += '<td>' + response.data[i].buyer + '</td>';
                        content += '<td>' + response.data[i].seller + '</td>';
                        content += '<td>' + response.data[i].name + '</td>';
                        content += '<td>' + response.data[i].qty + '</td>';
                        content += '<td>' + response.data[i].price + '</td>';
                        content += '<td>';
                        content += '<a href="/admin/current-viewhistorydetail/' + response.data[i].id + '" class="btn text-white btn-rounded" style="background-color:#00CCCD">';
                        content += 'View Detail';
                        content += '</a>';
                        content += '</td>';
                    }
                }
                $('#historyData').append(content);

            }
        });
    })
</script>

@endsection