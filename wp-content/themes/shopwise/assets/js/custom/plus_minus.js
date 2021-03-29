(function ($) {
  "use strict";

	$(document).ready(function () {
 
			if ($(".qty").attr("max")){
				$('.plus').on('click', function () {
					if ($(this).prev().val() < $(".qty").attr("max")) {
						$(this).prev().val(+$(this).prev().val() + 1);
					}
					
					$('button.button').removeAttr("disabled");  
				});
			} else {
				$('.plus').on('click', function () {
					if ($(this).prev().val() < 100) {
						$(this).prev().val(+$(this).prev().val() + 1);
					}
					
					$('button.button').removeAttr("disabled");
				});
			}

			$('.minus').on('click', function () {
				if ($(this).next().val() > 1) {
					if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
				}
				$('button.button').removeAttr("disabled");
			});
	});

})(jQuery);
