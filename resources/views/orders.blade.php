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
                <a href="javascript:void(0)" class="text-dark">Orders</a>
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <!--============================= CART PAGGE START  ============================ -->
  <section id="cart" class="padding section_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-12 mb-xl-0 mb-lg-0 mb-3">
          @include('includes.user-dashboard')
        </div>
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive px-md-3 pb-md-3">
                <table class="table text-center">
                  <thead class="table_cart mibile_one table_header_padding text-white">
                    <tr>
                      <th scope="col" class="th_first font-weight-normal">
                        Order ID
                      </th>
                      <th scope="col" class="th_first font-weight-normal">
                        Date
                      </th>
                      <th scope="col" class="font-weight-normal">Total</th>
                      <th scope="col" class="font-weight-normal">Status</th>
                      <th scope="col" class="font-weight-normal"></th>
                    </tr>
                  </thead>
                  <tbody class="box_sha" id="order-showw">
                    {{-- <tr>
                      <td class="cart_td gray_title">
                        <div class="product_des">
                          <h3>#123456</h3>
                        </div>
                      </td>
                      <td class="cart_td gray_title">
                        <div class="product_des">
                          <h3>6/24/2021</h3>
                        </div>
                      </td>
                      <td class="gray_title">$ 25</td>
                      <td class="cart-product-order-date">
                        <span class="bg-success text-white px-3 py-2"
                          >Delivered</span
                        >
                      </td>
                      <td>
                        <a href="" class="wishlist_cart_btn view_btn"
                          ><i class="fa fa-eye" aria-hidden="true"></i
                        ></a>
                      </td>
                    </tr> --}}
                  </tbody>
                </table>
                <div class="row"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--============================= CART PAGGE END  ============================ -->

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
                    // console.log(data);
                    var rowCount = data.data.length;
                    if(rowCount == 0)
                    {
                      var noOrders = '<span>No Orders</span>';
                      $("#order-showw").html(noOrders);
                    }
                    $("#order-show").html('');
                    for (i = 0; i < data.data.length; i++) {
                        order = data.data[i].order_date.split('T');
                        if (data.data[i].currency != null && data.data[i].currency != 'null' && data.data[i].currency != '') {
                            if (data.data[i].currency.symbol_position == 'left') {
                                // console.log('hello');
                                price = (data.data[i].order_price * +data.data[i].currency.exchange_rate);
                                price = data.data[i].currency.code +' '+ price;
                            } else {
                                // console.log('Hiiii');
                                price = (data.data[i].order_price * +data.data[i].currency.exchange_rate);
                                price = price +' '+ data.data[i].currency.code;
                            }
                        } else {
                            price = data.data[i].order_price;
                        }

                        orderStatus = data.data[i].order_status === 'Pending' ? '<span class="badge badge-success">'+ data.data[i].order_status +'</span>' + ' / <span class="badge badge-danger text-white" style="cursor:pointer" onClick="cancelStatus(' + data.data[i].order_id + ')">Cancel Order</span>' : '<span class="badge badge-success text-white px-3 py-2">'+ data.data[i].order_status +'</span>';
                        // orderStatus = data.data[i].order_status === 'Pending' ? data.data[i].order_status + ' / <button type="button" class="btn btn-primary mx-1" onClick="cancelStatus(' + data.data[i].order_id + ')"> Cancel Order</button>' : data.data[i].order_status;
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
                        tBodyRow = '<tr>'+
                                        '<td class="cart_td gray_title">'+
                                        '  <div class="product_des">'+
                                        '    <h3>'+ data.data[i].order_id +'</h3>'+
                                        '  </div>'+
                                        '</td>'+
                                        '<td class="cart_td gray_title">'+
                                        '  <div class="product_des">'+
                                        '    <h3>'+ order[0] +'</h3>'+
                                        '  </div>'+
                                        '</td>'+
                                        '<td class="gray_title">'+ price +'</td>'+
                                        '<td class="cart-product-order-date">'+
                                        ' '+ orderStatus +' '+
                                        '</td>'+
                                        '<td>'+
                                        '  <a href="/orders/'+ data.data[i].order_id +'" class="wishlist_cart_btn view_btn">'+
                                        '  <i class="fa fa-eye" aria-hidden="true"></i>'+
                                        '  </a>'+
                                        '</td>'+
                                    '</tr>';
                        $("#order-showw").append(tBodyRow);
                        
                    }
                    var rowCount = $('.order-showw tr').length;
                  
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