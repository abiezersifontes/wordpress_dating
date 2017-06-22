<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


global $product, $woocommerce_loop;

// Repeater styles
$type = flatsome_option('related_products');
if($type == 'hidden') return;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if(flatsome_option('max_related_products')) $posts_per_page = flatsome_option('max_related_products');

$related = get_related_custom($product->id);

if ( sizeof( $related ) === 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 5,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

if($type == 'grid') $type = 'row';

// Disable slider if less than selected products pr row. 
if ( sizeof( $related ) < (flatsome_option('related_products_pr_row')+1) ) {
	$type = 'row';
}

$repater['type'] = $type;
$repater['columns'] = flatsome_option('related_products_pr_row');
$repater['slider_style'] = 'reveal';
$repater['row_spacing'] = 'small';

if ( $products->have_posts() ) : ?>

	<div class="related related-products-wrapper product-section">

		<h5 class="product-section-title product-section-title-related pt-half pb-half uppercase related"><?php _e( 'personas que quizás te interesen', 'woocommerce' ); ?></h5>

			<?php echo get_flatsome_repeater_start($repater); ?>
			
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
        <div class="col">
              <div class="col-inner ">
                <div class="badge-container absolute left top z-1">
                </div>
                <div class="product-small box has-hover box-shade dark box-text-bottom">
                <div class="box-image">
                  <div class="image-cover" style="padding-top:150%;">
                    <a  href="<?php echo get_permalink();?>">
                      <?php echo woocommerce_get_product_thumbnail(); ?>
                    </a>
                       <div class="shade">
                   </div>
                  </div>
                  <div class="image-tools z-top top right show-on-hover">
                  </div>
                  </div><!-- box-image -->
                <div class="box-text text-center is-xlarge">
                    <div class="title-wrapper "><p class="name product-title "><a class= "nombre_relacionado" href="<?php echo get_permalink();?>"><?php do_action('title_related');?></a></p></div><div class="price-wrapper"></div><div class="overlay-tools vista">  <a class="quick-view" data-prod="504" href="#quick-view">Iniciar chat</a></div>
                </div> <!-- box-text -->
              </div><!-- box -->
            </div><!-- .col-inner -->
          </div>
			
			<?php /* wc_get_template_part( 'content', 'product' );*/ ?>

			<?php endwhile; // end of the loop. ?>

			<?php echo get_flatsome_repeater_end($repater); ?>


	</div><!-- .related-products-wrapper -->
<?php endif;

wp_reset_postdata(); 
