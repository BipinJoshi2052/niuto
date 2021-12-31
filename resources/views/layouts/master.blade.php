{{-- {{ dd(getSetting()['card_style']) }} --}}
{{-- {{ dd(getSetting()) }} --}}
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    @if (isset($user))
        <script>
            localStorage.setItem("customerToken", '{{ $user->token }}');
            localStorage.setItem("loginSuccessMessage", "Welcome {{ $user->first_name }} {{ $user->last_name }}");
            localStorage.setItem("customerHash", '{{ $user->hash }}');
            localStorage.setItem("customerLoggedin", '1');
            localStorage.setItem("customerId", '{{ $user->id }}');
            localStorage.setItem("customerFname", '{{ $user->first_name }}');
            localStorage.setItem("customerLname", '{{ $user->last_name }}');
            localStorage.setItem("cartSession", '');
            window.location.href = '/';
        </script>
    @endif
    <meta charset="UTF-8">
    <title>{{ isset(getSetting()['seo_title']) ? getSetting()['seo_title'] : 'Seo Title' }}</title>
    <meta name="description"
        content="{{ isset(getSetting()['seo_description']) ? getSetting()['seo_description'] : 'Seo Description' }}">
    <meta name="keywords"
        content="{{ isset(getSetting()['seo_keywords']) ? getSetting()['seo_keywords'] : 'Seo Keywords' }}">
    <meta name="author" content="">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png"
        href="{{ isset(getSetting()['favicon']) ? getSetting()['favicon'] : '01-fav.png' }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap link Starts -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/bootstrap-4.3.1/css/bootstrap.min.css.map') }}">
    <!-- Bootstrap link Ends -->
    <!-- Font Awesome Link Starts -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!-- Font Awesome Link Ends -->
    <!-- Slick Css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/slick/slick-theme.css') }}">
    <!-- Slick Css Ends-->
    <!-- Custom Links -->
    <!-- Font Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Orbitron:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300;1,400;1,500&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,600&display=swap"
        rel="stylesheet">
    <!-- Font Link Ends -->
    <link rel="stylesheet" href="https://k1ngzed.com/dist/swiper/swiper.min.css" />
    <link rel="stylesheet" href="https://k1ngzed.com/dist/EasyZoom/easyzoom.css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datepicker/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/jssocials/jssocials.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/jssocials/jssocials-theme-flat.css') }}">
    <!-- Custom Links Ends -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="animation-s1 {{ $data['direction'] === 'rtl' ? 'bodyrtl' : '' }}">
    {{-- <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script> --}}

    {{-- {{   dd(getSetting()) }} --}}
    {{-- @include('extras.preloader') --}}
    <!-- Whole Body Wrapper Starts -->
    <section id="index-wrapper">
        @include(isset(getSetting()['header_style']) ? 'includes.headers.header-'.getSetting()['header_style'] :
        'includes.headers.header-style1')

        @yield('content')

        @include(isset(getSetting()['Footer_style']) ? 'includes.footers.footer-'.getSetting()['Footer_style'] :
        'includes.footers.footer-style1')


    </section>
    <!-- Whole Body Wrapper Ends -->

    <!-- 1st Jquery Link Starts-->
    <script src="{{ asset('frontend/assets/jquery-3.5.1/jquery-3.5.1.js') }}"></script>
    <!-- Jquery Link Ends-->
    <!-- 2nd Popper Js Starts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <!-- Popper Js Ends -->
    <!-- 3rd Bootstrap Js Link Starts -->
    <script src="{{ asset('frontend/assets/bootstrap-4.3.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/bootstrap-4.3.1/js/bootstrap.min.js.map') }}"></script>
    <!-- Bootstrap Js Link Ends -->
    <!-- Slick Js -->
    <script src="{{ asset('frontend/assets/slick/slick.min.js') }}"></script>
    <!-- Slick Js Ends-->
    <!-- toastr Js -->
    <script src="{{ asset('/assets/toastr/toastr.min.js') }}"></script>
    {{-- <script src="{{ asset('/assets/toastr/toastr.js.map') }}"></script> --}}
    <!-- toastr Js Ends-->
    <!-- datepicker Js -->
    <script src="{{ asset('/assets/datepicker/datepicker.js') }}"></script>
    <!-- datepicker Js Ends-->
    <script src="{{ asset('/assets/jssocials/jssocials.min.js') }}"></script>
    <!-- Custom Js Starts -->
    <script src="https://k1ngzed.com/dist/swiper/swiper.min.js"></script>
    <script src="https://k1ngzed.com/dist/EasyZoom/easyzoom.js"></script>
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
    <!-- Custom Js Ends -->
    <!-- Nav Cart Popup -->
    <!-- Modal -->
    <div class="modal fade" id="nav-cart" tabindex="-1" role="dialog" aria-labelledby="navcartlabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-auto" id="navcartlabel"> <span class="mr-2"><i
                                class="fa fa-opencart" aria-hidden="true"></i></span> Items List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="top-cart-product-template">
                        {{-- <tr>
                            <div class="item">
                                <td class="pr-4 py-3"><img src=" frontend/assets/images/product-images/1 (2).jpg " class="img-fluid"></td>
                                <td class="px-4 py-3">
                                    <div class="head font-weight-bold">
                                        Beats Headphone x <span class="cart-quantity ">1</span>
                                    </div>
                                    <div class="price">
                                        Rs 1000
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="item">
                                <td class="pr-4 py-3"><img src=" frontend/assets/images/product-images/1 (1).jpg " class="img-fluid"></td>
                                <td class="px-4 py-3">
                                    <div class="head font-weight-bold">
                                        Beats Headphone x <span class="cart-quantity ">1</span>
                                    </div>
                                    <div class="price">
                                        Rs 1000
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span><i class="fa fa-trash" aria-hidden="true"></i></span>
                                </td>
                            </div>
                        </tr> --}}
                    </table>
                    <span id="top-cart-product-total"></span>
                    {{-- <div class="total-amount pt-3 text-center">
                        Total : <span class="font-weight-bold" id="top-cart-product-total">
                            Rs 1500
                        </span>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <a href="/cart" class="m-auto">
                        <button type="button" class="btn btn-primary m-auto">View Cart Page</button>
                    </a>
                    <a href="/checkout" class="m-auto">
                        <button type="button" class="btn btn-primary m-auto">Proceed Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->
    <!-- Nav Cart Popup -->

    {{-- <a href="javascript:void(0)" class="btn-secondary swipe-to-top" id="back-to-top" data-toggle="tooltip"
        data-placement="bottom" data-original-title="{{ trans('lables.general-backtotop') }}"
        title="{{ trans('lables.general-backtotop') }}">&uarr;</a> --}}

    {{-- <div class="mobile-overlay"></div> --}}

    {{-- <div class="notifications" id="notificationWishlist">Product Added To Wishlist</div> --}}



    {{-- @include('extras.settings') --}}
    {{-- @include('modals.product-quick-view') --}}

    <!-- All custom scripts here -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    {{-- <script src="{{ asset('assets/front/js/scripts.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}

    @php
        $language_id = $data['selectedLenguage'];
        $locale = session()->get('locale');
        //dd ($locale);
    @endphp
    <script>
        loginErrorMessage = localStorage.getItem("loginErrorMessage");
        // console.log(loginErrorMessage);
        if (loginErrorMessage != null) {
            toastr.error(loginErrorMessage);
            localStorage.removeItem("loginErrorMessage");
        }
    </script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
        customerFname = $.trim(localStorage.getItem("customerFname"));
        customerLname = $.trim(localStorage.getItem("customerLname"));

        if (loggedIn != '1') {
            $(".auth-login").remove();
            $(".without-auth-login").removeAttr('hidden');
        } else {
            $(".auth-login").removeAttr('hidden');
            $(".without-auth-login").remove();
            $(".welcomeUsername").html(customerFname + " " + customerLname);
        }

        customerToken = $.trim(localStorage.getItem("customerToken"));

        languageId = localStorage.getItem("languageId");
        languageName = localStorage.getItem("languageName");

        if (languageName == null || languageName == 'null') {
            localStorage.setItem("languageId", $.trim("{{ $data['selectedLenguage'] }}"));
            localStorage.setItem("languageName", $.trim("{{ $data['selectedLenguageName'] }}"));
            $(".language-default-name").html($.trim("{{ $data['selectedLenguageName'] }}"));
            languageId = $.trim("{{ $data['selectedLenguage'] }}");
        } else {
            $(".language-default-name").html(localStorage.getItem("languageName"));
            $('.mobile-language option[value="' + localStorage.getItem("languageId") + '"]').attr('selected', 'selected');
        }

        currency = localStorage.getItem("currency");
        currencyCode = localStorage.getItem("currencyCode");
        if (currencyCode == null || currencyCode == 'null') {
            localStorage.setItem("currency", $.trim("{{ $data['selectedCurrency'] }}"));
            localStorage.setItem("currencyCode", $.trim("{{ $data['selectedCurrencyName'] }}"));
            $("#selected-currency").html($.trim("{{ $data['selectedCurrencyName'] }}"));
            currency = 1;
        } else {
            $("#selected-currency").html(localStorage.getItem("currencyCode"));
            $('.currency option[value="' + localStorage.getItem("languageId") + '"]').attr('selected', 'selected');
        }

        cartSession = $.trim(localStorage.getItem("cartSession"));
        if (cartSession == null || cartSession == 'null') {
            cartSession = '';
        }
        $(document).ready(function() {

            loginSuccessMessage = localStorage.getItem("loginSuccessMessage");
            if (loginSuccessMessage != null) {
                toastr.success(loginSuccessMessage);
                localStorage.removeItem("loginSuccessMessage");
            }

            if (loggedIn != '1') {
                localStorage.setItem("cartSession", cartSession);
                menuCart(cartSession);
            } else {
                menuCart('');
            }
            getWishlist();

            // if (loggedIn != '1') {
            //     // console.log('login');
            //     $(".auth-login").remove();
            // } else {
            //     // console.log('no login');
            //     $(".without-auth-login").remove();
            //     $(".welcomeUsername").html(customerFname + " " + customerLname);
            // }
        });

        function getSliderSettings(className) {
            jQuery(document).ready(function() {
                (function(jQuery) {
                    var tabCarousel = jQuery('.' + className);
                    if (tabCarousel.length) {

                        tabCarousel.each(function() {
                            var thisCarousel = jQuery(this),
                                item = jQuery(this).data('item'),
                                itemmobile = jQuery(this).data('itemmobile');



                            thisCarousel.slick({
                                lazyLoad: 'progressive',
                                dots: false,
                                arrows: true,
                                infinite: false,
                                // variableWidth: true,
                                //rtl:true,
                                speed: 300,
                                slidesToShow: item || 4,
                                slidesToScroll: item || 4,
                                adaptiveHeight: true,
                                responsive: [{
                                        breakpoint: 1025,
                                        settings: {
                                            slidesToShow: 3,
                                            slidesToScroll: 3
                                        }
                                    },
                                    {
                                        breakpoint: 992,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 2
                                        }
                                    },
                                    {
                                        breakpoint: 768,
                                        settings: {
                                            slidesToShow: itemmobile || 1,
                                            slidesToScroll: itemmobile || 1
                                        }
                                    }
                                ]
                            });
                        });
                    };

                })(jQuery);
            });
        }

        function getWishlist() {
            if (loggedIn != '1') {
                return;
            }

            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/wishlist',
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
                        $(".wishlist-count").html(data.data.length);
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function addWishlist(input) {
            if (loggedIn != '1') {
                toastr.error('{{ trans('response.please_login_first') }}')
                return;
            }

            $.ajax({
                type: 'post',
                url: "{{ url('') }}" + '/api/client/wishlist?product_id=' + $(input).attr('data-id'),
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
                        $(".wishlist-count").html(data.data.length);
                        toastr.success('Product added to wishlist')
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function addCompare(input) {
            if (loggedIn != '1') {
                toastr.error('{{ trans('response.please_login_first') }}')
                return;
            }


            customerId = $.trim(localStorage.getItem("customerId"));
            $.ajax({
                type: 'post',
                url: "{{ url('') }}" + '/api/client/compare?product_id=' + $(input).attr('data-id') +
                    '&customer_id=' + customerId,
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
                        toastr.success('{{ trans('response.compare-add-success') }}')

                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function quiclViewData(input) {
            product_type = $.trim($(input).attr('data-type'));
            product_id = $.trim($(input).attr('data-id'));
            $(".quick-view-modal-show").html('');
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/products/' + product_id +
                    '?getCategory=1&getDetail=1&language_id=' + languageId + '&currency=' + localStorage.getItem(
                        "currency"),
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
                        const templ = document.getElementById("quick-view-template");
                        const clone = templ.content.cloneNode(true);
                        // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
                        if (data.data.product_gallary != null && data.data.product_gallary != 'null' && data
                            .data.product_gallary != '') {
                            if (data.data.product_gallary.detail != null && data.data.product_gallary.detail !=
                                'null' && data.data.product_gallary.detail != '') {
                                clone.querySelector(".quick-view-image").setAttribute('src', data.data
                                    .product_gallary.detail[1].gallary_path);
                            }
                        }
                        if (data.data.detail != null && data.data.detail != 'null' && data.data.detail != '') {
                            clone.querySelector(".quick-view-image").setAttribute('alt', data.data.detail[0]
                                .title);
                        }
                        if (data.data.category != null && data.data.category != 'null' && data.data.category !=
                            '') {
                            for (j = 0; j < data.data.category.length; j++) {
                                if (data.data.category[j].category_detail != null && data.data.category[j]
                                    .category_detail != 'null' && data.data.category[j].category_detail != '') {
                                    if (data.data.category[j].category_detail.detail != null && data.data
                                        .category[j].category_detail.detail != 'null' && data.data.category[j]
                                        .category_detail.detail != '') {
                                        clone.querySelector(".quick-view-categories").innerHTML =
                                            '<li><a href="javascript:void(0)">' + data.data.category[j]
                                            .category_detail.detail[0]
                                            .name + '</a></li>';
                                    }
                                }
                            }
                        }
                        if (data.data.detail != null && data.data.detail != 'null' && data.data.detail != '') {
                            clone.querySelector(".quick-view-product-name").innerHTML = data.data.detail[0]
                                .title;
                            clone.querySelector(".quick-view-desc").innerHTML = data.data.detail[0].desc
                                .replace(/<\/?[^>]+>/gi, '').substring(0, 250)
                        }
                        clone.querySelector(".quick-view-product-id").innerHTML = data.data.product_id;

                        if (data.data.product_type == 'simple') {
                            if (data.data.product_discount_price == '' || data.data.product_discount_price ==
                                null || data.data.product_discount_price == 'null') {
                                clone.querySelector(".quick-view-price").innerHTML = '<ins>' + data.data
                                    .product_price_symbol + '</ins>';
                            } else {
                                clone.querySelector(".quick-view-price").innerHTML = '<ins>' + data.data
                                    .product_discount_price + '</ins> <del>' + data.data
                                    .product_price_symbol +
                                    '</del>';
                            }

                            clone.querySelector(".quick-view-add-to-cart").setAttribute('onclick',
                                'addToCart(this)');
                            clone.querySelector(".quick-view-add-to-cart").setAttribute('data-id', data.data
                                .product_id);
                        } else {
                            if (data.data.product_combination != null && data.data.product_combination !=
                                'null' && data.data.product_combination != '') {
                                clone.querySelector(".quick-view-price").innerHTML = '<ins>' + data.data
                                    .product_combination[0].product_price_symbol + '</ins>';
                            }
                            clone.querySelector(".quick-view-qty").classList.add('d-none');
                            clone.querySelector(".quick-view-add-to-cart").setAttribute('href', '/product/' +
                                data
                                .data.product_id + '/' + data
                                .data.product_slug);
                            clone.querySelector(".quick-view-add-to-cart").innerHTML = 'View Detail';
                        }
                        $(".quick-view-modal-show").html('');
                        $(".quick-view-modal-show").append(clone);
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function buyNow(input){
            if(loggedIn == '1'){
                addToCart(input);
                window.location.href = '{{ url('checkout') }}';
            }else{
                toastr.error('Please login');
            }
        }

        function addToCart(input) {
            product_type = $.trim($(input).attr('data-type'));
            product_id = $.trim($(input).attr('data-id'));
            product_combination_id = '';
            if (product_type == 'variable') {
                if ($.trim($("#product_combination_id").val()) == '' || $.trim($("#product_combination_id").val()) ==
                    'null') {
                    toastr.error("{{ trans('response.select-combination') }}")
                    return;
                }
                product_combination_id = $("#product_combination_id").val();
            }
            if ($(input).parents('tr').data('row') == 'wishlistRows') {
                $(input).parents('tr').find('.wishlistProductQty').attr('id', 'quantity-input');
            }
            qty = $.trim($("#quantity-input").val());
            $(input).parents('tr').find('.wishlistProductQty').removeAttr('id');
            if (qty == '' || qty == 'undefined' || qty == null) {
                qty = 1;
            }
            addToCartFun(product_id, product_combination_id, cartSession, qty);
        }

        function addToCartFun(product_id, product_combination_id, cartSession, qty) {
            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart?session_id=' + cartSession + '&product_id=' + product_id +
                    '&qty=' + qty + '&product_combination_id=' + product_combination_id;
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/store?session_id=' + cartSession + '&product_id=' +
                    product_id + '&qty=' + qty + '&product_combination_id=' + product_combination_id;
            }
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
                        if (loggedIn != '1') {
                            localStorage.setItem("cartSession", data.data.session);
                            // console.dir(data);
                            menuCart(data.data.session);
                        } else {
                            menuCart('');
                        }
                        toastr.success('{{ trans('response.add-to-cart-success') }}')
                    } else if (data.status == 'Error') {

                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                    if (data.responseJSON.status == 'Error') {
                        // toastr.error(data.responseJSON.message);
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }

                },
            });
        }

        function menuCart(cartSession) {
            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart?session_id=' + cartSession + '&currency=' + localStorage
                    .getItem("currency");
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/get?session_id=' + cartSession + '&currency=' +
                    localStorage.getItem("currency");
            }
            $.ajax({
                type: 'get',
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
                        total_price = 0;
                        currrency = '';
                        var qtyAmountRow = '';
                        var deleteRow = '';
                        var totalRow = '';
                        var clone = '';
                        for (i = 0; i < data.data.length; i++) {
                            if (data.data[i].product_type == 'variable') {
                                for (k = 0; k < data.data[i].combination.length; k++) {
                                    if (data.data[i].product_combination_id == data.data[i].combination[k]
                                        .product_combination_id) {
                                        price = data.data[i].combination[k].price;
                                        $(".product-card-price").html(data.data[i].product_price_symbol);
                                        if (data.data[i].combination[k].gallary != null && data.data[i]
                                            .combination[k].gallary != 'null' && data.data[i].combination[k]
                                            .gallary != '') {
                                            imageSrc = '/gallary/' + data.data[i].combination[k].gallary
                                                .gallary_name;
                                            imageAlt = data.data[i].combination[k].gallary.gallary_name;
                                            name = data.data[i].product_detail[0].title;
                                            for (loop = 0; loop < data.data[i].product_combination
                                                .length; loop++) {
                                                if (data.data[i].product_combination[loop].length - 1 == loop) {
                                                    name += data.data[i].product_combination[loop].variation
                                                        .detail[0].name;
                                                } else {
                                                    name += data.data[i].product_combination[loop].variation
                                                        .detail[0].name + '-';
                                                }
                                            }
                                        }
                                        k = data.data[i].combination.length;
                                    } else {}
                                }
                            } else {
                                if (data.data[i].product_gallary != null && data.data[i].product_gallary !=
                                    'null' && $.trim(data.data[i].product_gallary) != '') {
                                    if (data.data[i].product_gallary.detail != null && data.data[i]
                                        .product_gallary.detail != 'null' && $.trim(data.data[i].product_gallary
                                            .detail) != '') {
                                        imageSrc = data.data[i].product_gallary.detail[2].gallary_path;
                                        if (imageSrc.startsWith('/')) {
                                            imageSrc = imageSrc.substring(1);
                                        }
                                    }
                                }
                                if (data.data[i].product_detail != null && data.data[i].product_detail !=
                                    'null' && $.trim(data.data[i].product_detail) != '') {
                                    imageAlt = data.data[i].product_detail[0].title;
                                    name = data.data[i].product_detail[0].title;
                                }
                            }

                            if (data.data[i].discount_price > 0) {
                                discount_price = data.data[i].discount_price;
                            } else {
                                discount_price = data.data[i].price;
                            }
                            //discount_price = +data.data[i].price - +data.data[i].discount_price;
                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    qtyAmountRow = '<td class="px-4 py-3">' +
                                        '<div class="head font-weight-bold">' +
                                        name + ' x <span class="cart-quantity ">' + data.data[i].qty +
                                        '</span>' +
                                        '</div>' +
                                        '<div class="price">' +
                                        data.data[i].currency.code + ' ' + discount_price +
                                        '</div>' +
                                        '</td>';
                                    deleteRow = '<td class="px-4 py-3">' +
                                        '<span><i class="fa fa-trash" aria-hidden="true"   data-id=' + data
                                        .data[i].product_id + ' data-combination-id=' + data.data[i]
                                        .product_combination_id +
                                        ' onclick="removeCartItem(this)"></i></span>' +
                                        '</td>';
                                } else {
                                    qtyAmountRow = '<td class="px-4 py-3">' +
                                        '<div class="head font-weight-bold">' +
                                        name + ' x <span class="cart-quantity ">' + data.data[i].qty +
                                        '</span>' +
                                        '</div>' +
                                        '<div class="price">' +
                                        discount_price + ' ' + data.data[i].currency.code +
                                        '</div>' +
                                        '</td>';
                                    deleteRow = '<td class="px-4 py-3">' +
                                        '<span><i class="fa fa-trash" aria-hidden="true"   data-id=' + data
                                        .data[i].product_id + ' data-combination-id=' + data.data[i]
                                        .product_combination_id +
                                        ' onclick="removeCartItem(this)"></i></span>' +
                                        '</td>';
                                }
                            }

                            total_price = total_price + (discount_price * data.data[i].qty);

                            clone += '<tr>' +
                                '<div class="item">' +
                                '<td class="pr-4 py-3"><img src="{{ asset('/') }}' + imageSrc +
                                '" class="img-fluid"></td>' +
                                qtyAmountRow +
                                deleteRow +
                                '</div>' +
                                '</tr>';

                            $("#top-cart-product-template").html(clone);

                            currrency = data.data[i].currency;
                        }
                        if (currrency != '' && currrency != 'null' && currrency != null) {
                            if (currrency.symbol_position == 'left') {
                                total_price = currrency.code + ' ' + total_price;
                            } else {
                                total_price = total_price + ' ' + currrency.code;
                            }
                        }
                        if (data.data.length > 0) {
                            totalRow += '<div class="total-amount pt-3 text-center">' +
                                'Total : <span class="font-weight-bold">' +
                                total_price +
                                '</span>' +
                                '</div>';
                            $("#total-menu-cart-product-count").html(data.data.length);
                            $("#top-cart-product-total").html(totalRow);
                            $('#nav-cart > div > div > div').eq(2).show();
                        } else {
                            $("#total-menu-cart-product-count").html(data.data.length);
                            $("#top-cart-product-template").html('<tr><td>No Items</td></tr>');
                            $("#top-cart-product-total").html('');
                            $('#nav-cart > div > div > div').eq(2).hide();
                        }
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        $(document).on('click', '.quantity-plus', function() {
            var quantity = $('#quantity-input').val();
            $('#quantity-input').val(parseInt(quantity) + 1);
        })

        $(document).on('click', '.quantity-minus', function() {
            var quantity = $('#quantity-input').val();
            if (quantity > 1)
                $('#quantity-input').val(parseInt(quantity) - 1);
        });

        $(".language-default").click(function(e) {
            e.preventDefault();
            languageId = $(this).attr('data-id');
            languageName = $(this).attr('data-name');
            localStorage.setItem("languageId", languageId);
            localStorage.setItem("languageName", languageName);
            $(".language-default-name").html(languageName);
            var href = $(this).attr('href');
            window.location.href = href;
        });

        $(".mobile-language").change(function(e) {
            e.preventDefault();
            languageId = $(this).val();
            languageName = $(".mobile-language option:selected").text();
            localStorage.setItem("languageId", languageId);
            localStorage.setItem("languageName", languageName);
            var href = $(".mobile-language option:selected").attr('data-link');
            window.location.href = href;
        });


        $('.cat-dropdown').click(function() {
            var category_id = $(this).attr('data-id');
            var category_name = $(this).attr('data-name');
            $('.selected_category').attr('data-id', category_id);
            $('.selected_category').html(category_name);
        });

        $('#search-input').on('keyup', function(e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                var searchInput = $('#search-input').val();
                if (searchInput == "") {
                    toastr.error("Search input empty!!!")
                } else {
                    var url = "{{ url('/shop') }}" + '?search=' + searchInput;
                    var catgory_id = $('.selected_category').attr('data-id');
                    if (catgory_id != '' && catgory_id !== undefined)
                        url += "&category=" + catgory_id;
                    window.location.href = url;
                }
            }
        });


        $(".selected-currency").click(function(e) {
            e.preventDefault();
            currencyId = $(this).attr('data-id');
            currencycode = $(this).attr('data-code');
            localStorage.setItem("currency", currencyId);
            localStorage.setItem("currencyCode", currencycode);
            $("#selected-currency").html(currencycode);
            var href = $(this).attr('href');
            location.reload();
        });

        $(".currency").change(function(e) {
            e.preventDefault();
            lcurrencyId = $(this).attr('data-id');
            currencycode = $(this).attr('data-code');
            localStorage.setItem("currency", currencyId);
            localStorage.setItem("currencyCode", currencycode);
            location.reload();
        });

        $('.log_out').click(function() {
            // $('body').click(function() {
            url = "{{ url('') }}" + '/api/client/customer_logout';

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
                        localStorage.removeItem("customerToken");
                        localStorage.removeItem("loginErrorMessage");
                        localStorage.removeItem("loginSuccessMessage");
                        localStorage.removeItem("customerHash");
                        localStorage.removeItem("customerLoggedin");
                        localStorage.removeItem("customerId");
                        localStorage.removeItem("customerFname");
                        localStorage.removeItem("customerLname");
                        localStorage.removeItem("cartSession", '');
                        location.reload();
                    }
                },
                error: function(data) {},
            });
        });

        function cartItem(cartSession) {
            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart?session_id=' + cartSession + '&language_id=' + languageId +
                    '&currency=' + localStorage.getItem("currency");
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/get?session_id=' + cartSession + '&language_id=' +
                    languageId + '&currency=' + localStorage.getItem("currency");
            }

            $.ajax({
                type: 'get',
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
                        $("#cartItem-product-show").html('');
                        const templ = document.getElementById("cartItem-Template");
                        total_price = 0;
                        for (i = 0; i < data.data.length; i++) {
                            $("#totalItems").val(i + 1);
                            if (data.data[i].product_type == 'variable') {
                                for (k = 0; k < data.data[i].combination.length; k++) {
                                    if (data.data[i].product_combination_id == data.data[i].combination[k]
                                        .product_combination_id) {
                                        if (data.data[i].combination[k].gallary != null) {
                                            clone.querySelector(".cartItem-image").setAttribute('src',
                                                '/gallary/' + data.data[i].combination[k].gallary
                                                .gallary_name);
                                            clone.querySelector(".cartItem-image").setAttribute('alt', data
                                                .data[i].combination[k].gallary.gallary_name);
                                            name = data.data[i].product_detail[0].title;
                                            for (loop = 0; loop < data.data[i].product_combination
                                                .length; loop++) {
                                                if (data.data[i].product_combination.length - 1 == loop) {
                                                    name += data.data[i].product_combination[loop].variation
                                                        .detail[0].name;
                                                } else {
                                                    name += data.data[i].product_combination[loop].variation
                                                        .detail[0].name + '-';
                                                }
                                            }
                                            clone.querySelector(".cartItem-name").innerHTML = name;
                                        }
                                        k = data.data[i].combination.length;
                                    } else {}
                                }
                            } else {
                                if (data.data[i].product_gallary != null && $.trim(data.data[i]
                                        .product_gallary) != '') {
                                    if (data.data[i].product_gallary.detail != null && $.trim(data.data[i]
                                            .product_gallary.detail) != '') {
                                        imgSrc = data.data[i].product_gallary.detail[2].gallary_path;
                                    }
                                }
                                if (data.data[i].product_detail != null && $.trim(data.data[i]
                                    .product_detail) != '') {
                                    imgAlt = data.data[i].product_detail[0].title;
                                    itemName = data.data[i].product_detail[0].title;
                                }
                            }

                            if (data.data[i].discount_price > 0) {
                                discount_price = data.data[i].discount_price;
                            } else {
                                discount_price = data.data[i].price;
                            }
                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    sum = +data.data[i].qty * +discount_price;
                                    cartItemTotal = data.data[i].currency.code + ' ' + sum.toFixed(2);
                                    cartItemPrice = data.data[i].currency.code + ' ' + discount_price.toFixed(
                                    2);
                                } else {
                                    sum = +data.data[i].qty * +discount_price;
                                    cartItemTotal = sum.toFixed(2) + ' ' + data.data[i].currency.code;
                                    cartItemPrice = discount_price.toFixed(2) + ' ' + data.data[i].currency
                                    .code;
                                }
                            } else {
                                cartItemPrice = discount_price.toFixed(2);
                            }
                            itemQty = +data.data[i].qty;
                            $(".cartItem-qty").attr('id', 'quantity' + i);

                            total_price = total_price + (discount_price * data.data[i].qty);


                            // if ($.trim(data.data[i].category_detail[0].category_detail) != '' && $.trim(data
                            //         .data[i].category_detail[0].category_detail) != 'null' && $.trim(data.data[
                            //         i].category_detail[0].category_detail) != null) {
                            //     clone.querySelector(".cartItem-category-name").innerHTML = data.data[i]
                            //         .category_detail[0].category_detail.detail[0].name;
                            // }

                            tbodyRow = '<tr class="cartItem-row" product_combination_id="' + data.data[i]
                                .product_combination_id + '" product_id="' + data.data[i].product_id +
                                '" product_type="' + data.data[i].product_type + '">' +
                                '<td class="cart-image">' +
                                '<img src="' + imgSrc + '" class="img-fluid cartItem-image">' +
                                '</td>' +
                                '<td class="cart-product-name-info">' +
                                '<h4 class="cart-product-description cartItem-name">' + itemName + '</h4>' +
                                '<div class="row">' +
                                '<div class="col-4">' +
                                '<div class="rating rateit-small"></div>' +
                                '</div>' +
                                '</div>' +
                                '</td>' +
                                '<td class="cart-product-grand-total"><span class="cart-grand-total-price">' +
                                cartItemPrice + '</span>' +
                                '</td>' +
                                '<td class="cart-product-quantity">' +
                                '<div class="quant-input">' +
                                '<input type="number" value="' + itemQty + '" class="cartItem-qty">' +
                                '</div>' +
                                '</td>' +
                                '<td class="cart-product-grand-total"><span class="cart-grand-total-price">' +
                                cartItemTotal + '</span>' +
                                '</td>' +
                                '<td class="romove-item">' +
                                '<a href="javascript:void(0)" title="cancel" class="icon cartItem-remove" onclick="removeCartItem(this)" data-id="' +
                                data.data[i].product_id + '" data-combination-id="' + data.data[i]
                                .product_combination_id + '"><i class="fa fa-trash-o"></i></a>' +
                                '</td>' +
                                '</tr>';

                            $("#cartItem-product-show").append(tbodyRow);

                            // const temp1 = document.getElementById("cartItem-grandtotal-template");
                            // const clone1 = temp1.content.cloneNode(true);
                            if (data.data[i].currency != '' && data.data[i].currency != 'null' && data.data[i]
                                .currency != null) {
                                if (data.data[i].currency.symbol_position == 'left') {
                                    $(".caritem-subtotal").html(data.data[i].currency.code + ' ' + total_price
                                        .toFixed(2));
                                    $(".caritem-subtotal").attr('price', total_price.toFixed(2));
                                    $(".caritem-subtotal").attr('price-symbol', data.data[i].currency.code +
                                        ' ' + total_price.toFixed(2));
                                    $(".caritem-grandtotal").html(data.data[i].currency.code + ' ' + total_price
                                        .toFixed(2));
                                } else {
                                    $(".caritem-subtotal").html(total_price.toFixed(2) + ' ' + data.data[i]
                                        .currency.code);
                                    $(".caritem-subtotal").attr('price', total_price.toFixed(2));
                                    $(".caritem-subtotal").attr('price-symbol', data.data[i].currency.code +
                                        ' ' + total_price.toFixed(2));
                                    $(".caritem-grandtotal").html(total_price.toFixed(2) + ' ' + data.data[i]
                                        .currency.code);
                                }
                            }
                        }

                        couponCart = $.trim(localStorage.getItem("couponCart"));
                        if (couponCart != 'null' && couponCart != '') {
                            $("#coupon_code").val(couponCart);
                            couponCartItem();
                        }

                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }

        function removeCartItem(input) {
            product_id = $.trim($(input).attr('data-id'));
            product_combination_id = $.trim($(input).attr('data-combination-id'));
            if (product_combination_id == null || product_combination_id == 'null') {
                product_combination_id = '';
            }

            if (loggedIn == '1') {
                url = "{{ url('') }}" + '/api/client/cart/delete?session_id=' + cartSession + '&product_id=' +
                    product_id +
                    '&product_combination_id=' + product_combination_id + '&language_id=' + languageId;
            } else {
                url = "{{ url('') }}" + '/api/client/cart/guest/delete?session_id=' + cartSession + '&product_id=' +
                    product_id + '&product_combination_id=' + product_combination_id + '&language_id=' + languageId;
            }

            $.ajax({
                type: 'DELETE',
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
                        $(input).closest('tr').remove();
                        cartItem(cartSession);
                        menuCart(cartSession);
                        toastr.error('Product removed from cart');
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {
                    $('#event-loading').css('display', 'none');
                },
            });
        }
    </script>

    @yield('script')

    <script>
        $(document).ajaxStop(function() {
            myFunction();
        });

        $(document).on('keyup', '#search-input', function() {
            var name = $(this).val();
            if (name.length > 0) {
                $.ajax({
                    url: '{{ route('search-product') }}',
                    dataType: 'json',
                    method: 'get',
                    data: {
                        name: name
                    },
                    success: function(response) {
                        // console.log(response)
                        if (response.length > 0) {
                            $('#searchBox > ul').html('');
                            var results = '';
                            $.each(response, function(i, e) {
                                price = e.price;
                                discount = e.discount_price;
                                newPrice = parseInt(price) - parseInt(discount);
                                results += '<a href="/product/' + e.id + '/' + e.product_slug + '" style="text-decoration: none;">' +
                                    '<li class="dropdown-item">' +
                                        '<img class="img-thumbnail" src="{{ asset("/gallary") }}/' + e.gallary_name + '" style="width: 150px; height: 100px;"> ' + e.title + ' (Rs. ' + newPrice + ')' +
                                    '</li>' +
                                '</a>';
                            });
                            $('#searchBox > ul').html(results);
                            $('#searchBox').addClass('show');
                            $('#searchBox > ul').addClass('show');
                        } else {
                            $('#searchBox > ul').html('');
                            $('#searchBox').removeClass('show');
                            $('#searchBox > ul').removeClass('show');
                        }
                    },
                    error: function(error) {
                        // console.log(error);
                    }
                });
            } else {
                $('#searchBox').html('');
                $('#searchBox').prop('hidden', true);
            }
        });

        $('#search-clear').on('click', function(){
            $('#search-input').val('');
        })

        $('body').click(function(e) {
            if (e.target.id == "searchBox" || e.target.id == "search-input"){
                return;
            }
            if ($(e.target).closest('#searchBox').length){
                return;
            }
            $('#searchBox > ul').html('');
            $('#searchBox').removeClass('show');
            $('#searchBox > ul').removeClass('show');
        });
    </script>
</body>

</html>
