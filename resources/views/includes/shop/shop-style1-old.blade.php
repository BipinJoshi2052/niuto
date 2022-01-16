<?php
$categories = App\Models\Admin\Category::inRandomOrder()
    ->with('detail')
    ->take(8)
    ->get();
?>

{{-- {{ dd($categories) }} --}}
<!-- Breadcrumbs -->
<section id="breadcrumbs" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="m-0 p-0 d-flex align-items-center text-white">
                    <li class="font-weight-bold">Home</li><span class="mx-2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <li class="">Shop</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">Shop</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumbs Ends -->
<!-- Product Listing  -->
<section id="product-listing-page" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-12">
                <div class="left-side-wrapper px-4 py-4 d-lg-block d-none">
                    <div class="card-wrapper mb-2">
                        <div class="card-group-item">
                            <div class="card-head">
                                <h6 class=" title font-weight-bold">By Categories </h6>
                            </div>
                            <div class="filter-content">
                                <div class="card-body">
                                    @foreach ($categories as $category)
                                        <label class="">
                                            <a class="text-muted" href="shop?category={{ $category->id }}" style="text-decoration: none;">
                                                <span class="form-check-label">
                                                    {{ $category->detail[0]->category_name }}
                                                </span>
                                            </a>
                                        </label>
                                    @endforeach
                                </div>
                                <!-- card-body.// -->
                            </div>
                        </div>
                        <!-- card-group-item.// -->
                    </div>
                    <!-- card.// -->
                    
                    <!-- card.// -->
                    <div class="card-wrapper mb-2">
                        <div class="card-group-item">
                            <div class="card-head">
                                <h6 class="title font-weight-bold">By Price Range </h6>
                            </div>
                            <div class="filter-content">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Min</label>
                                            <input type="number" class="form-control" id="minRs" autocomplete="off">
                                        </div>
                                        <div class="form-group col-md-6 text-right">
                                            <label>Max</label>
                                            <input type="number" class="form-control" id="maxRs" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <!-- card-body.// -->
                            </div>
                        </div>
                    </div>
                    <!-- card.// -->
                </div>
                <!-- Mobile Filter  -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary d-xl-none d-md-block " data-toggle="modal" data-target="#leftsidebarfilter">
                    Product Filter
                    <span class="ml-2"> 
                        <i class="fa fa-list" aria-hidden="true"></i>
                    </span>
                </button>
                <!-- Mobile Filter Ends -->
            </div>
            @include(isset(getSetting()['card_style']) ? 'includes.cart.product_card_'.getSetting()['card_style'] : "includes.cart.product_card_style1")
        </div>
    </div>
</section>
<!-- Product Listing Ends -->
