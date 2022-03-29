<!-- leftbar-tab-menu -->
<div class="leftbar-tab-menu">
    <div class="main-icon-menu">
        <a href="/products" class="logo logo-metrica d-block text-center">
            <span>
                <img src="{{asset('images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
            </span>
        </a>
        <nav class="nav">
            <a href="/products" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Auctions" data-trigger="hover">
                <i data-feather="shopping-cart" class="align-self-center menu-icon icon-dual"></i>
            </a><!--end MetricaEcommerce--><br>
            @if(Auth::user()->is_admin)
            <a href="/admin/dashboard" data-toggle="tooltip-custom" data-placement="right" title="" data-original-title="Adminarea" data-trigger="hover">
                <i data-feather="grid" class="align-self-center menu-icon icon-dual"></i>
            </a><!--end MetricaApps--><br>
            @endif
        </nav><!--end nav-->
    </div><!--end main-icon-menu-->

    <div class="main-menu-inner">
        <!-- LOGO -->
        <div class="topbar-left">
            <a href="/products" class="logo">
                <span>
                    <img src="{{asset('images/laravel-logo.png')}}" alt="logo-large" class="logo-lg logo-dark">
                    <img src="{{asset('images/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
                </span>
            </a>
        </div>
    </div><!-- end main-menu-inner-->
</div>
<!-- end leftbar-tab-menu-->
