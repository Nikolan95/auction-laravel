@extends('layout.layout')
@section('content')
<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content-tab">

        <div class="container-fluid">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            @include('notifications.outbidded')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body  met-pro-bg">
                            <div class="met-profile">
                                <div class="row">
                                    <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                        <div class="met-profile-main">
                                            <div class="met-profile-main-pic">
                                                <img src="{{asset('images/users/user-4.jpg')}}" alt="" class="rounded-circle">
                                                <span class="fro-profile_main-pic-change">
                                                    <i class="fas fa-camera"></i>
                                                </span>
                                            </div>
                                            <div class="met-profile_user-detail">
                                                <h5 class="met-user-name">{{$user->username}}</h5>
                                                <p class="mb-0 met-user-name-post">{{ $user->username }}</p>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4 ml-auto">
                                        <ul class="list-unstyled personal-detail">
                                            <li class="mt-2"><i class="dripicons-mail text-info font-18 mt-2 mr-2"></i> <b> Email </b> : {{ $user->email }}</li>
                                            <li class="mt-2"><i class="dripicons-location text-info font-18 mt-2 mr-2"></i> <b>Location</b> : {{ $user->address }}</li>
                                        </ul>
                                        <div class="button-list btn-social-icon">
                                            <button type="button" class="btn btn-blue btn-circle">
                                                <i class="fab fa-facebook-f"></i>
                                            </button>

                                            <button type="button" class="btn btn-secondary btn-circle ml-2">
                                                <i class="fab fa-twitter"></i>
                                            </button>

                                            <button type="button" class="btn btn-pink btn-circle  ml-2">
                                                <i class="fab fa-dribbble"></i>
                                            </button>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end f_profile-->
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
            <div class="row">
                <div class="col-12">
                    <div class="tab-content detail-list" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="general_detail">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class=" d-flex justify-content-between">
                                                <img src="{{asset('images/wallet.png')}}" alt="" height="75">
                                                <div class="align-self-center">
                                                    <h2 class="mt-0 mb-2 font-weight-semibold" id="myBalance">${{ number_format($user->balance, 2, ',', '.') }}</h2>
                                                    <h4 class="title-text mb-0">My Balance</h4>
                                                </div>
                                            </div>
                                            <form action="{{route('add.balance')}}" method="POST"  id="addfundsform">
                                                @csrf
                                                <div class="d-flex justify-content-between bg-light p-3 mt-3 rounded">
                                                    <div>
                                                        <input type="text" class="form-control" name="balance" id="balance" placeholder="add balance">
                                                        <span class="text-danger error-text balance_error"></span>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-primary btn-sm add-file ml-3" type="submit">Add balance</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title mt-0 mb-4">Latest Activity</h4>
                                            <div class="slimscroll profile-activity-height">
                                                <div class="activity">
                                                    @foreach($bids as $bid)
                                                        <div class="activity-info">
                                                            <div class="icon-info-activity">
                                                                <i class="mdi mdi-checkbox-marked-circle-outline bg-soft-success"></i>
                                                            </div>
                                                            <div class="activity-info-text">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <p class="text-muted mb-0 font-14 w-75"><span class="text-dark font-14">{{$bid->user->username}}</span>
                                                                        has bidded on <a href="/auction/{{$bid->product->id}}" class="text-dark">{{$bid->product->name}}</a> ${{$bid->price}}
                                                                    </p>
                                                                    <span class="text-muted">{{ \Carbon\Carbon::parse($bid->created_at)->diffForHumans() }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div><!--end activity-->
                                            </div><!--crypot dash activity-->
                                        </div><!--end card-body-->
                                    </div><!--end card-->
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end general detail-->
                    </div><!--end tab-content-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!-- container -->
    </div>
    <!-- end page content -->
</div>
<!-- end page-wrapper -->
@endsection
