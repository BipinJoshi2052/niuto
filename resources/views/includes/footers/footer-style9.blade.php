<section class="pro-content header-section">
    <!-- //footer style nine -->
    <footer id="footerNine" class="footer-area footer-nine  d-lg-block d-xl-block pro-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="footer-image mb-4">
                                <h5>{{ trans('lables.footer-download-our-app') }}</h5>
                                <a href="javascript:void(0)"><img class="img-fluid"
                                        src="{{ asset('assets/front/images/miscellaneous/google-play-btn.png') }}"
                                        alt="google-btn"></a>
                                <a href="javascript:void(0)"><img class="img-fluid"
                                        src="{{ asset('assets/front/images/miscellaneous/app-store-btn.png') }}"
                                        alt="appstore"></a>
                            </div>
                            <div class="footer-image mb-3">
                                <h5>{{ trans('lables.footer-safe-payment') }}</h5>
                                <img class="img-fluid"
                                    src="{{ asset('assets/front/images/miscellaneous/payments.png') }}" alt="image">
                            </div>
                        </div>
                        <div class="col-6">
                            <h5>{{ trans('lables.footer-category') }}</h5>
                            <ul class="links-tag pl-0 mb-0">
                                @foreach($data['category'] as $category)
                                @if(count($category->detail) > 0)
                                <li> <a href="{{ url('/shop?category='.$category->id) }}">{{  $category->detail[0]->category_name }}</a> </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="single-footer single-footer-left">
                                <h5>{{ trans('lables.footer-our-services') }}</h5>

                                <ul class="links-list pl-0 mb-0">
                                    <li> <a href="{{ url('/') }}" title="{{ trans('lables.footer-home') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-home') }}</a> </li>
                  <li> <a href="{{ url('/shop') }}" title="{{ trans('lables.footer-home') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-shop') }}</a> </li>
                  <li> <a href="{{ url('/orders') }}" title="{{ trans('lables.footer-orders') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-orders') }}</a> </li>
                  <li> <a href="{{ url('/cart') }}" title="{{ trans('lables.footer-shopping-cart') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-shopping-cart') }}</a> </li>           
                    <li> <a href="{{ url('/wishlist') }}" title="{{ trans('lables.footer-wishlist') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-wishlist') }}</a> </li>  
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <h5>{{ trans('lables.footer-information') }}</h5>

                            <ul class="links-list pl-0 mb-0">
                                @foreach($data['pages'] as $page)
                                @if(isset($page->page_detail))
                                <li> <a href="{{ url("/page")."/".$page->slug }}"><i class="fa fa-angle-right" ></i>{{ $page->page_detail[0]->title }}</a> </li>
                                @endif
                                @endforeach 
                            </ul>
                        </div>
                        <div class="col-12 col-lg-5">
                            <h5>{{ trans('lables.footer-contact-us') }}</h5>
                            <ul class="contact-list  pl-0 mb-0">
                                <li> <i class="fas fa-map-marker"></i><span>{{isset(getSetting()['address']) ? getSetting()['address'] : '#' }}</span> </li>
                                <li> <i class="fas fa-phone"></i><span>({{isset(getSetting()['phone-number']) ? getSetting()['phone-number'] : '#' }})</span> </li>
                                <li> <i class="fas fa-envelope"></i><span> <a href="javascript:void(0)">{{isset(getSetting()['email']) ? getSetting()['email'] : '#' }}</a> </span> </li>
                          
                              </ul>

                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="container-fluid p-0">
            <div class="social-content">
                <div class="container">
                    <div class="social-div">
                        <div class="row align-items-center justify-content-between">

                            <div class="col-12 col-md-4">

                                <div class="footer-info">
                                    &copy;&nbsp;{{ trans('lables.footer-company') }} <a href="{{ url('/privacy') }}">{{ trans('lables.footer-privacy') }}</a>&nbsp;&bull;&nbsp;<a href="{{ url('/term') }}">{{ trans('lables.footer-term') }}</a>
                                  </div>
                            </div>
                            <div class="col-12 col-md-4">
                              <ul class="list">
                                <li><a href="{{isset(getSetting()['facebook_url']) ? getSetting()['facebook_url'] : '#' }}" class="fab fa-facebook-f"></a></li>
                                <li><a href="{{isset(getSetting()['twitter_url']) ? getSetting()['twitter_url'] : '#' }}" class="fab fa-twitter"></a></li>
                                <li><a href="{{isset(getSetting()['google_url']) ? getSetting()['google_url'] : '#' }}" class="fab fa-google"></a></li>
                                <li><a href="{{isset(getSetting()['linkedin_url']) ? getSetting()['linkedin_url'] : '#' }}" class="fab fa-linkedin-in"></a></li>
                                <li><a href="{{isset(getSetting()['insta_url']) ? getSetting()['insta_url'] : '#' }}" class="fab fa-instagram"></a></li>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <footer id="footerMobile" class="footer-area footer-mobile d-lg-none d-xl-none">
        <div class="container-fluid p-0">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="single-footer display-mobile">
          <h5>{{ trans('lables.footer-newsletter') }}</h5>
                            <div class="row">
                                <div class="col-7 col-md-8">
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="newsletter">
                            <div class="block">
                                <form class="form-inline">
                                    <div class="search">
                                        <input type="search" placeholder="Confirm your email..">
                                        <button class="btn btn-secondary subscribe" type="submit">
                                            <h5>{{ trans('lables.footer-subscribe') }}</h5>

                                        </button>
                                        <button class="btn-secondary arrow" type="submit">
                                            <i class=" fas fa-location-arrow"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-md-4">
                        <div class="single-footer display-mobile">
                            <h5>{{ trans('lables.footer-follow-us') }}</h5>
                            <div class="row">
                                <div class="col-7 col-md-8">
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <div class="socials">
                            <ul class="list">
                              <li><a href="{{isset(getSetting()['facebook_url']) ? getSetting()['facebook_url'] : '#' }}" class="fab fa-facebook-f"></a></li>
                              <li><a href="{{isset(getSetting()['twitter_url']) ? getSetting()['twitter_url'] : '#' }}" class="fab fa-twitter"></a></li>
                              <li><a href="{{isset(getSetting()['google_url']) ? getSetting()['google_url'] : '#' }}" class="fab fa-google"></a></li>
                              <li><a href="{{isset(getSetting()['linkedin_url']) ? getSetting()['linkedin_url'] : '#' }}" class="fab fa-linkedin-in"></a></li>
                              <li><a href="{{isset(getSetting()['insta_url']) ? getSetting()['insta_url'] : '#' }}" class="fab fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0  footer-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="single-footer">
                            <h5>{{ trans('lables.footer-about-store') }}</h5>
                            <div class="row">
                                <div class="col-7 col-md-8">
                                    <hr>
                                </div>
                            </div>
                            <ul class="contact-list  pl-0 mb-0">
                                <li> <i class="fas fa-map-marker"></i><span>{{isset(getSetting()['address']) ? getSetting()['address'] : '#' }}</span> </li>
                                <li> <i class="fas fa-phone"></i><span>({{isset(getSetting()['phone_number']) ? getSetting()['phone_number'] : '#' }})</span> </li>
                                <li> <i class="fas fa-envelope"></i><span> <a href="javascript:void(0)">{{isset(getSetting()['email']) ? getSetting()['email'] : '#' }}</a> </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="footer-block">
                            <div class="single-footer single-footer-left">
                                <h5>{{ trans('lables.footer-our-services') }}</h5>

                                <div class="row">
                                    <div class="col-7 col-md-8">
                                        <hr>
                                    </div>
                                </div>
                                <ul class="links-list pl-0 mb-0">
                                    <li> <a href="{{ url('/') }}" title="{{ trans('lables.footer-home') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-home') }}</a> </li>
                                    <li> <a href="{{ url('/shop') }}" title="{{ trans('lables.footer-home') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-shop') }}</a> </li>
                                    <li> <a href="{{ url('/orders') }}" title="{{ trans('lables.footer-orders') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-orders') }}</a> </li>
                                    <li> <a href="{{ url('/cart') }}" title="{{ trans('lables.footer-shopping-cart') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-shopping-cart') }}</a> </li>           
                                      <li> <a href="{{ url('/wishlist') }}" title="{{ trans('lables.footer-wishlist') }}"><i class="fa fa-angle-right"></i>{{ trans('lables.footer-wishlist') }}</a> </li>           
                                  </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 ">
                        <div class="single-footer single-footer-right">
                            <h5>{{ trans('lables.footer-information') }}</h5>

                            <div class="row">
                                <div class="col-7 col-md-8">
                                    <hr>
                                </div>
                            </div>
                            <ul class="links-list pl-0 mb-0">
                                <li> <a href="{{ url('/about-us') }}"><i class="fa fa-angle-right"></i>About Us</a>
                                </li>
                                <li> <a href="{{ url('/privacy') }}"><i class="fa fa-angle-right"></i>Privacy
                                        Policy</a> </li>
                                <li> <a href="{{ url('/refund') }}"><i class="fa fa-angle-right"></i>Refund
                                        Policy</a> </li>
                                <li> <a href="{{ url('/term') }}"><i class="fa fa-angle-right"></i>Term &amp;
                                        Services</a> </li>
                                <li> <a href="{{ url('/contact-us') }}"><i class="fa fa-angle-right"></i>Contact
                                        Us</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid p-0">
            <div class="copyright-content">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-12 col-md-6">
                            <div class="footer-info">
                                &copy;&nbsp;{{ trans('lables.footer-company') }} <a href="{{ url('/privacy') }}">{{ trans('lables.footer-privacy') }}</a>&nbsp;&bull;&nbsp;<a href="{{ url('/term') }}">{{ trans('lables.footer-term') }}</a>
                              </div>

                        </div>
                        <div class="col-12 col-md-6">
                            <div class="footer-image">
                                <img class="img-fluid"
                                    src="{{ asset('assets/front/images/miscellaneous/payments.png') }}">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
</section>
