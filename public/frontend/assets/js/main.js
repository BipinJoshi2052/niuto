$(document).ajaxStop(function() {
  loaderOnLoad();
});
$(document).ready(function () {
  if ($("body").hasClass(".js-range-slider")) {
    console.log('asdfasdf');
    $(".js-range-slider").ionRangeSlider({
      skin: "round",
      step: 1,
      type: "double",
      grid: false,
      min: 0,
      max: 1000,
      from: 200,
      to: 800,
      prefix: "$",
    });
  }
});
$(".our_brand").slick({
  dots: false,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 3000,
  slidesToShow: 1,
  slidesToScroll: 1,
});
window.addEventListener("scroll", function () {
  var header = document.querySelector(".header");
  header.classList.toggle("sticky-bar", window.scrollY > 50);
});
$(document).ready(function () {
  $(".your-class").slick({
    dots: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 1,
    slidesToScroll: 1,
  });
});

// product slider
// $(document).ready(function () {

// });
// Product List Slick Slider
$(".slick_slider").slick({
  dots: false,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 3000,
  slidesToShow: 5,
  slidesToScroll: 1,

  responsive: [
    {
      breakpoint: 1399,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 1080,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 780,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
  ],
});
// CATEGORY START
$(".category_list").slick({
  dots: false,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 3000,
  slidesToShow: 5,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1399,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 1080,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 780,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
  ],
});
//FEATURES
$(".feature_slider").slick({
  dots: false,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 3000,
  slidesToShow: 5,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1399,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 1080,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 780,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
      },
    },
  ],
});
$(".slick_testimonial").slick({
  dots: false,
  arrows: true,
  autoplay: true,
  autoplaySpeed: 3000,
  slidesToShow: 1,
  slidesToScroll: 1,
});

//Price Range

// search js start
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}

// product detail start

  (function ($) {
    // if ($(".picZoomer-pic").length > 0) {
      $.fn.picZoomer = function (options) {
        var opts = $.extend({}, $.fn.picZoomer.defaults, options),
          $this = this,
          $picBD = $('<div class="picZoomer-pic-wp"></div>')
            .css({ width: opts.picWidth + "px", height: opts.picHeight + "px" })
            .appendTo($this),
          $pic = $this.children("img").addClass("picZoomer-pic").appendTo($picBD),
          $cursor = $(
            '<div class="picZoomer-cursor"><i class="f-is picZoomCursor-ico"></i></div>'
          ).appendTo($picBD),
          cursorSizeHalf = { w: $cursor.width() / 2, h: $cursor.height() / 2 },
          $zoomWP = $(
            '<div class="picZoomer-zoom-wp"><img src="" alt="" class="picZoomer-zoom-pic"></div>'
          ).appendTo($this),
          $zoomPic = $zoomWP.find(".picZoomer-zoom-pic"),
          picBDOffset = { x: $picBD.offset().left, y: $picBD.offset().top };
    
        opts.zoomWidth = opts.zoomWidth || opts.picWidth;
        opts.zoomHeight = opts.zoomHeight || opts.picHeight;
        var zoomWPSizeHalf = { w: opts.zoomWidth / 2, h: opts.zoomHeight / 2 };
    
        $zoomWP.css({
          width: opts.zoomWidth + "px",
          height: opts.zoomHeight + "px",
        });
        $zoomWP.css(
          opts.zoomerPosition || { top: 0, left: opts.picWidth + 30 + "px" }
        );
    
        $zoomPic.css({
          width: opts.picWidth * opts.scale + "px",
          height: opts.picHeight * opts.scale + "px",
        });
    
        $picBD
          .on("mouseenter", function (event) {
            $cursor.show();
            $zoomWP.show();
            $zoomPic.attr("src", $pic.attr("src"));
          })
          .on("mouseleave", function (event) {
            $cursor.hide();
            $zoomWP.hide();
          })
          .on("mousemove", function (event) {
            var x = event.pageX - picBDOffset.x,
              y = event.pageY - picBDOffset.y;
    
            $cursor.css({
              left: x - cursorSizeHalf.w + "px",
              top: y - cursorSizeHalf.h + "px",
            });
            $zoomPic.css({
              left: -(x * opts.scale - zoomWPSizeHalf.w) + "px",
              top: -(y * opts.scale - zoomWPSizeHalf.h) + "px",
            });
          });
        return $this;
      };
      $.fn.picZoomer.defaults = {
        picHeight: 460,
        scale: 2.5,
        zoomerPosition: { top: "0", left: "380px" },
    
        zoomWidth: 400,
        zoomHeight: 460,
      };
    // }
  })(jQuery);


$(document).ready(function () {
  if ($(".picZoomer").length > 0) {
    $(".picZoomer").picZoomer();
    $(".piclist li").on("click", function (event) {
      alert('Hey');
      var $pic = $(this).find("img");
      $(".picZoomer-pic").attr("src", $pic.attr("src"));
    });
  }
  if ($("#recent_post").length > 0) {
    var owl = $("#recent_post");
    owl.owlCarousel({
      margin: 20,
      dots: false,
      nav: true,
      navText: [
        "<i class='fa fa-chevron-left'></i>",
        "<i class='fa fa-chevron-right'></i>",
      ],
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 2,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 5,
        },
        1200: {
          items: 4,
        },
      },
    });
  }

  // $(".decrease_").click(function () {
  //   decreaseValue(this);
  // });
  // $(".increase_").click(function () {
  //   increaseValue(this);
  // });
  // function increaseValue(_this) {
  //   var value = parseInt($(_this).siblings("input#number").val(), 10);
  //   value = isNaN(value) ? 0 : value;
  //   value++;
  //   $(_this).siblings("input#number").val(value);
  // }

  // function decreaseValue(_this) {
  //   var value = parseInt($(_this).siblings("input#number").val(), 10);
  //   value = isNaN(value) ? 0 : value;
  //   value < 1 ? (value = 1) : "";
  //   value--;
  //   $(_this).siblings("input#number").val(value);
  // }
});
// Product Detail color choose Js
$(document).ready(function () {
  $(".imagesize").click(function () {
    if ($(".imagesize-active").length) {
      $(".imagesize-active")
        .not($(this))
        .removeClass("imagesize-active")
        .addClass("image-size");
    }
    $(this).removeClass("image-size").addClass("imagesize-active");
  });
});
// Product Detail Size choose Js
$(document).ready(function () {
  $(".size").click(function () {
    if ($(".size-active").length) {
      $(".size-active")
        .not($(this))
        .removeClass("size-active")
        .addClass("size");
    }
    $(this).removeClass("size").addClass("size-active");
  });
});

// PRODUCT DETAIL TAB START
$(function () {
  var $tabButtonItem = $("#tab-button li"),
    $tabSelect = $("#tab-select"),
    $tabContents = $(".tab-contents"),
    activeClass = "is-active";

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(":first").hide();

  $tabButtonItem.find("a").on("click", function (e) {
    var target = $(this).attr("href");

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on("change", function () {
    var target = $(this).val(),
      targetSelectNum = $(this).prop("selectedIndex");

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });
});
// PRODUCT DETAIL FORM
$(document).ready(function () {
  $(".input").focus(function () {
    $(this).parent().find(".label-txt").addClass("label-active");
  });

  $(".input").focusout(function () {
    if ($(this).val() == "") {
      $(this).parent().find(".label-txt").removeClass("label-active");
    }
  });
});
// input cart

$(document).ready(function () {
  $(".count").prop("disabled", true);
  // $(document).on("click", ".plus", function () {
  //   $(".count").val(parseInt($(".count").val()) + 1);
  // });
  // $(document).on("click", ".minus", function () {
  //   $(".count").val(parseInt($(".count").val()) - 1);
  //   if ($(".count").val() == 0) {
  //     $(".count").val(1);
  //   }
  // });
});

function toggleIcon(e) {
  $(e.target)
    .prev(".panel-heading")
    .find(".more-less")
    .toggleClass("glyphicon-plus glyphicon-minus");
}
$(".panel-group").on("hidden.bs.collapse", toggleIcon);
$(".panel-group").on("shown.bs.collapse", toggleIcon);

// Bootstrap Range Slider Js

// Brand Slick Slider On Modal Popup End

// Bootstrap Range Slider Js Ends



function decreaseCartInput(thes){
  var $_input_value = $(thes).val();
  $(thes).val($_input_value - 1);
  if($_input_value == 1){
    $(thes).val(1);
  }
}

function increaseCartInput(cart_input){
  var $_input_value = $(cart_input).val();
  $(cart_input).val(parseInt($_input_value) + 1);
}