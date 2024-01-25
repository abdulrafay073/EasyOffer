@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Finance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Receivables</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('submit-receivables') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Invoice</label>
                                <div class="input-group col-xs-12">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button"
                                            style="border-radius: 20px 0px 0px 20px">
                                            <i class="mdi mdi-cloud-download menu-icon"></i>
                                        </button>
                                    </span>
                                    <input type="file" class="form-control" name="invoice">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Remaining</label>
                                <input type="text" class="form-control" name="remaining" placeholder="Remaining">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Received</label>
                                <input type="text" class="form-control" name="received" placeholder="Received">
                            </div>

                            <div class="col-md-12 mt-4 pb-5">
                                <button type="submit" class="btn text-white btn-rounded mr-2"
                                    style="background-color:#232475"> Add Receivable
                                </button>
                            </div>
                        </div>
                    </form>

                    <h4 class="card-title">All Receivables</h4>
                    <div class="table-responsive d-block pb-4">
                        <table class="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>ID</th>
                                    <th>Invoice</th>
                                    <th>Remaining</th>
                                    <th>Received</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>
                                        <a href="{{ asset($item['invoice_file']) }}" target="_blank"
                                            class="text-primary text-center">
                                            View uploaded ( Picture / Document )
                                        </a>
                                    </td>
                                    <td>{{ $item['remaining'] }}</td>
                                    <td>{{ $item['received'] }}</td>
                                    <td>{{ date('d-M-Y', strtotime($item['created_at'])) }}</td>
                                    <td> Pending </td>
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

@endsection