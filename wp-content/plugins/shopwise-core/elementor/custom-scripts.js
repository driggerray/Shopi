/* KLB Addons for Elementor v1.0 */

!(function ($) {
	
	/* HOME SLIDER */
	function klbbackground_bg($scope, $) {
		$(".background_bg").each(function() {
			var attr = $(this).attr('data-img-src');
			if (typeof attr !== typeof undefined && attr !== false) {
				$(this).css('background-image', 'url(' + attr + ')');
			}
		});
	}
	
	/* OWL CAROUSEL */
	function klbowlcarousel($scope, $) {
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
	}
	
	/* SLICK SLIDER*/
	function klbslickslider($scope, $) {
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
	}
	function klbcountdown($scope, $) {
		$('.countdown_time').each(function() {
			var endTime = $(this).data('time');
			$(this).countdown(endTime, function(tm) {
				$(this).html(tm.strftime('<div class="countdown_box"><div class="countdown-wrap"><span class="countdown days">%D </span><span class="cd_text">Days</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown hours">%H</span><span class="cd_text">Hours</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown minutes">%M</span><span class="cd_text">Minutes</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown seconds">%S</span><span class="cd_text">Seconds</span></div></div>'));
			});
		});
	}
	
	function klbcontactform7($scope, $) {
		$(".wpcf7-form input[name='your-name'], .wpcf7-form input[type='email']" ).closest('p').wrapAll( "<div class='row'></div>" );
		$(".wpcf7-form input[name='your-name'], .wpcf7-form input[type='email']" ).closest('p').wrap( "<div class='col-lg-6'><div class='form-group'></div></div>" );
		$(".wpcf7-form input[name='your-subject'], .wpcf7-form input[type='tel']" ).closest('p').wrapAll( "<div class='row'></div>" );
		$(".wpcf7-form input[name='your-subject'], .wpcf7-form input[type='tel']" ).closest('p').wrap( "<div class='col-lg-6'><div class='form-group'></div></div>" );
	}
	
    var parentBody = window.parent.document.getElementsByClassName("elementor-editor-wp-page");
    var parentBod = $(parentBody);
    
    function updatePageSettings(newValue) {
        elementor.saver.update({
            onSuccess: function() {
                elementor.reloadPreview();
                elementor.once( 'preview:loaded', function() {
                    elementor.getPanelView().setPage('page_settings').activateTab('settings');
                    jQuery(parentBod).find('.elementor-tab-control-settings').addClass('elementor-active');
                    jQuery(parentBod).find('#elementor-panel-footer-settings').trigger('click');
                } );
            }
        });
    }
    jQuery(window).on('elementor/frontend/init', function () {

        if ( typeof elementor != "undefined" && typeof elementor.settings.page != "undefined") {
            elementor.settings.page.addChangeCallback( 'shopwise_elementor_hide_page_header', updatePageSettings );
            elementor.settings.page.addChangeCallback( 'shopwise_elementor_page_header_type', updatePageSettings );
            elementor.settings.page.addChangeCallback( 'shopwise_elementor_hide_page_footer', updatePageSettings );
        }
		
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-home-slider.default', klbbackground_bg);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-home-slider-2.default', klbbackground_bg);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-home-full-slider.default', klbbackground_bg);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-product-carousel.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-product-carousel.default', klbcountdown);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-product-carousel-2.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-product-carousel-3.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-product-carousel-4.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-testimonial.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-product-tab-carousel.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-product-tab-carousel-2.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-clients-carousel.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-image-carousel.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-category-carousel.default', klbowlcarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-contact-form-7.default', klbcontactform7);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-deal-section.default', klbbackground_bg);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-deal-section.default', klbcountdown);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-deal-carousel.default', klbcountdown);
        elementorFrontend.hooks.addAction('frontend/element_ready/shopwise-deal-carousel.default', klbowlcarousel);


    });

})(jQuery);
