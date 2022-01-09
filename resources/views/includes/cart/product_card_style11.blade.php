<template id="product-card-template">
    <div class="div-class">
        <div class="product product9 ratingstar">
            <article>
                <div class="thumb">
                    {{-- <div class="badges">
                        <span class="badge badge-success">featured</span>
                        <span class="badge badge-info">New</span>
                        <span class="badge badge-danger">50%</span>
                    </div> --}}
                    <span class="d-none compare-icon"></span>
                    <img class="img-fluid product-card-image" src="" alt="Modern Single Sofa">
                    <div class="product-action">
                        <a class="btn-secondary btn icon swipe-to-top product-card-link">
                            <i class="fas fa-shopping-bag"></i>
                        </a>
                        <div class="btn  btn-secondary icon swipe-to-top quick-view-icon" data-toggle="modal"
                            data-target="#quickViewModal" data-tooltip="tooltip" data-placement="bottom" title=""
                            data-original-title="Quick View">
                            <i class="fas fa-eye"></i>
                        </div>

                        <a href="javascript:void(0)" class="icon btn btn-secondary active swipe-to-top wishlist-icon"
                            data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Wishlist">
                            <i class="fas fa-heart"></i>
                        </a>
                    </div>
                </div>

                <div class="content">
                    <div class="pricetag">
                        <div class="price price-none product-card-price">
                        </div>
                        

                        <div class="pro-rating d-g-none">
                            <fieldset class="disabled-ratings display-rating">

                            </fieldset>
                        </div>
                    </div>

                    <span class="d-none product-card-category">

                    </span>
                    <h5 class="title"><a href="javascript:void(0)" class="product-card-name">Denim jacket reverse</a></h5>
                    <p class="para product-card-desc"> </p>
                    <div class="pro-rating display-none listing-none">
                        <fieldset class="disabled-ratings display-rating1">
                        </fieldset>
                    </div>
                    <div class="price display-none listing-none product-card-price">
                    </div>



                </div>
            </article>
        </div>
    </div>
</template>
