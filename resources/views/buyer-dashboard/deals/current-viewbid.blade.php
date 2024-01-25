@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Deals</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Current Requests </li>
                <li class="breadcrumb-item active" aria-current="page"> View Quotation </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Request ID # {{ $getreqid->request_id }}</h4>
                    <div class="table-responsive d-block mt-4 pb-4">
                        <table class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>ID #</th>
                                    <th>Reqeust ProdID</th>
                                    <th>Customer Name</th>
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
                                @if(count($dataArray) > 0)
                                    @foreach($dataArray as $item)
                                    <tr class="text-center">
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $item['buyer_reqId']  }}</td>
                                        <td>{{ $item['customername'] }}</td>
                                        <td>{{ $item['sellername'] }}</td>
                                        <td>{{ $item['prod_name'] }}</td>
                                        <td>{{ $item['prod_qty'] }}</td>
                                        <td>{{ $item['prod_price'] + $item['admin_margin'] }}</td>
                                        <td>{{ date('d- M-Y', strtotime($item['date'])) }}</td>
                                        <td class="px-2">
                                            @if($item['buyer_accept'] == 0 && $item['buyer_rebid'] == 0 && $item['buyer_reject'] == 0)
                                            
                                                <!-- working condition me hai ye <a> tag , just hide kiya hua hai -->
                                                <a hidden href="{{ route('current-viewbid-details', $item['id']) }}"
                                                    class="btn text-white btn-rounded" style="background-color:#00CCCD">
                                                    View Detail
                                                </a>

                                                <form action="{{ route('current-bid-accepts') }}" method="POST"
                                                    style="display:inline!important">
                                                    @csrf
                                                    <input type="hidden" name="placedbidid" value="{{ $item['id'] }}">

                                                    <button type="submit" class="btn text-white btn-rounded"
                                                        style="background-color:#237549">
                                                        Accept
                                                    </button>
                                                </form>

                                                <button type="button" class="btn text-white btn-rounded RebidButton"
                                                    value="{{ $item['id'] }}" data-toggle="modal" data-target="#rebidModal"
                                                    style="background-color:#232475">
                                                    Re-Quotation
                                                </button>

                                                <button type="button" class="btn text-white btn-rounded RejectButton"
                                                    value="{{ $item['id'] }}" data-toggle="modal" data-target="#rejectModal"
                                                    style="background-color:#F01111">
                                                    Reject
                                                </button>
                                            @elseif($item['buyer_accept'] == 1)
                                                <button class="btn text-white btn-rounded" style="background-color:#232475">Accepeted</button>
                                            @elseif($item['buyer_rebid'] == 1)
                                                <button class="btn text-white btn-rounded" style="background-color:#232475">ReQuotation Submitted</button>
                                            @elseif($item['buyer_reject'] == 1)
                                                <button class="btn text-white btn-rounded" style="background-color:#F01111">Rejected</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="9">No Quotation Available</td>
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

<div class="modal fade" id="rebidModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('current-bid-rebids') }}" method="POST">
                @csrf

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reason</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input name="placedbidid" id="rebid_placedbidid" value="" hidden>
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
                    <button type="submit" class="btn text-white" style="background-color:#F01111">Save</button>
                    <button type="button" class="btn btn-dark modalclose" data-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('current-bid-rejects') }}" method="POST">
                @csrf

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reason</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input name="placedbidid" id="reject_placedbidid" value="" hidden>
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
                    <button type="submit" class="btn text-white" style="background-color:#F01111">Save</button>
                    <button type="button" class="btn btn-dark modalclose" data-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- cdn jquery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$('.RejectButton').on('click', function() { //use
    var id = $(this).val();
    // console.log(id);
    $('#reject_placedbidid').val(id);

})

$('.RebidButton').on('click', function() { //use
    var id = $(this).val();
    // console.log(id);
    $('#rebid_placedbidid').val(id);

})
</script>

@endsection