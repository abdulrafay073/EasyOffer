@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">General</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Sellers </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Current Deals</h4> -->
                    <div class="table-responsive d-block mt-4">
                        <table class="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>Customer Name</th>
                                    <th>Company Address</th>
                                    <th>Company Email</th>
                                    <th>Company Contact Number</th>
                                    <th>Designation</th>
                                    <th>Company Owner name</th>
                                    <th>Certifications (CMP, ISO, etc)</th>
                                    <th>DOB</th>
                                    <th>NTN No</th>
                                    <th>GST No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seller as $data)
                                <tr class="text-center">
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
                                    <td>{{ $data['dob_1'] }}</td>
                                    <td>{{ $data['ntn'] }}</td>
                                    <td>{{ $data['gst'] }}</td>
                                    <td class="px-2">
                                        <a href="{{ route('seller-viewdetail', $data->id) }}"
                                            class="btn text-white btn-rounded" style="background-color:#232475">
                                            View Detail
                                        </a>
                                        <a href="{{ route('seller-edit', $data->id) }}"
                                            class="btn text-white btn-rounded" style="background-color:#232475">
                                            Edit
                                        </a>
                                        <button type="button" class="btn text-white btn-rounded RatingButton"
                                            value="{{$data['userid']}}" data-toggle="modal" data-target="#ratingModal"
                                            style="background-color:#232475">
                                            Rating
                                        </button>
                                        <button type="button" class="btn text-white btn-rounded RemoveButton"
                                            value="{{$data['userid']}}" data-toggle="modal" data-target="#removeModal"
                                            style="background-color:#F01111">
                                            Remove
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

<div class="modal fade" id="ratingModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('seller-rating') }}" method="POST">
                @csrf

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Seller Rating</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input name="sellerid" id="rating_sellerid" value="" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn  text-white" style="background-color:#232475">Save</button>
                    <button type="button" class="btn btn-dark modalclose" data-dismiss="modal">Close</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="removeModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{ route('seller-remove') }}" method="POST">
                @csrf

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Reason</h4>
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <input name="sellerid" id="remove_sellerid" value="" hidden>
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
$('.RatingButton').on('click', function() { //use
    var id = $(this).val();
    // console.log(id);
    $('#rating_sellerid').val(id);

})

$('.RemoveButton').on('click', function() { //use
    var id = $(this).val();
    // console.log(id);
    $('#remove_sellerid').val(id);

})
</script>

@endsection