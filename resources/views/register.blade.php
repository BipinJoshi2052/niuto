@extends('layouts.master')
@section('content')
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
    <!-- register Us -->
    <section id="login-register-wrapper" class="p-4">

        <div class="login-register-form p-xl-5 p-lg-5 p-md-2 p-0">
            <div class="row position-relative">
                <div class="image w-100"><img src="frontend/assets/images/banner/1 (2).jpg" class="img-fluid"></div>
                <div class="col-xl-4 col-lg-6 col-md-8 position-absolute mx-auto form-wrapper">
                    <form class="p-2" id="registerForm">
                        <div class="text-center">
                            <h1 class="font-weight-bold my-xl-4 my-md-3 my-4">Register</h1>
                            <div class="form-group position-relative mb-xl-4 mb-md-3 mb-2">
                                <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none bg-transparent" id="registerFirstName" placeholder="Firstname">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                            </div>
                            <div class="form-group position-relative mb-xl-4 mb-md-3 mb-2">
                                <input type="text" class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none bg-transparent" id="registerLastName" placeholder="Lastname">
                                <i class="fa fa-user-o" aria-hidden="true"></i>
                            </div>
                            <div class="form-group position-relative mb-xl-4 mb-md-3 mb-2">
                                <input type="email" class="form-control border-top-0 border-right-0 border-left-0 rounded-0
                                        shadow-none bg-transparent" id="registerEmail" placeholder="Email">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </div>
                            <div class="form-group position-relative mb-xl-4 mb-md-3 mb-2">
                                <input type="password" class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none bg-transparent" id="registerPassword" placeholder="Password">
                                <i class="fa fa-key" aria-hidden="true"></i>
                            </div>
                            <div class="form-group position-relative mb-xl-4 mb-md-3 mb-2">
                                <input type="password" class="form-control border-top-0 border-right-0 border-left-0 rounded-0 shadow-none bg-transparent" id="registerConfirmPassword" placeholder="Re-type Password">
                                <i class="fa fa-key" aria-hidden="true"></i>
                            </div>

                            <button type="button" class="btn btn-success btn-block shadow border-0 py-2 text-uppercase"  id="createAccount">
                                Create an Account
                            </button>

                            <p class="text-center mt-4">
                                Already have an account?
                                <span>
                                <a href="login.html">Login</a>
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
    </section>
    <!-- register Us Ends -->
@endsection
@section('script')
<script>
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    if(loggedIn == '1'){
        window.location.href = "{{url('/')}}";
    }

    $("#createAccount").click(function(e) {
        e.preventDefault();
        creatAcount();
    });


    $(".google-click").click(function() {
        localStorage.setItem("sociallite",'google');
    });

    $(".facebook-click").click(function() {
        localStorage.setItem("sociallite",'facebook');
    });

    @if(isset($_GET["code"]) && $_GET["code"] != '')
        code = "{{$_GET['code']}}"
        scope = "{{$_GET['scope']}}"
        authuser = "{{$_GET['authuser']}}"
        prompt = "{{$_GET['prompt']}}"
        sociallite = localStorage.getItem("sociallite");
        $.ajax({
            type: 'get',
            url: "{{ url('') }}" + '/api/client/customer_login/'+sociallite+'/callback?code='+code+'&scope='+scope+'&authuser='+authuser+'&prompt='+prompt,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{isset($setting['client_id']) ? $setting['client_id'] : ''}}",
                clientsecret: "{{isset($setting['client_secret']) ? $setting['client_secret'] : ''}}",
            },
            beforeSend: function() {},
            success: function(data) {
                if(data.status == 'Success'){
                    localStorage.setItem("customerToken",data.data.token);
                    localStorage.setItem("customerHash",data.data.hash);
                    localStorage.setItem("customerId",data.data.id);
                    localStorage.setItem("customerLoggedin",'1');
                    localStorage.setItem("cartSession",'');
                    window.location.href = "/";
                }
            },
            error: function(data) {
                // console.log(data.responseJSON.errors);
                if(data.status == 422){
                    $.each( data.responseJSON.errors, function( index, value ){
                        $("#registerForm").find("."+index).html(value)
                        $("#registerForm").find("."+index).removeClass('d-none');
                    });
                }
            },
        });
    @endif

    function creatAcount() {
        firstname = $("#registerFirstName").val();
        lastname = $("#registerLastName").val();
        email = $("#registerEmail").val();
        pwd = $("#registerPassword").val();
        confirmpwd = $("#registerConfirmPassword").val();
        $(".errors").addClass('d-none');
        customerLogin = $.trim(localStorage.getItem("customerLoggedin"));
        if(customerLogin == '1'){
            toastr.error('{{ trans("already-logged-in") }}');
            return;
        }

        cartSession = $.trim(localStorage.getItem("cartSession"));
        if(cartSession == null || cartSession == 'null'){
            cartSession = '';
        }
        
        $.ajax({
            type: 'post',
            url: "{{ url('') }}" + '/api/client/customer_register',
            data:{
                first_name: firstname,
                last_name: lastname,
                email: email,
                password: pwd,
                confirm_password: confirmpwd,
                session_id:cartSession,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{isset($setting['client_id']) ? $setting['client_id'] : ''}}",
                clientsecret: "{{isset($setting['client_secret']) ? $setting['client_secret'] : ''}}",
            },
            beforeSend: function() {},
            success: function(data) {
                if(data.status == 'Success'){
                    localStorage.setItem("customerToken",data.data.token);
                    localStorage.setItem("customerHash",data.data.hash);
                    localStorage.setItem("customerId",data.data.id);
                    localStorage.setItem("customerLoggedin",'1');
                    localStorage.setItem("cartSession",'');
                    window.location.href = "/";
                }
            },
            error: function(data) {
                if(data.responseJSON.errors){
                    var err = '';
                    $.each(data.responseJSON.errors, function(i, e){
                        err += e + '\n';
                    });
                    toastr.error(err);
                    return false;
                }
                toastr.error(data.responseJSON.message);
            },
        });
    }

    $("#loginAccount").click(function(e) {
        e.preventDefault();
        loginAcount();
    })

    function loginAcount() {
        email = $("#loginEmail").val();
        password = $("#loginPassword").val();
        $(".errors").addClass('d-none');
        customerLogin = $.trim(localStorage.getItem("customerLoggedin"));
        if(customerLogin == '1'){
            toastr.error('{{ trans("already-logged-in") }}');

            return;
        }

        cartSession = $.trim(localStorage.getItem("cartSession"));
        if(cartSession == null || cartSession == 'null'){
            cartSession = '';
        }
        
        $.ajax({
            type: 'post',
            url: "{{ url('') }}" + '/api/client/customer_login',
            data:{
                email: email,
                password: password,
                session_id:cartSession,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{isset($setting['client_id']) ? $setting['client_id'] : ''}}",
                clientsecret: "{{isset($setting['client_secret']) ? $setting['client_secret'] : ''}}",
            },
            beforeSend: function() {},
            success: function(data) {
                if(data.status == 'Success'){
                    localStorage.setItem("customerToken",data.data.token);
                    localStorage.setItem("customerHash",data.data.hash);
                    localStorage.setItem("customerLoggedin",'1');
                    localStorage.setItem("customerId",data.data.id);
                    localStorage.setItem("customerFname",data.data.first_name);
                    localStorage.setItem("customerLname",data.data.last_name);
                    localStorage.setItem("cartSession",'');
                    window.location.href = '/';
                }
            },
            error: function(data) {
                // console.log(data);
                if(data.status == 422){
                    if(data.responseJSON.status == 'Error'){
                        $("#loginForm").find(".password").html(data.responseJSON.message)
                        $("#loginForm").find(".password").removeClass('d-none');
                    }
                }
                if(data.status == 422){
                    $.each( data.responseJSON.errors, function( index, value ){
                        $("#loginForm").find("."+index).html(value)
                        $("#loginForm").find("."+index).removeClass('d-none');
                    });
                }
            },
        });
    }
</script>
@endsection