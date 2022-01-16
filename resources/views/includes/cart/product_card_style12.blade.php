<template id="product-card-template">
  <div class="div-class">
    <div class="product product12 ratingstar ">
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

      <div class="pro-rating rating-none">
        <fieldset class="disabled-ratings display-rating">
        </fieldset>
        </div>
      <h5 class="title"><a href="javascript:void(0)" class="product-card-name"></a></h5>
      <p class="para product-card-desc"></p>
      <div class="pro-rating rating-grid-none listing-none">
        <fieldset class="disabled-ratings display-rating1">
        </fieldset>
        </div>
      
      <div class="price product-card-price">            
      </div>  
   
      <a class="btn-secondary btn icon swipe-to-top product-card-link" onclick="notificationCart();">
          <i class="fas fa-shopping-bag"></i> Add to Cart
          </a> 
    </div>                 
 
  </article>
</div>
</div>
</template>