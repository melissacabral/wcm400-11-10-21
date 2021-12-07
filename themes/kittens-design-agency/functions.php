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

//add another image size beyond thumbnail, medium and large
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
		'banana_menu' => 'Banana'
	) );
}

/**
 * Handle the pagination on all screens
 */
add_action('loop_end', 'mmc_pagination');
function mmc_pagination($query){
		if( $query->is_main_query() ){
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
	} //end if main loop
}

/**
 * Set up all Widget Areas (dynamic sidebars) for our site
 */
add_action( 'widgets_init', 'mmc_widget_areas' );
function mmc_widget_areas(){
	register_sidebar(array(
		'name' 	=> 'Header Area',
		'id' 	=> 'header_area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
	));
	register_sidebar(array(
		'name' 	=> 'Blog Sidebar',
		'id' 	=> 'blog_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
	));
	register_sidebar(array(
		'name' 	=> 'Shop Sidebar',
		'id' 	=> 'shop_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
	));
	register_sidebar(array(
		'name' 	=> 'Footer Area',
		'id' 	=> 'footer_area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
	));
}
/**
 * Fix the default comment count so it excludes pingbacks and trackbacks
 */
add_filter( 'get_comments_number', 'mmc_comment_count' );
function mmc_comment_count(){
	//"this" post ID
	global $id;
	$comments = get_approved_comments( $id );
	$count = 0;
	foreach( $comments AS $comment ){
		//if it's a real comment, count it
		if( $comment->comment_type == 'comment' ){
			$count ++;
		}
	}
	return $count;
}

/**
 * Count the number of trackbacks and pingbacks on any post
 */
function mmc_pings_count(){
	//"this" post ID
	global $id;
	$comments = get_approved_comments( $id );
	$count = 0;
	foreach( $comments AS $comment ){
		//if it's anything but a real comment, count it
		if( $comment->comment_type != 'comment' ){
			$count ++;
		}
	}
	return $count;
}

/**
 * Improve Comment replies with a little JavaScript
 */
add_action( 'wp_enqueue_scripts', 'mmc_scripts' );
function mmc_scripts(){
	//main css file (style.css)
	wp_enqueue_style( 'mmc-kitten-style', get_stylesheet_uri(), array(), '0.1' );

	//bring the comment form to the user when they reply
	wp_enqueue_script( 'comment-reply' );
}

/**
 * WooCommerce Support
 */

add_action( 'after_setup_theme', 'mmc_woo_setup' );
function mmc_woo_setup(){
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}


//remove the default content wrapper HTML
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

//add our correct content wrapper HTML
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
function my_theme_wrapper_start() {
  echo '<main class="content">';
}
function my_theme_wrapper_end() {
  echo '</main>';
}

/**
 * Theme Customization Options
 * * Header and footer background color
 * * font options
 * @link https://codex.wordpress.org/Theme_Customization_API
 */
add_action('customize_register', 'mmc_customize');
function mmc_customize( $wp_customize ){
	//custom colors (Color panel already exists)
	$wp_customize->add_setting( 'header_bgcolor', array(
		'default' 			=> '#cccccc',
		'sanitize_callback' => 'wp_strip_all_tags',
	) );
	//Control UI - this will make a color picker
	$wp_customize->add_control( new WP_Customize_Color_Control( 
		$wp_customize, 
		'header_bgcolor_control',
		array(
			'label' 	=> 'Header Background Color',
			'section' 	=> 'colors', //built-in to WP
			'settings' 	=> 'header_bgcolor',
		)  ) );

	//footer bg color
	$wp_customize->add_setting( 'footer_bgcolor', array(
		'default' 			=> '#cccccc',
		'sanitize_callback' => 'wp_strip_all_tags',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'footer_bgcolor_control',
		array(
			'label' 	=> 'Footer Background Color',
			'section' 	=> 'colors',
			'settings' 	=> 'footer_bgcolor',
		)	) );

	//Typography section
	$wp_customize->add_section( 'mmc_typography', array(
		'title' 	=> 'Typography',
		'priority' 	=> 30,
	) );
	$wp_customize->add_setting( 'body_font', array(
		'default'			=> 'Roboto',
		'sanitize_callback' => 'wp_strip_all_tags',
	) );
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'body_font_control',
		array(
			'label' 	=> 'Body Font',
			'section' 	=> 'mmc_typography',
			'settings' 	=> 'body_font',
			'type'		=> 'radio', //or text, select, checkboxes, radio, textarea
			'choices'	=> array(
								'Roboto' 		=> 'Roboto - professional',
								'Lato'			=> 'Lato - approachable',
								'Nunito' 		=> 'Nunito - playful',
								'Poppins'		=> 'Poppins - trendy',
								'Merriweather' 	=> 'Merriweather - classical',
							),
		)	) );

} //end customize function


/**
 * Embedded CSS for the customizations
 */
add_action('wp_head', 'mmc_customized_css');
function mmc_customized_css(){
	$footer_color = get_theme_mod( 'footer_bgcolor' );
	?>
	<style>
		.header{
			background-color: <?php echo get_theme_mod( 'header_bgcolor' ); ?>  ;
		}
		.footer{
			background-color: <?php echo $footer_color; ?>  ;
			color: <?php echo mmc_get_contrast( $footer_color ); ?>;
		}
		body{
			font-family: <?php echo get_theme_mod( 'body_font' ); ?>;
		}
	</style>
	<?php
}


/**
 * Enqueue the correct stylesheet for the font choice
 */
add_action( 'wp_enqueue_scripts', 'mmc_google_font' );
function mmc_google_font(){
	$bodyfont = urlencode( get_theme_mod('body_font') );
	$url = "https://fonts.googleapis.com/css2?family=$bodyfont&display=swap";
	wp_enqueue_style('custom_google_font', $url);
}


/**
 * Color contrast function
 * @link https://24ways.org/2010/calculating-color-contrast/
 */
function mmc_get_contrast($hexcolor = ''){
	//remove the # character to avoid deprecated notice 
	$hexcolor = str_replace('#', '', $hexcolor);	
	$r = hexdec(substr($hexcolor,0,2));
	$g = hexdec(substr($hexcolor,2,2));
	$b = hexdec(substr($hexcolor,4,2));
	$yiq = (($r*299)+($g*587)+($b*114))/1000;
	return ($yiq >= 128) ? 'black' : 'white';
}



//no close PHP