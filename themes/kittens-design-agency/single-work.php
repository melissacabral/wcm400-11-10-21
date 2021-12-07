<?php get_header(); //requires header.php ?>
		<main class="content">

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

					<?php 
					//show the work categories applied to this post
					//			$id, 		$taxo, 		$before, $between, $after
					the_terms( $post->id, 'work_category', '<h3>' , ', ', '</h3>' ); ?>

					
						
						<?php 
						//ACF demo - check to make sure the ACF plugin is running first
						if( function_exists('get_field') ){
							$client = get_field('client');
							if($client){ ?>
							<h3 class="client-name">
								<?php echo $client; ?> 
							</h3>
							<?php 
							} //end if client exists
						} //end if ACF
						?>

					</a>
				</div>
				
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages(); //if paginated content ?>

					<?php 
					//show the skills as a list
	$title = __('Skills', 'kittens-design-agency');
	the_terms( $post->id, 'skill', "<h3>$title</h3><ul><li>" , '</li><li>', '</li></ul>' ); ?>
				</div>
				
			</article>
			<!-- end .post -->


			<?php 
				} //end while
			}else{ ?>

				<h2>No Portfolio Piece to show</h2>

			<?php } //end of The Loop ?>

			
		</main>
		<!-- end .content -->
		

<?php get_footer();  //require footer.php ?>