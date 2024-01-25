@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Current Request </li>
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
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
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
                                    <td>{{ $item['customername'] }}</td>
                                    <td>{{ $item['prod_name'] }}</td>
                                    <td>{{ $item['prod_qty'] }}</td>
                                    <td>{{ date('d-M-Y', strtotime($item['date'])) }}</td>
                                    <td class="px-2">
                                        <a href="{{ route('com-current-viewdetail', $item['id']) }}"
                                            class="btn text-white btn-rounded" style="background-color:#00CCCD">
                                            View Detail
                                        </a>

                                        <a href="{{ route('com-current-requests-direct-quotation', $item['id']) }}"
                                            class="btn text-white btn-rounded" style="background-color:#232475">
                                            Direct Quotation
                                        </a>

                                        <a href="{{ route('com-current-requests-proceed', $item['id']) }}"
                                            class="btn text-white btn-rounded" style="background-color:#237549">
                                            Proceed
                                        </a>

                                        <a hidden href="{{ route('com-current-requests-placebid', $item['id']) }}"
                                            class="btn text-white btn-rounded" style="background-color:#232475">
                                            Place Bid
                                        </a>

                                        <button class="btn text-white btn-rounded RejectButton" value="{{$item['id']}}"
                                            data-toggle="modal" data-target="#rejectModal"
                                            style="background-color:#F01111">
                                            Reject
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

<div class="modal fade" id="rejectModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('com-current-requests-reject') }}" method="post">
                {{ csrf_field() }}

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reason</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input name="requestid" id="reject_requestid" value="" hidden>
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
    $('#reject_requestid').val(id);

})
</script>

@endsection