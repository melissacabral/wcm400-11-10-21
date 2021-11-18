<!DOCTYPE html>
<html lang="en-us">
<head>
  <?php wp_head(); //HOOK. required for the admin bar and plugins to work ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
	
	<style type="text/css">
		/* custom header: see functions.php */
		.header{
			background-image: url(<?php header_image(); ?>);
			background-size: cover;
			background-position: center center;
		}
	</style>

</head>
<body <?php body_class(); ?>>
	<div class="site">
		<header class="header header-home">
			<div class="branding">
				<?php 
				//custom logo activated in functions.php
				the_custom_logo(); 
				?>
				<h1 class="site-title">
					<a href="<?php echo home_url(); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<h2><?php bloginfo( 'description' ); ?></h2>
			</div>

			<div class="navigation">
				<?php 
				//step 2 of adding menu areas to our theme. See functions.php
				wp_nav_menu(array(
					'theme_location' 	=> 'main_menu',
					'container'				=> 'nav', 			// wrap with a <nav> tag
					'container_class'	=> 'main-menu', //<nav class="main-menu">
				)); ?>
			</div>

			<div class="utilities">
				<?php 
				//when using a function from any plugin, check to see if it's active first
				if( function_exists('mmc_social_icons') ){
					mmc_social_icons();
				}
				?>

				<!-- Utility menu will go here -->
				<ul>
					<li><?php wp_loginout( home_url() ); ?></li>
				</ul>
				<?php //if the current user is not logged in, show the login form
				if( ! is_user_logged_in() ){
					wp_login_form();
				} 
				?>
			</div>
		</header>

