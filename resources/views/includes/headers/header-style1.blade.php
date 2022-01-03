<?php
$categories = App\Models\Admin\Category::inRandomOrder()
    ->with('detail')
    ->whereHas('my_products')
    ->with('my_products')
    ->take(8)
    ->get();
?>
<header class="section-header top-header-bg">
    <div class="container">
        <div class="top-header d-flex justify-content-end align-items-center">
            <div class="top-social-icon">
                <ul class="mb-0">
                    <li>
                        <a href="wishlist.html" class="wishlist_mobile"><i class="fa fa-heart-o"
                                aria-hidden="true"></i><span class="font-weight-normal">Wishlist</span></a>
                        <!-- user login start  -->
                        <div class="dropdown user_login_mobile">
                            <button
                                class="
                    pb-0
                    btn
                    bg-transparent
                    dropdown-toggle
                    pt-0
                    font-weight-normal
                  "
                                type="button" data-toggle="dropdown">
                                <i class="fa fa-user-o" aria-hidden="true"></i> My Account
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="login.html" class="font-weight-normal"><span class="pr-2"><i
                                                class="fa fa-user" aria-hidden="true"></i></span>
                                        Login</a>
                                </li>
                                <li>
                                    <a href="register.html" class="font-weight-normal"><span class="pr-2"><i
                                                class="fa fa-sign-in" aria-hidden="true"></i></span>Sign Up</a>
                                </li>
                            </ul>
                        </div>
                        <!-- cart modal start  -->
                        <a href="" class="cart_mobile" data-toggle="modal" data-target="#exampleModal"><i
                                class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <sup>1</sup></a>
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
                                                    <tr class="d-flex align-items-center">
                                                        <th scope="row">
                                                            <div class="cart_img">
                                                                <img src="https://montechbd.com/shopist/demo/public/uploads/1619869340-h-250-tv2.png"
                                                                    alt="image" />
                                                            </div>
                                                        </th>
                                                        <td class="border-0">
                                                            <h5 class="text-dark">Blue Diamond Almonds</h5>
                                                            <h6 class="text-dark">Rs233</h6>
                                                        </td>
                                                        <td class="border-0">
                                                            <a href="" class="gray_title"><i class="fa fa-trash-o"
                                                                    aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex flex-column align-items-end">
                                        <div class="cart_top_total">
                                            <h6 class="text-dark mr-1">Total Rs233</h6>
                                        </div>
                                        <div
                                            class="
                          top_cartmodal_btn
                          d-flex
                          justify-content-between
                          align-items-center
                          w-100
                        ">
                                            <a href="cart.html" class="them_btn_new btn_cart_modal">View Cart</a>
                                            <a href="checkout.html" class="them_btn_new btn_cart_modal">Proceed
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
            <a class="navbar-brand text-white text-uppercase text-left p-0 mr-5" href=""><img src="{{ asset('frontend/assets/img/logo.png') }}"
                    class="img-fluid" alt="imageOriana Eatery" /></a>
            <!-- search start  -->

            <div class="searchbar d-none d-md-block">
                <input class="search_input" type="text" name="" placeholder="Search..." />
                <a href="#" class="search_icon"><i class="fas fa-search"></i></a>
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
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="about.html">About Us</a>
                </li>
                <li class="nav-item position-relative">
                    <a class="
                drop_arrow
                nav-link
                font-weight-bold
                text-left text-lg-center
              "
                        href="product.html">Products
                    </a>
                    <div class="menu_drop_down">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="menu_drop_list">
                                    <ul>
                                        <h3 class="text-left">Gaming</h3>
                                        <li><a href="">Office Product</a></li>
                                        <li><a href="">Office Productsss</a></li>
                                        <li><a href="">Office Product</a></li>
                                        <li><a href="">Office Productsss</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="menu_drop_list">
                                    <ul>
                                        <h3 class="text-left">Gaming</h3>
                                        <li><a href="">Office Product</a></li>
                                        <li><a href="">Office Productsss</a></li>
                                        <li><a href="">Office Product</a></li>
                                        <li><a href="">Office Productsss</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="menu_drop_list mt-4">
                                    <ul>
                                        <h3 class="text-left">Gaming</h3>
                                        <li><a href="">Office Product</a></li>
                                        <li><a href="">Office Productsss</a></li>
                                        <li><a href="">Office Product</a></li>
                                        <li><a href="">Office Productsss</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="menu_drop_list mt-4">
                                    <ul>
                                        <h3 class="text-left">Gaming</h3>
                                        <li><a href="">Office Product</a></li>
                                        <li><a href="">Office Productsss</a></li>
                                        <li><a href="">Office Product</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="checkout.html">
                        Checkout
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="cart.html">
                        Cart
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-left text-lg-center" href="contact.html">Contact Us
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
