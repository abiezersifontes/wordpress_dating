<?php
/*
plugin name: Miembros
plugin URI: http://localhost
Description: Permite mostrar los productos en forma de circulo-
Author: Joselyn
Author URI: http://www.codeplus.com.ve
License : GPL2
*/

function show_members(){

$content='<div class="products members">';
$content.='<h1 class="uppercase title_members"><center> <span class= "member_color">miembros</span>  principales</center> </h1>';

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 5
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) :  $loop->the_post();
                $content.= '<div id= "members_circle">';
                $content2 = woocommerce_get_product_thumbnail();
                $content.= $content2;
                $content.= '</div>';
			endwhile;
		} else {
            $content.= __( 'No products found' );
		}
		wp_reset_postdata();

$content.='</div>';
    return $content;
}
add_shortcode('members','show_members');
