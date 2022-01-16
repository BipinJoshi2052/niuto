<script>
    loggedIn = localStorage.getItem("customerLoggedin");
    if (loggedIn != '1') {
        localStorage.setItem("loginErrorMessage", "Please Login!!!");
        window.location.href = "{{url('/login')}}";
    }
</script>
@extends('layouts.master')
@section('content')
    
<!--========================== HEADER END  --->
<section id="breadcrumb_item" class="pb-0 breadcrumb mb-0">
    <div class="container">
       <div class="row">
          <div class="col-md-12 m-auto">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item font-weight-bold">
                      <a href="{{ url('/') }}"
                         ><span><i class="fa fa-home" aria-hidden="true"></i></span>
                      HOME</a
                         >
                   </li>
                   <li
                      class="breadcrumb-item font-weight-bold"
                      aria-current="page"
                      >
                      <a href="javascript:void(0)" class="text-dark">Wishlist</a>
                   </li>
                </ol>
             </nav>
          </div>
       </div>
    </div>
 </section>
 <!--============================= CHANGE PASSWORD PAGGE START  ============================ -->
 <section id="change-password-wrapper" class="py-3">
    <div class="container">
       <div class="row py-xl-5 py-md-3 py-0">
          <div class="col-lg-3 col-12 mb-xl-0 mb-lg-0 mb-3">
             @include('includes.user-dashboard')
          </div>
          <div class="col-xl-7 col-lg-7 col-md-12 col-12">
             <div class="change-password dashboard-content">
                <form method="POST" id="changePassForm">
                   <div class="form-group">
                      <label class="info-title" for="exampleInputPassword1">Old Password <span>*</span></label>
                      <input type="password" class="form-control unicase-form-control text-input" id="old_password" autocomplete="off">
                      <div class="text-danger require old_password"></div>
                   </div>
                   <div class="form-group">
                      <label class="info-title" for="exampleInputPassword1">New Password <span>*</span></label>
                      <input type="password" class="form-control unicase-form-control text-input" id="new_password" autocomplete="off">
                      <div class="text-danger require new_password"></div>
                   </div>
                   <div class="form-group">
                      <label class="info-title" for="exampleInputPassword1">Confirm Password <span>*</span></label>
                      <input type="password" class="form-control unicase-form-control text-input" id="confirm_password" autocomplete="off">
                      <div class="text-danger require confirm_password"></div>
                   </div>
                   <div class="form-group d-flex justify-content-between align-items-center">
                      <div class="form-group col-12 pl-0 text-center d-flex justify-content-between align-items-center">
                         {{-- <a href="checkout.html" class="w-25 theme_btn btn_tr">Save</a> --}}
                         <button type="submit" class="w-25 theme_btn btn_tr">Save</button>
                         {{-- <a href="#" class="forgot-password"
                            >Forgot your Password?</a
                            > --}}
                      </div>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!--============================= CHANGE PASSWORD PAGGE END  ============================ -->

@endsection
@section('script')
<script>
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    if(loggedIn != '1'){
        window.location.href ="{{url('/')}}";
    }

    cartSession = $.trim(localStorage.getItem("cartSession"));
    if(cartSession == null || cartSession == 'null'){
        cartSession = '';
    }
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    customerToken = $.trim(localStorage.getItem("customerToken"));
    customerId = $.trim(localStorage.getItem("customerId"));

    $("#changePassForm").submit(function(e){
        e.preventDefault();
        old_password = $("#changePassForm").find("#old_password").val();
        new_password = $("#changePassForm").find("#new_password").val();
        confirm_password = $("#changePassForm").find("#confirm_password").val();

        $.ajax({
            type: 'post',
            url:"{{ route('change-old-password') }}",
            data:{
                old_password:old_password,
                new_password:new_password,
                confirm_password:confirm_password,
                customerId:customerId,
            },
            headers: {
                'Authorization' : 'Bearer '+customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid:"{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret:"{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {
                $('#section-loading').css('display', 'block');
            },
            success: function(data) {
               console.log(data);
                $('#section-loading').css('display', 'none');
            
                if (data.status == 'Success') {
                    log_out();
                    // location.reload();
                    toastr.success('{{ trans("response.password-changed-successfully") }}');
                }
                else if (data.status == 'Error') {
                    toastr.error('{{ trans("response.some_thing_went_wrong") }}');
                }
            },
            error: function(response){
               console.log(response);
                $('#section-loading').css('display', 'none');
                var error_html = '';
                   $.each(response.responseJSON.errors, function(e, value){
                     $("."+e).html(value[0]);
                   });
               //  toastr.error(response.responseJSON.message);
            }
        });
    });

    function log_out(){
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
    }
</script>
@endsection
