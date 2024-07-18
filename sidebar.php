<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Life_Outdoors
 */

 if ( ! is_active_sidebar( 'sidebar-1' )  || ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<?php
if ( is_product_category() ) {
    // For  taxonomy-product-cat.php template Product category page
    dynamic_sidebar( 'sidebar-1' ); // sidebar-1 for product category
} elseif ( is_post_type_archive( 'product' ) ) {
    // For archive-product.php template Shop page
    dynamic_sidebar( 'sidebar-2' ); 
} 
?>

</aside><!-- #secondary -->
