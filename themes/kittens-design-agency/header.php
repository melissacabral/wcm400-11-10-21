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
		<header class="header">
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
				<?php dynamic_sidebar( 'header_area' ); ?>
			</div>		
		</header>

