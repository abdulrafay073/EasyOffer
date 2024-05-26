@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Imoortant Matter</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Delete Matter </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
                    <!-- <h4 class="card-title">Add Matter</h4> -->
                    <!-- <p class="card-description">Basic form layout</p> -->
                    <form action="{{ route('submit-delete-matter') }}" method="POST" class="forms-sample">
                        @csrf

                        <input type="hidden" name="matterid" value="{{ $data->id }}" class="form-control">
                        <div class="row">
                            <div class="col-md-6">
                                <label><b>Customer Name</b></label>
                                <select disabled name="customer" class="form-control" required>
                                    <option disabled>Select Customer</option>
                                    @forelse ($buyers as $buyer)
                                    <option value="{{ $buyer->id }}" {{ $data->customer_id == $buyer->id ? 'selected' : '' }}>{{ $buyer->comp_name_1 }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label><b>Product</b></label>
                                <input readonly type="text" name="product" value="{{ $data->product_name }}" class="form-control" placeholder="Enter product">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Problem</b></label>
                                <input readonly type="text" name="problem" value="{{ $data->problem }}" class="form-control" placeholder="Enter problem">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Problem Rated</b></label>
                                <input readonly type="text" name="problemrated" value="{{ $data->problem_rated }}" class="form-control" placeholder="Enter problem rated">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Status</b></label>
                                <input readonly type="text" name="status" value="{{ $data->status }}" class="form-control" placeholder="Enter status">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Solution</b></label>
                                <input readonly type="text" name="solution" value="{{ $data->solution }}" class="form-control" placeholder="Solution">
                            </div>

                            <div class="col-md-12 mt-3">
                                <label><b>Boss Feedback</b></label>
                                <input readonly type="text" name="bossfeedback" value="{{ $data->boss_feedback }}" class="form-control" placeholder="Enter Feedback">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Manager Approval</b></label>
                                <input readonly type="text" name="managerapproval" value="{{ $data->manager_approval }}" class="form-control" placeholder="Manager approval">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Resolve Time</b></label>
                                <input readonly type="text" name="resolvetime" value="{{ $data->resolve_time }}" class="form-control" placeholder="Resolve time">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Issue Related</b></label>
                                <select disabled name="issuerelated" class="form-control">
                                    <option disabled>Select Issue</option>
                                    <option value="Supplier" {{ $data->issue_related == "Supplier" ? 'selected' : '' }}>Supplier</option>
                                    <option value="Customer" {{ $data->issue_related == "Customer" ? 'selected' : '' }}>Customer</option>
                                    <option value="Logistics" {{ $data->issue_related == "Logistics" ? 'selected' : '' }}>Logistics</option>
                                    <option value="Bd" {{ $data->issue_related == "Bd" ? 'selected' : '' }}>BD</option>
                                    <option value="Sample" {{ $data->issue_related == "Sample" ? 'selected' : '' }}>Sample</option>
                                    <option value="Marketing" {{ $data->issue_related == "Marketing" ? 'selected' : '' }}>Marketing</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Assign To</b></label>
                                <select disabled name="assignto" class="form-control" required>
                                    <option disabled>Select Assign Person</option>
                                    @forelse ($sellers as $seller)
                                    <option value="{{ $seller->id }}" {{ $data->assign_to == $seller->id ? 'selected' : '' }}>{{ $seller->comp_name_1 }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="col-md-12 mt-4 pb-4">
                                <button type="submit" class="btn text-white btn-rounded mr-2" style="background-color:#F01111">
                                    Delete
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