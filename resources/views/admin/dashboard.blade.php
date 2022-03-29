@extends('layout.layout')
@section('content')

        <!-- Page Content-->
        <div class="page-content-tab">

            <div class="container-fluid">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="float-right">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Admin panel</li>
                                </ol>
                            </div>
                            <h4 class="page-title">All products</h4><br>
                            <button class="btn btn-primary btn-sm add-file ml-3" data-toggle = "modal" data-target ="#createproduct">add new product for auction</button>
                        </div><!--end page-title-box-->
                    </div><!--end col-->
                </div>
                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Product Stock</h4>
                                <p class="text-muted mb-4 font-13">
                                    Available all products.
                                </p>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Starting Price</th>
                                            <th>Current bid</th>
                                            <th>Bidder</th>
                                            <th>Created at</th>
                                            <th>Auction ends</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach($products as $product)
                                        <tr id="row{{ $product->id }}">
                                            <td>{{ $product->name }}</td>
                                            <td>${{ number_format($product->start_price, 2, ',', '.') }}</td>
                                            <td>@if($product->highestBid())${{ number_format($product->highestBid(), 2, ',', '.') }}@endif</td>
                                            <td>@if($product->highestBidUser()){{$product->highestBidUser()->user->username}}@endif</td>
                                            <td>{{$product->created_at}}</td>
                                            <td>{{$product->auction_ends}}</td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="editProduct({{$product->id}})"><i class="far fa-edit text-info mr-1"></i></a>
                                                <a href="deleteproduct" data-toggle="modal" data-target="#deleteproduct" data-id ="{{ $product->id }}" data-name ="{{ $product->name }}"><i class="far fa-trash-alt text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div><!-- container -->
        </div>
        <!-- end page content -->
        @include('admin.crudModals')
        <script language="javascript">
            var today = new Date().toISOString().slice(0, 16);
            console.log(document.getElementById("auction_ends1")[0]);
            document.getElementById("auction_ends1").min = today;
        </script>
@endsection
