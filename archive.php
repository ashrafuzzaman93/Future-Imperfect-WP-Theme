<?php get_header(); ?>
	<!-- Main -->
	<div id="main">
		
		<!-- Post -->
		<?php if ( have_posts() ) : ?>
				<article class="post">
					<?php
						the_archive_title( '<h2 class="page-title">', '</h2>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</article>
		<?php endif; ?>

		<?php  
			if ( have_posts() ) :
				// Start the Loop.  
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );

				// End the loop.
				endwhile;
				?>
				<!-- Pagination -->
				<ul class="actions pagination">
					<?php 

						// Previous Posts link
						if ( !empty( get_previous_posts_link() ) ) {
							printf( '<li>%s<li>', get_previous_posts_link( __( 'Previous Page', 'imperfect' ) ) );
						} else {
							printf( '<li><a href="" class="disabled button large previous">%s</a></li>', __( 'Previous Page', 'imperfect' ) );
						}

						// Next Posts link
						if ( !empty( get_next_posts_link() ) ) {
							printf( '<li>%s<li>', get_next_posts_link( __( 'Next Page', 'imperfect' ) ) );
						} else {
							printf( '<li><a href="" class="disabled button large previous">%s</a></li>', __( 'Next Page', 'imperfect' ) );
						}
					?>
				</ul>	
		<?php 
			else: 
				get_template_part( 'template-parts/post/content', 'none' );
			endif;
			?>
	</div>

	<!-- Sidebar -->
	<?php get_sidebar(); ?>

</div>
<?php get_footer(); ?>