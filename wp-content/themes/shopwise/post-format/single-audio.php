<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single_post">
		<h1 class="blog_title"><?php the_title(); ?></h2>
		<ul class="list_none blog_meta">
			<li><i class="ti-calendar"></i> <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></li>

			<?php if(has_category()){ ?>
			<li><i class="ti-folder"></i> <?php the_category(', '); ?></li>
			<?php } ?>
			
			<?php the_tags( '<li><i class="ti-tag"></i>', ', ', ' </li>'); ?>
			
			<?php if ( is_sticky()) {
				printf( '<li class="sticky"><i class="ti-star"></i>%s</li>', esc_html__( 'Featured', 'shopwise' ) );
			} ?>
		</ul>
		<div class="blog_img">
			<figure class="entry-media embed-responsive embed-responsive-16by9">
			   <?php echo get_post_meta($post->ID, 'klb_blogaudiourl', true); ?>
			</figure>
		</div>

		<div class="blog_content">
			<div class="blog_text">
				<div class="klb-post">
					<?php the_content(); ?>
					<?php wp_link_pages(array('before' => '<div class="klb-pagination">' . esc_html__( 'Pages:', 'shopwise' ),'after'  => '</div>', 'next_or_number' => 'number')); ?>
				</div>
			</div>
		</div>
	</div>
</article>