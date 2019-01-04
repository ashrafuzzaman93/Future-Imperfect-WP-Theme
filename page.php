<?php get_header(); ?>
	<!-- Main -->
	<div id="main">
		<?php  
			while ( have_posts() ) : the_post();
		?>
		<article id="post-<?php the_ID() ?>" <?php post_class( array( 'post' ) ); ?>>
			<span class="image featured"><?php if ( has_post_thumbnail() ) the_post_thumbnail(); ?></span>
			<?php
				the_content(); 
				
				if ( !post_password_required() ) {
					$fi_args = array(
						'before'		=> '<p>'. __( '<b>Pages: </b>', 'imperfect' ),
						'after'			=> '</p>',
					);
					wp_link_pages( $fi_args );
				}
			?>
		</article>
		<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>