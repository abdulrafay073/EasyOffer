@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">System Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Terms And Consitions Management</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label><b>Term</b></label>
                                <input type="text" class="form-control" name="term" placeholder="Term">
                            </div>

                            <div class="col-md-12 mt-4 pb-5">
                                <button type="button" class="btn text-white btn-rounded mr-2"
                                    style="background-color:#232475"> Add Term
                                </button>
                            </div>
                        </div>
                    </form>

                    <h4 class="card-title">All Terms</h4>
                    <div class="table-responsive d-block pb-4">
                        <table class="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>Term</th>
                                    <th>CreatedDateTime</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="px-2">
                                        <a href="" class="btn text-white btn-rounded" style="background-color:#232475">
                                            Remove
                                        </a>
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