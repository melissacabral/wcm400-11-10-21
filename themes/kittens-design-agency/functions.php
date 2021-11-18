<?php 
//activate "sleeping" features

//SEO-friendly titles (there should be no <title> in your header code)
add_theme_support('title-tag');

//if you have a blog, you need this
add_theme_support( 'automatic-feed-links' );

//upgrade forms and other output to HTML5
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

//Post Formats (tumblr-style)
add_theme_support('post-formats', array('image', 'video', 'link', 'quote'));


//Custom body background image and color
add_theme_support('custom-background');

//Custom Header Image: see header.php for CSS implementation
$args = array(
	'width' => 1600,
	'height' => 1024,
	'flex-width' => true,
	'flex-height' => true,
);
add_theme_support('custom-header', $args);

//Custom Logo
$args = array(
	'width' => 300,
	'height' => 300,
	'flex-width' => true,
	'flex-height' => true,
);
add_theme_support('custom-logo', $args);

//post thumbnails (featured images)
add_theme_support('post-thumbnails');

//add another image size beyond thumbnail, medoum and large
add_image_size( 'banner', 1600, 400, true);


// Example of using a hook - Change the length of the default excerpt
function mmc_excerpt_length(){
	//how to combine hooks with conditionals
	if( is_search() ){
		return 10;
	}else{
		return 65; //words
	}
}
add_filter( 'excerpt_length', 'mmc_excerpt_length' );

//make the [...] better with a read more button
function mmc_readmore(){
	$url = get_permalink();
	return "&hellip; <a href='$url' class='button button-outline'>Read More</a>";
}
add_filter( 'excerpt_more', 'mmc_readmore' );

//Example showing admin panel changes
function mmc_admin_footer(){
	return 'Thanks for using the Kitten Agency theme';
}
add_filter( 'admin_footer_text', 'mmc_admin_footer' );

//example of using an action hook (breadcrumbs)
function mmc_breadcrumb(){
	 echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        single_cat_title();
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}
//add_action( 'loop_start', 'mmc_breadcrumb' );
//add_action( 'loop_end', 'mmc_breadcrumb' );

/**
 * Set up menu areas
 * This is step 1 of 3: Register it!
 * Use wp_nav_menu to display menus in your template
 */
add_action( 'init', 'mmc_menu_areas' );
function mmc_menu_areas(){
	register_nav_menus( array(
		'main_menu' => 'Main Menu',
		'footer_menu' => 'Footer Menu',
	) );
}

/**
 * Handle the pagination on all screens
 */
add_action('loop_end', 'mmc_pagination');
function mmc_pagination(){
	echo '<section class="pagination">';

	//use is_singular() if you want this to show up on pages
	if( is_single() ){
		//single links
		previous_post_link('%link', '&larr; %title');
		next_post_link('%link', '%title &rarr;');
	}else{
		//archive links. use simple next/prev buttons if on mobile
		if( wp_is_mobile() ){
			previous_posts_link('&larr; Newer Posts');
			next_posts_link('Older Posts &rarr;');
		}else{
			//numbered pagination if on desktop
			the_posts_pagination();
		}
	}
	echo '</section>';
}

//no close PHP