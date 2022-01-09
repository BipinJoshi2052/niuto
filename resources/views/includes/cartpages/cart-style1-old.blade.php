<!-- Breadcrumbs -->
<section id="breadcrumbs" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="m-0 p-0 d-flex align-items-center text-white">
                    <li class="font-weight-bold">{{ trans('lables.bread-crumb-home') }}</li><span class="mx-2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <li class="">Cart</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">Cart</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumbs Ends -->
<!-- Cart -->
<section id="cart-wrapper" class="py-3">
    <div class="container">
        <div class="row">
            <div class="shopping-cart">
                <div class="shopping-cart-table">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-description item">Image</th>
                                    <th class="cart-product-name item">Product Name</th>
                                    <th class="cart-total last-item">Price</th>
                                    <th class="cart-qty item">Quantity</th>
                                    <th class="cart-total last-item">Total</th>
                                    <th class="cart-romove item">Remove</th>
                                </tr>
                            </thead>
                            <!-- /thead -->
                            <tbody id="cartItem-product-show">
                                {{-- <tr>
                                    <td class="cart-image">
                                        <a class="entry-thumbnail" href="detail.html">
                                            <img src="frontend/assets/images/product-images/1 (1).jpg" class="img-fluid">
                                        </a>
                                    </td>
                                    <td class="cart-product-name-info">
                                        <h4 class="cart-product-description"><a href="detail.html">Yoga Mat</a></h4>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </td>
                                    <td class="cart-product-grand-total"><span class="cart-grand-total-price">$300.00</span>
                                    </td>
                                    <td class="cart-product-quantity">
                                        <div class="quant-input">
                                            <input type="number" value="1">
                                        </div>
                                    </td>
                                    <td class="cart-product-grand-total"><span class="cart-grand-total-price">$300.00</span>
                                    </td>
                                    <td class="romove-item"><a href="#" title="cancel" class="icon"><i
                                    class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr> --}}
                            </tbody>
                            <!-- /tbody -->
                        </table>
                        <div class="d-flex justify-content-around align-items-center w-100 my-3 flex-wrap">
                            <form class="coupon-field d-flex ">
                                <input type="text" placeholder="Apply Coupon Code" class="mr-2 coupon_code">
                                <button type="button" class="btn btn-success" onclick="couponCartItem()" id="coupon-code">{{ trans('lables.cart-page-apply') }}</button>
                            </form>
                            <div class="total-amount font-weight-bold mt-xl-0 mt-md-0 mt-2">
                                <a href="shop">
                                    <button type="button" class="btn btn-success">
                                        {{ trans('lables.cart-page-continue-shopping') }}</button>
                                </a>
                                <button type="button" class="btn btn-success" onclick="updateCartItem()">{{ 
                                trans('lables.cart-page-update-cart') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-center align-items-center text-center">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 my-3 ">
                        <div class="cart-summary sub_border_shadow p-xl-4 p-lg-4 p-md-3 p-3 text-left">
                            <strong class="cart_text mb-3 d-block font-weight-bold">Cart Summary</strong>
                            <div class="cart-price d-flex justify-content-between mb-2">
                                <h6 class="">Sub Total</h6>
                                <span class="cart_text caritem-subtotal"></span>
                            </div>
                            <div class="cart-price d-flex justify-content-between mb-2">
                                <h6 class="">{{ trans('lables.cart-page-discount') }}</h6>
                                <span class="cart_text caritem-discount-coupon"></span>
                            </div>
                            <hr>
                            <div class="cart-price d-flex justify-content-between mb-2">
                                <h6 class="">Grand Total</h6>
                                <span class="cart_text caritem-grandtotal"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-12 my-3">
                        <a href="{{url('/checkout')}}">
                            <button type="button" class="btn btn-success">Proceed Checkout</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Cart Ends -->