<?php get_header(); ?>
	<!-- Main -->
	<div id="main">
		<?php  
			while ( have_posts() ) : the_post();
			?>
				<article class="post">
					<header>
						<div class="title"><h2><?php the_title(); ?></h2></div>
						<div class="meta">
							<time class="published" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'F d, Y' ) ); ?></time>
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-imperfect"><span class="name"><?php the_author(); ?></span><?php echo get_avatar( get_the_author_meta( 'ID' ), 35, null, get_the_author_meta('display_name') ) ; ?>
							</a>
						</div>
					</header>
					<span class="image featured"><?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?></span>
					<?php
						the_content(); 

						if ( !post_password_required() ) {
							$fi_args = array(
								'before'		=> '<p>'. __( 'Pages: ', 'imperfect' ),
								'after'			=> '</p>',
							);
							wp_link_pages( $fi_args );
						}
					?>
					<footer>
						<ul class="stats">
							<li><?php the_tags( __( '<b>Tags: </b>', 'imperfect' ), ' ' ); ?></li>
							<li><a href="#" class="icon fa-heart">28</a></li>
							<li><?php comments_popup_link( '0', '1', '%', 'icon fa-comment', __( 'Comments Off', 'imperfect' ) ); ?></li>
						</ul>
					</footer>
				</article>
		<?php 
				if ( comments_open() || get_comments_number() ) :
					comments_template(); 
				endif;
			endwhile; 
		?>
	</div>

	<!-- Footer -->
	<?php  
		if ( is_active_sidebar('imperfect_single_page_widgets_area') ) {
			dynamic_sidebar('imperfect_single_page_widgets_area');
		}
	?>

</div>

<?php get_footer(); ?>