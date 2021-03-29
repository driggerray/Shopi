<?php 
/*************************************************
## Shopwise Typography
*************************************************/

function shopwise_custom_styling() { ?>

<style type="text/css">
<?php if (get_theme_mod( 'shopwise_shop_breadcrumb_bg' )) { ?>
.klb-shop-breadcrumb.page-title-area{
	background-image: url(<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'shopwise_shop_breadcrumb_bg' )) ); ?>);
}
<?php } ?>


<?php if (get_theme_mod( 'shopwise_blog_breadcrumb_bg' )) { ?>
.klb-blog-breadcrumb.page-title-area{
	background-image: url(<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'shopwise_blog_breadcrumb_bg' )) ); ?>);
}
<?php } ?>


<?php if (get_theme_mod( 'shopwise_question_box' )) { ?>
.questions-area .questions-box::before {
	background-image: url(<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'shopwise_question_box_image' )) ); ?>);
}
<?php } ?>


#preloader{
	background: #fff url('<?php echo esc_url( wp_get_attachment_url(get_theme_mod( 'shopwise_loader_image' )) ); ?>') no-repeat center center; 
}

a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.btn-fill-out {
	border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.btn-fill-out::before,
.btn-fill-out::after {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.btn-fill-out:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?> !important;
}

.btn-border-fill {
	border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.btn-border-fill::before,
.btn-border-fill::after {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.btn-link::before {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.text_default {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?> !important;
}

.bg_default {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?> !important;
}

.scrollup:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.scrollup_style1 {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

[class*=overlay_bg_default_]::before {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.ripple {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.ripple::before,.ripple::after {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.btn-ripple-white .ripple {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.heading_s3::before {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.sub_heading {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.lds-ellipsis span {
	background: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.dark_skin .navbar .navbar-nav .dropdown-menu li a.active, 
.dark_skin .navbar .navbar-nav .dropdown-menu li a:hover, 
.dark_skin .navbar .navbar-nav .dropdown-menu > ul > li:hover > a, 
.dark_skin .navbar .navbar-nav .dropdown-menu > ul > .mega-menu-col ul > li:hover > a {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.navbar .navbar-nav > li > a.active, 
.navbar .navbar-nav > li:hover > a,
.light_skin.transparent_header.nav-fixed .navbar .navbar-nav > li > a.active,
.light_skin.transparent_header.nav-fixed .navbar .navbar-nav > li:hover > a,
.transparent_header.nav-fixed .light_skin .navbar .navbar-nav > li > a.active,
.transparent_header.nav-fixed .light_skin .navbar .navbar-nav > li:hover > a {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.navbar .navbar-nav .dropdown-menu li a.active, 
.navbar .navbar-nav .dropdown-menu li a:hover, 
.navbar .navbar-nav .dropdown-menu > ul > li:hover > a, 
.navbar .navbar-nav .dropdown-menu > ul > .mega-menu-col ul > li:hover > a, 
.sticky_dark_skin.nav-fixed .navbar .navbar-nav .dropdown-item:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.sticky_dark_skin.nav-fixed .navbar .navbar-nav .dropdown-item.active {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.cart_count, .wishlist_count {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.social_icons li a:hover, 
.header_wrap .social_icons li a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.social_white .social_icons li a:hover, .social_white.social_icons li a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.border_social .social_icons li a:hover, .border_social.social_icons li a:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.social_icons.social_style1 li a {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.social_icons.social_style1 li a:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.social_style4 li a {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.social_style4 li a:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.top-header.light_skin .header_list li a:hover, 
.top-header.light_skin .contact_detail li a:hover, 
.top-header.light_skin .header_list li a:hover span {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.banne_info a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?> !important;
}

.hover_menu_style1 .navbar-collapse .navbar-nav > li > a::before {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.categories_btn {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

#navCatContent li a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.more_categories {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.search_btn2 {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.search_btn3 {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.search_btn:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.contact_phone i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.carousel-control-next:hover, .carousel-control-prev:hover,
.light_arrow .carousel-control-next:hover, .light_arrow .carousel-control-prev:hover{
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.indicators_style1 li.active,
.indicators_style2 li.active {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.indicators_style2 li.active:before,
.indicators_style1 li.active:before {
	border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.banner_content_border {
	border: 10px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.bg_strip {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.bg_strip::before {
	border: 20px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border-bottom-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border-left-color: transparent;
}

.bg_strip::after {
	border: 20px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border-bottom-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border-right-color: transparent;
}

@media only screen and (max-width: 480px){
	.bg_strip::before, .bg_strip::after {
		border-width: 17px;
	}
}

.icon_box_style2 .icon i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.icon_box_style3 .icon i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.icon_box_style4 .icon i {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.icon_box_style5:hover {
	border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.icon_box_style5:hover .icon {
	background-color:<?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.icon_box_style6 .icon i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.icon_box_style6 .icon::before {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.grid_filter li a.current {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.grid_filter.filter_style1 li a.current {
	color: #fff;
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.grid_filter.filter_style2 li a.current {
	border-bottom-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.author_name span {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.testimonial_style2.nav_style1.owl-theme[data-margin="10"] .owl-nav .owl-prev,
.testimonial_style2.nav_style1.owl-theme[data-margin="10"] .owl-nav .owl-next {
	background-color:<?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.blog_meta li a i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.post_date {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.blog_post.blog_style3 .blog_content a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.newsletter_form .btn-send {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

}
.newsletter_form .btn-send2 {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.contact_info_style2 li i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.footer_dark a:hover, .footer_dark .widget_links li a:hover, .widget_links li a:hover, .footer_dark .footer_link li a:hover,.footer_link li a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.contact_icon i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.contact_text a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.contact_style3 .contact_icon {
	border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.contact_style3 .contact_icon::before {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.divider.divider_style1 i {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.deal_timer::before {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.deal_wrap {
	border: 2px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.deal_progress .progress-bar {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.shorting_icon.active {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.price {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.pr_action_btn li a:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.product_size_switch span.active {
	border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.product_gallery_item a.active {
    border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.product_sort_info li i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.filter_price .ui-slider .ui-slider-range {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.shop_container.list .pr_action_btn li a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.shop_container.list .list_product_action_box .pr_action_btn li.add-to-cart a {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.shop_container.list .pr_action_btn li.add-to-cart a:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.toggle_info i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.order_complete i {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.pagination_style1 .page-item.active .page-link, 
.pagination_style1 .page-item .page-link:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.tags a:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.widget_tweet_feed a {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.tab-style1 .nav-tabs li.nav-item a.active, .tab-style1 .nav-tabs li.nav-item a.active:hover,
.tab-style2 .nav-tabs li.nav-item a.active, .tab-style2 .nav-tabs li.nav-item a.active:hover {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.tab-style3 .nav-tabs .nav-item a.active {
	border-bottom-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.custome-checkbox input[type="checkbox"]:checked + .form-check-label::before {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.custome-radio input[type="radio"] + .form-check-label::after {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.custome-radio input[type="radio"]:checked + .form-check-label::before {
	border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.owl-theme .owl-dots .owl-dot span {
	border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.owl-theme .owl-dots .owl-dot.active span,
.owl-theme .owl-dots .owl-dot:hover span {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.nav_style5.owl-theme .owl-nav .owl-prev:hover, .nav_style5.owl-theme .owl-nav .owl-next:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.slick-prev:hover, .slick-next:hover {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.scroll_down_icon .down {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.blockquote_style2 {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.blockquote_style3 {
	border-left: 2px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.default {
	background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.product_price ins {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

button.button {
    border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

button.button:before,button.button:after {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

button.button:hover {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.ajax_quick_view .product_price > span.woocommerce-Price-amount {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.tab-style3 .woocommerce-tabs ul li.active a {
    border-bottom-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

input[type="submit"] {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
    border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

input[type="submit"]:hover {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.mega_main_menu > .menu_holder > .menu_inner > ul#main_ul-main-menu > li.current-menu-item > .item_link:after {
	color:<?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.mega_main_menu.main-menu .mega_dropdown > li > .item_link:hover * {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.navbar .mega_main_menu.main-menu .mega_dropdown > li > .item_link:hover * {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.categories_wrap .mega_main_menu.klb-sidebar-menu .mega_dropdown > li > .item_link:hover * {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

ul.page-numbers span.page-numbers.current, ul.page-numbers a.page-numbers:hover {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
    border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.ui-slider .ui-slider-range {
	background: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?> !important;
	border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

p.woocommerce-mini-cart__buttons a.button:before,
p.woocommerce-mini-cart__buttons a.button:after {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

p.woocommerce-mini-cart__buttons.buttons a.button.checkout:hover {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

p.woocommerce-mini-cart__buttons.buttons a.button.checkout {
    border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.woocommerce-form-coupon-toggle:before {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

nav.woocommerce-MyAccount-navigation ul li a {
    border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

nav.woocommerce-MyAccount-navigation ul li.is-active a, nav.woocommerce-MyAccount-navigation ul li a:hover {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.woocommerce-MyAccount-content a {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.blog_meta i {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.tagcloud a:hover {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

blockquote {
    border-left: 2px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

ul.klb-left-menu li a:hover {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.klb-header2 p.woocommerce-mini-cart__buttons a.button:first-child:before,.klb-header2 p.woocommerce-mini-cart__buttons a.button:first-child:after {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.klb-header2 p.woocommerce-mini-cart__buttons.buttons a.button:first-child:hover {
    border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.klb-product2.product_box .add-to-cart a {
    border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.klb-product2.product_box .add-to-cart a:before,.product_box .add-to-cart a:after {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.klb-product2.product_box .add-to-cart a:hover {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

@media (min-width: 992px) {
	.klb-header3 .mega_main_menu.main-menu > .menu_holder > .menu_inner > ul > li > .item_link:hover:after {
		color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
	}
}

.mega_main_menu.main-menu > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link:after {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.klb-post button {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
    border: 1px solid <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.klb-post button:hover {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.klb-pagination span.post-page-numbers.current, .klb-pagination a.post-page-numbers:hover {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
    border-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.icon_box_style4 .icon i {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.icon_box_style4 .icon i {
    background: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

code {
    color: <?php echo esc_attr(get_theme_mod( 'shopwise_main_color' )); ?>;
}

.header_wrap:not([class*="bg_"]):not([class*="bg-"]) {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_header_bg' )); ?>;
}
.mega_main_menu.main-menu > .menu_holder > .mmm_fullwidth_container {
    background-color: <?php echo esc_attr(get_theme_mod( 'shopwise_header_bg' )); ?>;
}

.main_menu_uppercase .navbar-nav > li > .nav-link,
ul.klb-left-menu li a,
.contact_detail > li a, 
.header_list > li a,
.header_list > li:before {
	color: <?php echo esc_attr(get_theme_mod( 'shopwise_header_font_color' )); ?>;
}

ul.klb-left-menu li a {

}
</style>
<?php }
add_action('wp_head','shopwise_custom_styling');

?>