<!-- Product Detail  -->
<section id="product-detail-wrapper" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                <div class="product-carousel">
                    <!-- Swiper and EasyZoom plugins start -->
                    <div class="swiper-container gallery-top" style="height: 400px">
                        <div class="swiper-wrapper" id="top-gallery">
                            {{-- <div class="swiper-slide easyzoom easyzoom--overlay">
                                <a href="frontend/assets/images/product-images/1 (1).jpg">
                                    <img src="frontend/assets/images/product-images/1 (1).jpg" alt="" />
                                </a>
                            </div> --}}
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper" id="thumb-gallery">
                            {{-- <div class="swiper-slide">
                                <img src="frontend/assets/images/product-images/1 (1).jpg" alt="" />
                            </div> --}}
                        </div>
                    </div>
                    <!-- Swiper and EasyZoom plugins end -->
                </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6 col-12">
                <div class="d-flex justify-content-center h-100 product-detail flex-column">
                    <div class="about mb-3">
                        <div class="d-flex flex-row align-items-center mb-2">
                            <h1 class="font-weight-bold m-0" id="pro-title">
                                {{-- AUDIRECT BEAM3 PRO --}}
                            </h1>
                        </div>
                        <div class="rating-wrapper mb-2">
                            <div class="p-ratings display-rating">
                                <i class="fa fa-star orange"></i>
                                <i class="fa fa-star orange"></i>
                                <i class="fa fa-star b1b1b1"></i>
                                <i class="fa fa-star b1b1b1"></i>
                                <i class="fa fa-star b1b1b1"></i>
                            </div>
                        </div>
                        <div class="product-price d-flex ">
                            <div class="first-price mr-2" id="cut-product-card-price"></div>
                            <div class="second-price" id="product-card-price"></div>
                        </div>
                    </div>
                    <form class="product-types">
                        <div class="form-row">
                            {{-- <div class="form-group col-md-4">
                                <label>Size</label>
                                <select id="size" class="form-control">
                                    <option selected>Choose...</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div> --}}
                            <div class="form-group col-md-4">
                                <div class="quantity mb-3">
                                    <label>Quantity</label>
                                    <div>
                                        <input type="number" value="1" min="1" id="quantity-input" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="color-wrapper">
                        <h5>Color</h5>
                        <div class="my-color mb-3">
                            <label class="radio m-0">
                                <input type="radio" name="gender" value="MALE" checked="" />
                                <span class="red"></span>
                            </label>
                            <label class="radio m-0">
                                <input type="radio" name="gender" value="FEMALE" />
                                <span class="blue"></span>
                            </label>
                            <label class="radio m-0">
                                <input type="radio" name="gender" value="FEMALE" />
                                <span class="green"></span>
                            </label>
                            <label class="radio m-0">
                                <input type="radio" name="gender" value="FEMALE" />
                                <span class="orange"></span>
                            </label>
                        </div>
                    </div> --}}
                    <div class="mt-2">
                        <h5>Description</h5>
                        <p class="pro-desc">
                            {{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est
                            tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo
                            gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id
                            nulla. --}}
                        </p>
                        <button type="button" id="add-to-cart">
                            Add to Cart
                        </button>
                        <button type="button" id="add-to-wishlist">
                            Add to WishList
                        </button>
                        <button type="button" id="buyNow">
                            Buy Now
                        </button>
                        <div id="share"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        {{-- <a class="nav-item nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                            aria-controls="first" aria-selected="true">About This Product</a> --}}
                        <a class="nav-item nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                            aria-controls="second" aria-selected="false">Reviews (<span class="review-count">0</span>) </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    {{-- <div class="tab-pane fade show active p-3 w-75" id="first" role="tabpanel"
                        aria-labelledby="first-tab">
                        <p class="pro-desc">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi,
                            non praesentium corrupti illum, repudiandae adipisci, fuga nesciunt deserunt ipsam inventore ad
                            fugit beatae necessitatibus maiores mollitia rem officiis tenetur!
                            Corrupti.
                        </p>
                        <div class="table-responsive mt-4">
                            <table class="table">
                                <h4>Yoga Matt</h4>
                                <tbody>
                                    <tr>
                                        <th>Model</th>
                                        <td>Mx 12345</td>
                                    </tr>
                                    <tr>
                                        <th>Color</th>
                                        <td>Purple</td>
                                    </tr>
                                    <tr>
                                        <th>Material</th>
                                        <td>Woolen</td>
                                    </tr>
                                    <tr>
                                        <th>Length</th>
                                        <td>9ft</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <div class="tab-pane fade p-3" id="second" role="tabpanel" aria-labelledby="second-tab">
                        <span id="review-rating-show">
                            <!-- User Comments -->
                            {{-- <div class="col-xl-8 col-lg-8 col-12 comments-content p-4 my-3 bg-light">
                                <h5 class="mb-2">By Joe John</h5>
                                <div class="p-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                        class="fa fa-star"></i> </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                                <small class="review-date">March 26, 2017</small>
                            </div> --}}
                            <!-- User Comments Ends -->
                        </span>
                        <div class="col-xl-8 col-lg-8 col-12 blog-comment bg-light px-xl-5 px-2 py-4">
                            <div class="col-12 mb-4 text-center">
                                <h2 class="font-weight-bold mb-xl-4 mb-md-3 mb-2">Add a comment</h2>
                            </div>
                            <div class="col-xl-12">
                                <form>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-center mb-2">
                                                <select class="form-control" id="prodRating" required>
                                                    <option value=''>Select</option>
                                                    <option value='1'>1</option>
                                                    <option value='2'>2</option>
                                                    <option value='3'>3</option>
                                                    <option value='4'>4</option>
                                                    <option value='5'>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 my-md-5 my-4">
                                            <div class="col-text-area d-flex justify-content-center">
                                                <textarea class="w-100 p-3 border-0 rounded-0" placeholder="Add Comment" id="prodComment"></textarea>
                                            </div>
                                        </div>
                                        <div class="button-wrapper mx-auto mb-3">
                                            <button type="submit" class="btn-cus px-5" id="reviewSend">Send</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Detail Ends -->
