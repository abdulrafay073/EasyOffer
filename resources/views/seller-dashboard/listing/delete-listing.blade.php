@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Delete Listing </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header" style="background-color: #f96868">
                    <h4 class="mt-2">Are you sure you want to delete this Listing ?</h4>
                </div>
                <div class="card-body mt-2">
                    <!-- <h4 class="card-title">Update Listing</h4> -->
                    <!-- <p class="card-description">Basic form layout</p> -->

                    <form action="{{ route('submit-dellisting') }}" method="POST" class="forms-sample">
                        @csrf

                        <input type="hidden" name="listingid" value="{{$data['id']}}" class="form-control">
                        <div class="col-md-6">
                            <label class="text-bold">Name</label>
                            <input type="text" name="editname" class="form-control" value="{{ $data['name'] }}"
                                readonly>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Description</label>
                            <textarea type="text" name="editdescription" rows="6" class="form-control"
                                placeholder="Description" readonly>{{ $data['description'] }}</textarea>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Certification</label>
                            <input type="text" name="editcertification" class="form-control"
                                value="{{ $data['certification'] }}" readonly>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Capacity</label>
                            <input type="text" name="editcapacity" class="form-control" value="{{ $data['capacity'] }}"
                                readonly>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Intermediate Manufacturing</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            @if($data['intermediate_manufacturing'] == 1)
                                            <input type="radio" class="form-check-input" name="editoptionsRadios"
                                                id="optionsRadiosBuyer" value="1" checked> Yes
                                            @else
                                            <input type="radio" class="form-check-input" name="editoptionsRadios"
                                                id="optionsRadiosBuyer" value="1"> Yes
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            @if($data['intermediate_manufacturing'] == 0)
                                            <input type="radio" class="form-check-input" name="editoptionsRadios"
                                                id="optionsRadiosBuyer" value="0" checked> No
                                            @else
                                            <input type="radio" class="form-check-input" name="editoptionsRadios"
                                                id="optionsRadiosBuyer" value="0"> No
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <small>
                                Send me updates about Tropical Inspire products and services.
                                <span style="color: #232475">Privacy policy</span>
                            </small>
                        </div>

                        <div class="col-md-12 mt-4 pb-4">
                            <button type="submit" class="btn text-white btn-rounded mr-2"
                                style="background-color:#232475"> Delete
                            </button>
                            <button class="btn btn-light btn-rounded">
                                <a href="{{ route('listings') }}" style="color:#000; text-decoration:none">Back</a>
                            </button>
                        </div>

                    </form>
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection