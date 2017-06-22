<?php

require_once('formularios.php');

// Add custom Theme Functions here

function plugin(){
    if ( function_exists( 'woocommerce_product_search' ) ) {
      echo woocommerce_product_search();

    } else {

        echo 'no esta el plugin';
    }
}

add_shortcode('plug','plugin');

add_action('wp_head','first_script');

add_action('wp_ajax_imprimir','imprimir_process');
add_action('wp_ajax_nopriv_imprimir','imprimir_process');

/******************************************
*no mosrar el menu si no estas en el home
*******************************************/
add_action('wp_head','limitar_menu');
if(!function_exists('limitar_menu')){
  function limitar_menu($content){

    if(is_home() or is_front_page()){
      ?>
      <style>
        #header{display:none;}
      </style>
      <?php
    }elseif(!is_user_logged_in()){
      ?>
      <style>
        .header-nav{display:none;}
        div.col-inner{padding-top:60px;}
        div.flex-right{display:none;}
        /*
        #logo{width:100px;height:100px;}
        img.header_logo , img-header-logo{width:100px;height:100px;}
        */
      </style>
      <?php
    }
  }
}

// function enviar_email(){
//   wp_mail("abiezer.1530@gmail.com","bienvenido a EvaVenezuela","este es el mensaje de bienvenida");
// }

// add_action('wp', 'enviar_email');

/*-----------------------------------------------------------------------------
-----------------------------------------------------------------------------*/
/*add_filter( 'bp_user_can_create_groups', 'mycred_pro_limit_bp_group_creation' );
function mycred_pro_limit_bp_group_creation( $can ) {

	if ( ! function_exists( 'mycred' ) ) return $can;

	$point_type = 'mycred_default';
	$mycred = mycred( $point_type );
	$user_id = get_current_user_id();

	// If excluded
	if ( $mycred->exclude_user( $user_id ) ) return $can;

	// Point requirement
	$required = 5000;

	// Decline if balance is lower then required
	if ( $mycred->get_users_balance( $user_id, $point_type ) < $required ) return false;

	return true;

}*/
/*-----------------------------------------------------------------------------*/

add_action('wp_ajax_valid','valid_cre');
add_action('wp_ajax_nopriv_valid','valid_cre');

function valid_cre(){
  if ( ! function_exists( 'mycred' ) ) echo '$can';
	$point_type = 'mycred_default';
	$mycred = mycred( $point_type );
	$user_id = get_current_user_id();
	// If excluded
	if ( $mycred->exclude_user( $user_id ) ) echo '$can';
	// Point requirement
	$required = 1;
	// Decline if balance is lower then required
	if ( $mycred->get_users_balance( $user_id, $point_type ) < $required ){
    $vali = array(
        'cod'             => '10',
        'mensaje'         => 'Aun no disponde de creditos'
    );
    echo $vali;
  }else{
    $vali = array(
        'cod'             => '11',
        'mensaje'         => 'es mayor que uno'
    );
	   echo $vali;
  }
}

add_action('wp_ajax_valid_l','valid_login');
add_action('wp_ajax_nopriv_valid_l','valid_login');

function valid_login(){
  if ( ! defined( 'ABSPATH' ) ) {
  	exit; // Exit if accessed directly
  }

  /*if ( ! $messages ){
  	return;
  }*/

foreach ( $messages as $message ) :
$p =  "<li><span class='message-icon icon-close'></span>".wp_kses_post( $message )."</li>";
endforeach;
  echo "
  <div class='woocommerce-messages alert-color medium-text-center container'>
  	<div class='message-wrapper'>
  		<ul class='woocommerce-error woocommerce-message'>".
      $p[0]
  		."</ul>
  	</div>
  </div>
  ";
}

/*-----------------------------------------------------
            Añade busqueda de modelos con ajax
-----------------------------------------------------*/
add_action('wp_ajax_busq_ajax','busq_ajax');
/*-----------------------------------------------------*/

/*-----------------------------------------------------
            Funcion busqueda de modelos con ajax
-----------------------------------------------------*/
function busq_ajax(){
  global $current_user;
  get_currentuserinfo();
  $usuario = esc_attr($current_user->preferencia);

   if($_GET['nombre']):
      if($usuario =='h_b_m'){
        $genero = 'mujeres';
      }elseif ($usuario =='h_b_h') {
        $genero = 'h_homosexual';
      }elseif ($usuario =='m_b_h') {
        $genero = 'hombres';
      }elseif ($usuario =='m_b_m') {
        $genero = 'm_homosexual';
      }
      $args = array(
        's' =>  $_GET['nombre'],
        'post_type' => 'product',
        'product_cat' =>  $genero,
        'posts_per_page' => 1 );

       $loop = new WP_Query( $args );
       if($loop->have_posts()):

        ?>

        <?php
        $i=0;
        while ( $loop->have_posts() ) : $loop->the_post();
          global $product;

             $modelo[$i]['image'] = woocommerce_get_product_thumbnail();
             $modelo[$i]['link'] = get_permalink();
             $modelo[$i]['title'] = get_the_title();

          endwhile;
          $nombre = json_encode($modelo);
        else:
          ?>no hay resultados<?php
        endif;
      endif;

    echo $modelo[0]['image']." <a href='".$modelo[0]['link']."'>".$modelo[0]['title']."</a> ";
}
/*-----------------------------------------------------*/

function first_script(){
    wp_register_script('first_script-js',get_template_directory_uri().'-child/assets/js/script-child.js',array('jquery'));
    wp_register_script('seconds',get_template_directory_uri().'-child/assets/js/bootstrap.min.js',array('jquery'));
    wp_enqueue_script('jquery');
    wp_enqueue_script('first_script-js');
    wp_enqueue_script('seconds');
}

/*=============================
          Remover tab
===============================*/
add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {
unset($tabs['reviews']);
return $tabs;
}


function wc_is_purchasable( $return ) {
 return true;
 }
 add_filter( 'woocommerce_is_purchasable', 'wc_is_purchasable', 10, 1 );


/*--------------------------------------------
              Registrar usuarios
-------------------------------------------*/
function registrar_usuario($user1, $email, $pass, $prefer, $product_id){
  $user = $user1;
    $datos = array(
        'user_login'        => $user,
        'user_pass'         => md5($pass),
        'user_nicename'     => $user,
        'user_email'        => $email,
        'user_registered'   => date("Y-m-d H:i:s"),
        'display_name'      => $user
    );
    global $wpdb;

    $wpdb->insert('ev7_users',$datos);

    $id_user = $wpdb->insert_id;
    add_user_meta($id_user,'preferencia',$prefer);

    if(isset($product_id) and !empty($product_id)){
      $product_id_r = get_user_meta($id_user,'product_id');

      if(isset($product_id_r) and !empty($product_id_r)){
        update_user_meta($id_user,'product_id',$product_id);
      }elseif (isset($product_id_r)) {
        update_user_meta($id_user,'product_id',$product_id);
      }else {
        add_user_meta($id_user,'product_id',$product_id);
      }
    }
    $usuario = array(
        'user_login'    =>  $user,
        'user_password' =>  $pass,
        'id'            =>  $id_user
    );

    return $usuario;
}

/*-------------------------------
  Gestion de registro con ajax usuario general
-------------------------------*/
function imprimir_process(){

    $user = $_POST['data']['username'];
    $email = $_POST['data']['email'];
    $pass = $_POST['data']['password'];
    $prefer = $_POST['data']['preference'];

    $val = validar_usuario($user,$email,$pass,$prefer);

    if($val['cod'] == 7){

        $usuario_r = registrar_usuario($user, $email, $pass, $prefer);
        wp_signon($usuario_r);
        $mensaje = json_encode($val);
        echo $mensaje;
        exit();
    }else{

        $mensaje = json_encode($val);
        echo $mensaje;
        exit();

    }
}

/*---------------------------------
        Validacion de usuario
---------------------------------*/

function validar_usuario($user, $email,$pass,$prefer){


    if(empty($user)){
        $validacion = array(
            'cod' => '1',
            'mensaje'        => 'Debe completar el campo Usuario'
        );
        return $validacion;
    }elseif(empty($email)){
        $validacion = array(
            'cod' => '2',
            'mensaje'        => 'Debe completar el campo Correo'
        );
        return $validacion;
    }elseif(empty($pass)){
        $validacion = array(
            'cod' => '3',
            'mensaje'        => 'Debe completar el campo Contraseña'
        );
        return $validacion;
    }elseif(empty($prefer)){
        $validacion = array(
            'cod' => '4',
            'mensaje'        => 'Debe completar el campo Preferencia'
        );
        return $validacion;
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $validacion = array(
          'cod'            => '8',
            'mensaje'      => 'Introduzca un email valido'
        );

        return $validacion;
    }elseif (ctype_space($user)) {
      $validacion = array(
        'cod'            => '9',
        'mensaje'         => 'El usuario no puede contener espacios'
        );
        return $validacion;
    }


    global $wpdb;
    $user_login = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE user_login='".$user."'");

    if(!empty($user_login)){
        $validacion = array(
            'cod' => '5',
            'mensaje'        => 'El usuario ya esta registrado'
        );
        return $validacion;
    }else{
        $user_email = $wpdb->get_results("SELECT * FROM $wpdb->users WHERE user_email='".$email."'");
        if(!empty($user_email)){
            $validacion = array(
                'cod' => '6',
                'mensaje'        => 'El correo ya esta registrado'
            );
            return $validacion;
        }
    }

    $validacion = array(
        'cod'            => '7',
        'mensaje'        => 'Usuario registrado'
    );

 return $validacion;

}


/*===========================
      Registrar carrusel
=============================*/
function registrar_carrusel($id_user){
  $str = '{"newestfirst":"false","name":"'.$id_user.'","slides":[],"skin":"fashion","fixaspectratio":"true","centerimage":"true","fitimage":"false","fitcenterimage":"false","sameheight":"false","sameheightresponsive":"false","sameheightmediumscreen":769,"sameheightmediumheight":200,"sameheightsmallscreen":415,"sameheightsmallheight":150,"fullwidth":"true","hidecontaineroninit":"false","hidecontainerbeforeloaded":"false","spacing":0,"imgextraprops":"","showimgtitle":"false","addwoocommerceclass":"true","imgtitle":"title","customcss":"","dataoptions":"","lightboxresponsive":"true","lightboxshownavigation":"false","lightboxnogroup":"false","lightboxshowtitle":"true","lightboxshowdescription":"false","lightboxfullscreenmode":"false","lightboxcloseonoverlay":"true","lightboxvideohidecontrols":"false","lightboxtitlestyle":"bottom","lightboximagepercentage":75,"lightboxdefaultvideovolume":1,"lightboxoverlaybgcolor":"#000","lightboxoverlayopacity":0.9,"lightboxbgcolor":"#fff","lightboxtitleprefix":"%NUM \/ %TOTAL","lightboxtitleinsidecss":"color:#fff; font-size:16px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left;","lightboxdescriptioninsidecss":"color:#fff; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;","lightboxautoslide":"false","lightboxslideinterval":5000,"lightboxshowtimer":"true","lightboxtimerposition":"bottom","lightboxtimerheight":2,"lightboxtimercolor":"#dc572e","lightboxtimeropacity":1,"lightboxshowplaybutton":"true","lightboxalwaysshownavarrows":"false","lightboxbordersize":8,"lightboxshowtitleprefix":"true","lightboxborderradius":0,"lightboximagekeepratio":"true","lightboxadvancedoptions":"","lightboxshowsocial":"false","lightboxsocialposition":"position:absolute;top:100%;right:0;","lightboxsocialpositionsmallscreen":"position:absolute;top:100%;right:0;left:0;","lightboxsocialdirection":"horizontal","lightboxsocialbuttonsize":32,"lightboxsocialbuttonfontsize":18,"lightboxsocialrotateeffect":"true","lightboxshowfacebook":"true","lightboxshowtwitter":"true","lightboxshowpinterest":"true","donotinit":"false","addinitscript":"false","doshortcodeontext":"false","triggerresize":"false","triggerresizedelay":100,"lightboxthumbwidth":90,"lightboxthumbheight":60,"lightboxthumbtopmargin":12,"lightboxthumbbottommargin":4,"lightboxbarheight":64,"lightboxtitlebottomcss":"{color:#333; font-size:14px; font-family:Armata,sans-serif,Arial; overflow:hidden; text-align:left;}","lightboxdescriptionbottomcss":"{color:#333; font-size:12px; font-family:Arial,Helvetica,sans-serif; overflow:hidden; text-align:left; margin:4px 0px 0px; padding: 0px;}","width":300,"height":300,"rownumber":1,"autoplay":"true","random":"false","circular":"true","direction":"horizontal","responsive":"true","visibleitems":3,"pauseonmouseover":"true","scrollmode":"page","interval":3000,"transitionduration":1000,"continuous":"false","continuousduration":2500,"arrowstyle":"mouseover","arrowimage":"arrows-42-60-0.png","arrowwidth":42,"arrowheight":60,"navstyle":"none","navimage":"bullet-16-16-1.png","navwidth":16,"navheight":16,"navspacing":8,"showhoveroverlay":"false","hoveroverlayimage":"hoveroverlay-64-64-4.png","screenquery":"{\n\t\"tablet\": {\n\t\t\"screenwidth\": 800,\n\t\t\"visibleitems\": 2\n\t},\n\t\"mobile\": {\n\t\t\"screenwidth\": 480,\n\t\t\"visibleitems\": 1\n\t}\n}","skintemplate":"&lt;div class=\"amazingcarousel-image\"&gt;__IMAGE__&lt;\/div&gt;","skincss":"@import url(https:\/\/fonts.googleapis.com\/css?family=Open+Sans);\n\n#amazingcarousel-CAROUSELID .amazingcarousel-image {\t\n\tposition: relative;\n\tpadding: 0px;\n}\n\n#amazingcarousel-CAROUSELID .amazingcarousel-image img {\n\tdisplay: block;\n\twidth: 100%;\n\tmax-width: 100%;\n\tborder: 0;\n\tmargin: 0;\n\tpadding: 0;\n\t-moz-border-radius: 0px;\n\t-webkit-border-radius: 0px;\n\tborder-radius: 0px;\n}\n\n#amazingcarousel-container-CAROUSELID {\n\tpadding: 32px 48px; \n}\n\n#amazingcarousel-CAROUSELID .amazingcarousel-list-container { \n\tpadding: 16px 0;\n}\n\n\n#amazingcarousel-CAROUSELID .amazingcarousel-item-container {\n\ttext-align: center;\n\tpadding: 0px;\n}\n\n#amazingcarousel-CAROUSELID .amazingcarousel-item-container:hover {\n\topacity: 0.7;\n\tfilter: alpha(opacity=70);\n}\n\n#amazingcarousel-CAROUSELID .amazingcarousel-prev {\n\tleft: 0%;\n\ttop: 50%;\n\tmargin-left: 0px;\n\tmargin-top: -30px;\n}\n\n#amazingcarousel-CAROUSELID .amazingcarousel-next {\n\tright: 0%;\n\ttop: 50%;\n\tmargin-right: 0px;\n\tmargin-top: -30px;\n}\n\n#amazingcarousel-CAROUSELID .amazingcarousel-nav {\n\tposition: absolute;\n\twidth: 100%;\n\ttop: 100%;\n}\n\n#amazingcarousel-CAROUSELID .amazingcarousel-bullet-wrapper {\n\tmargin: 4px auto;\n}","arrowimagemode":"defined","navimagemode":"defined","hoveroverlayimagemode":"defined","showhoveroverlayalways":"false","hidehoveroverlayontouch":"false","usescreenquery":"true","showplayvideo":"true","playvideoimage":"playvideo-64-64-0.png","playvideoimagepos":"center","playvideoimagemode":"defined"}';
  $datos = array(
        'name'   => $id_user,
        'data'   => $str,
        'authorid' => '1',
        'time'   => date("Y-m-d H:i:s"),
    );
    global $wpdb;

    $wpdb->insert('ev7_wonderplugin_carousel',$datos);

    $id_carousel = $wpdb->insert_id;

    return $id_carousel;
}


/*---------------------------------
Lista la categoria de acuerdo a su preferencia
---------------------------------*/
add_shortcode('lista_genero','genero');

function genero(){

  global $current_user;
  get_currentuserinfo();
  if($current_user->product_id){
    $prefer_pre = get_post_meta($current_user->product_id,"preferencia");
    $prefer = $prefer_pre[0];
  }else{
    $prefer = esc_attr($current_user->preferencia);
  }

   if($_GET['nombre']):
      if($prefer == 'h_b_m'){
        $genero = 'mujeres';
      }elseif ($prefer == 'h_b_h') {
        $genero = 'h_homosexual';
      }elseif ($prefer == 'm_b_h') {
        $genero = 'hombres';
      }elseif ($prefer == 'm_b_m') {
        $genero = 'm_homosexual';
      }
      $args = array(
        's' =>  $_GET['nombre'],
        'post_type' => 'product',
        'product_cat' =>  $genero,
        'posts_per_page' => -1 );
       $loop = new WP_Query( $args );
       if($loop->have_posts()):

        ?>
        <div class="row large-columns-3 medium-columns- small-columns-2 row-normal has-shadow row-box-shadow-1 row-box-shadow-5-hover">
        <?php
        while ( $loop->have_posts() ) : $loop->the_post();
          global $product;
            ?>
            <div class="col">
              <div class="col-inner">
                <div class="badge-container absolute left top z-1">
                </div>
                <div class="product-small box has-hover box-shade dark box-text-bottom">
                <div class="box-image">
                  <div class="image-cover" style="padding-top:150%;">
                    <a href="<?php echo get_permalink();?>">
                      <?php echo woocommerce_get_product_thumbnail(); ?>

                    </a>
                       <div class="shade">

                   </div>
                  </div>
                  <div class="image-tools z-top top right show-on-hover">
                  </div>
                  </div><!-- box-image -->

                <div class="box-text text-center is-xlarge">
                  <div class="title-wrapper"><p class="name product-title"></p><?php do_action('woocommerce_shop_loop_item_title'); ?></div><div class="price-wrapper"></div><div class="overlay-tools">  <a class="quick-view" data-prod="504" href="#quick-view">Vista Rápida</a></div></div><!-- box-text -->
              </div><!-- box -->
            </div><!-- .col-inner -->
          </div>

            <?php
          endwhile;
        else:
          ?></br></br><center><h1>no hay resultados para esta busqueda</h1></center><?php
        endif;

    else:


      if($prefer == 'h_b_m'){
      echo do_shortcode("[ux_products name style='shade' cat='mujeres' type='row' slider_nav_style='circle' col_spacing='small' columns='3' depth='1' depth_hover='5' products='2500' orderby='rand' image_height='150%' image_size='large' text_size='xlarge']");
    }else if($prefer == 'h_b_h'){
          echo do_shortcode("[ux_products style='shade' cat='h_homosexual' type='row' slider_nav_style='circle' col_spacing='small' columns='3' depth='1' depth_hover='5' products='2500' orderby='rand' image_height='150%' image_size='large' text_size='xlarge']");
      }else if($prefer == 'm_b_h'){
          echo do_shortcode("[ux_products style='shade' cat='hombres' type='row' slider_nav_style='circle' col_spacing='small' columns='3' depth='1' depth_hover='5' products='2500' orderby='rand' image_height='150%' image_size='large' text_size='xlarge']");
      }else if($prefer == 'm_b_m'){
          echo do_shortcode("[ux_products style='shade' cat='m_homosexual' type='row' slider_nav_style='circle' col_spacing='small' columns='3' depth='1' depth_hover='5' products='2500' orderby='rand' image_height='150%' image_size='large' text_size='xlarge']");
      }else{
          $dir_base = 'http://' .  $_SERVER['HTTP_HOST'];
            redirigir_url($dir_base."/my-account/edit-account","debe completar el campo preferencia");
      }
    endif;

}

/*---------------------------------
---------------------------------*/

add_shortcode('register1','custom_pre_get_posts_query');

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;

	if ( ! is_admin() && is_shop() ) {

		$q->set( 'tax_query', array(array(
			'taxonomy' => 'mujeres',
			'field' => 'slug',
			'terms' => array( 'knives' ), // Don't display products in the knives category on the shop page
			'operator' => 'NOT IN'
		)));

	}
}
/*-----------------------------------------------------
                Incluyendo estilos
------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'twentysixteen_scripts');
function twentysixteen_scripts() {
	wp_enqueue_style('style.css', get_stylesheet_uri());
	wp_enqueue_style( 'login' );
}

add_action('wp_enqueue_scripts','bootstrap');
function bootstrap(){
wp_enqueue_style('bootstrap.min', get_template_directory_uri() . '-child/assets/css/bootstrap.min.css');
}

/*-------------------------------------------------------*/

add_shortcode('register', 'shortcode_register');


?>

<?php

/*================================
boton para ingresar ubicado en el home
=================================*/
function shortcode_botonacceder(){

    $icon_style = get_theme_mod('account_icon_style');
    if(is_woocommerce_activated()){ ?>
        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
            class="nav-top-link nav-top-not-logged-in jossy <?php if($icon_style && $icon_style !== 'image') echo get_flatsome_icon_class($icon_style, 'small'); ?>"
            <?php if(get_theme_mod('account_login_style','lightbox') == 'lightbox') echo 'data-open="#login-form-popup"'; ?>
          >


  <?php if(get_theme_mod('header_account_title', 1)) { ?>
    <?php _e('Login', 'woocommerce'); ?>
    <?php if(get_theme_mod('header_account_register')){
        echo ' / '.__('Register', 'woocommerce');
      } ?>
  <?php } else {
        echo get_flatsome_icon('icon-user');
    } ?>
</a><!-- .account-login-link -->

<?php if($icon_style && $icon_style !== 'image' && $icon_style !== 'plain') echo '</div>'; ?>

<?php
// Show Dropdown for logged in users
if ( is_user_logged_in() ) { ?>
<ul class="nav-dropdown  <?php flatsome_dropdown_classes(); ?>">
    <?php woocommerce_get_template('myaccount/account-links.php'); ?>
</ul>
<?php } ?>

<?php } else {
  echo '<li><a class="element-error tooltip" title="WooCommerce needed">-</a></li>'; }

}
add_shortcode('botonacceder','shortcode_botonacceder');
?>

<?php

function redirigir_url($link,$alerta) {
 ?>
<script>
var link =  "<?php echo $link; ?>";
var alerta = "<?php echo $alerta; ?>"
  window.location=link;
  alert(alerta);
</script>
<?php

}

/*=======================
 titulo del banner
===========================*/
function shortcode_texto(){?>
<div id=texto>
    <h2 class="uppercase">evavenezuela</h2>
<h3 class="thin-font">Conectándote con tu pareja ideal.</h3>
</div>
<?php
}
add_shortcode('texto','shortcode_texto');

/*==================================================
Muestra atributos personalizados en las miniaturas
===================================================*/
function atributo_producto(){
global $product;
$fabric_values = get_the_terms( $product->id, 'pa_edad');

foreach ( $fabric_values as $fabric_value ) {
	  echo $fabric_value->name;
}
}
//add_action('woocommerce_shop_loop_item_title','atributo_producto');

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );/*remueve el titulo del producto de la miniatura*/
/*============================================
Mostrar edad y pais en la miniatura
==============================================*/
function edad(){
 if (function_exists('the_field')){?>
    <center class="fuente"><b><?php
    the_field('nombre');
        echo ", ";
        ?> </b><?php
    the_field('edad');?></center>
    <p class="if"><center class="if"><?php
    the_field('vivo_en');?></center></p> <?php
 }
}
add_action('woocommerce_shop_loop_item_title','edad');


/*==================================
hook para productos relacionados
====================================*/
function title_related() {
    do_action('title_related');
}

function show_related(){
 if (function_exists('the_field')){?>
    <center class="fuente"><b><?php
    the_field('nombre');
        echo ", ";
        ?> </b><?php
    the_field('edad');?></center><?php
 }
}
add_action('title_related','show_related');

/*=============================
Relacionar por categoria
================================*/
function get_related_custom( $id ) {
    global $woocommerce;

    // Related products are found from category and tag
    $tags_array = array(0);
    $cats_array = array(0);

    // Get categories
    $terms = wp_get_post_terms($id, 'product_cat');
    foreach ( $terms as $term ) $cats_array[] = $term->term_id;

    // Don't bother if none are set
    if ( sizeof($cats_array)==1 && sizeof($tags_array)==1 ) return array();

    // Meta query
    $meta_query = array();
    $meta_query[] = $woocommerce->query->visibility_meta_query();
    $meta_query[] = $woocommerce->query->stock_status_meta_query();

    // Get the posts
    $related_posts = get_posts( apply_filters('woocommerce_product_related_posts', array(
        'orderby'        => 'rand',
        'posts_per_page' => 6,
        'post_type'      => 'product',
        'fields'         => 'ids',
        'meta_query'     => $meta_query,
        'tax_query'      => array(
            'relation'      => 'OR',
            array(
                'taxonomy'     => 'product_cat',
                'field'        => 'id',
                'terms'        => $cats_array
            ),
            array(
                'taxonomy'     => 'product_tag',
                'field'        => 'id',
                'terms'        => $tags_array
            )
        )
    ) ));
    $related_posts = array_diff( $related_posts, array( $id ));
    return $related_posts;
}
add_action('init','get_related_custom');
?>

<?php


add_shortcode('formu_login','formu_login');

/*----------------------------------------------------
  Añade campo preferencia al area modificar de perfil
-----------------------------------------------------*/
add_action('woocommerce_edit_account_form','agrega_mi_campo_personalizado');
/*----------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------------------------
                                    Actualizar en bd preferencia
----------------------------------------------------------------------------------------------*/
add_action('woocommerce_save_account_details', 'my_custom_checkout_field_update_order_meta');
/*-------------------------------------------------------------------------------------------*/

//add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);

/*============================
Añade mas columnas de la galeria de fotos
=========================================*/
add_filter ( 'woocommerce_product_thumbnails_columns', 'xx_thumb_cols' );
 function xx_thumb_cols() {
     return 100;
 }


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
/*---------------------------------------------------------------------------------------------------------
                            Redireccionar despues de iniciar session
-----------------------------------------------------------------------------------------------------------*/
function redireccion(){
  $host = dirname( set_url_scheme( 'http://' .  $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ));
  wp_redirect($host. '/inicio');
}
add_filter('woocommerce_login_redirect','redireccion');

/*------------------------------------------------------------------------------------------------------*/

function ACF_product(){
if (function_exists('the_field')){?>
<div class="grid_modelo" id="style">
    <div class="cuadro1">
        <p class='informacion uppercase size'> <b class='identificador '></b>
          <?php echo str_replace ("_"," ", get_field('nombre'))?>
        </p>
        <p class='informacion uppercase'> <b class='identificador'></b>
          <?php echo str_replace ("_"," ", get_field('edad')); echo " AÑOS, "; echo str_replace ("_"," ", get_field('vivo_en'))?>
        </p>
        <p class='informacion'> <b class='identificador'></b>
            <?php echo str_replace ("_"," ", get_field('estado_civil'));?> <b class="vertical-bar"> </b> <?php echo str_replace ("_"," ", get_field('nivel_de_estudios'));?> <b class="vertical-bar espacio"> </b> <?php echo str_replace ("_"," ", get_field('titulo_de_estudios'))?>
        </p>
        <p class='informacion uppercase'> <b class='identificador'>fecha de nacimiento</b>
          <?php echo str_replace ("_"," ", get_field('fecha_nacimiento'))?>
        </p>
        <p class='parrafo uppercase'> <b class='identificador'>#<b class="color_red">amo</b>tus<b class="color_red">imperfecciones:</b></b>
          <?php $imper = get_field('imperfecciones');
            $tamanio = count($imper);
            if(isset($imper) and !empty($imper)){
            foreach($imper as $imperfec){
              echo str_replace("_"," ",$imperfec);
              if($tamanio > 1){
                echo ", ";
                $tamanio = $tamanio - 1;
              }else{
                echo ".";
              }
            }
          }
          ?>
        </p>

    </div>

    <div class="cuadro">
        <p class='parrafo'> <b class='identificador '></b>
          <?php echo str_replace ("_"," ", get_field('hobbies'))?>
        </p>
        <p class='parrafo'> <b class='identificador '></b>
          <?php echo str_replace ("_"," ", get_field('biografia'))?>
        </p>
    </div>

    <div class= "cuadro">
        <p class='informacion uppercase size'><b class='identificador '>Acerca de mi</b>
        </p>
        <p class='informacion'> <b class='identificador '>Nacionalidad:</b>
          <?php echo str_replace ("_"," ", get_field('nacionalidad'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Hijos:</b>
          <?php echo str_replace ("_"," ", get_field('hijos'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Ocupación:</b>
          <?php echo str_replace ("_"," ", get_field('ocupacion'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Color de ojos:</b>
          <?php echo str_replace ("_"," ", get_field('color_de_ojos'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Color de cabello:</b>
          <?php echo str_replace ("_"," ", get_field('color_de_cabello'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Bebida favorita:</b>
          <?php echo str_replace ("_"," ", get_field('bebida_favorita'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Fuma:</b>
          <?php echo str_replace ("_"," ", get_field('fuma'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Altura (cm):</b>
          <?php echo str_replace ("_"," ", get_field('altura'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Tipo de cuerpo:</b>
          <?php echo str_replace ("_"," ", get_field('tipo_de_cuerpo'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Otros idiomas:</b>
          <?php echo str_replace ("_"," ", get_field('otros_idiomas'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Música favorita:</b>
          <?php echo str_replace ("_"," ", get_field('musica_favorita'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Película favorita:</b>
          <?php echo str_replace ("_"," ", get_field('pelicula_favorita'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Deportes que práctico:</b>
          <?php echo str_replace ("_"," ", get_field('deportes_que_practico'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Instrumento que práctico:</b>
          <?php echo str_replace ("_"," ", get_field('cuales_instrumentos_musicales'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Comida favorita:</b>
          <?php echo str_replace ("_"," ", get_field('comida_favorita'))?>
        </p>
        <p class='informacion'> <b class='identificador '>Ciudad favorita del mundo:</b>
          <?php echo str_replace ("_"," ", get_field('ciudad_favorita_del_mundo'))?>
        </p>
         <p class='parrafo'> <b class='identificador '>Me gustaría:</b>
          <?php echo str_replace ("_"," ", get_field('me_gustaria'))?>
        </p>
    </div>

    <div class="cuadro">
        <p class='parrafo'> <b class='identificador '>Carácter:</b>
          <?php echo str_replace ("_"," ", get_field('caracter'))?>
        </p>
        <p class='parrafo'> <b class='identificador '>Intereses:</b>
          <?php
          $inter = get_field('intereses');
            $tamanio_i = count($inter);

            if(isset($inter) and !empty($inter)){

            foreach($inter as $intere){
              echo str_replace("_"," ",$intere);
              if($tamanio_i > 1){
                echo ", ";
                $tamanio_i = $tamanio_i - 1;
              }else{
                echo ".";
              }

            }
          }
          ?>
        </p>
        <p class='parrafo'> <b class='identificador '>Pareja ideal:</b>
          <?php echo str_replace ("_"," ", get_field('pareja_ideal'))?>
        </p>
    </div>
</div>

<?php
}}

// Show advanced custom fields in product detail page
add_action( 'woocommerce_single_product_summary', "ACF_product", 8 );



add_filter( 'woocommerce_product_related_posts_relate_by_tag', 'enable_tag_related_products' );

/*------------------------------------------
    Shortcode para formulario de Busqueda
-------------------------------------------*/
add_shortcode('busq','busq');
/*-----------------------------------------*/


/*------------------------
Redireccionar a inicio
--------------------------*/
function redirecting_get() {
  $host = dirname( set_url_scheme( 'http://' .  $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ) );
    $route = $host."/inicio?nombre=".$_GET['nombre'];
      wp_redirect($route);

}
add_action( 'admin_post_nopriv', 'redirecting_get' );
add_action( 'admin_post', 'redirecting_get' );


// Redirecciona a el pago al darle click al boton quiero conocerte

add_filter ('add_to_cart_redirect', 'redirect_to_checkout_page');

function redirect_to_checkout_page() {

	global $woocommerce;

	$checkout_url = $woocommerce->cart->get_checkout_url();
	return $checkout_url;
}

//No mostrar precio en perfil del producto ni en catalogo
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_single_product_flipbook_summary', 'woocommerce_template_single_price', 10 );


/*===========================
Remueve precio de vista rapida
==============================*/
function removeprice(){
remove_action( 'woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_price', 10 );
}
add_action('wc_quick_view_before_single_product', 'removeprice', 1);

/*=========================================
Remueve las notas de envio en el checkout
===========================================*/
add_filter( 'woocommerce_checkout_fields' , 'remove_order_notes' );

function remove_order_notes( $fields ) {
     unset($fields['order']['order_comments']);
     return $fields;
}

/*=================================
Quitar el título del campo
===================================*/
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );


add_action( 'init', 'we_woocommerce_clear_cart_url' );
    function we_woocommerce_clear_cart_url() {
	global $woocommerce;
	if( isset($_REQUEST['clear-cart']) ) {
		$woocommerce->cart->empty_cart();
	}
}


/*====================================
          MENSAJE DE CHECKOUT
======================================*/
function rei_wc_add_to_cart_message( $message, $product_id ) {
    $titles = array();

    if ( is_array( $product_id ) ) {
        foreach ( $product_id as $id ) {
            $titles[] = get_the_title( $id );

        }
    } else {
        $titles[] = get_the_title( $product_id );

    }

    $titles = array_filter( $titles );

 $added_text = sprintf( _n( '%s te ha enviado un mensaje.', '%s esperan por conocerte.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );
    // Output success messages
    if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
        $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wp_get_referer() ? wp_get_referer() : home_url() );
        $message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( 'Continue Shopping', 'woocommerce' ), esc_html( $added_text ) );
    } else {
       $message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View Cart', 'woocommerce' ), esc_html( $added_text ) );
    }

    return $message;
}
add_filter('wc_add_to_cart_message','rei_wc_add_to_cart_message',10,2);

/*=======================================
Vaciar el carro automaticamente si no esta en checkout
=========================================*/
function my_empty_cart() {
    global $woocommerce;
    global $wp;
    $host = get_site_url();
    $checkout = $host . '/checkout';
    $user = wp_get_current_user();
    $current_url = home_url(add_query_arg(array(),$wp->request));
      $dir_actual = home_url(add_query_arg( array()));

    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		    if ( in_array( 'administrator', $user->roles ) ) {
		      }

         else if ( $current_url != $checkout) {
          $woocommerce->cart->empty_cart();
    }
		}
	}



function mensaje_automatico() {
  $user_id = get_current_user_id();

  foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
    $sku = $_product->get_sku();
  }


  $model_id = get_post_meta($product_id, 'user_id');

  messages_new_message( array(
    'recipients' => $user_id,
    'sender_id'  => $model_id[0],
    'subject'    => "¿Me quieres conocer?",
    'content'    => "Cuentame acerca de ti, ¿A que te dedicas?",
    'error_type' => 'wp_error'
  ) );
}
add_action( 'woocommerce_checkout_shipping', 'mensaje_automatico' );

add_action('woocommerce_create_product_variation', 'usuario_producto');

add_action( 'wp', 'my_empty_cart' );

/*==============================================
Ocultar base de grupo en el prefil de buddypress
================================================*/

function bpfr_hide_profile_field_group( $retval ) {
	if ( bp_is_active( 'xprofile' ) ) :

	// hide profile group/field to all except admin
	if ( !is_super_admin() ) {
		//exlude fields, separated by comma
		// $retval['exclude_fields'] = '1';
		//exlude groups, separated by comma
		$retval['exclude_groups'] = '1';
	}
	return $retval;

	endif;
}
add_filter( 'bp_after_has_profile_parse_args', 'bpfr_hide_profile_field_group' );

function remove_nav_items() {
    bp_core_remove_subnav_item( 'profile', 'edit' );
}
add_action( 'bp_setup_nav', 'remove_nav_items');


/* Remueve el titulo que se muestra al mantener el mouse encima de una miniatura del producto*/
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $deprecated1 = 0, $deprecated2 = 0 ) {
		global $post;
		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

		if ( has_post_thumbnail() ) {
			$props = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			return get_the_post_thumbnail( $post->ID, $image_size, array(
				'alt'    => $props['alt'],
			) );
		} elseif ( wc_placeholder_img_src() ) {
			return wc_placeholder_img( $image_size );
		}
	}
}
// remove_action( 'template_redirect', array( 'WC_Form_Handler', 'save_account_details' ) );


function woo_custom_checkout_fields( $fields ) {
  unset ($fields['billing']['billing_company']);     // Eliminar el campo Empresa
  unset ($fields['billing']['billing_address_1']);   // Eliminar el campo Dirección 1
  unset ($fields['billing']['billing_address_2']);   // Eliminar el campo Dirección 2
  unset ($fields['billing']['billing_postcode']);    // Eliminar el campo Código Postal
  unset ($fields['billing']['billing_state']);       // Eliminar el campo Provincia
  unset ($fields['billing']['billing_country']);     // Eliminar el campo País
  unset ($fields['billing']['billing_city']);


  return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'woo_custom_checkout_fields' );

function remove_quick_view(){
  remove_action('flatsome_product_box_actions', 'flatsome_lightbox_button', 50);
}

add_action('flatsome_product_box_actions', 'remove_quick_view', 1);

function message_private(){
  global $product;
  $id = $product->id;
  $post = get_post($id);
  $id_usuario = $post->user_id;
 if ( is_user_logged_in() ) echo '<a href="' . wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . get_the_author_meta('user_nicename', $id_usuario) ) . '" title="Send a private message to this user" class="send-message">Enviar mensaje</a>';

}

add_action('flatsome_product_box_actions', 'message_private', 50);
