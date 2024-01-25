@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Current Request </li>
                <li class="breadcrumb-item active" aria-current="page"> Placed Bid </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Current Deals</h4> -->
                    <div class="table-responsive d-block mt-4 pb-4">
                        <table class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>ID #</th>
                                    <th>Reqeust ID #</th>
                                    <th>Seller Name</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($dataArray as $item)
                                <tr class="text-center">
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item['buyer_reqId']  }}</td>
                                    <td>{{ $item['sellername'] }}</td>
                                    <td>{{ $item['customername'] }}</td>
                                    <td>{{ date('d-M-Y', strtotime($item['date'])) }}</td>
                                    <td class="px-2">
                                        <a href="{{ route('com-current-requests-placebid-viewdetail', $item['id']) }}"
                                            class="btn text-white btn-rounded" style="background-color:#00CCCD">
                                            View Detail
                                        </a>

                                        <form action="{{ route('com-current-requests-placebid-proceed') }}"
                                            method="POST" style="display:inline!important">
                                            @csrf
                                            <input type="hidden" name="placedbidid" value="{{ $item['id'] }}">

                                            @if( $item['proceed'] == 0 )
                                            <button type="submit" class="btn text-white btn-rounded"
                                                style="background-color:#237549">
                                                Proceed
                                            </button>
                                            @else
                                            <button disabled class="btn text-white btn-rounded"
                                                style="background-color:#237549">
                                                <i class="mdi mdi-block-helper" style="font-size:13px"></i>
                                                Proceed
                                            </button>
                                            @endif
                                        </form>

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