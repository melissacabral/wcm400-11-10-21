<?php 
/*
Plugin Name: MMC Portfolio CPT
Description: Sets up Custom Post Types for our Portfolio Pieces
Author: Melissa Cabral
Version: 0.1
License: GPLv3
 */

add_action('init', 'mmc_portfolio_setup');
function mmc_portfolio_setup(){
	register_post_type( 'work', array(
		'public' 		=> true,
		// 'exclude_from_search' => true, 
		'has_archive' 	=> true,
		'label'			=> 'Portfolio', 
		'menu_position'	=> 5,
		'menu_icon'		=> 'dashicons-portfolio', //choose a dashicon
		'show_in_rest'	=> true, //activate block editor
		'supports'		=> array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 
									'custom-fields' 
								),
		'labels'		=> array( 
								'singular_name' => 'Portfolio Piece',
								'name'			=> 'Portfolio',
								'not_found'		=> 'No portfolio pieces found',
								'view_items'	=> 'View Portfolio',
								'view_item'		=> 'View Portfolio Piece',
							 	),
		'rewrite'		=> array( 'slug' => 'portfolio' ), 
	) );
}