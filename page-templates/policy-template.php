<?php
/**
 * Template Name: Policy Template
 * 
 * The template for displaying the policy pages.
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
        <article class="policy-template" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
                // Check if the Advanced Custom Fields function exists.
                if ( function_exists( 'get_field' ) ) { 
                    // Get fields values and display content if it exists. 
                    $policy_overview = get_field('policy_overview');
                    $policy_info = get_field('policy_info');

                    if ( $policy_overview ) :
                ?>
                        <section class="policy-overview">
                            <div class="policy-description">
                                <?php echo $policy_overview; ?>
                            </div>
                        </section>
                <?php
                    endif;

                    if ( $policy_info && is_array( $policy_info ) ) :
                ?>
                        <section class="policy-info">
                            <?php foreach ( $policy_info as $info ) : ?>
                                <?php if ( isset( $info['subtitle'] ) && isset( $info['description'] ) ) : ?>
                                    <div class="policy-item">
                                        <h2><?php echo esc_html( $info['subtitle'] ); ?></h2>
                                        <div class="policy-description">
                                            <?php echo $info['description']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
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