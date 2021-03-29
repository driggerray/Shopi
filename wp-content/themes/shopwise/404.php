<?php
/**
 * 404.php
 * @package WordPress
 * @subpackage Shopwise
 * @since Shopwise 1.0
 */
?>

<?php get_header(); ?>

<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <div class="row align-items-center">
			<?php $breadcrumb = get_theme_mod('shopwise_blog_breadcrumb','0'); ?>
			<?php if($breadcrumb == '1'){ ?>
				<div class="col-md-6">
					<div class="page-title">
						<h1><?php esc_html_e('Page Not Found','shopwise'); ?></h1>
					</div>
				</div>
				<div class="col-md-6">
					<?php echo shopwise_breadcrubms(); ?>
				</div>
			<?php } else { ?>
				<div class="col-md-12">
					<div class="page-title text-center">
						<h1><?php esc_html_e('Page Not Found','shopwise'); ?></h1>
					</div>
				</div>
			<?php } ?>
        </div>
    </div>
</div>

<div class="section">
	<div class="error_wrap">
    	<div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-10 order-lg-first">
                	<div class="text-center">
                        <div class="error_txt"><?php esc_html_e('404','shopwise'); ?></div>
                        <h5 class="mb-2 mb-sm-3"><?php esc_html_e('oops! The page you requested was not found!','shopwise'); ?></h5> 
                        <p><?php esc_html_e('The page you are looking for was moved, removed, renamed or might never existed.','shopwise'); ?></p>
                        <div class="search_form pb-3 pb-md-4">
                            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" method="get">
                                <input type="text" name="s" id="text" placeholder="<?php esc_attr_e('Search', 'shopwise') ?>" class="form-control" autocomplete="off">
                                <button type="submit" class="btn icon_search"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <a href="<?php echo esc_url( home_url('/') ); ?>" class="btn btn-fill-out"><?php esc_html_e('Go To Homepage','shopwise'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>