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

        echo '<h1 class="screen-reader-text">' . get_the_title() . '</h1>';

        //  Display hero images
        if ( function_exists( 'get_field' ) ) {
            $home_slider = get_field('hero_images');
            $size = '1536x1536';

            if ($home_slider && is_array($home_slider)) :
                ?>
                <section class="image-slider">
                    <?php foreach ($home_slider as $image) : ?>
                        <div class="slide">
                        <?php echo wp_get_attachment_image( $image, $size ); ?>
                        </div>
                    <?php endforeach; ?>
                </section>
                <?php
            endif;
        }   

        // Display products by categories
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
                        echo '<article class="single-product">';
                        echo '<a href="' . get_permalink() . '">';
                        echo woocommerce_get_product_thumbnail();
                        echo '<h3>' . get_the_title() . '</h3>';
                        echo '</a>';
                        echo '</article>';
                    }
                    wp_reset_postdata();
                }
            }
        }

        echo '</div></section>';

        // Display on sale products
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
                echo '<article class="single-sale-product">';
                echo '<a href="' . get_permalink() . '">';
                echo woocommerce_get_product_thumbnail();
                echo '<h3>' . get_the_title() . '</h3>';
                echo '</a>';
                echo '<span class="price">' . $product->get_price_html() . '</span>';
                woocommerce_template_loop_add_to_cart();
                echo '</article>';
            }
            wp_reset_postdata();
        }

        echo '</div></section>';

      // Display workshops
      echo '<section class="workshops-this-month"><h2>Workshops</h2><div class="workshop-list">';

      $recent_workshops_args = array(
          'post_type'      => 'tribe_events', 
          'posts_per_page' => 3,
          'orderby'        => 'date',
          'order'          => 'DESC',
      );

      $recent_workshops_query = new WP_Query( $recent_workshops_args );

      if ( $recent_workshops_query->have_posts() ) {
          while ( $recent_workshops_query->have_posts() ) {
              $recent_workshops_query->the_post();

              echo '<article class="single-workshop">';
              echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
              echo '<div class="workshop-excerpt">' . get_the_excerpt() . '</div>';
              echo '</article>';
          }
          wp_reset_postdata();
      } else {
          echo '<p>No workshops found.</p>';
      }

      echo '</div></section>';


        // Custom query to display testimonials
        $args = array(
            'post_type'      => 'out-testimonial',
            'posts_per_page' => 3,
        );
        $query = new WP_Query( $args );
        if ( $query -> have_posts() ){
        echo '<section class="testimonials"><h2>Testimonials</h2>';
            echo '<div class="testimonials-container">';
                while ( $query -> have_posts() ) {
                    $query -> the_post();
                    the_content();
                }
                wp_reset_postdata();
            echo '</div>';
        echo '</section>';    
        }

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
