@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Quotation </li>
                <li class="breadcrumb-item active" aria-current="page"> View Quotation </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Request ID # {{ $getreqid->request_id }}</h4>

                    <form action="" method="POST">

                        <div class="table-responsive d-block mt-4 pb-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="background-color: #CFCED1">
                                        <th><input class="form-control" type="checkbox" name="allseller" id="allseller"></th>
                                        <th hidden>ID #</th>
                                        <th>Reqeust ProdID</th>
                                        <th>Seller Name</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    @if(count($dataArray) > 0)
                                    @foreach($dataArray as $item)
                                    <tr class="text-center">
                                        <td>
                                            <input class="form-control" value="{{ $item['id'] }}" type="checkbox"
                                                name="quotid" id="quotid">
                                        </td>
                                        <td hidden>{{ $count++ }}</td>
                                        <td>{{ $item['buyer_reqId']  }}</td>
                                        <td>{{ $item['sellername'] }}</td>
                                        <td>{{ $item['customername'] }}</td>
                                        <td>{{ $item['prod_name'] }}</td>
                                        <td>{{ $item['prod_qty'] }}</td>
                                        <td>{{ $item['prod_price'] + $item['admin_margin'] }}</td>
                                        <td>{{ date('d-M-Y', strtotime($item['date'])) }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No Quotation Available</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <button id="quotationForm" class="btn text-white btn-rounded mt-2 mb-2"
                            style="background-color:#232475">
                            Forward
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- cdn jquery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $("table").simpleCheckboxTable({
        onCheckedStateChanged: function($checkbox) {
            // Do something
        }
    });
});
</script>


<!-- Quotation send to buyers - Form Submit using Ajax -->
<script>
$('#quotationForm').click(function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get the selected checkbox values
    var selectedIds = $('input[name="quotid"]:checked').map(function() {
        return $(this).val();
    }).get();

    // Do something with the selected IDs
    // console.log(selectedIds);

    var quotationsId = selectedIds;
    console.log(quotationsId);

    // You can also send the selected IDs to a server using AJAX if needed
    $.ajax({
        url: "{{ route('quotation-forward-to-buyers') }}",
        type: 'POST',
        data: {
            quotIds: quotationsId,
            _token: '{{csrf_token()}}'
        },
        success: function(response) {
            // console.log('successfully');

            Swal.fire(
                'Success!',
                'Selected Quotation has been send to buyers.',
                'success',
            )
            window.location = '/admin/quotations';
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});
</script>

@endsection