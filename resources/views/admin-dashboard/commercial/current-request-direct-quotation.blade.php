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
                                    <th>Seller Name</th>
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
                                    <td>{{ $item['sellername'] }}</td>
                                    <td>{{ $item['prod_name'] }}</td>
                                    <td>{{ $item['prod_qty'] }}</td>
                                    <td>{{ $item['prod_price'] }}</td>
                                    <td>{{ date('d-M-Y', strtotime($item['date'])) }}</td>
                                    <td><input id="margin" name="margin" class="form-control margin" style="width:100px" disabled></td>
                                    <td class="px-2">

                                        <button class="btn text-white btn-rounded editmargin" id="editmargin" style="background-color:#232475">
                                            Edit
                                        </button>

                                        <form action="{{ route('com-current-requests-direct-quotation-proceed') }}" method="POST"
                                            style="display:inline!important">
                                            @csrf
                                            <input type="hidden" name="placedbidid" value="{{ $item['id'] }}">
                                            <input type="hidden" name="adminmargin" id="adminmargin" value="">

                                            <button type="submit" class="btn text-white btn-rounded"
                                                style="background-color:#237549">
                                                Proceed
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="11">No History Available</td>
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

@endsection