<footer id="footer" class="footer-bg-color position-relative padding_top pt-5" style="--r1: 130%; --r2: 71.5%">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="footer-logo-box text_white">
                    <div class="header-logo">
                        <a class="footer-logo navbar-brand text-white font-weight-bold text-uppercase font-weight-bolder mb-4 p-0"
                            href="{{url('/')}}">
                            <img src="{{isset(getSetting()['site_logo']) ? asset(getSetting()['site_logo']) : asset('01-logo.png') }}" alt="{{isset(getSetting()['site_name']) ? getSetting()['site_name'] : 'Logo' }}" />
                        </a>
                    </div>
                    <ul class="d-flex">
                        @if (isset(getSetting()['facebook_url']))                        
                            <li class="logo-bg">
                                <a href="{{isset(getSetting()['facebook_url']) ? getSetting()['facebook_url'] : '#' }}" class="text-white"><i class="fa fa-facebook"
                                        aria-hidden="true"></i></a>
                            </li>
                        @endif
                        @if (isset(getSetting()['google_url']))                        
                            <li class="logo-bg ml-3">
                                <a href="{{isset(getSetting()['google_url']) ? getSetting()['google_url'] : '#' }}" class="text-white"=""=""><i class="fa fa-google-plus"
                                        aria-hidden="true"></i></a>
                            </li>
                        @endif
                        @if (isset(getSetting()['linkedin_url']))                        
                            <li class="logo-bg ml-3">
                                <a href="{{isset(getSetting()['google_url']) ? getSetting()['linkedin_url'] : '#' }}" class="text-white"=""=""><i class="fa fa-linkedin"
                                        aria-hidden="true"></i></a>
                            </li>
                        @endif
                        @if (isset(getSetting()['instagram_url']))
                            <li class="feature_in_bg ml-3">
                                <a href="{{isset(getSetting()['instagram_url']) ? getSetting()['instagram_url'] : '#' }}" class="text-white"=""=""><i class="fa fa-instagram"
                                        aria-hidden="true"></i></a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <div class="footer-title text_white footer_after">
                    <h4 class="mb-2 mb-md-4 text-white">Quick Links</h4>
                    <ul class="text-white">
                        <li class="mb-2">
                            <a href="{{ url('/') }}" class="text-white">Home</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ url('/shop') }}" class="text-white">Products</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ url('/checkout') }}" class="text-white">Checkout</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ url('/cart') }}" class="text-white">Cart</a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ url('/blog') }}" class="text-white">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <div class="footer-title text_white footer_after">
                    <h4 class="text-white mb-2 mb-md-4">Links</h4>
                    <ul>
                        
                        @foreach($data['pages'] as $page)
                            @if(isset($page->page_detail))
                                <li class="mb-2">
                                    <a href="{{ url("/page")."/".$page->slug }}" class="text-white" title="{{ $page->page_detail[0]->title }}">{{ $page->page_detail[0]->title }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-12 mt-4 mt-lg-0">
                <div class="footer-title text_white footer_after">
                    <h4 class="text-white mb-2 mb-md-4">Find Us</h4>
                    <ul>
                        <li class="text-white mb-2">
                            <span class="pr-3"><i class="fa fa-map-marker"
                                    aria-hidden="true"></i></span>{{isset(getSetting()['address']) ? getSetting()['address'] : '#' }}
                        </li>
                        <li class="text-white mb-2">
                            <a href="tel:{{isset(getSetting()['phone_number']) ? getSetting()['phone_number'] : '#' }}" class="text-light"><span
                                    class="pr-3"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                    {{isset(getSetting()['phone_number']) ? getSetting()['phone_number'] : '#' }}</a>
                        </li>
                        <li>
                            <a href="mailto:{{isset(getSetting()['email']) ? getSetting()['email'] : '#' }}" class="text-white"><span class="pr-3"><i
                                        class="fa fa-envelope-square" aria-hidden="true"></i></span>{{isset(getSetting()['email']) ? getSetting()['email'] : '#' }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12 text-center pb-3 pt-2">
                <p class="mb-0 text-white text-center font-weight-normal">
                    Copyright All Right Reserved 2021.
                    <span class="testimonial-title">Power by <a href="https://nextnepal.com/" style="color: white">Next Nepal</a></span>
                </p>
            </div>
        </div>
    </div>
</footer>
<!--=============================FOOTER END  ============================ -->
