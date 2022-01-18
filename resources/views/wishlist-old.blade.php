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
                    <li class="">WishList</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">WishList</h2>
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
                                                    <th class="cart-description item">Image</th>
                                                    <th class="cart-product-name item">Product Name</th>
                                                    <th class="cart-qty item">Quantity</th>
                                                    <th class="cart-romove item"></th>
                                                </tr>
                                            </thead>
                                            <!-- /thead -->
                                            <tbody id="wishlist-show">
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

    wishListShow();
    function wishListShow() {
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
                // // console.log(data);
                if (data.status == 'Success') {
                    $("#wishlist-show").html('');
                    for (i = 0; i < data.data.length; i++) {
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

                        if (data.data[i].product_type == 'simple') {
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
                        tbodyRow = '<tr data-row="wishlistRows">' +
                            '<td class="cart-image">' +
                                '<a class="entry-thumbnail" href="' + href + '">' +
                                    '<img src="' + imgSrc + '" class="img-fluid">' +
                                '</a>' +
                            '</td>' +
                            '<td class="cart-product-name-info">' +
                                '<h4 class="cart-product-description"><a href="' + href + '">' + title + '</a></h4>' +
                                '<div class="row">' +
                                    '<div class="col-4">' +
                                        '<div class="rating rateit-small"></div>' +
                                    '</div>' +
                                '</div>' +
                            '</td>' +
                            '<td class="cart-product-quantity">' +
                                '<div class="quant-input">' +
                                    '<input type="number" value="1" class="wishlistProductQty">' +
                                '</div>' +
                            '</td>' +
                            '<td class="romove-item">' +
                                '<button type="button" class="btn btn-primary mx-1" onclick="addToCart(this)" data-id="' + data.data[i].products.product_id + '" data-type="' + data.data[i].products.product_type + '"><i class="fa fa-shopping-bag"> </i> Add To Cart</button>' +
                                '<button type="button" class="btn btn-primary mx-1" onclick="removeWishlist(this)" data-id="' + data.data[i].wishlist + '"><i class="fa fa-trash-o"></i> Remove</button>' +
                            '</td>' +
                        '</tr>';
                        $("#wishlist-show").append(tbodyRow);
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