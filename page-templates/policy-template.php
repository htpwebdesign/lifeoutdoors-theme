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

        get_template_part( 'template-parts/content', 'page' );


        if ( function_exists( 'get_field' ) ) { 
            $policy_overview = get_field('policy_overview');
            $policy_info = get_field('policy_info');

            if ($policy_overview) :
                ?>
                <section class="policy-overview">
                    <div class="policy-description">
                        <?php echo $policy_overview; ?>
                    </div>
                </section>
                <?php
            endif;

            if ($policy_info && is_array($policy_info)) :
                ?>
                <section class="policy-info">
                    <?php foreach ($policy_info as $info) : ?>
                        <?php if (isset($info['subtitle']) && isset($info['description'])) : ?>
                            <div class="policy-item">
                                <h2><?php echo esc_html($info['subtitle']); ?></h2>
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

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
