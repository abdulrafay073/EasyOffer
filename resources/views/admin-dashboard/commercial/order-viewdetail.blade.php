@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Commercial</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Confirmation Form Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
                    <!-- <h4 class="card-title">Add Order Confirmation</h4> -->
                    <!-- <p class="card-description">Basic form layout</p> -->
                
                    <div class="row">
                        <div class="col-md-8 mt-4 text-right">
                            <h5>TO BE FILLED BY MARKETING PERSON</h5>
                        </div>
                        <div class="col-md-4 mt-3">
                            <!-- <label class="text-bold">Name</label> -->
                            <input type="text" class="form-control" value="{{ $data->marketingperson_name }}" readonly>
                        </div>
                        <div class="col-md-12">
                            <hr style="border: 2px solid #000">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Customer Name</label>
                            <input type="text" class="form-control" value="{{ $buyer->comp_name_1 }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Supplier Name</label>
                            <input type="text" class="form-control" value="{{ $seller->comp_name_1 }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Product</label>
                            <input type="text" class="form-control" value="{{ $data->productname }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Price</label>
                            <input type="text" class="form-control" value="{{ $data->price }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Qty</label>
                            <input type="text" class="form-control" value="{{ $data->qty }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Payment Term</label>
                            <input type="text" class="form-control" value="{{ $data->paymentterm }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Mfg Name (If Tarader)</label>
                            <input type="text" class="form-control" value="{{ $data->mfgname }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Shipment Mode</label>
                            <input type="text" class="form-control" value="{{ $data->shipmentmode }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Shipment Intimation</label>
                            <input type="text" class="form-control" value="{{ $data->shipmentintimation }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">PSS/W.S Requirement</label>
                            <input type="text" class="form-control" value="{{ $data->pssrequirement }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Shipment Requirements Any Other Instruction</label>
                            <input type="text" class="form-control" value="{{ $data->shipmentrequirement }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Customer Shipment Required Time</label>
                            <input type="text" class="form-control" value="{{ $data->customershipmenttime }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">LC Availability Date</label>
                            <input type="date" class="form-control" value="{{ $data->lcdate }}" readonly>
                        </div>
                        <div class="col-md-3 mt-4">
                            <label class="text-bold">Indent To Customer</label>
                            <input type="text" class="form-control" value="{{ $buyer->comp_name_1 }}" readonly>
                        </div>
                        <div class="col-md-3 mt-4">
                            <label class="text-bold">To Supplier</label>
                            <input type="text" class="form-control" value="{{ $seller->comp_name_1 }}" readonly>
                        </div>

                        <div class="col-md-12 mt-4">
                            <div class="table-responsive mt-4">
                                <table class="table">
                                    <tbody>
                                        <tr class="text-center">
                                            <td>Pre-Shipment Coa Require</td>
                                            <td>
                                                @if($data->preshipmentcoa == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>Shipment After ADC</td>
                                            <td>
                                                @if($data->shipmentafteradc == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>DML</td>
                                            <td>
                                                @if($data->dml == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>Pre-Shipment Docs For Approval</td>
                                            <td>
                                                @if($data->preshipmentdocs == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>Lables For Approval</td>
                                            <td>
                                                @if($data->lables == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>GMP</td>
                                            <td>
                                                @if($data->gmp == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>Certificates</td>
                                            <td>
                                                @if($data->certifictes == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>Images Before Shipment</td>
                                            <td>
                                                @if($data->imagebeforeshipment == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>MOA</td>
                                            <td>
                                                @if($data->moa == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td>Pre-Inform Do/Yard/Origin Charges</td>
                                            <td>
                                                @if($data->preinformcharges == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>Stability Data</td>
                                            <td>
                                                @if($data->stability == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>SAFTA/FTA</td>
                                            <td>
                                                @if($data->safta == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="text-center">
                                            <td style="line-height: 1.5">Material Availability Confirmation <br> By Commercial Department</td>
                                            <td>
                                                @if($data->materialavailability == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td>DMF</td>
                                            <td>
                                                @if($data->dmf == 1)
                                                <input type="checkbox" class="form-control" checked>
                                                @else
                                                <input type="checkbox" class="form-control">
                                                @endif
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('order-confirmation-submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="salesmarketingorderid" value="{{ $data->id }}">
                        <div class="row mt-4">
                            <div class="col-md-8 mt-4 text-right">
                                <h5>TO BE FILLED BY COMMERCIAL PERSON</h5>
                            </div>
                            <div class="col-md-4 mt-3">
                                <!-- <label class="text-bold">Name</label> -->
                                <input type="text" class="form-control" placeholder="Name" name="cpname">
                            </div>
                            <div class="col-md-12">
                                <hr style="border: 2px solid #000">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Customer Name</label>
                                <select class="form-control" name="customername">
                                    <option selected disabled>Select Customer</option>
                                    @foreach($buyerlist as $item)
                                    <option value="{{ $item['id'] }}">{{ $item['comp_name_1'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Supplier Name</label>
                                <select class="form-control" name="suppliername">
                                    <option selected disabled>Select Supplier</option>
                                    @foreach($sellerlist as $item)
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
                                <label class="text-bold">Shipment Mode</label>
                                <select class="form-control" name="shipmentmode">
                                    <option selected disabled>Select Mode</option>
                                    <option value="By Air">By Air</option>
                                    <option value="By Sea">By Sea</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Payment Term</label>
                                <input type="text" class="form-control" name="paymentterm" placeholder="payment term">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Origin</label>
                                <input type="text" class="form-control" name="origin" placeholder="origin">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Material Availability</label>
                                <select class="form-control" name="materialavailability">
                                    <option selected disabled>Select Availability</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Mfg Name (If Tarader)</label>
                                <input type="text" class="form-control" name="mfgname">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Commission Decided</label>
                                <input type="text" class="form-control" name="commission">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Supplier Shipping Instructions</label>
                                <input type="text" class="form-control" name="supplierinstruction">
                            </div>
                            <div class="col-md-3 mt-4">
                                <label class="text-bold">Indent To Customer</label>
                                <select class="form-control" name="indentcustomer">
                                    <option selected disabled>Select Customer</option>
                                    @foreach($buyerlist as $item)
                                    <option value="{{ $item['comp_name_1'] }}">{{ $item['comp_name_1'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mt-4">
                                <label class="text-bold">To Supplier</label>
                                <select class="form-control" name="tosupplier">
                                    <option selected disabled>Select Supplier</option>
                                    @foreach($sellerlist as $item)
                                    <option value="{{ $item['comp_name_1'] }}">{{ $item['comp_name_1'] }}</option>
                                    @endforeach
                                </select>
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