@extends('layouts.login.app')

@section('content')

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-left p-3">
                        <div class="brand-logo">
                            <!-- <img src="{{ asset('images/logo.svg') }}" alt="logo"> -->
                            <img src="{{ asset('images/logo1.png') }}" alt="logo">
                        </div>
                        <h4><b>New here?</b></h4>
                        <h6 class="font-weight-light">Join us today! It takes only few steps</h6>

                        <form id="signupForm" action="{{ route('register') }}" method="POST"
                            enctype='multipart/form-data' class="pt-3">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadiosBuyer" value="2" checked> Buyer <i
                                                class="input-helper"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadiosSeller" value="3"> Seller <i
                                                class="input-helper"></i></label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company Person 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-account-network text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="companyperson1" id="companyperson1" placeholder="company name"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Company Email 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-email-variant text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg border-left-0"
                                        name="companyemail1" id="companyemail1" placeholder="company email"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Company Contact 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-cellphone text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="companycontact1" id="companycontact1" placeholder="company contact number"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Designation 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-spotlight-beam text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="designation1" id="designation1" placeholder="designation"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date Of Birth 1</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-chart-arc text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-control-lg border-left-0" name="dob1"
                                        id="dob1" placeholder="dob1" max="<?= date('Y-m-d'); ?>"
                                        style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company Person 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-account-network text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="companyperson2" id="companyperson2" placeholder="company name"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Company Email 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-email-variant text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg border-left-0"
                                        name="companyemail2" id="companyemail2" placeholder="company email"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Company Contact 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-cellphone text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="companycontact2" id="companycontact2" placeholder="company contact number"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Designation 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-spotlight-beam text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="designation2" id="designation2" placeholder="designation"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date Of Birth 2</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-chart-arc text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-control-lg border-left-0" name="dob2"
                                        id="dob2" placeholder="dob2" max="<?= date('Y-m-d'); ?>"
                                        style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company Person 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-account-network text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="companyperson3" id="companyperson3" placeholder="company name"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Company Email 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-email-variant text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control form-control-lg border-left-0"
                                        name="companyemail3" id="companyemail3" placeholder="company email"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Company Contact 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-cellphone text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="companycontact3" id="companycontact3" placeholder="company contact number"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Designation 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-spotlight-beam text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="designation3" id="designation3" placeholder="designation"
                                        style="min-height: auto">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Date Of Birth 3</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-chart-arc text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control form-control-lg border-left-0" name="dob3"
                                        id="dob3" placeholder="dob3" max="<?= date('Y-m-d'); ?>"
                                        style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company Office Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-rename-box text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="companyofficeaddress" id="companyofficeaddress"
                                        placeholder="company office address" style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company Factory Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-rename-box text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="companyfactoryaddress" id="companyfactoryaddress"
                                        placeholder="company factory address" style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Company Owner Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-accusoft text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0"
                                        name="ownername" id="ownername" placeholder="company owner name"
                                        style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Upload Certification (CMP,ISO, etc)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-sign-text text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control form-control-lg border-left-0"
                                        name="uploadcertification" id="uploadcertification"
                                        placeholder="upload certification" style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>NTN No</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-sign-text text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0" name="ntnno"
                                        id="ntnno" placeholder="Ntn No" style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>GST No</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-sign-caution text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg border-left-0" name="gstno"
                                        id="gstno" placeholder="Gst No" style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-lock-outline text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg border-left-0"
                                        name="password" id="password" placeholder="Password" style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-lock-outline text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg border-left-0"
                                        name="cpassword" id="cpassword" placeholder="Confirm Password"
                                        style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group" id="sellergc" style="display:none">
                                <label>Company General Certification</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-sign-text text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control form-control-lg border-left-0"
                                        name="companygeneralcertification" id="companygeneralcertification"
                                        placeholder="upload general certification" style="min-height: auto">
                                </div>
                            </div>

                            <!-- <div class="form-group" id="sellerlisting" style="display:none">
                                <label>Upload Listing (.csv)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-sign-text text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control form-control-lg border-left-0"
                                        name="uploadsellerlisting" id="uploadsellerlisting" accept=".xlsx, .xls, .csv"
                                        placeholder="upload listing" style="min-height: auto">
                                </div>
                            </div>

                            <div class="form-group" id="buyerlisting">
                                <label>Upload Listing (.csv)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-sign-text text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="file" class="form-control form-control-lg border-left-0"
                                        name="uploadbuyerlisting" id="uploadbuyerlisting" accept=".xlsx, .xls, .csv"
                                        placeholder="upload listing" style="min-height: auto">
                                </div>
                            </div> -->

                            <div class="mb-4">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="tmc" id="tmc" class="form-check-input"
                                                style="margin-top:-3px">
                                            I agree to all Terms & Conditions
                                        </label>
                                        <br>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 text-center">
                                <button class="btn btn-block btn-lg font-weight-medium auth-form-btn text-white"
                                    style="background-color:#232475" type="submit"><b>Sign Up
                                    </b>
                                </button>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> Already have an account? <a
                                    href="{{route('login') }}"
                                    style="font-weight:bold; text-decoration:none; color:#595783">Sign in</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 register-half-bg d-flex flex-row">
                    <p class="text-white font-weight-medium text-center flex-grow align-self-end"><b>Copyright &copy;
                            2023 All rights reserved.</b>
                    </p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@endsection