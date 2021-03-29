jQuery(document).ready(function($) {
	"use strict";

 	$("ul#main_ul-klb-sidebar-menu > :nth-child(1n+" + sidebarmenu.displayitem + ")" ).wrapAll( "<li><ul class='more_slide_open' style='display: none;'></ul></li>" );
	$("ul#menu-sidebar-menu > :nth-child(1n+" + sidebarmenu.displayitem + ")" ).wrapAll( "<li><ul class='more_slide_open' style='display: none;'></ul></li>" );
	$("ul#menu-categories > :nth-child(1n+" + sidebarmenu.displayitem + ")" ).wrapAll( "<li><ul class='more_slide_open' style='display: none;'></ul></li>" );
});