{{-- {{ dd(get_defined_vars()) }} --}}
@extends('layouts.master')
@section('content')
<style>
    .variation_active {
        border: 1px solid;
    }

    .price-active {
        border: 1px solid;
    }
</style>
@include(isset(getSetting()['product_detail']) ? 'includes.productdetail.product-'.getSetting()['product_detail'] : 'includes.productdetail.product-style1')

@include(isset(getSetting()['product_detail']) ? 'includes.productdetail.product-'.getSetting()['product_detail']."-template" : 'includes.productdetail.product-style1-template')

@include('includes.productdetail.related-product-section');

{{-- @include(isset(getSetting()['card_style']) ? 'includes.cart.product_card_'.getSetting()['card_style'] : "includes.cart.product_card_style1") --}}

<input type="hidden" id="product_id" value="{{ $product }}" />

@endsection


@section('script')
<script>
    var attribute_id = [];
    var attribute = [];
    var variation_id = [];
    var variation = [];
    $(document).ready(function() {
        fetchProduct();
        fetchRelatedProduct();

        $('#second-tab').click();
        $("#share").jsSocials({
            url: '{{ url('/') }}',
            text: "Niuto",
            showLabel: false,
            shareIn: 'popup',
            showCount: "inside",
            shares: ["facebook", "twitter", "googleplus", "linkedin", "whatsapp"]
        });
    });

    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    customerId = $.trim(localStorage.getItem("customerId"));

    languageId = localStorage.getItem("languageId");

    if (languageId == null || languageId == 'null') {
        localStorage.setItem("languageId", '1');
        $(".language-default-name").html('Endlish');
        localStorage.setItem("languageName", 'English');
        languageId = 1;
    }

    customerToken = $.trim(localStorage.getItem("customerToken"));


    function fetchProduct() {
        var url = "{{ url('') }}" + '/api/client/products/' + "{{ $product }}" +
            '?getCategory=1&getDetail=1&language_id=' + languageId + '&currency='+localStorage.getItem("currency");
        var appendTo = 'product-page';
        $.ajax({
            type: 'get',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                console.log(data);
                if (data.status == 'Success') {
                    var clone = '';
                    var sideGal = '';
                    var thumbGal = '';
                    var img_str = '';
                    $('#add-to-wishlist').attr('data-id', data.data.product_id);
                    $('#add-to-wishlist').attr('onclick', 'addWishlist(this)');
                    $('#add-to-wishlist').attr('data-type', data.data.product_type);
                    $('#add-to-cart').attr('data-id', data.data.product_id);
                    $('#add-to-cart').attr('onclick', 'addToCart(this)');
                    $('#add-to-cart').attr('data-type', data.data.product_type);
                    $('#buyNow').attr('data-id', data.data.product_id);
                    $('#buyNow').attr('onclick', 'buyNow(this)');
                    $('#buyNow').attr('data-type', data.data.product_type);
                    if (data.data.product_gallary_detail != null && data.data.product_gallary_detail.length > 0) {
                        for (var g = 0; g < data.data.product_gallary_detail.length; g++) {
                            
                            prodGalDetGalName = data.data.product_gallary_detail[g].gallary_name;
                            sideGal += '<li>'+
                                            '<img src="{{ asset('/')}}gallary/large' + prodGalDetGalName + ' " alt="">'+
                                        '</li>';
                            if(g == 0){
                                dataImg = "{{ asset('/') }}gallary/large"+prodGalDetGalName;
            
                                showImg = '<img class="my_img" src="'+ dataImg +'?fit=inside|140:140,'+ dataImg+'?fit=inside|220:220,'+ dataImg +'?fit=inside|540:540" alt="product">';
                            }
                            if(g == 3){
                                break;
                            }
                        }
                        if(data.data.product_combination){
                            for (loop = 0; loop < data.data.product_combination.length; loop++) {
                                if (data.data.product_combination[loop].gallary != null) {
                                    sideGal +=  '<li>'+
                                                    '<img src="{{ asset('/')}}gallary/large' + prodGalDetGalName + ' " alt="">'+
                                                '</li>';
                                    if(loop == 0){
                                        dataImg = "{{ asset('/') }}gallary/large"+prodGalDetGalName;
                                        showImg = '<img class="my_img" src="'+ dataImg +'?fit=inside|140:140,'+ dataImg+'?fit=inside|220:220,'+ dataImg +'?fit=inside|540:540" alt="product">';
                                    }
                                }
                                if(loop == 3){
                                    break;
                                }
                            }
                        }
                    } else {
                        if(data.data.product_gallary != null){
                            sideGal +=  '<li>'+
                                            '<img src="{{ asset("/")}}gallary/' + data.data.product_gallary.gallary_name + ' " alt="">'+
                                        '</li>';
                            dataImg = "{{ asset('/') }}gallary/large"+prodGalDetGalName;
                            showImg = '<img class="my_img" src="'+ dataImg +'?fit=inside|140:140,'+ dataImg+'?fit=inside|220:220,'+ dataImg +'?fit=inside|540:540" alt="product">';
                        }
                    }
                    $('#side-gallery').html(sideGal);
                    $('#zoomGallery').html(showImg);
                    zoomGalleryPicker();


                    if (data.data.detail != null) {
                        $("#pro-title").html(data.data.detail[0].title);
                        $(".pro-desc").html(data.data.detail[0].desc);

                    }

                    if (data.data.product_type == 'simple') {
                            if (data.data.product_discount_price == '' || data.data.product_discount_price == null || data.data.product_discount_price =='null') {
                                $("#product-card-price").html(data.data.product_price_symbol);
                            } else {
                                $("#product-card-price").html(data.data.product_discount_price_symbol); 
                                $('#cut-product-card-price').html(data.data.product_price_symbol);
                            }
                        } else {
                            if (data.data.product_combination != null) {
                                $("#product-card-price").html(data.data.product_combination[0].product_price_symbol);
                        }
                    }
                    if (data.data.reviews !== null) {
                        $(".review-count").html(data.data.reviews.length);
                        rating = '';
                        sum = 0;
                        for(review = 0; review < data.data.reviews.length; review++){
                            sum = +sum + +data.data.reviews[review].rating;
                        }
                        cur_rating = (sum / 5);
                        cur_rating = cur_rating * 100;
                        rating = '<div class="rating">' +
                            '<div class="rating-upper" style="width: ' + cur_rating + '%">' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                            '</div>' +
                            '<div class="rating-lower">' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                            '</div>' +
                        '</div>';
                        $("#display-rating").html(rating);
                    }

                    if (data.data.rating !== null) {
                        // clone.querySelector(".rating").innerHTML = data.data.rating;
                    }

                    $("." + appendTo).append(clone);
                    getProductReview();
                    // slideInital();

                }
            },
            error: function(data) {
                myFunction();
            },
        });
    }

    $(document).on('click', '.variation_list_item', function() {
        var variation_name = $(this).attr('data-variation-name');
        var attribute_name = $(this).attr('data-attribute-name').split(' ').join('_');

        $('.attribute_' + attribute_name + '_div').each(function() {
            $('.attribute_' + attribute_name + '_div').removeClass("variation_active");
        })

        $('.' + variation_name + '-' + attribute_name).addClass("variation_active");

        if (attribute_id.indexOf($(this).attr('data-attribute-id')) === -1) {
            attribute_id.push($(this).attr('data-attribute-id'));
            attribute.push($(this).attr('data-attribute-name'));
            variation_id.push($(this).attr('data-variation-id'));
            variation.push($(this).attr('data-variation-name'));

        } else {

            var index = attribute_id.indexOf($(this).attr('data-attribute-id'));
            if ($(this).attr('data-variation-id') == "") {
                attribute_id.splice(index, 1);
                variation_id.splice(index, 1);
                attribute.splice(index, 1);
                variation.splice(index, 1);
            } else {
                attribute_id[index] = $(this).attr('data-attribute-id');
                variation_id[index] = $(this).attr('data-variation-id');
                attribute[index] = $(this).attr('data-attribute-name');
                variation[index] = $(this).attr('data-variation-name');
            }

        }

        // // console.log(attribute_id, variation_id, attribute, variation);
        var url = "{{ url('') }}" + '/api/client/products/{{ $product }}?getCategory=1&getDetail=1&language_id=' + languageId + '&currency='+localStorage.getItem("currency");
        $.ajax({
            type: 'get',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {
                    for (i = 0; i < data.data.product_combination.length; i++) {
                        p = 0;
                        not_combination = 0;
                        product_combination_id = price = gallary = '';
                        variation_array = new Array();
                        for (k = 0; k < data.data.product_combination[i].combination.length; k++) {
                            variation_array[p] = data.data.product_combination[i].combination[k].variation_id;
                            ++p;
                        }
                        if (variation_array.length == variation_id.length) {
                            // console.log(variation_array);
                            // console.log(variation_id);
                            for (m = 0; m < variation_id.length; m++) {
                                if (jQuery.inArray(parseInt(variation_id[m]), variation_array) == -1) {
                                    not_combination = 1;
                                }
                            }
                        } else {
                            not_combination = 1;
                        }

                        if (not_combination == 0) {
                            product_combination_id = data.data.product_combination[i].product_combination_id;
                            $("#product_combination_id").val(product_combination_id);
                            price = data.data.product_combination[i].product_price_symbol;
                            $(".product-card-price").html(price);

                            if (data.data.product_combination[i].gallary != null) {
                                gallary = data.data.product_combination[i].gallary.gallary_name;
                                var image_list_link = "";
                                var image_list = "";

                                image_list_link = '<a class="" href="/gallary/large' + data.data.product_combination[i].gallary.gallary_name + '" title="Lorem ipsum dolor sit amet"><img class="product-detail-section-image" src="/gallary/large' + data.data.product_combination[i].gallary.gallary_name + '" alt="Zoom Image" /></a>'


                                image_list = '<div class=""><img class="product-detail-section-image" src="/gallary/thumbnail' + data.data.product_combination[i].gallary.gallary_name + '" alt="Zoom Image"/></div>';

                                $("#image-"+data.data.product_combination[i].product_combination_id).trigger('click');

                                // $(".slider-for").removeClass('slick-initialized slick-slider');
                                // $(".slider-for").html(image_list_link);
                                // $(".slider-nav").html(image_list);
                            }
                            return;
                        } else {}
                    }

                    // slideInital();
                }
            },
            error: function(data) {},
        });

    })

    function fetchRelatedProduct() {
        var productID = "{{ $product }}";
        var url = "{{ url('') }}" + '/api/client/products?limit=12&getCategory=1&getDetail=1&productId='+ productID +'&language_id=' + languageId + '&currency='+localStorage.getItem("currency");
        var appendTo = 'related';
        $.ajax({
            type: 'get',
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {
                    var cart = '';
                    var wish = '';
                    var imgSrc = '';
                    var imgAlt = '';
                    var name = '';
                    for (i = 0; i < data.data.length; i++) {
                        if (data.data[i].product_gallary != null) {
                            if (data.data[i].product_gallary.detail != null) {
                                imgSrc = data.data[i].product_gallary.detail[1].gallary_path;
                            }
                        }
                        if (data.data[i].detail != null) {
                            imgAlt = data.data[i].detail[0].title;
                        }
                        if (data.data[i].category != null) {
                            if (data.data[i].category[0].category_detail != null) {
                                if (data.data[i].category[0].category_detail.detail != null) {
                                    name = data.data[i].category[0].category_detail.detail[0].name;
                                }
                            }
                        }
                        if (data.data[i].detail != null) {
                            title = data.data[i].detail[0].title;
                            href = '/product/' + data.data[i].product_id+'/'+data.data[i].product_slug;
                            var desc = data.data[i].detail[0].desc;
                            desc = desc.substring(0, 50);
                        }

                        if (data.data[i].product_type == 'simple') {
                            if (data.data[i].product_discount_price == '' || data.data[i].product_discount_price == null || data.data[i].product_discount_price == 'null') {
                                price = data.data[i].product_price_symbol;
                            } else {
                                price = data.data[i].product_price_symbol + '<span class="strikeThrough ">' +data.data[i].product_discount_price_symbol +'</span>';
                            }
                        } else {
                            if (data.data[i].product_combination != null) {
                                price = data.data[i].product_combination[0].product_price_symbol;
                            }
                        }

                        // clone = '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12  mt-4 mb-3">' +
                        //     '<div class="product-grid-item">' +
                        //         '<div class="product-grid-image">' +
                        //             '<a href="' + href + '">' +
                        //                 '<img class="pic-1 img-fluid" src="' +imgSrc + '">' +
                        //             '</a>' +
                        //             '<ul class="social">' +
                        //                 '<!-- <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li> -->' +
                        //                 '<li><a href="javascript:void(0)" onclick="addWishlist(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>' +
                        //                 '<li><a href="javascript:void(0)" onclick="addToCart(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>' +
                        //             '</ul>' +
                        //             // '<span class="product-new-label font-weight-bold">New</span>' +
                        //             // '<span class="product-discount-label">-10%</span>' +
                        //         '</div>' +
                        //         '<div class="product-content">' +
                        //             '<h4 class="title mt-2"><a href="' + href + '">Product Name</a></h4>' +
                        //             '<div class="price">' +
                        //                 price +
                        //                 // '<span>' + cutPrice + '</span>' +
                        //             '</div>' +
                        //             '<a class="add-to-cart" href=javascript:void(0)" onclick="buyNow(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '">Buy Now</a>' +
                        //         '</div>' +
                        //     '</div>' +
                        // '</div>';


                        clone = '<div class="col-md-3 col-sm-6 col-12">'+
                                    '<div class="item_block bg-white position-relative p-3 mb-md-0 mb-3">'+
                                    '  <div class="img_block">'+
                                    '    <a href="'+ href +'">'+
                                    '      <img src="'+ imgSrc +'" alt="img" class="img-fluid">'+
                                    '  </a>'+
                                    '  </div>'+
                                    '  <div class="content_block pb-3">'+
                                    '    <small>'+ data.data[i].category[0].category_detail.detail[0].name +'</small>'+
                                    '    <a href="'+ href +'"><h4>'+ title +'</h4></a>'+
                                    '    <span class="">'+ price +'</span>'+
                                    '  </div>'+
                                    '  <div class="wish_list_block">'+
                                    '    <a href="javascript:void(0)" onclick="addWishlist(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '"><i class="fa fa-heart" aria-hidden="true"></i></a>'+
                                    '  </div>'+
                                    '  <div class="dis_block">'+
                                    // '    <h5>Sale</h5>'+
                                    '  </div>'+
                                    '  <div class="icon_group">'+
                                    '    <div class="cart_blocks">'+
                                    '      <a href="javascript:void(0)" tabindex="0" onclick="addToCart(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '">'+
                                    '        <i class="fa fa-cart-plus" aria-hidden="true"></i></a>'+
                                    '    </div>'+
                                    '    <div class="cart_block">'+
                                    '      <a href="'+ href +'" tabindex="0">'+
                                    '        <i class="fa fa-eye" aria-hidden="true"></i></a>'+
                                    '    </div>'+
                                    '    <div class="cart_blockss">'+
                                    '      <a href="" tabindex="0">'+
                                    '        <i class="fa fa-exchange" aria-hidden="true"></i></a>'+
                                    '    </div>'+
                                    '  </div>'+
                                    '</div>'+
                                '</div>';
                        
                        $("#featured-product").append(clone);
                    }
                    // getSliderSettings(appendTo);
                }
            },
            error: function(data) {},
        });
    }

    function productReview() {
        rating = $("input[name=rating]").val();
        comment = $("#comment").val();
        title = $("#title").val();
        if(rating == ''){
            toastr.error('{{ trans("select-ratings") }}');
            return;
        }

        var url = "{{ url('') }}" + '/api/client/review?product_id={{ $product }}&comment=' + comment + '&rating=' + rating +'&title='+title;
        var appendTo = 'related';
        $.ajax({
            type: 'post',
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
                    toastr.success('{{ trans("rating-saved-successfully") }}');
                    $("#comment").val('');
                    $("#title").val('');
                    getProductReview();
                }
            },
            error: function(data) {
                // console.log(data);
                if (data.status == 422) {
                    jQuery.each(data.responseJSON.errors, function(index, item) {
                        $("#" + index).parent().find('.invalid-feedback').css('display',
                            'block');
                        $("#" + index).parent().find('.invalid-feedback').html(item);
                    });
                }
                else if (data.status == 401) {
                    toastr.error('{{ trans("response.some_thing_went_wrong") }}');
                }
            },
        });
    }

    $(document).on('click', '#reviewSend', function(e){
        e.preventDefault();
        if(loggedIn != '1'){
            toastr.error('please login to review');
            return false;
        }
        rating = $("#prodRating").val();
        comment = $("#prodComment").val();
        title = '';
        if(rating == ''){
            toastr.error('Select rating');
            return;
        }
        
        var url = "{{ url('') }}" + '/api/client/review?product_id={{ $product }}&comment=' + comment + '&rating=' + rating +'&title='+title +'&customer_id='+customerId;
        var appendTo = 'related';
        $.ajax({
            type: 'post',
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
                    toastr.success('{{ trans("rating-saved-successfully") }}');
                    $("#prodRating").val('');
                    $("#prodComment").val('');
                    getProductReview();
                }else{
                    toastr.errort
                }
            },
            error: function(data) {
                $('#event-loading').css('display', 'none');
                toastr.error(data.responseJSON.message);
            },
        });
    });

    function getProductReview() {
        var url = "{{ url('') }}" + '/api/client/review?product_id={{ $product }}&customer=1';
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
                    $("#review-rating-show").html('');
                    for (review = 0; review < data.data.length; review++) {
                        cur_rating = (data.data[review].rating / 5);
                        cur_rating = cur_rating * 100;
                        image = (data.data[review].customer.customer_avatar || data.data[review].customer.customer_avatar == '') ? '{{ url("/") }}/gallary/' + data.data[review].customer.customer_avatar : 'https://image.ibb.co/jw55Ex/def_face.jpg';
                        if(data.data[review].comment){
                            if(data.data[review].comment == null || data.data[review].comment == 'null'){
                                comment = '';
                            }else{
                                comment = data.data[review].comment;
                            }
                        }
                        span = '<div class="row">' +
                            '<div class="col-md-2">' +
                                '<div class="user_product">' +
                                    '<img src="' + image + '" class="img img-rounded img-fluid" />' +
                                '</div>' +
                                '<p class="text-secondary text-md-center text-left pt-md-0 pt-3">' +
                                    data.data[review].customer.customer_first_name + ' ' + data.data[review].customer.customer_last_name +
                                '</p>' +
                                '<p class="text-secondary text-md-center text-left pt-md-0 pt-3">' +
                                    data.data[review].date +
                                '</p>' +
                            '</div>' +
                            '<div class="col-md-10">' +
                                '<div class="clearfix"></div>' +
                                '<p>' +
                                    '<div class="rating">' +
                                        '<div class="rating-upper" id="product-rating" style="width: ' + cur_rating + '%">' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                        '</div>' +
                                        '<div class="rating-lower">' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                            '<span><i class="fa fa-star" aria-hidden="true"></i></span>' +
                                        '</div>' +
                                    '</div>' +
                                '</p>' +
                                '<p>' +
                                    comment +
                                '</p>' +
                            '</div>' +
                        '</div>';
                        $("#review-rating-show").append(span);
                    }
                }
            },
            error: function(data) {
                // console.log(data);
            },
        });
    }

    function zoomGalleryPicker(){
        (function ($) {
            $.fn.picZoomer = function (options) {
              var opts = $.extend({}, $.fn.picZoomer.defaults, options),
                $this = this,
                $picBD = $('<div class="picZoomer-pic-wp"></div>')
                  .css({ width: opts.picWidth + "px", height: opts.picHeight + "px" })
                  .appendTo($this),
                $pic = $this.children("img").addClass("picZoomer-pic").appendTo($picBD),
                $cursor = $(
                  '<div class="picZoomer-cursor"><i class="f-is picZoomCursor-ico"></i></div>'
                ).appendTo($picBD),
                cursorSizeHalf = { w: $cursor.width() / 2, h: $cursor.height() / 2 },
                $zoomWP = $(
                  '<div class="picZoomer-zoom-wp"><img src="" alt="" class="picZoomer-zoom-pic"></div>'
                ).appendTo($this),
                $zoomPic = $zoomWP.find(".picZoomer-zoom-pic"),
                picBDOffset = { x: $picBD.offset().left, y: $picBD.offset().top };
            
              opts.zoomWidth = opts.zoomWidth || opts.picWidth;
              opts.zoomHeight = opts.zoomHeight || opts.picHeight;
              var zoomWPSizeHalf = { w: opts.zoomWidth / 2, h: opts.zoomHeight / 2 };
            
              $zoomWP.css({
                width: opts.zoomWidth + "px",
                height: opts.zoomHeight + "px",
              });
              $zoomWP.css(
                opts.zoomerPosition || { top: 0, left: opts.picWidth + 30 + "px" }
              );
          
              $zoomPic.css({
                width: opts.picWidth * opts.scale + "px",
                height: opts.picHeight * opts.scale + "px",
              });
          
              $picBD
                .on("mouseenter", function (event) {
                  $cursor.show();
                  $zoomWP.show();
                  $zoomPic.attr("src", $pic.attr("src"));
                })
                .on("mouseleave", function (event) {
                  $cursor.hide();
                  $zoomWP.hide();
                })
                .on("mousemove", function (event) {
                  var x = event.pageX - picBDOffset.x,
                    y = event.pageY - picBDOffset.y;
                
                  $cursor.css({
                    left: x - cursorSizeHalf.w + "px",
                    top: y - cursorSizeHalf.h + "px",
                  });
                  $zoomPic.css({
                    left: -(x * opts.scale - zoomWPSizeHalf.w) + "px",
                    top: -(y * opts.scale - zoomWPSizeHalf.h) + "px",
                  });
                });
              return $this;
            };
            $.fn.picZoomer.defaults = {
              picHeight: 460,
              scale: 2.5,
              zoomerPosition: { top: "0", left: "380px" },
            
              zoomWidth: 400,
              zoomHeight: 460,
            };
        })(jQuery);
        $(".picZoomer").picZoomer();
          $(".piclist li").on("click", function (event) {
            var $pic = $(this).find("img");
            $(".picZoomer-pic").attr("src", $pic.attr("src"));
        });
    }
</script>
@endsection
