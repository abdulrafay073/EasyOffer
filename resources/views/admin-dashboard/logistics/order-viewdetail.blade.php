@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Logistics</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Confirmation Form Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
                
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

                    <div class="row mt-4">
                        <div class="col-md-8 mt-4 text-right">
                            <h5>TO BE FILLED BY COMMERCIAL PERSON</h5>
                        </div>
                        <div class="col-md-4 mt-3">
                            <!-- <label class="text-bold">Name</label> -->
                            <input type="text" class="form-control" value="{{ $commData->commercialperson_name }}" readonly>
                        </div>
                        <div class="col-md-12">
                            <hr style="border: 2px solid #000">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Customer Name</label>
                            <input type="text" class="form-control" value="{{ $commbuyer->comp_name_1 }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Supplier Name</label>
                            <input type="text" class="form-control" value="{{ $commseller->comp_name_1 }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Product</label>
                            <input type="text" class="form-control" value="{{ $commData->productname }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Price</label>
                            <input type="text" class="form-control" value="{{ $commData->price }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Qty</label>
                            <input type="text" class="form-control" value="{{ $commData->qty }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Shipment Mode</label>
                            <input type="text" class="form-control" value="{{ $commData->shipmentmode }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Payment Term</label>
                            <input type="text" class="form-control" value="{{ $commData->paymentterm }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Origin</label>
                            <input type="text" class="form-control" value="{{ $commData->origin }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Material Availability</label>
                            <input type="text" class="form-control" value="{{ $commData->materialavailability }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Mfg Name (If Tarader)</label>
                            <input type="text" class="form-control" value="{{ $commData->mfgname }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Commission Decided</label>
                            <input type="text" class="form-control" value="{{ $commData->commissiondecided }}" readonly>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Supplier Shipping Instructions</label>
                            <input type="text" class="form-control" value="{{ $commData->supplierinstructions }}" readonly>
                        </div>
                        <div class="col-md-3 mt-4">
                            <label class="text-bold">Indent To Customer</label>
                            <input type="text" class="form-control" value="{{ $commData->indentcustomer }}" readonly>
                        </div>
                        <div class="col-md-3 mt-4">
                            <label class="text-bold">To Supplier</label>
                            <input type="text" class="form-control" value="{{ $commData->tosupplier }}" readonly>
                        </div>
                    </div>

                    <form action="{{ route('logistics-order-confirmation-submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="commercialorderid" value="{{ $commData->id }}">
                        <div class="row mt-4">
                            <div class="col-md-12 mt-4 text-center">
                                <h5>FOR LOGISTICS DEPARTMENT</h5>
                            </div>

                            <div class="col-md-12">
                                <hr style="border: 2px solid #000">
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="text-bold">Any Special Instructions From Customer</label>
                                <input type="text" class="form-control" name="instructionfromcustomer">
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="text-bold">Any Special Instructions From Supplier</label>
                                <input type="text" class="form-control" name="instructionfromsupplier">
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="text-bold">Any Other Instructions/Remarks</label>
                                <input type="text" class="form-control" name="instructionremarks">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Indent Send To Customer</label>
                                <select class="form-control" name="indenttocustomer">
                                    <option selected disabled>Select Indent</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Indent Send To Supplier</label>
                                <select class="form-control" name="indenttosupplier">
                                    <option selected disabled>Select Indent</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">SC Required</label>
                                <select class="form-control" name="screquired">
                                    <option selected disabled>Select SC</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">CA Required</label>
                                <select class="form-control" name="carequired">
                                    <option selected disabled>Select CA</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="text-bold">Reason For Holding The Indent</label>
                                <input type="text" class="form-control" name="reason">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Customer Contact Person</label>
                                <select class="form-control" name="customercontactperson">
                                    <option selected disabled>Select Customer</option>
                                    @foreach($buyerlist as $item)
                                    <option value="{{ $item['comp_name_1'] }}">{{ $item['comp_name_1'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Supplier Contact Person</label>
                                <select class="form-control" name="suppliercontactperson">
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
                    <form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection