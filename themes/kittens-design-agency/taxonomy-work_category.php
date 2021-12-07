<?php get_header(); //requires header.php ?>
		<main class="content">
			<section class="page-title">
				<h1><?php _e('Portfolio', 'kittens-design-agency') ?> 
				<?php single_cat_title( ' - ' ) ?></h1>

				<ul>
					<li>
						<a href="<?php echo get_post_type_archive_link( 'work' ); ?>">
						View All
						</a>
					</li>
					<?php 
					//show all the terms in our custom taxonomy
					wp_list_categories( array(
						'title_li'	=> '',
						'taxonomy'	=> 'work_category',
					) ); ?>
				</ul>
			</section>

			<?php //The Loop
			if( have_posts() ){	
				while( have_posts() ){	
					the_post();
			?>

			<article <?php post_class('clearfix'); ?>>
				<div class="cover-image">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('banner'); ?>

						<h2 class="entry-title">
							<?php the_title(); ?>
						</h2>
						
	<?php the_terms( $post->id, 'work_category', '<h3 class="category">', ', ', '</h3>' ); ?>
						
					</a>
				</div>
				<div class="entry-content">
					<?php the_excerpt(); ?>
				</div>
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
		

<?php get_footer();  //require footer.php ?>