<template id="product-card-template">
    <div class="div-class">
        <div class="product product12">
            <article>
                <div class="thumb">
                    {{-- <div class="badges">
                        <span class="badge badge-success">featured</span>
                        <span class="badge badge-info">New</span>
                        <span class="badge badge-danger">50%</span>
                    </div> --}}

                    <img class="img-fluid product-card-image" src="" alt="Modern Single Sofa">
                </div>
                <span class="d-none wishlist-icon"></span>
                <span class="d-none compare-icon"></span>
                <span class="d-none quick-view-icon"></span>

                
                
                <div class="content">
                    <span class="tag product-card-category">
                    </span>
                    <h5 class="title"><a href="" class="product-card-name"></a></h5>
                    <p class="para product-card-desc"></p>
                    <div class="price product-card-price">
                    </div>
                    <div class="pro-counter">
                        <div class="input-group item-quantity">

                            <input type="text" id="quantity21" name="quantity" class="form-control" value="10">

                            <span class="input-group-btn">
                                <button type="button" value="quantity21" class="quantity-plus21 btn" data-type="plus"
                                    data-field="">
                                    <i class="fas fa-plus"></i>
                                </button>

                                <button type="button" value="quantity21" class="quantity-minus21 btn" data-type="minus"
                                    data-field="">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </span>
                        </div>
                        <a class="btn-secondary btn icon swipe-to-top  product-card-link">
                            <i class="fas fa-shopping-bag"></i>
                        </a>

                    </div>

                </div>

            </article>
            <div class="d-none display-rating" ></div>
        <div class="d-none display-rating1" ></div>
        </div>
    </div>
</template>
