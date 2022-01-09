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
                    <li class="">Profile</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">Profile</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumbs Ends -->
<!-- Profile -->
<section id="profile-wrapper" class="py-3">
    <div class="container">
        <div class="row py-xl-5 py-md-3 py-0">
            @include('includes.side-menu')
            <div class="col-xl-9 col-lg-9 col-md-11 col-10 mt-xl-0 mt-md-0 mt-3">
                <div class="row">
                    <div class="col-10">
                        <ul class="nav mb-3 d-flex justify-content-between" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold p-0 head-info text-dark" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">Profile Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  edit text-white" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false"><span class="mr-2"><i class="fa fa-pencil" aria-hidden="true"></i></span>Edit</a>
                            </li>
                        </ul>
                        <div class="profile-side-detail-edit">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                                    <div class="dashboard-content d-flex justify-content-around align-items-center h-100">
                                        {{-- <div class="dashboard-profile-image mr-3">
                                            <img src="frontend/assets/images/profile.jpg" class="tab-profile-img img-fluid">
                                        </div> --}}
                                        <ul class="w-100 mb-0">
                                            <li>
                                                Name <span id="liName">
                                                    {{-- Ram Shrestha --}}
                                                </span>
                                            </li>
                                            <li>
                                                Contact <span id="liPhone">
                                                    {{-- +123 90 --}}
                                                </span>
                                            </li>
                                            <li>
                                                Email <span id="liEmail">
                                                    {{-- ram@gmail.com --}}
                                                </span>
                                            </li>
                                            <li>
                                                Address <span id="liAddress">
                                                    {{-- Kathmandu, Nepal --}}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                                    <form id="profileForm" method="post">
                                        <div class="form-row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control" placeholder="First Name" id="first_name" name="first_name">
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" id="last_name" name="last_name">
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="phone">Phone</label>
                                                <input type="number" class="form-control" placeholder="" id="phone" name="phone">
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="gender">Email</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <label for="dob">DOB</label>
                                                <input type="text" class="form-control datepicker" id="dob" name="dob" autocomplete="off" readonly>
                                            </div>
                                            {{-- <div class="form-group col-12">
                                                <label for="image">Upload Profile Image</label>
                                                <input type="file" class="form-control-file" id="uploadprofileimage">
                                            </div> --}}
                                            <div class="form-group col-md-12 col-12">
                                                <input type="hidden" class="form-control" id="addres_id">
                                                <input type="hidden" class="form-control" id="method">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            @php
                                                getSetting()['is_deliveryboyapp_purchased'] = 0;
                                            @endphp
                                        </div>
                                    </form>
                                </div>
                            </div>
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
    if(loggedIn != '1'){
        window.location.href = "{{url('/')}}";
    }

    cartSession = $.trim(localStorage.getItem("cartSession"));
    if(cartSession == null || cartSession == 'null'){
        cartSession = '';
    }
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    customerToken = $.trim(localStorage.getItem("customerToken"));
    customerId = $.trim(localStorage.getItem("customerId"));

    $(document).ready(function(){
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });
        getProfile();
    });

    function getProfile() {
        $.ajax({
            type: 'get',
            url: "{{ url('') }}" +
                '/api/client/profile/'+customerId,
            headers: {
                'Authorization' : 'Bearer '+customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'Success') {
                    $("#liName").html(data.data.customer_first_name + ' ' + data.data.customer_last_name);
                    $("#liEmail").html(data.data.customer_email);
                    $("#profileForm").find("#first_name").val(data.data.customer_first_name);
                    $("#profileForm").find("#last_name").val(data.data.customer_last_name);
                }
            },
            error: function(data) {},
        });

        $.ajax({
            type: 'get',
            url: "{{ url('') }}" +
                '/api/client/customer_address_book?is_default=1',
            headers: {
                'Authorization' : 'Bearer '+customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {},
            success: function(data) {
                // console.log(data);
                if (data.status == 'Success') {
                    if(data.data != null && data.data != 'null' && data.data != ''){
                        $("#profileForm").find("#gender").val(data.data[0].gender);
                        $("#profileForm").find("#gender").trigger('change');
                        $("#profileForm").find("#dob").val(data.data[0].dob);
                        $("#liPhone").html(data.data[0].phone);
                        $("#liAddress").html(data.data[0].city + ', ' + data.data[0].country_id.country_name);
                        $("#profileForm").find("#phone").val(data.data[0].phone);
                        $("#profileForm").find("#method").val('put');
                        $("#profileForm").find("#addres_id").val(data.data[0].id);
                    }
                    else{
                        $("#profileForm").find("#method").val('post');
                    }
                }
            },
            error: function(data) {
            },
        });
    }

    $("#profileForm").submit(function(e){
        e.preventDefault();
        first_name = $("#profileForm").find("#first_name").val();
        last_name = $("#profileForm").find("#last_name").val();

        $.ajax({
            type: 'put',
            url: "{{ url('') }}" +
                '/api/client/profile/'+customerId,
            data:{
                first_name:first_name,
                last_name:last_name,
                type:'profile'
            },
            headers: {
                'Authorization' : 'Bearer '+customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            beforeSend: function() {
                $('#event-loading').css('display', 'block');
            },
            success: function(data) {
                $('#event-loading').css('display', 'none');
                if (data.status == 'Success') {
                    toastr.success('{{ trans("profile-updated-successfully") }}');
                }
                else if (data.status == 'Error') {
                    toastr.error('{{ trans("response.some_thing_went_wrong") }}');
                }
            },
            error: function(data) {
                $('#event-loading').css('display', 'none');
                if(data.status == 422){
                    jQuery.each(data.responseJSON.errors, function(index, item) {
                        $("#"+index).parent().find('.invalid-feedback').css('display','block');
                        $("#"+index).parent().find('.invalid-feedback').html(item);
                    });
                }
                else{
                    toastr.error('{{ trans("response.some_thing_went_wrong") }}');
                }
            },
        });

        gender = $("#profileForm").find("#gender").val();
        dob = $("#profileForm").find("#dob").val();
        phone = $("#profileForm").find("#phone").val();
        method = $("#profileForm").find("#method").val();
        if(method == 'post'){
            url = '/api/client/customer_address_book';
        }
        else{
            ids = $("#profileForm").find("#addres_id").val();
            url = '/api/client/customer_address_book/'+ids;
        }

        $.ajax({
            type: method,
            url: "{{ url('') }}" +url,
            data:{
                is_default:'1',
                gender:gender,
                first_name:first_name,
                last_name:last_name,
                dob:dob,
                phone:phone,
                type:'profile'
            },
            headers: {
                'Authorization' : 'Bearer '+customerToken,
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
                }
                else if (data.status == 'Error') {
                    toastr.error('{{ trans("response.some_thing_went_wrong") }}');
                }
            },
            error: function(data) {
                if(data.status == 422){
                    jQuery.each(data.responseJSON.errors, function(index, item) {
                        $("#"+index).parent().find('.invalid-feedback').css('display','block');
                        $("#"+index).parent().find('.invalid-feedback').html(item);
                    });
                }
                else{
                    toastr.error('{{ trans("response.some_thing_went_wrong") }}');
                }
            },
        });
    });
</script>
@endsection