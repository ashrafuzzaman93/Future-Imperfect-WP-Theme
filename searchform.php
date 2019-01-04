<?php $uniq_id = uniqid('search-form-'); ?>
<form class="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" id="<?php echo esc_attr( $uniq_id ); ?>" name="s" placeholder="<?php _e( 'Search', 'imperfect' ); ?>" value="<?php get_search_query(); ?>" />
</form>