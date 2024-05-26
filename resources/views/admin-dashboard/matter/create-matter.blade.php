@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Imoortant Matter</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Add Matter </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
                    <!-- <h4 class="card-title">Add Matter</h4> -->
                    <!-- <p class="card-description">Basic form layout</p> -->
                    <form action="{{ route('create-matter') }}" method="POST" class="forms-sample">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <label><b>Customer Name</b></label>
                                <select name="customer" class="form-control" required>
                                    <option selected disabled>Select Customer</option>
                                    @forelse ($buyers as $buyer)
                                    <option value="{{ $buyer->id }}">{{ $buyer->comp_name_1 }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label><b>Product</b></label>
                                <input type="text" name="product" class="form-control" placeholder="Enter product">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Problem</b></label>
                                <input type="text" name="problem" class="form-control" placeholder="Enter problem">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Problem Rated</b></label>
                                <input type="text" name="problemrated" class="form-control" placeholder="Enter problem rated">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Status</b></label>
                                <input type="text" name="status" class="form-control" placeholder="Enter status">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Solution</b></label>
                                <input type="text" name="solution" class="form-control" placeholder="Solution">
                            </div>

                            <div class="col-md-12 mt-3">
                                <label><b>Boss Feedback</b></label>
                                <input type="text" name="bossfeedback" class="form-control" placeholder="Enter Feedback">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Manager Approval</b></label>
                                <input type="text" name="managerapproval" class="form-control" placeholder="Manager approval">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Resolve Time</b></label>
                                <input type="text" name="resolvetime" class="form-control" placeholder="Resolve time">
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Issue Related</b></label>
                                <select name="issuerelated" class="form-control">
                                    <option selected disabled>Select Issue</option>
                                    <option value="Supplier">Supplier</option>
                                    <option value="Customer">Customer</option>
                                    <option value="Logistics">Logistics</option>
                                    <option value="Bd">BD</option>
                                    <option value="Sample">Sample</option>
                                    <option value="Marketing">Marketing</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label><b>Assign To</b></label>
                                <select name="assignto" class="form-control" required>
                                    <option selected disabled>Select Assign Person</option>
                                    @forelse ($sellers as $seller)
                                    <option value="{{ $seller->id }}">{{ $seller->comp_name_1 }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            <div class="col-md-12 mt-4 pb-4">
                                <button type="submit" class="btn text-white btn-rounded mr-2" style="background-color:#232475">
                                    Submit
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