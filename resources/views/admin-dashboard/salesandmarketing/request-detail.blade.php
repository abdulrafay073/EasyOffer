@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sales And Marketing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Request Details </li>
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
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Shipping Method</th>
                                    <th>Payment Method</th>
                                    <th>Origin</th>
                                    <th>Required (local, import) </th>
                                    <th>Description</th>
                                    <th>Certifications</th>
                                    <th>Sample or Real purchase Check</th>
                                    <th>Price</th>
                                    <th>Time Duration</th>
                                    <th>Seller Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="px-2">
                                        <a href="" class="btn text-white btn-rounded" style="background-color:#237549">
                                            View Detail
                                        </a>
                                        <button class="btn text-white btn-rounded" style="background-color:#232475">
                                            Give Response
                                        </button>
                                        <button class="btn text-white btn-rounded" style="background-color:#F01111">
                                            Cancel
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection