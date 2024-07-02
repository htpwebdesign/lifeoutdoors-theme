<?php
/**
 * The template for displaying the About Us page
 *
 * This is the template that displays the About Us page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Life_Outdoors
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        $company_about = get_field('company_about');
        $company_images = get_field('company_images');

        if ($company_about) :
            ?>
            <section class="company-about">
                <h2>About the Company</h2>
                <div class="company-description">
                    <?php echo $company_about;?>
                </div>
            </section>
            <?php
        endif;

        if ($company_images && is_array($company_images)) :
			?>
			<section class="company-images">
				<h2>Company Images</h2>
				<div class="gallery">
					<?php foreach ($company_images as $image) : ?>
						<?php if (is_array($image)) :  ?>
							<div class="gallery-item">
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
			</section>
			<?php
		endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
