<?php 
/*
Template Part - Header
The basic header that appears on every page
*/ 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php wp_head(); //REQUIRED HOOK. Makes the admin bar and plugins work with our theme ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo('name'); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body>
<div class="site">
  <header class="header">
    <div class="header-bar">
      <h1 class="site-title">
      	<a href="<?php echo home_url(); ?>">
      	<?php bloginfo('name'); ?>      		
      	</a>
      </h1>
      <h2><?php bloginfo('description'); ?></h2>
      <nav>
        <ul class="menu">
         <?php wp_list_pages(array(
         	'title_li' => '',
         )); ?>
        </ul>
      </nav>

     <?php get_search_form(); //get the default search form or searchform.php ?>

    </div>
  </header>