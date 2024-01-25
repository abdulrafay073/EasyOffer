@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Finance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Expenses</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('submit-expenses') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Expense Type</label>
                                <input type="text" class="form-control" name="exptype" placeholder="Expense Type">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Amount</label>
                                <input type="text" class="form-control" name="amount" placeholder="Amount">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Date</label>
                                <input type="date" class="form-control" name="datetime" placeholder="DateTime">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Person</label>
                                <input type="text" class="form-control" name="person" placeholder="Person">
                            </div>

                            <div class="col-md-12 mt-4 pb-5">
                                <button type="submit" class="btn text-white btn-rounded mr-2"
                                    style="background-color:#232475"> Add Expense
                                </button>
                            </div>
                        </div>
                    </form>

                    <h4 class="card-title">All Expenses</h4>
                    <div class="table-responsive d-block pb-4">
                        <table class="table" class="table table-striped">
                            <thead>
                                <tr style="background-color: #CFCED1">
                                    <th>ID</th>
                                    <th>Expense Type</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Person</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $item['expense_type'] }}</td>
                                    <td>{{ $item['amount'] }}</td>
                                    <td>{{ date('d-M-Y', strtotime($item['datetime'])) }}</td>
                                    <td>{{ $item['person'] }}</td>
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