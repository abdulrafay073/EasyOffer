@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Imoortant Matter</a></li>
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
                                    <th>Customer</th>
                                    <th>AssignTo</th>
                                    <th>ProductName</th>
                                    <th>Problem</th>
                                    <th>ProblemRated</th>
                                    <th>Status</th>
                                    <th>Solution</th>
                                    <th>Boss Feedback</th>
                                    <th>Manager Approval</th>
                                    <th>Resolve Time</th>
                                    <th>Issue Related</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @forelse($data as $item)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item->buyer->comp_name_1 ?? '-' }}</td>
                                    <td>{{ $item->seller->comp_name_1 ?? '-' }}</td>
                                    <td>{{ $item->product_name ?? '-' }}</td>
                                    <td>{{ $item->problem ?? '-' }}</td>
                                    <td>{{ $item->problem_rated ?? '-' }}</td>
                                    <td>{{ $item->status ?? '-' }}</td>
                                    <td>{{ $item->solution ?? '-' }}</td>
                                    <td>{{ $item->boss_feedback ?? '-' }}</td>
                                    <td>{{ $item->manager_approval ?? '-' }}</td>
                                    <td>{{ $item->resolve_time ?? '-' }}</td>
                                    <td>{{ $item->issue_related ?? '-' }}</td>
                                    <td class="px-2">
                                        <button class="btn btn-rounded" style="background-color:#232475">
                                            <a href="{{ route('update-matter', $item['id']) }}" style="color:#fff; text-decoration:none">
                                                Update
                                            </a>
                                        </button>
                                        <button class="btn text-white btn-rounded" style="background-color:#F01111">
                                            <a href="{{ route('delete-matter', $item['id']) }}" style="color:#fff; text-decoration:none">
                                                Delete
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="13" class="text-center">No Data Available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection