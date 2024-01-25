@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Current Request </li>
                <li class="breadcrumb-item active" aria-current="page"> Proceed </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Request ProdID # {{ $requestid->buyer_request_id }}</h4>

                    <form action="" method="POST">

                        <input type="hidden" value="{{ $requestid->id }}" id="requestid">

                        <div class="table-responsive d-block mt-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="background-color: #CFCED1">
                                        <th><input class="form-control" type="checkbox" name="allseller" id="allseller">
                                        </th>
                                        <th>Customer Name</th>
                                        <th>Company Address</th>
                                        <th>Company Email</th>
                                        <th>Company Contact Number</th>
                                        <th>Designation</th>
                                        <th>Company Owner name</th>
                                        <th>Certifications (CMP, ISO, etc)</th>
                                        <th hidden>DOB</th>
                                        <th hidden>NTN No</th>
                                        <th hidden>GST No</th>
                                        <th>Whatsapp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seller as $data)
                                    <tr class="text-center">
                                        <td>
                                            <input class="form-control" value="{{ $data['userid'] }}" type="checkbox"
                                                name="sellerid" id="sellerid">
                                        </td>
                                        <td>{{ $data['comp_name_1'] }}</td>
                                        <td>{{ $data['comp_office_address'] }}</td>
                                        <td>{{ $data['comp_email_1'] }}</td>
                                        <td>{{ $data['comp_contact_1'] }}</td>
                                        <td>{{ $data['designation_1'] }}</td>
                                        <td>{{ $data['comp_ownername'] }}</td>
                                        <td><a href="{{ asset($data['upload_certification']) }}" target="_blank"
                                                class="text-primary">
                                                <i class="mdi mdi-eye" style="font-size: 20px"></i>
                                            </a></td>
                                        <td hidden>{{ $data['dob_1'] }}</td>
                                        <td hidden>{{ $data['ntn'] }}</td>
                                        <td hidden>{{ $data['gst'] }}</td>
                                        <td><a href="https://wa.me/{{ $data['comp_contact_1'] }}" target="_blank"><i class="fa fa-whatsapp text-success" style="font-size:24px"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button id="sellerForm" class="btn text-white btn-rounded mt-4"
                            style="background-color:#232475">
                            Submit
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


<!-- Request Assignint to sellers - Form Submit using Ajax -->
<script>
$('#sellerForm').click(function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get the selected checkbox values
    var selectedIds = $('input[name="sellerid"]:checked').map(function() {
        return $(this).val();
    }).get();

    // Do something with the selected IDs
    // console.log(selectedIds);

    var sellersId = selectedIds;
    var reqId = $('#requestid').val();
    console.log(sellersId);
    console.log(reqId);

    // You can also send the selected IDs to a server using AJAX if needed
    $.ajax({
        url: "{{ route('com-crp-submit') }}",
        type: 'POST',
        data: {
            makerequestId: reqId,
            sellerIds: sellersId,
            _token: '{{csrf_token()}}'
        },
        success: function(response) {
            // console.log('successfully');

            Swal.fire(
                'Success!',
                'The request has been assigned to selected sellers.',
                'success',
            )
            window.location = '/admin/current-requests';
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
});
</script>


@endsection