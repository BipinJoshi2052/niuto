// Banner Slick Slider Starts
function slickInit(){
    $('.slick-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
    
        responsive: [{
                breakpoint: 1400,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1080,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 780,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
    
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
    
    
        ]
    
    }); 
}
// Banner Slick Slider Ends
// Product List Slick Slider 
function productListInit(){
    $('.slick-slider-product').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [{
                breakpoint: 1400,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1080,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 780,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
    
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
    
    
        ]
    });
}
// Product List Slick Slider Ends
// Category Slick Slider 
function categorySlickInit(){
    $('.slick-slider-category').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [{
                breakpoint: 1440,
                settings: {
                    slidesToShow: 8,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1080,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 780,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
    
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
    
    
        ]
    });
}
// Category Slick Slider Ends

function productDetailInit(){
    // Product Page carousel Start
    // product Gallery and Zoom

    // activation carousel plugin
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 5,
        freeMode: true,

        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        breakpoints: {
            0: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 4,
            },
        }
    });
    var galleryTop = new Swiper('.gallery-top', {
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: galleryThumbs
        },
    });
    // change carousel item height
    // gallery-top
    let productCarouselTopWidth = $('.gallery-top').outerWidth();
    $('.gallery-top').css('height', productCarouselTopWidth);

    // gallery-thumbs
    let productCarouselThumbsItemWith = $('.gallery-thumbs .swiper-slide').outerWidth();
    $('.gallery-thumbs').css('height', productCarouselThumbsItemWith);

    // activation zoom plugin
    var $easyzoom = $('.easyzoom').easyZoom();
}

// loader 
// $(document).ready(function(){
// 	$('div#loading').removeAttr('id');
// });
var preloader = document.getElementById("loading");
// window.addEventListener('load', function(){
// 	preloader.style.display = 'none';
// 	})

function myFunction() {
    preloader.style.display = 'none';
};

// Navbar Height Show Animation 
// $(document).ready(function() {
//     $(window).resize(function() {
//         var width = $(window).width();
//         if (width < 769) {
//             $(".dropdown-custom").click(function() {
//                 var itemOpen = $(this).data('open');
//                 // // console.log(itemOpen);
//                 $('"' + itemOpen + '"').slideToggle("slow")
//             });
//         }
//     });

// });
// Navbar Height Show Animation Ends