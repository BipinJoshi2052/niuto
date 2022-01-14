$(document).ready(function() {

  $('.search_icon_new').click(function() {
    $('.sub_search').css("opacity", "1");
    $('.search_icon_new').hide();
  });
$("body").on('click', function (e) {
  if ($(e.target).closest(".search_icon_new").length === 0  && $(e.target).closest(".sub_search").length === 0) {
    $('.search_icon_new').show();
    $('.sub_search').css("opacity", "0");
  }
});



});
$(document).ready(function () {
  if($(".js-range-slider").length > 0){
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
function our_brand(){
  $(".our_brand").slick({
    dots: false,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 1,
    slidesToScroll: 1,
  });
}
window.addEventListener("scroll", function () {
  var header = document.querySelector(".header");
  header.classList.toggle("sticky-bar", window.scrollY > 50);
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
})(jQuery);

$(document).ready(function () {
  if($(".picZoomer").length > 0){
    
  $(".picZoomer").picZoomer();
  $(".piclist li").on("click", function (event) {
    alert('Hey');
    var $pic = $(this).find("img");
    $(".picZoomer-pic").attr("src", $pic.attr("src"));
  });
  }
  if($("#recent_post").length > 0){
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
// $("#range-slider").slider({
//   // the id of the slider element
//   id: "range-slider",
//   // minimum value
//   min: 1,
//   // maximum value
//   max: 10000,
//   // increment step
//   step: 1,
//   // the number of digits shown after the decimal.
//   precision: 0,
//   // 'horizontal' or 'vertical'
//   orientation: "horizontal",
//   // initial value
//   value: 5,
//   // enable range slider
//   range: true,
//   // selection placement.
//   // 'before', 'after' or 'none'.
//   // in case of a range slider, the selection will be placed between the handles
//   selection: "before",
//   // 'show', 'hide', or 'always'
//   tooltip: "always",
//   // show two tooltips one for each handler
//   tooltip_split: true,
//   // lock to ticks
//   lock_to_ticks: false,
//   // 'round', 'square', 'triangle' or 'custom'
//   handle: "round",
//   // whether or not the slider should be reversed
//   reversed: false,
//   // RTL mode
//   rtl: "auto",
//   // whether or not the slider is initially enabled
//   enabled: true,
//   // callback
//   formatter: function formatter(val) {
//     if (Array.isArray(val)) {
//       return val[0] + " : " + val[1];
//     } else {
//       return val;
//     }
//   },
//   // The natural order is used for the arrow keys.
//   // Arrow up select the upper slider value for vertical sliders, arrow right the righter slider value for a horizontal slider - no matter if the slider was reversed or not.
//   // By default the arrow keys are oriented by arrow up/right to the higher slider value, arrow down/left to the lower slider value.
//   natural_arrow_keys: false,
//   // Used to define the values of ticks.
//   // Tick marks are indicators to denote special values in the range.
//   // This option overwrites min and max options.
//   ticks: [],
//   // Defines the positions of the tick values in percentages.
//   // The first value should always be 0, the last value should always be 100 percent.
//   ticks_positions: [],
//   // Defines the labels below the tick marks. Accepts HTML input.
//   ticks_labels: [],
//   // Used to define the snap bounds of a tick.
//   // Snaps to the tick if value is within these bounds.
//   ticks_snap_bounds: 0,
//   // Used to allow for a user to hover over a given tick to see it's value.
//   ticks_tooltip: false,
//   // Position of tooltip, relative to slider.
//   // Accepts 'top'/'bottom' for horizontal sliders and 'left'/'right' for vertically orientated sliders.
//   // Default positions are 'top' for horizontal and 'right' for vertical slider.
//   tooltip_position: null,
//   // Set to 'logarithmic' to use a logarithmic scale.
//   scale: "linear",
//   // Focus the appropriate slider handle after a value change.
//   focus: false,
//   // ARIA labels for the slider handle's, Use array for multiple values in a range slider.
//   labelledby: null,
//   // Defines a range array that you want to highlight
//   rangeHighlights: [],

//   // Bootstrap Range Slider Js End
// });

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

// product review rating page js
$('.rating-select .btn').on('mouseover', function(){
  $(this).removeClass('btn-light').addClass('btn-success');
  $(this).prevAll().removeClass('btn-light').addClass('btn-success');
  $(this).nextAll().removeClass('btn-success').addClass('btn-light');
});

$('.rating-select').on('mouseleave', function(){
  active = $(this).parent().find('.selected');
  if(active.length) {
      active.removeClass('btn-light').addClass('btn-success');
      active.prevAll().removeClass('btn-light').addClass('btn-success');
      active.nextAll().removeClass('btn-success').addClass('btn-light');
  } else {
      $(this).find('.btn').removeClass('btn-success').addClass('btn-light');
  }
});

$('.rating-select .btn').click(function(){
  if($(this).hasClass('selected')) {
      $('.rating-select .selected').removeClass('selected');
  } else {
      $('.rating-select .selected').removeClass('selected');
      $(this).addClass('selected');
      
      if($('#prodRating').length>0){
          $('#prodRating').val( $(this).data('rating_value') );
      }
  }
});