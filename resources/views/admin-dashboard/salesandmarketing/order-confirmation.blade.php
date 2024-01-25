@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Sales And Marketing</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Confirmation Form </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
             
                    <form action="{{ route('sale-order-confirmation-submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 mt-4 text-right">
                                <h5>TO BE FILLED BY MARKETING PERSON</h5>
                            </div>
                            <div class="col-md-4 mt-3">
                                <!-- <label class="text-bold">Name</label> -->
                                <input type="text" class="form-control" name="mpname" placeholder="Name">
                            </div>
                            <div class="col-md-12">
                                <hr style="border: 2px solid #000">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Customer Name</label>
                                <select class="form-control" name="customername">
                                    <option selected disabled>Select Customer</option>
                                    @foreach($buyer as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['comp_name_1'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Supplier Name</label>
                                <select class="form-control" name="suppliername">
                                    <option selected disabled>Select Supplier</option>
                                    @foreach($seller as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['comp_name_1'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Product</label>
                                <input type="text" class="form-control" name="pname" placeholder="product name">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Price</label>
                                <input type="text" class="form-control" name="price" placeholder="price">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Qty</label>
                                <input type="text" class="form-control" name="qty" placeholder="qty">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Payment Term</label>
                                <input type="text" class="form-control" name="paymentterm" placeholder="payment term">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Mfg Name (If Trader)</label>
                                <input type="text" class="form-control" name="mfgname">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Shipment Mode</label>
                                <select class="form-control" name="shipmentmode">
                                    <option selected disabled>Select Mode</option>
                                    <option value="By Air">By Air</option>
                                    <option value="By Sea">By Sea</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Shipment Intimation</label>
                                <select class="form-control" name="shipmentintimation">
                                    <option selected disabled>Select Mode</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">PSS/W.S Requirement</label>
                                <input type="text" class="form-control" name="pssrequirement"
                                    placeholder="pss/w.s">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Shipment Requirements Any Other Instruction</label>
                                <input type="text" class="form-control" name="shipmentrequirement" placeholder="">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Customer Shipment Required Time</label>
                                <input type="text" class="form-control" name="customershipmenttime" placeholder="">
                            </div>
                            <!-- <div class="col-md-6 mt-4">
                                <label class="text-bold">Certifications (CMP, ISO etc) </label>
                                <div class="input-group col-xs-12">
                                    <input type="file" class="form-control" name="certification">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">
                                            <i class="mdi mdi-cloud-download menu-icon"></i>
                                        </button>
                                    </span>
                                </div>
                            </div> -->
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">LC Availability Date</label>
                                <input type="date" class="form-control" name="lcdate">
                            </div>

                            <div class="col-md-3 mt-4">
                                <label class="text-bold">Indent To Customer</label>
                                <select class="form-control" name="indentcustomer">
                                    <option selected disabled>Select Customer</option>
                                    @foreach($buyer as $item)
                                    <option value="{{ $item['comp_name_1'] }}">{{ $item['comp_name_1'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mt-4">
                                <label class="text-bold">To Supplier</label>
                                <select class="form-control" name="tosupplier">
                                    <option selected disabled>Select Supplier</option>
                                    @foreach($seller as $item)
                                    <option value="{{ $item['comp_name_1'] }}">{{ $item['comp_name_1'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12 mt-4">
                                <div class="table-responsive mt-4">
                                    <table class="table">
                                        <tbody>
                                            <tr class="text-center">
                                                <td>Pre-Shipment Coa Require</td>
                                                <td><input type="checkbox" class="form-control" name="preshipmentcoa"></td>
                                                <td>Shipment After ADC</td>
                                                <td><input type="checkbox" class="form-control" name="shipmentafteradc"></td>
                                                <td>DML</td>
                                                <td><input type="checkbox" class="form-control" name="dml"></td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>Pre-Shipment Docs For Approval</td>
                                                <td><input type="checkbox" class="form-control" name="preshipmentdocs"></td>
                                                <td>Lables For Approval</td>
                                                <td><input type="checkbox" class="form-control" name="lables"></td>
                                                <td>GMP</td>
                                                <td><input type="checkbox" class="form-control" name="gmp"></td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>Certificates</td>
                                                <td><input type="checkbox" class="form-control" name="certifictes"></td>
                                                <td>Images Before Shipment</td>
                                                <td><input type="checkbox" class="form-control" name="imagebeforeshipment"></td>
                                                <td>MOA</td>
                                                <td><input type="checkbox" class="form-control" name="moa"></td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>Pre-Inform Do/Yard/Origin Charges</td>
                                                <td><input type="checkbox" class="form-control" name="preinformcharges"></td>
                                                <td>Stability Data</td>
                                                <td><input type="checkbox" class="form-control" name="stability"></td>
                                                <td>SAFTA/FTA</td>
                                                <td><input type="checkbox" class="form-control" name="safta"></td>
                                            </tr>
                                            <tr class="text-center">
                                                <td style="line-height: 1.5">Material Availability Confirmation <br> By Commercial Department</td>
                                                <td><input type="checkbox" class="form-control" name="materialavailability"></td>
                                                <td>DMF</td>
                                                <td><input type="checkbox" class="form-control" name="dmf"></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12 mt-5 pb-5">
                                <button type="submit" class="btn text-white btn-rounded mr-2"
                                    style="background-color:#232475"> Confirm Order
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