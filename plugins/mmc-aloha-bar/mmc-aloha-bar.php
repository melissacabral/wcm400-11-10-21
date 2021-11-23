<?php
/*
Plugin Name: MMC Aloha Bar
Description: Adds a promotional announcement bar at the top of the site
Author: Melissa Cabral
Version: 0.1
License: GPLv3
Plugin URI: http://melissacabral.com/plugin-info
Author URI: http://melissacabral.com


Any other notes or comments can go here
*/


/**
 * HTML output
 */
add_action( 'wp_footer', 'mmc_aloha_html' );
function mmc_aloha_html(){
	?>
	<!-- Aloha Bar by Melissa Cabral -->
	<div id="mmc-aloha-bar">
		<span class="mmc-aloha-message">
			This is the call to action message
		</span>
		<a href="#" class="mmc-aloha-button">Click Here!</a>
	</div>
	<!-- End Aloha Bar -->
	<?php
}

/**
 * Load all css and js for the plugin
 */
add_action( 'wp_enqueue_scripts', 'mmc_aloha_scripts' );
function mmc_aloha_scripts(){
	//external file URL
	$url = plugins_url( 'css/mmc-aloha-style.css', __FILE__ );
	wp_enqueue_style( 'mmc-aloha-stylesheet', $url );

	//add jquery
	wp_enqueue_script( 'jquery' );

	//external script file
	$url = plugins_url( 'js/mmc-aloha-script.js', __FILE__ );
	//					handle, 			url, dependencies,	ver, in footer?
	wp_enqueue_script( 'mmc-aloha-script', $url, array('jquery'), 0.1, true  );
}


/**
 * Trying out some admin nags!

 */
add_action( 'admin_notices', 'mmc_admin_notice__success' );
function mmc_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p>I recommend you get Autoptimize! It's awesome</p>
    </div>
    <?php
}


//no close php