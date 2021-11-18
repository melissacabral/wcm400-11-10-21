		<footer class="footer">
			<?php 
				//step 2 of adding menu areas to our theme. See functions.php
				wp_nav_menu(array(
					'theme_location' 	=> 'footer_menu',
					'container'			=> 'div', 			// wrap with a <div> tag
					'container_class'	=> 'footer-menu',   //<div class="footer-menu">
					'fallback_cb'		=> false, 			//no default menu
				)); ?>

			<div class="footer-widgets">
				<?php 
				//step 2 of widget areas (step 1 is in functions.php)
				dynamic_sidebar('footer_area'); ?>
			</div>
		</footer>
	</div>

<?php wp_footer(); //HOOK. required for admin bar and plugins to work. ?>
</body>
</html>