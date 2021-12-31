@extends('layouts.master')
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
        });

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
                '&getDetail=1&language_id=' + language_id + '&currency=' + localStorage.getItem("currency");

            if (category != "")
                url += "&productCategories=" + category;
            if (varations != "")
                url += "&variations=" + varations;
            if (price_range != "") {
                price_range = price_range.split("-");
                url += "&price_from=" + price_range[0];
                url += "&price_to=" + price_range[1];
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
                    $('#event-loading').css('display', 'block');
                },
                success: function(data) {
                    $('#event-loading').css('display', 'none');
                    if (data.status == 'Success') {
                        if (data.meta.last_page < page) {
                            $('.load-more-products').attr('disabled', true);
                            $('.load-more-products').html('No More Items');
                            return
                        }
                        var pagination =
                            '<label for="staticEmail" class="col-form-label">Showing From <span class="showing_record">' +
                            data.meta.to + '</span>&nbsp;of&nbsp;<span class="showing_total_record">' + data
                            .meta.total + '</span>&nbsp;results.</label>';
                        var nextPage = parseInt(data.meta.current_page) + 1;
                        pagination += '<div class="col-12 col-sm-6">';
                        pagination += '<ul class="loader-page mt-0">';
                        pagination += '<li class="loader-page-item">';
                        pagination += '<button class="load-more-products btn btn-secondary" data-page="' + nextPage + '">Load More</button>';
                        pagination += '</li>';
                        pagination += '</ul>';
                        pagination += '</div>';

                        $('.pagination').html(pagination);
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

                            if (data.data[i].product_type == 'simple') {
                                if (data.data[i].product_discount_price == '' || data.data[i].product_discount_price == null || data.data[i].product_discount_price == 'null') {
                                    priceSymbol = data.data[i].product_price_symbol;
                                } else {
                                    priceSymbol = data.data[i].product_discount_price_symbol + '<span>' + data.data[i].product_price_symbol + '</span>';
                                }
                            } else {
                                if (data.data[i].product_combination != null && data.data[i].product_combination != 'null' && data.data[i].product_combination != '') {
                                    priceSymbol = data.data[i].product_combination[0].product_price_symbol;
                                }
                            }

                            if (data.data[i].product_type == 'simple') {
                                cartLink = '<li><a href="javascript:void(0)" data-tip="Add to Cart" onclick="addToCart(this)" data-id=' + data.data[i].product_id + ' data-type=' + data.data[i].product_type + '><i class="fa fa-shopping-cart"></i></a></li>';
                                wishList = '<li><a href="javascript:void(0)" onclick="addWishlist(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>';
                            } else {
                                cartLink = '<li><a href="product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>';
                                wishList = '';
                            }

                            clone = '<div class="col-md-4 col-sm-6 mt-3">' +
                                '<div class="product-grid-item">' +
                                    '<div class="product-grid-image">' +
                                        '<a href="' + href + '"><img class="pic-1 img-fluid" src="{{ asset('/') }}' + imgSrc + '"></a>' +
                                        '<ul class="social">' +
                                            wishList +
                                            cartLink +
                                        '</ul>' +
                                    '</div>' +
                                    '<div class="product-content">' +
                                        '<h4 class="title mt-2"><a href="' + href + '">' + title + '</a></h4>' +
                                        '<div class="price">' +
                                            priceSymbol +
                                        '</div>' +
                                        '<a class="add-to-cart" href="javascript:void(0)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" onclick="addToCart(this)">ADD TO CART</a><br />' +
                                        // '<div class="fb-share-button" data-href="{{ url('') }}/product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '" data-layout="button_count"></div>' +
                                        // '<a target="_blank" class="btn btn-primary btn-sm my-2" href="https://www.facebook.com/sharer/sharer.php?u={{ url('') }}/product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '.com&display=popup"> <i class="fa fa-facebook-square mx-1"></i> Share </a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

                            $("#" + appendTo).append(clone);
                        }
                    }
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
                '&getDetail=1&language_id=' + language_id + '&currency=' + localStorage.getItem("currency");

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
                    $('#event-loading').css('display', 'none');
                    if (data.status == 'Success') {
                        if (data.meta.last_page < page) {
                            $('.load-more-products').attr('disabled', true);
                            $('.load-more-products').html('No More Items');
                            return
                        }
                        var pagination =
                            '<label for="staticEmail" class="col-form-label">Showing From <span class="showing_record">' +
                            data.meta.to + '</span>&nbsp;of&nbsp;<span class="showing_total_record">' + data
                            .meta.total + '</span>&nbsp;results.</label>';
                        var nextPage = parseInt(data.meta.current_page) + 1;
                        pagination += '<div class="col-12 col-sm-6">';
                        pagination += '<ul class="loader-page mt-0">';
                        pagination += '<li class="loader-page-item">';
                        pagination += '<button class="load-more-products btn btn-secondary" data-page="' + nextPage + '">Load More</button>';
                        pagination += '</li>';
                        pagination += '</ul>';
                        pagination += '</div>';

                        $('.pagination').html(pagination);
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

                            if (data.data[i].product_type == 'simple') {
                                if (data.data[i].product_discount_price == '' || data.data[i].product_discount_price == null || data.data[i].product_discount_price == 'null') {
                                    priceSymbol = data.data[i].product_price_symbol;
                                } else {
                                    priceSymbol = data.data[i].product_discount_price_symbol + '<span>' + data.data[i].product_price_symbol + '</span>';
                                }
                            } else {
                                if (data.data[i].product_combination != null && data.data[i].product_combination != 'null' && data.data[i].product_combination != '') {
                                    priceSymbol = data.data[i].product_combination[0].product_price_symbol;
                                }
                            }

                            if (data.data[i].product_type == 'simple') {
                                cartLink = '<li><a href="javascript:void(0)" data-tip="Add to Cart" onclick="addToCart(this)" data-id=' + data.data[i].product_id + ' data-type=' + data.data[i].product_type + '><i class="fa fa-shopping-cart"></i></a></li>';
                                wishList = '<li><a href="javascript:void(0)" onclick="addWishlist(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>';
                            } else {
                                cartLink = '<li><a href="product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>';
                                wishList = '';
                            }

                            clone = '<div class="col-md-4 col-sm-6 mt-3">' +
                                '<div class="product-grid-item">' +
                                    '<div class="product-grid-image">' +
                                        '<a href="' + href + '"><img class="pic-1 img-fluid" src="{{ asset('/') }}' + imgSrc + '"></a>' +
                                        '<ul class="social">' +
                                            wishList +
                                            cartLink +
                                        '</ul>' +
                                    '</div>' +
                                    '<div class="product-content">' +
                                        '<h4 class="title mt-2"><a href="' + href + '">' + title + '</a></h4>' +
                                        '<div class="price">' +
                                            priceSymbol +
                                        '</div>' +
                                        '<a class="add-to-cart" href="javascript:void(0)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" onclick="addToCart(this)">ADD TO CART</a><br />' +
                                        // '<div class="fb-share-button" data-href="{{ url('') }}/product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '" data-layout="button_count"></div>' +
                                        // '<a target="_blank" class="btn btn-primary btn-sm my-2" href="https://www.facebook.com/sharer/sharer.php?u={{ url('') }}/product/' + data.data[i].product_id + '/' + data.data[i].product_slug + '.com&display=popup"> <i class="fa fa-facebook-square mx-1"></i> Share </a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

                            $("#" + appendTo).append(clone);
                        }
                    }
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

            // console.log(attribute_id, variation_id, attribute, variation)
        })

        $('#filter').click(function(e) {
            e.preventDefault();

            filter();
        })

        $('.filter-from-sidebar').click(function() {
            filter();
        })

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
        })

        $(document).on('keyup', '#minRs, #maxRs', function() {
            if($('#minRs').val() != '' && $('#maxRs').val() != ''){
                $('#shop_page_product_card').html('');
                fetchProductWithRange(1, $('#minRs').val(), $('#maxRs').val());
            }
        })
    </script>
@endsection
