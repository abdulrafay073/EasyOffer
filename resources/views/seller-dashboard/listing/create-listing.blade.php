@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add Listing </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header" style="background-color:#B7CFE7">
                    <form action="{{ route('excel-listing') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 mt-2 text-center">
                                <label><b>Upload Listing </b></label>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group col-xs-12">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button" style="border-radius: 20px 0px 0px 20px">
                                            <i class="mdi mdi-cloud-download menu-icon"></i>
                                        </button>
                                    </span>
                                    <input type="file" class="form-control" name="uploadfile" id="uploadcsv" accept=".xlsx, .xls, .csv" required>
                                </div>
                            </div>
                            <div class="col-md-3 mt-1">
                                <button type="submit" class="btn text-white btn-rounded" style="background-color:#232475">
                                    <i class="mdi mdi-cloud-download menu-icon pr-1"></i>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body mt-2">
                    <!-- <h4 class="card-title">Add Listing</h4> -->
                    <!-- <p class="card-description">Basic form layout</p> -->
                    <form action="{{ route('create-listing') }}" method="POST" enctype='multipart/form-data' class="forms-sample">
                        @csrf

                        <div class="col-md-6">
                            <label class="text-bold">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Description</label>
                            <textarea type="text" name="description" rows="6" class="form-control" placeholder="Description"></textarea>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Price</label>
                            <input type="number" min=0 step="0.1" name="price" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Certification</label>
                            <input type="text" name="certification" class="form-control" placeholder="Certification Detail">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Capacity</label>
                            <input type="text" name="capacity" class="form-control" placeholder="Capacity">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="text-bold">Intermediate Manufacturing</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadiosBuyer" value="1" checked> Yes <i class="input-helper"></i></label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadiosSeller" value="0"> No <i class="input-helper"></i></label>
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
                            <button type="submit" class="btn text-white btn-rounded mr-2" style="background-color:#232475"> Add
                            </button>
                            <button class="btn btn-light btn-rounded">
                                <a href="{{ route('create-listing') }}" style="color:#000; text-decoration:none">Cancel</a>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection