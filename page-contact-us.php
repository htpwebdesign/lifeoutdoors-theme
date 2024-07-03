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
                <p><?php echo wp_kses_post($physical_address); ?></p>
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
                <div id="map" style="height: 450px; width: 600px;"></div>
            <?php else: ?>
                <div id="map" style="height: 450px; width: 600px;"></div>
            <?php endif; ?>

            <!-- Mailchimp Form -->
            <div id="mc_embed_shell">
                <link href="//cdn-images.mailchimp.com/embedcode/classic-061523.css" rel="stylesheet" type="text/css">
                <style type="text/css">
                    #mc_embed_signup{background:#fff; false;clear:left; font:14px Helvetica,Arial,sans-serif; width: 600px;}
                    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                </style>
                <div id="mc_embed_signup">
                    <form action="https://bcitwebdeveloper.us17.list-manage.com/subscribe/post?u=ca84e9592fe90b690293a8f7f&amp;id=a092230ff0&amp;f_id=00edc2e1f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                        <div id="mc_embed_signup_scroll">
                            <h2>Subscribe To The Life Outdoors Newsletter</h2>
                            <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
                            <div class="mc-field-group">
                                <label for="mce-EMAIL">Email Address <span class="asterisk">*</span></label>
                                <input type="email" name="EMAIL" class="required email" id="mce-EMAIL" required="" value="">
                            </div>
                            <div id="mce-responses" class="clear foot">
                                <div class="response" id="mce-error-response" style="display: none;"></div>
                                <div class="response" id="mce-success-response" style="display: none;"></div>
                            </div>
                            <div aria-hidden="true" style="position: absolute; left: -5000px;">
                                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups -->
                                <input type="text" name="b_ca84e9592fe90b690293a8f7f_a092230ff0" tabindex="-1" value="">
                            </div>
                            <div class="optionalParent">
                                <div class="clear foot">
                                    <input type="submit" name="subscribe" id="mc-embedded-subscribe" class="button" value="Subscribe">
                                    <p style="margin: 0px auto;">
                                        <a href="http://eepurl.com/iS_x12" title="Mailchimp - email marketing made easy and fun">
                                            <span style="display: inline-block; background-color: transparent; border-radius: 4px;">
                                                <img class="refferal_badge" src="https://digitalasset.intuit.com/render/content/dam/intuit/mc-fe/en_us/images/intuit-mc-rewards-text-dark.svg" alt="Intuit Mailchimp" style="width: 220px; height: 40px; display: flex; padding: 2px 0px; justify-content: center; align-items: center;">
                                            </span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script>
                <script type="text/javascript">
                    (function($) {
                        window.fnames = new Array(); 
                        window.ftypes = new Array();
                        fnames[0]='EMAIL';ftypes[0]='email';
                        fnames[1]='FNAME';ftypes[1]='text';
                        fnames[2]='LNAME';ftypes[2]='text';
                        fnames[3]='ADDRESS';ftypes[3]='address';
                        fnames[4]='PHONE';ftypes[4]='phone';
                        fnames[5]='BIRTHDAY';ftypes[5]='birthday';
                    }(jQuery));
                    var $mcj = jQuery.noConflict(true);
                </script>
            </div>
            <!-- End of Mailchimp Form Embed Code -->

        </section>

    <?php
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>

<script type="text/javascript">
    function initMap() {
        var defaultLocation = {lat: 49.2682, lng: -123.1487};

        <?php if ($google_map && isset($google_map['lat']) && isset($google_map['lng'])) : ?>
            var location = {
                lat: <?php echo $google_map['lat']; ?>,
                lng: <?php echo $google_map['lng']; ?>
            };
        <?php else: ?>
            var location = defaultLocation;
        <?php endif; ?>

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: location
        });

        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }

    window.onload = function() {
        initMap();
    };
</script>
