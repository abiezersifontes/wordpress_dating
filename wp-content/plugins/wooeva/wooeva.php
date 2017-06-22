<?php

/**
 * Plugin Name: WooEva
 * Plugin URI:  http://codeplus.com.ve/
 * Description: Personalizaciones de woocommerce para EvaVenezuela.
 * Author:      Abiezer
 * Author URI:  http://codeplus.com.ve/
 * Version:     0.1
 * License:     GPL
 */

// function auto_mensaje(){
//   global $product;
//   echo $product->get_sku();
// }
// add_action('wp','auto_mensaje');
//add_action('wc_add_to_cart_message','auto_mensaje')

add_action('wp_print_styles','estilos_wooeva');

function estilos_wooeva(){
  wp_enqueue_style( 'estilos_WooEva-css',  plugins_url() .'/wooeva/includes/css/wooeva.css');
  wp_enqueue_style( 'WooEva_jqueryui-css',  plugins_url() .'/wooeva/includes/js/jquery-ui/jquery-ui.css');
}

function jqueryui(){
    wp_register_script('jqueryui-js',plugins_url().'/wooeva/includes/js/jquery-ui/jquery-ui.js',array('jquery'));
    wp_enqueue_script('jquery');
    wp_enqueue_script('jqueryui-js');
}

add_action('wp_head','jqueryui');


function user_for_product( $post_id ) {

	// If this is just a revision, don't send the email.
	if ( wp_is_post_revision( $post_id ) ){
    return;
  }

    $product_id = $post_id;
    $product_name = get_the_title( $post_id );
    $product_preference = get_field('preferencia',$product_id,'string');
    $email = get_field('correo',$product_id,'string');
    $status_post = get_post_status($post_id);
    $type_post = get_post_type($post_id);
    $product_user_id = get_post_meta($post_id,'user_id');

    $pass = '123';
    /*

    */

    if($status_post == 'publish'):
      if($type_post == 'product'):
        $valid = validar_usuario($product_name, $email,$pass,$product_preference);

      if($valid['cod'] == 7){

            $user = registrar_usuario($product_name, $email, $pass, $product_preference, $product_id);
            aniadir_campo_producto($product_id,'user_id',$user['id']);

            aniadir_campo_producto($product_id,'_sold_individually','yes');

            $id_carousel = registrar_carrusel($user['id']);
            aniadir_campo_usuario($user['id'],'carousel_id',$id_carousel);
        }
      endif;
    endif;
}
add_action( 'save_post', 'user_for_product' );



function aniadir_campo_usuario($id, $campo, $valor){
  $valor_registrado = get_user_meta($id,$campo);
  if(isset($valor_registrado) and !empty($valor_registrado)):
    update_user_meta($id,$campo,$valor);
  else:
    add_user_meta($id,$campo,$valor);
  endif;
}

function aniadir_campo_producto($id,$campo,$valor){
  $valor_registrado = get_post_meta($id,$campo);
  if(isset($valor_registrado) and !empty($valor_registrado)):
    update_post_meta($id,$campo,$valor);
  else:
    add_post_meta( $id, $campo,$valor);
  endif;
}

function comprar_solo_uno($post_id){
  aniadir_campo_producto($post_id,'_sold_individually','yes');
}
add_action('wp_insert_post','comprar_solo_uno');

// function myavatar_add_default_avatar( $url )
// {
//   return get_stylesheet_directory_uri() .'/screenshot.png';
// }
// //add_action('wp','myavatar_add_default_avatar');
// add_filter( 'bp_core_mysteryman_src', 'myavatar_add_default_avatar' );

// function prueba(){
//   $args = array(
//     'item_id'       => 57,
//     'original_file' => plugins_url() .'/wooeva/grid.png',
//     'crop_x'        => '500px',
//     'crop_y'        => '500px',
//     'crop_w'        => '500px',
//     'crop_h'        => '500px'
//   );
//
//   if ( ! bp_core_avatar_handle_crop( $args ) ) {
//     echo "la imagen ha sifo cambiada";
//   } else {
//     echo "la imagen no se cambio";
//   }
//
//   $args = array(
//     'item_id' => 57,
//     'object' => 'user',
//     'type' => 'string'
//   );
//
//   // NOTICE! Understand what this does before running.
//   $result = bp_core_fetch_avatar($args);
// }
//
// add_action('wp','prueba');

//redireccion temporal desde myaccount
function redir(){
  global $wp;
  $checkout = get_site_url() . '/my-account';
  $current_url = home_url(add_query_arg(array(),$wp->request));
  if($checkout == $current_url){
    $user = get_userdata( get_current_user_id() );
    wp_redirect( home_url() . '/perfil/' . $user->user_login);
  }
}

add_action('template_redirect','redir');
?>
