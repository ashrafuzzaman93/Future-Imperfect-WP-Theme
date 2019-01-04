<article class="post">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p>
		<?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'imperfect' ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
	</p>
	<?php else : ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'imperfect' ); ?></p>
			<?php
				get_search_form();
		endif; ?>
</article>