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
                    <li class="">Order</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">Order</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumbs Ends -->
<!-- Profile -->
<section id="profile-wrapper" class="py-3">
    <div class="container">
        <div class="row py-xl-5 py-md-3 py-0">
            @include('includes.side-menu')
            <div class="col-xl-9 col-lg-9 col-md-11 col-10 mt-xl-0 mt-md-0 mt-3">
                <section id="cart-wrapper" class="py-3">
                    <div class="container">
                        <div class="row">
                            <div class="shopping-cart">
                                <div class="shopping-cart-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="cart-qty item">Order Id</th>
                                                    <th class="cart-qty item">Order Date</th>
                                                    <th class="cart-description item">Description</th>
                                                    <th class="cart-description item">Status</th>
                                                    <th class="cart-romove item"></th>
                                                </tr>
                                            </thead>
                                            <!-- /thead -->
                                            <tbody id="order-showw">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<!-- Profile Ends -->

@endsection
@section('script')
<script>
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    if (loggedIn != '1') {
        window.location.href = "{{url('/')}}";
    }

    languageId = localStorage.getItem("languageId");
    if (languageId == null || languageId == 'null') {
        localStorage.setItem("languageId", '1');
        $(".language-default-name").html('Endlish');
        localStorage.setItem("languageName", 'English');
        languageId = 1;
    }

    cartSession = $.trim(localStorage.getItem("cartSession"));
    if (cartSession == null || cartSession == 'null') {
        cartSession = '';
    }
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    customerToken = $.trim(localStorage.getItem("customerToken"));
    customerId = $.trim(localStorage.getItem("customerId"));

    $(document).ready(function() {
        getCustomerOrder();
    });

    function getCustomerOrder() {
        $.ajax({
            type: 'get',
            url: "{{ url('') }}" +
                '/api/client/customer/order?orderDetail=1&language_id=' + languageId + '&productDetail=1&sortBy=id&sortType=DESC&currency='+localStorage.getItem("currency"),
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {
                    $("#order-show").html('');
                    for (i = 0; i < data.data.length; i++) {
                        order = data.data[i].order_date.split('T');
                        if (data.data[i].currency != null && data.data[i].currency != 'null' && data.data[i].currency != '') {
                            if (data.data[i].currency.symbol_position == 'left') {
                                price = (data.data[i].order_price * +data.data[i].currency.exchange_rate);
                                price = data.data[i].currency.code +' '+ price;
                            } else {
                                price = (data.data[i].order_price * +data.data[i].currency.exchange_rate);
                                price = price +' '+ data.data[i].currency.code;
                            }
                        } else {
                            price = data.data[i].order_price;
                        }
                        orderStatus = data.data[i].order_status === 'Pending' ? data.data[i].order_status + ' / <button type="button" class="btn btn-primary mx-1" onClick="cancelStatus(' + data.data[i].order_id + ')"> Cancel Order</button>' : data.data[i].order_status;
                        if (data.data[i].order_detail != null && data.data[i].order_detail != 'null' && data.data[i].order_detail != '') {
                            if (data.data[i].order_detail[0].product != null && data.data[i].order_detail[0].product != 'null' && data.data[i].order_detail[0].product != '') {
                                if (data.data[i].order_detail[0].product.product_type == 'variable') {
                                    if (data.data[i].order_detail[0].product_combination.gallary != null) {
                                        for (loop = 0; loop < data.data[i].order_detail[0].product_combination.combination
                                            .length; loop++) {
                                            if (data.data[i].order_detail[0].product_combination.combination.length - 1 == loop) {
                                                name += data.data[i].order_detail[0].product_combination.combination[loop].variation
                                                    .detail[0].name;
                                            } else {
                                                name += data.data[i].order_detail[0].product_combination.combination[loop].variation
                                                    .detail[0].name + '-';
                                            }
                                        }
                                    }
                                } else {
                                    if (data.data[i].order_detail[0].product.detail != null) {
                                        // clone.querySelector(".order-image").setAttribute('src',
                                        //     '/gallary/' + data.data[i].order_detail[0].product.product_gallary.gallary_name);
                                        name = data.data[i].order_detail[0].product.detail[0].title;
                                    }
                                }
                            }
                        }
                        tBodyRow = '<tr>' +
                            '<td class="cart-product-grand-total"><span class="cart-grand-total-price">' + data.data[i].order_id + '</span></td>' +
                            '<td class="cart-product-grand-total"><span class="cart-grand-total-price">' + order[0] + '</span></td>' +
                            '<td class="cart-product-name-info">' +
                                '<h4 class="cart-product-description"><a href="/orders/' + data.data[i].order_id + '">' + name + '</a></h4>' +
                                '<div class="row justify-content-center">' +
                                    '<div class="col-12">' +
                                        '<div class="rating rateit-small">' + price + '</div>' +
                                    '</div>' +
                                    '<div class="col-12">' +
                                        '<div class="rating rateit-small">' + data.data[i].order_notes + '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td class="cart-product-grand-total">' + orderStatus + '</td>' +
                            '<td class="romove-item">' +
                                '<a href="/orders/'+data.data[i].order_id+'" title="cancel" class="icon">' +
                                    '<button type="button" class="btn btn-primary mx-1"> <i class="fa fa-eye"></i> View Detail</button>' +
                                '</a>' +
                            '</td>' +
                        '</tr>';
                        $("#order-showw").append(tBodyRow);
                    }
                }
            },
            error: function(data) {},
        });
    }


    function cancelStatus(order) {
        // alert(order);

        $.ajax({
            method: 'post',
            url: "{{ url('') }}" +
                '/api/client/order/' + order,
            data: { _method:'PUT',order_status:'Cancel'},
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {
                    getCustomerOrder()
                }
            },
            error: function(data) {},
        });
        // 
    }
</script>
@endsection