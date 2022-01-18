<script>
    loggedIn = localStorage.getItem("customerLoggedin");
    if (loggedIn != '1') {
        localStorage.setItem("loginErrorMessage", "Please Login!!!");
        window.location.href = "{{url('/login')}}";
    }
</script>
@extends('layouts.master')
@section('content')
    
<!-- Breadcrumbs -->
<section id="breadcrumbs" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="m-0 p-0 d-flex align-items-center text-white">
                    <li class="font-weight-bold">Home</li><span class="mx-2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <li class="">Change Password</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">Change Password</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumbs Ends -->
<!-- Cart -->
<section id="password-wrapper" class="py-3">
    <div class="container">
        <div class="row py-xl-5 py-md-3 py-0">
            @include('includes.side-menu')
            <div class="col-xl-5 col-lg-5 col-md-11 col-10 mt-xl-0 mt-md-0 mt-3">
                <div class="change-password">
                    <form method="post" id="changePassForm">
                        <div class="form-group">
                            <label class="info-title" for="old_password">Old Password <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="old_password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="new_password">New Password <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="new_password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="confirm_password">Confirm Password <span>*</span></label>
                            <input type="password" class="form-control unicase-form-control text-input" id="confirm_password">
                        </div>
                        <div class="radio outer-xs">
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Cart Ends -->

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
                $('#event-loading').css('display', 'block');
            },
            success: function(data) {
                $('#event-loading').css('display', 'none');
                if (data.status == 'Success') {
                    log_out();
                    // location.reload();
                    toastr.success('{{ trans("password-changed-successfully") }}');
                }
                else if (data.status == 'Error') {
                    toastr.error('{{ trans("response.some_thing_went_wrong") }}');
                }
            },
            error: function(response){
                $('#event-loading').css('display', 'none');
                toastr.error(response.responseJSON.message);
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
