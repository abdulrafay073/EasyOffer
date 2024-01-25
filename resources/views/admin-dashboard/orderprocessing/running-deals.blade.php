@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Order Processing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Running Deals</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Current Deals</h4> -->
                    <div class="table-responsive d-block mt-4 mb-4">
                        <table class="table" class="table table-striped">
                            <thead class="text-center">
                                <tr style="background-color: #CFCED1;">
                                    <th>OrderID</th>
                                    <th>Marketing Person Name</th>
                                    <th>Commercial Person Name</th>
                                    <th>Logistic Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($dataArray as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['marketingperson_name'] }}</td>
                                    <td>{{ $item['commercialperson_name'] }}</td>
                                    <td>{{date('d-M-Y', strtotime($item['date']))}}</td>
                                    <td>
                                        <a class="btn text-white btn-rounded" style="background-color:#00CCCD">
                                            {{ $item['status'] }}
                                        </a>
                                    </td>
                                    <td class="px-2">
                                        <a href="{{ route('running-deals-viewdetail', $item['id']) }}" class="btn text-white btn-rounded" style="background-color:#232475">
                                            View Detail
                                        </a>
                                        <button type="button" class="btn text-white btn-rounded CancelButton"
                                            value="{{ $item['id'] }}" data-toggle="modal" data-target="#cancelModal"
                                            style="background-color:#F01111">
                                            Cancel
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


<div class="modal fade" id="cancelModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('running-deals-cancel') }}" method="POST">
                @csrf

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reason</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input name="logistic_orderid" id="cancel_orderid" value="" hidden>
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
$('.CancelButton').on('click', function() { //use
    var id = $(this).val();
    // console.log(id);
    $('#cancel_orderid').val(id);

})
</script>

@endsection