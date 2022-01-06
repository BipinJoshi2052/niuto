<?php
$categories = App\Models\Admin\Category::where('parent_id', null)
    ->with('detail')
    ->with('subcategory')
    ->take(9)
    ->get();
?>
<header class="section-header top-header-bg">
    <div class="container">
        <div class="top-header d-flex justify-content-end align-items-center">
            <div class="top-social-icon">
                <ul class="mb-0">
                    <li>
                        <a href="{{ url('/wishlist') }}" class="wishlist_mobile"><i class="fa fa-heart-o"
                                aria-hidden="true"></i><span class="font-weight-normal">Wishlist</span>
                                <sup class="wishlist-count"></sup>
                        </a>
                        <!-- user login start  -->
                        <div class="dropdown user_login_mobile">
                            <button class="pb-0 btn bg-transparent dropdown-toggle pt-0 font-weight-normal"
                                type="button" data-toggle="dropdown">
                                <i class="fa fa-user-o" aria-hidden="true"></i> <span class="welcomeUsername">My Account</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu without-auth-login" id="profilenavId" hidden>
                                <li>
                                    <a href="{{ url('/login') }}" class="font-weight-normal"><span class="pr-2"><i
                                                class="fa fa-user" aria-hidden="true"></i></span>
                                        Login</a>
                                </li>
                                <li>
                                    <a href="{{ url('/register') }}" class="font-weight-normal"><span class="pr-2"><i
                                                class="fa fa-sign-in" aria-hidden="true"></i></span>Sign Up</a>
                                </li>
                            </ul>
                            <ul class="dropdown-menu auth-login" id="profilenavId" hidden>
                                <li>
                                    <a href="{{ url('/profile') }}" class="font-weight-normal"><span class="pr-2"><i
                                                class="fa fa-user" aria-hidden="true"></i></span>
                                        Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('/wishlist') }}" class="font-weight-normal"><span class="pr-2"><i
                                                class="fa fa-heart" aria-hidden="true"></i></span>
                                        Wishlist</a>
                                </li>
                                <li>
                                    <a href="{{ url('/orders') }}" class="font-weight-normal"><span class="pr-2"><i
                                                class="fa fa-sort" aria-hidden="true"></i></span>
                                        Order Status</a>
                                </li>
                                <li>
                                    <a href="{{ url('/change-password') }}" class="font-weight-normal"><span class="pr-2"><i
                                                class="fa fa-sort" aria-hidden="true"></i></span>
                                        Change Password</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="font-weight-normal log_out"><span class="pr-2"><i
                                                class="fa fa-sign-out" aria-hidden="true"></i></span>Logout</a>
                                </li>
                            </ul>
                        </div>
                        <!-- cart modal start  -->
                        <a href="{{ url('/cart') }}" class="cart_mobile" data-toggle="modal" data-target="#exampleModal"><i
                                class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <sup id="total-menu-cart-product-count"></sup></a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel">
                                            My Cart
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body mb-0 pb-0">
                                        <div class="table-responsive px-md-3">
                                            <table class="table text-center mb-0">
                                                <tbody class="" id="top-cart-product-template">
                                                   
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex flex-column align-items-end">
                                        <div class="cart_top_total" id="top-cart-product-total">
                                            
                                        </div>
                                        <div class="top_cartmodal_btn d-flex justify-content-between align-items-center w-100">
                                            <a href="{{ url('/cart') }}" class="them_btn_new btn_cart_modal">View Cart</a>
                                            <a href="{{ url('/checkout') }}" class="them_btn_new btn_cart_modal">Proceed
                                                Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- cart modal end  -->

                        <!-- Popup Search Modal -->
                        <!-- Modal -->

                        <!-- Popup Search Modal Ends-->
                        <!-- search modal end  -->
                        <!-- search header end  -->
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<nav class="header navbar navbar-expand-lg header-sticky">
    <div class="container">
        <div class="header-logo text-center d-flex">
            <a class="navbar-brand text-white text-uppercase text-left p-0 mr-5" href=""><img src="{{ isset(getSetting()['site_logo']) ? getSetting()['site_logo'] : asset('01-logo.png') }}"
                alt="{{ isset(getSetting()['site_name']) ? getSetting()['site_name'] : 'Logo' }}"
                    class="img-fluid" /></a>
            <!-- search start  -->

            <div class="searchbar d-none d-md-block">
                <input class="search_input" type="text" placeholder="Search" id="search-input" autocomplete="off" />
                <a href="#" class="search_icon"><i class="fas fa-search"></i></a>

                <div class="dropdown searchBox w-100" id="searchBox">
                    <ul class="dropdown-menu" style="width: 100%; overflow-y: auto; max-height: 400px; min-height:auto">
                        <a href="" style="text-decoration: none;">
                            <li class="dropdown-item">
                                <img class="img-thumbnail" height="100px" src="https://dummyimage.com/150x100/000/fff"> India
                            </li>
                        </a>
                    </ul>
                </div>
            </div>

            <!-- search end  -->
            <!-- search mobile new star  -->
            <div class="search_mobile_men d-block d-md-none">
                <button class="search_icon_new" type="submit">
                    <i class="fa fa-search"></i>
                </button>

                <div class="sub_search">
                    <form action="" class="d-flex">
                        <input class="input_box" type="text" placeholder="Search.." name="search" />
                        <button class="search_top" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- search mobile new end  -->
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
            <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="{{ url('/shop') }}">Shop</a>
                </li>
                <li class="nav-item position-relative">
                    <a class="
                drop_arrow
                nav-link
                font-weight-bold
                text-left text-lg-center
              "
                        href="product.html">Category
                    </a>
                    <div class="menu_drop_down">
                        <div class="row">
                            @foreach ($categories as $k => $category)
                            <div class="col-md-6">
                                <div class="menu_drop_list">
                                    <ul>
                                        <a href="/shop?category={{ $category->id }}">
                                            <h3 class="text-left">{{ $category->detail[0]->category_name }}</h3>
                                        </a>
                                        @foreach ($category->subcategory as $sub => $subcat)
                                        @if (!$category->subcategory->isEmpty())
                                            <li><a href="/shop?category={{ $subcat->id }}">{{ $subcat->detail[0]->category_name }}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="{{ url('/checkout') }}">
                        Checkout
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="{{ url('/cart') }}">
                        Cart
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="{{ url('/contact-us') }}">Contact Us
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Button trigger modal -->
    <div class="mobile-menu d-lg-none d-md-block mr-4 position-absolute" data-toggle="modal"
        data-target="#rightsidebarfilter">
        <span><i class="fa fa-bars fa-2x text-light" aria-hidden="true"></i></span>
    </div>
    <!-- Button trigger modal -->
</nav>
<!--========================== HEADER END  --->
