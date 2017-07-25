<?php 
/*
Plugin Name: MMC Product Post Type
Description: Adds support for adding new "products" to our admin panel
Author: Melissa Cabral
Version: 0.1
License: GPLv3 and up
*/

add_action( 'init', 'mmc_product_cpt' );
function mmc_product_cpt(){
	register_post_type( 'product', array(
		'public' 		=> true,
		'has_archive' 	=> true,
		'labels'		=> array(
				'name' 			=> 'Products',
				'singular_name' => 'Product',
				'not_found'		=> 'No products found',
				'add_new_item'	=> 'Add New Product',
		),
		'menu_icon'		=> 'dashicons-cart', //look up: dashicons
		'menu_position'	=> 5, //below posts
		'supports'		=> array( 'title', 'editor' , 'thumbnail', 'excerpt', 
								'custom-fields' ),
		'rewrite'		=> array( 'slug' => 'shop' ), //better urls
	) );

	//add the taxonomy "brand" to products
	register_taxonomy( 'brand', 'product', array(
		'hierarchical' 		=> true,
		'show_admin_column'	=> true,
		'labels' 			=> array(
			'name'				=> 'Brands',
			'singular_name'		=> 'Brand',
			'add_new_item'		=> 'Add New Brand',
			'search_items'		=> 'Search Brands',
			'not_found'			=> 'No brands found.',
			'parent_item'		=> 'Parent Brand',
		),
	) );
}


//Flush the permalinks when this plugin is activated 
function mmc_flush(){
	mmc_product_cpt();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'mmc_flush' );

//flush the permalinks again if we ever turn this plugin off
register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

//no close