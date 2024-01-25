@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Deals</a></li>
                <li class="breadcrumb-item active" aria-current="page">Current Deals</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Current Deals</h4> -->
                    <div class="table-responsive d-block mt-4 mb-4">
                        <table class="table" class="table table-striped">
                            <thead class="text-center">
                                <tr style="background-color: #CFCED1;">
                                    <th>OrderID</th>
                                    <th>Marketing Person Name</th>
                                    <th>Commercial Person Name</th>
                                    <th>Logistic Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach($dataArray as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['marketingperson_name'] }}</td>
                                    <td>{{ $item['commercialperson_name'] }}</td>
                                    <td>{{date('d-M-Y', strtotime($item['date']))}}</td>
                                    <td>
                                        <a class="btn text-white btn-rounded" style="background-color:#ffab2d">
                                            {{ $item['status'] }}
                                        </a>
                                    </td>
                                    <td class="px-2">
                                        <a href="{{ route('current-deals-viewdetails', $item['id']) }}" class="btn text-white btn-rounded" style="background-color:#232475">
                                            View Detail
                                        </a>
                                    </td>
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