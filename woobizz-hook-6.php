<?php
/*
Plugin Name: Woobizz Hook 6 
Plugin URI: http://woobizz.com
Description: Add widget content before payment options on checkout page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
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
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
	add_action( 'widgets_init', 'woobizzhook6_widget',106);    
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook6_admin_notice' );
}
//Add Hook 6

function woobizzhook6_widget() {
	$args = array(
				'id'            => 'woobizzhook6_id',
				'name'          => __( 'Woobizz Hook 6', 'woobizzhook6' ),
				'description'   => __( 'Add widget content before payment options on checkout page','woobizzhook6' ),
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
//Hook1 Notice
function woobizzhook6_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 6 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook6' ); ?></p>
    </div>
    <?php
}