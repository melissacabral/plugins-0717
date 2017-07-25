<?php
/*
Plugin Name: MMC Custom Admin
Description: Customizes the Admin, Login and register screens
Author: Melissa Cabral
License: GPLv3 or higher
Version: 0.1
*/

// Custom Stylesheet for login and register forms
function mmc_login_css(){
	$url = plugins_url( 'css/login.css', __FILE__ );
	wp_enqueue_style( 'login-css', $url );
}
add_action( 'login_enqueue_scripts', 'mmc_login_css' );

//Change the wordpress logo link
function mmc_login_logo_link(){
	//the home page of this website. you can put any absolute URL here
	return home_url();
}
add_filter( 'login_headerurl', 'mmc_login_logo_link' );


//change the wordpress logo title (tooltip)
function mmc_login_tooltip(){
	return 'Back to ' . get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'mmc_login_tooltip' );

//remove unnecessary dashboard widgets
function mmc_dash_widgets(){
	// 					$id, 			$screen, 		$context
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );

	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );

	//  $id, $title, $callback, $screen, $context, $priority, $callback args
	add_meta_box( 'dashboard_mmc_help', 'Helpful Hints', 'mmc_help_content', 'dashboard', 
		'side', 'high' );
}
add_action( 'admin_init', 'mmc_dash_widgets' );


//callback function for custom dashboard widget
function mmc_help_content(){
	echo '<iframe width="340" height="200" src="https://www.youtube.com/embed/3vVfEsi-R6M?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>';
}

//customize the toolbar (admin bar)
function mmc_modify_toolbar( $wp_admin_bar ){
	$wp_admin_bar->remove_node( 'wp-logo' );

	//add our own "contact me" button
	$wp_admin_bar->add_node( array(
		'id' 	=> 'mmc-contact',
		'title' => 'Contact Melissa',
		'href'	=> 'http://melissacabral.com/get-in-touch',
		'meta'	=> array( 
			'target' => '_blank', 
		),
		'parent' => 'top-secondary', //go to the right
	) );
}
add_action( 'admin_bar_menu', 'mmc_modify_toolbar', 999 );