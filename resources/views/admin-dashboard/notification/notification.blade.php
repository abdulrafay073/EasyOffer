@extends('layouts.dashboard.layout')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Dashboard</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Notification </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body mt-2">
                    <div class="preview-list" aria-labelledby="notificationDropdown">
                        <h5 class="p-3 mb-0">Notifications</h5>
                        <a class="dropdown-item preview-item mb-2">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('images/faces/face4.jpg') }}" alt="" class="profile-pic" />
                            </div>
                            <div class="preview-item-content">
                                <p class="mb-1"> Dany Miles <span class="text-small text-muted">commented on
                                        your photo</span>
                                </p>
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="count count-varient1">4</span>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item mb-2">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('images/faces/face21.jpg') }}" alt="" class="profile-pic" />
                            </div>
                            <div class="preview-item-content">
                                <p class="mb-1"> Alex <span class="text-small text-muted">just mentioned you in
                                        his post</span>
                                </p>
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="count count-varient1">1</span>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item mb-2">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('images/faces/face3.jpg') }}" alt="" class="profile-pic" />
                            </div>
                            <div class="preview-item-content">
                                <p class="mb-1"> James <span class="text-small text-muted">posted a photo on
                                        your wall</span>
                                </p>
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="count count-varient1">2</span>
                            </div>
                        </a>
                        <a class="dropdown-item preview-item mb-2">
                            <div class="preview-thumbnail">
                                <img src="{{ asset('images/faces/face2.jpg') }}" alt="" class="profile-pic" />
                            </div>
                            <div class="preview-item-content">
                                <p class="mb-1"> Alex <span class="text-small text-muted">just mentioned you in
                                        his post</span>
                                </p>
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="count count-varient1">7</span>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <p class="p-3 mb-0"><i class="mdi mdi-forward menu-icon"></i> View all notification</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection