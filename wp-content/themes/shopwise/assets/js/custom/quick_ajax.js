jQuery(document).ready(function($) {
	"use strict";

    $('a.button.detail-bnt').on('click', function(event){
		event.preventDefault(); 
        var data = {
            action: 'quick_view',
			beforeSend: function() {
				$('body').append('<div class="loader-overlay"></div><div class="loader-image"></div>');
			},
			security : MyAjax.security,
			'id': $(this).attr('href'),
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(MyAjax.ajaxurl, data, function(response) {
            $.magnificPopup.open({
                type: 'inline',
                items: {
                    src: response
                }
            })
			
			$('.carousel_slider').each( function() {
				var $carousel = $(this);
				$carousel.owlCarousel({
					dots : $carousel.data("dots"),
					loop : $carousel.data("loop"),
					items: $carousel.data("items"),
					margin: $carousel.data("margin"),
					mouseDrag: $carousel.data("mouse-drag"),
					touchDrag: $carousel.data("touch-drag"),
					autoHeight: $carousel.data("autoheight"),
					center: $carousel.data("center"),
					nav: $carousel.data("nav"),
					rewind: $carousel.data("rewind"),
					navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
					autoplay : $carousel.data("autoplay"),
					animateIn : $carousel.data("animate-in"),
					animateOut: $carousel.data("animate-out"),
					autoplayTimeout : $carousel.data("autoplay-timeout"),
					smartSpeed: $carousel.data("smart-speed"),
					responsive: $carousel.data("responsive")
				});	
			});
			$('.slick_slider').each( function() {
				var $slick_carousel = $(this);
				$slick_carousel.slick({
					arrows: $slick_carousel.data("arrows"),
					dots: $slick_carousel.data("dots"),
					infinite: $slick_carousel.data("infinite"),
					centerMode: $slick_carousel.data("center-mode"),
					vertical: $slick_carousel.data("vertical"),
					fade: $slick_carousel.data("fade"),
					cssEase: $slick_carousel.data("css-ease"),
					autoplay: $slick_carousel.data("autoplay"),
					verticalSwiping: $slick_carousel.data("vertical-swiping"),
					autoplaySpeed: $slick_carousel.data("autoplay-speed"),
					speed: $slick_carousel.data("speed"),
					pauseOnHover: $slick_carousel.data("pause-on-hover"),
					draggable: $slick_carousel.data("draggable"),
					slidesToShow: $slick_carousel.data("slides-to-show"),
					slidesToScroll: $slick_carousel.data("slides-to-scroll"),
					asNavFor: $slick_carousel.data("as-nav-for"),
					focusOnSelect: $slick_carousel.data("focus-on-select"),
					responsive: $slick_carousel.data("responsive")
				});	
			});
		
		
			var image = $('#product_img');
			//var zoomConfig = {};
			var zoomActive = false;
			
			zoomActive = !zoomActive;
			if(zoomActive) {
				if ($(image).length > 0){
					$(image).elevateZoom({
						cursor: "crosshair",
						easing : true, 
						gallery:'pr_item_gallery',
						zoomType: "inner",
						galleryActiveClass: "active"
					}); 
				}
			}
			else {
				$.removeData(image, 'elevateZoom');//remove zoom instance from image
				$('.zoomContainer:last-child').remove();// remove zoom container from DOM
			}
			
			$.magnificPopup.defaults.callbacks = {
			open: function() {
			  $('body').addClass('zoom_image');
			},
			close: function() {
			  // Wait until overflow:hidden has been removed from the html tag
			  setTimeout(function() {
				$('body').removeClass('zoom_image');
				$('body').removeClass('zoom_gallery_image');
				$('.zoomContainer').slice(1).remove();
				}, 100);
			  }
			};
			
			// Set up gallery on click
			var galleryZoom = $('#pr_item_gallery');
			galleryZoom.magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery:{
					enabled: true
				},
				callbacks: {
					elementParse: function(item) {
						item.src = item.el.attr('data-zoom-image');
					}
				}
			});
			
			// Zoom image when click on icon
			$('.product_img_zoom').on('click', function(){
				var atual = $('#pr_item_gallery a').attr('data-zoom-image');
				$('body').addClass('zoom_gallery_image');
				$('#pr_item_gallery .item').each(function(){
					if( atual == $(this).find('.product_gallery_item').attr('data-zoom-image') ) {
						return galleryZoom.magnificPopup('open', $(this).index());
					}
				});
			});
			
			if ($(".qty").attr("max")){
			$('.plus').on('click', function () {
					if ($(this).prev().val() < $(".qty").attr("max")) {
					$(this).prev().val(+$(this).prev().val() + 1);
					}
					
			});
			} else {
			$('.plus').on('click', function () {
					if ($(this).prev().val() < 100) {
					$(this).prev().val(+$(this).prev().val() + 1);
					}
			});
			}

			$('.minus').on('click', function () {
					if ($(this).next().val() > 1) {
					if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
					}
			});
		
			
			$(".loader-image").remove();
			$(".loader-overlay").remove();
        });
    });
});