<?php get_header(); //requires header.php ?>
		<main class="content">

			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<article <?php post_class('clearfix'); ?>>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<?php 
				//activate featured image
				the_post_thumbnail('medium'); ?>
				<div class="entry-content">
					<?php 
					//show the full content on singular posts, otherwise show short content
					if( is_singular() OR has_post_format( 'quote' ) ){
						the_content();
					}else{
						//first 55 words of the post by default
						the_excerpt();
					} ?>
				</div>
				<div class="postmeta">
					<span class="author">by: <?php the_author(); ?> </span>
					<span class="date"> <?php the_time('F j, Y'); ?> </span>
					<span class="num-comments"><?php comments_number(); ?></span>
					<span class="categories"><?php the_category(); ?></span>
					<?php the_tags('<span class="tags">', ', ', '</span>'); ?>
				</div>
				<!-- end .postmeta -->
			</article>
			<!-- end .post -->

			<?php comments_template(); ?>

			<?php 
				} //end while
			}else{ ?>

				<h2>No Posts to show</h2>

			<?php } //end of The Loop ?>
			
			
		</main>
		<!-- end .content -->
		
<?php get_sidebar(); //require sidebar.php ?>		
<?php get_footer();  //require footer.php ?>