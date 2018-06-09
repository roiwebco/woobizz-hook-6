<?php
/*
Plugin Name: Woobizz Hook 6 
Plugin URI: http://woobizz.com
Description: Add content before payment options on checkout page
Author: WOOBIZZ.COM
Author URI: http://woobizz.com
Version: 1.0.1
Text Domain: woobizzhook6
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook6_load_textdomain' );
function woobizzhook6_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook6', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Add Hook 6
function woobizzhook6_widget() {
	$args = array(
				'id'            => 'woobizzhook6_id',
				'name'          => __( 'Woobizz Hook 6', 'woobizzhook6' ),
				'description'   => __( 'Add content before payment options on checkout page','woobizzhook6' ),
				'before_title'  => '<h2 class="widgettitle">',
				'before_title'   => '</h2>',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'before_widget'  => '</li>',
	);
	register_sidebar( $args );
	add_action( 'woocommerce_review_order_before_payment', 'woobizzhook6_display',100);
	function woobizzhook6_display(){
		?>
		<div class="woobizzhook-widget-div">
			<div class="woobizzhook-widget-content">
				<?php dynamic_sidebar( 'Woobizz Hook 6' ); ?>
			</div>
		</div>
		<?php
	}
}
add_action( 'widgets_init', 'woobizzhook6_widget',106);
