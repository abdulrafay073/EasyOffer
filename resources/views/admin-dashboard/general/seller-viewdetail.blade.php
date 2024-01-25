@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">General</li>
                <li class="breadcrumb-item active" aria-current="page">Seller</li>
                <li class="breadcrumb-item active" aria-current="page">View Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
                    <!-- <h4 class="card-title">Add Listing</h4> -->
                    <!-- <p class="card-description">Basic form layout</p> -->
                    <h4>Seller View Details</h4>

                    <div class="row mt-2">
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Person 1</label>
                            <input type="text" class="form-control" name="companyperson1" id="companyperson1"
                                placeholder="company name" value="{{ $data['comp_name_1'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Email 1</label>
                            <input type="email" class="form-control" name="companyemail1" id="companyemail1"
                                placeholder="company email" value="{{ $data['comp_email_1'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Contact 1</label>
                            <input type="text" class="form-control" name="companycontact1" id="companycontact1"
                                placeholder="company contact number" value="{{ $data['comp_contact_1'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Designation 1</label>
                            <input type="text" class="form-control" name="designation1" id="designation1"
                                placeholder="designation" value="{{ $data['designation_1'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Date Of Birth 1</label>
                            <input type="date" class="form-control" name="dob1" id="dob1" placeholder="dob"
                                max="<?= date('Y-m-d'); ?>" value="{{ $data['dob_1'] }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Person 2</label>
                            <input type="text" class="form-control" name="companyperson2" id="companyperson2"
                                placeholder="company name" value="{{ $data['comp_name_2'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Email 2</label>
                            <input type="email" class="form-control" name="companyemail2" id="companyemail2"
                                placeholder="company email" value="{{ $data['comp_email_2'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Contact 2</label>
                            <input type="text" class="form-control" name="companycontact2" id="companycontact2"
                                placeholder="company contact number" value="{{ $data['comp_contact_2'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Designation 2</label>
                            <input type="text" class="form-control" name="designation2" id="designation2"
                                placeholder="designation" value="{{ $data['designation_2'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Date Of Birth 2</label>
                            <input type="date" class="form-control" name="dob2" id="dob2" placeholder="dob"
                                max="<?= date('Y-m-d'); ?>" value="{{ $data['dob_2'] }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Person 3</label>
                            <input type="text" class="form-control" name="companyperson3" id="companyperson3"
                                placeholder="company name" value="{{ $data['comp_name_3'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Email 3</label>
                            <input type="email" class="form-control" name="companyemail3" id="companyemail3"
                                placeholder="company email" value="{{ $data['comp_email_3'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Company Contact 3</label>
                            <input type="text" class="form-control" name="companycontact3" id="companycontact3"
                                placeholder="company contact number" value="{{ $data['comp_contact_3'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Designation 3</label>
                            <input type="text" class="form-control" name="designation3" id="designation3"
                                placeholder="designation" value="{{ $data['designation_3'] }}" readonly>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="text-bold">Date Of Birth 3</label>
                            <input type="date" class="form-control" name="dob3" id="dob3" placeholder="dob"
                                max="<?= date('Y-m-d'); ?>" value="{{ $data['dob_3'] }}" readonly>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Company Office Address</label>
                            <input type="text" class="form-control" name="companyofficeaddress"
                                id="companyofficeaddress" placeholder="company office address"
                                value="{{ $data['comp_office_address'] }}" readonly>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Company Facotry Address</label>
                            <input type="text" class="form-control" name="companyfactoryaddress"
                                id="companyfactoryaddress" placeholder="company factory address"
                                value="{{ $data['comp_factory_address'] }}" readonly>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="text-bold">Company Owner Name</label>
                            <input type="text" class="form-control" name="ownername" id="ownername"
                                placeholder="company owner name" value="{{ $data['comp_ownername'] }}" readonly>
                        </div>

                        <div class=" col-md-6 mt-4">
                            <label class="text-bold">Certifications (CMP, ISO etc) </label>
                            <div class="col-md-12 mt-2">
                                <label></label>
                                <a href="{{ asset($data['upload_certification']) }}" target="_blank"
                                    class="text-primary text-center">
                                    <small>View uploaded ( Picture / Document )</small>
                                </a>
                                <input type="hidden" name="prevdocument" value="{{ $data['upload_certification'] }}">
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="text-bold">NTN No</label>
                            <input type="text" class="form-control" name="ntnno" id="ntnno" placeholder="Ntn No"
                                value="{{ $data['ntn'] }}" readonly>
                        </div>

                        <div class="col-md-6 mt-4">
                            <label class="text-bold">GST No</label>
                            <input type="text" class="form-control" name="gstno" id="gstno" placeholder="Gst No"
                                value="{{ $data['gst'] }}" readonly>
                        </div>

                        <div class=" col-md-6 mt-4">
                            <label class="text-bold">Company General Certification</label>
                            <div class="col-md-12 mt-2">
                                <label></label>
                                <a href="{{ asset($data['comp_general_certification']) }}" target="_blank"
                                    class="text-primary text-center">
                                    <small>View uploaded ( Picture / Document )</small>
                                </a>
                                <input type="hidden" name="prevdocument"
                                    value="{{ $data['comp_general_certification'] }}">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5 pb-5">
                            <a href="{{ route('sellers') }}" class="btn text-white btn-rounded mr-2"
                                style="background-color:#232475"> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection