<div class="col-12">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="blog_post blog_style2 box_shadow1">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<?php  
					$att=get_post_thumbnail_id();
					$image_src = wp_get_attachment_image_src( $att, 'full' );
					$image_src = $image_src[0]; 
				?>
				<div class="blog_img">
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo esc_url($image_src); ?>" alt="<?php the_title_attribute(); ?>">
					</a>
				</div>
			<?php } ?>
			<div class="blog_content bg-white">
				<div class="blog_text">
					<h1 class="blog_title"><a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
					<ul class="list_none blog_meta">
						<li><i class="ti-calendar"></i> <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></li>
						
						<?php if(has_category()){ ?>
						<li><i class="ti-folder"></i> <?php the_category(', '); ?></li>
						<?php } ?>
						
						<?php the_tags( '<li><i class="ti-tag"></i>', ', ', ' </li>'); ?>
						<?php if ( is_sticky()) {
							printf( '<li class="sticky"><i class="ti-star"></i>%s</li>', esc_html__('Featured', 'shopwise' ) );
						} ?>
					</ul>
					<div class="klb-post">
						<?php the_excerpt(); ?>
						<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
					</div>
				</div>
			</div>
		</div>
	</article>
</div>