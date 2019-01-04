<?php get_header(); ?>
	<!-- Main -->
	<div id="main">
		<article class="post">
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'imperfect' ); ?></h1>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'imperfect' ); ?></p>
			<?php get_search_form(); ?>
			<p><?php _e( 'Back to ', 'imperfect' ); ?><a href="<?php echo esc_url( home_url('/') ); ?>"><?php _e( 'Home', 'imperfect' ); ?></a></p>
		</article>		
	</div>
</div>
<?php get_footer(); ?>