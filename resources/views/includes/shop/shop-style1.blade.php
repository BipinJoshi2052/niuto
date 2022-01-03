<?php
$categories = App\Models\Admin\Category::inRandomOrder()
    ->with('detail')
    ->take(9)
    ->get();
?>
{{-- {{ dd($categories) }} --}}
<section id="breadcrumb_item" class="pb-0 breadcrumb mb-0">
    <div class="container">
       <div class="row">
          <div class="col-md-12 m-auto">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item font-weight-bold">
                      <a href="index.html"
                         ><span><i class="fa fa-home" aria-hidden="true"></i></span>
                      HOME</a
                         >
                   </li>
                   <li
                      class="breadcrumb-item font-weight-bold"
                      aria-current="page"
                      >
                      <a href="product.html" class="text-dark">PRODUCTS</a>
                   </li>
                </ol>
             </nav>
          </div>
       </div>
    </div>
 </section>
 <!--========================== PRODUCTS START  --->
 <section id="products" class="section_bg padding">
    <div class="container">
       <!-- Button trigger modal -->
       <button type="button" class="button_list d-xl-none d-lg-none d-md-block mb-4" data-toggle="modal" data-target="#leftsidebarfilter">
       Product Filter
       <span class="ml-2">
       <i class="fa fa-list" aria-hidden="true"></i>
       </span>
       </button>
       <!-- Mobile Filter Ends -->
       <div class="row">
          <div class="col-md-3 d-md-block d-none">
             <div class="row">
                <div class="col-md-12">
                   <ul class="bg-white border_one category_product">
                      <div class="category_title">
                         <h4 class="pl-4 font-weight-bold">
                            <span class="pr-3"
                               ><i class="fa fa-bars" aria-hidden="true"></i
                               ></span>
                            Categories
                         </h4>
                      </div>
                      @foreach($categories as $k => $category)
                      <li class="px-3 product_icon position-relative d-block">
                        <a href="/shop?category={{ $category->id }}" class="sub_icon">
                            <span class="pr-2">
                                 <i class="fa fa-hand-o-right text-dark" aria-hidden="true"></i>
                            </span>
                            {{ $category->detail[0]->category_name }}
                        </a>
                         {{-- <ul class="sub_menu_list">
                            <li>
                               <a href="#">
                               <span
                                  ><i class="fa fa-angle-right" aria-hidden="true"></i
                                  ></span>
                               Men's Third</a
                                  >
                            </li>
                            <li>
                               <a href="#">
                               <span
                                  ><i class="fa fa-angle-right" aria-hidden="true"></i
                                  ></span>
                               Electronic Accessories
                               </a>
                            </li>
                            <li>
                               <a href="#">
                               <span
                                  ><i class="fa fa-angle-right" aria-hidden="true"></i
                                  ></span>
                               Men's Fashion Third</a
                                  >
                            </li>
                            <li>
                               <a href="#">
                               <span
                                  ><i class="fa fa-angle-right" aria-hidden="true"></i
                                  ></span>
                               Men's Third</a
                                  >
                            </li>
                            <li>
                               <a href="#">
                               <span
                                  ><i class="fa fa-angle-right" aria-hidden="true"></i
                                  ></span>
                               Electronic Accessories
                               </a>
                            </li>
                            <li>
                               <a href="#">
                               <span
                                  ><i class="fa fa-angle-right" aria-hidden="true"></i
                                  ></span>
                               Men's Fashion Third</a
                                  >
                            </li>
                         </ul> --}}
                      </li>
                      @endforeach
                   </ul>
                </div>
                <div class="col-md-12">
                   <div
                      class="
                      price_rang_block
                      border_one
                      bg-white
                      category_product
                      mt-4
                      "
                      >
                      <div class="category_title">
                         <h4 class="pl-4 font-weight-bold">
                            <span class="pr-3"></span>
                            Our Brand
                         </h4>
                      </div>
                      <div class="our_brand pt-3">
                         <div class="our_brand_item">
                            <img
                               src="https://montechbd.com/shopist/demo/public/uploads/1616788177-h-80-nike.png"
                               class="img-fluid"
                               alt=""
                               />
                         </div>
                         <div class="our_brand_item">
                            <img
                               src="https://montechbd.com/shopist/demo/public/uploads/1616788177-h-80-nike.png"
                               class="img-fluid"
                               alt=""
                               />
                         </div>
                      </div>
                   </div>
                </div>
                <div class="col-md-12">
                   <div
                      class="
                      price_rang_block
                      border_one
                      bg-white
                      category_product
                      mt-4 pb-3
                      "
                      >
                      <div class="category_title">
                         <h4 class="pl-4 font-weight-bold">
                            <span class="pr-3"></span>
                            Price Range
                         </h4>
                      </div>
                      <div class="slider" id="range-slider">
                      </div>
                      <!-- <input type="range" min="1" max="100" value="50" class="slider" id="myRange"> -->
                   </div>
                </div>
                <div class="col-md-12">
                   <div
                      class="
                      price_rang_block
                      border_one
                      bg-white
                      category_product
                      mt-4"
                      >
                      <div class="category_title">
                         <h4 class="pl-4 font-weight-bold">
                            <span class="pr-3"></span>
                            Select Colors
                         </h4>
                      </div>
                      <div class="colors_block p-3">
                         <label class="color_single"
                            ><small class="round"></small>
                         <span class=""> Red</span>
                         <input type="checkbox" checked="checked" />
                         <span class="checkmark"></span>
                         </label>
                         <label class="color_single">
                         <small class="round bg-warning"></small>
                         <span> Yellow</span>
                         <input type="checkbox" />
                         <span class="checkmark"></span>
                         </label>
                         <label class="color_single">
                         <small class="round bg-primary"></small>
                         <span>Blue</span>
                         <input type="checkbox" />
                         <span class="checkmark"></span>
                         </label>
                         <label class="color_single">
                         <small class="round bg-success"></small>
                         <span> Green</span>
                         <input type="checkbox" />
                         <span class="checkmark"></span>
                         </label>
                      </div>
                   </div>
                </div>
                <div class="col-md-12">
                   <div
                      class="
                      price_rang_block
                      border_one
                      bg-white
                      category_product
                      mt-4
                      "
                      >
                      <div class="category_title">
                         <h4 class="pl-4 font-weight-bold">
                            <span class="pr-3"></span>
                            Select Sizes
                         </h4>
                      </div>
                      <div class="colors_block p-3">
                         <label class="color_single"
                         <span class=""> Small</span>
                         <input type="checkbox" checked="checked" />
                         <span class="checkmark"></span>
                         </label>
                         <label class="color_single">
                         <span> Medium</span>
                         <input type="checkbox" />
                         <span class="checkmark"></span>
                         </label>
                         <label class="color_single">
                         <span>Large</span>
                         <input type="checkbox" />
                         <span class="checkmark"></span>
                         </label>
                         <label class="color_single">
                         <span> XL</span>
                         <input type="checkbox" />
                         <span class="checkmark"></span>
                         </label>
                         <label class="color_single">
                         <span> XXL</span>
                         <input type="checkbox" />
                         <span class="checkmark"></span>
                         </label>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-9">
            @include(isset(getSetting()['card_style']) ? 'includes.cart.product_card_'.getSetting()['card_style'] : "includes.cart.product_card_style1")
          </div>
       </div>
    </div>
 </section>
