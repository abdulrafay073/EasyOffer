@extends('layouts.login.app')

@section('content')

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-left p-3">
                        <div class="brand-logo">
                            <!-- <img src="{{ asset('images/logonew.png') }}" alt="logo"> -->
                            <img src="{{ asset('images/logo1.png') }}" alt="logo">
                        </div>
                        <h4><b>Welcome back!</b></h4>
                        <h6 class="font-weight-light">Happy to see you again!</h6>
                        <form class="pt-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0"
                                            style="padding: 0.75rem">
                                            <i class="mdi mdi-account-outline text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="text"
                                        class="form-control form-control-lg border-left-0 @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}"
                                        placeholder=" Mobile Number/Email" style="min-height: auto">
                                    @error('email')
                                    <span class="invalid-feedback focus-input100" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                    <input type="password" name="password" id="password"
                                        class="form-control form-control-lg border-left-0 @error('password') is-invalid @enderror"
                                        placeholder="Password" style="min-height: auto">

                                    @error('password')
                                    <span class="invalid-feedback focus-input100" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                                </div>
                                <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                            </div>
                            <div class="my-3 text-center">
                                <button class="btn btn-block btn-lg font-weight-medium auth-form-btn text-white"
                                    style="background-color:#232475" type="submit"><b>Sign in
                                    </b></button>
                            </div>
                            <!-- <div class="mb-2 d-flex">
                                <button type="button" class="btn btn-facebook auth-form-btn flex-grow me-1">
                                    <i class="mdi mdi-facebook me-2"></i><b>Facebook</b> </button>
                                <button type="button" class="btn btn-google auth-form-btn flex-grow ms-1">
                                    <i class="mdi mdi-google me-2"></i><b>Google</b> </button>
                            </div> -->
                            <div class="text-center mt-4 font-weight-light"> Don't have an account? <a
                                    href="{{ route('register') }}"
                                    style="font-weight:bold; text-decoration:none; color:#595783">Sign
                                    Up</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 login-half-bg d-flex flex-row">
                    <p class="text-white font-weight-medium text-center flex-grow align-self-end"><b>Copyright &copy;
                            2023
                            All rights reserved.</b></p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

@endsection