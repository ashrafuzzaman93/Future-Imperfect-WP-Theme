<?php 
	
	if ( !function_exists('imperfect_theme_setup') ) {
		function imperfect_theme_setup() {

			/* Register Text Domain for Translation */
			load_theme_textdomain('imperfect');

			/* Getting RSS Feed Links */
			add_theme_support( 'automatic-feed-links' );

			/* Getting Title Tag */
			add_theme_support('title-tag');

			/* Getting Post Thumbnail */
			add_theme_support('post-thumbnails');

			add_image_size( 'imperfect-left-thumb', 64, 64, true );

			add_theme_support('custom-header');
			add_theme_support( 'custom-logo' );

			/* Getting Background Options */
			add_theme_support('custom-background');	

			/* Getting Post Formats */ 
			// add_theme_support( 'post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'] );

			/*  */
			add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

			add_editor_style('assets/css/editor-style.css');

			// Menu Register
			register_nav_menu( 'primary_menu', __( 'Primary Menu', 'imperfect' ) );

			if ( ! isset( $content_width ) ) $content_width = 900;
		}

		add_action( 'after_setup_theme', 'imperfect_theme_setup' );
	}

	/*---------------------------------------------*/
    /* Register Sidebar for Sidebar */
    /*---------------------------------------------*/

    function imperfect_main_sidebar_widgets() {

    	$args = array(
    		'name'			=> __( 'Left Sidebar', 'imperfect' ),
    		'id'			=> 'imperfect_left_sidebar_widgets',
    		'before_widget'	=> '<section>',
    		'after_widget'	=> '</section>',
    		'before_title'	=> '<h2>',
    		'after_title'	=> '</h2>'
    	);
    	register_sidebar( $args );
    }
    add_action( 'widgets_init', 'imperfect_main_sidebar_widgets' );


	/*---------------------------------------------*/
    /* Register Sidebar for Menu Widgets */
    /*---------------------------------------------*/

    function imperfect_menu_widgets() {

    	$args = array(
    		'name'			=> __( 'Menu Widget', 'imperfect' ),
    		'id'			=> 'imperfect_menu_widgets_area',
    		'before_widget'	=> '<section>',
    		'after_widget'	=> '</section>'
    	);
    	register_sidebar( $args );
    }
    add_action( 'widgets_init', 'imperfect_menu_widgets' );

    /*---------------------------------------------*/
    /* Register Sidebar for Single.php footer */
    /*---------------------------------------------*/

    function imperfect_single_page_footer_widgets() {

    	$args = array(
    		'name'			=> __( 'Blog Single Page Footer Widget', 'imperfect' ),
    		'id'			=> 'imperfect_single_page_widgets_area',
    		// 'before_widget'	=> '<section>',
    		// 'after_widget'	=> '</section>'
    	);
    	register_sidebar( $args );
    }
    add_action( 'widgets_init', 'imperfect_single_page_footer_widgets' );


	/*-------------------------------------*/
    /* Enqueue Imperfect Theme assets */
    /*-------------------------------------*/

	function imperfect_theme_assets() {

		// Getting Theme Version
		$opt = wp_get_theme();
		$ver = $opt->get( 'Version' );

		// CSS
		wp_enqueue_style( 'font-awesome-css', get_theme_file_uri('/assets/css/font-awesome.min.css'), null, '4.7.0' );
		wp_enqueue_style( 'font-Source-sans-css', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Raleway:400,800,900', null, $ver );
		wp_enqueue_style( 'imperfect-main-css', get_theme_file_uri('/assets/css/main.css'), null, $ver );
		wp_enqueue_style( 'imperfect-css', get_stylesheet_uri(), null, $ver );

		// JavaScript
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'imperfect-browser-min-js', get_theme_file_uri('/assets/js/browser.min.js'), array( 'jquery' ), null, true );
		wp_enqueue_script( 'imperfect-breakpoints-min-js', get_theme_file_uri('/assets/js/breakpoints.min.js'), array( 'jquery' ), null, true );
		wp_enqueue_script( 'imperfect-util-js', get_theme_file_uri('/assets/js/util.js'), array( 'jquery' ), null, true );
		wp_enqueue_script( 'imperfect-main-js', get_theme_file_uri('/assets/js/main.js'), array( 'jquery' ), null, true );

		if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
	        // Load comment-reply.js (into footer)
	        wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
	    }
	}
	add_action( 'wp_enqueue_scripts', 'imperfect_theme_assets' );


	

	// Imperfect Content Excerpt
	function imperfect_excerpt( $limit = null ) {
		
		if ( !empty($limit) ) {
			$getContent = wp_trim_words( get_the_content(), $limit, '' );
		} else {
			$getContent = wp_trim_words( get_the_content(), 50, '' );
		}

		$content = apply_filters( 'the_content', $getContent );
		return $content;
	}


	/*-----------------------------------------------------------------*/
    /* Class add previous_posts_link() and next_posts_link() */
    /*-----------------------------------------------------------------*/

	function imperfect_posts_link_attributes() {
	    return 'class="button large next"';
	}
	add_filter('next_posts_link_attributes', 'imperfect_posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'imperfect_posts_link_attributes');




	/*----------------------------------------------*/
    /* Password Protected Title Prefix */
    /*----------------------------------------------*/

    function imperfect_protected_title_prefix_change() {
    	// return 'Protected: %s';
    	return '%s';
    }
    add_filter( 'protected_title_format', 'imperfect_protected_title_prefix_change' );

    /*----------------------------------------------*/
    /* Include require files */
    /*----------------------------------------------*/
    require_once( get_theme_file_path('/inc/custom-widgets.php') );
    require_once( get_theme_file_path('/inc/internal-css.php') );





















?>