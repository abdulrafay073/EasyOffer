@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sales And Marketing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Email Marketing </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
                    <!-- <h4 class="card-title">Add Order Confirmation</h4> -->
                    <!-- <p class="card-description">Basic form layout</p> -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 mt-4">
                                <label class="text-bold">Email Text</label>
                                <textarea class="form-control" name="emailtext" rows=8>Email Text</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Upload</label>
                                <div class="input-group col-xs-12">
                                    <input type="file" class="form-control" name="upload">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">
                                            <i class="mdi mdi-cloud-download menu-icon"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">User List</label>
                                <select type="text" class="form-control">
                                    <option selected disabled>Select User</option>
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-md-12 mt-5 pb-5">
                                <button type="submit" class="btn text-white btn-rounded mr-2"
                                    style="background-color:#232475"> Email
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection