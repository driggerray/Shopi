<div class="col-12">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="blog_post blog_style2 box_shadow1">
			<div class="blog_img">
				<figure class="entry-media embed-responsive embed-responsive-16by9">
				   <?php  
					if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'vimeo') {  
					  echo '<iframe src="//player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" height="515" allowFullScreen></iframe>';  
					}  
					else if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'youtube') {  
					  echo '<iframe height="450" src="//www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" allowfullscreen></iframe>';  
					}  
					else {  
						echo ' '.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).' '; 
					}  
					?>
				</figure>
			</div>
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
							printf( '<li class="sticky"><i class="ti-star"></i>%s</li>', esc_html__( 'Featured', 'shopwise' ) );
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