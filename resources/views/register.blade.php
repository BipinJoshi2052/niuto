@extends('layouts.master')
@section('content')
    <section id="register" class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-12 m-auto">
              <div class="row no-gutters">
                <div class="col-md-7 m-auto">
                  <div class="contact-form bg_register m-auto p-5">
                    <h1 class="font-weight-bold text-center text-white">
                      REGISTER
                    </h1>
  
                    <form action="login.html">
                      <div class="form-group mb-4">
                        <input
                          type="text"
                          class="
                            form-control
                            bg-transparent
                            border-top-0 border-left-0 border-right-0
                            rounded-0
                            border_button_form
                          "
                          id="registerFirstName"
                          placeholder="First Name"
                        />
                      </div>
                      <div class="form-group mb-4">
                        <input
                          type="text"
                          class="
                            form-control
                            bg-transparent
                            border-top-0 border-left-0 border-right-0
                            rounded-0
                            border_button_form
                          "
                          id="registerLastName"
                          placeholder="Last Name"
                        />
                      </div>
                      <div class="form-group mb-4">
                        <input
                          type="email"
                          class="
                            form-control
                            bg-transparent
                            border-top-0 border-left-0 border-right-0
                            rounded-0
                            border_button_form
                          "
                          id="registerEmail"
                          placeholder="Email Address"
                        />
                      </div>
                      <div class="form-group mb-4">
                        <input
                          type="password"
                          class="
                            form-control
                            bg-transparent
                            border-top-0 border-left-0 border-right-0
                            rounded-0
                            border_button_form
                          "
                          id="registerPassword"
                          placeholder="Password "
                        />
                      </div>
                      <div class="form-group mb-4">
                        <input
                          type="password"
                          class="
                            form-control
                            bg-transparent
                            border-top-0 border-left-0 border-right-0
                            rounded-0
                            border_button_form
                          "
                          id="registerConfirmPassword"
                          placeholder="Confirm Password"
                        />
                      </div>
                      <div
                        class="
                          text-center
                          btn_groups-single
                          product_detail__bg
                          m-auto
                          w-50
                        "
                      >
                        <button
                          type="submit"
                          class="btn product_detail__bg py-1 text-light"
                          id="createAccount"
                        >
                          SIGN UP
                        </button>
                      </div>
                    </form>
                    <h6 class="text-white font-weight-bold text-center mb-0 py-4">
                      LOGIN WITH SOCIAL NETWORKING
                    </h6>
                    <div class="social-icon-footer ">
                      <ul class="d-flex justify-content-around">
                        <li class="facebook_bg register_button">
                          <a href="" class="text-white"
                            ><i class="fa fa-facebook" aria-hidden="true"></i
                          ></a>
                        </li>
                        <li class="twitter_bg register_button">
                          <a href="" class="text-white" ="" =""
                            ><i class="fa fa-twitter" aria-hidden="true"></i
                          ></a>
                        </li>
                        <li class="google_bg register_button">
                          <a href="" class="text-white" ="" =""
                            ><i class="fa fa-google-plus" aria-hidden="true"></i
                          ></a>
                        </li>
                        <li class="linkedin_bg register_button">
                          <a href="" class="text-white" ="" =""
                            ><i class="fa fa-linkedin" aria-hidden="true"></i
                          ></a>
                        </li>
                      </ul>
                    </div>
  
                    <a
                      class="text-white font-weight-bold text-right d-block w-100"
                      href="{{route('login')}}"
                      >Login</a
                    >
                  </div>
                </div>
              </div>
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
                    localStorage.setItem("customerFname", data.data.first_name);
                    localStorage.setItem("customerLname", data.data.last_name);
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
                    
                    localStorage.customerFname = data.data.first_name;
                    localStorage.customerLname = data.data.last_name;

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