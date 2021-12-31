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

@include(isset(getSetting()['card_style']) ? 'includes.cart.product_card_'.getSetting()['card_style'] : "includes.cart.product_card_style1")

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
            text: "Sharma Acoustic",
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
                if (data.status == 'Success') {
                    var clone = '';
                    var topGal = '';
                    var thumbGal = '';
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
                            topGal += '<div class="swiper-slide easyzoom easyzoom--overlay">' +
                                '<a href="{{ asset('/') }}gallary/large' + prodGalDetGalName + '">' +
                                    '<img src="{{ asset('/') }}gallary/large' + prodGalDetGalName + '" alt="" />' +
                                '</a>' +
                            '</div>';
                            thumbGal += '<div class="swiper-slide">' +
                                '<img src="{{ asset('/') }}gallary/large' + prodGalDetGalName + '" alt="" />' +
                            '</div>';
                        }
                        if(data.data.product_combination){
                            for (loop = 0; loop < data.data.product_combination.length; loop++) {
                                if (data.data.product_combination[loop].gallary != null) {
                                    topGal += '<div class="swiper-slide easyzoom easyzoom--overlay">' +
                                        '<a href="{{ asset('/') }}gallary/large' + prodGalDetGalName + '">' +
                                            '<img src="{{ asset('/') }}gallary/large' + prodGalDetGalName + '" alt="" />' +
                                        '</a>' +
                                    '</div>';
                                    thumbGal += '<div class="swiper-slide">' +
                                        '<img src="{{ asset('/') }}gallary/large' + prodGalDetGalName + '" alt="" />' +
                                    '</div>';
                                }
                            }
                        }
                    } else {
                        if(data.data.product_gallary != null){
                            // // console.log(data.data.product_gallary.gallary_name);
                            topGal += '<div class="swiper-slide easyzoom easyzoom--overlay">' +
                                '<a href="{{ asset("/") }}gallary/' + data.data.product_gallary.gallary_name + '">' +
                                    '<img src="{{ asset("/") }}gallary/' + data.data.product_gallary.gallary_name + '" alt="" />' +
                                '</a>' +
                            '</div>';
                            thumbGal += '<div class="swiper-slide">' +
                                '<img src="{{ asset("/") }}gallary/' + data.data.product_gallary.gallary_name + '" alt="" />' +
                            '</div>';
                        }
                    }
                    $('#top-gallery').html(topGal);
                    $('#thumb-gallery').html(thumbGal);
                    productDetailInit();

                    // if (data.data.category != null) {
                    //     if (data.data.category[0].category_detail != null) {
                    //         if (data.data.category[0].category_detail.detail != null) {
                    //             clone.querySelector(".product-detail-section-cateogory-link").setAttribute(
                    //                 'href', "/shop");

                    //             clone.querySelector(".product-detail-section-cateogory-link").innerHTML =
                    //                 data.data.category[0].category_detail.detail[0].name;

                    //         }
                    //     }
                    // }

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
                        // if (data.data.attribute != null) {
                        //     var combination = '';
                        //     var attribute = data.data.attribute
                        //     for (var a = 0; a < attribute.length; a++) {

                        //         if (attribute[a].attributes != null) {

                        //             if (attribute[a].attributes.detail != null) {

                        //                 combination += '<div class="color-selection">';
                        //                 combination += '<h4><b>' + attribute[a].attributes.detail[0].name +
                        //                     '</b></h4>';
                        //                 combination += '</div>';
                        //             }
                        //             combination += '<ul class="variations">';
                        //             if (attribute[a].variations != null) {
                        //                 for (var v = 0; v < attribute[a].variations
                        //                     .length; v++) {
                        //                     combination +=
                        //                         '<li class="btn size-btn variation_list_item attribute_' +
                        //                         attribute[a].attributes.detail[0].name.split(' ').join(
                        //                             '_') + '_div  ' + attribute[a].variations[v]
                        //                         .product_variation.detail[0].name + '-' + attribute[a]
                        //                         .attributes.detail[0].name.split(' ').join('_') +
                        //                         '" data-attribute-id="' + attribute[a].attributes
                        //                         .attribute_id + '" data-attribute-name="' + attribute[a]
                        //                         .attributes.detail[0].name + '" data-variation-id="' +
                        //                         attribute[a].variations[v]
                        //                         .product_variation.id + '" data-variation-name="' +
                        //                         attribute[a].variations[v]
                        //                         .product_variation.detail[0].name + '">' + attribute[a]
                        //                         .variations[v]
                        //                         .product_variation.detail[0].name + '</li>';
                        //                 }
                        //             }
                        //             combination += '</ul>';
                        //         }
                        //         clone.querySelector(".pro-options").innerHTML = combination;
                        //     }
                        // }

                    }
                    if (data.data.reviews !== null) {
                        $(".review-count").html(data.data.reviews.length);
                            rating = '';
                            sum = 0;
                            for(review = 0; review < data.data.reviews.length; review++){
                                sum = +sum + +data.data.reviews[review].rating;
                            }
                            cur_rating = (sum / data.data.reviews.length);
                            cur_rating = Math.round(cur_rating);
                            if(cur_rating == 1){
                                rating = '<i class="fa fa-star orange"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i>';
                            }
                            else if(cur_rating == 2){
                                rating = '<i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i>';
                            }
                            else if(cur_rating == 3){
                                rating = '<i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i>';
                            }
                            else if(cur_rating == 4){
                                rating = '<i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star b1b1b1"></i>';
                            }
                            else if(cur_rating == 5){
                                rating = '<i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i>';
                            }
                            else{
                                rating = '<i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i>';
                            }

                            $(".display-rating").innerHTML = rating;
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
        var url = "{{ url('') }}" + '/api/client/products?limit=10&getDetail=1&language_id=' + languageId + '&currency='+localStorage.getItem("currency");
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
                                price = data.data[i].product_price_symbol + '<span>' +data.data[i].product_discount_price_symbol +'</span>';
                            }
                        } else {
                            if (data.data[i].product_combination != null) {
                                price = data.data[i].product_combination[0].product_price_symbol;
                            }
                        }

                        clone = '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12  mt-4 mb-3">' +
                            '<div class="product-grid-item">' +
                                '<div class="product-grid-image">' +
                                    '<a href="' + href + '">' +
                                        '<img class="pic-1 img-fluid" src="' +imgSrc + '">' +
                                    '</a>' +
                                    '<ul class="social">' +
                                        '<!-- <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li> -->' +
                                        '<li><a href="javascript:void(0)" onclick="addWishlist(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>' +
                                        '<li><a href="javascript:void(0)" onclick="addToCart(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>' +
                                    '</ul>' +
                                    // '<span class="product-new-label font-weight-bold">New</span>' +
                                    // '<span class="product-discount-label">-10%</span>' +
                                '</div>' +
                                '<div class="product-content">' +
                                    '<h4 class="title mt-2"><a href="' + href + '">Product Name</a></h4>' +
                                    '<div class="price">' +
                                        price +
                                        // '<span>' + cutPrice + '</span>' +
                                    '</div>' +
                                    '<a class="add-to-cart" href=javascript:void(0)" onclick="buyNow(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '">Buy Now</a>' +
                                '</div>' +
                            '</div>' +
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
                        if (data.data[review].rating == '5') {
                            rating = '<i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i>';
                        } else if (data.data[review].rating == '4') {
                            rating = '<i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star b1b1b1"></i>';
                        } else if (data.data[review].rating == '3') {
                            rating = '<i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i>';
                        } else if (data.data[review].rating == '2') {
                            rating = '<i class="fa fa-star orange"></i><i class="fa fa-star orange"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i>';
                        } else if (data.data[review].rating == '1') {
                            rating = '<i class="fa fa-star orange"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i><i class="fa fa-star b1b1b1"></i>';
                        }
                        span = '<div class="col-xl-8 col-lg-8 col-12 comments-content p-4 my-3 bg-light">' +
                            '<h5 class="mb-2">By ' + data.data[review].customer.customer_first_name + ' ' + data.data[review].customer.customer_last_name + '</h5>' +
                            '<div class="p-ratings">' +
                                rating +
                            '</div>' +
                            '<p>' + data.data[review].comment + '</p>' +
                            '<small class="review-date">' + data.data[review].date + '</small>' +
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
</script>
@endsection
