<!-- Breadcrumbs -->
<!-- <section id="breadcrumbs" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="m-0 p-0 d-flex align-items-center text-white">
                    <li class="font-weight-bold">Home</li><span class="mx-2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <li class="">About Us</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">About Us</h2>
            </div>
        </div>
    </div>
</section> -->
<!-- Breadcrumbs Ends -->
<!-- Login Us -->
<section id="login-register-wrapper" class="p-4">
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
                                        {{-- <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                        Remember me --}}
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
</section>
<!-- Login Us Ends -->