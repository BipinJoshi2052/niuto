<script>
    loggedIn = localStorage.getItem("customerLoggedin");
    if (loggedIn != '1') {
        localStorage.setItem("loginErrorMessage", "Please Login!!!");
        window.location.href = "{{ url('/login') }}";
    }
</script>
@extends('layouts.master')
@section('content')

    <!-- Breadcrumbs -->
    <section id="breadcrumb_item" class="pb-0 breadcrumb mb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item font-weight-bold">
                                <a href="{{ url('/') }}"><span><i class="fa fa-home" aria-hidden="true"></i></span>
                                    HOME</a>
                            </li>
                            <li class="breadcrumb-item font-weight-bold" aria-current="page">
                                <a href="" class="text-dark">Dashboard Profile</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumbs Ends -->


    <!-- Profile -->
    <section id="profile-wrapper" class="py-3">
        <div class="container">
            <div class="row py-xl-5 py-md-3 py-0">
                <div class="col-lg-3 col-12 mb-xl-0 mb-lg-0 mb-3">
                    @include('includes.user-dashboard')
                </div>
                <div class="col-xl-9 col-lg-9 col-md-12 col-12">
                    <div class="profile-side-detail-edit">
                        <div class="dashboard-content">
                            <div class="submit-section">
                                <h4 class="font-weight-bold mb-3">Account</h4>
                                <form method="post" id="profileForm">
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-4">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" value="" id="first_name"
                                                name="first_name" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" value="" id="last_name"
                                                name="last_name" placeholder="Last Name">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="" id="email" name="email">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" value="" id="phone" name="phone"
                                                id="phone">
                                        </div>
                                        <div class="form-group col-md-6 mb-4">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control" id="gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        {{-- <div class="form-group col-md-6 mb-4">
                                            <label>Date of Birth</label>
                                            <input
                                            type="text"
                                            class="form-control datepicker"
                                            value="" id="dob" name="dob" autocomplete="off" readonly
                                            />
                                        </div> --}}
                                        <input type="hidden" class="form-control" id="addres_id">
                                        <input type="hidden" class="form-control" id="method">
                                        <div class="form-group col-12 mx-auto text-center">
                                            <button type="submit" class="w-25 theme_btn btn_tr">Save</a>
                                        </div>
                                        @php
                                            getSetting()['is_deliveryboyapp_purchased'] = 0;
                                        @endphp
                                    </div>
                                    <input type="hidden" id="method">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Profile Ends -->

@endsection
@section('script')
    <script>
        loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
        if (loggedIn != '1') {
            window.location.href = "{{ url('/') }}";
        }

        cartSession = $.trim(localStorage.getItem("cartSession"));
        if (cartSession == null || cartSession == 'null') {
            cartSession = '';
        }
        loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
        customerToken = $.trim(localStorage.getItem("customerToken"));
        customerId = $.trim(localStorage.getItem("customerId"));

        $(document).ready(function() {
            // $('.datepicker').datepicker({
            //     format: 'yyyy-mm-dd',
            // });
            getProfile();
        });

        function getProfile() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/profile/' + customerId,
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $("#profileForm").find("#first_name").val(data.data.customer_first_name);
                        $("#profileForm").find("#last_name").val(data.data.customer_last_name);
                        $("#profileForm").find("#email").val(data.data.customer_email);
                    }
                },
                error: function(data) {},
            });

            $.ajax({
                type: 'get',
                url: "{{ url('') }}" +
                    '/api/client/customer_address_book?is_default=1',
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        if (data.data != null && data.data != 'null' && data.data != '') {
                            $("#profileForm").find("#gender").val(data.data[0].gender);
                            $("#profileForm").find("#gender").trigger('change');
                            $("#profileForm").find("#dob").val(data.data[0].dob);
                            $("#profileForm").find("#phone").val(data.data[0].phone);
                            $("#profileForm").find("#method").val('put');
                            $("#profileForm").find("#addres_id").val(data.data[0].id);
                        } else {
                            $("#profileForm").find("#method").val('post');
                        }
                    }
                },
                error: function(data) {},
            });
        }

        $("#profileForm").submit(function(e) {
            e.preventDefault();
            first_name = $("#profileForm").find("#first_name").val();
            last_name = $("#profileForm").find("#last_name").val();

            $.ajax({
                type: 'put',
                url: "{{ url('') }}" +
                    '/api/client/profile/' + customerId,
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    type: 'profile'
                },
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        toastr.success('{{ trans('response.profile-updated-successfully') }}');
                        localStorage.customerFname = data.data.customer_first_name;
                        localStorage.customerLname = data.data.customer_last_name;
                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {
                    if (data.status == 422) {
                        jQuery.each(data.responseJSON.errors, function(index, item) {
                            $("#" + index).parent().find('.invalid-feedback').css('display',
                                'block');
                            $("#" + index).parent().find('.invalid-feedback').html(item);
                        });
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
            });

            gender = $("#profileForm").find("#gender").val();
            dob = $("#profileForm").find("#dob").val();
            phone = $("#profileForm").find("#phone").val();
            method = $("#profileForm").find("#method").val();
            if (method == 'post') {
                url = '/api/client/customer_address_book';
            } else {
                ids = $("#profileForm").find("#addres_id").val();
                url = '/api/client/customer_address_book/' + ids;
            }

            $.ajax({
                type: method,
                url: "{{ url('') }}" + url,
                data: {
                    is_default: '1',
                    gender: gender,
                    first_name: first_name,
                    last_name: last_name,
                    dob: dob,
                    phone: phone,
                    type: 'profile'
                },
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.status == 'Success') {
                        $("#profileForm").find("#method").val('put');
                        $("#profileForm").find("#addres_id").val(data.data.id);
                        location.reload();
                    } else if (data.status == 'Error') {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
                error: function(data) {
                    if (data.status == 422) {
                        jQuery.each(data.responseJSON.errors, function(index, item) {
                            $("#" + index).parent().find('.invalid-feedback').css('display',
                                'block');
                            $("#" + index).parent().find('.invalid-feedback').html(item);
                        });
                    } else {
                        toastr.error('{{ trans('response.some_thing_went_wrong') }}');
                    }
                },
            });
        });
    </script>
@endsection
