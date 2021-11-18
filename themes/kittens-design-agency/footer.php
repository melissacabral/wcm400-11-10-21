		<footer class="footer">
			<?php 
				//step 2 of adding menu areas to our theme. See functions.php
				wp_nav_menu(array(
					'theme_location' 	=> 'footer_menu',
					'container'			=> 'div', 			// wrap with a <div> tag
					'container_class'	=> 'footer-menu',   //<nav class="main-menu">
					'fallback_cb'		=> false, 			//no default menu
				)); ?>
		</footer>
	</div>

<?php wp_footer(); //HOOK. required for admin bar and plugins to work. ?>
</body>
</html>