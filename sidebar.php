<section id="sidebar">
	<!-- Intro -->
	<section id="intro">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
			<?php
				$getLogo = get_theme_mod( 'custom_logo');  
				if ( function_exists( 'the_custom_logo' ) && !empty( $getLogo ) ) {
				    $logoURL = wp_get_attachment_image_src( $getLogo, 'full' );
				    echo '<img src="'. esc_url( $logoURL[0] ).'" alt="'. get_bloginfo('name') .'" />';
				} else {
					echo '<img src="'. esc_url( get_theme_file_uri() ).'/assets/images/logo.jpg" alt="'. get_bloginfo('name') .'" />';
				}
			?>
		</a>
		<header>
			<h2><?php bloginfo( 'name' ); ?></h2>
			<p><?php bloginfo( 'description' ); ?></p>
		</header>
	</section>

	<?php 
		if ( is_active_sidebar( 'imperfect_left_sidebar_widgets' ) ) {
			dynamic_sidebar( 'imperfect_left_sidebar_widgets' );
		}
	?>

</section>