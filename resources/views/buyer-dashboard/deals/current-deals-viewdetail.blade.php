@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Deals</a></li>
                <li class="breadcrumb-item" aria-current="page">Current Deal</li>
                <li class="breadcrumb-item active" aria-current="page">ViewDetail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(to left, #6babd6 0%, #cbd8ec 100%)">
                                    <h5><i class="mdi mdi-check-decagram"></i> Purchase Confirmation</h5>
                                </div>
                                <div class="card-body p-5">

                                    <div class="row text-center">
                                        <div class="col-lg-12">                                    
                                            @if($logData->status == "Order Confirmed")
                                                <h5>Not Confirmation Yet</h5>
                                            @else
                                                <button type="button" class="btn text-white btn-rounded" onclick="CreatePDFfromHTML()"
                                                style="background-color:#232475">
                                                <i class="mdi mdi-download mr-1"></i> Download PDF
                                                </button>  

                                                @if($logData->status == "Purchase Deal Confirmed" || $logData->status == "Sale Deal Confirmed" || $logData->status == "Sale Deal Cancelled" || $logData->status == "LC Issued" || $logData->status == "Shipment Docs Completed" || $logData->status == "Payment Issued" || $logData->status == "Material Received" || $logData->status == "Margin Received" || $logData->status == "Order Completed")
                                                    <h5 class="mt-4 text-success">Purchase Deal has been confirmed by seller.</h5>
                                                @elseif($logData->status == "Purchase Deal Cancelled")
                                                    <h5 class="mt-4" style="color: #F01111">Purchase Deal has been cancelled by seller.</h5>
                                                @endif
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(to left, #6babd6 0%, #cbd8ec 100%)">
                                    <h5><i class="mdi mdi-sale"></i> Sale Confirmation</h5>
                                </div>
                                <div class="card-body p-5">
                                    
                                    <div class="row text-center">
                                        <div class="col-lg-12">
                                            @if ($logData->status == "Order Confirmed")
                                                <h5>Not Started Yet</h5>
                                            @elseif($logData->status == "Purchase Deal Confirmed" || $logData->status == "Sale Deal Confirmed" || $logData->status == "Sale Deal Cancelled" || $logData->status == "LC Issued" || $logData->status == "Shipment Docs Completed" || $logData->status == "Payment Issued" || $logData->status == "Material Received" || $logData->status == "Margin Received" || $logData->status == "Order Completed")
                                                <button type="button" class="btn text-white btn-rounded" onclick="CreatePDFfromHTML()"
                                                style="background-color:#232475">
                                                <i class="mdi mdi-download mr-1"></i> Download PDF
                                                </button>

                                                @if($logData->status == "Purchase Deal Confirmed")
                                                <form action="{{ route('sale-confirm') }}" method="POST" style="display:inline!important">
                                                    @csrf
                                                    <input type="hidden" name="logistic_id" value="{{ $logData->id }}">
                                                    <button type="submit" class="btn text-white btn-rounded"
                                                        style="background-color:#237549">
                                                        Confirm
                                                    </button>
                                                </form>

                                                <form action="{{ route('sale-cancel') }}" method="POST" style="display:inline!important">
                                                    @csrf
                                                    <input type="hidden" name="logistic_id" value="{{ $logData->id }}">
                                                    <button type="submit" class="btn text-white btn-rounded"
                                                        style="background-color:#F01111">
                                                        Cancel
                                                    </button>
                                                </form>
                                                @else
                                                    @if($logData->status == "Sale Deal Confirmed" || $logData->status == "LC Issued" || $logData->status == "Shipment Docs Completed" || $logData->status == "Payment Issued" || $logData->status == "Material Received" || $logData->status == "Margin Received" || $logData->status == "Order Completed")
                                                        <h5 class="mt-4 text-success">Sale Deal has been confirmed by you.</h5>
                                                    @elseif($logData->status == "Sale Deal Cancelled")
                                                        <h5 class="mt-4" style="color: #F01111">Sale Deal has been cancelled by you.</h5>
                                                    @endif
                                                @endif 
                                            @else
                                                <h5 style="color: #F01111">Deal Cancelled</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(to left, #6babd6 0%, #cbd8ec 100%)">
                                    <h5><i class="mdi mdi-playstation"></i> LC Issue</h5>
                                </div>
                                <div class="card-body p-5">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if ($logData->status == "Order Confirmed" || $logData->status == "Purchase Deal Confirmed")
                                                <h5 class="text-center">Not Started Yet</h5>
                                            @elseif($logData->status == "Sale Deal Confirmed")
                                                <form action="{{ route('lc-issue') }}" method="POST" enctype="multipart/form-data" style="display:inline!important">
                                                    @csrf

                                                    <input type="hidden" name="logistic_id" value="{{ $logData->id }}">
                                                    <div>
                                                        <label class="fw-bold">LC Attachment</label>
                                                        <div class="input-group col-xs-12">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary" type="button" style="border-radius: 20px 0px 0px 20px">
                                                                    <i class="mdi mdi-cloud-download menu-icon"></i>
                                                                </button>
                                                            </span>
                                                            <input type="file" class="form-control" name="lcdoc">
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <label>Note</label>
                                                        <textarea name="note" class="form-control" cols="30" rows="8"></textarea>            
                                                    </div>
                                                
                                                    <button type="submit" class="btn text-white btn-rounded mt-4"
                                                        style="background-color:#232475">
                                                        Submit
                                                    </button>
                                                </form>
                                            @elseif($logData->status == "LC Issued" || $logData->status == "Shipment Docs Completed" || $logData->status == "Payment Issued" || $logData->status == "Material Received" || $logData->status == "Margin Received" || $logData->status == "Order Completed")
                                                <h5 class="text-success" style="text-align:center">LC has been issued successfully.</h5>
                                            @else
                                                <h5 style="text-align:center; color: #F01111">Deal Cancelled</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(to left, #6babd6 0%, #cbd8ec 100%)">
                                    <h5><i class="mdi mdi-wallet-membership"></i> Shipment Docs (Invoice, Packing List, Coa, BL, Awb, Fta, Gmp, Form3, Form7, Tracking Id, Material Tracking Id)</h5>
                                </div>
                                <div class="card-body p-5">
                                    
                                    <div class="row text-center">
                                        <div class="col-lg-12">
                                            @if ($logData->status == "Order Confirmed" || $logData->status == "Purchase Deal Confirmed" || $logData->status == "Sale Deal Confirmed" || $logData->status == "LC Issued")
                                                <h5>Not Started Yet</h5>
                                            @elseif($logData->status == "Shipment Docs Completed" || $logData->status == "Payment Issued" || $logData->status == "Material Received" || $logData->status == "Margin Received" || $logData->status == "Order Completed")
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_invoice_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download Invoice
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_packing_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download Packing List
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_coa_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download Coa
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_bl_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download BL
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_awb_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download Awb
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_fta_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download Fta
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_gmp_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download Gmp
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_form3_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download Form3
                                                            </a>
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <button class="btn btn-rounded" style="background-color: #232475; width: 215px">
                                                            <a href="{{ $orderprocess->ship_form7_file }}" download style="color:#fff; text-decoration:none">
                                                                <i class="mdi mdi-download mr-1"></i> Download Form7
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row text-left mt-5">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-4">
                                                        <label class="fw-bold">Tracking ID</label>
                                                        <input type="text" value="{{ $orderprocess->ship_trackingid }}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="fw-bold">Material Tracking ID</label>
                                                        <input type="text" value="{{ $orderprocess->ship_materialtrackingid }}" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            @else
                                                <h5 style="color: #F01111">Deal Cancelled</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(to left, #6babd6 0%, #cbd8ec 100%)">
                                    <h5><i class="mdi mdi-cash"></i> Payment Issue</h5>
                                </div>
                                <div class="card-body p-5">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if ($logData->status == "Order Confirmed" || $logData->status == "Purchase Deal Confirmed" || $logData->status == "Sale Deal Confirmed" || $logData->status == "LC Issued")
                                                <h5 class="text-center">Not Started Yet</h5>
                                            @elseif($logData->status == "Shipment Docs Completed")
                                                <form action="{{ route('payment-issue') }}" method="POST" enctype="multipart/form-data" style="display:inline!important">
                                                    @csrf

                                                    <input type="hidden" name="logistic_id" value="{{ $logData->id }}">
                                                    <div>
                                                        <label class="fw-bold">Payment Receipt</label>
                                                        <div class="input-group col-xs-12">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary" type="button" style="border-radius: 20px 0px 0px 20px">
                                                                    <i class="mdi mdi-cloud-download menu-icon"></i>
                                                                </button>
                                                            </span>
                                                            <input type="file" class="form-control" name="payreceipt">
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                        <label>Note</label>
                                                        <textarea name="note" class="form-control" cols="30" rows="8"></textarea>            
                                                    </div>
                                                
                                                    <button type="submit" class="btn text-white btn-rounded mt-4"
                                                        style="background-color:#232475">
                                                        Submit
                                                    </button>
                                                </form>
                                            @elseif($logData->status == "Payment Issued" || $logData->status == "Material Received" || $logData->status == "Margin Received" || $logData->status == "Order Completed")
                                                <h5 class="text-success" style="text-align:center">Payment Receipt has been issued successfully.</h5>
                                            @else
                                                <h5 style="text-align:center; color: #F01111">Deal Cancelled</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(to left, #6babd6 0%, #cbd8ec 100%)">
                                    <h5><i class="mdi mdi-repeat"></i> Material Receiving Confirmation</h5>
                                </div>
                                <div class="card-body p-5">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if ($logData->status == "Order Confirmed" || $logData->status == "Purchase Deal Confirmed" || $logData->status == "Sale Deal Confirmed" || $logData->status == "LC Issued" || $logData->status == "Shipment Docs Completed")
                                                <h5 class="text-center">Not Started Yet</h5>
                                            @elseif($logData->status == "Payment Issued")
                                                <form action="{{ route('material-confirmation') }}" method="POST" style="display:inline!important">
                                                    @csrf

                                                    <input type="hidden" name="logistic_id" value="{{ $logData->id }}">
                                                    <div>
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" name="mtreceiving" class="form-check-input"
                                                                        style="margin-top:-3px" required>
                                                                    Material Received Confirmation
                                                                </label>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <button type="submit" class="btn text-white btn-rounded"
                                                        style="background-color:#232475">
                                                        Submit
                                                    </button>
                                                </form>
                                            @elseif($logData->status == "Material Received" || $logData->status == "Margin Received" || $logData->status == "Order Completed")
                                                <h5 class="text-success" style="text-align:center">Material has been received successfully.</h5>
                                            @else
                                                <h5 style="text-align:center; color: #F01111">Deal Cancelled</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(to left, #6babd6 0%, #cbd8ec 100%)">
                                    <h5><i class="mdi mdi-kodi"></i> Margin Received</h5>
                                </div>
                                <div class="card-body p-5">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if ($logData->status == "Order Confirmed" || $logData->status == "Purchase Deal Confirmed" || $logData->status == "Sale Deal Confirmed" || $logData->status == "LC Issued" || $logData->status == "Shipment Docs Completed" || $logData->status == "Payment Issued")
                                                <h5 class="text-center">Not Started Yet</h5>
                                            @elseif($logData->status == "Material Received")
                                                <form action="{{ route('margin-received') }}" method="POST" enctype="multipart/form-data" style="display:inline!important">
                                                    @csrf

                                                    <input type="hidden" name="logistic_id" value="{{ $logData->id }}">
                                                    <div>
                                                        <label class="fw-bold">Margin Attachment</label>
                                                        <div class="input-group col-xs-12">
                                                            <span class="input-group-append">
                                                                <button class="file-upload-browse btn btn-primary" type="button" style="border-radius: 20px 0px 0px 20px">
                                                                    <i class="mdi mdi-cloud-download menu-icon"></i>
                                                                </button>
                                                            </span>
                                                            <input type="file" class="form-control" name="marginreceived">
                                                        </div>
                                                    </div>
                                
                                                    <button type="submit" class="btn text-white btn-rounded mt-5"
                                                        style="background-color:#232475">
                                                        Submit
                                                    </button>
                                                </form>
                                            @elseif($logData->status == "Margin Received" || $logData->status == "Order Completed")
                                                <h5 class="text-success" style="text-align:center">Margin has been received successfully.</h5>
                                            @else
                                                <h5 style="text-align:center; color: #F01111">Deal Cancelled</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-2">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(to left, #6babd6 0%, #cbd8ec 100%)">
                                    <h5><i class="mdi mdi-briefcase-check"></i> Feedback</h5>
                                </div>
                                <div class="card-body p-5">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if ($logData->status == "Order Confirmed" || $logData->status == "Purchase Deal Confirmed" || $logData->status == "Sale Deal Confirmed" || $logData->status == "LC Issued" || $logData->status == "Shipment Docs Completed" || $logData->status == "Payment Issued" || $logData->status == "Material Received")
                                                <h5 class="text-center">Not Started Yet</h5>
                                            @elseif($logData->status == "Margin Received")
                                                <form action="{{ route('feedback') }}" method="POST" style="display:inline!important">
                                                    @csrf

                                                    <input type="hidden" name="logistic_id" value="{{ $logData->id }}">
                                                    <div>
                                                        <label>Note</label>
                                                        <textarea name="note" class="form-control" cols="30" rows="8"></textarea>            
                                                    </div>
                                                
                                                    <button type="submit" class="btn text-white btn-rounded mt-5"
                                                        style="background-color:#232475">
                                                        Submit
                                                    </button>
                                                </form>
                                            @elseif($logData->status == "Order Completed")
                                                <h5 class="text-success" style="text-align:center">Feedback has been submitted successfully.</h5>
                                            @else
                                                <h5 style="text-align:center; color: #F01111">Deal Cancelled</h5>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 500px"></div>

                    <!-- this is order confirmation form start-->
                    <div class="html-content">
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

                        <div class="row mt-4 mb-5 pb-5">
                            <div class="col-md-12 mt-4 text-center">
                                <h5>FOR LOGISTICS DEPARTMENT</h5>
                            </div>

                            <div class="col-md-12">
                                <hr style="border: 2px solid #000">
                            </div>

                            <div class="col-md-12 mt-4">
                                <label class="text-bold">Any Special Instructions From Customer</label>
                                <input type="text" class="form-control" value="{{ $logData->instruction_from_customer }}" readonly>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="text-bold">Any Special Instructions From Supplier</label>
                                <input type="text" class="form-control" value="{{ $logData->instruction_from_supplier }}" readonly>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="text-bold">Any Other Instructions/Remarks</label>
                                <input type="text" class="form-control" value="{{ $logData->remarks }}" readonly>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Indent Send To Customer</label>
                                <input type="text" class="form-control" value="{{ $logData->indent_sendto_customer }}" readonly>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Indent Send To Supplier</label>
                                <input type="text" class="form-control" value="{{ $logData->indent_sendto_supplier }}" readonly>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">SC Required</label>
                                <input type="text" class="form-control" value="{{ $logData->sc_required }}" readonly>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">CA Required</label>
                                <input type="text" class="form-control" value="{{ $logData->ca_required }}" readonly>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label class="text-bold">Reason For Holding The Indent</label>
                                <input type="text" class="form-control" value="{{ $logData->reason }}" readonly>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Customer Contact Person</label>
                                <input type="text" class="form-control" value="{{ $logData->customer_contactperson }}" readonly>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label class="text-bold">Supplier Contact Person</label>
                                <input type="text" class="form-control" value="{{ $logData->supplier_contactperson }}" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- this is order confirmation form end-->

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$( document ).ready(function() {
    $('.html-content').css("visibility", "hidden");
});
</script>

<!-- //Create PDf from HTML... -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script>
function CreatePDFfromHTML() {
    $('.html-content').css("visibility", "visible");

    var HTML_Width = $(".html-content").width();
    var HTML_Height = $(".html-content").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".html-content")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("PurchaseOrder.pdf");
        // $(".html-content").hide();
        $('.html-content').css("visibility", "hidden");

    });
}
</script>


@endsection