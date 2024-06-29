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
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'lifeoutdoors-theme' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'lifeoutdoors-theme' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'lifeoutdoors-theme' ), 'lifeoutdoors-theme', '<a href="https://wp.bcitwebdeveloper.ca/">FWD 37 - Team 5</a>' );
				?>

         <!-- Display footer menus        -->

        <div class="footer-menus">
            <nav id="footer-navigation" class="footer-navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-left') ); ?>
            </nav>     
            <nav id="footer-navigation" class="footer-navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-right') ); ?>
            </nav>		
		</div><!-- .footer-menus -->
        
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
