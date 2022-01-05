<script>
    loggedIn = localStorage.getItem("customerLoggedin");
    if (loggedIn != '1') {
        localStorage.setItem("loginErrorMessage", "Please Login!!!");
        window.location.href = "{{url('/login')}}";
    }
</script>
@extends('layouts.master')
@section('content')

<!-- Breadcrumbs -->
<section id="breadcrumbs" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="m-0 p-0 d-flex align-items-center text-white">
                    <li class="font-weight-bold">Home</li><span class="mx-2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <li class="">Checkout</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">Checkout</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumbs Ends -->
<!-- Checkout -->
<section id="checkout-wrapper" class="py-3">
    <div class="container">
        <div class="row">
            <div id="accordion" class="w-100">
                <!-- First Collapse -->
                <div class="card">
                    <div class="card-header p-0 bg-light" id="headingOne">
                        <h5 class="mb-0">
                            <div class="w-100 p-3" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span class="mr-2"><i class="fa fa-ravelry" aria-hidden="true"></i></span> Order Summary
                            </div>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
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
                                                        <tbody id="cartItem-product-show2">
                                                            {{-- <tr>
                                                                <td class="cart-image">
                                                                    <a class="entry-thumbnail" href="detail.html">
                                                                        <img src="frontend/assets/images/product-images/1 (3).jpg" class="img-fluid">
                                                                    </a>
                                                                </td>
                                                                <td class="cart-product-name-info">
                                                                    <h4 class="cart-product-description"><a href="detail.html">Yoga Mat</a></h4>
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <div class="rating rateit-small"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="cart-product-quantity">
                                                                    <div class="quant-input">
                                                                        <input type="number" value="1">
                                                                    </div>
                                                                </td>
                                                                <td class="cart-product-grand-total"><span class="cart-grand-total-price">$300.00</span>
                                                                </td>
                                                                <td class="romove-item"><a href="#" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a>
                                                                </td>
                                                            </tr> --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Cart Ends -->
                        </div>
                    </div>
                </div>
                <!-- First Collapse Ends -->
                <!-- Second Collapse  -->
                <div class="card">
                    <div class="card-header p-0 bg-light" id="headingTwo">
                        <h5 class="mb-0">
                            <div class="collapsed p-3" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="mr-2"><i class="fa fa-ravelry" aria-hidden="true"></i></span> Shipping Information
                            </div>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="text_gray">First Name</label>
                                        <input type="text" class="form-control w-100" placeholder="First name" id="delivery_first_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="text_gray">Last Name</label>
                                        <input type="text" class="form-control w-100" placeholder="Last name" id="delivery_first_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="text_gray mt-3">Address</label>
                                        <input type="text" class="form-control w-100" placeholder="Nepal" id="delivery_street_aadress">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="text_gray mt-3">City</label>
                                        <input type="text" class="form-control w-100" placeholder="Nepal" id="delivery_city">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="text_gray mt-3">Country</label>
                                        <select class="form-control w-100" id="delivery_country" onchange="states1()"></select>
                                        {{-- <input type="text" class="form-control w-100" placeholder="Nepal"> --}}
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="text_gray mt-3">State</label>
                                        <select class="form-control" id="delivery_state"></select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="text_gray mt-3">Postal Code</label>
                                        <input type="text" class="form-control w-100" placeholder="" id="delivery_postcode">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="text_gray mt-3">Number</label>
                                        <input type="text" class="form-control w-100" placeholder="" id="delivery_phone">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Second Collapse End -->
                <!-- Third Collapse  -->
                <div class="card">
                    <div class="card-header p-0 bg-light" id="headingThree">
                        <h5 class="mb-0">
                            <div class="collapsed p-3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <span class="mr-2"><i class="fa fa-ravelry" aria-hidden="true"></i></span> Payment Option
                            </div>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($payment_method_default as $payment_methods)
                                    <div class="col-3">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="inlineCheckbox{{ $payment_methods->id }}" name="customRadio" class="custom-control-input payment_method otherPayment" {{ $loop->first ? 'checked' : '' }} value="{{ $payment_methods->payment_method }}">
                                            <label class="custom-control-label otherPayment" for="inlineCheckbox{{ $payment_methods->id }}">{{ ucwords(str_replace('_', ' ', $payment_methods->payment_method)) }}</label>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <input type="radio" name="customRadio" class="custom-control-input payment_method esewaRadio" id="esewaRadio" value="esewa">
                                        <label class="custom-control-label esewaRadio" for="esewaRadio">Esewa</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Third Collapse End -->
            </div>

            <div class="d-flex justify-content-around w-100 my-1">
                <div class="total-amount font-weight-bold">
                    {{ trans('lables.checkout-subtotal') }} : <span class="caritem-subtotal">0</span>
                </div>
            </div>
            <div class="d-flex justify-content-around w-100 my-1">
                <div class="total-amount font-weight-bold">
                    {{ trans('lables.checkout-discount') }} : <span class="caritem-discount-coupon">0</span>
                </div>
            </div>
            <div class="d-flex justify-content-around w-100 my-1">
                <div class="total-amount font-weight-bold">
                    {{ trans('lables.checkout-shipping') }} : <span class="shipping-tax">0</span>
                </div>
            </div>
            <div class="d-flex justify-content-around w-100 my-1">
                <div class="total-amount font-weight-bold">
                    {{ trans('lables.checkout-total') }} : <span class="caritem-grandtotal">0</span>
                </div>
            </div>
            <button type="button" class="btn btn-success my-3 mx-auto createOrder confirmButton">Confirm Payment</button>
        </div>
        <div class="row" hidden>
            <form action="https://uat.esewa.com.np/epay/main" method="POST" id="esewaForm" class="my-3 mx-auto">
                <input value="10" name="tAmt" type="hidden">
                <input value="10" name="amt" type="hidden">
                <input value="0" name="txAmt" type="hidden">
                <input value="0" name="psc" type="hidden">
                <input value="0" name="pdc" type="hidden">
                <input value="EPAYTEST" name="scd" type="hidden">
                <input value="" name="pid" type="hidden">
                <input value="{{ route('esewa-verify') }}?q=su" type="hidden" name="su">
                <input value="{{ route('esewa-verify') }}?q=fu" type="hidden" name="fu">
                <button type="submit" class="btn btn-success esewaButton" id="esewaButton">Confirm Payment</button>
            </form>
        </div>
    </div>
</section>

<input type="hidden" class="total_by_weight" />

@endsection
@section('script')
    <script>
        languageId = $.trim(localStorage.getItem("languageId"));
        cartSession = $.trim(localStorage.getItem("cartSession"));
        if (cartSession == null || cartSession == 'null') {
            cartSession = '';
        }
        loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
        customerToken = $.trim(localStorage.getItem("customerToken"));
        customerId = $.trim(localStorage.getItem("customerId"));

        if (loggedIn != '1') {
            window.location.href = "{{ url('login') }}";
        }

        $(document).ready(function() {
            if (loggedIn == '1') {
                cartItem('');
            } else {
                cartItem(cartSession);
            }

            // $('#cartItem-product-show2 > tr')
            // $('#esewaForm input[name=amt]').val(total);

            $('.otherPayment').on('click', function(){
                if($('#esewaRadio').is(':checked') == false){
                    $('#esewaForm').parent().attr('hidden', true);
                    $('.confirmButton').attr('hidden', false);
                }
            });

            $('.esewaRadio').on('click', function(){
                if($('#esewaRadio').is(':checked')){
                    $('#esewaForm').parent().attr('hidden', false);
                    $('.confirmButton').attr('hidden', true);
                }
            });
        });

        $(document).ajaxStop(function () {
            var d = new Date();
            var productSkus = d.getTime();
            $.each($('#cartItem-product-show2 > tr'), function(){
                if(productSkus == ''){
                    productSkus += $(this).attr('product_sku');
                }else{
                    productSkus += '>' + $(this).attr('product_sku');
                }
            });
            var total = $('.caritem-grandtotal').html().split(' ').slice(-1)[0];
            $('#esewaForm input[name="amt"]').val(total);
            var tax = 0;
            var servChrg = 0;
            var total = parseFloat(total) + parseFloat(tax) + parseFloat(servChrg);
            $('#esewaForm input[name="pid"]').val(productSkus);
            $('#esewaForm input[name="tAmt"]').val(total);
        });


        function cartItem(cartSession) {
            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart?session_id=' + cartSession + '&language_id=' + languageId +
                    '&currency=' + localStorage.getItem("currency");
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/get?session_id=' + cartSession + '&language_id=' +
                    languageId + '&currency=' + localStorage.getItem("currency");
            }
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $("#cartItem-product-show2").html('');
                        total_price = 0;
                        total_weight = 0;

                        for (i = 0; i < data.data.length; i++) {
                            if (data.data[i].product_type == 'variable') {
                                for (k = 0; k < data.data[i].combination.length; k++) {
                                    if (data.data[i].product_combination_id == data.data[i].combination[k].product_combination_id) {
                                        total_weight += parseInt(data.data[i].product_weight) * parseInt(data.data[i].qty);
                                        if (data.data[i].combination[k].gallary != null) {
                                            imgSrc = '/gallary/' + data.data[i].combination[k].gallary.gallary_name;
                                            imgAlt = data.data[i].combination[k].gallary.gallary_name;
                                            name = data.data[i].product_detail[0].title;
                                            for (loop = 0; loop < data.data[i].product_combination
                                                .length; loop++) {
                                                if (data.data[i].product_combination[loop].length - 1 == loop) {
                                                    name += data.data[i].product_combination[loop].variation.detail[0].name;
                                                } else {
                                                    name += data.data[i].product_combination[loop].variation.detail[0].name + '-';
                                                }
                                            }
                                        }
                                        k = data.data[i].combination.length;
                                    } else {}
                                }
                            } else {
                                total_weight += parseInt(data.data[i].product_weight) * parseInt(data.data[i].qty);
                                if (data.data[i].product_gallary != null && $.trim(data.data[i].product_gallary) != '') {
                                    if (data.data[i].product_gallary.detail != null && $.trim(data.data[i].product_gallary.detail) != '') {
                                        imgSrc = data.data[i].product_gallary.detail[2].gallary_path;
                                    }
                                }
                                if (data.data[i].product_detail != null && $.trim(data.data[i].product_detail) != '') {
                                    imgAlt = data.data[i].product_detail[0].title;
                                    itemName = data.data[i].product_detail[0].title;
                                }
                            }

                            if (data.data[i].discount_price > 0) {
                                discount_price = data.data[i].discount_price;
                            } else {
                                discount_price = data.data[i].price;
                            }
                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    sum = +data.data[i].qty * +discount_price;
                                    cartItemTotal = data.data[i].currency.code + ' ' + sum;
                                    cartItemPrice = data.data[i].currency.code + ' ' + discount_price;
                                } else {
                                    sum = +data.data[i].qty * +discount_price;
                                    cartItemTotal = sum + ' ' + data.data[i].currency.code;
                                    cartItemPrice = discount_price + ' ' + data.data[i].currency.code;
                                }
                            } else {
                                cartItemPrice = discount_price;
                            }
                            itemQty = +data.data[i].qty;
                            itemQtyId = 'quantity' + i;

                            total_price = total_price + (discount_price * data.data[i].qty);


                            if ($.trim(data.data[i].category_detail[0].category_detail) != '' && $.trim(data.data[i].category_detail[0].category_detail) != 'null' && $.trim(data.data[i].category_detail[0].category_detail) != null) {
                                categoryName = data.data[i].category_detail[0].category_detail.detail[0].name;
                            }
                            tbodyRow = '<tr class="cartItem-row" product_combination_id="' + data.data[i].product_combination_id + '" product_id="' + data.data[i].product_id + '" product_type="' + data.data[i].product_type + '" product_sku="' + data.data[i].product_slug + '">' +
                                '<td class="cart-image">' +
                                    '<img src="' + imgSrc + '" class="img-fluid cartItem-image">' +
                                '</td>' +
                                '<td class="cart-product-name-info">' +
                                    '<h4 class="cart-product-description cartItem-name">' + itemName + '</h4>' +
                                    '<div class="row">' +
                                        '<div class="col-4">' +
                                            '<div class="rating rateit-small"></div>' +
                                        '</div>' +
                                    '</div>' +
                                '</td>' +
                                '<td class="cart-product-grand-total"><span class="cart-grand-total-price">' + cartItemPrice + '</span>' +
                                '</td>' +
                                '<td class="cart-product-quantity">' +
                                    '<div class="quant-input">' +
                                        '<input type="text" value="' + itemQty + '" class="cartItem-qty" id="' + itemQtyId + '" readonly>' +
                                    '</div>' +
                                '</td>' +
                                '<td class="cart-product-grand-total"><span class="cart-grand-total-price">' + cartItemTotal + '</span>' +
                                '</td>' +
                                '<td class="romove-item">' +
                                    '<a href="javascript:void(0)" title="cancel" class="icon cartItem-remove" onclick="removeCartItem(this)" data-id="' + data.data[i].product_id + '" data-combination-id="' + data.data[i].product_combination_id + '"><i class="fa fa-trash-o"></i></a>' +
                                '</td>' +
                            '</tr>';

                            $("#cartItem-product-show2").append(tbodyRow);

                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i].currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    $(".caritem-subtotal").html(data.data[i].currency.code + ' ' + total_price);
                                    $(".caritem-subtotal").attr('price', total_price);
                                    $(".caritem-subtotal").attr('currency-position', data.data[i].currency.symbol_position);
                                    $(".caritem-subtotal").attr('currency-code', data.data[i].currency.code);
                                    $(".caritem-subtotal").attr('price-symbol', data.data[i].currency.code + ' ' + total_price);
                                    $(".caritem-grandtotal").html(data.data[i].currency.code + ' ' + total_price.toFixed(2));
                                    $(".shipping-tax").attr('data-price', '0');
                                } else {
                                    $(".caritem-subtotal").html(total_price + ' ' + data.data[i].currency.code);
                                    $(".caritem-subtotal").attr('price', total_price);
                                    $(".shipping-tax").attr('data-price', '0');
                                    $(".caritem-subtotal").attr('price-symbol', data.data[i].currency.code + ' ' + total_price);
                                    $(".caritem-grandtotal").html(total_price.toFixed(2) + ' ' + data.data[i].currency.code);
                                }
                            }
                        }

                        $('.total_by_weight').val(total_weight);
                        couponCart = $.trim(localStorage.getItem("couponCart"));
                        if (couponCart != 'null' && couponCart != '') {
                            $("#coupon_code").val(couponCart);
                            couponCartItem();
                        }

                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        function removeCartItem(input) {
            // console.log(input);
            product_id = $.trim($(input).attr('data-id'));
            product_combination_id = $.trim($(input).attr('data-combination-id'));
            if (product_combination_id == null || product_combination_id == 'null') {
                product_combination_id = '';
            }

            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart/delete?session_id=' + cartSession + '&product_id=' + product_id +
                    '&product_combination_id=' + product_combination_id + '&language_id=' + languageId;
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/delete?session_id=' + cartSession + '&product_id=' +
                    product_id + '&product_combination_id=' + product_combination_id + '&language_id=' + languageId;
            }

            // console.log(url);

            $.ajax({
                type: 'DELETE',
                url: url,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(input).closest('tr').remove();
                        cartItem(cartSession);
                        menuCart(cartSession);
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        $("#removeCoupon").click(function() {
            localStorage.setItem("couponCart", '');
            couponCartItem();
            tax();
        });


        function couponCartItem() {
            coupon_code = $.trim(localStorage.getItem("couponCart"));

            $.ajax({
                type: 'post',
                url: "{{ url('') }}" + '/api/client/coupon?currency=' + localStorage.getItem("currency"),
                data: {
                    coupon_code: coupon_code,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + customerToken,
                },
                beforeSend: function() {},
                success: function(data) {
                    $("#coupon_code").val(coupon_code);
                    if (data.status == 'Success') {
                        if (data.data.type == 'fixed') {
                            price = $(".caritem-subtotal").attr('price');
                            if (data.data.currency != '' && data.data.currency != 'null' && data.data
                                .currency != null) {
                                price1 = (price - (data.data.amount * data.data.currency.exchange_rate));
                                $(".caritem-discount-coupon").attr('price', data.data.amount);
                                if (data.data.currency.symbol_position == 'left') {
                                    $(".caritem-discount-coupon").html(data.data.currency.code + ' ' + data.data
                                        .amount);
                                    $(".caritem-grandtotal").html(data.data.currency.code + ' ' + price1
                                        .toFixed(2));
                                } else {
                                    $(".caritem-discount-coupon").html(data.data.amount + ' ' + data.data
                                        .currency.code);
                                    $(".caritem-grandtotal").html(price1.toFixed(2) + ' ' + data.data.currency
                                        .code);
                                }
                            }
                        } else {
                            price = $(".caritem-subtotal").attr('price');
                            price1 = (price / 100) * data.data.amount;
                            $(".caritem-discount-coupon").attr('price', price1.toFixed(2));
                            if (data.data.currency != '' && data.data.currency != 'null' && data.data
                                .currency != null) {
                                if (data.data.currency.symbol_position == 'left') {
                                    $(".caritem-discount-coupon").html(data.data.currency.code + ' ' + price1
                                        .toFixed(2));
                                    price = price - price1
                                    $(".caritem-grandtotal").html(data.data.currency.code + ' ' + price.toFixed(
                                        2));
                                } else {
                                    $(".caritem-discount-coupon").html(price1.toFixed(2) + ' ' + data.data
                                        .currency.code);
                                    price = price - price1
                                    $(".caritem-grandtotal").html(price.toFixed(2) + ' ' + data.data.currency
                                        .code);
                                }
                            }
                        }
                        localStorage.setItem("couponCart", coupon_code);
                    } else {
                        price = $(".caritem-subtotal").attr('price-symbol');
                        $(".caritem-discount-coupon").attr('price', 0);
                        $(".caritem-discount-coupon").html('');
                        $(".caritem-grandtotal").html(price);
                        localStorage.setItem("couponCart", '');
                        toastr.error('{{ trans('invalid-coupon') }}');
                    }
                },
                error: function(data) {
                    price = $(".caritem-subtotal").attr('price-symbol');
                    $(".caritem-discount-coupon").attr('price', 0);
                    $(".caritem-discount-coupon").html('');
                    $(".caritem-grandtotal").html(price);
                    localStorage.setItem("couponCart", '');
                    if (data.status == 422) {
                        // toastr.error(data.responseJSON.message);
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
            });
        }
    </script>


    <script>
        country = state = '';
        $(document).ready(function() {
            getCustomerAdress();
            countries();
        });

        function getCustomerAdress() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/customer_address_book?is_default=1&language_id=' + languageId,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        for (i = 0; i < data.data.length; i++) {
                            $("#delivery_first_name").val(data.data[i].first_name);
                            $("#delivery_last_name").val(data.data[i].last_name);
                            $("#delivery_postcode").val(data.data[i].postcode);

                            if (data.data[i].country_id != 'null' && data.data[i].country_id != null && data
                                .data[i].country_id != '') {
                                country = data.data[i].country_id.country_id;
                            }
                            if (data.data[i].state_id != 'null' && data.data[i].state_id != null && data.data[i]
                                .state_id != '') {
                                state = data.data[i].state_id.id;
                            }
                            countries1();
                            $("#delivery_country_hidden").val(country);
                            $("#delivery_state_hidden").val(state);
                            $("#delivery_city").val(data.data[i].city);
                            $("#delivery_street_aadress").val(data.data[i].street_address);
                            $("#delivery_phone").val(data.data[i].phone);
                        }
                        if (data.data.length == 0) {
                            countries1();
                        }
                        shippingMethodisDefault();
                    }
                },
                error: function(data) {},
            });
        }

        function countries() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}/api/client/country?getAllData=1",
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        html = '<option value="">Select</option>';
                        for (i = 0; i < data.data.length; i++) {
                            selected = '';
                            if ($.trim($("#billing_country_hidden").val()) != '' && $.trim($(
                                    "#billing_country_hidden").val()) == data.data[i].country_id) {
                                selected = 'selected';
                                $("#billing_country_hidden").val('');
                            }

                            html += '<option value="' + data.data[i].country_id + '" ' + selected + '>' + data
                                .data[i].country_name + '</option>';
                        }
                        $("#billing_country").html(html);
                        if ($.trim($("#billing_state_hidden").val()) != '') {
                            $("#billing_country").trigger('change');
                        }
                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        function states() {
            country_id = $("#billing_country").val();
            if (country_id == '') {
                $("#billing_state").html('');
                return;
            }

            $.ajax({
                type: 'get',
                url: "{{ url('') }}/api/client/state?country_id=" + country_id + '&getAllData=1',
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        html = '<option value="">Select</option>';
                        for (i = 0; i < data.data.length; i++) {
                            selected = '';
                            if ($.trim($("#billing_state_hidden").val()) != '' && $.trim($(
                                    "#billing_state_hidden").val()) == data.data[i].id) {
                                selected = 'selected';
                            }
                            html += '<option value="' + data.data[i].id + '" ' + selected + '>' + data.data[i]
                                .name + '</option>';
                        }
                        $("#billing_state").html(html);
                        $("#billing_state_hidden").val('');
                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        function countries1() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}/api/client/country?getAllData=1",
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        html = '<option value="">Select</option>';
                        for (i = 0; i < data.data.length; i++) {
                            selected = '';
                            if ($.trim($("#delivery_country_hidden").val()) != '' && $.trim($(
                                    "#delivery_country_hidden").val()) == data.data[i].country_id) {
                                selected = 'selected';
                                $("#delivery_country_hidden").val('');
                            } else if (data.data[i].country_id == country) {
                                selected = 'selected';
                            }
                            html += '<option value="' + data.data[i].country_id + '" ' + selected + '>' + data
                                .data[i].country_name + '</option>';
                        }
                        $("#delivery_country").html(html);
                        if ($.trim($("#delivery_state_hidden").val()) != '' || country != '') {
                            $("#delivery_country").trigger('change');

                        }

                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        function states1() {

            country_id = $("#delivery_country").val() ? $("#delivery_country").val() : country;
            if (country_id == '') {
                $("#delivery_state").html('');
                return;
            }

            $.ajax({
                type: 'get',
                url: "{{ url('') }}/api/client/state?country_id=" + country_id + '&getAllData=1',
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        htmls = '<option value="">Select</option>';
                        for (i = 0; i < data.data.length; i++) {
                            selected = '';
                            if ($.trim($("#delivery_state_hidden").val()) != '' && $.trim($(
                                    "#delivery_state_hidden").val()) == data.data[i].id) {
                                selected = 'selected';
                            } else if (data.data[i].id == state) {
                                selected = 'selected';
                            }
                            htmls += '<option value="' + data.data[i].id + '" ' + selected + '>' + data.data[i]
                                .name + '</option>';
                        }
                        $("#delivery_state").html(htmls);
                        $("#delivery_state_hidden").val('');
                        tax();
                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        $("#delivery_state").change(function() {
            tax();
        })

        function isDefault(input) {
            id = $(input).attr('data-id');
            $.ajax({
                type: 'put',
                url: "{{ url('') }}/api/client/customer_address_book/" + id,
                data: {
                    is_default: '1',
                    is_default_type: 'default_action',
                    type: 'profile'
                },
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        // toastr.success(data.message)
                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        function shippingEdit(input) {
            id = $(input).attr('data-id');
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/customer_address_book/' + id,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $("#shippingAddressForm").find("#first_name").val(data.data.first_name);
                        $("#shippingAddressForm").find("#last_name").val(data.data.last_name);
                        $("#shippingAddressForm").find("#postcode").val(data.data.postcode);
                        country = state = '';
                        if (data.data.country_id != 'null' && data.data.country_id != null && data.data
                            .country_id != '') {
                            country = data.data.country_id.country_id;
                        }
                        if (data.data.state_id != 'null' && data.data.state_id != null && data.data.state_id !=
                            '') {
                            state = data.data.state_id.id;
                        }
                        countries();
                        $("#shippingAddressForm").find("#country_id_hidden").val(country);
                        $("#shippingAddressForm").find("#state_id_hidden").val(state);
                        $("#shippingAddressForm").find("#city").val(data.data.city);
                        $("#shippingAddressForm").find("#street_address").val(data.data.street_address);
                        $("#shippingAddressForm").find("#gender").val(data.data.gender);
                        $("#shippingAddressForm").find("#dob").val(data.data.dob);
                        $("#shippingAddressForm").find("#phone").val(data.data.phone);
                        $("#shippingAddressForm").find("#method").val('put');
                        $("#shippingAddressForm").find("#addres_id").val(id);
                    }
                },
                error: function(data) {},
            });
        }

        function shippingDelete(input) {
            id = $(input).attr('data-id');
            $.ajax({
                type: 'delete',
                url: "{{ url('') }}" + '/api/client/customer_address_book/' + id,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $(input).closest('tr').remove();
                        // toastr.success(data.message);
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {
                    // toastr.error(data.responseJSON.message);
                    toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                },
            });
        }

        $("#defaultCheck").click(function() {
            if ($.trim($(this).prop('checked')) == 'true') {
                $("#billing_first_name").val($("#delivery_first_name").val());
                $("#billing_last_name").val($("#delivery_last_name").val());
                $("#billing_street_aadress").val($("#delivery_street_aadress").val());
                $("#billing_city").val($("#delivery_city").val());
                $("#billing_postcode").val($("#delivery_postcode").val());
                $("#billing_phone").val($("#delivery_phone").val());
                $("#billing_country_hidden").val($("#delivery_country").val());
                countries();
                $("#billing_state_hidden").val($("#delivery_state").val());
            }
        });

        $(".payment_method").click(function() {
            payment_method = $.trim($(".payment_method:checked").val());
            if (payment_method == 'stripe' || payment_method == 'paypal') {
                $(".stripe_payment").removeClass('d-none');
                $(".bank_transfer").addClass('d-none');
                return;
            }
            if (payment_method == 'banktransfer') {
                $(".bank_transfer").removeClass('d-none');
                $(".stripe_payment").addClass('d-none');
            }
            if(payment_method == 'cod'){
                $(".stripe_payment").addClass('d-none');
                $(".bank_transfer").addClass('d-none');

            }
            
        });


        $(".createOrder").click(function(e) {
            e.preventDefault();
            createOrder();
        });

        $("#esewaButton").click(function(e) {
            e.preventDefault();
            createOrder();
        });

        function createOrder(){
            locations = '';
            billing_first_name = $("#delivery_first_name").val();
            if(billing_first_name == ''){
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('First Name is empty. Fill the required data.');
                $("#delivery_first_name").focus();
                return false;
            }
            billing_last_name = $("#delivery_last_name").val();
            if(billing_last_name == ''){
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Last Name is empty. Fill the required data.');
                $("#delivery_last_name").focus();
                return false;
            }
            billing_street_aadress = $("#delivery_street_aadress").val();
            if(billing_street_aadress == ''){
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Address is empty. Fill the required data.');
                $("#delivery_street_aadress").focus();
                return false;
            }
            billing_country = $("#delivery_country").val();
            if(billing_country == ''){
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Country is empty. Fill the required data.');
                $("#delivery_country").focus();
                return false;
            }
            billing_state = $("#delivery_state").val();
            if(billing_state == ''){
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('State is empty. Fill the required data.');
                $("#delivery_state").focus();
                return false;
            }
            billing_city = $("#delivery_city").val();
            if(billing_city == ''){
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('City is empty. Fill the required data.');
                $("#delivery_city").focus();
                return false;
            }
            billing_postcode = $("#delivery_postcode").val();
            if(billing_postcode == ''){
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Post Code  is empty. Fill the required data.');
                $("#delivery_postcode").focus();
                return false;
            }
            billing_phone = $("#delivery_phone").val();
            if(billing_phone == ''){
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Phone is empty. Fill the required data.');
                $("#delivery_phone").focus();
                return false;
            }

            delivery_first_name = $("#delivery_first_name").val();
            delivery_last_name = $("#delivery_last_name").val();
            delivery_street_aadress = $("#delivery_street_aadress").val();
            delivery_country = $("#delivery_country").val();
            delivery_state = $("#delivery_state").val();
            delivery_city = $("#delivery_city").val();
            delivery_postcode = $("#delivery_postcode").val();
            delivery_phone = $("#delivery_phone").val();
            order_notes = '';
            coupon_code = $.trim(localStorage.getItem("couponCart"));


            payment_method = $(".payment_method:checked").val();
            cc_number = '';
            cc_expiry_month = '';
            cc_expiry_year = '';
            cc_cvc = '';
            if (payment_method == '') {
                toastr.error('Select Payment Method');
                return;
            }else if(payment_method == 'cash_on_delivery'){
                payment_method = 'cod';
            }

            url = '/api/client/order';

            $.ajax({
                type: 'post',
                url: "{{ url('') }}" + url,
                data: {
                    billing_first_name: billing_first_name,
                    billing_last_name: billing_last_name,
                    billing_street_aadress: billing_street_aadress,
                    billing_country: billing_country,
                    billing_state: billing_state,
                    billing_city: billing_city,
                    billing_postcode: billing_postcode,
                    billing_phone: billing_phone,
                    delivery_first_name: delivery_first_name,
                    delivery_last_name: delivery_last_name,
                    delivery_street_aadress: delivery_street_aadress,
                    delivery_country: delivery_country,
                    delivery_state: delivery_state,
                    delivery_city: delivery_city,
                    delivery_postcode: delivery_postcode,
                    delivery_phone: delivery_phone,
                    order_notes: order_notes,
                    coupon_code: coupon_code,
                    latlong: locations,
                    currency_id: localStorage.getItem("currency"),
                    payment_method: payment_method,
                    cc_number: cc_number,
                    cc_expiry_month: cc_expiry_month,
                    cc_expiry_year: cc_expiry_year,
                    cc_cvc: cc_cvc,
                },
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    // console.log(data);
                    if (data.status == 'Success') {
                        if(payment_method == 'esewa'){
                            pid = $('#esewaForm input[name=pid]').val() + '?' + data.data.order_id;
                            $('#esewaForm input[name=pid]').val(pid);
                            $('#esewaForm').submit();
                        }else if(payment_method == 'cod'){
                            window.location.href = "{{ url('/thankyou') }}";
                        }
                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                        $("#pills-shipping-tab").addClass('active');
                        $("#pills-shipping").addClass('show active');
                    }
                },
                error: function(data) {
                    // console.log();
                    if (data.status == 422) {
                        jQuery.each(data.responseJSON.errors, function(index, item) {
                            $("#" + index).parent().find('.invalid-feedback').css('display',
                                'block');
                            $("#" + index).parent().find('.invalid-feedback').html(item);
                        });
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                    $("#pills-shipping-tab").addClass('active');
                    $("#pills-shipping").addClass('show active');

                    $("#pills-billing-tab").removeClass('active');
                    $("#pills-billing").removeClass('show active');

                    $("#pills-method-tab").removeClass('active');
                    $("#pills-method").removeClass('show active');

                    $("#pills-order-tab").removeClass('active');
                    $("#pills-order").removeClass('show active');

                },
            });
        }

        function tax() {
            state_id = $.trim($("#delivery_state").val());
            if (state_id == '') {
                return;
            }

            $.ajax({
                type: 'get',
                url: "{{ url('') }}/api/client/tax_rate?state_id=" + state_id + '&currency=' + localStorage
                    .getItem("currency"),
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        if (data.data != null) {
                            html = '';
                            for (i = 0; i < data.data.length; i++) {
                                total += +data.data[i].tax_amount;
                                tax_Desctiption = 'Tax';
                                if (data.data[i].tax != null && data.data[i].tax != 'null' && data.data[i]
                                    .tax != '') {
                                    tax_Desctiption = data.data[i].tax.tax_description + ' Tax';
                                }
                                html += '<tr><th scope="row">' + tax_Desctiption +
                                    '</th><td align="right" class="caritem-tax" price="' + data.data[i]
                                    .tax_amount + '">' + data.data[i].tax_amount_symbol + '</td></tr>'
                            }
                            $(html).insertBefore("#test");
                            caritemGrandtotal();
                        }
                    } else if (data.status == 'Error') {
                        price = $(".caritem-subtotal").attr('price');
                        couponCart = $(".caritem-discount-coupon").attr('price');
                        if (couponCart == null || couponCart == '') {
                            couponCart = 0;
                        }
                        shipping_price = $(".shipping-tax").attr('data-price');
                        total = +price + +couponCart + +shipping_price;
                        if ($.trim($(".caritem-subtotal").attr('currency-position')) == 'left') {
                            $(".caritem-grandtotal").html($(".caritem-subtotal").attr('currency-code') + ' ' +
                                total.toFixed(2));
                        } else {
                            $(".caritem-grandtotal").html(total.toFixed(2) + ' ' + $(".caritem-subtotal").attr(
                                'currency-code'));
                        }
                        // toastr.error(data.message);
                    }
                },
                error: function(data) {
                    caritemGrandtotal();
                },
            });
        }

        function shippingMethodisDefault() {
            $(".shipping-tax").attr('data-price', 0);
            $.ajax({
                type: 'post',
                url: "{{ url('') }}/api/client/isDefaultShipping",
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        if (data.data != null) {
                            shipping = 0;
                            if (data.data.shipping_method_id == 1) {

                                if ($('.total_by_weight').val() == 0) {
                                    $(".shipping-tax").attr('data-price', 0);
                                    shipping = 0;
                                } else {

                                    $(".shipping-tax").attr('data-price', parseFloat(data.data
                                        .shipping_method_amount) * $('.total_by_weight').val());
                                    shipping = parseFloat(data.data.shipping_method_amount) * $(
                                        '.total_by_weight').val();
                                }
                            } else {
                                alert(data.data.shipping_method_id + '     ' + $('.total_by_weight').val());
                                $(".shipping-tax").attr('data-price', data.data.shipping_method_amount);
                                shipping = data.data.shipping_method_amount;

                            }

                            if ($.trim($(".caritem-subtotal").attr('currency-position')) == 'left') {
                                $(".shipping-tax").html($(".caritem-subtotal").attr('currency-code') + ' ' +
                                    shipping);
                            } else {
                                $(".shipping-tax").html(shipping + ' ' + $(".caritem-subtotal").attr(
                                    'currency-code'));
                            }


                            caritemGrandtotal();
                        }
                    } else if (data.status == 'Error') {
                        caritemGrandtotal();
                        // toastr.error(data.message);
                    }
                },
                error: function(data) {
                    caritemGrandtotal();
                },
            });
        }

        function caritemGrandtotal() {
            couponCart = $(".caritem-discount-coupon").attr('price');
            if (couponCart == null || couponCart == '') {
                couponCart = 0;
            }
            sub_price = $(".caritem-subtotal").attr('price');
            tax_price = $(".caritem-tax").length;
            total_tax_price = 0;
            for (i = 0; i < tax_price; i++) {
                total_tax_price = +total_tax_price + +$(".caritem-tax").eq(i).attr('price');
            }
            shipping_price = $(".shipping-tax").attr('data-price');
            if (shipping_price != 'NaN' && shipping_price != '' && shipping_price != NaN && shipping_price != 'null' &&
                shipping_price != '' && shipping_price != null) {
                total = +sub_price + +total_tax_price + +shipping_price - +couponCart;
            } else {
                if ($.trim($(".caritem-subtotal").attr('currency-position')) == 'left') {
                    $(".shipping-tax").html($(".caritem-subtotal").attr('currency-code') + ' 0');
                } else {
                    $(".shipping-tax").html('0 ' + $(".caritem-subtotal").attr('currency-code'));
                }
                total = +sub_price + +total_tax_price - +couponCart;
            }
            if ($.trim($(".caritem-subtotal").attr('currency-position')) == 'left') {
                $(".caritem-grandtotal").html($(".caritem-subtotal").attr('currency-code') + ' ' + total.toFixed(2));
            } else {
                $(".caritem-grandtotal").html(total.toFixed(2) + ' ' + $(".caritem-subtotal").attr('currency-code'));
            }
        }
    </script>


    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkfQ--NrbuRkdYSFBu1AXlWohPV7RhNyI&libraries=places&callback=initialize" async defer></script>
    <script>
        var markers;
        var myLatlng;
        var map;
        var geocoder;

        function setUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    myLatlng = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    markers.setPosition(myLatlng);
                    map.setCenter(myLatlng);

                }, function() {});
            }
        }

        function saveAddress() {
            var latlng = markers.getPosition();
            geocoder.geocode({
                'location': latlng
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        var street = "";
                        var state = "";
                        var country = "";
                        var city = "";
                        var postal_code = "";

                        for (var i = 0; i < results[0].address_components.length; i++) {
                            for (var b = 0; b < results[0].address_components[i].types.length; b++) {
                                switch (results[0].address_components[i].types[b]) {
                                    case 'locality':
                                        city = results[0].address_components[i].long_name;
                                        break;
                                    case 'administrative_area_level_1':
                                        state = results[0].address_components[i].long_name;
                                        break;
                                    case 'country':
                                        country = results[0].address_components[i].long_name;
                                        break;
                                    case 'postal_code':
                                        postal_code = results[0].address_components[i].long_name;
                                        break;
                                    case 'route':
                                        if (street == "") {
                                            street = results[0].address_components[i].long_name;
                                        }
                                        break;

                                    case 'street_address':
                                        if (street == "") {
                                            street += ", " + results[0].address_components[i].long_name;
                                        }
                                        break;
                                }
                            }
                        }
                        // $("#postcode").val(postal_code);
                        // $("#street").val(street);
                        // $("#city").val(city);

                        // $("#latitude").val(markers.getPosition().lat());
                        // $("#longitude").val(markers.getPosition().lng());

                        // $("#entry_country_id").val(country);

                        $("#latlong").val(latlng);

                        // $("#entry_country_id option").filter(function() {
                        //   //may want to use $.trim in here
                        //   return $(this).text() == country;
                        // }).prop('selected', true);
                        // if(getZones("no_loader")){
                        //   $("#entry_zone_id option").filter(function() {
                        //     //may want to use $.trim in here
                        //     return $(this).text() == state;
                        //   }).prop('selected', true);
                        // }
                        $('#mapModal').hide();
                        $('.modal-backdrop').hide();
                        setTimeout(function() { 
                            // $('#location').focus();
                            $('#latlong').get(0).focus();
                           
                        }, 500);
                       

                    } else {
                        // console.log('No results found');
                    }
                } else {
                    // console.log('Geocoder failed due to: ' + status);
                }
            });
        }

        function initialize() {
            defaultPOS = {
                lat: '31.4',
                lng: '71.1'
            };
            map = new google.maps.Map(document.getElementById('map'), {
                center: defaultPOS,
                zoom: 13,
                mapTypeId: 'roadmap'
            });
            geocoder = new google.maps.Geocoder;
            markers = new google.maps.Marker({
                map: map,
                draggable: true,
                position: defaultPOS
            });



            var infowindow = new google.maps.InfoWindow;
            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                var bounds = new google.maps.LatLngBounds();

                places.forEach(function(place) {
                    if (!place.geometry) {
                        // console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    // console.log(place.geometry.location);
                    // Create a marker for each place.
                    markers.setPosition(place.geometry.location);
                    markers.setTitle(place.name);


                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
    </script> --}}

@endsection
