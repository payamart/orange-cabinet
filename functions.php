<?php
	/* Define THEME */
	if (!defined('URI_PATH')) define('URI_PATH', get_template_directory_uri());
	if (!defined('ABS_PATH')) define('ABS_PATH', get_template_directory());
	if (!defined('URI_PATH_FR')) define('URI_PATH_FR', URI_PATH.'/framework');
	if (!defined('ABS_PATH_FR')) define('ABS_PATH_FR', ABS_PATH.'/framework');
	if (!defined('URI_PATH_ADMIN')) define('URI_PATH_ADMIN', URI_PATH_FR.'/admin');
	if (!defined('ABS_PATH_ADMIN')) define('ABS_PATH_ADMIN', ABS_PATH_FR.'/admin');
	/* Frameword functions */

	/* Theme Options */
    if (!function_exists('jws_theme_filtercontent')) {
	function jws_theme_filtercontent($variable){
		return $variable;
	}
    }
    require_once ABS_PATH . '/framework_option/cs-framework.php';
    require_once (ABS_PATH_ADMIN.'/index.php');
    /* Function for Framework */
	require_once ABS_PATH_FR . '/includes.php';
    require_once ABS_PATH_FR . '/location_store.php';
	/* Widgets */
	require_once ABS_PATH_FR.'/widgets/abstract-widget.php';
	require_once ABS_PATH_FR.'/widgets/widgets.php';
    /* Woo commerce function */
    if (class_exists('Woocommerce')) {
    require_once ABS_PATH . '/woocommerce/wc-template-function.php';
    require_once ABS_PATH . '/woocommerce/wc-template-hooks.php';
    }
    /* Function for OCDI */
    function _kitgreen_filter_fw_ext_backups_demos($demos)
	{
		$demos_array = array(
			'kitgreen' => array(
				'title' => esc_html__('KitGreen Demo', 'kitgreen'),
				'screenshot' => 'http://jwsuperthemes.com/import_demo/kitgreen/screenshot.jpg',
				'preview_link' => 'http://kitgreen.jwsthemeswp.com',
			),
		);
        $download_url = 'http://jwsuperthemes.com/import_demo/kitgreen/download-script/';
		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);
			$demos[$demo->get_id()] = $demo;
			unset($demo);
		}
		return $demos;
	}
    add_filter('fw:ext:backups-demo:demos', '_kitgreen_filter_fw_ext_backups_demos');
	/* Register Sidebar */
	if (!function_exists('jwstheme_RegisterSidebar')) {
		function jwstheme_RegisterSidebar(){
			global $jwstheme_options;
            register_sidebar(array(
			'name' => __('Sidebar Filter Shop Top', 'kitgreen'),
			'id' => 'jws-filter-shhop-color',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
            register_sidebar(array(
			'name' => __('Sidebar Filter Shop Left And Right', 'kitgreen'),
			'id' => 'jws-filter-shhop-left-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
            register_sidebar(array(
			'name' => __('Sidebar Blog', 'kitgreen'),
			'id' => 'jws-sidebar-blog',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
            register_sidebar(array(
			'name' => __('Sidebar Remove Filter', 'kitgreen'),
			'id' => 'jws-sidebar-remove',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
            register_sidebar(array(
			'name' => __('Sidebar Shop Detail', 'kitgreen'),
			'id' => 'jws-sidebar-shop-detail',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
			));
		}
	}
	add_action( 'widgets_init', 'jwstheme_RegisterSidebar' );
    /**
     * Get all registered sidebars.
     *
     * @return  array
     */
        function jws_get_sidebars() {
        	global $wp_registered_sidebars;
        
        	// Get custom sidebars.
        	$custom_sidebars = get_option( 'kitgreen_custom_sidebars' );
        
        	// Prepare output.
        	$output = array();
        
        	$output[] = esc_html__( 'Select a sidebar', 'kitgreen' );
        
        	if ( ! empty( $wp_registered_sidebars ) ) {
        		foreach ( $wp_registered_sidebars as $sidebar ) {
        			$output[ $sidebar['id'] ] = $sidebar['name'];
        		}
        	}
        
        	if ( ! empty( $custom_sidebars ) ) {
        		foreach ( $custom_sidebars as $sidebar ) {
        			$output[ $sidebar['id'] ] = $sidebar['name'];
        		}
        	}
        
        
        	return $output;
       }
	/* Enqueue Script */
	function jwstheme_enqueue_scripts() {
        // Google font
    	wp_enqueue_style( 'jws-font-google', jws_kitgreen_google_font_url() );
		/* Start Css jws */   
        wp_enqueue_style( 'boostrap-css', "https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css", false );
        wp_enqueue_style( 'jws-preset', URI_PATH.'/assets/css/presets/default.css', false );
        wp_enqueue_style( 'ionicons', URI_PATH.'/assets/css/ionicons.min.css', false );
        wp_enqueue_style( 'linearicons', URI_PATH.'/assets/css/linearicons.css', false );
        wp_enqueue_style( 'animate', URI_PATH.'/assets/css/css_jws/animate.css', false );
        /* End Css jws */
        /* Start JS jws */
        wp_enqueue_style( 'slick-css', "//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css", false );
        wp_enqueue_script( 'modernizr', "https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" , false  );
        wp_enqueue_script( 'slick-js', "https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js", array('jquery'), '', true  );
        wp_enqueue_script( 'waypoints', "https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js", array('jquery'), '', true  );
        wp_enqueue_script( 'image-load', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', array('jquery'), '', true  );
        wp_enqueue_script( 'image-lazy', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js', array('jquery'), '', true  );
        wp_enqueue_script( 'menu-sticky', URI_PATH.'/assets/js/dev/menu-sticky.js', array('jquery'), '', true  );    
        wp_enqueue_script( 'jquery.countdown.min', "https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js", array('jquery'), '', true  );    
        wp_enqueue_script( 'isotope-js', "https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.5/isotope.pkgd.min.js", array('jquery'), '', true  );
        wp_enqueue_script( 'packery', URI_PATH.'/assets/js/dev/packery.js', array('jquery'), '', true  );
        wp_enqueue_script( 'shortcode-js', URI_PATH.'/assets/js/dev/shortcode_theme.js', array('jquery'), '', true  );
        
		wp_enqueue_style( 'jws-kitgreen-style', get_stylesheet_uri() );
		wp_add_inline_style( 'jws-kitgreen-style', jws_theme_custom_css() );
        $script_name = 'wc-add-to-cart-variation';
    	if ( wp_script_is( $script_name, 'registered' ) && ! wp_script_is( $script_name, 'enqueued' ) ) {
    		wp_enqueue_script( $script_name );
    	}
        /*Woocomerce*/
        wp_enqueue_script( 'jws-cartparent', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_parent.js', array('jquery'), '', true  );
        wp_enqueue_script( 'jws-addtocart', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_addtocart.min.js', array('jquery'), '', true  );
        wp_enqueue_script( 'jws-cart', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_cart.js', array('jquery'), '', true  );
        wp_enqueue_script( 'jws-laodmore', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_load-more.js', array('jquery'), '', true  );
        wp_enqueue_script( 'jws-cartsingle', URI_PATH.'/assets/js/dev/woocomerce/ajax_mn_single.js', array('jquery'), '', true  );
        wp_enqueue_script( 'jws-startcart', URI_PATH.'/assets/js/dev/woocomerce/star_cart.js', array('jquery'), '', true  );
   
        wp_enqueue_script( 'jws-main-js', URI_PATH.'/assets/js/dev/main.js', array('jquery'), '', true  );
        wp_enqueue_script( 'boostrap-js', "https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js", array('jquery'), '', true  );
        wp_localize_script( 'jquery', 'MS_Ajax', array(
            'ajaxurl'       => admin_url( 'admin-ajax.php' ),
            'nextNonce'     => wp_create_nonce( 'myajax-next-nonce' ))
        );
        if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
            wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
        }
	}
    add_action( 'wp_enqueue_scripts', 'jwstheme_enqueue_scripts' );
        function deregister_styles() {
            wp_deregister_style( 'animate-css');
        }
    add_action( 'wp_print_styles', 'deregister_styles', 100 );
	/* Init Functions */
    $less = cs_get_option('golobal-enable-less');
    if($less == "1") {
      	function jwstheme_init() {
    		require_once ABS_PATH_FR.'/presets.php';
    	}
    	add_action( 'init', 'jwstheme_init' );  
    }