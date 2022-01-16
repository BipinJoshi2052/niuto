<template id="product-card-template">
  <div class="div-class">
<div class="product product4 ">
  <article>
   <div class="thumb">
     {{-- <div class="badges">
       <span class="badge badge-success">featured</span>
       <span class="badge badge-info">New</span>
       <span class="badge badge-danger">50%</span>                        
     </div> --}}
     <div class="product-action-vertical">
      
       <a href="javascript:void(0)" class="wishlist-icon icon active swipe-to-top" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Wishlist">
         <i class="fas fa-heart"></i>
       </a>
     <div class="icon swipe-to-top quick-view-icon" data-toggle="modal" data-target="#quickViewModal" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Quick View">
       <i class="fas fa-eye"></i></div>
     <a href="javascript:void(0)" class="compare-icon icon swipe-to-top" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Compare"><i class="fas fa-align-right" data-fa-transform="rotate-90"></i></a>
 
     </div>

     <img class="img-fluid product-card-image" src="" alt="Modern Single Sofa">
   </div>
    
   <div class="content">
    <span class="product-card-category d-none"></span>
    <h5 class="title text-center"><a href="javascript:void(0)" class="product-card-name"></a></h5>
     <p class="para product-card-desc"></p>
      <div class="price product-card-price">
      </div>
      {{-- <a class="btn  btn-secondary  swipe-to-top  listing-none product-card-link" href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Detail">View Detail</a> --}}
   </div>                 

   <div class="product-action">
    <a class="btn  btn-secondary  swipe-to-top product-card-link" href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="View Detail">View Detail</a>
   </div><!-- End .product-action -->
  </article>
  <div class="d-none display-rating" ></div>
        <div class="d-none display-rating1" ></div>
</div>
  </div>
</template>