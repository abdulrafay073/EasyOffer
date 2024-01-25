@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Inprocess Request </li>
                <li class="breadcrumb-item active" aria-current="page"> View Quotation </li>
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
                                    <th>Seller Name</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Margin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @if(count($dataArray) > 0)
                                @foreach($dataArray as $item)
                                <tr class="text-center">
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item['reqId']  }}</td>
                                    <td>{{ $item['buyer_reqId']  }}</td>
                                    <td>{{ $item['sellername'] }}</td>
                                    <td>{{ $item['customername'] }}</td>
                                    <td>{{ $item['prod_name'] }}</td>
                                    <td>{{ $item['prod_qty'] }}</td>
                                    <td>{{ $item['prod_price'] }}</td>
                                    <td>{{ date('d-M-Y', strtotime($item['date'])) }}</td>
                                    <td><input id="margin" name="margin" class="form-control margin" style="width:100px" disabled></td>
                                    <td class="px-2">

                                        <a href="{{ route('inprocess-viewbid-detail', $item['id']) }}"
                                            class="btn text-white btn-rounded" style="background-color:#00CCCD">
                                            View Detail
                                        </a>

                                        <button class="btn text-white btn-rounded editmargin" id="editmargin" style="background-color:#232475">
                                            Edit
                                        </button>

                                        <form action="{{ route('inprocess-viewbid-proceed') }}" method="POST"
                                            style="display:inline!important">
                                            @csrf
                                            <input type="hidden" name="placedbidid" value="{{ $item['id'] }}">
                                            <input type="hidden" name="adminmargin" id="adminmargin" value="">

                                            <button type="submit" class="btn text-white btn-rounded"
                                                style="background-color:#237549">
                                                Proceed
                                            </button>
                                        </form>

                                        <form action="{{ route('inprocess-viewbid-delete') }}" method="POST"
                                            style="display:inline!important">
                                            @csrf
                                            <input type="hidden" name="placedbidid" value="{{ $item['id'] }}">

                                            <button type="submit" class="btn text-white btn-rounded"
                                                style="background-color:#F01111">
                                                Delete
                                            </button>
                                        </form>

                                        <button class="btn text-white btn-rounded ViewButton" value="{{ $item['id'] }}"
                                            data-toggle="modal" data-target="#viewModal"
                                            style="background-color:#232475">
                                            View Response
                                        </button>

                                        <button class="btn text-white btn-rounded SendButton" value="{{ $item['id'] }}"
                                            data-toggle="modal" data-target="#sendModal"
                                            style="background-color:#232475">
                                            Send Response
                                        </button>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="11">No Quotation Available</td>
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

<div class="modal fade" id="sendModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('inprocess-viewbid-sendresponse') }}" method="POST">
                @csrf

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Response</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input name="placedbidid" id="send_placedbidid" value="" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea name="note" class="form-control" rows="6"
                                    placeholder="Type reason...."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn text-white" style="background-color:#232475">Send</button>
                    <button type="button" class="btn btn-dark modalclose" data-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- cdn jquery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    // enabled the margin field
    $('.editmargin').on('click', function() { //use

        // Find the closest row to the clicked button
        var row = $(this).closest('tr');
        
        // Find the input field in that row and enable it
        var inputField = row.find('input[id="margin"]');
        inputField.prop('disabled', false);
    })

    // margin field keyup to set admin margin
    $('.margin').on('keyup', function() { //use
        var rate = $(this).val();

        // Find the closest row to the clicked button
        var row = $(this).closest('tr');
        
        // Find the input field in that row and enable it
        var inputField = row.find('input[id="adminmargin"]');
        inputField.val(rate)
    })
</script>

<script>
$('.ViewButton').on('click', function() { //use
    var id = $(this).val();
    console.log(id);

    $.ajax({
        type: "GET",
        url: "/admin/inprocess-viewbid-response/" + id,
        dataType: "json",

        success: function(response) {
            console.log(response.bidaccept);
            console.log(response.bidrebid);
            console.log(response.bidrebidnote);
            console.log(response.bidreject);
            console.log(response.bidrejectreason);

            if (response.bidaccept == 1) {
                $("#msg").text('');
                $("#msg").text('The buyer has accepted the bid.');
            } else if (response.bidrebid == 1) {
                $("#msg").text('');
                $("#msg").text(response.bidrebidnote);
            } else if (response.bidreject == 1) {
                $("#msg").text('');
                $("#msg").text(response.bidrejectreason);
            } else {
                $("#msg").text('No Response Yet');
            }
        }
    });

})

$('.SendButton').on('click', function() { //use
    var id = $(this).val();
    // console.log(id);
    $('#send_placedbidid').val(id);

})
</script>

@endsection