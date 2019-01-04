<?php

	function imperfect_register_custom_widgets() {
		register_widget( 'imperfect_side_menu_recent_post' );
		register_widget( 'imperfect_sidebar_mini_post' );
		register_widget( 'imperfect_sidebar_left_thumbnail_post' );
		register_widget( 'imperfect_social_and_footer_text' );
	}
	add_action( 'widgets_init', 'imperfect_register_custom_widgets' );



	/*---------------------------------------------------------*/
	/* Imperfect Recent Posts Widgets One */
	/*---------------------------------------------------------*/

	class imperfect_side_menu_recent_post extends WP_Widget{
		function __construct() {
			parent::__construct( 'imp_side_menu_rcn_post', __( 'Imperfect Off-Canvas Menu Posts', 'imperfect' ) );
		}

		function form( $instance ) { ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e( 'Title', 'imperfect' ); ?></label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" class="widefat" value="<?php echo !empty($instance['title']) ? $instance['title'] : ''; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_side_menu_recent_posts_ctg' ) ); ?>"><?php _e( 'Categories', 'imperfect' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_side_menu_recent_posts_ctg' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_side_menu_recent_posts_ctg' ) ); ?>">
				<option value=""><?php _e( '-- Select Category --', 'imperfect' ); ?></option>

				<?php  

					$terms = get_terms( 'category' );
					foreach ( $terms as $term ) :
						
						$selected 	=  ( $instance['imperfect_side_menu_recent_posts_ctg'] == $term->slug ) ? 'selected=selected' : '';
						?>
							<option value="<?php echo esc_attr( $term->slug ) ?>" <?php echo esc_attr( $selected ) ?>> <?php echo esc_html( $term->name ); ?></option>
						<?php

					endforeach;
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_side_menu_recent_posts_count_number' ) ); ?>"><?php _e( 'Number of posts to show: ', 'imperfect' ); ?></label>
			<input type="number" min="1" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_side_menu_recent_posts_count_number' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_side_menu_recent_posts_count_number' ) ); ?>" class="tiny-text" value="<?php echo !empty($instance['imperfect_side_menu_recent_posts_count_number']) ? $instance['imperfect_side_menu_recent_posts_count_number'] : ''; ?>">
		</p>

	<?php
		}

		function widget( $args, $instance ) {
	?>

		<section>
			<ul class="links">
				<?php

					$getCat 	 =  $instance['imperfect_side_menu_recent_posts_ctg'] ? $instance['imperfect_side_menu_recent_posts_ctg'] : '';
					$no_of_posts = $instance['imperfect_side_menu_recent_posts_count_number'] ? $instance['imperfect_side_menu_recent_posts_count_number'] : 4;

					$args = array(
						'post_type'			=> 'post',
						'category_name'		=> $getCat,
						'post__not_in'		=> array( get_the_ID() ),
						'posts_per_page'	=> $no_of_posts
					);
					$mrp_query = new WP_Query( $args );

					if ( $mrp_query->have_posts() ) :
						while ( $mrp_query->have_posts() ) : $mrp_query->the_post();
				?>
							<li>
								<a href="<?php the_permalink(); ?>">
									<h3><?php the_title(); ?></h3>
									<?php echo imperfect_excerpt(4); ?>
								</a>
							</li>
				<?php 
						endwhile; 
					else:
				?>
						<li>
							<p><?php _e( 'No posts found', 'imperfect' ); ?></p>
						</li>
				<?php endif; ?>
			</ul>
		</section>

	<?php

		}
	}



	/*---------------------------------------------------------*/
	/* Imperfect Recent Mini Thumbnail Posts */
	/*---------------------------------------------------------*/

	class imperfect_sidebar_mini_post extends WP_Widget {

		function __construct() {
			parent::__construct( 'imp_sidebar_mini_rcn_post', __( 'Imperfect Mini Thumbnail Posts', 'imperfect' ) );
		}

		function form( $instance ) { ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e( 'Title', 'imperfect' ); ?></label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" class="widefat" value="<?php echo !empty($instance['title']) ? $instance['title'] : ''; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_sidebar_mini_recent_posts_ctg' ) ); ?>"><?php _e( 'Categories', 'imperfect' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_sidebar_mini_recent_posts_ctg' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_sidebar_mini_recent_posts_ctg' ) ); ?>">
				<option value=""><?php _e( '-- Select Category --', 'imperfect' ); ?></option>

				<?php  

					$terms = get_terms( 'category' );
					foreach ( $terms as $term ) :
						
						$selected 	=  ( $instance['imperfect_sidebar_mini_recent_posts_ctg'] == $term->slug ) ? 'selected="selected"' : '';
						?>
							<option value="<?php echo esc_attr( $term->slug ); ?>" <?php echo esc_attr( $selected ); ?>> <?php echo esc_html( $term->name ); ?></option>
						<?php
					endforeach;
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_sidebar_mini_posts_count_number' ) ); ?>"><?php _e( 'Number of posts to show: ', 'imperfect' ); ?></label>
			<input type="number" min="1" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_sidebar_mini_posts_count_number' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_sidebar_mini_posts_count_number' ) ); ?>" class="tiny-text" value="<?php echo !empty($instance['imperfect_sidebar_mini_posts_count_number']) ? $instance['imperfect_sidebar_mini_posts_count_number'] : ''; ?>">
		</p>

	<?php
		}

		function widget( $args, $instance ) {
	?>

		<section>
			<div class="mini-posts">
				<?php

					$getCat 	 =  $instance['imperfect_sidebar_mini_recent_posts_ctg'] ? $instance['imperfect_sidebar_mini_recent_posts_ctg'] : '';
					$no_of_posts = $instance['imperfect_sidebar_mini_posts_count_number'] ? $instance['imperfect_sidebar_mini_posts_count_number'] : 4;

					$args = array(
						'post_type'			=> 'post',
						'category_name'		=> $getCat,
						'post__not_in'		=> array( get_the_ID() ),
						'posts_per_page'	=> $no_of_posts
					);
					$mrp_query = new WP_Query( $args );

					if ( $mrp_query->have_posts() ) :
						while ( $mrp_query->have_posts() ) : $mrp_query->the_post();
				?>
							<article class="mini-post">
								<header>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<time class="published" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'F d, Y' ) ); ?></time>
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="author-imperfect"><img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), ['size'=>45] ) ); ?>" alt="<?php echo esc_attr( get_the_author_meta( 'display_name' ) ); ?>" /></a>
								</header>
								<a href="<?php the_permalink(); ?>" class="image">
									<?php 
										if ( has_post_thumbnail() ) {
											the_post_thumbnail();
										} else {
											echo '<img src="'. esc_attr( get_theme_file_uri( 'assets/images/default.jpg' ) ) .'" alt="'. esc_attr( get_the_title() ) .'" />';
										}
									?>
								</a>
							</article>
				<?php 
						endwhile; 
					else:
				?>
						<li>
							<p><?php _e( 'No posts found', 'imperfect' ); ?></p>
						</li>
				<?php endif; ?>
			</div>
		</section>

	<?php

		}
	}


	/*---------------------------------------------------------*/
	/* Imperfect Recent Left Thumbnail Posts */
	/*---------------------------------------------------------*/

	class imperfect_sidebar_left_thumbnail_post extends WP_Widget{
		function __construct() {
			parent::__construct( 'imp_sidebar_left_rcn_post', __( 'Imperfect Left Thumbnail Posts', 'imperfect' ) );
		}

		function form( $instance ) { ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e( 'Title', 'imperfect' ); ?></label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" class="widefat" value="<?php echo !empty($instance['title']) ? $instance['title'] : ''; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_sidebar_left_posts_count_number' ) ); ?>"><?php _e( 'Number of posts to show: ', 'imperfect' ); ?></label>
			<input type="number" min="1" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_sidebar_left_posts_count_number' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_sidebar_left_posts_count_number' ) ); ?>" class="tiny-text" value="<?php echo !empty($instance['imperfect_sidebar_left_posts_count_number']) ? $instance['imperfect_sidebar_left_posts_count_number'] : ''; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_sidebar_left_recent_posts_ctg' ) ); ?>"><?php _e( 'Categories', 'imperfect' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_sidebar_left_recent_posts_ctg' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_sidebar_left_recent_posts_ctg' ) ); ?>">
				<option value=""><?php _e( '-- Select Category --', 'imperfect' ); ?></option>

				<?php  

					$terms = get_terms( 'category' );
					foreach ( $terms as $term ) :
						
						$selected 	=  ( $instance['imperfect_sidebar_left_recent_posts_ctg'] == $term->slug ) ? 'selected="selected"' : '';
						?>
							<option value="<?php echo esc_attr( $term->slug ); ?>" <?php echo esc_attr( $selected ); ?>> <?php echo esc_html( $term->name ); ?></option>
						<?php
						
					endforeach;
				?>
			</select>
		</p>

	<?php
		}

		function widget( $args, $instance ) {
	?>

		<section>
			<ul class="posts">
				<?php

					$getCat 	 =  $instance['imperfect_sidebar_left_recent_posts_ctg'] ? $instance['imperfect_sidebar_left_recent_posts_ctg'] : '';
					$no_of_posts = $instance['imperfect_sidebar_left_posts_count_number'] ? $instance['imperfect_sidebar_left_posts_count_number'] : 4;

					$args = array(
						'post_type'			=> 'post',
						'category_name'		=> $getCat,
						'post__not_in'		=> array( get_the_ID() ),
						'posts_per_page'	=> $no_of_posts
					);
					$mrp_query = new WP_Query( $args );

					if ( $mrp_query->have_posts() ) :
						while ( $mrp_query->have_posts() ) : $mrp_query->the_post();
				?>
							<li>
								<article>
									<header>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<time class="published" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>"><?php echo esc_html( get_the_date( 'F d, Y' ) ); ?></time>
									</header>
									<a href="<?php the_permalink(); ?>" class="image">
										<?php 
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( 'imperfect-left-thumb', array( 'alt' => esc_attr( get_the_title() ) ) );
											} else {
												echo '<img src="'. esc_attr( get_theme_file_uri( 'assets/images/default.jpg' ) ) .'" alt="'. esc_attr( get_the_title() ) .'" />';
											}
										?>
									</a>
								</article>
							</li>
				<?php 
						endwhile; 
					else:
				?>
						<li>
							<p><?php _e( 'No posts found', 'imperfect' ); ?></p>
						</li>
				<?php endif; ?>
			</ul>
		</section>

	<?php

		}
	}


	/*---------------------------------------------------------*/
	/* Imperfect Social networks footer text */
	/*---------------------------------------------------------*/

	class imperfect_social_and_footer_text extends WP_Widget{

		public function __construct() {
			parent::__construct( 'imperfect_social_nd_footer', __( 'Imperfect Social Networks', 'imperfect' ) );
		}

		function form( $instance ) { 
	?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_tw' ) ); ?>"><?php _e( 'Twitter', 'imperfect' ) ?></label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_tw' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_tw' ) ); ?>" value="<?php echo !empty($instance['imperfect_tw']) ? $instance['imperfect_tw'] : ''; ?>" class="widefat">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_fb' ) ); ?>"><?php _e( 'Facebook', 'imperfect' ) ?></label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_fb' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_fb' ) ); ?>" value="<?php echo !empty($instance['imperfect_fb']) ? $instance['imperfect_fb'] : ''; ?>" class="widefat">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_ins' ) ); ?>"><?php _e( 'Instagram', 'imperfect' ) ?></label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_ins' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_ins' ) ); ?>" value="<?php echo !empty($instance['imperfect_ins']) ? $instance['imperfect_ins'] : ''; ?>" class="widefat">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_link' ) ); ?>"><?php _e( 'LinkedIn', 'imperfect' ) ?></label>
				<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_link' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_link' ) ); ?>" value="<?php echo !empty($instance['imperfect_link']) ? $instance['imperfect_link'] : ''; ?>" class="widefat">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_mail' ) ); ?>"><?php _e( 'Mail', 'imperfect' ) ?></label>
				<input type="email" name="<?php echo esc_attr( $this->get_field_name( 'imperfect_mail' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_mail' ) ); ?>" value="<?php echo !empty($instance['imperfect_mail']) ? $instance['imperfect_mail'] : ''; ?>" class="widefat">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'imperfect_ft' ) ); ?>"><?php _e( 'Footer Text', 'imperfect' ) ?></label>
				<textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name('imperfect_ft') ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'imperfect_ft' ) ); ?>"><?php echo !empty($instance['imperfect_ft']) ? $instance['imperfect_ft'] : ''; ?></textarea>
				
			</p>

	<?php

		}

		function widget( $args, $instance ) {

			$twitter 	= sanitize_text_field( $instance['imperfect_tw'] );
			$facebook 	= sanitize_text_field( $instance['imperfect_fb'] );
			$instagram 	= sanitize_text_field( $instance['imperfect_ins'] );
			$linkedin 	= sanitize_text_field( $instance['imperfect_link'] );
			$email 		= sanitize_email( $instance['imperfect_mail'] );
			$footer_text = sanitize_textarea_field( $instance['imperfect_ft'] );
	?>
			
			<section id="footer">
				<ul class="icons">

					<?php if ( !empty($twitter) ) : ?>
						<li><a href="<?php echo esc_url( $twitter ); ?>" class="fa-twitter"><span class="label"><?php _e( 'Twitter', 'imperfect' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( !empty($facebook) ) : ?>
						<li><a href="<?php echo esc_url( $facebook ); ?>" class="fa-facebook"><span class="label"><?php _e( 'Facebook', 'imperfect' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( !empty($instagram) ) : ?>
						<li><a href="<?php echo esc_url( $instagram ); ?>" class="fa-instagram"><span class="label"><?php _e( 'Instagram', 'imperfect' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( !empty($linkedin) ) : ?>
						<li><a href="<?php echo esc_url( $linkedin ); ?>" class="fa-linkedin"><span class="label"><?php _e( 'Linked', 'imperfect' ); ?></span></a></li>
					<?php endif; ?>

					<?php if ( !empty($email) ) : ?>
						<li><a href="mailto:<?php echo esc_attr( $email ); ?>" class="fa-envelope"><span class="label"><?php _e( 'Email', 'imperfect' ); ?></span></a></li>
					<?php endif; ?>


				</ul>
				<?php if ( !empty($footer_text) ) : ?>
					<p class="copyright"><?php echo esc_html( $footer_text ); ?></p>
				<?php endif; ?>
			</section>
	<?php

		}

	}
















?>