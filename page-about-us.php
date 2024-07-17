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
    ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="featureimage">
                        <?php the_post_thumbnail(); ?>
                    </div>
                <?php endif; ?>
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">

                <?php
                if ( function_exists( 'get_field' ) ) {
                    $company_about = get_field('company_about');
                    $company_images = get_field('company_images');

                    if ( $company_about ) :
                ?>
                        <section class="company-about">
                            <div class="company-description">
                                <?php echo $company_about; ?>
                            </div>
                        </section>
                <?php
                    endif;

                    if ( $company_images && is_array($company_images) ) :
                ?>
                        <section class="company-images">
                            <h2>Our Store: Where the Adventure Begins and Outdoor Adventures from Our Founders</h2>
                            <div class="gallery">
                                <?php foreach ( $company_images as $image ) : ?>
                                    <div class="gallery-item">
                                        <?php 
                                        $size = 'large';
                                        echo wp_get_attachment_image( $image, $size ); 
                                        $caption = wp_get_attachment_caption( $image );
                                        if ( $caption ) :
                                        ?>
                                            <div class="gallery-caption">
                                                <?php echo esc_html( $caption ); ?>
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
                ?>

            </div><!-- .entry-content -->        

        </article><!-- #post -->

    <?php
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
