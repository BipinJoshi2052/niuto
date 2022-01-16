@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-slider.min.css') }}" />
    
@endsection
@section('content')

    @include(isset(getSetting()['shop']) ? 'includes.shop.shop-'.getSetting()['shop'] : 'includes.shop.shop-style1')
    <style>
        .variation_active {
            border: 1px solid;
        }

        .price-active {
            border: 1px solid;
        }

    </style>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
    <script>
        var language_id = localStorage.getItem('languageId');
        var attribute_id = [];
        var attribute = [];
        var variation_id = [];
        var variation = [];
        var sortBy = "";
        var sortType = "";
        var priceFromSidebar = "{{ isset($_GET['price']) ? $_GET['price'] : '' }}";
        var shopStyle = "{{ getSetting()['shop'] }}";
        var my_variations = '';
        var priceRange = '';

        $(document).ready(function(){
            $(".variation-filter").on('click', function(){
                my_variations = [];
                $('.variation-filter').each(function(){
                    if($(this).is(":checked")){
                        my_variations.push($(this).val());
                    }
                });
                fetchProduct(1);
            });
        });
        $(document).ready(function() {
            fetchProduct(1);
            $(".variaion-filter").each(function() {
                if ($(this).val() != "") {
                    attribute_id.push($(this).attr('data-attribute-id'));
                    variation_id.push($(this).val());
                    attribute.push($(this).attr('data-attribute-name'));
                    variation.push($('option:selected', this).attr('data-variation-name'));
                }
            });
            
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/brand',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    var brandDiv = '';
                    $.each(data.data, function(i, e){
                        imgSrc = '';
                        if(e.gallary){
                            imgSrc = '/gallary/' + e.gallary;
                        }else{
                            imgSrc = '/images/noimage.png';
                        }
                        brandDiv += '<div class="our_brand_item">' +
                            '<a href="javascript:void(0)" data-id="' + e.brand_id + '" class="productBrand"><img src="' + imgSrc + '" class="img-fluid" alt="" height="50px"/></a>' +
                        '</div>';
                    })
                    $('#prodBrand').html(brandDiv);
                    our_brand();
                },
                complete: function(){},
                error: function(data) {},
            });
        });

        $(document).on('click', '.productBrand', function(){
            brand = $(this).data('id');
            fetchProductWithBrand(1, brand);
        })

        $('.sortBy').change(function() {
            sortBy = $('option:selected', this).attr('data-sort-by')
            sortType = $('option:selected', this).attr('data-sort-type')
            $(".shop_page_product_card").html('');
            fetchProduct(1);
        })

        function fetchProduct(page) {
            var limit = "{{ isset($_GET['limit']) ? $_GET['limit'] : '12' }}";
            var category = "{{ isset($_GET['category']) ? $_GET['category'] : '' }}";
            var varations = "{{ isset($_GET['variation_id']) ? $_GET['variation_id'] : '' }}";
            var price_range = "{{ isset($_GET['price']) ? $_GET['price'] : '' }}";
            var url = "{{ url('') }}" + '/api/client/products?page=' + page + '&limit=' + limit +
                '&getDetail=1&getCategory=1&language_id=' + language_id + '&currency=' + localStorage.getItem("currency");

            if (category != "")
                url += "&productCategories=" + category;
            if (varations != "")
                url += "&variations=" + varations;
            if (price_range != "") {
                price_range = price_range.split("-");
                url += "&price_from=" + price_range[0];
                url += "&price_to=" + price_range[1];
            }

            if(my_variations != ""){
                url += "&my_variations=" + my_variations;
            }
            if(priceRange != '' && priceRange.length > 0){
                url += "&price_from=" + priceRange[0];
                url += "&price_to=" + priceRange[1];
            }

            if (sortBy != "" && sortType != "")
                url += "&sortBy=" + sortBy + "&sortType=" + sortType;
            var searchinput = "{{ isset($_GET['search']) ? $_GET['search'] : '' }}";
            if (searchinput != "")
                url += "&searchParameter=" + searchinput;
            var appendTo = 'shop_page_product_card';
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {
                    // alert('Helo');
                    $('.section-loading').css('display', 'block');
                },
                success: function(data) {
                    if (data.status == 'Success' && data.data.length > 0) {
                        var links = '';
                        var page_meta_label = '';
                        for(meta = 0; meta < data.meta.links.length; meta++){
                            var page_meta_next_page = getURLParameter(data.meta.links[meta].url, 'page');
                            // var page_meta_next_page = getURLParameter(data.meta.links[meta].url, 'page') != null ? getURLParameter(data.meta.links[meta].url, 'page') : '#' ;
                            
                            var page_meta_url = data.meta.links[meta].url;
                            // var page_meta_url = data.meta.links[meta].url != null ? data.meta.links[meta].url : '#';
                            var page_meta_active = data.meta.links[meta].active == true ? 'active' : '';
                            if(data.meta.links[meta].label == '&laquo; Previous'){
                                page_meta_label = '&laquo;';
                            } else if(data.meta.links[meta].label == 'Next &raquo;') {
                                page_meta_label = '&raquo;';
                            } else {
                                page_meta_label = data.meta.links[meta].label;
                            }
                            links +=  '<a href="'+ page_meta_next_page +'" class="load-product-link '+ page_meta_active +'" data-to="'+ data.meta.to +'" data-total="'+ data.meta.total +'">'+ page_meta_label +'</a>';
                            // links +=  '<a href="'+ page_meta_url +'" class="'+ page_meta_active +'">'+ page_meta_label +'</a>';
                        }
                        $('.pagination').html(links);
                        var clone = '';
                        var imgSrc = '';
                        var imgAlt = '';
                        var priceSymbol = '';
                        var cartLink = '';
                        for (i = 0; i < data.data.length; i++) {
                            if (data.data[i].product_gallary != null) {
                                if (data.data[i].product_gallary.detail != null) {
                                    imgSrc = data.data[i].product_gallary.detail[0].gallary_path;
                                    if(imgSrc.startsWith('/')){
                                        imgSrc = imgSrc.substring(1);
                                    }
                                }
                            }
                            if (data.data[i].detail != null) {
                                imgAlt = data.data[i].detail[0].title;
                            }
                            if (data.data[i].category != null) {
                                if (data.data[i].category[0].category_detail.detail != null) {
                                    category = data.data[i].category[0].category_detail.detail[0].name;
                                }
                            }
                            if (data.data[i].detail != null) {
                                title = data.data[i].detail[0].title;
                                href = 'product/' + data.data[i].product_id + '/' + data.data[i].product_slug;
                                desc = data.data[i].detail[0].desc;
                                desc = desc.substring(0, 50);
                            }

                            if (data.data[i].product_discount_price == '' || data.data[i].product_discount_price == null || data.data[i].product_discount_price == 'null') {
                                priceSymbol = data.data[i].product_price_symbol;
                            } else {
                                priceSymbol = data.data[i].product_discount_price_symbol + '<span class="price-through">' + data.data[i].product_price_symbol + '</span>';
                            }
                            // if (data.data[i].product_type == 'simple') {
                            // } else {
                            //     if (data.data[i].product_combination != null && data.data[i].product_combination != 'null' && data.data[i].product_combination != '') {
                            //         priceSymbol = data.data[i].product_combination[0].product_price_symbol;
                            //     }
                            // }

                            if (data.data[i].product_type == 'simple') {
                                cartLink = '<a href="javascript:void(0)" onclick="addToCart(this)" data-id="'+ data.data[i].product_id +'" data-type="'+ data.data[i].product_type +'" tabindex="0"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>';
                                wishList = '<a href="javascript:void(0)" onclick="addWishlist(this)" data-id="'+ data.data[i].product_id +'" data-type="'+ data.data[i].product_type +'"><i class="fa fa-heart" aria-hidden="true"></i></a>';
                            } else {
                                cartLink = cartLink = '<a href="product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '" tabindex="0"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>';
                                wishList = '';
                            }
                            clone += '<div class="col-md-4 col-12">'+
                                '<div class="item_block bg-white position-relative p-3 mb-3">'+
                                    '<div class="img_block">'+
                                    '<a href="'+ href +'"><img src="{{ asset('/') }}' + imgSrc + '"  alt="img" class="img-fluid"></a>'+
                                    '</div>'+
                                    '<div class="content_block pb-3">'+
                                        '<small>'+ data.data[i].category[0].category_detail.detail[0].name +'</small>'+
                                        '<a href="'+ href +'"><h4>' + title + '</h4></a>'+
                                        '<span class="">'+ priceSymbol +'</span>'+
                                    '</div>'+
                                    '<div class="wish_list_block">'+
                                        wishList +
                                    '</div>'+
                                    '<div class="icon_group">'+
                                        '<div class="cart_blocks">'+
                                            cartLink +
                                        '</div>'+
                                        '<div class="cart_block">'+
                                            '<a href="'+ href +'" tabindex="0">'+
                                            '<i class="fa fa-eye" aria-hidden="true"></i></a>'+
                                        '</div>'+
                                        '<div class="cart_blockss">'+
                                            '<a href="" tabindex="0">'+
                                            '<i class="fa fa-exchange" aria-hidden="true"></i></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            $("#" + appendTo).html(clone);
                            
                        }
                    } else {
                        $("#" + appendTo).html('<div class=text-center> <p style="width: 100%;padding-left: 22px;font-size: 20px;font-weight: 500;padding-top: 12px;">No data found</p> </div>');
                    }
                },
                complete: function(){
                    $('.section-loading').css('display', 'none');
                },
                error: function(data) {},
            });
        }

        function fetchProductWithRange(page, price_from, price_to) {
            var limit = "{{ isset($_GET['limit']) ? $_GET['limit'] : '12' }}";
            var category = "{{ isset($_GET['category']) ? $_GET['category'] : '' }}";
            var varations = "{{ isset($_GET['variation_id']) ? $_GET['variation_id'] : '' }}";
            var price_range = "{{ isset($_GET['price']) ? $_GET['price'] : '' }}";

            var url = "{{ url('') }}" + '/api/client/products?page=' + page + '&limit=' + limit +
                '&getDetail=1&getCategory=1&language_id=' + language_id + '&currency=' + localStorage.getItem("currency");

            url += "&price_from=" + price_from;
            url += "&price_to=" + price_to;

            if (category != "")
                url += "&productCategories=" + category;
            if (varations != "")
                url += "&variations=" + varations;
            
            if (sortBy != "" && sortType != "")
                url += "&sortBy=" + sortBy + "&sortType=" + sortType;
            var searchinput = "{{ isset($_GET['search']) ? $_GET['search'] : '' }}";
            if (searchinput != "")
                url += "&searchParameter=" + searchinput;
            var appendTo = 'shop_page_product_card';
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {
                    $('#event-loading').css('display', 'block');
                },
                success: function(data) {
                    if (data.status == 'Success' && data.data.length > 0) {
                        var links = '';
                        var page_meta_label = '';
                        for(meta = 0; meta < data.meta.links.length; meta++){
                            var page_meta_next_page = getURLParameter(data.meta.links[meta].url, 'page');
                            // var page_meta_next_page = getURLParameter(data.meta.links[meta].url, 'page') != null ? getURLParameter(data.meta.links[meta].url, 'page') : '#' ;
                            
                            var page_meta_url = data.meta.links[meta].url;
                            // var page_meta_url = data.meta.links[meta].url != null ? data.meta.links[meta].url : '#';
                            var page_meta_active = data.meta.links[meta].active == true ? 'active' : '';
                            if(data.meta.links[meta].label == '&laquo; Previous'){
                                page_meta_label = '&laquo;';
                            } else if(data.meta.links[meta].label == 'Next &raquo;') {
                                page_meta_label = '&raquo;';
                            } else {
                                page_meta_label = data.meta.links[meta].label;
                            }
                            links +=  '<a href="'+ page_meta_next_page +'" class="load-product-link '+ page_meta_active +'" data-to="'+ data.meta.to +'" data-total="'+ data.meta.total +'">'+ page_meta_label +'</a>';
                            // links +=  '<a href="'+ page_meta_url +'" class="'+ page_meta_active +'">'+ page_meta_label +'</a>';
                        }
                        $('.pagination').html(links);
                        var clone = '';
                        var imgSrc = '';
                        var imgAlt = '';
                        var priceSymbol = '';
                        var cartLink = '';
                        for (i = 0; i < data.data.length; i++) {
                            if (data.data[i].product_gallary != null) {
                                if (data.data[i].product_gallary.detail != null) {
                                    imgSrc = data.data[i].product_gallary.detail[0].gallary_path;
                                    if(imgSrc.startsWith('/')){
                                        imgSrc = imgSrc.substring(1);
                                    }
                                }
                            }
                            if (data.data[i].detail != null) {
                                imgAlt = data.data[i].detail[0].title;
                            }
                            if (data.data[i].category != null) {
                                if (data.data[i].category[0].category_detail.detail != null) {
                                    category = data.data[i].category[0].category_detail.detail[0].name;
                                }
                            }
                            if (data.data[i].detail != null) {
                                title = data.data[i].detail[0].title;
                                href = 'product/' + data.data[i].product_id + '/' + data.data[i].product_slug;
                                desc = data.data[i].detail[0].desc;
                                desc = desc.substring(0, 50);
                            }

                            if (data.data[i].product_discount_price == '' || data.data[i].product_discount_price == null || data.data[i].product_discount_price == 'null') {
                                priceSymbol = data.data[i].product_price_symbol;
                            } else {
                                priceSymbol = data.data[i].product_discount_price_symbol + '<span class="price-through">' + data.data[i].product_price_symbol + '</span>';
                            }
                            // if (data.data[i].product_type == 'simple') {
                            // } else {
                            //     if (data.data[i].product_combination != null && data.data[i].product_combination != 'null' && data.data[i].product_combination != '') {
                            //         priceSymbol = data.data[i].product_combination[0].product_price_symbol;
                            //     }
                            // }

                            if (data.data[i].product_type == 'simple') {
                                cartLink = '<a href="javascript:void(0)" onclick="addToCart(this)" data-id="'+ data.data[i].product_id +'" data-type="'+ data.data[i].product_type +'" tabindex="0"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>';
                                wishList = '<a href="javascript:void(0)" onclick="addWishlist(this)" data-id="'+ data.data[i].product_id +'" data-type="'+ data.data[i].product_type +'"><i class="fa fa-heart" aria-hidden="true"></i></a>';
                            } else {
                                cartLink = cartLink = '<a href="product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '" tabindex="0"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>';
                                wishList = '';
                            }
                            clone += '<div class="col-md-4 col-12">'+
                                '<div class="item_block bg-white position-relative p-3 mb-3">'+
                                    '<div class="img_block">'+
                                    '<a href="'+ href +'"><img src="{{ asset('/') }}' + imgSrc + '"  alt="img" class="img-fluid"></a>'+
                                    '</div>'+
                                    '<div class="content_block pb-3">'+
                                        '<small>'+ data.data[i].category[0].category_detail.detail[0].name +'</small>'+
                                        '<a href="'+ href +'"><h4>' + title + '</h4></a>'+
                                        '<span class="">'+ priceSymbol +'</span>'+
                                    '</div>'+
                                    '<div class="wish_list_block">'+
                                        wishList +
                                    '</div>'+
                                    '<div class="icon_group">'+
                                        '<div class="cart_blocks">'+
                                            cartLink +
                                        '</div>'+
                                        '<div class="cart_block">'+
                                            '<a href="'+ href +'" tabindex="0">'+
                                            '<i class="fa fa-eye" aria-hidden="true"></i></a>'+
                                        '</div>'+
                                        '<div class="cart_blockss">'+
                                            '<a href="" tabindex="0">'+
                                            '<i class="fa fa-exchange" aria-hidden="true"></i></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            $("#" + appendTo).html(clone);
                            
                        }
                    } else {
                        $("#" + appendTo).html('<div class=text-center> <p style="width: 100%;padding-left: 22px;font-size: 20px;font-weight: 500;padding-top: 12px;">No data found</p> </div>');
                    }
                },
                complete: function(){
                    $('.section-loading').css('display', 'none');
                },
                error: function(data) {},
            });
        }
        function our_brand(){
            $(".our_brand").slick({
                dots: false,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 3000,
                slidesToShow: 1,
                slidesToScroll: 1,
            });
        }
        function fetchProductWithBrand(page, brand) {
            var limit = "{{ isset($_GET['limit']) ? $_GET['limit'] : '12' }}";
            var category = "{{ isset($_GET['category']) ? $_GET['category'] : '' }}";
            var varations = "{{ isset($_GET['variation_id']) ? $_GET['variation_id'] : '' }}";
            var price_range = "{{ isset($_GET['price']) ? $_GET['price'] : '' }}";
            var url = "{{ url('') }}" + '/api/client/products?page=' + page + '&limit=' + limit +
                '&getDetail=1&getCategory=1&brandId=' + brand + '&language_id=' + language_id + '&currency=' + localStorage.getItem("currency");

            if (category != "")
                url += "&productCategories=" + category;
            if (varations != "")
                url += "&variations=" + varations;
            if (price_range != "") {
                price_range = price_range.split("-");
                url += "&price_from=" + price_range[0];
                url += "&price_to=" + price_range[1];
            }

            if(my_variations != ""){
                url += "&my_variations=" + my_variations;
            }
            if(priceRange != '' && priceRange.length > 0){
                url += "&price_from=" + priceRange[0];
                url += "&price_to=" + priceRange[1];
            }

            if (sortBy != "" && sortType != "")
                url += "&sortBy=" + sortBy + "&sortType=" + sortType;
            var searchinput = "{{ isset($_GET['search']) ? $_GET['search'] : '' }}";
            if (searchinput != "")
                url += "&searchParameter=" + searchinput;
            var appendTo = 'shop_page_product_card';
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {
                    // alert('Helo');
                    $('.section-loading').css('display', 'block');
                },
                success: function(data) {
                    if (data.status == 'Success' && data.data.length > 0) {
                        var links = '';
                        var page_meta_label = '';
                        for(meta = 0; meta < data.meta.links.length; meta++){
                            var page_meta_next_page = getURLParameter(data.meta.links[meta].url, 'page');
                            // var page_meta_next_page = getURLParameter(data.meta.links[meta].url, 'page') != null ? getURLParameter(data.meta.links[meta].url, 'page') : '#' ;
                            
                            var page_meta_url = data.meta.links[meta].url;
                            // var page_meta_url = data.meta.links[meta].url != null ? data.meta.links[meta].url : '#';
                            var page_meta_active = data.meta.links[meta].active == true ? 'active' : '';
                            if(data.meta.links[meta].label == '&laquo; Previous'){
                                page_meta_label = '&laquo;';
                            } else if(data.meta.links[meta].label == 'Next &raquo;') {
                                page_meta_label = '&raquo;';
                            } else {
                                page_meta_label = data.meta.links[meta].label;
                            }
                            links +=  '<a href="'+ page_meta_next_page +'" class="load-product-link '+ page_meta_active +'" data-to="'+ data.meta.to +'" data-total="'+ data.meta.total +'">'+ page_meta_label +'</a>';
                            // links +=  '<a href="'+ page_meta_url +'" class="'+ page_meta_active +'">'+ page_meta_label +'</a>';
                        }
                        $('.pagination').html(links);
                        var clone = '';
                        var imgSrc = '';
                        var imgAlt = '';
                        var priceSymbol = '';
                        var cartLink = '';
                        for (i = 0; i < data.data.length; i++) {
                            if (data.data[i].product_gallary != null) {
                                if (data.data[i].product_gallary.detail != null) {
                                    imgSrc = data.data[i].product_gallary.detail[0].gallary_path;
                                    if(imgSrc.startsWith('/')){
                                        imgSrc = imgSrc.substring(1);
                                    }
                                }
                            }
                            if (data.data[i].detail != null) {
                                imgAlt = data.data[i].detail[0].title;
                            }
                            if (data.data[i].category != null) {
                                if (data.data[i].category[0].category_detail.detail != null) {
                                    category = data.data[i].category[0].category_detail.detail[0].name;
                                }
                            }
                            if (data.data[i].detail != null) {
                                title = data.data[i].detail[0].title;
                                href = 'product/' + data.data[i].product_id + '/' + data.data[i].product_slug;
                                desc = data.data[i].detail[0].desc;
                                desc = desc.substring(0, 50);
                            }

                            if (data.data[i].product_discount_price == '' || data.data[i].product_discount_price == null || data.data[i].product_discount_price == 'null') {
                                priceSymbol = data.data[i].product_price_symbol;
                            } else {
                                priceSymbol = data.data[i].product_discount_price_symbol + '<span class="price-through">' + data.data[i].product_price_symbol + '</span>';
                            }
                            // if (data.data[i].product_type == 'simple') {
                            // } else {
                            //     if (data.data[i].product_combination != null && data.data[i].product_combination != 'null' && data.data[i].product_combination != '') {
                            //         priceSymbol = data.data[i].product_combination[0].product_price_symbol;
                            //     }
                            // }

                            if (data.data[i].product_type == 'simple') {
                                cartLink = '<a href="javascript:void(0)" onclick="addToCart(this)" data-id="'+ data.data[i].product_id +'" data-type="'+ data.data[i].product_type +'" tabindex="0"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>';
                                wishList = '<a href="javascript:void(0)" onclick="addWishlist(this)" data-id="'+ data.data[i].product_id +'" data-type="'+ data.data[i].product_type +'"><i class="fa fa-heart" aria-hidden="true"></i></a>';
                            } else {
                                cartLink = cartLink = '<a href="product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '" tabindex="0"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>';
                                wishList = '';
                            }
                            clone += '<div class="col-md-4 col-12">'+
                                '<div class="item_block bg-white position-relative p-3 mb-3">'+
                                    '<div class="img_block">'+
                                    '<a href="'+ href +'"><img src="{{ asset('/') }}' + imgSrc + '"  alt="img" class="img-fluid"></a>'+
                                    '</div>'+
                                    '<div class="content_block pb-3">'+
                                        '<small>'+ data.data[i].category[0].category_detail.detail[0].name +'</small>'+
                                        '<a href="'+ href +'"><h4>' + title + '</h4></a>'+
                                        '<span class="">'+ priceSymbol +'</span>'+
                                    '</div>'+
                                    '<div class="wish_list_block">'+
                                        wishList +
                                    '</div>'+
                                    '<div class="icon_group">'+
                                        '<div class="cart_blocks">'+
                                            cartLink +
                                        '</div>'+
                                        '<div class="cart_block">'+
                                            '<a href="'+ href +'" tabindex="0">'+
                                            '<i class="fa fa-eye" aria-hidden="true"></i></a>'+
                                        '</div>'+
                                        '<div class="cart_blockss">'+
                                            '<a href="" tabindex="0">'+
                                            '<i class="fa fa-exchange" aria-hidden="true"></i></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                            $("#" + appendTo).html(clone);
                            
                        }
                    } else {
                        $("#" + appendTo).html('<div class=text-center> <p style="width: 100%;padding-left: 22px;font-size: 20px;font-weight: 500;padding-top: 12px;">No data found</p> </div>');
                    }
                },
                complete: function(){
                    $('.section-loading').css('display', 'none');
                },
                error: function(data) {},
            });
        }


        var limit = "{{ isset($_GET['limit']) ? $_GET['limit'] : '12' }}";
        var shopRedirecturl = "{{ url('/shop') }}" + '?limit=' + limit;
        $('.category-filter').change(function() {
            $(this).attr('selected', true);
        })
        $('.price-filter').change(function() {
            $(this).attr('selected', true);
        })

        $('.variaion-filter').on('change', function() {

            if (attribute_id.indexOf($(this).attr('data-attribute-id')) === -1) {
                attribute_id.push($(this).attr('data-attribute-id'));
                variation_id.push($(this).val());
                attribute.push($(this).attr('data-attribute-name'));
                variation.push($('option:selected', this).attr('data-variation-name'));
            } else {

                var index = attribute_id.indexOf($(this).attr('data-attribute-id'));
                if ($(this).val() == "") {
                    attribute_id.splice(index, 1);
                    variation_id.splice(index, 1);
                    attribute.splice(index, 1);
                    variation.splice(index, 1);
                } else {
                    attribute_id[index] = $(this).attr('data-attribute-id');
                    variation_id[index] = $(this).val();
                    attribute[index] = $(this).attr('data-attribute-name');
                    variation[index] = $('option:selected', this).attr('data-variation-name');
                }

            }


        })

        $('.price-range-list').on('click', function() {
            var price_range = $(this).attr('data-price-range');
            $('.price-range-list').each(function() {
                $('.price-range-list').removeClass("price-active");
            })
            $('.price-range-list' + '-' + price_range).addClass("price-active");
            priceFromSidebar = price_range;
        });

        $('.variation_list_item').on('click', function() {
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

            
        })

        $('#filter').click(function(e) {
            e.preventDefault();

            filter();
        })

        $('.filter-from-sidebar').click(function() {
            filter();
        })


        


        function filterProduct(){
            var limit = "{{ isset($_GET['limit']) ? $_GET['limit'] : '12' }}";
            var searchinput = "{{ isset($_GET['search']) ? $_GET['search']: '' }}";
            if(variations != ''){
                shopRedirecturl += ""
            }

        }

        function filter() {
            var limit = "{{ isset($_GET['limit']) ? $_GET['limit'] : '12' }}";
            var searchinput = "{{ isset($_GET['search']) ? $_GET['search'] : '' }}";

            if ($('.category-filter').val() != "" && $('.category-filter').val() != undefined) {
                shopRedirecturl += "&category=" + $('.category-filter').val();
            }
            if ($('.price-filter').val() != "" && $('.price-filter').val() != undefined) {
                shopRedirecturl += "&price=" + $('.price-filter').val();
            } else if (priceFromSidebar != "") {
                shopRedirecturl += "&price=" + priceFromSidebar;
            }

            if (searchinput != "")
                shopRedirecturl += "&searchParameter=" + searchinput;
            if (variation_id.length > 0)
                shopRedirecturl += "&attribute=" + attribute;
            if (variation_id.length > 0)
                shopRedirecturl += "&variation=" + variation;
            if (variation_id.length > 0)
                shopRedirecturl += "&attribute_id=" + attribute_id;
            if (variation_id.length > 0)
                shopRedirecturl += "&variation_id=" + variation_id;
            window.location.href = shopRedirecturl;
        }

        $(document).on('click', '.load-more-products', function() {
            var pageToLoad = $(this).attr('data-page');
            fetchProduct(pageToLoad);
        });



        $(document).on('click', '.load-product-link', function(e){
            e.preventDefault();
            var dataToLoadFrom = $(this).attr('href');
            var dataTo = $(this).data('to');
            var dataTotal = $(this).data('total');
            if(dataToLoadFrom != 'null' && dataToLoadFrom != null && dataToLoadFrom != 'undefined'){
                fetchProduct(dataToLoadFrom);
            }
            
        });

        $(function(){
            priceRangeslider();
            
            
        });

        $(document).on('mouseup', "#range-slider", function(){
            if($('#range-slider-div').attr('value')){
                priceRange = $('#range-slider-div').attr('value');
            }
            splitValue = priceRange.split(',');
            fetchProductWithRange(1, splitValue[0], splitValue[1]);
        });
        

        $(document).on('keyup', '#minRs, #maxRs', function() {
            if($('#minRs').val() != '' && $('#maxRs').val() != ''){
                $('#shop_page_product_card').html('');
                fetchProductWithRange(1, $('#minRs').val(), $('#maxRs').val());
            }
        });
        function priceRangeslider()
        {
            $("#range-slider-div").slider({
                // the id of the slider element
                id: "range-slider",
                // minimum value
                min: 1,
                // maximum value
                max: 10000,
                // increment step
                step: 1,
                // the number of digits shown after the decimal.
                precision: 0,
                // 'horizontal' or 'vertical'
                orientation: "horizontal",
                // initial value
                value: 1,
                // enable range slider
                range: true,
                // selection placement.
                // 'before', 'after' or 'none'.
                // in case of a range slider, the selection will be placed between the handles
                selection: "before",
                // 'show', 'hide', or 'always'
                tooltip: "always",
                // show two tooltips one for each handler
                tooltip_split: true,
                // lock to ticks
                lock_to_ticks: false,
                // 'round', 'square', 'triangle' or 'custom'
                handle: "round",
                // whether or not the slider should be reversed
                reversed: false,
                // RTL mode
                rtl: "auto",
                // whether or not the slider is initially enabled
                enabled: true,
                // callback
                formatter: function formatter(val) {
                  if (Array.isArray(val)) {
                    return val[0] + " : " + val[1];
                  } else {
                    return val;
                  }
                },
                // The natural order is used for the arrow keys.
                // Arrow up select the upper slider value for vertical sliders, arrow right the righter slider value for a horizontal slider - no matter if the slider was reversed or not.
                // By default the arrow keys are oriented by arrow up/right to the higher slider value, arrow down/left to the lower slider value.
                natural_arrow_keys: false,
                // Used to define the values of ticks.
                // Tick marks are indicators to denote special values in the range.
                // This option overwrites min and max options.
                ticks: [],
                // Defines the positions of the tick values in percentages.
                // The first value should always be 0, the last value should always be 100 percent.
                ticks_positions: [],
                // Defines the labels below the tick marks. Accepts HTML input.
                ticks_labels: [],
                // Used to define the snap bounds of a tick.
                // Snaps to the tick if value is within these bounds.
                ticks_snap_bounds: 0,
                // Used to allow for a user to hover over a given tick to see it's value.
                ticks_tooltip: false,
                // Position of tooltip, relative to slider.
                // Accepts 'top'/'bottom' for horizontal sliders and 'left'/'right' for vertically orientated sliders.
                // Default positions are 'top' for horizontal and 'right' for vertical slider.
                tooltip_position: null,
                // Set to 'logarithmic' to use a logarithmic scale.
                scale: "linear",
                // Focus the appropriate slider handle after a value change.
                focus: false,
                // ARIA labels for the slider handle's, Use array for multiple values in a range slider.
                labelledby: null,
                // Defines a range array that you want to highlight
                rangeHighlights: [],
                // Bootstrap Range Slider Js End
            });
        }
    </script>
@endsection
