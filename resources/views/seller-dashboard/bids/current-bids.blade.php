@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Quotation</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Current Quotations </li>
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
                                <tr style="background-color: #CFCED1">
                                    <th>ID #</th>
                                    <th>Reqeust ID #</th>
                                    <th>Reqeust ProdID</th>
                                    <th hidden>Customer Name</th>
                                    <th>Seller Name</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
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
                                    <td hidden>{{ $item['customername'] }}</td>
                                    <td>{{ $item['sellername'] }}</td>
                                    <td>{{ $item['prod_name'] }}</td>
                                    <td>{{ $item['prod_qty'] }}</td>
                                    <td>{{ $item['prod_price'] }}</td>
                                    <td>{{ date('d- M-Y', strtotime($item['date'])) }}</td>
                                    <td class="px-2">
                                        <a href="{{ route('current-bid-detail', $item['id']) }}"
                                            class="btn text-white btn-rounded" style="background-color:#00CCCD">
                                            View Detail
                                        </a>

                                        <button class="btn text-white btn-rounded ViewButton" value="{{ $item['id'] }}"
                                            data-toggle="modal" data-target="#viewModal"
                                            style="background-color:#232475">
                                            View Response
                                        </button>

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

<div class="modal fade" id="viewModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View Respnse</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">

                        <p id="msg"></p>

                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark modalclose" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- cdn jquery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$('.ViewButton').on('click', function() { //use
    var id = $(this).val();
    console.log(id);

    $.ajax({
        type: "GET",
        url: "/seller/current-bids-response/" + id,
        dataType: "json",

        success: function(response) {
            console.log(response.bidresponse);
            console.log(response.bidresponsenote);

            if (response.bidresponse == 1) {
                $("#msg").text('');
                $("#msg").text(response.bidresponsenote);
            } else {
                $("#msg").text('No Response Yet');
            }
        }
    });

})
</script>

@endsection