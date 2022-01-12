<?php
$profileNav = Request::is('profile');
$orderNav = Request::is('orders*');
$shippingNav = Request::is('shipping-address');
$cartNav = Request::is('cart');
$wishlistNav = Request::is('wishlist');
$passwordNav = Request::is('change-password');
$active = 'active';
$unactive = '';
// dd(Route::current());
?>
<div class="dashboard-list py-lg-5 px-lg-3 d-lg-block auth-login">
    <div class="d-user-avater text-center mb-4">
        <img src="{{ asset('images/noimage.png') }}" class="img-fluid avater user_avatar_in_profile"
            alt="profile-image" id="profile_img">
        <h5 class="user_name_in_profile">Muniraj</h5>
        <form>
            <a href="javascript:void(0)" class="text_yellow" onclick="changeProfile()"> <span class="mr-1"><i
                        class="fa fa-pencil" aria-hidden="true"></i></span> Upload Image</a>
            <input type="file" id="prf-pic" style="display: none" />
        </form>
    </div>
    <ul class="sidebar">
        <li class="{{ $profileNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
            <a href="{{ url('/profile') }}"><span class="mr-2"><i class="fa fa-user"
                        aria-hidden="true"></i></span>Profile</a>
        </li>
        <li class="{{ $orderNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
            <a href="{{ url('/orders') }}"><span class="mr-2"><i class="fa fa-sort"
                        aria-hidden="true"></i></span>Order Status</a>
        </li>
        <li class="{{ $shippingNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
            <a href="{{ url('/shipping-address') }}"><span class="mr-2"><i class="fa fa-sort"
                        aria-hidden="true"></i></span>Shipping Address</a>
        </li>
        <li class="{{ $cartNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
            <a href="{{ url('/cart') }}"><span class="mr-2"><i class="fa fa-shopping-bag"
                        aria-hidden="true"></i></span>My Cart</a>
        </li>
        <li class="{{ $wishlistNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
            <a href="{{ url('/wishlist') }}"><span class="mr-2"><i class="fa fa-shopping-bag"
                        aria-hidden="true"></i></span>Wishlist</a>
        </li>
        <li class="{{ $passwordNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
            <a href="{{ url('/change-password') }}"><span class="mr-2"><i class="fa fa-lock"
                        aria-hidden="true"></i></span>Change Password</a>
        </li>
        <li class="mb-md-3 mb-2 p-2">
            <a href="javascript:void(0)" class="log_out"><span class="mr-2"><i class="fa fa-sign-out"
                        aria-hidden="true"></i></span>Logout</a>
        </li>
    </ul>
</div>


<div class="dashboard-list py-lg-5 px-lg-3 d-lg-block without-auth-login">
    <ul class="sidebar">
        <li class="mb-md-3 mb-2 p-2">
            <a href="{{ url('/cart') }}"><span class="mr-2"><i class="fa fa-shopping-bag"
                        aria-hidden="true"></i></span>My Cart</a>
        </li>
    </ul>
</div>

@section('script')
    <script>
        $(document).ajaxStop(function() {
            $("#profile_img").attr('src', localStorage.customerImage);
            $(".user_name_in_profile").html(localStorage.customerFname + ' ' + localStorage.customerLname);
        });


        function changeProfile() {
            $("#prf-pic").click();
        }

        $("#prf-pic").change(function() {
            if ($(this).val() != "") {
                upload(this);
                console.log($(this).val());
            }
        });

        function upload(img) {
            var form_data = new FormData();
            form_data.append("file", img.files[0]);
            form_data.append("_token", "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('updateCustomerProfile') }}",
                headers: {
                    'Authorization': 'Bearer ' + customerToken,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                data: form_data,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(data) {
                    // return true;
                    // $("body").removeClass("loading");
                    if (data.errors) {
                        toastr.error(data.errors.file[0]);
                    } else {
                        localStorage.setItem('customerImage', '{{ asset('gallary/') }}/' + data.profile_image);
                        $('#profile_img').attr('src', '{{ asset('gallary/') }}/' + data.profile_image);
                        toastr.success(data.msg);
                    }

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                },
            });
        }
    </script>
@endsection
