@extends('layout.layout')
@section('content')
    @if(session('success'))
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>
            $('document').ready(function () {
                Swal.fire(
                    'Success!',
                    'Auto bid has been enabled on this product',
                    'success'
                )
            });
        </script>
    @elseif(session('outbidded'))
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>
            $('document').ready(function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You have been outbidded by competitor bot',
                })
            });
        </script>
    @elseif(session('outbid'))
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>
            $('document').ready(function () {
                Swal.fire(
                    'Success!',
                    'You have outbidded competitor bot. And auto bid has been enabled on this product',
                    'success'
                )
            });
        </script>
    @elseif(session('newbid'))
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script>
            $('document').ready(function () {
                Swal.fire(
                    'Success!',
                    'Bid has been placed',
                    'success'
                )
            });
        </script>
    @endif
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
                                    <li class="breadcrumb-item"><a href="/products">Products</a></li>
                                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Procuct-Detail</h4>
                        </div><!--end page-title-box-->
                    </div><!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                @include('notifications.outbidded')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        @if($errors->any())
                                            @foreach($errors->all() as $error)
                                            <div class="alert icon-custom-alert alert-outline-pink b-round fade show" role="alert">
                                                <i class="mdi mdi-alert-outline alert-icon"></i>
                                                <div class="alert-text">
                                                    <strong>Oh snap!</strong> {{$error}}
                                                </div>
                                                <div class="alert-close">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true"><i class="mdi mdi-close text-danger"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                        @if($product->image)
                                            <img src="{{asset($product->image->path)}}" alt="" class=" mx-auto  d-block" height="400" width="400">
                                        @else
                                        <img src="{{asset('images/products/img-7.png')}}" alt="" class=" mx-auto  d-block" height="400">
                                        @endif
                                    </div><!--end col-->
                                    <div class="col-lg-6 align-self-center">
                                        <div class="single-pro-detail">
{{--                                            <p class="mb-1">{{$product->subcategory->name}}</p>--}}
                                            <div class="custom-border mb-3"></div>
                                            <h3 class="pro-title">{{$product->name}}</h3>
                                            <p class="text-muted mb-0">{{$product->description}}</p>
                                            <div>Auction closes <span id="time">{{ \Carbon\Carbon::parse($product->auction_ends)->diffForHumans() }}</span> !</div>
                                            @if($maxBid)
                                                Current Bid
                                                <h2 class="pro-price" id="maxBid">${{ number_format($maxBid, 2, ',', '.') }} </h2>
                                            @else
                                                Price starting at
                                                <h2 class="pro-price">${{ number_format($product->start_price, 2, ',', '.') }} </h2>
                                            @endif
{{--                                            <a href="/{{$product->user->username}}/products" class="text-muted font-13">From user: {{ $product->user->username }}</a>--}}
                                            <div class="quantity mt-3 ">
                                                <form action="{{ route('bid') }}" method="POST" id="bidForm">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input class="form-control" type="number" name="price" min="0" value="0" id="example-number-input">
                                                    <button type="submit" class="btn btn-gradient-primary text-white px-4 d-inline-block">Bid now</button>
                                                </form>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            </div>
                                            <h5>Or try autobid feature</h5>
                                            <button class="btn btn-primary btn-sm add-file ml-3" data-toggle = "modal" data-target ="#autobid">Auto bid</button>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-4">Latest Activity</h4>
                                <div class="slimscroll profile-activity-height">
                                    <div class="activity" id="bidActivity">
                                        @forelse($product->bids as $bid)
                                        <div class="activity-info">
                                            <div class="icon-info-activity">
                                                <i class="mdi mdi-checkbox-marked-circle-outline bg-soft-success"></i>
                                            </div>
                                            <div class="activity-info-text">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="text-muted mb-0 font-14 w-75"><span class="text-dark font-14">{{ $bid->user->username }}</span>
                                                        has bidded ${{ number_format($bid->price, 2, ',', '.') }} on {{ $product->name }}
                                                    </p>
                                                    <span class="text-muted">{{ \Carbon\Carbon::parse($bid->created_at)->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                            <div class="activity-info">
                                                <div class="icon-info-activity">
                                                    <i class="mdi mdi-alert-decagram bg-soft-purple"></i>
                                                </div>
                                                <div class="activity-info-text">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <p class="text-muted mb-0 font-14 w-75">
                                                           There are currently no bids on this product. Bid Now!
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div><!--end activity-->
                                </div><!--crypot dash activity-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end col-->
                </div><!--end row-->
            </div><!-- container -->
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->
    <div class="modal fade autobid" id="autobid" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role = "document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss = "modal" aria-label="close"><span aria-hidden = "true">&times;</span></button>
                    <div class="modal-title">
                    </div>
                </div>
                <form action="{{ route('autobid') }}" method="POST" id="autoBidForm">
                    @csrf
                    <div class="modal-body">
                        <h5>You are about to enable auto-bid system on this item please add maximum value </h5>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="max_value">Max Value</label>
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="number" class="form-control" name="max_value" id="max_value1">
                                            <span class="text-danger error-text max_value_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <button class="btn btn-primary btn-sm add-file ml-3" type="submit">Enable autobid Now!</button>
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
