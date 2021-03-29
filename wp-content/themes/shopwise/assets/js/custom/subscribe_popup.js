(function ($) {
  "use strict";

	$(window).on('load',function(){
		  if ($.cookie("cacher-modal")) {
			$("#onload-popup").remove();
		  } else {
			setTimeout(function() {
				$("#onload-popup").modal('show', {}, 500);
			}, 3000);
		  }
		
	});
	
	$(document).ready(function () {
		$(".dontshow").click(function() {
			if ($(this).is(":checked")) {
				$(".subscribe_popup").modal("hide");
				$.cookie("cacher-modal", true);
			} else {
				$.cookie("cacher-modal", false);
			}
		})
	});

})(jQuery);