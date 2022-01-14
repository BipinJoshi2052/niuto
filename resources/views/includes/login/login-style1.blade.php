<!-- Login Start -->
<section id="register" class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-12 m-auto">
          <div class="row no-gutters">
            <div class="col-md-7 m-auto">
              <div class="contact-form bg_register m-auto p-5">
                <h1 class="font-weight-bold text-center text-white">Login</h1>

                <form action="dashboard.html">
                  <div class="form-group mb-4">
                    <input type="text" class="form-control bg-transparent border-top-0 border-left-0 border-right-0 rounded-0 border_button_form" id="loginEmail"
                      placeholder="Username or Email...."/>
                  </div>

                  <div class="form-group mb-4">
                    <input type="password" class="form-control bg-transparent border-top-0 border-left-0 border-right-0 rounded-0 border_button_form" id="loginPassword"
                      placeholder="Password"/>
                  </div>
                  {{-- <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input text-white" id="exampleCheck1"
                    />
                    <label class="form-check-label text-white w-100 d-md-flex justify-content-between d-block" for="exampleCheck1">
                        Remember Me
                      <span class="">Lost Your Password?</span>
                    </label>
                  </div> --}}

                  <div class="text-center btn_groups-single product_detail__bg m-auto w-50">
                    <button type="button" id="loginAccount" class="btn product_detail__bg py-1 text-light">
                      LOGIN
                    </button>
                  </div>
                </form>
                <h6 class="text-white font-weight-bold text-center mb-0 py-4">
                  LOGIN WITH SOCIAL NETWORKING
                </h6>
                <div class="social-icon-footer">
                  <ul class="d-flex justify-content-around">
                    <li class="facebook_bg register_button">
                      <a href="{{url('/api/client/customer_login/facebook')}}" class="text-white">
                          <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    </li>
                    <li class="twitter_bg register_button">
                      <a href="" class="text-white"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li class="google_bg register_button">
                      <a href="{{url('/api/client/customer_login/google')}}" class="text-white"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                    </li>
                    <li class="linkedin_bg register_button">
                      <a href="" class="text-white"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </li>
                  </ul>
                </div>
                  <p style="color: white" class="text-center mb-0">If you are new here, </p>
                <a class="text-white font-weight-bold text-center d-block w-100 " href="{{ url('/register') }}">REGISTER</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- End Login -->



<!-- Login Us -->
{{-- <section id="login-register-wrapper" class="p-4">
    <div class="container">
        <div class="login-register-form p-xl-5 p-lg-5 p-md-2 p-0">
            <div class="row position-relative">
                <div class="image w-100"><img src="frontend/assets/images/banner/1 (2).jpg" class="img-fluid"></div>
                <div class="col-xl-4 col-lg-6 col-md-8 position-absolute mx-auto form-wrapper">
                    <form class="p-2">
                        <div class="text-center">
                            <h1 class="font-weight-bold my-xl-4 my-md-3 my-4">Login</h1>
                            <div class="form-group position-relative mb-xl-4 mb-md-3 mb-2">
                                <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none bg-transparent" id="loginEmail" placeholder="Username">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                            </div>
                            <div class="form-group position-relative mb-xl-4 mb-md-3 mb-2">
                                <input type="password" class="form-control border-top-0 border-right-0 border-left-0 rounded-0
                                        shadow-none bg-transparent" id="loginPassword" placeholder="Password">
                                <i class="fa fa-key" aria-hidden="true"></i>

                            </div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <div class="form-check">
                                       
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-6 text-xl-right text-lg-right text-center mt-xl-0 mt-lg-0 mt-2">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success btn-block shadow border-0 py-2 text-uppercase" id="loginAccount">
                                Login
                            </button>

                            <p class="text-center mt-4">
                                Don't have an account?
                                <span>
                                <a href="{{ url('/register') }}">Register</a>
                            </span>

                            </p>
                            <div class="row mb-4 px-3 justify-content-center align-items-center">
                                <h6 class="mb-xl-0 mb-md-2 mb-2 mr-2">Sign in with</h6>
                                <div class="social-media d-flex justify-content-center h-100">
                                    <div class="google text-center mr-3">
                                        <a href="{{ url('/api/client/customer_login/google') }}" class="fa fa-google auth-google" aria-hidden="true"></a>
                                    </div>
                                    <div class="facebook text-center mr-3">
                                        <a class="fa fa-facebook" aria-hidden="true"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Login Us Ends -->