@extends('layouts.master')
@section('content')
    @include(isset(getSetting()['slider_style']) ? 'includes.sliders.slider-'.getSetting()['slider_style'] :
    'includes.sliders.slider-style1')

    <!-- Product Listing  -->
    <section id="product-listing-wrapper">
        <div class="container">
            <div class="product-lists padding">
                <div class="row" id="product-list-section">
                    <div class="col-12">
                        <div class="heading d-flex justify-content-between align-items-center mb-5 flex-wrap">
                            <div class="head">
                                <h2 class="font-weight-bold">Shop All New Imports</h2>
                                <p>THERE'S SOMETHING FOR EVERYONE</p>
                            </div>
                            <div class="navigator">
                                <a href="/shop">See all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Listing Ends -->
    <!-- Categories -->
    <section id="categories-wrapper" class="py-3">
        <div class="container">
            <div class="row py-4">
                <div class="col-12">
                    <div class="heading d-flex justify-content-between align-items-center mb-5 flex-wrap">
                        <div class="head">
                            <h2 class="font-weight-bold">Choose your Categories</h2>
                            <p>More than 10 categories to choose from</p>
                        </div>
                        <div class="navigator">
                            <a href="/shop">See all</a>
                        </div>
                    </div>
                </div>
                <div class="slick-slider-category w-100" id="category-section">
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Ends -->
    <!-- Feature Product Listing Slider -->
    <section id="feature-product-slider-wrapper" class="bg-light">
        <div class="container">
            <div class="product-lists padding">
                <div class="row">
                    <div class="col-12">
                        <div class="heading d-flex justify-content-between align-items-center mb-5 flex-wrap">
                            <div class="head">
                                <h2 class="font-weight-bold">Featured Products</h2>
                                <!-- <p>THERE'S SOMETHING FOR EVERYONE</p> -->
                            </div>
                            <div class="navigator">
                                <a href="/shop">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="slick-slider-product w-100" id="featured-product-section">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature Product Listing Slider Ends -->
    <!-- Latest Product Listing  -->
    <section id="latest-product-listing-wrapper">
        <div class="container">
            <div class="product-lists padding">
                <div class="row" id="latest-product-section">
                    <div class="col-12">
                        <div class="heading d-flex justify-content-between align-items-center mb-5 flex-wrap">
                            <div class="head">
                                <h2 class="font-weight-bold">Latest Products</h2>
                                <p>Winter New Arrivals</p>
                            </div>
                            <div class="navigator">
                                <a href="/shop">See all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Listing Ends -->
    <!-- Ads -->
    <section id="ads">
        <div class="content position-relative text-center">
            <img src="{{ asset('frontend/assets/images/product-images/1 (3).jpg') }}" class="img-fluid">
            <div class="discription m-auto text-white p-xl-5 p-lg-5 p-md-3 p-3">
                <h1 class="font-weight-bold text-uppercase">This is Us</h1>
                <p>Discover all your demands.</p>
            </div>
        </div>
    </section>
    <!-- Ads Ends -->
    <!-- Blogs -->
    <section id="reviews-wrapper" class="bg-light">
        <div class="container">
            <div class="row padding">
                <div class="col-12">
                    <div class="heading d-flex justify-content-between align-items-center mb-5 flex-wrap">
                        <div class="head">
                            <h2 class="font-weight-bold">Blogs</h2>
                        </div>
                        <div class="navigator">
                            <a href="{{ url('/blog') }}">See all</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 blog-list">
                    <div class="row justify-content-center" id="blog-section">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blogs Ends -->

    @foreach (homePageBuilderJson() as $template)
    @if (!$template['skip'] && $template['display'])
    @include('sections.home-'.$template['template_postfix'].'-section')
    @endif  
    @endforeach
    
    
    @endsection
    @section('script')
    <script>
        $(document).ready(function() {
            sliderMedia();
            categorySlider();
            
            var url = "{{ url('') }}" +
                '/api/client/products?limit=12&getCategory=1&getDetail=1&language_id=' + 1 +
                '&sortBy=id&sortType=DESC&currency=' + 1;
            appendTo = 'product-list-section';
            fetchProduct(url, appendTo);

            var url = "{{ url('') }}" + '/api/client/products?limit=10&getDetail=1&language_id=' +
                1 + '&currency=' + 1;
            appendTo = 'featured-product-section';
            fetchProduct(url, appendTo);
            
            var url = "{{ url('') }}" +
            '/api/client/products?limit=12&getCategory=1&getDetail=1&language_id=' + 1 +
            '&sortBy=id&sortType=DESC&currency=' + 1;
            appendTo = 'latest-product-section';
            fetchProduct(url, appendTo);
            
            blogNews();

            // var url = "{{ url('') }}" +
            //     '/api/client/products?limit=10&getCategory=1&getDetail=1&language_id=' + languageId +
            //     '&topSelling=1&currency=' + 1;
            // appendTo = 'tab_top_sales';
            // fetchProduct(url, appendTo);

            // var url = "{{ url('') }}" + '/api/client/products?limit=10&getDetail=1&language_id=' +
            //     languageId + '&currency=' + 1;
            // appendTo = 'tab_special_products';
            // fetchProduct(url, appendTo);


            // var url = "{{ url('') }}" +
            //     '/api/client/products?limit=6&getCategory=1&getDetail=1&language_id=' + languageId +
            //     '&sortBy=id&sortType=DESC&currency=' + 1;
            // appendTo = 'weekly-sale';
            // fetchProduct(url, appendTo);

            // var url = "{{ url('') }}" +
            //     '/api/client/products?limit=1&getCategory=1&getDetail=1&language_id=' + languageId +
            //     '&topSelling=1&currency=' + 1;
            // appendTo = 'weekly-sale-first-div';
            // fetchFeaturedWeeklyProduct(url,appendTo)

            // bannerMedia();
            // cartSession = $.trim(localStorage.getItem("cartSession"));
            // if (cartSession == null || cartSession == 'null') {
            //     cartSession = '';
            // }
            // menuCart(cartSession);
        });

        function fetchProduct(url, appendTo) {
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
                        for (i = 0; i < data.data.length; i++) {
                            
                            if (data.data[i].product_gallary != null && data.data[i].product_gallary != 'null' && data.data[i].product_gallary != '') {
                                if (data.data[i].product_gallary.detail != null && data.data[i].product_gallary.detail != 'null' && data.data[i].product_gallary.detail != '') {
                                    imgSrc = data.data[i].product_gallary.detail[1].gallary_path;
                                }
                            }
                            if (data.data[i].detail != null && data.data[i].detail != 'null' && data.data[i].detail != '') {
                                imgAlt = data.data[i].detail[0].title;
                            }
                            if (data.data[i].category != null && data.data[i].category != 'null' && data.data[i].category != '') {
                                if (data.data[i].category[0].category_detail != null && data.data[i].category[0].category_detail != 'null' && data.data[i].category[0].category_detail != ''
                                ) {
                                    if (data.data[i].category[0].category_detail.detail != null && data.data[i].category[0].category_detail.detail != 'null' && data.data[i].category[0].category_detail.detail != '') {
                                        itemName = data.data[i].category[0].category_detail.detail[0].name;
                                    }
                                }
                            }
                            if (data.data[i].detail != null && data.data[i].detail != 'null' && data.data[i].detail != '') {
                                title = data.data[i].detail[0].title;
                                href = '/product/' + data.data[i].product_id + '/' + data.data[i].product_slug;
                                var desc = data.data[i].detail[0].desc;
                                desc = desc.substring(0, 50);
                            }

                            if (data.data[i].product_type == 'simple') {
                                if (data.data[i].product_discount_price == '' || data.data[i].product_discount_price == null || data.data[i].product_discount_price ==
                                    'null') {
                                    productCardPrice = data.data[i].product_price_symbol;
                                } else {
                                    productCardPrice = data.data[i].product_discount_price_symbol + '<span>' +data.data[i].product_price_symbol + '</span>';
                                }
                            } else {
                                if (data.data[i].product_combination != null && data.data[i].product_combination != 'null' && data.data[i].product_combination != '') {
                                    productCardPrice = data.data[i].product_combination[0].product_price_symbol;
                                }
                            }
                            switch(appendTo){
                                case 'product-list-section': 
                                    product = '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12  mt-4 mb-3">' +
                                        '<div class="product-grid-item">' +
                                            '<div class="product-grid-image">' +
                                                '<a href="' + href + '">' +
                                                    '<img class="pic-1 img-fluid" src="' + imgSrc + '">' +
                                                '</a>' +
                                                '<ul class="social">' +
                                                    '<!-- <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li> -->' +
                                                    '<li><a href="javascript:void(0)" onclick="addWishlist(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>' +
                                                    '<li><a href="javascript:void(0)" onclick="addToCart(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>' +
                                                '</ul>' +
                                            '</div>' +
                                            '<div class="product-content">' +
                                                '<h4 class="title mt-2"><a href="' + href + '">' + title + '</a></h4>' +
                                                '<div class="price">' +
                                                    productCardPrice +
                                                '</div>' +
                                                '<a class="add-to-cart" href="javascript:void(0)" onclick="buyNow(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '">Buy Now</a>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';
                                    if(i==4){
                                        return false
                                    };
                                    break;

                                case 'latest-product-section': 
                                    product = '<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12  mt-4 mb-3">' +
                                        '<div class="product-grid-item">' +
                                            '<div class="product-grid-image">' +
                                                '<a href="' + href + '">' +
                                                    '<img class="pic-1 img-fluid" src="' + imgSrc + '">' +
                                                '</a>' +
                                                '<ul class="social">' +
                                                    '<!-- <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li> -->' +
                                                    '<li><a href="javascript:void(0)" onclick="addWishlist(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>' +
                                                    '<li><a href="javascript:void(0)" onclick="addToCart(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>' +
                                                '</ul>' +
                                            '</div>' +
                                            '<div class="product-content">' +
                                                '<h4 class="title mt-2"><a href="' + href + '">' + title + '</a></h4>' +
                                                '<div class="price">' +
                                                    productCardPrice +
                                                '</div>' +
                                                '<a class="add-to-cart" href="javascript:void(0)" onclick="buyNow(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '">Buy Now</a>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';
                                    if(i==8){
                                        return false
                                    };
                                    break;

                                case 'featured-product-section':
                                    product = '<div class="slick-item mx-3 ">' +
                                        '<div class="product-grid-item">' +
                                            '<div class="product-grid-image">' +
                                                '<a href="' + href + '">' +
                                                    '<img class="pic-1 img-fluid" src="' + imgSrc + '">' +
                                                '</a>' +
                                                '<ul class="social">' +
                                                    '<!-- <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li> -->' +
                                                    '<li><a href="javascript:void(0)" onclick="addWishlist(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>' +
                                                    '<li><a href="javascript:void(0)" onclick="addToCart(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>' +
                                                '</ul>' +
                                            '</div>' +
                                            '<div class="product-content">' +
                                                '<h4 class="title mt-2"><a href="' + href + '">' + title + '</a></h4>' +
                                                '<div class="price">' +
                                                    productCardPrice +
                                                '</div>' +
                                                '<a class="add-to-cart" href="javascript:void(0)" onclick="buyNow(this)" data-id="' + data.data[i].product_id + '" data-type="' + data.data[i].product_type + '">Buy Now</a>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';
                                    break;
                            }

                            $("#" + appendTo).append(product);
                        }


                        if (appendTo != 'new-arrival' && appendTo != 'weekly-sale')
                            getSliderSettings(appendTo);
                    }
                    appendTo == 'featured-product-section' ? productListInit() : '';
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function fetchFeaturedWeeklyProduct(url, appendTo) {
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
                        // console.log(data,"final data");
                        var htmlToRender ="<article><div class='badges'><span class='badge badge-success'>Featured</span></div><div class='detail'>";
                        
                            htmlToRender +='<h5 class="title"><a  href="/product/'+data
                                    .data[0].product_id +'/'+data
                                    .data[0].product_slug+'">'+data.data[0].detail[0]
                                    .title+'</a></h5>';


                            htmlToRender +='<p class="discription">'+data.data[0].detail[0]
                                    .desc+'</p>';
                            
                            
                            

                            if (data.data[0].product_type == 'simple') {
                                if (data.data[0].product_discount_price == '' || data.data[0]
                                    .product_discount_price == null || data.data[0].product_discount_price ==
                                    'null') {
                                    htmlToRender +='<div class="price">'+data.data[0]
                                        .product_price_symbol+'</div>';
                                } else {
                                    htmlToRender +='<div class="price">'+data.data[0]
                                        .product_discount_price_symbol + '<span>' +data.data[0].product_price_symbol + '</span></div>';
                                }
                            } else {
                                if (data.data[0].product_combination != null && data.data[0]
                                    .product_combination != 'null' && data.data[0].product_combination != '') {
                                        htmlToRender +='<div class="price">'+data.data[0]
                                        .product_combination[0].product_price_symbol+'</div>';
                                }
                            }

                            htmlToRender +='<div class="pro-sub-buttons"><div class="buttons"><button type="button" class="btn  btn-link " data-id='+data.data[0]
                                .product_id+' onclick="addWishlist(this)" data-type='+data.data[0]
                                .product_type+'><i class="fas fa-heart"></i>Add to Wishlist</button>';
                                
                            htmlToRender +='<button type="button" class="btn btn-link" data-id='+data.data[0]
                                .product_id+' data-type='+data.data[0]
                                .product_type+' onclick="addCompare(this)" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Add to Compare"><i class="fas fa-align-right"></i>Add to Compare</button></div></div></div>';
                            htmlToRender +='<picture><div class="product-hover">';
                            if (data.data[0].product_type == 'simple') {
                                
                                htmlToRender +='<button type="button" onclick="addToCart(this)" class="btn btn-block btn-secondary cart swipe-to-top" >Add To Cart</button>';

                            } else {
                                
                                htmlToRender +='<a href="/product/'+data
                                    .data[0].product_id +'/'+data
                                    .data[0].product_slug+'" onclick="addToCart(this)" class="btn btn-block btn-secondary cart swipe-to-top" >View Detail</a>';
        
                            }
                            
                            htmlToRender +='</div>';

                             if (data.data[0].product_gallary != null && data.data[0].product_gallary !=
                                'null' && data.data[0].product_gallary != '') {
                                if (data.data[0].product_gallary.detail != null && data.data[0].product_gallary
                                    .detail != 'null' && data.data[0].product_gallary.detail != '') {
                                       htmlToRender +='<img class="img-fluid" src="'+data.data[0]
                                        .product_gallary.detail[1].gallary_path+'" alt="Men"s Cotton Classic Baseball Cap">';

                                }
                            }
                            htmlToRender +='</picture></article>';
                           

                        $('#weekly-sale-first-div').html(htmlToRender);
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function blogNews() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/blog_news?getGallaryDetail=1&limit=3&sortBy=id&language_id=' + 1 +
                    '&getDetail=1&getBlogCategory=1&sortType=DESC',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        var blogSection = '';
                        $.each(data.data, function(i, e){
                            blogSection += '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">' +
                                '<div class="content">' +
                                    '<div class="image">' +
                                        '<img src="{{ asset('gallary') }}/' + e.gallary.gallary_name + '" class="img-fluid">' +
                                    '</div>' +
                                    '<div class="discription text-center p-3 m-auto bg-light">' +
                                        '<a href="/blog-detail/' + e.slug + '">' +
                                            '<h3 class="font-weight-bold">' +
                                                e.detail[0].name +
                                            '</h3>' +
                                        '</a>' +
                                        '<p>' + e.detail[0].description.replace(/<[^>]*>?/gm, '').substring(0, 85) + '...</p>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';
                            if(i == 2){
                                return false;
                            } 
                        });
                        $('#blog-section').html(blogSection);
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function sliderMedia() {
            var sliderType = "{{ getSetting()['slider_style'] ? getSetting()['slider_style'] : '' }}";
            if (sliderType == "style1") {
                sliderType = 1;
            }
            if (sliderType == "style2") {
                sliderType = 2;
            }
            if (sliderType == "style3") {
                sliderType = 3;
            }
            if (sliderType == "style4") {
                sliderType = 4;
            }
            if (sliderType == "style5") {
                sliderType = 5;
            }
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/slider?getLanguage=' + 1 +
                    '&getSliderType=1&getSliderNavigation=1&getSliderGallary=1&limit=5&sortBy=id&sortType=DESC&sliderType=' +
                    sliderType + '&language_id=' + 1,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        var sliderSection = '';
                        $.each(data.data, function(i, e){
                            sliderSection += '<div class="slick-item">' +
                                '<img src="{{ asset('gallary') }}/' + e.gallary + '" class="img-fluid w-100">' +
                                '<div class="discription">' +
                                    '<h1 class="font-weight-bold"> ' + e.slider_title + '</h1>' +
                                    '<div class="ban-content">' +
                                        '<p>' + e.slider_description + '</p>' +
                                    '</div>' +
                                    '<a href="' + e.slider_url + '" class="btn anchor-btn">Learn More</a>' +
                                '</div>' +
                            '</div>';
                        });
                        $('#slider-section').html(sliderSection);
                        slickInit();
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function categorySlider() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/category?getDetail=1&page=1&limit=10&getGallary=1&language_id=' + 1 +
                    '&sortBy=category_name&sortType=DESC',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    var category = '';
                    if (data.status == 'Success') {
                        $.each(data.data, function(i, e){
                            var icon = e.icon == 'fa' ? e.icon : 'fa fa-headphones';
                            category += '<div class="slick-item mx-3">' +
                                '<div class="content text-center bg-light">' +
                                    '<a href="/shop?category=' + e.id + '">' +
                                        '<div class="box m-auto"> <i class="' + icon + '" aria-hidden="true"></i></div>' +
                                        '<div class="title mt-3">' +
                                            '<h6 class="m-0">' + e.name + '</h6>' +
                                        '</div>' +
                                    '</a>' +
                                '</div>' +
                            '</div>';
                        });
                        $('#category-section').html(category);
                        categorySlickInit();
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function bannerMedia() {
            var bannerType = "{{ getSetting()['banner_style'] ? getSetting()['banner_style'] : 'style1' }}";
            if (bannerType == "style1") {
                bannerType = 'banner1';
            }
            if (bannerType == "style2" || bannerType == "style3" || bannerType == "style4") {
                bannerType = "banner2";
            }
            if (bannerType == "style5" || bannerType == "style6") {
                bannerType = "banner5";
            }
            if (bannerType == "style7" || bannerType == "style8") {
                bannerType = "banner7";
            }
            if (bannerType == "style9") {
                bannerType = "banner9";
            }
            if (bannerType == "style10" || bannerType == "style11" || bannerType == "style12") {
                bannerType = "banner10";
            }

            if (bannerType == "style13" || bannerType == "style14" || bannerType == "style15") {
                bannerType = "banner13";
            }

            if (bannerType == "style16" || bannerType == "style17") {
                bannerType = "banner16";
            }

            if (bannerType == "style18" || bannerType == "style19") {
                bannerType = "banner18";
            }
            $('.banner_div').css('display', 'none');
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/constant_banner?getLanguage=' + languageId + '&title=' +
                    bannerType +
                    '&language_id=' + languageId + '&getGallary=1',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        if (typeof data.data[0] !== 'undefined') {
                            $('.banner-link1').attr('href', data.data[0]
                                .banner_url);

                            $('.banner-image1').attr('src', "/gallary/" + data.data[0].gallary
                                .gallary_name);
                        }



                        if (typeof data.data[1] !== 'undefined') {
                            $('.banner-link2').attr('href', data.data[1]
                                .banner_url);

                            $('.banner-image2').attr('src', "/gallary/" + data.data[1].gallary
                                .gallary_name);
                        }




                        if (typeof data.data[2] !== 'undefined') {
                            $('.banner-link3').attr('href', data.data[2]
                                .banner_url);
                            $('.banner-image3').attr('src', "/gallary/" + data.data[2].gallary
                                .gallary_name);
                        }

                        if (typeof data.data[3] !== 'undefined') {
                            $('.banner-link4').attr('href', data.data[3]
                                .banner_url);
                            $('.banner-image4').attr('src', "/gallary/" + data.data[3].gallary
                                .gallary_name);
                        }

                        if (typeof data.data[4] !== 'undefined') {

                            $('.banner-link5').attr('href', data.data[4]
                                .banner_url);
                            $('.banner-image5').attr('src', "/gallary/" + data.data[4].gallary
                                .gallary_name);
                        }
                        if (typeof data.data[5] !== 'undefined') {
                            $('.banner-link6').attr('href', data.data[5]
                                .banner_url);
                            $('.banner-image6').attr('src', "/gallary/" + data.data[5].gallary
                                .gallary_name);

                        }
                        $('.banner_div').css('display', 'block');
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }
    </script>
@endsection
