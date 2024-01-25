@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Make Bid </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
                    <!-- <h4 class="card-title">Add Listing</h4> -->
                    <!-- <p class="card-description">Basic form layout</p> -->
                    <form>
                        <!-- <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <label class="mt-3"><b>Search Product</b></label>
                            </div>
                            <div class="col-md-8 mt-2">
                                <select class="js-example-basic-single" style="width: 100%;">
                                    <option selected disabled>Search Product</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    <option value="AM">America</option>
                                    <option value="CA">Canada</option>
                                    <option value="RU">Russia</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Customer name</label>
                                <input type="text" class="form-control" placeholder="customer name">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Products</label>
                                <input type="text" class="form-control" placeholder="products">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Qty</label>
                                <input type="text" class="form-control" placeholder="qty">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Shipping Method</label>
                                <input type="text" class="form-control" placeholder="shipping method">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Payment Method</label>
                                <input type="text" class="form-control" placeholder="payment method">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Origin</label>
                                <input type="text" class="form-control" placeholder="origin">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Required (local, import) </label>
                                <input type="text" class="form-control" placeholder="required (local, import), ">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Description</label>
                                <input type="text" class="form-control" placeholder="description">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Certifications (CMP, ISO etc) </label>
                                <div class="input-group col-xs-12">
                                    <input type="file" class="form-control" placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">
                                            <i class="mdi mdi-cloud-download menu-icon"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Time Duration</label>
                                <input type="text" class="form-control" placeholder="time">
                            </div>
                            <div class="col-md-6 mt-4 ml-4">
                                <label>
                                    <input type="checkbox" class="form-check-input">
                                    <small>Sample Or Real Purchase</small>
                                    <i class="input-helper"></i>
                                </label>
                            </div>

                            <div class="col-md-12 mt-5 pb-5">
                                <button type="submit" class="btn text-white btn-rounded mr-2"
                                    style="background-color:#232475"> Make Bid
                                </button>
                                <button class="btn btn-light btn-rounded">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection