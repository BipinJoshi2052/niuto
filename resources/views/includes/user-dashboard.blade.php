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
      <img
        src="https://img.freepik.com/free-photo/pleasant-looking-serious-man-stands-profile-has-confident-expression-wears-casual-white-t-shirt_273609-16959.jpg?size=626&ext=jpg"
        class="img-fluid avater"
        alt="profile-image"
      />
      <h5>Muniraj</h5>
      <a href="" class="text_yellow">
        <span class="mr-1"
          ><i class="fa fa-pencil" aria-hidden="true"></i
        ></span>
        Upload Image</a
      >
    </div>
    <ul class="sidebar">
      <li class="{{ $profileNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
        <a href="{{ url('/profile') }}"
          ><span class="mr-2"
            ><i class="fa fa-user" aria-hidden="true"></i></span
          >Profile</a
        >
      </li>
      <li class="{{ $orderNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
        <a href="{{ url('/orders') }}"
          ><span class="mr-2"
            ><i class="fa fa-sort" aria-hidden="true"></i></span
          >Order Status</a
        >
      </li>
      <li class="{{ $shippingNav ? $active: $unactive }} mb-md-3 mb-2 p-2">
        <a href="{{ url('/shipping-address') }}"
          ><span class="mr-2"
            ><i class="fa fa-sort" aria-hidden="true"></i></span
          >Shipping Address</a
        >
      </li>
      <li class="{{ $cartNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
        <a href="{{ url('/cart') }}"
          ><span class="mr-2"
            ><i
              class="fa fa-shopping-bag"
              aria-hidden="true"
            ></i></span
          >My Cart</a
        >
      </li>
      <li class="{{ $wishlistNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
        <a href="{{ url('/wishlist') }}"
          ><span class="mr-2"
            ><i
              class="fa fa-shopping-bag"
              aria-hidden="true"
            ></i></span
          >Wishlist</a
        >
      </li>
      <li class="{{ $passwordNav ? $active : $unactive }} mb-md-3 mb-2 p-2">
        <a href="{{ url('/change-password') }}"
          ><span class="mr-2"
            ><i class="fa fa-lock" aria-hidden="true"></i></span
          >Change Password</a
        >
      </li>
      <li class="mb-md-3 mb-2 p-2">
        <a href="javascript:void(0)" class="log_out"
          ><span class="mr-2"
            ><i class="fa fa-sign-out" aria-hidden="true"></i></span
          >Logout</a
        >
      </li>
    </ul>
  </div>


  <div class="dashboard-list py-lg-5 px-lg-3 d-lg-block without-auth-login">
    <ul class="sidebar">
      <li class="mb-md-3 mb-2 p-2">
        <a href="{{ url('/cart') }}"
          ><span class="mr-2"
            ><i
              class="fa fa-shopping-bag"
              aria-hidden="true"
            ></i></span
          >My Cart</a
        >
      </li>
    </ul>
  </div>