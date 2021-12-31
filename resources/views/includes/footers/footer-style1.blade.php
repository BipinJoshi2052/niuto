@php
$pages = App\Models\Admin\Page::get();
$lilAbout = App\Models\Admin\Page::where('slug', 'about-us')->first();
@endphp
<!-- Footer -->
<footer id="footer-wrapper" class="position-relative pt-5 pb-3">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="footer-logo-box text-white">
                    <div class="header-logo mb-3">
                        <a class="" href="{{ url('/') }}"><img
                                src="{{ asset('frontend/assets/images/logo/logo-footer.jpeg') }}"
                                class="img-fluid"></a>
                    </div>
                    <p>
                        @if (isset($lilAbout) && $lilAbout)
                            {{ str_replace('&nbsp;', ' ', strip_tags($lilAbout->available_page_detail()->description)) }}
                        @else
                            {{ getSetting()['about_us'] }}
                        @endif
                    </p>
                    <ul class="d-flex pl-0">
                        <li class="logo-bg ">
                            <a href="{{ getSetting()['facebook_url'] }}" class="text-white"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li class="feature_in_bg ml-3">
                            <a href="{{ getSetting()['instagram_url'] }}" class="text-white"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li class="logo-bg ml-3">
                            <a href="{{ getSetting()['google_url'] }}" class="text-white"><i
                                    class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                        <li class="logo-bg ml-3">
                            <a href="{{ getSetting()['instagram_url'] }}" class="text-white"><i
                                    class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12 mt-2 mt-md-0">
                <div class="footer-title text_white footer_after">
                    <h4 class="mb-3 mb-md-4 text-white">Pages</h4>
                    <ul class="text-white">
                        <li class="mb-3">
                            <a href="{{ url('/') }}" class="text-white">Home</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ url('/shop') }}" class="text-white">Shop</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ url('/wishlist') }}" class="text-white">Wishlist</a>
                        </li>
                        <li class="mb-3">
                            <a href="{{ url('/contact-us') }}" class="text-white">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12 mt-4 mt-lg-0">
                <div class="footer-title text_white footer_after">
                    <h4 class="text-white mb-3 mb-md-4">Support</h4>
                    <ul>
                        @foreach ($pages as $page)
                            <li class="mb-3">
                                <a href="{{ url('/page', $page->slug) }}"
                                    class="text-white">{{ $page->available_page_detail()->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-4 mt-lg-0">
                <div class="footer-title text_white footer_after">
                    <h4 class="text-white mb-3 mb-md-4">Find Us</h4>
                    <ul>
                        <li class="text-white mb-3"><span class="pr-3"><i class="fa fa-map-marker"
                                    aria-hidden="true"></i></span>{{ getSetting()['address'] ?? 'Kathmandu, Nepal' }}
                        </li>
                        <li class="text-white mb-3"><span class="pr-3"><i class="fa fa-phone"
                                    aria-hidden="true"></i></span>{{ getSetting()['phone_number'] }}</li>
                        <li class="text-white "><span class="pr-3"><i class="fa fa-envelope-square"
                                    aria-hidden="true"></i></span>{{ getSetting()['email'] }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="mb-0 text-white text-center ">
                    Copyright All Right Reserved {{ date('Y') }}.
                    <span class="testimonial-title">Next Nepal Pvt.Ltd</span>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Ends -->
