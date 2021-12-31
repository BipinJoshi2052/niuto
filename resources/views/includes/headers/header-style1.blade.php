<?php
$categories = App\Models\Admin\Category::inRandomOrder()
    ->with('detail')
    ->whereHas('my_products')
    ->with('my_products')
    ->take(8)
    ->get();
?>
<!-- Navigation Starts -->
<section id="navigation-wrapper" class="sticky-top">
    <div class="container">
        <div class="nav-logo d-flex justify-content-between align-items-center">
            <div class="logo pr-xl-5 pr-md-3 pr-1">
                <a href="{{ url('/') }}">
                    <img src="{{ isset(getSetting()['site_logo']) ? getSetting()['site_logo'] : asset('01-logo.png') }}"
                        alt="{{ isset(getSetting()['site_name']) ? getSetting()['site_name'] : 'Logo' }}"
                        class="img-fluid" />
                </a>
            </div>
            <div class="search-nav m-auto w-50">
                <!-- Actual search box -->
                <div class="form-group has-search mb-0">
                    <span class="fa fa-search form-control-feedback"></span>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" id="search-input" autocomplete="off" />
                        <div class="btn input-group-addon" style="cursor: pointer; border-top: 1px solid #ced4da; border-right: 1px solid #ced4da; border-bottom: 1px solid #ced4da;" id="search-clear">
                            <span class="fa fa-close"></span>
                        </div>
                    </div>
                    <div class="dropdown searchBox" id="searchBox">
                        <ul class="dropdown-menu" style="width: 100%; overflow-y: auto; max-height: 400px; min-height:auto">
                            {{-- <a href="" style="text-decoration: none;">
                                <li class="dropdown-item">
                                    <img class="img-thumbnail" height="100px" src="https://dummyimage.com/150x100/000/fff"> India
                                </li>
                            </a> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="cart-wishlist d-xl-block">
                <ul class="d-flex m-0">
                    <li class="nav-item">
                        <a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" data-toggle="modal"
                            data-target="#nav-cart">
                            <span class="mr-1"><i class="fa fa-shopping-bag" aria-hidden="true"></i></span>
                            Cart <sup class="cart-item-no text-white px-2" id="total-menu-cart-product-count">
                                0
                            </sup>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link add-on px-xl-2 px-lg-1 px-md-2 px-2" href="{{ url('/wishlist') }}">
                            <span class="mr-1"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
                            Wishlist <sup class="cart-item-no text-white px-2 wishlist-count">
                                0
                            </sup>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="extra auth-login" hidden>
                <ul class="d-flex align-items-center justify-content-center mb-0 p-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle m-auto add-on" href="#" id="profilenav"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-1"><i class="fa fa-user-o" aria-hidden="true"></i></span> <span
                                class="welcomeUsername"></span>
                        </a>
                        <div class="profilenav-dropdown dropdown-menu p-0" aria-labelledby="profilenav">
                            <a class="dropdown-item" href="{{ url('/profile') }}"> <span class="mr-2"><i
                                        class="fa fa-user" aria-hidden="true"></i></span>Profile</a>
                            <a class="dropdown-item" href="{{ url('/wishlist') }}"> <span class="mr-2"><i
                                        class="fa fa-heart" aria-hidden="true"></i></span>Wish List</a>
                            <a class="dropdown-item" href="{{ url('/orders') }}"> <span class="mr-2"><i
                                        class="fa fa-sort" aria-hidden="true"></i></span>Order Status</a>
                            <a class="dropdown-item" href="{{ url('/change-password') }}"> <span
                                    class="mr-2"><i class="fa fa-lock"
                                        aria-hidden="true"></i></span>Change Pas...</a>
                            <a class="dropdown-item log_out" href="javascript:void(0)"> <span class="mr-2"><i
                                        class="fa fa-sign-out" aria-hidden="true"></i></span>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="extra without-auth-login" hidden>
                <ul class="d-flex align-items-center justify-content-center mb-0 p-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle m-auto add-on" href="#" id="profilenav"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-1"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            Profile
                        </a>
                        <div class="profilenav-dropdown dropdown-menu p-0" aria-labelledby="profilenav">
                            <a class="dropdown-item" href="{{ url('/login') }}"> <span class="mr-2"><i
                                        class="fa fa-sign-in" aria-hidden="true"></i></span>Login</a>
                            <a class="dropdown-item" href="{{ url('/register') }}"> <span class="mr-2"><i
                                        class="fa fa-paper-plane" aria-hidden="true"></i></span>Register</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropdown-custom" data-open="#item2"
                            href="under-construction.html" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            Product
                        </a>
                        <div id="item2" class="dropdown-menu dropdown-menu2" aria-labelledby="navbarDropdown">
                            <div class="container d-block">
                                <div class="row">
                                    @foreach ($categories as $key => $category)
                                        <div class="col-md-3">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link head font-weight-bold"
                                                        href="/shop?category={{ $category->id }}">{{ $category->detail[0]->category_name }}</a>
                                                </li>
                                                @foreach ($category->my_products->take(2) as $value)
                                                    <li class="nav-item p-0">
                                                        <a class="nav-link"
                                                            href="/product/{{ $value->id }}/{{ $value->product_slug }}">{{ $value->detail[0]->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!--  /.container  -->
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/shop') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/about-us') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/contact-us') }}">Contacts</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section>
<!-- Navigation Ends -->
