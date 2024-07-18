<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Life_Outdoors
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! Page can&rsquo;t be found.', 'lifeoutdoors-theme' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( "It looks like the page you are looking for doesn't exist. But don't worry, you can continue shopping by clicking the link below.", 'lifeoutdoors-theme' ); ?></p>
			</div>
            <a class="continue-shopping" href="<?php echo esc_url( home_url() ); ?>">Continue Shopping</a>
					
					<!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
