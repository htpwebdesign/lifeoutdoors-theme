<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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

        $title_address = get_field('title_adress');
        $title_hours = get_field('title_hours');
        $physical_address = get_field('physical_address');
        $store_hours = get_field('our_store_ours');
        $phone = get_field('phone');
        $fax = get_field('fax');
        $google_map = get_field('google_map');
    ?>

        <section class="contact-info">
            <?php if ($title_address) : ?>
                <h2><?php echo esc_html($title_address); ?></h2>
            <?php endif; ?>

            <?php if ($physical_address) : ?>
                <p><?php echo esc_html($physical_address); ?></p>
            <?php endif; ?>

            <?php if ($title_hours) : ?>
                <h2><?php echo esc_html($title_hours); ?></h2>
            <?php endif; ?>

            <?php if ($store_hours && is_array($store_hours)) : ?>
    			<div class="store-hours">
        			<?php foreach ($store_hours as $hour) : ?>
            			<?php if (isset($hour['week_days']) && isset($hour['hours']) && is_array($hour['hours'])) : ?>
                			<p><?php echo esc_html($hour['week_days']); ?>: 
                    			<?php echo implode(', ', array_map('esc_html', $hour['hours'])); ?>
                			</p>
            			<?php endif; ?>
        			<?php endforeach; ?>
    			</div>
			<?php endif; ?>

            <?php if ($phone) : ?>
                <p><?php echo esc_html($phone); ?></p>
            <?php endif; ?>

            <?php if ($fax) : ?>
                <p><?php echo esc_html($fax); ?></p>
            <?php endif; ?>

            <?php if ($google_map && isset($google_map['lat']) && isset($google_map['lng'])) : ?>
    			<div class="google-map">
        			<iframe src="https://www.google.com/maps/embed/v1/view?key=AIzaSyCIhWznK-Bo47A6t_UAoJBLOGH9OUAzut4&center=<?php echo esc_attr($google_map['lat']); ?>,<?php echo esc_attr($google_map['lng']); ?>&zoom=14" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    			</div>
			<?php endif; ?>
        </section>

    <?php
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
