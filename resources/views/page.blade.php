@extends('layouts.master')
@section('content')
<!-- Breadcrumbs -->
<section id="breadcrumbs" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="m-0 p-0 d-flex align-items-center text-white">
                    <li class="font-weight-bold">Home</li><span class="mx-2"><i class="fa fa-angle-right"
                            aria-hidden="true"></i></span>
                    <li class="">{{ $page->page_detail[0]->title }}</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">{{ $page->page_detail[0]->title }}</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumbs Ends -->
<!-- ABOUT Us -->
<section id="about-us-wrapper" class="py-4">
    <div class="container">
        {{-- <div class="row">
            <div class="col-12 text-center">
                <div class="about-banner-img mb-3 position-relative">
                    <img src="frontend/assets/images/product-images/1 (2).jpg" class="img-fluid">
                </div>
            </div>
        </div> --}}
        <div class="about-us-list">
            <div class="row">
                <div class=" col-xl-12 col-lg-12 col-md-12 order-xl-1 order-lg-1 order-md-1 order-2 mb-2">
                    <div class="about-us-image-discription d-flex h-100 justify-content-center align-items-center flex-column py-3">
                        {!! $page->page_detail[0]->description !!}
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- About Us Ends -->
@endsection
@section('script')
@endsection
