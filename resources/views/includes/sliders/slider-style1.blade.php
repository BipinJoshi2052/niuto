<!--========================== SLIDER START  -->
<?php
$categories = App\Models\Admin\Category::where('parent_id', null)
    ->with('detail')
    ->with('subcategory')
    ->take(9)
    ->get();
?>
<section id="slider">
    <div class="container p-0">
        <div class="row no-gutters">
            <div class="col-lg-3 col-12">
                <ul class="bg-white border_one d-lg-block d-none">
                    @foreach($categories as $k => $category)
                    <li class="px-3 product_icon position-relative d-block">
                      <a href="/shop?category={{ $category->id }}" class="sub_icon">
                          <span class="pr-2">
                            
                               <img src="{{ asset( '/gallary/' ).'/'.$category->icon->name }}" alt="{{ $category->icon->name }}" height="25px" width="25px">
                          </span>
                          {{ $category->detail[0]->category_name }}
                      </a>
                      @if(!$category->subcategory->isEmpty())
                          <ul class="sub_menu_list">
                             @foreach($category->subcategory as $sub => $subcat)
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
            
            <div class="col-lg-9 col-12">
                @include('includes.loader')
                <div class="your-class" id="slider-section">
                    {{-- <div class="slider_item position-relative">
                        <img src="https://cyberstore.qodeinteractive.com/wp-content/uploads/2017/08/h5-slide-background-img-3.jpg"
                            class="d-block w-100 img-fluid" alt="image..." />
                    </div> --}}
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--========================== SLIDER END  -->
