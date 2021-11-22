<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>  
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); //HOOK. required for the admin bar and plugins to work ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	
	<style type="text/css">
		/* custom header: see functions.php */
		.header{
			background-image: url(<?php header_image(); ?>);
			background-size: cover;
			background-position: center center;
			color: #<?php header_textcolor() ?>;
		}
	</style>

</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); //required hook  ?>
	<div class="site">
		<header class="header">
			<div class="branding">
				<?php 
				//custom logo activated in functions.php
				the_custom_logo(); 
				?>
				<h1 class="site-title">
					<a href="<?php echo esc_url(home_url()); ?>">
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

