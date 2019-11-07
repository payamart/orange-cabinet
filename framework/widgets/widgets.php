<?php
require_once 'recent-posts-widget-with-thumbnails.php';
require_once 'catgory.php';
require_once 'search-jws.php';
require_once 'portfolio_list.php';

if (class_exists('Woocommerce')) {
	require_once 'minicart-widget.php';
    require_once 'widget_price_woo.php';
    require_once 'contact-header-top.php';
    require_once 'widget_filter_atribute.php';
    require_once 'widget_filter_pric_ajax.php';
    require_once 'product-cat.php';
    require_once 'product-sort-by.php';  
}
/**
 * Register widgets
 *
 * @since  1.0
 *
 * @return void
 */


function kitgreen_register_widgets() {
	if ( class_exists( 'WC_Widget' ) ) {
    	register_widget( 'kitgreen_Widget_Attributes_Filter' );
	   register_widget( 'kitgreen_Price_Filter_List_Widget' );
       register_widget( 'WC_Widget_Product_Categories2' );
       register_widget( 'kitgreen_Product_SortBy_Widget' );
	}
    
}

add_action( 'widgets_init', 'kitgreen_register_widgets' );