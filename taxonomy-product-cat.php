<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life_Outdoors
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php

			$terms = wp_get_post_terms(get_the_ID(), 'product-category');

			if ($terms && ! is_wp_error($terms)) :
				foreach ($terms as $term) {
					$args = array(
						'post_type' => 'product-category',
						'tax_query' => array(
							array(
								'taxonomy' =>'product-category',
								'field'	   => 'slug',
								'terms'    => $term->slug,
							),
						),
						'orderby' => 'title',
						'order'	  => 'ASC',
					);
		
					$query = new WP_Query( $args );

					if ( $query->have_posts() ) :
						echo '<section class="taxonomy-product-section">';
						while ( $query->have_posts() ) {
							$query->the_post();
							get_template_part( 'template-parts/content', get_post_type() );
						}
						echo '</section>';
						wp_reset_postdata();
					endif; 
				}
			endif;
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
