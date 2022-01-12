<!--========================== BREADCRUMB START  --->
<section id="breadcrumb_item" class="pb-0 breadcrumb mb-0">
    <div class="container">
       <div class="row">
          <div class="col-md-12 m-auto">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item font-weight-bold"><a href="{{ url('/') }}"><span><i class="fa fa-home" aria-hidden="true"></i></span> HOME</a></li>
                   <li class="breadcrumb-item font-weight-bold " aria-current="page"><a href="javascript:void(0)" class="text-dark">CART</a></li>
                </ol>
             </nav>
          </div>
       </div>
    </div>
 </section>
 <!--============================= CART PAGGE START  ============================ -->
 <section id="cart" class="padding section_bg ">
    <div class="container">
       <div class="row">
          <div class="col-md-9">
             <div id="table_content" class="table-responsive  px-md-3 pb-md-3 ">
                <table class="table text-center">
                   <thead class="table_cart mibile_one table_header_padding text-white">
                      <tr>
                         <th scope="col" class="th_first font-weight-normal">Product Image</th>
                         <th scope="col" class="product_content font-weight-normal">Product Name</th>
                         <th scope="col" class="font-weight-normal">Price</th>
                         <th scope="col" class="font-weight-normal">Quantity</th>
                         <th scope="col" class="font-weight-normal">Total</th>
                         <th scope="col" class="font-weight-normal">Remove</th>
                      </tr>
                   </thead>
                   <tbody class="box_sha" id="cartItem-product-show">
                      {{-- <tr>
                         <th scope="row">
                            <div class="cart_imgss">
                               <img src="https://montechbd.com/shopist/demo/public/uploads/1619869340-h-250-tv2.png" alt="">
                            </div>
                         </th>
                         <td class="cart_td gray_title">
                            <div class="product_des">
                               <h3>Blue Diamond Almonds</h3>
                            </div>
                         </td>
                         <td class="gray_title">$ 25</td>
                         <td class="gray_title">
                            <div class="qty">
                               <span class="minus">-</span>
                               <input type="number" class="count" name="qty" value="1">
                               <span class="plus">+</span>
                            </div>
                         </td>
                         <td class="gray_title">$2</td>
                         <td class="gray_title"><a href="" class="gray_title"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                      </tr> --}}
                   </tbody>
                </table>
                
                <div class="row">
                  <div class="d-flex justify-content-around align-items-center w-100 my-3 flex-wrap">
                     <form class="coupon-field d-flex ">
                         <input type="text" placeholder="Apply Coupon Code" class="mr-2 coupon_code form-control">
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
          </div>
          <div class="col-md-3 m-auto">
             <div class="cart-summary border_one p-3">
                <strong class="green_one_text mb-4 d-block">CART TOTALS</strong>
                <div class="cart-price d-flex justify-content-between">
                   <h6 class="">Sub Total</h6>
                   <h6 class="green_one_text caritem-subtotal"></h6>
                </div>
                <div class="cart-price d-flex justify-content-between mt-2">
                   <!-- <h6 class="">Shipping Cost</h6> -->
                   <!-- <h6 class="green_one_text">$ 0</h6> -->
                </div>
                <div class="cart-price d-flex justify-content-between  mt-2">
                   <h6 class="">Discount</h6>
                   <h6 class="green_one_text caritem-discount-coupon">Rs 0</h6>
                </div>
                <hr class="m-0 p-0">
                <div class="cart-price d-flex justify-content-between  mt-2">
                   <h6 class="">Grand Total</h6>
                   <h6 class="green_one_text caritem-grandtotal"></h6>
                </div>
             </div>
             <div class="btn_wrapper mt-4">
                <a href="{{ url('/checkout') }}" class="theme_btn btn_tr ">Checkout</a>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!--============================= CART PAGGE END  ============================ -->