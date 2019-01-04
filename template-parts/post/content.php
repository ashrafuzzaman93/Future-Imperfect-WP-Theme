<article id="post-<?php the_ID() ?>"  <?php post_class( array( 'post' ) ); ?>>
	<header>
		<div class="title">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</div>
		<div class="meta">
			<time class="published" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
				<?php echo esc_html( get_the_date( 'F d, Y' ) ); ?>
			</time>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-imperfect">
				<span class="name"><?php the_author(); ?></span>
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 38, null, get_the_author_meta('display_name') ) ; ?>
			</a>
		</div>
	</header>
	<a href="<?php the_permalink(); ?>" class="image featured">
		<?php  
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} else {
				echo '<img src="'. esc_attr( get_theme_file_uri( 'assets/images/default.jpg' ) ) .'" alt="'. esc_attr( get_the_title() ) .'" />';
			}
		?>
	</a>
	<?php
		if ( !post_password_required() ) {
			echo imperfect_excerpt(); 
		} else {
			echo get_the_password_form();
		}	
	?>
	<footer>
		<ul class="actions">
			<li><a href="<?php the_permalink(); ?>" class="button large"><?php _e( 'Continue Reading', 'imperfect' ); ?></a></li>
		</ul>
		<ul class="stats">
			<li><?php the_category( ' ' ); ?></li>
			<li><a href="#" class="icon fa-heart">28</a></li>
			<li><?php comments_popup_link( '0', '1', '%', 'icon fa-comment', __( 'Comments Off', 'imperfect' ) ); ?></li>
		</ul>
	</footer>
</article>