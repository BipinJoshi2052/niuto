{{-- <script>
    loggedIn = localStorage.getItem("customerLoggedin");
    if (loggedIn != '1') {
        localStorage.setItem("loginErrorMessage", "Please Login!!!");
        window.location.href = "{{ url('/login') }}";
    }

</script> --}}
@extends('layouts.master')
@section('content')
    <section id="breadcrumb_item" class="pb-0 breadcrumb mb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item font-weight-bold">
                                <a href="{{ url('/') }}"><span><i class="fa fa-home" aria-hidden="true"></i></span>
                                    HOME</a>
                            </li>
                            <li class="breadcrumb-item font-weight-bold" aria-current="page">
                                <a href="javascript:void(0)" class="text-dark">CHECKOUT</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--========================== CHECKOUT START  --->
    <section id="checkout" class="padding">
        <div class="container">
            <div class="checkout-wrapper box_shado px-4 pt-4">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="my-car-title d-flex mb-3">
                            <div class="my-cart-number">1</div>
                            <div class="my-cart-order">
                                <h4>Order Summary</h4>
                            </div>
                        </div>
                        <!-- table start  -->
                        <div id="table_content" class="table-responsive-lg">
                            <table class="table border_new">
                                <thead>
                                    <tr class="text-center">
                                        <th class="font-weight-bold text-dark">Product Image</th>
                                        <th class="font-weight-bold text-dark t-cart">Product</th>
                                        <th class="font-weight-bold text-dark">Price</th>
                                        <th class="font-weight-bold text-dark">Quantity</th>
                                        <th class="font-weight-bold text-dark">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="cartItem-product-show2">
                                    {{-- <tr class="text-center">
                                        <td class="border_trhee">
                                            <div class="img-block">
                                                <img src="https://montechbd.com/shopist/demo/public/uploads/1619866402-h-250-7-front-f.jpg"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column w-100">
                                                <div class="head w-100">Blue Diamond Almonds</div>
                                            </div>
                                        </td>
                                        <td class="text_gray">$20</td>
                                        <td class="text_gray">
                                            <div class="qty">
                                                <input type="number" class="" name="qty" value="1">
                                            </div>
                                        </td>
                                        <td class="text_gray">$0</td>
                                        <td class="text_gray">$20</td>
                                    </tr> --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="text_gray" colspan="3"></td>
                                        <td class="text_gray">Sub Total</td>
                                        <td class="text_gray caritem-subtotal">0</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="text_gray" colspan="3"></td>
                                        <td class="text_gray">Total</td>
                                        <td class="text_gray caritem-grandtotal">0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- table end  -->
                    </div>

                    <div class="col-xl-12">
                        <div class="my-car-title d-flex mb-3 mt-4">
                            <div class="my-cart-number">2</div>
                            <div class="my-cart-order d-flex justify-content-between w-100 align-items-center">
                                <div class="title w-50">
                                    <h4>Shipping Information</h4>
                                </div>

                                <div class="w-50 d-flex justify-content-center align-items-center">
                                    <button type="button" id="shippingAddressButton" class="btn btn-primary d-none"
                                        data-toggle="modal" data-target="#addNewShippingAddressModal">
                                        Add New Address
                                    </button>
                                    <div class="check ml-3">
                                        <input type="checkbox" style="width:unset;" id="pickupCheckbox"> <span>Pickup Point</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- table start  -->
                        {{-- <div id="shipping_table_content" class="table-responsive-lg d-none">
                            <table class="table border_new">
                                <thead>
                                    <tr class="text-center">
                                        <th class="font-weight-bold text-dark">
                                        </th>
                                        <th class="font-weight-bold text-dark t-cart">
                                            {{ trans('lables.shipping-address-first-name') }}</th>
                                        <th class="font-weight-bold text-dark">
                                            {{ trans('lables.shipping-address-last-name') }}</th>
                                        <th class="font-weight-bold text-dark">
                                            {{ trans('lables.shipping-address-country-state-city') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" id="shipping-address-listing-show">
                                    
                                </tbody>

                            </table>
                        </div> --}}
                        <!-- table end  -->


                        <!--========================== SHIPPING START  --->

                        <div class="grid shipping_info_card d-none" id="shipping">

                        </div>

                        <div class="grid pickup_info_card d-none" id="pickupCard">

                        </div>
                        <!--========================== SHIPPING end  --->

                        <form class="d-none" id="shipping_detail_form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="text_gray mt-3">First Name</label>
                                    <input type="text" class="form-control w-100" id="delivery_first_name">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text_gray mt-3">Last Name</label>
                                    <input type="text" class="form-control w-100" id="delivery_last_name">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text_gray mt-3">Address</label>
                                    <input type="text" class="form-control w-100" id="delivery_street_aadress">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text_gray mt-3">City</label>
                                    <input type="text" class="form-control w-100" id="delivery_city">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text_gray mt-3">Country</label>
                                    <select class="form-control w-100" id="delivery_country" onchange="states()"></select>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text_gray mt-3">State</label>
                                    <select class="form-control" id="delivery_state"></select>
                                </div>
                                <input type="hidden" class="form-control" id="delivery_state_hidden">
                                <input type="hidden" class="form-control" id="delivery_country_hidden">
                                <div class="col-md-6">
                                    <label for="" class="text_gray mt-3">Postal Code</label>
                                    <input type="text" class="form-control w-100" placeholder="5468" id="delivery_postcode">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="text_gray mt-3">Phone Number</label>
                                    <input type="text" class="form-control w-100" placeholder="" id="delivery_phone">
                                </div>
                            </div>
                        </form>



                        <form class="d-none" id="pickup_form">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="country"></label>
                                    <select id="pickupSelectCountry" class="form-control">
                                        <option value="">Select Country</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="my-car-title d-flex mt-5">
                            <div class="my-cart-number">3</div>
                            <div class="my-cart-order">
                                <h4>Payment Information</h4>
                            </div>
                        </div>
                        <div class="my-cart-payment">
                            <ul class="mb-0 py-4">
                                @foreach ($payment_method_default as $payment_methods)
                                    <li>
                                        <span
                                            class="d-flex justify-content-start justify-content-lg-center align-items-center">
                                            <input type="radio" id="inlineCheckbox{{ $payment_methods->id }}"
                                                name="customRadio" class="payment_method"
                                                {{ old('customRadio', $loop->first ? 'checked' : '') }}
                                                value="{{ $payment_methods->payment_method }}">
                                            <label class="my-auto" for="inlineCheckbox{{ $payment_methods->id }}">
                                                <h5 class="font-weigth-normal mb-0">
                                                    {{ ucwords(str_replace('_', ' ', $payment_methods->payment_method)) }}
                                                </h5>
                                            </label>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="my-car-title d-flex mb-3">
                            <div class="my-cart-number">4</div>
                            <div class="my-cart-order">
                                <h4>Confirm Order</h4>
                            </div>
                        </div>
                        <div class="btn_groups-single large-btn my-5 rounded-0">
                            <button type="button" class="btn-purpal createOrder confirmButton">Confirm</button>
                        </div>
                        <div hidden>
                            <form action="" method="POST" id="esewaForm" class="my-3 mx-auto">
                                <input value="10" name="tAmt" type="hidden">
                                <input value="10" name="amt" type="hidden">
                                <input value="0" name="txAmt" type="hidden">
                                <input value="0" name="psc" type="hidden">
                                <input value="0" name="pdc" type="hidden">
                                <input value="" name="scd" type="hidden">
                                <input value="" name="pid" type="hidden">
                                <input value="{{ route('esewa-verify') }}?q=su" type="hidden" name="su">
                                <input value="{{ route('esewa-verify') }}?q=fu" type="hidden" name="fu">
                                <div class="btn_groups-single large-btn my-5 rounded-0">
                                    <button type="submit" class="btn-purpal esewaButton confirmButton"
                                        id="esewaButton">Confirm Esewa</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--========================== CHECKOUT END  --->

    {{-- Template Start --}}
    <template id="shipping-address-listing-template">
        <tr class="shipping-address-listing-id">
            <td>
                <div class="form-check">
                    <input class="form-check-input shipping-address-listing-is-default" name="radiobtn" type="radio">
                </div>
            </td>
            <td>
                <label class="form-check-label shipping-address-listing-first-name">
                </label>
            </td>
            <td>
                <label class="form-check-label shipping-address-listing-last-name">
                </label>
            </td>
            <td>
                <label class="form-check-label shipping-address-listing-country-state-city">
                </label>
            </td>

            {{-- <td class="edit-tag">
                <ul class="d-inline-flex">
                    <li><a href="javascript:void(0)" class="shipping-address-listing-edit-btn"> <i class="fas fa-pen"></i> Edit</a></li>
                    <li><a href="javascript:void(0)" class="shipping-address-listing-delete-btn"> <i class="fas fa-trash-alt"></i> Remove</a></li>
                </ul>

            </td> --}}
        </tr>
    </template>

    <template id="shipping-address-listing-card-template">
        <label class="card">
            <input name="plan" class="radio shipping-address-listing-card-is-default" type="radio">

            <span class="plan-details">
                <span class="plan-type shipping-address-listing-first-name-last-name"></span>
                {{-- <span class="plan-cost">$0<span class="slash">/</span><abbr
                        class="plan-cycle" title="month">mo</abbr></span> --}}
                <span><b>Country: </b> <span id="detail_card_country"></span></span>
                <span><b>State: </b><span id="detail_card_state"></span></span>
                <span><b>City: </b><span id="detail_card_city"></span></span>
            </span>
        </label>
    </template>


    <template id="pickup-card-template">
        <label class="card">
            <input name="plan" class="radio pickup-address-listing-card-is-default" type="radio">

            <span class="plan-details">
                <span class="plan-type pickup-address-listing-first-name-last-name"></span>
                <span><b>Country: </b> <span id="pickup_detail_card_country"></span></span>
                <span><b>State: </b><span id="pickup_detail_card_state"></span></span>
                <span><b>City: </b><span id="pickup_detail_card_city"></span></span>
            </span>
        </label>
    </template>
    {{-- Template End --}}

    {{-- <input type="hidden" class="total_by_weight" /> --}}



    {{-- Add new shipping address modal --}}

    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="addNewShippingAddressModal" tabindex="-1" role="dialog"
        aria-labelledby="addNewShippingAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewShippingAddressModalLabel">Add New Shipping Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="shipping_detail_form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="text_gray mt-3">First Name</label>
                                <input type="text" name="new_first_name" class="form-control w-100" id="new_first_name">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="text_gray mt-3">Last Name</label>
                                <input type="text" name="new_last_name" class="form-control w-100" id="new_last_name">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="text_gray mt-3">Address</label>
                                <input type="text" name="new_street_aadress" class="form-control w-100"
                                    id="new_street_aadress">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="text_gray mt-3">City</label>
                                <input type="text" name="new_city" class="form-control w-100" id="new_city">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="text_gray mt-3">Country</label>
                                <select class="form-control w-100" name="new_country" id="new_country"
                                    onchange="getStatesInModal()">
                                    <option value="">Select Country</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="text_gray mt-3">State</label>
                                <select class="form-control" name="new_state" id="new_state">
                                    <option value="">Select State</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="text_gray mt-3">Postal Code</label>
                                <input type="text" class="form-control w-100" placeholder="" id="new_postcode"
                                    name="new_postcode">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="text_gray mt-3">Phone Number</label>
                                <input type="text" class="form-control w-100" placeholder="" id="new_phone"
                                    name="new_phone">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="SaveNewShippingAddress">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End add new shipping address modal --}}


@endsection
@section('script')
    <script src="{{ asset('frontend/assets/js/jquery-validate.min.js') }}"></script>
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


        });

        $(document).ajaxStop(function() {
            var d = new Date();
            var productSkus = d.getTime();
            $.each($('#cartItem-product-show2 > tr'), function() {
                if (productSkus == '') {
                    productSkus += $(this).attr('product_sku');
                } else {
                    productSkus += '>' + $(this).attr('product_sku');
                }
            });
            // console.log($('.caritem-grandtotal').html())
            var total = $('.caritem-grandtotal').html().split(' ').slice(-1)[0];
            // console.log(total);
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
                beforeSend: function(data) {

                },
                success: function(data) {
                    if (data.data.length == 0) {
                        window.location.href = "{{ url('/shop') }}";
                    }
                    if (data.status == 'Success') {
                        $("#cartItem-product-show2").html('');
                        total_price = 0;
                        total_weight = 0;

                        for (i = 0; i < data.data.length; i++) {
                            price = 0;
                            discount = 0;
                            afterDiscountPrice = 0;
                            imageSrc = '';
                            imageAlt = '';
                            itemName = '';
                            afterDiscountPrice = data.data[i].discount_price;
                            if (data.data[i].product_type == 'variable') {
                                for (k = 0; k < data.data[i].combination.length; k++) {
                                    if (data.data[i].product_combination_id == data.data[i].combination[k]
                                        .product_combination_id) {
                                        total_weight += parseInt(data.data[i].product_weight) * parseInt(data
                                            .data[i].qty);
                                        if (afterDiscountPrice > 0) {
                                            price = afterDiscountPrice;
                                        } else {
                                            price = data.data[i].combination[k].price;
                                        }
                                        if (data.data[i].combination[k].gallary != null) {
                                            imageSrc = '/gallary/' + data.data[i].combination[k].gallary
                                                .gallary_name;
                                            imageAlt = data.data[i].combination[k].gallary.gallary_name;
                                            itemName = data.data[i].product_detail[0].title + ' ';
                                            for (loop = 0; loop < data.data[i].product_combination
                                                .length; loop++) {
                                                if (data.data[i].product_combination[loop].length - 1 == loop) {
                                                    itemName += data.data[i].product_combination[loop].variation
                                                        .detail[0].name;
                                                } else {
                                                    itemName += data.data[i].product_combination[loop].variation
                                                        .detail[0].name + '-';
                                                }
                                            }
                                        }
                                        k = data.data[i].combination.length;
                                    }
                                }
                                // if (data.data[i].product_detail != null && $.trim(data.data[i]
                                //         .product_detail) != '') {
                                //     imageAlt = data.data[i].product_detail[0].title;
                                //     itemName = data.data[i].product_detail[0].title;
                                // }
                            } else {
                                total_weight += parseInt(data.data[i].product_weight) * parseInt(data.data[i]
                                    .qty);
                                if (data.data[i].product_gallary != null && $.trim(data.data[i]
                                        .product_gallary) != '') {
                                    if (data.data[i].product_gallary.detail != null && $.trim(data.data[i]
                                            .product_gallary.detail) != '') {
                                        imageSrc = data.data[i].product_gallary.detail[2].gallary_path;
                                    }
                                }
                                if (data.data[i].product_detail != null && $.trim(data.data[i]
                                        .product_detail) != '') {
                                    imageAlt = data.data[i].product_detail[0].title;
                                    itemName = data.data[i].product_detail[0].title;
                                }
                                if (afterDiscountPrice > 0) {
                                    price = afterDiscountPrice;
                                } else {
                                    price = data.data[i].price;
                                }
                            }
                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    sum = +data.data[i].qty * +price;
                                    cartItemTotal = data.data[i].currency.code + ' ' + sum;
                                    cartItemPrice = data.data[i].currency.code + ' ' + price;
                                } else {
                                    sum = +data.data[i].qty * +price;
                                    cartItemTotal = sum + ' ' + data.data[i].currency.code;
                                    cartItemPrice = price + ' ' + data.data[i].currency.code;
                                }
                            } else {
                                cartItemPrice = discount_price;
                            }
                            itemQty = +data.data[i].qty;
                            itemQtyId = 'quantity' + i;

                            total_price += (price * itemQty);

                            if ($.trim(data.data[i].category_detail[0].category_detail) != '' && $.trim(data
                                    .data[i].category_detail[0].category_detail) != 'null' && $.trim(data.data[
                                    i].category_detail[0].category_detail) != null) {
                                categoryName = data.data[i].category_detail[0].category_detail.detail[0].name;
                            }

                            tbodyRow = '<tr class="text-center cartItem-row" product_combination_id="' + data
                                .data[i].product_combination_id + '" product_id="' + data.data[i].product_id +
                                '" product_type="' + data.data[i].product_type + '" product_sku="' + data.data[
                                    i].product_slug + '">' +
                                '<td class="border_trhee">' +
                                '   <div class="img-block">' +
                                '      <img src="' + imageSrc + '" alt="">' +
                                '   </div>' +
                                '</td>' +
                                '<td>' +
                                '   <div class="d-flex flex-column w-100">' +
                                '      <div class="head w-100">' + itemName + '</div>' +
                                '   </div>' +
                                '</td>' +
                                '<td class="text_gray">' + cartItemPrice + '</td>' +
                                '<td class="text_gray">' +
                                '   <div class="">' +
                                '     ' + itemQty + ' ' +
                                '   </div>' +
                                '</td>' +
                                '<td class="text_gray">' + cartItemTotal + '</td>' +
                                '<td class="remove-item">' +
                                '<a href="javascript:void(0)" class="fa fa-trash-o text-danger cartItem-remove" onclick="removeCartItem(this)" data-id="' +
                                data.data[i].product_id + '" data-combination-id="' + data.data[i]
                                .product_combination_id + '"></a>' +
                                '</td>' +
                                '</tr>';
                            $("#cartItem-product-show2").append(tbodyRow);

                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    $(".caritem-subtotal").html(data.data[i].currency.code + ' ' + total_price);
                                    $(".caritem-subtotal").attr('price', total_price);
                                    $(".caritem-subtotal").attr('currency-position', data.data[i].currency
                                        .symbol_position);
                                    $(".caritem-subtotal").attr('currency-code', data.data[i].currency.code);
                                    $(".caritem-subtotal").attr('price-symbol', data.data[i].currency.code +
                                        ' ' + total_price);
                                    $(".caritem-grandtotal").html(data.data[i].currency.code + ' ' + total_price
                                        .toFixed(2));
                                    $(".shipping-tax").attr('data-price', '0');
                                } else {
                                    $(".caritem-subtotal").html(total_price + ' ' + data.data[i].currency.code);
                                    $(".caritem-subtotal").attr('price', total_price);
                                    $(".shipping-tax").attr('data-price', '0');
                                    $(".caritem-subtotal").attr('price-symbol', data.data[i].currency.code +
                                        ' ' + total_price);
                                    $(".caritem-grandtotal").html(total_price.toFixed(2) + ' ' + data.data[i]
                                        .currency.code);
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
                url = "{{ url('') }}" + '/api/client/cart/delete?session_id=' + cartSession + '&product_id=' +
                    product_id +
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
        $(document).ready(function(){
            $("#pickupCheckbox").on("click", function(){
                if($(this).is(":checked")){
                    getPickupInformation();
                    $("#shipping").addClass('d-none');
                } else {
                    getShippingInformation();
                    $("#shipping").removeClass('d-none');
                }
            });
        });


        function getPickupInformation() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/customer_address_book',
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        if (data.data.length > 0) {
                            $(".pickup_info_card").removeClass('d-none');
                            $(".pickup_info_card").html('');
                            const templ = document.getElementById("pickup-card-template");
                            for (i = 0; i < data.data.length; i++) {
                                const clone = templ.content.cloneNode(true);
                                clone.querySelector(".pickup-address-listing-first-name-last-name")
                                    .innerHTML = data.data[i].first_name + ' ' + data.data[i].last_name;
                                country = state = '';
                                if (data.data[i].country_id != 'null' && data.data[i].country_id != null && data
                                    .data[i].country_id != '') {
                                    country = data.data[i].country_id.country_name + ', ';
                                    cardCountry = data.data[i].country_id.country_name;
                                }
                                if (data.data[i].state_id != 'null' && data.data[i].state_id != null && data
                                    .data[i]
                                    .state_id != '') {
                                    state = data.data[i].state_id.name + ', ';
                                    cardState = data.data[i].state_id.name;
                                }
                                clone.querySelector("#pickup_detail_card_country").innerHTML = cardCountry;
                                clone.querySelector("#pickup_detail_card_state").innerHTML = cardState;
                                clone.querySelector("#pickup_detail_card_city").innerHTML = data.data[i].city;
                                clone.querySelector(".pickup-address-listing-card-is-default")
                                    .setAttribute('data-id', data.data[i].id);
                                clone.querySelector(".pickup-address-listing-card-is-default")
                                    .setAttribute('onclick', 'setPickupInformation(this)');
                                if (data.data[i].default_address == '1') {
                                    $("#shippingAddressForm").find("#gender").val(data.data[i].gender);
                                    $("#shippingAddressForm").find("#dob").val(data.data[i].dob);
                                    $("#shippingAddressForm").find("#phone").val(data.data[i].phone);
                                    // clone.querySelector(".pickup-address-listing-card-is-default")
                                    //     .setAttribute(
                                    //         'checked', true);
                                }
                                $(".pickup_info_card").html(clone);
                            }
                        } else {
                            $(".pickup_info_card").addClass('d-none');
                        }
                    }
                },
                error: function(data) {},
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            $("#addNewShippingAddressModal").on("shown.bs.modal", function(e) {
                getcountriesInModal();
            });


            // $("#shipping_detail_form").validate({
            //     rules: {
            //         new_first_name: "required",
            //         new_last_name: "required",
            //         new_phone: {
            //             required: true,
            //             digits: true,
            //             minlength: 10,
            //             maxlength: 13
            //         },
            //         new_street_aadress: "required",
            //         new_city: "required",
            //         new_country: "required",
            //         new_state: "required",
            //         new_postcode: "required",
            //     },
            //     messages: {
            //         new_first_name: "The first name is required",
            //         new_last_name: "The last name is required",
            //         new_phone: {
            //             digits: "Phone must contain only numeric value",
            //             minlength: "Phone must have at least 10 digits",
            //             maxlength: "The phone length must not be greater than 13",
            //         },
            //         new_street_aadress: "The street address is required",
            //         new_city: "The city is required",
            //         new_country: "Select Country",
            //         new_state: "Select State",
            //         new_postcode: "Postcode is required",

            //     },
            //     submitHandler: function() {
            //         $("#shipping_detail_form").submit();
            //     }

            // });


            $("#SaveNewShippingAddress").on('click', function() {
                var new_first_name = $("#new_first_name").val(),
                    new_last_name = $("#new_last_name").val(),
                    new_phone = $("#new_phone").val(),
                    new_country = $("#new_country").val(),
                    new_state = $("#new_state").val(),
                    new_postcode = $("#new_postcode").val(),
                    new_street_address = $("#new_street_aadress").val(),
                    new_city = $("#new_city").val();
                if (new_first_name == '') {
                    toastr.error('First name is required');
                    return false;
                } else if (new_last_name == '') {
                    toastr.error('Last name is required');
                    return false;
                } else if (new_phone == '') {
                    toastr.error('Phone is required');
                    return false;
                } else if (new_country == '') {
                    toastr.error('Country is required');
                    return false;
                } else if (new_state == '') {
                    toastr.error('State is required');
                    return false;
                } else if (new_postcode == '') {
                    toastr.error('Postcode is required');
                    return false;
                } else if (new_street_address == '') {
                    toastr.error('Street Address is required');
                    return false;
                } else if (new_city == '') {
                    toastr.error("City is required");
                    return false;
                } else {
                    $.ajax({
                        type: 'put',
                        url: "{{ url('') }}" +
                            '/api/client/profile/' + customerId,
                        data: {
                            first_name: new_first_name,
                            last_name: new_last_name,
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
                                toastr.success(
                                    'Shipping address added sucessfully'
                                );
                                localStorage.customerFname = data.data.customer_first_name;
                                localStorage.customerLname = data.data.customer_last_name;
                            } else if (data.status == 'Error') {
                                toastr.error(
                                    '{{ trans('response.some_thing_went_wrong') }}');
                            }
                        },
                        error: function(data) {
                            if (data.status == 422) {
                                jQuery.each(data.responseJSON.errors, function(index, item) {
                                    $("#" + index).parent().find('.invalid-feedback')
                                        .css('display',
                                            'block');
                                    $("#" + index).parent().find('.invalid-feedback')
                                        .html(item);
                                });
                            } else {
                                toastr.error(
                                    '{{ trans('response.some_thing_went_wrong') }}');
                            }
                        },
                    });

                    var url = '/api/client/customer_address_book';
                    $.ajax({
                        type: "post",
                        url: "{{ url('') }}" + url,
                        data: {
                            is_default: '1',
                            first_name: new_first_name,
                            last_name: new_last_name,
                            phone: new_phone,
                            country_id: new_country,
                            state_id: new_state,
                            street_address: new_street_address,
                            postcode: new_postcode,
                            city: new_city,
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
                                getShippingInformation();
                                $("#delivery_first_name").val(new_first_name);
                                $("#delivery_last_name").val(new_last_name);
                                $("#delivery_street_aadress").val(new_street_address);
                                $("#delivery_city").val(new_city);
                                $("#delivery_country").val(new_country);
                                $("#delivery_state").val(new_state);
                                $("#delivery_postcode").val(new_postcode);
                                $("#delivery_phone").val(new_phone);
                                $("#delivery_state_hidden").val(new_state);
                                $("#delivery_country").trigger('change');
                                $("#addNewShippingAddressModal").modal('toggle');
                            } else if (data.status == 'Error') {
                                toastr.error(
                                    '{{ trans('response.some_thing_went_wrong') }}');
                            }
                        },
                        error: function(data) {
                            if (data.status == 422) {
                                jQuery.each(data.responseJSON.errors, function(index, item) {
                                    $("#" + index).parent().find('.invalid-feedback')
                                        .css('display',
                                            'block');
                                    $("#" + index).parent().find('.invalid-feedback')
                                        .html(item);
                                });
                            } else {
                                toastr.error(
                                    '{{ trans('response.some_thing_went_wrong') }}');
                            }
                        },
                    });
                }
            });
        });
    </script>


    <script>
        country = state = '';
        $(document).ready(function() {
            getCustomerAdress();
            // countries();
            // states1();
            getShippingInformation();
        });


        function getShippingInformation() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/customer_address_book',
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        if (data.data.length > 0) {
                            $("#shipping_table_content").addClass('d-none');
                            $(".shipping_info_card").removeClass('d-none');
                            $("#shipping_detail_form").addClass('d-none');
                            $("#shippingAddressButton").removeClass('d-none');
                            $("#shipping-address-listing-show").html('');
                            $(".shipping_info_card").html('');
                            const templ = document.getElementById("shipping-address-listing-template");
                            const cardTempl = document.getElementById("shipping-address-listing-card-template");
                            for (i = 0; i < data.data.length; i++) {
                                const clone = templ.content.cloneNode(true);
                                const cloneCard = cardTempl.content.cloneNode(true);
                                cloneCard.querySelector(".shipping-address-listing-first-name-last-name")
                                    .innerHTML = data.data[i].first_name + ' ' + data.data[i].last_name;
                                // clone.querySelector(".shipping-address-listing-first-name").innerHTML = data
                                //     .data[i]
                                //     .first_name;
                                // clone.querySelector(".shipping-address-listing-last-name").innerHTML = data
                                //     .data[i]
                                //     .last_name;
                                country = state = '';
                                if (data.data[i].country_id != 'null' && data.data[i].country_id != null && data
                                    .data[i].country_id != '') {
                                    country = data.data[i].country_id.country_name + ', ';
                                    cardCountry = data.data[i].country_id.country_name;
                                }
                                if (data.data[i].state_id != 'null' && data.data[i].state_id != null && data
                                    .data[i]
                                    .state_id != '') {
                                    state = data.data[i].state_id.name + ', ';
                                    cardState = data.data[i].state_id.name;
                                }
                                cloneCard.querySelector("#detail_card_country").innerHTML = cardCountry;
                                cloneCard.querySelector("#detail_card_state").innerHTML = cardState;
                                cloneCard.querySelector("#detail_card_city").innerHTML = data.data[i].city;
                                // clone.querySelector(".shipping-address-listing-country-state-city").innerHTML =
                                //     country + state + data.data[i].city;
                                // clone.querySelector(".shipping-address-listing-is-default").setAttribute(
                                //     'data-id',
                                //     data.data[i].id);
                                // clone.querySelector(".shipping-address-listing-is-default").setAttribute(
                                //     'onclick',
                                //     'setAddress(this)');
                                cloneCard.querySelector(".shipping-address-listing-card-is-default")
                                    .setAttribute('data-id', data.data[i].id);
                                cloneCard.querySelector(".shipping-address-listing-card-is-default")
                                    .setAttribute('onclick', 'setAddress(this)');
                                // clone.querySelector(".shipping-address-listing-edit-btn").setAttribute('data-id', data.data[i].id);
                                // clone.querySelector(".shipping-address-listing-edit-btn").setAttribute('onclick', 'shippingEdit(this)');
                                // clone.querySelector(".shipping-address-listing-delete-btn").setAttribute('data-id', data.data[i].id);
                                // clone.querySelector(".shipping-address-listing-delete-btn").setAttribute('onclick', 'shippingDelete(this)');
                                if (data.data[i].default_address == '1') {
                                    $("#shippingAddressForm").find("#gender").val(data.data[i].gender);
                                    $("#shippingAddressForm").find("#dob").val(data.data[i].dob);
                                    $("#shippingAddressForm").find("#phone").val(data.data[i].phone);
                                    // clone.querySelector(".shipping-address-listing-is-default").setAttribute(
                                    //     'checked', true);
                                    cloneCard.querySelector(".shipping-address-listing-card-is-default")
                                        .setAttribute(
                                            'checked', true);
                                }
                                // $("#shipping-address-listing-show").append(clone);
                                $(".shipping_info_card").append(cloneCard);
                            }
                            $("#shippingAddressForm").find("#method").val('post');
                        } else {
                            $("#shipping_table_content").addClass('d-none');
                            $(".shipping_info_card").addClass('d-none');
                            $("#shipping_detail_form").removeClass('d-none');
                            $("#shippingAddressButton").addClass('d-none');
                        }
                    }
                },
                error: function(data) {},
            });
        }


        function setAddress(input) {
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

                        $("#delivery_first_name").val(data.data.first_name);
                        $("#delivery_last_name").val(data.data.last_name);
                        $("#delivery_postcode").val(data.data.postcode);

                        country = state = '';
                        if (data.data.country_id != 'null' && data.data.country_id != null && data.data
                            .country_id != '') {
                            country = data.data.country_id.country_id;
                        }
                        if (data.data.state_id != 'null' && data.data.state_id != null && data.data.state_id !=
                            '') {
                            state = data.data.state_id.id;
                        }
                        // countries1();
                        $("#delivery_country_hidden").val(country);
                        $("#delivery_country").val(country);
                        $("#delivery_country").trigger('change');
                        $("#delivery_state_hidden").val(state);
                        $("#delivery_state").val(state);
                        $("#delivery_city").val(data.data.city);
                        $("#delivery_street_aadress").val(data.data.street_address);
                        $("#delivery_phone").val(data.data.phone);
                    }
                },
                error: function(data) {},
            });
        }



        function setPickupInformation(input){
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

                        $("#delivery_first_name").val(data.data.first_name);
                        $("#delivery_last_name").val(data.data.last_name);
                        $("#delivery_postcode").val(data.data.postcode);

                        country = state = '';
                        if (data.data.country_id != 'null' && data.data.country_id != null && data.data
                            .country_id != '') {
                            country = data.data.country_id.country_id;
                        }
                        if (data.data.state_id != 'null' && data.data.state_id != null && data.data.state_id !=
                            '') {
                            state = data.data.state_id.id;
                        }
                        // countries1();
                        $("#delivery_country_hidden").val(country);
                        $("#delivery_country").val(country);
                        $("#delivery_country").trigger('change');
                        $("#delivery_state_hidden").val(state);
                        $("#delivery_state").val(state);
                        $("#delivery_city").val(data.data.city);
                        $("#delivery_street_aadress").val(data.data.street_address);
                        $("#delivery_phone").val(data.data.phone);
                    }
                },
                error: function(data) {},
            });
        }

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
                            $("#delivery_country_hidden").val(country);
                            $("#delivery_state_hidden").val(state);
                            countries1();
                            $("#delivery_country").val(country);

                            $("#delivery_state").val(state);
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
                            if (data.data[i].country_name == 'Nepal') {
                                selected = 'selected';
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
            // alert("elo");
            country_id = $("#delivery_country").val();

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

                        html = '<option value="">Select</option>';
                        for (i = 0; i < data.data.length; i++) {
                            selected = '';

                            if ($.trim($("#delivery_state_hidden").val()) != '' && $.trim($(
                                    "#delivery_state_hidden").val()) == data.data[i].id) {
                                selected = 'selected';
                            }
                            html += '<option value="' + data.data[i].id + '" ' + selected + '>' + data.data[i]
                                .name + '</option>';
                        }

                        $("#delivery_state").html(html);
                        $("#delivery_state_hidden").val('');
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
                            // else if (data.data[i].country_name == 'Nepal') {
                            //     selected = 'selected';
                            // }
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




        function getcountriesInModal() {
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
                        html = '<option value="">Select Country</option>';
                        for (i = 0; i < data.data.length; i++) {
                            html += '<option value="' + data.data[i].country_id + '">' + data
                                .data[i].country_name + '</option>';
                        }
                        $("#new_country").html(html);

                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }


        function getStatesInModal() {
            var modal_country_id = $("#new_country").val();

            $.ajax({
                type: 'get',
                url: "{{ url('') }}/api/client/state?country_id=" + modal_country_id + '&getAllData=1',
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        htmls = '<option value="">Select State</option>';
                        for (i = 0; i < data.data.length; i++) {
                            htmls += '<option value="' + data.data[i].id + '">' + data.data[i]
                                .name + '</option>';
                        }
                        $("#new_state").html(htmls);
                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {},
            });
        }

        function states1() {

            country_id = $("#delivery_country").val() ? $("#delivery_country").val() : country;
            if (!country) {
                country_id = 149;
            }

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
            if (payment_method == 'esewa') {
                $('#esewaForm').parent().attr('hidden', false);
                $('.createOrder').attr('hidden', true);
                $.ajax({
                    type: 'post',
                    data: {
                        'payment_method': payment_method,
                    },
                    url: '{{ url('') }}' + '/api/client/esewaMerchant',
                    headers: {
                        'Authorization': 'Bearer ' + customerToken,
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                        clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                    },
                    beforeSend: function() {},
                    success: function(response) {
                        $("#esewaForm").attr('action', response.ESEWA_URL);
                        $('#esewaForm input[name="scd"]').val(response.ESEWA_MERCHANT_ID);
                    }
                });
                $(".stripe_payment").addClass('d-none');
                $(".bank_transfer").addClass('d-none');
            }
            if (payment_method == 'stripe' || payment_method == 'paypal') {
                $('#esewaForm').parent().attr('hidden', true);
                $('.createOrder').attr('hidden', false);
                $(".stripe_payment").removeClass('d-none');
                $(".bank_transfer").addClass('d-none');
                return;
            }
            if (payment_method == 'banktransfer') {
                $('#esewaForm').parent().attr('hidden', true);
                $('.createOrder').attr('hidden', false);
                $(".bank_transfer").removeClass('d-none');
                $(".stripe_payment").addClass('d-none');
            }
            if (payment_method == 'cash_on_delivery') {
                $('#esewaForm').parent().attr('hidden', true);
                $('.createOrder').attr('hidden', false);
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

        function createOrder() {
            locations = '';
            billing_first_name = $("#delivery_first_name").val();
            if (billing_first_name == '') {
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('First Name is empty. Fill the required data.');
                $("#delivery_first_name").focus();
                return false;
            }
            billing_last_name = $("#delivery_last_name").val();
            if (billing_last_name == '') {
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Last Name is empty. Fill the required data.');
                $("#delivery_last_name").focus();
                return false;
            }
            billing_street_aadress = $("#delivery_street_aadress").val();
            if (billing_street_aadress == '') {
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Address is empty. Fill the required data.');
                $("#delivery_street_aadress").focus();
                return false;
            }
            billing_country = $("#delivery_country").val();
            if (billing_country == '') {
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Country is empty. Fill the required data.');
                $("#delivery_country").focus();
                return false;
            }
            billing_state = $("#delivery_state").val();
            if (billing_state == '') {
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('State is empty. Fill the required data.');
                $("#delivery_state").focus();
                return false;
            }
            billing_city = $("#delivery_city").val();
            if (billing_city == '') {
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('City is empty. Fill the required data.');
                $("#delivery_city").focus();
                return false;
            }
            billing_postcode = $("#delivery_postcode").val();
            if (billing_postcode == '') {
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").addClass('show');
                toastr.error('Post Code  is empty. Fill the required data.');
                $("#delivery_postcode").focus();
                return false;
            }
            billing_phone = $("#delivery_phone").val();
            if (billing_phone == '') {
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
            } else if (payment_method == 'cash_on_delivery') {
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
                beforeSend: function() {
                    $(".createOrder").attr('disabled', true);
                    i = 0;
                    interval = setInterval(function() {
                        i = ++i % 4;
                        $(".createOrder").html("Wait Your Order is Submitting" + Array(i + 1).join(
                            "."));
                    }, 200);
                },
                success: function(data) {
                    // console.log(data);
                    if (data.status == 'Success') {
                        clearInterval(interval);
                        if (payment_method == 'esewa') {
                            pid = $('#esewaForm input[name=pid]').val() + '?' + data.data.order_id;
                            $('#esewaForm input[name=pid]').val(pid);
                            $('#esewaForm').submit();
                        } else if (payment_method == 'cod') {
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
            currencyCode = $(".caritem-subtotal").attr('currency-code') ? $(".caritem-subtotal").attr('currency-code') : '';
            totalP = total ? total.toFixed(2) : 0;
            if ($.trim($(".caritem-subtotal").attr('currency-position')) == 'left') {
                $(".caritem-grandtotal").html(currencyCode + ' ' + totalP);
            } else {
                $(".caritem-grandtotal").html(totalP + ' ' + currencyCode);
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
