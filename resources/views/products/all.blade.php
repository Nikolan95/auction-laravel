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
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Products</h4>
                    </div><!--end page-title-box-->
                </div><!--end col-->
            </div>
            @include('notifications.outbidded')
            <div class="row">
                <div class="col-md-3">
                    <label for="username">Order by price</label>
                    <select class="form-control form-control-sm" aria-label="Default select example" onchange="javascript:handleSelect(this)">
                        <option value="/products"></option>
                        <option value="/products/lowest" @isset($filter)@if($filter == 'lowest') selected @endif @endisset>lowest</option>
                        <option value="/products/highest" @isset($filter)@if($filter == 'highest') selected @endif @endisset>highest</option>
                    </select>
                </div>
            </div>
            <br>
            <!-- end page title end breadcrumb -->
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            @if($product->image)
                            <img src="{{asset($product->image->path)}}" alt="" class="d-block mx-auto my-4" height="170" width="170">
                            @else
                                <img src="{{asset('images/products/img-7.png')}}" alt="" class="d-block mx-auto my-4" height="170">
                            @endif
                            <div class="d-flex justify-content-between align-items-center my-4">
                                <div>
                                    <a href="#" class="header-title">{{ $product->name }}</a>
                                    <div>Auction closes <span id="time">{{ \Carbon\Carbon::parse($product->auction_ends)->diffForHumans() }}</span> !</div>
                                </div>
                                <div>
                                    <p>Starting price ${{ number_format($product->start_price, 2, ',', '.') }}</p>
                                    @if($product->highestBid())
                                        <p class="text-dark mt-0 mb-2">Current bid ${{ number_format($product->highestBid(), 2, ',', '.') }}</p>
                                    @endif
                                </div>
                            </div>
                            <a class="btn btn-soft-primary btn-block" href="/product/{{$product->id}}">Bid Now</a>
                        </div><!--end card-body-->
                    </div><!--end card-->
                </div><!--end col-->
                @endforeach
            </div>  <!--end row-->
        </div><!-- container -->
        @if ($products->lastPage() > 1)
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item {{ ($products->currentPage() == 1) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $products->url(1) }}" tabindex="-1">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li class="page-item {{ ($products->currentPage() == $i) ? ' active' : '' }}">
                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $products->url($products->currentPage()+1) }}">Next</a>
                    </li>
                </ul><!--end pagination-->
            </nav><!--end nav-->
        @endif
    </div>
    <!-- end page content -->
    <script type="text/javascript">
        //fuction for filtering price
        function handleSelect(elm)
        {
            window.location = elm.value;
        }
    </script>
@endsection
