<template id="product-card-template">
    <div class="div-class">
        <div class="product product9">
            <article>
                <div class="thumb">
                    {{-- <div class="badges">
                        <span class="badge badge-success">featured</span>
                        <span class="badge badge-info">New</span>
                        <span class="badge badge-danger">50%</span>
                    </div> --}}
                    <div class="product-action-vertical">

                        <a  class="btn icon active swipe-to-top product-card-link" data-toggle="tooltip"
                            data-placement="bottom" title="" data-original-title="Add to Cart">
                            <i class="fas fa-shopping-bag"></i>
                        </a>
                        <a href="javascript:void(0)" class="wishlist-icon btn-secondary listing-none icon swipe-to-top"
                            data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Wishlist">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>

                    <img class="img-fluid product-card-image" src="" alt="Modern Single Sofa">
                    <div class="product-action">
                        <div class="btn btn-block btn-secondary icon swipe-to-top quick-view-icon" data-toggle="modal"
                            data-target="#quickViewModal" data-tooltip="tooltip" data-placement="bottom" title=""
                            data-original-title="Quick View">
                            Quick View </div>
                    </div>
                </div>

                <div class="content">
                    <span class="tag product-card-category">
                    </span>
                    <h5 class="title"><a href="javascript:void(0)" class="product-card-name">Denim jacket reverse</a></h5>
                    <p class="para product-card-desc"></p>
                    <div class="pricetag">
                        <div class="price product-card-price">
                        </div>
                        <a href="javascript:void(0)" class="wishlist-icon btn-secondary icon swipe-to-top" data-toggle="tooltip"
                            data-placement="bottom" title="" data-original-title="Wishlist">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                <span class="d-none compare-icon"></span>

                </div>
            </article>
            <div class="d-none display-rating" ></div>
        <div class="d-none display-rating1" ></div>
        </div>
    </div>
</template>
