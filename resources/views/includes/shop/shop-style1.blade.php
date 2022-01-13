<?php
$categories = App\Models\Admin\Category::where('parent_id', null)
    ->with('detail')
    ->with('subcategory')
    ->take(9)
    ->get();
$requestCategory = request()->category;
if($requestCategory != null || $requestCategory != ''){
    $breadCrumbCat = App\Models\Admin\Category::where("id", $requestCategory)->with('detail')->first();
    if(!empty($breadCrumbCat->parent)){
        $maincategory = $breadCrumbCat->parent->with('detail')->first();
    } else {
        $maincategory = '';
    }
} else {
    $breadCrumbCat = '';
}
?>

<section id="breadcrumb_item" class="pb-0 breadcrumb mb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item font-weight-bold">
                            <a href="{{ url('/') }}"><span><i class="fa fa-home" aria-hidden="true"></i></span>
                                HOME</a>
                        </li>
                        @if($maincategory = '')
                            <li class="breadcrumb-item font-weight-bold" aria-current="page">
                                <a href="/shop?category={{ $maincategory->id }}"  class="text-dark">{{ $maincategory->detail[0]->category_name }}</a>
                            </li>
                        @endif
                        @if($breadCrumbCat != '')
                            <li class="breadcrumb-item font-weight-bold" aria-current="page">
                                <a href="javascript:void(0)" class="text-dark">{{ $breadCrumbCat->detail[0]->category_name }}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item font-weight-bold" aria-current="page">
                                <a href="javascript:void(0)" class="text-dark">PRODUCTS</a>
                            </li>
                        @endif
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
        <button type="button" class="button_list d-xl-none d-lg-none d-md-block mb-4" data-toggle="modal"
            data-target="#leftsidebarfilter">
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
                                    <span class="pr-3"><i class="fa fa-bars"
                                            aria-hidden="true"></i></span>
                                    Categories
                                </h4>
                            </div>
                            @foreach ($categories as $k => $category)
                                <li class="px-3 product_icon position-relative d-block">
                                    <a href="/shop?category={{ $category->id }}" class="sub_icon">
                                        <span class="pr-2">
                                            <i class="fa fa-hand-o-right text-dark" aria-hidden="true"></i>
                                        </span>
                                        {{ $category->detail[0]->category_name }}
                                    </a>
                                    @if (!$category->subcategory->isEmpty())
                                        <ul class="sub_menu_list">
                                            @foreach ($category->subcategory as $sub => $subcat)
                                                <li>
                                                    <a href="/shop?category={{ $subcat->id }}">
                                                        <span>
                                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                                        </span>
                                                        {{ $subcat->detail[0]->category_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="price_rang_block border_one bg-white category_product mt-4">
                            <div class="category_title">
                                <h4 class="pl-4 font-weight-bold">
                                    <span class="pr-3"></span>
                                    Our Brand 
                                </h4>
                            </div>
                            <div class="our_brand pt-3">
                                <div class="our_brand_item">
                                    <img src="https://montechbd.com/shopist/demo/public/uploads/1616788177-h-80-nike.png"
                                        class="img-fluid" alt="" />
                                </div>
                                <div class="our_brand_item">
                                    <img src="https://montechbd.com/shopist/demo/public/uploads/1616788177-h-80-nike.png"
                                        class="img-fluid" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="price_rang_block border_one bg-white category_product mt-4 pb-3">
                            <div class="category_title">
                                <h4 class="pl-4 font-weight-bold">
                                    <span class="pr-3"></span>
                                    Price Range
                                </h4>
                            </div>
                            <div class="slider price-slider" id="range-slider">
                            </div>
                            <!-- <input type="range" min="1" max="100" value="50" class="slider" id="myRange"> -->
                        </div>
                    </div>
                    @foreach($data["attribute"] as $key => $attribute)
                        @php
                            $attribute_name = $attribute->attribute_detail[0]->name;
                        @endphp
                        @if($attribute_name == 'Color' || $attribute_name == "Size")
                            <input type="hidden" value="{{ $attribute->id }}" name="attribute[]">
                            @if($attribute_name == "Color" && !$attribute->variation->isEmpty())
                                <div class="col-md-12">
                                    <div class="price_rang_block border_one bg-white category_product mt-4">
                                        <div class="category_title">
                                            <h4 class="pl-4 font-weight-bold">
                                                <span class="pr-3"></span>
                                                Select Colors
                                            </h4>
                                        </div>
                                        <div class="colors_block p-3">
                                            @foreach($attribute->variation as $atvkey => $variation)
                                                <label class="color_single">
                                                <small class="round" style="background-color: {{ $variation->variation_detail[0]->name }}"></small>
                                                <span class=""> {{ $variation->variation_detail[0]->name }}</span>
                                                <input type="checkbox" name="variation[]" class="variation-filter" value="{{ $variation->variation_detail[0]->variation_id }}" data-attribute-id="{{ $attribute->id }}" data-attribute-name="{{ $attribute->attribute_detail[0]->name }}">
                                                <span class="checkmark"></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div> 
                            @elseif($attribute_name == "Size" && !$attribute->variation->isEmpty())
                                <div class="col-md-12">
                                    <div class="price_rang_block border_one bg-white category_product mt-4">
                                        <div class="category_title">
                                            <h4 class="pl-4 font-weight-bold">
                                                <span class="pr-3"></span>
                                                Select Sizes
                                            </h4>
                                        </div>
                                        <div class="colors_block p-3">
                                            @foreach($attribute->variation as $atvkey => $variation)
                                                <label class="color_single"> 
                                                    <span class="">{{ $variation->variation_detail[0]->name }}</span>
                                                    <input type="checkbox" name="variation[]" class="variation-filter" value="{{ $variation->variation_detail[0]->variation_id }}" data-attribute-id="{{ $attribute->id }}" data-attribute-name="{{ $attribute->attribute_detail[0]->name }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            @break
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-md-9">
                @include(isset(getSetting()['card_style']) ? 'includes.cart.product_card_'.getSetting()['card_style'] :
                "includes.cart.product_card_style1")
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="leftsidebarfilter" tabindex="-1" role="dialog" aria-labelledby="leftsidebarfilterlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
              <div class="modal-header">
                 <h5 class="modal-title font-weight-bold" id="leftsidebarfilterlabel">Product Filter</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                 <div class="left-side-wrapper px-md-4 px-1 py-md-4 py-2">
                    <div class="row">
                       <div class="col-md-12">
                          <div id="sidebarmodal" class="bg-white border_one category_product">
                             <nav id="column_left">
                                <ul class="nav nav-list">
                                   <li class="main-list p-0">
                                      <a class="accordion-heading" data-toggle="collapse" data-target="#submenu1" aria-expanded="true">
                                         <span class="nav-header-primary nav-link dropdown-toggle d-block p-0 category_title">
                                         <h4 class=" font-weight-bold text-center">Categories </h4>
                                      </a>
                                      <ul class="px-3 collapse show" id="submenu1" style="">
                                        @foreach ($categories as $k => $category)
                                         <li class="mobile_plush">
                                            <a href="/shop?category={{ $category->id }}" class="accordion-heading dropdown-toggle collapsed" data-toggle="collapse" data-target="#submenu11" aria-expanded="false">
                                               <h5>{{ $category->detail[0]->category_name }}</h5>
                                               <span class="pull-right "><b class="caret"></b></span>
                                            </a>
                                            @if (!$category->subcategory->isEmpty())
                                            <ul class="pl-0 collapse" id="submenu11" style="">
                                            @foreach ($category->subcategory as $sub => $subcat)
                                               <li>
                                                  <a href="/shop?category={{ $subcat->id }}" title="Title">
                                                     <h6>-{{ $subcat->detail[0]->category_name }} </h6>
                                                  </a>
                                               </li>
                                               @endforeach
                                            </ul>
                                            @endif
                                         </li>
                                         @endforeach
                                      </ul>
                                   </li>
                                </ul>
                             </nav>
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="
                             price_rang_block
                             border_one
                             bg-white
                             category_product
                             mt-4
                             ">
                             <div class="category_title">
                                <h4 class="pl-4 font-weight-bold">
                                   <span class="pr-3"></span>
                                   Our Brand
                                </h4>
                             </div>
                             <div class="our_brand-2 pt-3">
                                <div class="our_brand_two">
                                   <img
                                      src="https://montechbd.com/shopist/demo/public/uploads/1616788177-h-80-nike.png"
                                      class="img-fluid"
                                      alt=""
                                      />
                                </div>
                                <div class="our_brand_two">
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
                          <div class="
                             price_rang_block
                             border_one
                             bg-white
                             category_product
                             mt-4
                             ">
                             <div class="category_title">
                                <h4 class="pl-4 font-weight-bold">
                                   <span class="pr-3"></span>
                                   Price Range
                                </h4>
                             </div>
                            <div class="slider price-slider" id="range-slider">
                          </div>
                       </div>
                       @foreach($data["attribute"] as $key => $attribute)
                       @php
                           $attribute_name = $attribute->attribute_detail[0]->name;
                       @endphp
                       @if($attribute_name == 'Color' || $attribute_name == "Size")
                           <input type="hidden" value="{{ $attribute->id }}" name="attribute[]">
                           @if($attribute_name == "Color" && !$attribute->variation->isEmpty())
                               <div class="col-md-12">
                                   <div class="price_rang_block border_one bg-white category_product mt-4">
                                       <div class="category_title">
                                           <h4 class="pl-4 font-weight-bold">
                                               <span class="pr-3"></span>
                                               Select Colors
                                           </h4>
                                       </div>
                                       <div class="colors_block p-3">
                                           @foreach($attribute->variation as $atvkey => $variation)
                                               <label class="color_single">
                                               <small class="round" style="background-color: {{ $variation->variation_detail[0]->name }}"></small>
                                               <span class=""> {{ $variation->variation_detail[0]->name }}</span>
                                               <input type="checkbox" name="variation[]" class="variation-filter" value="{{ $variation->variation_detail[0]->variation_id }}" data-attribute-id="{{ $attribute->id }}" data-attribute-name="{{ $attribute->attribute_detail[0]->name }}">
                                               <span class="checkmark"></span>
                                               </label>
                                           @endforeach
                                       </div>
                                   </div>
                               </div> 
                               @elseif($attribute_name == "Size" && !$attribute->variation->isEmpty())
                               <div class="col-md-12">
                                   <div class="price_rang_block border_one bg-white category_product mt-4">
                                       <div class="category_title">
                                           <h4 class="pl-4 font-weight-bold">
                                               <span class="pr-3"></span>
                                               Select Sizes
                                           </h4>
                                       </div>
                                       <div class="colors_block p-3">
                                           @foreach($attribute->variation as $atvkey => $variation)
                                               <label class="color_single"> 
                                                   <span class="">{{ $variation->variation_detail[0]->name }}</span>
                                                   <input type="checkbox" name="variation[]" class="variation-filter" value="{{ $variation->variation_detail[0]->variation_id }}" data-attribute-id="{{ $attribute->id }}" data-attribute-name="{{ $attribute->attribute_detail[0]->name }}">
                                                   <span class="checkmark"></span>
                                               </label>
                                           @endforeach
                                       </div>
                                   </div>
                               </div>
                           @endif
                       @else
                           @break
                       @endif
                   @endforeach
                    </div>
                 </div>
              </div>
              <!-- <div class="modal-footer">
                 </div> -->
           </div>
        </div>
     </div>
     <!-- Mobile Filter Pop Up Ends -->

</section>
