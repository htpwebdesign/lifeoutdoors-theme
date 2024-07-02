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

        $home_slider = get_field('hero_images');

        if ($home_slider && is_array($home_slider)) :
            ?>
            <section class="image-slider">
                <?php foreach ($home_slider as $image) : ?>
                    <div class="slide">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    </div>
                <?php endforeach; ?>
            </section>
            <?php
        endif;

        echo '<section class="products-by-categories"><h2>Products by Categories</h2><div class="category-products">';

        $categories = get_terms('product_cat', array('hide_empty' => true));
        if ( ! empty($categories) && ! is_wp_error($categories) ) {
            $categories = array_slice($categories, 0, 4);
            foreach ($categories as $category) {
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 1,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => $category->slug,
                        ),
                    ),
                );
                $product_query = new WP_Query( $args );
                if ( $product_query->have_posts() ) {
                    while ( $product_query->have_posts() ) {
                        $product_query->the_post();
                        echo '<div class="single-product">';
                        echo '<a href="' . get_permalink() . '">';
                        echo woocommerce_get_product_thumbnail();
                        echo '<h3>' . get_the_title() . '</h3>';
                        echo '</a>';
                        echo '</div>';
                    }
                    wp_reset_postdata();
                }
            }
        }

        echo '</div></section>';

        echo '<section class="on-sale-products"><h2>On Sale</h2><div class="on-sale-slider">';

        $on_sale_args = array(
            'post_type'      => 'product',
            'posts_per_page' => 4,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_tag',
                    'field'    => 'slug',
                    'terms'    => 'on-sale',
                ),
            ),
        );
        $on_sale_query = new WP_Query( $on_sale_args );
        if ( $on_sale_query->have_posts() ) {
            while ( $on_sale_query->have_posts() ) {
                $on_sale_query->the_post();
                echo '<div class="single-sale-product">';
                echo '<a href="' . get_permalink() . '">';
                echo woocommerce_get_product_thumbnail();
                echo '<h3>' . get_the_title() . '</h3>';
                echo '</a>';
                echo '<span class="price">' . $product->get_price_html() . '</span>';
                woocommerce_template_loop_add_to_cart();
                echo '</div>';
            }
            wp_reset_postdata();
        }

        echo '</div></section>';

        echo '<section class="workshops-this-month"><h2>Workshops This Month</h2><div class="workshop-list">';

        $current_month = date('m');
        $current_year = date('Y');

        $first_day_of_month = "$current_year-$current_month-01";
        $last_day_of_month = date("Y-m-t", strtotime($first_day_of_month));

        $workshop_args = array(
            'post_type'      => 'event', 
            'posts_per_page' => -1,
            'meta_query'     => array(
                array(
                    'key'     => 'workshop_date', 
                    'value'   => array($first_day_of_month, $last_day_of_month),
                    'compare' => 'BETWEEN',
                    'type'    => 'DATE'
                )
            )
        );

        $workshop_query = new WP_Query( $workshop_args );
        if ( $workshop_query->have_posts() ) {
            while ( $workshop_query->have_posts() ) {
                $workshop_query->the_post();

                $workshop_date = get_post_meta(get_the_ID(), 'workshop_date', true);
                echo '<div class="single-workshop">';
                echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                echo '<span class="workshop-date">' . date('F j, Y', strtotime($workshop_date)) . '</span>';
                echo '<div class="workshop-excerpt">' . get_the_excerpt() . '</div>';
                echo '</div>';
            }
            wp_reset_postdata();
        } else {
            echo '<p>No workshops scheduled for this month.</p>';
        }
        echo '</div></section>';

        // Custom query to display testimonials
        $args = array(
            'post_type'      => 'out-testimonial',
            'posts_per_page' => 3,
        );
        $query = new WP_Query( $args );
        if ( $query -> have_posts() ){
        echo '<h2>Testimonials</h2><section class="testimonials">';
            while ( $query -> have_posts() ) {
                $query -> the_post();
                the_content();
            }
            wp_reset_postdata();
        echo '</section>';    
        }

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
