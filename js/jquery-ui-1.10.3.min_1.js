// !!!  menu onclick add body class in menu full screen open js !!!
jQuery('#menu').click(function () {
    $('#nav-icon').toggleClass('open');
});
// !!! custom reponsive menu !!!
jQuery(function ($) {

    $("nav .navbar-nav, .nav-primary .navbar-nav, .nav-secondary .navbar-nav").addClass("responsive-menu");

   /* $(".navbar-toggle").click(function () {
        $("header .navbar-nav, .nav-primary .navbar-nav, .nav-secondary .navbar-nav").slideToggle();
    });*/

    $(window).resize(function () {
        if (window.innerWidth > 991) {
            $("nav .navbar-nav, .nav-primary .navbar-nav, .nav-secondary .navbar-nav, nav .sub-menu").removeAttr("style");
            $(".responsive-menu > .menu-item").removeClass("menu-open");
        }
    });

    $(".menu-item-has-children").click(function (event) {
        if (event.target !== this)
            return;
        $(this).children().siblings(".sub-menu").slideToggle(function () {
            $(this).parent().toggleClass("menu-open");
        });
    });
});


// !!! wow animation js !!!
var wow = new WOW({
    boxClass: 'wow',
    animateClass: 'animated',
    offset: 0,
    mobile: true,
    live: true,
    callback: function (box) {},
    scrollContainer: null
});
wow.init();



/*--------------------------
Search form
---------------------------- */

$(".search-btn").on("click", function(){
  $(".search_active").addClass("activepop");
});

//removes the "active" class to .popup and .popup-content when the "Close" button is clicked 
$(".close__wrap, .popup-overlay").on("click", function(){
  $(".search_active").removeClass("activepop");
});


// DONATE BUTTON HOVER

$(function() {  
  $('.btn-6')
    .on('mouseenter', function(e) {
			var parentOffset = $(this).offset(),
      		relX = e.pageX - parentOffset.left,
      		relY = e.pageY - parentOffset.top;
			$(this).find('span').css({top:relY, left:relX})
    })
    .on('mouseout', function(e) {
			var parentOffset = $(this).offset(),
      		relX = e.pageX - parentOffset.left,
      		relY = e.pageY - parentOffset.top;
    	$(this).find('span').css({top:relY, left:relX})
    });
  
});

/* !!! Active pertucular dive on html !!! */

function visible(partial) {
    var $t = partial,
        $w = jQuery(window),
        viewTop = $w.scrollTop(),
        viewBottom = viewTop + $w.height(),
        _top = $t.offset().top,
        _bottom = _top + $t.height(),
        compareTop = partial === true ? _bottom : _top,
        compareBottom = partial === true ? _top : _bottom;

    return ((compareBottom <= viewBottom) && (compareTop >= viewTop) && $t.is(':visible'));
}

function customAnimation()
{
    if (jQuery('.fade').length) {
        jQuery('.fade').each(function () {
            var el = jQuery(this);
            if (visible(el)) {
                el.addClass('-in-view');
            }
        });
    } 
}

jQuery(document).ready(function(){
    
     customAnimation();    
    
     //scroll
    $(window).scroll(function (event) {
        customAnimation();
    })
})

/*$(document).ready(function() {
    $('.select-custom').select2();
    $("#country").select2({
        placeholder: "Country*"
    });
     $("#budget").select2({
        placeholder: "Budget*"
    });
});
*/
// !!!  menu onclick add body class in menu full screen open js !!!

jQuery('#offcanvas-toggler').click(function () {
    $('.offcanvas-menu').addClass('offcanvas');	
});
jQuery(".close-offcanvas").click(function() {    
    $('.offcanvas-menu').removeClass( 'offcanvas');    
}); 

// Gallery image hover
$( ".img-wrapper" ).hover(
  function() {
    $(this).find(".img-overlay").animate({opacity: 1}, 600);
  }, function() {
    $(this).find(".img-overlay").animate({opacity: 0}, 600);
  }
);

// Lightbox
var $overlay = $('<div id="overlay"></div>');
var $image = $("<img>");
var $prevButton = $('<div id="prevButton"><i class="fa fa-chevron-left"></i></div>');
var $nextButton = $('<div id="nextButton"><i class="fa fa-chevron-right"></i></div>');
var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

// Add overlay
$overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
$("#gallery").append($overlay);

// Hide overlay on default
$overlay.hide();

// When an image is clicked
$(".img-overlay").click(function(event) {
  // Prevents default behavior
  event.preventDefault();
  // Adds href attribute to variable
  var imageLocation = $(this).prev().attr("href");
  // Add the image src to $image
  $image.attr("src", imageLocation);
  // Fade in the overlay
  $overlay.fadeIn("slow");
});

// When the overlay is clicked
$overlay.click(function() {
  // Fade out the overlay
  $(this).fadeOut("slow");
});

// When next button is clicked
$nextButton.click(function(event) {
  // Hide the current image
  $("#overlay img").hide();
  // Overlay image location
  var $currentImgSrc = $("#overlay img").attr("src");
  // Image with matching location of the overlay image
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  // Finds the next image
  var $nextImg = $($currentImg.closest(".image").next().find("img"));
  // All of the images in the gallery
  var $images = $("#image-gallery img");
  // If there is a next image
  if ($nextImg.length > 0) { 
    // Fade in the next image
    $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  } else {
    // Otherwise fade in the first image
    $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
  }
  // Prevents overlay from being hidden
  event.stopPropagation();
});

// When previous button is clicked
$prevButton.click(function(event) {
  // Hide the current image
  $("#overlay img").hide();
  // Overlay image location
  var $currentImgSrc = $("#overlay img").attr("src");
  // Image with matching location of the overlay image
  var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
  // Finds the next image
  var $nextImg = $($currentImg.closest(".image").prev().find("img"));
  // Fade in the next image
  $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
  // Prevents overlay from being hidden
  event.stopPropagation();
});

// When the exit button is clicked
$exitButton.click(function() {
  // Fade out the overlay
  $("#overlay").fadeOut("slow");
});


 jQuery( document ).ready(function($) {
    $('.scroller-ul').each(function () {
        var $scrollable = $(this);
        var $scrollbar = $(this).prev().children();
        $scrollbar.parent().removeAttr('style');
        $scrollbar.removeAttr('style');
        var $height = 0;
        $('li', $scrollable).each(function () {
            $height = parseInt($height) + parseInt($(this).height());
        })
        $scrollable.outerHeight(true);
        var mainscroll = $scrollable.outerHeight(true);
        var scrolheight = $scrollable[0].scrollHeight;
        var Thumbheight = mainscroll * mainscroll / scrolheight;
        $scrollbar.height(Thumbheight);
        $scrollable.on("scroll", function () {
            $scrollbar.css('margin-top', $scrollable.scrollTop() / mainscroll * Thumbheight);
        })
    })
 });

// !!!  menu onclick add body class in menu full screen open js !!!

 $(".toggle-btn").on('click', function() 
  {    
    $(this).parent('.collpase-btn').next('.collpase-div').slideToggle( "800");
    
  },function()
  {    
    $(this).parent('.collpase-btn').next('.collpase-div').slideToggle( "800");
    
  });   
 $('.circle-plus').on('click', function(){
  $(this).toggleClass('opened');
})

// FILTER GALLERY
var _createClass = function () {function defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}return function (Constructor, protoProps, staticProps) {if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;};}();function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}var
FilterGallery = function () {

    function FilterGallery() {_classCallCheck(this, FilterGallery);
        this.$filtermenuList = $('.filtermenu li');
        this.$container = $('.procontainer');

        this.updateMenu('all');
        this.$filtermenuList.on('click', $.proxy(this.onClickFilterMenu, this));
    }_createClass(FilterGallery, [{ key: 'onClickFilterMenu', value: function onClickFilterMenu(

        event) {
            var $target = $(event.target);
            var targetFilter = $target.data('filter');

            this.updateMenu(targetFilter);
            this.updateGallery(targetFilter);
        } }, { key: 'updateMenu', value: function updateMenu(

        targetFilter) {
            this.$filtermenuList.removeClass('active');
            this.$filtermenuList.each(function (index, element) {
                var targetData = $(element).data('filter');

                if (targetData === targetFilter) {
                    $(element).addClass('active');
                }
            });
        } }, { key: 'updateGallery', value: function updateGallery(

        targetFilter) {var _this = this;

            if (targetFilter === 'all') {
                this.$container.fadeOut(300, function () {
                    $('.post').show();
                    _this.$container.fadeIn();
                });
            } else {
                this.$container.find('.post').each(function (index, element) {
                    _this.$container.fadeOut(300, function () {
                        if ($(element).hasClass(targetFilter)) {
                            $(element).show();
                        } else {
                            $(element).hide();
                        }
                        _this.$container.fadeIn();
                    });
                });
            }
        } }]);return FilterGallery;}();


var fliterGallery = new FilterGallery();


//CUSTOM_TAB JS
$(document).on("click", "#service-tab .nav-link", function(e){
	e.preventDefault();
	var $this = $(this);
	if($this.closest('.service-tab').hasClass('now-it-not-accordian'))
{
	$('.nav-link ', $('.services')).not($this).removeClass('active');
	$('.tab-pane', $('.services')).not($this.attr('href')).hide();
	$($this.attr('href')).show();
	$this.addClass('active');
}
	else
		{
			$('.nav-link ', $('.services')).not($this).removeClass('active');
			$this.toggleClass('active');
			$('.tab-pane', $('.services')).not($this.attr('href')).css('max-height', '0px');
			if(!$this.hasClass('active'))
				{
					$($this.attr('href')).css('max-height','0px');
				}
			else
				{
			$($this.attr('href')).css('max-height', $($this.attr('href'))[0].scrollHeight);
				}
			
			
			
		}
})

function AccrodianTotab()
{
if($(window).width() < 767)
	{
		if(!$("#service-tab").hasClass('now-it-accordian'))
			{
$("#service-tab").addClass('now-it-accordian');
$("#service-tab").removeClass('now-it-not-accordian');
		jQuery('[href="#one"]').trigger('click');
	   jQuery('#service-tab .nav-link').each(function () {
                    $(this).after($($(this).attr('href'))[0].outerHTML);
                    $($(this).attr('href'), $('.tab-content')).hide();
	   })
			}
		
	}
else
	{
		if(!$("#service-tab").hasClass('now-it-not-accordian'))
			{
				$("#service-tab").removeClass('now-it-accordian');
$("#service-tab").addClass('now-it-not-accordian');
		 $('.tab-pane', $('#service-tab')).remove();
                $('.tab-pane').removeAttr('style');
                jQuery('[href="#one"]').trigger('click');
			}
	}

}
AccrodianTotab();
$(window).resize(function(){
	AccrodianTotab();
})


$( document ).ready(function() {	
    //$("#projectone .content").trigger('mouseover');
	setTimeout(function() {
       $("#project1").css('opacity','1');
	   $("#project2").css('opacity','1');
    }, 2000);
	setTimeout(function() {
       $("#project1").removeAttr('style');
	   $("#project2").removeAttr('style');
    }, 4000);
	setTimeout(function() {
       $("#project3").css('opacity','1');
	   $("#project4").css('opacity','1');
    }, 4000);
	setTimeout(function() {
       $("#project3").removeAttr('style');
	   $("#project4").removeAttr('style');
    }, 6000);
	setTimeout(function() {
       $("#project5").css('opacity','1');
	   $("#project6").css('opacity','1');
    }, 6000);
	setTimeout(function() {
       $("#project5").removeAttr('style');
	   $("#project6").removeAttr('style');
    }, 8000);
	setTimeout(function() {
       $("#project13").css('opacity','1');
	   $("#project14").css('opacity','1');
    }, 8000);
	setTimeout(function() {
       $("#project13").removeAttr('style');
	   $("#project14").removeAttr('style');
    }, 10000);
	setTimeout(function() {
       $("#project7").css('opacity','1');
	   $("#project8").css('opacity','1');
    }, 10000);
	setTimeout(function() {
       $("#project7").removeAttr('style');
	   $("#project8").removeAttr('style');
    }, 12000);
	setTimeout(function() {
       $("#project9").css('opacity','1');
	   $("#project10").css('opacity','1');
    }, 12000);
	setTimeout(function() {
       $("#project9").removeAttr('style');
	   $("#project10").removeAttr('style');
    }, 14000);
	setTimeout(function() {
       $("#project11").css('opacity','1');
	   $("#project12").css('opacity','1');
    }, 14000);
	setTimeout(function() {
       $("#project11").removeAttr('style');
	   $("#project12").removeAttr('style');
    }, 16000);
	
	setTimeout(function() {
       $("#project1").css('opacity','1');
	   $("#project2").css('opacity','1');
    }, 16000);
	setTimeout(function() {
       $("#project1").removeAttr('style');
	   $("#project2").removeAttr('style');
    }, 20000);
	setTimeout(function() {
       $("#project3").css('opacity','1');
	   $("#project4").css('opacity','1');
    }, 22000);
	setTimeout(function() {
       $("#project3").removeAttr('style');
	   $("#project4").removeAttr('style');
    }, 24000);
	setTimeout(function() {
       $("#project5").css('opacity','1');
	   $("#project6").css('opacity','1');
    }, 24000);
	setTimeout(function() {
       $("#project5").removeAttr('style');
	   $("#project6").removeAttr('style');
    }, 26000);
	setTimeout(function() {
       $("#project13").css('opacity','1');
	   $("#project14").css('opacity','1');
    }, 26000);
	setTimeout(function() {
       $("#project13").removeAttr('style');
	   $("#project14").removeAttr('style');
    }, 28000);
	setTimeout(function() {
       $("#project7").css('opacity','1');
	   $("#project8").css('opacity','1');
    }, 28000);
	setTimeout(function() {
       $("#project7").removeAttr('style');
	   $("#project8").removeAttr('style');
    }, 30000);
	setTimeout(function() {
       $("#project9").css('opacity','1');
	   $("#project10").css('opacity','1');
    }, 30000);
	setTimeout(function() {
       $("#project9").removeAttr('style');
	   $("#project10").removeAttr('style');
    }, 32000);
	setTimeout(function() {
       $("#project11").css('opacity','1');
	   $("#project12").css('opacity','1');
    }, 32000);
	setTimeout(function() {
       $("#project11").removeAttr('style');
	   $("#project12").removeAttr('style');
    }, 34000);
	
	
	setTimeout(function() {
       $("#project1").css('opacity','1');
	   $("#project2").css('opacity','1');
    }, 34000);
	setTimeout(function() {
       $("#project1").removeAttr('style');
	   $("#project2").removeAttr('style');
    }, 37000);
	setTimeout(function() {
       $("#project3").css('opacity','1');
	   $("#project4").css('opacity','1');
    }, 37000);
	setTimeout(function() {
       $("#project3").removeAttr('style');
	   $("#project4").removeAttr('style');
    }, 40000);
	setTimeout(function() {
       $("#project5").css('opacity','1');
	   $("#project6").css('opacity','1');
    }, 40000);
	setTimeout(function() {
       $("#project5").removeAttr('style');
	   $("#project6").removeAttr('style');
    }, 43000);
	setTimeout(function() {
       $("#project13").css('opacity','1');
	   $("#project14").css('opacity','1');
    }, 43000);
	setTimeout(function() {
       $("#project13").removeAttr('style');
	   $("#project14").removeAttr('style');
    }, 46000);
	setTimeout(function() {
       $("#project7").css('opacity','1');
	   $("#project8").css('opacity','1');
    }, 46000);
	setTimeout(function() {
       $("#project7").removeAttr('style');
	   $("#project8").removeAttr('style');
    }, 49000);
	setTimeout(function() {
       $("#project9").css('opacity','1');
	   $("#project10").css('opacity','1');
    }, 49000);
	setTimeout(function() {
       $("#project9").removeAttr('style');
	   $("#project10").removeAttr('style');
    }, 52000);
	setTimeout(function() {
       $("#project11").css('opacity','1');
	   $("#project12").css('opacity','1');
    }, 52000);
	setTimeout(function() {
       $("#project11").removeAttr('style');
	   $("#project12").removeAttr('style');
    }, 55000);
	
	
	setTimeout(function() {
       $("#project1").css('opacity','1');
	   $("#project2").css('opacity','1');
    }, 55000);
	setTimeout(function() {
       $("#project1").removeAttr('style');
	   $("#project2").removeAttr('style');
    }, 58000);
	setTimeout(function() {
       $("#project3").css('opacity','1');
	   $("#project4").css('opacity','1');
    }, 58000);
	setTimeout(function() {
       $("#project3").removeAttr('style');
	   $("#project4").removeAttr('style');
    }, 61000);
	setTimeout(function() {
       $("#project5").css('opacity','1');
	   $("#project6").css('opacity','1');
    }, 61000);
	setTimeout(function() {
       $("#project5").removeAttr('style');
	   $("#project6").removeAttr('style');
    }, 65000);
	setTimeout(function() {
       $("#project13").css('opacity','1');
	   $("#project14").css('opacity','1');
    }, 65000);
	setTimeout(function() {
       $("#project13").removeAttr('style');
	   $("#project14").removeAttr('style');
    }, 69000);
	setTimeout(function() {
       $("#project7").css('opacity','1');
	   $("#project8").css('opacity','1');
    }, 69000);
	setTimeout(function() {
       $("#project7").removeAttr('style');
	   $("#project8").removeAttr('style');
    }, 73000);
	setTimeout(function() {
       $("#project9").css('opacity','1');
	   $("#project10").css('opacity','1');
    }, 73000);
	setTimeout(function() {
       $("#project9").removeAttr('style');
	   $("#project10").removeAttr('style');
    }, 77000);
	setTimeout(function() {
       $("#project11").css('opacity','1');
	   $("#project12").css('opacity','1');
    }, 77000);
	setTimeout(function() {
       $("#project11").removeAttr('style');
	   $("#project12").removeAttr('style');
    }, 82000);
	
	
	setTimeout(function() {
       $("#project1").css('opacity','1');
	   $("#project2").css('opacity','1');
    }, 82000);
	setTimeout(function() {
       $("#project1").removeAttr('style');
	   $("#project2").removeAttr('style');
    }, 86000);
	setTimeout(function() {
       $("#project3").css('opacity','1');
	   $("#project4").css('opacity','1');
    }, 86000);
	setTimeout(function() {
       $("#project3").removeAttr('style');
	   $("#project4").removeAttr('style');
    }, 90000);
	setTimeout(function() {
       $("#project5").css('opacity','1');
	   $("#project6").css('opacity','1');
    }, 90000);
	setTimeout(function() {
       $("#project5").removeAttr('style');
	   $("#project6").removeAttr('style');
    }, 95000);
	setTimeout(function() {
       $("#project13").css('opacity','1');
	   $("#project14").css('opacity','1');
    }, 95000);
	setTimeout(function() {
       $("#project13").removeAttr('style');
	   $("#project14").removeAttr('style');
    }, 100000);
	setTimeout(function() {
       $("#project7").css('opacity','1');
	   $("#project8").css('opacity','1');
    }, 100000);
	setTimeout(function() {
       $("#project7").removeAttr('style');
	   $("#project8").removeAttr('style');
    }, 110000);
	setTimeout(function() {
       $("#project9").css('opacity','1');
	   $("#project10").css('opacity','1');
    }, 110000);
	setTimeout(function() {
       $("#project9").removeAttr('style');
	   $("#project10").removeAttr('style');
    }, 120000);
	setTimeout(function() {
       $("#project11").css('opacity','1');
	   $("#project12").css('opacity','1');
    }, 120000);
	setTimeout(function() {
       $("#project11").removeAttr('style');
	   $("#project12").removeAttr('style');
    }, 130000);
	
});
$(function () {
    var active = '';
    var next = null;
    $('#carousel-ppc').on('slide.bs.carousel', function () {
        $('.carousel-indicators li').each(function () {
            if ($(this).hasClass('active')) {
                active = $(this).data('slide-to');
                console.log(active);
                next = $(this).next('li').data('slide-to');
            }
        });
        $('.pay-per-click-wrapper').removeClass('slide-' + active);
        if (typeof next === 'undefined') {
            $('.pay-per-click-wrapper').addClass('slide-1');
        } else {
            $('.pay-per-click-wrapper').addClass('slide-' + next);
        }

    });
});