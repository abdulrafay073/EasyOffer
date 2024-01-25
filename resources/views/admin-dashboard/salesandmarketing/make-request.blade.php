@extends('layouts.dashboard.layout')

@section('content')

<style>
.itembutton {
    font-size: 15px;
    color: #fff;
    background-color: #5E72E4;
    border: transparent;
    border-radius: 20px;
    padding: 8px;
    width: 150px;
}
</style>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sales And Marketing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Make Request </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

                <form action="{{ route('sale-makerequest-submit') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        <!-- <div class="row" hidden>
                        <div class="col-md-1 mt-2"></div>
                        <div class="col-md-9 mt-2"><label style="font-weight: 500">Search Product</label>
                            <select class="js-example-basic-single" style="width: 100%">
                                <option selected disabled>Select Product Name</option>
                                <option value="AL">Alabama</option>
                                <option value="WY">Wyoming</option>
                                <option value="AM">America</option>
                                <option value="CA">Canada</option>
                                <option value="RU">Russia</option>
                            </select>
                        </div>
                        <div class="col-md-1 mt-4"><button class="btn text-white btn-rounded"
                                style="background-color:#232475; margin-top:12px">Add </button>
                        </div>
                        </div> -->

                        <div class="row" hidden>
                            <div class="col-md-3">
                                <label><b>Request ID#</b></label>
                                <input type="text" name="name" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="table-responsive d-block mt-4">
                            <table class="table" class="table table-striped">
                                <thead>
                                    <tr style="background-color: #CFCED1">
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Shipping Method</th>
                                        <th>Payment Method</th>
                                        <th>Required (local, import) </th>
                                        <th>Certifications</th>
                                        <th>Sample or Real purchase Check</th>
                                        <th hidden>Price</th>
                                        <th hidden>Time Duration</th>
                                        <th>Origin</th>
                                    </tr>
                                </thead>
                                <tbody id="items">
                                    <tr>
                                        <td>
                                            <select class="form-control" name="customername[]" style="width:200px">
                                                <option selected disabled>Select customer</option>
                                                @foreach($buyers as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['comp_name_1'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <!-- <select class="js-example-basic-single" name="product[]" style="width:200px"> -->
                                            <select class="form-control" name="product[]" style="width:200px">
                                                <option selected disabled>Select Product</option>
                                                @foreach($data as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="description[]"
                                                style="width:200px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="qty[]" style="width:100px" id="qty" >
                                        </td>
                                        <td>
                                            <select class="form-control" name="shipping[]" style="width:200px" id="shipping">
                                                <option selected disabled>Select Shipping</option>
                                                <option value="By Air">By Air</option>
                                                <option value="By Sea">By Sea</option>
                                                <option value="By Road">By Road</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="payment[]" style="width:200px">
                                                <option disabled>Select Payment</option>
                                                <option value="Advance T/T">Advance T/T</option>
                                                <option value="LC - sight" selected>LC - sight</option>
                                                <option value="LC - 30">LC - 30</option>
                                                <option value="LC - 60">LC - 60</option>
                                                <option value="LC - 90">LC - 90</option>
                                                <option value="BC - sight">BC - sight</option>
                                                <option value="BC - sight 30">BC - sight 30</option>
                                                <option value="BC - sight 60">BC - sight 60</option>
                                                <option value="BC - sight 90">BC - sight 90</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" name="required[]" style="width:200px">
                                                <option disabled>Select Required</option>
                                                <option value="Local">Local</option>
                                                <option value="Import" selected>Import</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="certification[]"
                                                style="width:200px">
                                        </td>
                                        <td>
                                            <input type="checkbox" class="form-control" name="sampleorreal[]">
                                        </td>
                                        <td hidden>
                                            <input type="text" class="form-control" name="price[]" style="width:150px">
                                        </td>
                                        <td hidden>
                                            <input type="text" class="form-control" name="timeduration[]"
                                                style="width:150px">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="origin[]" style="width:150px">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-4 pb-3">
                            <div class="col-md-12 mt-2 text-center">
                                <input name="addFieldButton" type="button" value="Add Items" onclick="addField();"
                                    class="itembutton">
                                <input name="delFieldButton" type="button" value="Remove Items" onclick="delField();"
                                    class="itembutton">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-rounded text-white" style="background-color:#232475">Add
                            Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $('#qty').on("keyup", function(){
    var qty = $(this).val();
    console.log(qty);

        if(qty > 100){
            $('#shipping').val("By Sea");
        }
        else if(qty < 100){
            $('#shipping').val("By Air");
        }
    })
</script>

<!-- Add Row Delete Row Functionalities -->
<script>
counter = -1;
var contract_selected = -1;

function addField() {
    counter++;

    var content = '';
    content += '<tr id="RequestItem_row_' + counter + '">';
    content += '    <td>';
    content += '       <select class="form-control" name="customername[]">';
    content += '            <option selected disabled>Select Customer</option>';
    content += '            @foreach($buyers as $item)';
    content += '                <option value="{{ $item["id"] }}">{{ $item["comp_name_1"] }}</option>';
    content += '            @endforeach';
    content += '        </select>'
    content += '    </td>';
    content += '    <td>';
    content += '       <select class="form-control" name="product[]">';
    content += '            <option selected disabled>Select Product</option>';
    content += '            @foreach($data as $item)';
    content += '                <option value="{{ $item["id"] }}">{{ $item["name"] }}</option>';
    content += '            @endforeach';
    content += '       </select>';
    content += '    </td>';
    content += '    <td>';
    content += '       <input type="text" name="description[]" class="form-control">';
    content += '    </td>';
    content += '    <td>';
    content += '       <input type="text" name="qty[]" class="form-control" id="qty_' + counter + '">';
    content += '    </td>';
    content += '    <td>';
    content += '       <select class="form-control" name="shipping[]" id="shipping_' + counter + '">';
    content += '            <option selected disabled> Select Shipping </option>';
    content += '            <option value="By Air">By Air</option>';
    content += '            <option value="By Sea">By Sea</option>';
    content += '            <option value="By Road">By Road</option>';
    content += '        </select>';
    content += '    </td>';
    content += '    <td>';
    content += '       <select class="form-control" name="payment[]">';
    content += '            <option disabled> Select Payment </option>';
    content += '            <option value="Advance T/T">Advance T/T</option>';
    content += '            <option value="LC - sight" selected>LC - sight</option>';
    content += '            <option value="LC - 30">LC - 30</option>';
    content += '            <option value="LC - 60">LC - 60</option>';
    content += '            <option value="LC - 90">LC - 90</option>';
    content += '            <option value="BC - sight">BC - sight</option>';
    content += '            <option value="BC - sight 30">BC - sight 30</option>';
    content += '            <option value="BC - sight 60">BC - sight 60</option>';
    content += '            <option value="BC - sight 90">BC - sight 90</option>';
    content += '        </select>';
    content += '    </td>';
    content += '    <td>';
    content += '       <select class="form-control" name="required[]">';
    content += '            <option disabled> Select Required </option>';
    content += '            <option value="Local">Local</option>';
    content += '            <option value="Import" selected>Import</option>';
    content += '        </select>';
    content += '    </td>';
    content += '    <td>';
    content += '       <input type="text" name="certification[]" class="form-control">';
    content += '    </td>';
    content += '    <td>';
    content += '       <input type="checkbox" name="sampleorreal[]" class="form-control">';
    content += '    </td>';
    content += '    <td hidden>';
    content += '       <input type="text" name="price[]" class="form-control">';
    content += '    </td>';
    content += '    <td hidden>';
    content += '       <input type="text" name="timeduration[]" class="form-control">';
    content += '    </td>';
    content += '    <td>';
    content += '       <input type="text" name="origin[]" class="form-control">';
    content += '    </td>';
    content += '</tr>';
    $('#items').append(content);

    // console.log(contract_selected);

    $('#qty_' + counter).on("keyup", function(){
    var qty = $(this).val();
    console.log(qty);

        if(qty > 100){
            $('#shipping_' + counter).val("By Sea");
        }
        else if(qty < 100){
            $('#shipping_' + counter).val("By Air");
        }
    })

}

function delField() {
    $("#RequestItem_row_" + counter).remove();
    counter--;
}
</script>

@endsection