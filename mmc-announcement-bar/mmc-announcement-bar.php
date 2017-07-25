<?php 
/*
Plugin Name: MMC Announcement Bar
Description: A simple plugin for learning - adds an announcement bar to the top of the page
Author: Melissa Cabral
Version: 0.1
License: GPLv3 or higher
*/

//HTML output
function mmc_bar_html(){
	?>
	<!-- MMC Announcement Bar Plugin by Melissa Cabral -->
	<div id="announcement-bar">
		<p>This is the Announcement bar <a href="#">Click Here</a></p>
		<div class="mmc-dismiss">×</div>
	</div>
	<?php
}
add_action( 'wp_footer', 'mmc_bar_html' );

//Attach CSS and JS
function mmc_bar_scripts(){
	//figure out the absolute URL to the file
	$css_url = plugins_url( 'css/mmc-announcement-bar.css', __FILE__ );
	//tell WP to put it on the page
	wp_enqueue_style( 'mmc-bar-css', $css_url );

	//attach jQuery 
	wp_enqueue_script( 'jquery' );

	//attach our custom script
	$js_url = plugins_url( 'js/mmc-announcement-bar.js', __FILE__ );
	//					handle       src       deps           ver     in footer?
	wp_enqueue_script( 'mmc-bar-js', $js_url, array('jquery'), '0.1', true  );
}
add_action( 'wp_enqueue_scripts', 'mmc_bar_scripts' );


//no close php