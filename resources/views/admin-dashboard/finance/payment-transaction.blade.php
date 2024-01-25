@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Finance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment Transaction</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-md-center">
                        <div class="col-md-4 mt-3">
                            <label><b>Buyer</b></label>
                            <select class="js-example-basic-single" style="width: 100%;" id="buyername">
                                <option selected disabled>Search Buyer</option>
                                @foreach($buyers as $buyer)
                                <option value="{{ $buyer['comp_name_1'] }}">{{ $buyer['comp_name_1'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label><b>Seller</b></label>
                            <select class="js-example-basic-single" style="width: 100%;" id="sellername">
                                <option selected disabled>Search Seller</option>
                                @foreach($sellers as $seller)
                                <option value="{{ $seller['comp_name_1'] }}">{{ $seller['comp_name_1'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mt-4">
                            <label for=""></label>
                            <button type="button" id="buyertoseller_search" class="btn text-white btn-rounded mt-3"
                                style="background-color:#232475"> Search
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive d-block mt-5 pb-4">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>Invoice <small>(Payment Issue)</small></th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="buyertosellerData">
                                <tr>
                                    <td><small>No Data Available</small></td>
                                    <td><small>No Status</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">

                    <div class="row justify-content-md-center">
                        <div class="col-md-4 mt-3">
                            <label><b>Seller</b></label>
                            <select class="js-example-basic-single" style="width: 100%;" id="sellernamee">
                                <option selected disabled>Search Seller</option>
                                @foreach($sellers as $seller)
                                <option value="{{ $seller['comp_name_1'] }}">{{ $seller['comp_name_1'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label><b>Admin</b></label>
                            <select class="js-example-basic-single" style="width: 100%;" id="adminname">
                                <option value="Super Admin" selected>Super Admin</option>
                            </select>
                        </div>
                        <div class="col-md-2 mt-4">
                            <label for=""></label>
                            <button type="button" id="sellertoadmin_search" class="btn text-white btn-rounded mt-3"
                                style="background-color:#232475"> Search
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive d-block mt-5 pb-4">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>Received <small>(Margin)</small></th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="sellertoadminData">
                                <tr>
                                    <td><small>No Data Available</small></td>
                                    <td><small>No Status</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- cdn jquery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>
$('#buyertoseller_search').on('click', function() {
   
    var buyer = $('#buyername').val();
    var seller = $('#sellername').val();
    // console.log(buyer);
    // console.log(seller);

    $.ajax({
        type: "GET",
        url: "/admin/payment-transaction-data/" + buyer + "/" + seller,
        dataType: "json",

        success: function(response) {
            console.log(response);

            $('#buyertosellerData').html('');
            
            var content = '';
            if(response.data === null || response.data.length === 0){

                content += '<tr>';
                content +=      '<td colspan="2"> No Data Available </td>';
                content += '</tr>';
            }
            else{

                for (var i = 0; i < response.data.length; i++) {
                    content += '<tr>';
                    content +=   '<td>';
                    content +=      '<button class="btn btn-rounded" style="background-color: #232475">';
                    content +=          '<a href="' + response.data[i].invoice + '" download style="color:#fff; text-decoration:none">';
                    content +=           '<i class="mdi mdi-download mr-1"></i> Download Invoice';
                    content +=          '</a>';
                    content +=      '</button>';
                    content +=   '</td>'
                    content +=   '<td class="text-success font-weight-bold">' + response.data[i].status + '</td>';
                    content += '</tr>';
                }
            }
            $('#buyertosellerData').append(content);

        }
    });
});
</script>

<script>
$('#sellertoadmin_search').on('click', function() {
   
    var seller = $('#sellernamee').val();
    var admin = $('#adminname').val();
    // console.log(seller);
    // console.log(admin);

    $.ajax({
        type: "GET",
        url: "/admin/payment-transaction-data1/" + seller + "/" + admin,
        dataType: "json",

        success: function(response) {
            console.log(response);

            $('#sellertoadminData').html('');
            
            var content = '';
            if(response.data === null || response.data.length === 0){

                content += '<tr>';
                content +=      '<td colspan="2"> No Data Available </td>';
                content += '</tr>';
            }
            else{

                for (var i = 0; i < response.data.length; i++) {
                    content += '<tr>';
                    content +=   '<td>';
                    content +=      '<button class="btn btn-rounded" style="background-color: #232475">';
                    content +=          '<a href="' + response.data[i].margin + '" download style="color:#fff; text-decoration:none">';
                    content +=           '<i class="mdi mdi-download mr-1"></i> Download Invoice';
                    content +=          '</a>';
                    content +=      '</button>';
                    content +=   '</td>'
                    content +=   '<td class="text-success font-weight-bold">' + response.data[i].status + '</td>';
                    content += '</tr>';
                }
            }
            $('#sellertoadminData').append(content);

        }
    });
});
</script>

@endsection