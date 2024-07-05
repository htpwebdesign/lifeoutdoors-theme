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

        if ( function_exists( 'get_field' ) ) {
            $company_about = get_field('company_about');
            $company_images = get_field('company_images');
            $size = 'large';
            $caption = wp_get_attachment_caption( $image );

            if ($company_about) :
                ?>
                <section class="company-about">
                    <div class="company-description">
                        <?php echo $company_about;?>
                    </div>
                </section>
                <?php
            endif;

            if ($company_images && is_array($company_images)) :
                ?>
                <section class="company-images">
                    <h2>Our Store: Where the Adventure Begins and Outdoor Adventures from Our Founders</h2>
                    <div class="gallery">
                        <?php foreach ($company_images as $image) : ?>
                            <div class="gallery-item">
                                <?php 
                                echo wp_get_attachment_image( $image, $size ); 
                                $caption = wp_get_attachment_caption( $image );
                                if ($caption) :
                                    ?>
                                    <div class="gallery-caption">
                                        <?php echo esc_html($caption); ?>
                                    </div>
                                    <?php
                                endif;
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php
            endif;
        }    

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
