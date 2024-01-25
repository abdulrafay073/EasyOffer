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
                    <form action="{{ route('excel-listings') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 mt-2 text-center">
                                <label><b>Upload Listing </b></label>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group col-xs-12">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button"
                                            style="border-radius: 20px 0px 0px 20px">
                                            <i class="mdi mdi-cloud-download menu-icon"></i>
                                        </button>
                                    </span>
                                    <input type="file" class="form-control" name="uploadfile" id="uploadcsv"
                                        accept=".xlsx, .xls, .csv" required>
                                </div>
                            </div>
                            <div class="col-md-3 mt-1">
                                <button type="submit" class="btn text-white btn-rounded"
                                    style="background-color:#232475">
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
                    <form action="{{ route('create-listings') }}" method="POST" class="forms-sample">
                        @csrf

                        <div class="col-md-6">
                            <label><b>Name</b></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                        </div>

                        <div class="col-md-12 mt-4 pb-4">
                            <button type="submit" class="btn text-white btn-rounded mr-2"
                                style="background-color:#232475">
                                Add
                            </button>
                            <button class="btn btn-light btn-rounded">
                                <a href="{{ route('create-listings') }}"
                                    style="color:#000; text-decoration:none">Cancel</a>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection