<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

		<?php wp_head(); ?>
	</head>
	<body <?php body_class( array( 'is-preload' ) ); ?>>
		
		<!-- Wrapper -->
		<div id="wrapper">

			<!-- Header -->
			<header id="header">
				<h1><a href="<?php echo esc_url( site_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<?php  
					if ( has_nav_menu( 'primary_menu' ) ) {
						wp_nav_menu( array(
							'theme_location'	=> 'primary_menu',
							'container'			=> 'nav',
							'container_class'	=> 'links'
						) );
					}
				?>
				<nav class="main">
					<ul>
						<li class="search">
							<a class="fa-search" href="#search"><?php _e( 'Search', 'imperfect' ); ?></a>
							<form id="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="text" name="s" placeholder="<?php _e( 'Search', 'imperfect' ); ?>" />
							</form>
						</li>
						<?php if ( is_active_sidebar( 'imperfect_menu_widgets_area' ) ) : ?>
							<li class="menu"><a class="fa-bars" href="#menu"><?php _e( 'Menu', 'imperfect' ); ?></a></li>
						<?php endif; ?>
					</ul>
				</nav>
			</header>

			<?php get_template_part( 'template-parts/header/off-canvas-menu' ); ?>
					
