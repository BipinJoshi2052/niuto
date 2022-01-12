<script>
    loggedIn = localStorage.getItem("customerLoggedin");
    if (loggedIn != '1') {
        localStorage.setItem("loginErrorMessage", "Please Login!!!");
        window.location.href = "{{url('/login')}}";
    }
</script>
@extends('layouts.master')
@section('content')

<!--========================== HEADER END  --->
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
                <a href="javascript:void(0)" class="text-dark">Wishlist</a>
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--============================= WISHLIST PAGGE START  ============================ -->
  <section id="cart" class="padding section_bg wishlist_page">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-12 mb-xl-0 mb-lg-0 mb-3">
          @include('includes.user-dashboard')
        </div>
        <div class="col-md-9">
          <div id="table_content" class="table-responsive p-md-3 p-2">
            <table class="table text-center">
              <thead class="table_cart mibile_one table_header_padding text-white">
                <tr>
                  <th scope="col" class="th_first font-weight-normal">
                    Product Image
                  </th>
                  <th scope="col" class="product_content font-weight-normal">
                    Product
                  </th>
                  <th scope="col" class="font-weight-normal">Quantity</th>
                  <th scope="col" class="font-weight-normal">Total</th>

                  <th scope="col" class="font-weight-normal"></th>
                  <th scope="col" class="font-weight-normal"></th>
                </tr>
              </thead>
              <tbody class="box_sha" id="wishlist-show">
                {{-- <tr>
                  <th scope="row">
                    <div class="cart_img">
                      <img src="https://montechbd.com/shopist/demo/public/uploads/1619869340-h-250-tv2.png" alt="">
                    </div>
                  </th>
                  <td class="cart_td gray_title">
                    <div class="product_des">
                      <h3>Blue Diamond Almonds</h3>
                    </div>
                  </td>
                  <td class="gray_title">
                    <div class="qty">
                      <span class="minus">-</span>
                      <input type="number" class="count" name="qty" value="1">
                      <span class="plus">+</span>
                    </div>
                  </td>
                  <td class="gray_title">$ 25</td>

                  <td class="gray_title">
                    <a href="" class="wishlist_cart_btn cart_button">
                        <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    </a>
                  </td>
                  <td class="gray_title">
                    <a href="" class="wishlist_cart_btn remove_btn">
                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr> --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--============================= WISHLIST PAGGE END  ============================ -->
 
@endsection
@section('script')
<script>
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    // if (loggedIn != '1') {
    //     window.location.href = "{{url('/')}}";
    // }

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
        // getCustomerOrder();
        
    });
    // $(document).ajaxStop(function(){
      wishListShow();
    // });
    
    function wishListShow() {
        console.log("Hello Wishlist");
        var url = "{{ url('') }}" +
                '/api/client/wishlist?limit=100&getCategory=1&getDetail=1&language_id=' + languageId +
                '&sortBy=id&sortType=DESC&topSelling=1&currency='+localStorage.getItem("currency");
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
                    $("#wishlist-show").html('');
                    for (i = 0; i < data.data.length; i++) {
                        console.log(data.data.length); 
                        href = '/product/' + data.data[i].products.product_id + '/' + data.data[i].products.product_slug;
                        if (data.data[i].products.product_gallary != null && data.data[i].products.product_gallary != 'null' && data.data[i].products.product_gallary != '') {
                            if (data.data[i].products.product_gallary.detail != null && data.data[i].products.product_gallary.detail != 'null' && data.data[i].products.product_gallary.detail != '') {
                                if(data.data[i].products.product_gallary.detail[2].gallary_path){
                                    imgSrc = data.data[i].products.product_gallary.detail[2].gallary_path;
                                }
                            }
                        }
                        if (data.data[i].products.detail != null && data.data[i].products.detail != 'null' && data.data[i].products.detail != '') {
                            imgAlt = data.data[i].products.detail[0].title;
                        }
                        if (data.data[i].products.category != null && data.data[i].products.category != 'null' && data.data[i].products.category != '') {
                            if (data.data[i].products.category[0].category_detail != null && data.data[i].products.category[0].category_detail != 'null' && data.data[i].products.category[0].category_detail != ''
                            ) {
                                if (data.data[i].products.category[0].category_detail.detail != null && data.data[i].products.category[0].category_detail.detail != 'null' && data.data[i].products.category[0].category_detail.detail != '') {
                                    // clone.querySelector(".product-card-category").innerHTML = data.data[i].products.category[0].category_detail.detail[0].name;
                                }
                            }
                        }
                        if (data.data[i].products.detail != null && data.data[i].products.detail != 'null' && data.data[i].products.detail != '') {
                            title = data.data[i].products.detail[0].title;
                            desc = data.data[i].products.detail[0].desc;
                        }

                        wishlistProductPrice = data.data[i].products.product_price_symbol;
                        if (data.data[i].product_type == 'simple') {
                            console.log('simple');
                            if (data.data[i].product_discount_price == '' || data.data[i].product_discount_price == null || data.data[i].product_discount_price == 'null') {
                                wishlistProductPrice = data.data[i].product_price_symbol;
                            } else {
                                wishlistProductPrice = data.data[i].product_discount_price_symbol + '<span>' +data.data[i].product_price_symbol + '</span>';
                            }
                        } else {
                            
                            if (data.data[i].product_combination != null && data.data[i].product_combination != 'null' && data.data[i].product_combination != '') {
                                wishlistProductPrice = data.data[i].product_combination[0].product_price_symbol;
                            }
                        }
                        // tbodyRow = '<tr data-row="wishlistRows">' +
                        //     '<td class="cart-image">' +
                        //         '<a class="entry-thumbnail" href="' + href + '">' +
                        //             '<img src="' + imgSrc + '" class="img-fluid">' +
                        //         '</a>' +
                        //     '</td>' +
                        //     '<td class="cart-product-name-info">' +
                        //         '<h4 class="cart-product-description"><a href="' + href + '">' + title + '</a></h4>' +
                        //         '<div class="row">' +
                        //             '<div class="col-4">' +
                        //                 '<div class="rating rateit-small"></div>' +
                        //             '</div>' +
                        //         '</div>' +
                        //     '</td>' +
                        //     '<td class="cart-product-quantity">' +
                        //         '<div class="quant-input">' +
                        //             '<input type="number" value="1" class="wishlistProductQty">' +
                        //         '</div>' +
                        //     '</td>' +
                        //     '<td class="romove-item">' +
                        //         '<button type="button" class="btn btn-primary mx-1" onclick="addToCart(this)" data-id="' + data.data[i].products.product_id + '" data-type="' + data.data[i].products.product_type + '"><i class="fa fa-shopping-bag"> </i> Add To Cart</button>' +
                        //         '<button type="button" class="btn btn-primary mx-1" onclick="removeWishlist(this)" data-id="' + data.data[i].wishlist + '"><i class="fa fa-trash-o"></i> Remove</button>' +
                        //     '</td>' +
                        // '</tr>';
                        tbodyRow = '<tr data-row="wishlistRows">'+
                                    '<th scope="row">'+
                                    '  <div class="cart_img">'+
                                    '    <img src="'+ imgSrc +'" alt="">'+
                                    '  </div>'+
                                    '</th>'+
                                    '<td class="cart_td gray_title cart-product-name-info">'+
                                    '  <div class="product_des">'+
                                    '    <h3>'+ title +'</h3>'+
                                    '  </div>'+
                                    '</td>'+
                                    '<td class="gray_title cart-product-quantity">'+
                                    '  <div class="qty">'+
                                    '    <span class="minus" onclick="decreaseCartInput($(this).next())">-</span>'+
                                    '    <input type="number" class="count wishlistProductQty" name="qty" value="1">'+
                                    '    <span class="plus" onclick="increaseCartInput($(this).prev())">+</span>'+
                                    '  </div>'+
                                    '</td>'+
                                    '<td class="gray_title">'+ wishlistProductPrice +'</td>'+
                                    '<td class="gray_title">'+
                                    '  <a href="javascript:void(0)" onclick="addToCart(this)" data-id="' + data.data[i].products.product_id + '" data-type="' + data.data[i].products.product_type + '" class="wishlist_cart_btn cart_button">'+
                                    '      <i class="fa fa-cart-plus" aria-hidden="true"></i>'+
                                    '  </a>'+
                                    '</td>'+
                                    '<td class="gray_title">'+
                                    '  <a href="javascript:void(0)" class="wishlist_cart_btn remove_btn" onclick="removeWishlist(this)" data-id="' + data.data[i].wishlist + '">'+
                                    '      <i class="fa fa-trash-o" aria-hidden="true"></i>'+
                                    '  </a>'+
                                    '</td>'+
                                '</tr>';
                        console.log(tbodyRow);
                        $("#wishlist-show").append(tbodyRow);
                    }

                    if(data.data.length == 0){
                        $("#table_content").html('<p style="font-weight:600; font-size:20px;">No data in your wishlist</p>');
                    }
                }
            },
            error: function(data) {},
        });
    }

    function removeWishlist(input){
        id = $(input).attr('data-id');
        var url = "{{ url('') }}" +
                '/api/client/wishlist/'+id;
        $.ajax({
            type: 'delete',
            url: url,
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {
                $('#event-loading').css('display', 'block');
            },
            success: function(data) {
                $('#event-loading').css('display', 'none');
                if (data.status == 'Success') {
                    toastr.success('{{ trans("wishlist-remove") }}');
                    wishListShow();
                    getWishlist();
                }
            },
            error: function(data) {
                $('#event-loading').css('display', 'none');
            },
        });

    }
    
    $(document).on('click', '.quantity-right-plus', function() {
        var row_id = $(this).attr('data-field');

        var quantity = $('#quantity' + row_id).val();
        $('#quantity' + row_id).val(parseInt(quantity) + 1);
    })

    $(document).on('click', '.quantity-left-minus', function() {
        var row_id = $(this).attr('data-field');
        var quantity = $('#quantity' + row_id).val();
        if (quantity > 1)
            $('#quantity' + row_id).val(parseInt(quantity) - 1);
    })
</script>
@endsection