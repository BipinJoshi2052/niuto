<script>
    loggedIn = localStorage.getItem("customerLoggedin");
    if (loggedIn != '1') {
        localStorage.setItem("loginErrorMessage", "Please Login!!!");
        window.location.href = "{{url('/login')}}";
    }
</script>
@extends('layouts.master')
@section('content')

<section id="breadcrumb_item" class="pb-0 breadcrumb mb-0">
    <div class="container">
      <div class="row">
        <div class="col-md-12 m-auto">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item font-weight-bold">
                <a href="{{ url('/') }}"
                  ><span><i class="fa fa-home" aria-hidden="true"></i></span>
                  HOME</a
                >
              </li>
              <li
                class="breadcrumb-item font-weight-bold"
                aria-current="page"
              >
                <a href="javascript:void(0)" class="text-dark">Order Details</a>
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section id="cart" class="padding section_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-12 mb-xl-0 mb-lg-0 mb-3">
          @include('includes.user-dashboard')
        </div>
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-12">
            <div id="accordion" class="w-100">
                <!-- First Collapse -->
                <div class="card">
                    <div class="card-header p-0 bg-light" id="headingOne">
                        <h5 class="mb-0">
                            <div class="w-100 p-3" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span class="mr-2"><i class="fa fa-ravelry" aria-hidden="true"></i></span> Order#<span class="order-no"></span>
                            </div>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text_gray"><b>Order Status:</b> <span class="order-status"></span></label><br/>
                                        <label class="text_gray"><b>Order Date:</b> <span class="order-date"></span></label><br/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text_gray"><b>Address:</b> <span class="order-delivery-address"></span> </label><br/>
                                        <label class="text_gray"><b>Address Detail:</b> <span class="order-delivery-detail"></span> </label><br/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- First Collapse Ends -->
                <!-- Second Collapse  -->
                <div class="card">
                    <div class="card-header p-0 bg-light" id="headingTwo">
                        <h5 class="mb-0">
                            <div class="collapsed p-3" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="mr-2"><i class="fa fa-ravelry" aria-hidden="true"></i></span> Order Items
                            </div>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <!-- Cart -->
                            <section id="cart-wrapper" class="py-3">
                                <div class="container">
                                    {{-- <div class="row"> --}}
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
                                                                <th class="cart-romove item">Sub Total</th>
                                                            </tr>
                                                        </thead>
                                                        <!-- /thead -->
                                                        <tbody id="order-show-detaill">
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
                                                        <!-- /tbody -->
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            </section>
                            <!-- Cart Ends -->
                        </div>
                    </div>
                </div>
                <!-- Second Collapse End -->
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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
        id = '{{$id}}';
        $.ajax({
            type: 'get',
            url: "{{ url('') }}" +
                '/api/client/customer/order/' + id + '?orderDetail=1&language_id=' + languageId + '&productDetail=1&billing_country=1&billing_state=1&delivery_country=1&delivery_state=1&currency='+localStorage.getItem("currency"),
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {
                    $("#order-show-detaill").html('');
                    order = data.data.order_date.split('T');
                    $(".order-date").html(order[0]); 
                    $(".order-no").html(data.data.order_id);
                    $(".order-status").html(data.data.order_status);
                    $(".order-billing-address").html(data.data.order_status);
                    $(".order-billing-detail").html(data.data.order_status);
                    $(".order-delivery-address").html(data.data.delivery_street_aadress);

                    country = state = '';
                    if(data.data.delivery_country1 != null && data.data.delivery_country1 != 'null' && data.data.delivery_country1 != ''){
                        country = ', '+data.data.delivery_country1.country_name;
                    }
                    if(data.data.delivery_state1 != null && data.data.delivery_state1 != 'null' && data.data.delivery_state1 != ''){
                        state = ', '+data.data.delivery_state1.name;
                    }
                    detail_address = data.data.delivery_street_aadress +', '+ data.data.delivery_city + state +country;
                    $(".order-delivery-detail").html(detail_address);

                    $(".order-billing-address").html(data.data.billing_street_aadress);
                    country = state = '';
                    if(data.data.billing_country1 != null && data.data.billing_country1 != 'null' && data.data.billing_country1 != ''){
                        country = ', '+data.data.billing_country1.country_name;
                    }
                    if(data.data.billing_state1 != null && data.data.billing_state1 != 'null' && data.data.billing_state1 != ''){
                        state = ', '+data.data.billing_state1.name;
                    }
                    detail_address = data.data.billing_street_aadress +', '+ data.data.billing_city + state +country;
                    $(".order-billing-detail").html(detail_address);
                    $(".order-payment-method").html(data.data.payment_method);

                    if (data.data.order_detail != null && data.data.order_detail != 'null' && data.data.order_detail != '') {
                        for (k = 0; k < data.data.order_detail.length; k++) {
                            if (data.data.order_detail[k].product != null && data.data.order_detail[k].product != 'null' && data.data.order_detail[k].product != '') {
                                if (data.data.order_detail[k].product.product_type == 'variable') {
                                    if (data.data.order_detail[k].product_combination.gallary != null && data.data.order_detail[k].product_combination.gallary != 'null' && data.data.order_detail[k].product_combination.gallary != '') {
                                        imgSrc = '/gallary/' + data.data.order_detail[k].product_combination.gallary.gallary_name;
                                        imgAlt = data.data.order_detail[k].product_combination.gallary.gallary_name;
                                        name = data.data.order_detail[k].product.detail[0].title +' - ';
                                        for (loop = 0; loop < data.data.order_detail[k].product_combination.combination
                                            .length; loop++) {
                                            if (data.data.order_detail[k].product_combination.combination.length - 1 == loop) {
                                                name += data.data.order_detail[k].product_combination.combination[loop].variation.detail[0].name;
                                            } else {
                                                name += data.data.order_detail[k].product_combination.combination[loop].variation.detail[0].name + '-';
                                            }
                                        }
                                    }
                                } else {
                                    if (data.data.order_detail[k].product.detail != null && data.data.order_detail[k].product.detail != 'null' && data.data.order_detail[k].product.detail != '') {
                                        imgSrc = '/gallary/' + data.data.order_detail[k].product.product_gallary.gallary_name;
                                        
                                        imgAlt = data.data.order_detail[k].product.product_gallary.gallary_name;

                                        name = data.data.order_detail[k].product.detail[0].title;

                                    }
                                }
                            }
                            if (data.data.currency_id != null && data.data.currency_id != 'null' && data.data.currency_id != '') {
                                if (data.data.currency.symbol_position == 'left') {
                                    price = +data.data.order_detail[k].product_price * +data.data.currency.exchange_rate;
                                    price = data.data.currency_id.code +' '+ price;
                                }
                                else{
                                    price = data.data.order_detail[k].product_price * +data.data.currency.exchange_rate;
                                    price = price +' '+ data.data.currency_id.code;
                                }
                            } else {
                                price = data.data.order_detail[k].product_price;
                            }
                            if (data.data.currency != null && data.data.currency != 'null' && data.data.currency != '') {
                                if (data.data.currency.symbol_position == 'left') {
                                    price = +price * +data.data.currency.exchange_rate;
                                }
                                else{
                                    price = +price * +data.data.currency.exchange_rate;
                                }
                            }
                            quantity = data.data.order_detail[k].product_qty;

                            sub_total = data.data.order_detail[k].product_price * data.data.order_detail[k].product_qty;
                            if (data.data.currency != null && data.data.currency != 'null' && data.data.currency != '') {
                                if (data.data.currency.symbol_position == 'left') {
                                    sub_total = sub_total * +data.data.currency.exchange_rate;
                                    sub_total = data.data.currency.code +' '+ sub_total;
                                } else {
                                    sub_total = sub_total * +data.data.currency.exchange_rate;
                                    sub_total = sub_total +' '+ data.data.currency.code;
                                }
                            } else {
                                sub_total = sub_total;
                            }

                            tbodyRow = '<tr>' +
                                '<td class="cart-image">' +
                                    '<img src="' + imgSrc + '" class="img-fluid cartItem-image OrderDetailImage">' +
                                '</td>' +
                                '<td class="cart-product-name-info">' +
                                    '<h4 class="cart-product-description cartItem-name">' + name + '</h4>' +
                                    '<div class="row">' +
                                        '<div class="col-4">' +
                                            '<div class="rating rateit-small"></div>' +
                                        '</div>' +
                                    '</div>' +
                                '</td>' +
                                '<td class="cart-product-grand-total"><span class="cart-grand-total-price">' + price + '</span>' +
                                '</td>' +
                                '<td class="cart-product-quantity">' +
                                    '<div class="quant-input">' +
                                        '<span>' + quantity + '</span>' +
                                    '</div>' +
                                '</td>' +
                                '<td class="cart-product-grand-total"><span class="cart-grand-total-price">' + sub_total + '</span>' +
                                '</td>' +
                            '</tr>';
                            
                            $("#order-show-detaill").append(tbodyRow);
                        }
                    }
                }
            },
            error: function(data) {},
        });
    }

    function saveComments(){
        id = '{{$id}}';
        comment = $('#comment').val();

        var page_url = "/api/web/add_comments";
        let data = {
            comment:comment,
            id:id
        }

        $.ajax({
                type: 'post',
                url: "{{ url('') }}" + '/api/client/add_comments',
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                data:data,
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        getCustomerOrder();
                        toastr.success('Your Comments are Sent')
                        $('#comment').val('')
                    }
                },
                error: function(data) {
                    toastr.error(data.responseJSON.errors.comment[0])
                    // console.log(data.responseJSON.errors.comment[0],'if error')
                },
            });    
    }
</script>
@endsection