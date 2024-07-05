<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Life_Outdoors
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			
         <!-- Display footer menus        -->

        <div class="footer-menus">
			<div class="footer-left">
				<?php
				the_custom_logo();
				?>
			</div>
			<nav class="footer-center">
				<div class="footer-center-1">
					<h3>Contacts</h3>
					<?php
                	wp_nav_menu(
                    	array(
                        	'theme_location' => 'footer-center',
                        	'menu_id'        => 'footer-center-items',
                    	)
                	);
                	?>
				</div>
				<div class="footer-center-2">
					<h3>Policies</h3>
					<?php
                	wp_nav_menu(
                    	array(
                        	'theme_location' => 'footer-center-2',
                        	'menu_id'        => 'footer-center-2-items',
                    	)
                	);
                	?>
				</div>
			</nav>
			<nav class="footer-right">
				<?php
                	wp_nav_menu(
                    	array(
                        	'theme_location' => 'footer-right',
                        	'menu_id'        => 'footer-right-items',
                    	)
                	);
                	?>
				<p>Created by Dani Melo, Tyler Whitman, Yasin Colak, Danny Kim<br>Educational Purpose Only</p>
			</nav>
            		
		</div><!-- .footer-menus -->
        
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
