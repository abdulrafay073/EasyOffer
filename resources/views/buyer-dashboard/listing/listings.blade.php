@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Listings </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Current Deals</h4> -->
                    <div class="table-responsive d-block mt-4 pb-4">
                        <table class="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td class="px-2">
                                        <button class="btn btn-rounded" style="background-color:#232475">
                                            <a href="{{ route('update-listings', $item['id']) }}"
                                                style="color:#fff; text-decoration:none">
                                                Update
                                            </a>
                                        </button>
                                        <button class="btn text-white btn-rounded" style="background-color:#F01111">
                                            <a href="{{ route('delete-listings', $item['id']) }}"
                                                style="color:#fff; text-decoration:none">
                                                Delete
                                            </a>
                                        </button>
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