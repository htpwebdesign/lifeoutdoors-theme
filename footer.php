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
					<h2>Contacts</h2>
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
					<h2>Policies</h2>
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
				<h2>
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'lifeoutdoors-theme' ), 'lifeoutdoors-theme', '<a href="https://wp.bcitwebdeveloper.ca/">FWD 37 - Team 5</a>' );
				?>
				</h2>
				<p>Dani Melo, Tyler Whitman, Yasin Colak, Danny Kim<br>Educational Purpose Only</p>
				
			</nav>
            		
		</div><!-- .footer-menus -->
        
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
