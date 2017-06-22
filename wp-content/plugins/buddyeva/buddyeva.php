<?php

/**
 * Plugin Name: BuddyEva
 * Plugin URI:  http://codeplus.com.ve/
 * Description: Personalizaciones de buddypress para EvaVenezuela.
 * Author:      Abiezer
 * Author URI:  http://codeplus.com.ve/
 * Version:     0.1
 * License:     GPL
 */

//Ocultar boton mensaje privado
 add_filter( 'bp_get_send_message_button', function( $array ) {
    //  if ( friends_check_friendship( bp_loggedin_user_id(), bp_displayed_user_id() ) ) {
    //      return $array;
    //  } else {
         return '';
    //  }
 } );

 add_action('wp_print_styles','estilos_buddyeva');

 function estilos_buddyeva(){
   wp_enqueue_style( 'estilos_BuddyEva-css',  plugins_url() .'/buddyeva/includes/css/buddyeva.css' );
 }
 add_action('bp_friends_setup_nav','bpdev_custom_hide_friends_if_not_self');

 function bpdev_custom_hide_friends_if_not_self(){

  if(bp_is_my_profile() || is_super_admin()){
     return ;
  }else{

    bp_admin_bar_remove_wp_menus();
  }
 }

 add_action('bp_before_profile_content','woo_contenido');

 function woo_contenido(){

   global $wp;
   $current_url = home_url(add_query_arg(array(),$wp->request));
   $valor = strpos($current_url, "profile");

    if($valor <= 0):
      $id = bp_displayed_user_id();
      $usuario = get_userdata($id);
      $product_id = esc_attr($usuario->product_id);
      if(empty($product_id)):
       global $current_user;

       $nombre = esc_attr($usuario->user_nicename);
       $prefer = esc_attr($usuario->preferencia);
       $mail = esc_attr($usuario->user_email);
       $numero = esc_attr($usuario->numero);
       $nacionalidad_wc = esc_attr($usuario->nacionalidad_wc);
       $cant_hijos_wc = esc_attr($usuario->cant_hijos_wc);
       $ocupacion_wc = esc_attr($usuario->ocupacion_wc);
       $edad_wc = esc_attr($usuario->edad_wc);
       $pareja_ideal_wc = esc_attr($usuario->pareja_ideal_wc);
       $carousel_id = esc_attr($usuario->carousel_id);

       $intereses = $usuario->intereses;

          $content ='<br><br>
          <div class="container contenido">
            <div class="row">
              <div class="style1-columns large-4 columns  acerca-de-buddyeva">
              <br/><h3 class="primary-text-color text-center">Acerca de mi</h3>
              <br/><br/><h4>Prefiero: </h4>';
                 if($prefer =='h_b_m'){
                   $content.= 'Mujeres';
                 }elseif ($prefer =='h_b_h') {
                   $content.= 'Hombres';
                 }elseif ($prefer =='m_b_h') {
                   $content.= 'Hombres';
                 }elseif ($prefer =='m_b_m') {
                   $content.= 'Mujeres';
                 }
                 if(!$nacionalidad_wc == ""){
                   $content.="<br/><br/><h4>Nacionalidad: </h4>";
                   $content.= $nacionalidad_wc;
                 }
                 if(!$cant_hijos_wc == ""){
                   $content.="<br/><br/><h4>Hijos: </h4>";
                   $content.= $cant_hijos_wc;
                 }
                 if(!$ocupacion_wc == ""){
                   $content.="<br/><br/><h4>Ocupación: </h4>";
                   $content.= $ocupacion_wc;
                 }
                 if(!$edad_wc == ""){
                   $content.="<br/><br/><h4>Edad:</h4>";
                   $content.= $edad_wc;
                 }

                 $content.='
              </div>

              <div class="style2-columns large-4 columns intereses-buddyeva">
                <br/><h3 class="text-center primary-text-color">Intereses</h3>';

                $count = 0;
                $content.= '<div class="row as_45454sd">';
                if(!empty($intereses)):
                  foreach ($intereses as $clave => $valor) {
                      if(!empty($valor)){
                        $content.= '<div class="columns small-12 medium-3 text-center redim_6592"><div id= "ahg_54854"><div class= "nvhf_3568"> <i class="'.$valor.'"></i></div> </div><i class="pqwo_985"<br>'.str_replace("_","<br>",$valor).'</i> </div>';
                        $count++;
                      }
                  }
                else:
                  $content.= '<div class= "text-center"> Pregunta a '.$nombre.' sus intereses. </div>';

                endif;
                $content.= '</div>';
                $content.= '</div>';
                $content.='</h1>';
                $content.='</h1>';
              $content.= '<div class="style3-columns col-fit columns que-busco-buddyeva text-justify">
              <br/><h3 class="primary-text-color text-center">Estoy buscando</h3><br/>';
              $content.= $pareja_ideal_wc;
              $content.='
              </div>

            </div>
          </div>';
          $content.='</div>';

        if(!empty($carousel_id)):
          $carousel = '[wonderplugin_carousel id="'.$carousel_id.'"]';
          echo do_shortcode($carousel);
        endif;

        echo $content;
      else:
        $user_id = get_post_meta($product_id,'user_id');
        $nombre = get_field('nombre',$product_id);
        $prefer = get_field('preferencia',$product_id,'string');
        $nacionalidad_wc = get_field('nacionalidad',$product_id,'string');
        $cant_hijos_wc = get_field('hijos',$product_id,'string');
        $ocupacion_wc = get_field('ocupacion',$product_id,'string');
        $edad_wc = get_field('edad',$product_id,'string');
        $pareja_ideal_wc = get_field('pareja_ideal',$product_id,'string');
        $carousel_id = get_user_meta($user_id[0], 'carousel_id');

        $nivel_de_estudios = get_field('nivel_de_estudios', $product_id);
        $titulo = get_field('titulo_de_estudios', $product_id);
        $imperfecciones = get_field('imperfecciones', $product_id);
        $cumpleanios = get_field( 'cumpleanios', $product_id);
        $color_de_ojos = get_field('color_de_ojos', $product_id);
        $bebida_favorita = get_field('bebida_favorita', $product_id);
        $color_de_cabello = get_field('color_de_cabello', $product_id);
        $fuma = get_field('fuma', $product_id);
        $altura = get_field('altura', $product_id);
        $tipo_de_cuerpo = get_field('tipo_de_cuerpo', $product_id);
        $otros_idiomas = get_field('otros_idiomas', $product_id);
        $estado_civil = get_field('estado_civil', $product_id);
        $vivo_en = get_field('vivo_en', $product_id);
        $musica_favorita = get_field('musica_favorita', $product_id);
        $pelicula_favorita = get_field('pelicula_favorita', $product_id);
        $biografia = get_field('biografia', $product_id);
        $caracter = get_field('caracter', $product_id);
        $intereses = get_field('intereses', $product_id);
        $deporte = get_field('deporte', $product_id);
        $deportes_que_practico = get_field('deportes_que_practico', $product_id);
        $toca_algun_instrumento = get_field('toca_algun_instrumento', $product_id);
        $cuales_instrumentos_musicales = get_field('cuales_instrumentos_musicales', $product_id);
        $hobbies = get_field('hobbies', $product_id);
        $comida_favorita = get_field('comida_favorita', $product_id);
        $ciudad_favorita_del_mundo = get_field('ciudad_favorita_del_mundo', $product_id);
        $me_gustaria = get_field('me_gustaria', $product_id);

        $content ='<br><br>
        <div class="container contenido">
          <div class="row">
            <div class="style1-columns large-4 columns  acerca-de-buddyeva">
            <br/><h3 class="primary-text-color text-center">Acerca de mi</h3>
            <br/><br/><h4>Prefieres: </h4>';
               if($prefer =='h_b_m'){
                 $content.= 'Mujeres';
               }elseif ($prefer =='h_b_h') {
                 $content.= 'Hombres';
               }elseif ($prefer =='m_b_h') {
                 $content.= 'Hombres';
               }elseif ($prefer =='m_b_m') {
                 $content.= 'Mujeres';
               }
               if(!$nacionalidad_wc == ""){
                 $content.="<br/><br/><h4>Nacionalidad: </h4>";
                 $content.= $nacionalidad_wc;
               }
               if(!$cant_hijos_wc == ""){
                 $content.="<br/><br/><h4>Hijos: </h4>";
                 $content.= $cant_hijos_wc;
               }
               if(!$ocupacion_wc == ""){
                 $content.="<br/><br/><h4>Ocupación: </h4>";
                 $content.= $ocupacion_wc;
               }
               if(!$edad_wc == ""){
                 $content.="<br/><br/><h4>Edad:</h4>";
                 $content.= $edad_wc;
               }
               if(!empty($imperfecciones)){
                 $content.="<br/><br/><h4>Imperfecciones:</h4>";

                   foreach ($imperfecciones as $clave => $valor) {
                       if($valor){
                         $content.= ucwords( str_replace("_"," ",$valor) ). '<br>';
                         $count++;
                       }
                   }
               }
               if(!empty($nivel_de_estudios)){
                 $content.="<br/><br/><h4>Nivel de Estudios:</h4>";
                 $content.= ucwords( str_replace("_"," ",$nivel_de_estudios) );
               }
               if(!empty($titulo)){
                 $content.="<br/><br/><h4>Título de estudios</h4>";
                 $content.= $titulo;
               }
               if(!empty($cumpleanios)){
                 $content.="<br/><br/><h4>Cumpleaños:</h4>";
                 $content.= $cumpleanios;
               }
               if(!empty($color_de_ojos)){
                 $content.="<br/><br/><h4>Color de Ojos:</h4>";
                 $content.= $color_de_ojos;
               }
               if(!empty($bebida_favorita)){
                 $content.="<br/><br/><h4>Bebida Favorita:</h4>";
                 $content.= $bebida_favorita;
               }
               if(!empty($color_de_cabello)){
                 $content.="<br/><br/><h4>Color de cabello:</h4>";
                 $content.= $color_de_cabello;
               }
               if(!empty($fuma)){
                 $content.="<br/><br/><h4>Fuma:</h4>";
                 $content.= $fuma;
               }
               if(!empty($altura)){
                 $content.="<br/><br/><h4>Altura (cm):</h4>";
                 $content.= $altura;
               }
               if(!empty($tipo_de_cuerpo)){
                 $content.="<br/><br/><h4>Tipo de Cuerpo:</h4>";
                 $content.= $tipo_de_cuerpo;
               }
               if(!empty($otros_idiomas)){
                 $content.="<br/><br/><h4>Otros idiomas:</h4>";
                 $content.= $otros_idiomas;
               }
               if(!empty($estado_civil)){
                 $content.="<br/><br/><h4>Estado Civil:</h4>";
                 $content.= $estado_civil;
               }
               if(!empty($vivo_en)){
                 $content.="<br/><br/><h4>Vivo en:</h4>";
                 $content.= $vivo_en;
               }
               if(!empty($musica_favorita)){
                 $content.="<br/><br/><h4>Música Favorita:</h4>";
                 $content.= $musica_favorita;
               }
               if(!empty($pelicula_favorita)){
                 $content.="<br/><br/><h4>Película Favorita:</h4>";
                 $content.= $pelicula_favorita;
               }
               if(!empty($deporte)){
                 $content.="<br/><br/><h4>Practica algún deporte:</h4>";
                 $content.= $deporte;
               }
               if(!empty($depotes_que_practico)){
                 $content.="<br/><br/><h4>Deportes:</h4>";
                 $content.= $depotes_que_practico;
               }
               if(!empty($toca_algun_instrumento)){
                 $content.="<br/><br/><h4>Toca algún instrumento musical:</h4>";
                 $content.= $toca_algun_instrumento;
               }
               if(!empty($cuales_instrumentos_musicales)){
                 $content.="<br/><br/><h4>Instrumentos musicales:</h4>";
                 $content.= $cuales_instrumentos_musicales;
               }
               if(!empty($hobbies)){
                 $content.="<br/><br/><h4>Hobbies:</h4>";
                 $content.= $hobbies;
               }
               if(!empty($comida_favorita)){
                 $content.="<br/><br/><h4>Comida Favorita:</h4>";
                 $content.= $comida_favorita;
               }
               if(!empty($ciudad_favorita_del_mundo)){
                 $content.="<br/><br/><h4>Ciudad favorita del mundo:</h4>";
                 $content.= $ciudad_favorita_del_mundo;
               }
               if(!empty($me_gustaria)){
                 $content.="<br/><br/><h4>Me gustaria:</h4>";
                 $content.= $me_gustaria;
               }

               $content.='
            </div>
            <div class="style2-columns large-4 columns intereses-buddyeva">
              <br/><h3 class="text-center primary-text-color">Intereses</h3>';

              $count = 0;
              $content.= '<div class="row as_45454sd">';

              if(!empty($intereses)):

                foreach($intereses as $interes){
                  if(!empty($interes)){
                    $content.= '<div class="columns small-12 medium-3 text-center redim_6592"><div id= "ahg_54854"><div class= "nvhf_3568"> <i class="'.$interes.'"></i></div> </div><i class="pqwo_985"<br>'.str_replace("_","<br>",$interes).'</i> </div>';
                    $count++;
                  }
                }
              endif;

              $content.='</div>';
              $content.='</div>';
              $content.='</h1>';
              $content.='</h1>';
            $content.= '<div class="style3-columns col-fit columns que-busco-buddyeva text-justify">
            <br/><h3 class="primary-text-color text-center">Estoy buscando</h3><br/>';
            $content.= $pareja_ideal_wc;
            if(!empty($caracter)){
              $content.="<br/><br/><h4>Carácter:</h4>";
              $content.= $caracter;
            }
            if(!empty($biografia)){
              $content.="<br/><br/><h4>Biografía:</h4>";
              $content.= $biografia;
            }
            $content.='
            </div>
          </div>
        </div>';
        $content.='</div>';

        if(!empty($carousel_id[0])):
          $carousel = '[wonderplugin_carousel id="'.$carousel_id[0].'"]';
          echo do_shortcode($carousel);
        endif;

        echo $content;

      endif;
    endif;

 }

 add_action('wp_footer','buddyeva_js');
 function buddyeva_js(){
     wp_register_script('buddyeva-js',plugin_dir_url(__FILE__).'includes/js/buddyeva.js',array('jquery'));
     wp_enqueue_script('jquery');
     wp_enqueue_script('buddyeva-js');
 }


 function ventana_regalo(){
 // 	global $current_user;
  //  get_currentuserinfo();
  //
 // 	if(isset($current_user->feel_wc) and !empty($current_user->feel_wc)):
 // 		$feel_wc = $current_user->feel_wc;
 // 	else:
 // 		$feel_wc = "";
 // 	endif;

 echo
 '<div class="modal fade"  id="ventana-regalo" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
 		<div class="modal-footer">
 		<button type="button" class="btn btn-default" data-dismiss="modal">X</button>
 		</div>
 		<div class="modal-dialog">
         <div class="modal-content alt_modal">
 					<div class="modal-body">

              <div class="row-fluid">
                <div class="col-sm-3"><img src="' . plugins_url("gift-1.gif",__FILE__) . '" class="img-responsive" alt="Regalo"><input type="checkbox" id="inlineCheckbox1" value="option1"></div>
                <div class="col-sm-3"><img src="' . plugins_url("gift-2.png",__FILE__) . '" class="img-responsive" alt="Regalo"><input type="checkbox" id="inlineCheckbox1" value="option1"></div>
                <div class="col-sm-3"><img src="' . plugins_url("gift-3.gif",__FILE__) . '" class="img-responsive" alt="Regalo"><input type="checkbox" id="inlineCheckbox1" value="option1"></div>
                <div class="col-sm-3"><img src="' . plugins_url("gift-4.jpg",__FILE__) . '" class="img-responsive" alt="Regalo"><input type="checkbox" id="inlineCheckbox1" value="option1"></div>
              </div>

              <div class="row text-center">
                <div class="col-sm-2"><a href="#" class="btn btn-primary">Regalar</a></div>
              </div>

 					</div>
 				</div>
 		</div>
  </div> ';
 }
 add_action('wp_head','ventana_regalo');

function buddyeva_add_tab() {
    global $bp;

    bp_core_new_subnav_item( array(
        'name'              => 'Editar',
        'slug'              => 'editar',
        'parent_url'        => trailingslashit( bp_displayed_user_domain() . $bp->profile->slug ),
        'parent_slug'       => $bp->profile->slug,
        'screen_function'   => 'buddyeva_add_tab_screen',
        'position'          => 20,
        'user_has_access'   => bp_is_my_profile()
    ) );
}
add_action( 'bp_setup_nav', 'buddyeva_add_tab', 100 );


function buddyeva_add_tab_screen() {
    add_action( 'bp_template_content', 'buddyeva_add_tab_screen_content' );
    bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function buddyeva_add_tab_screen_content() {
    wc_get_template('myaccount/form-edit-account.php');
}

function i_feel_act(){
  global $current_user;
  get_currentuserinfo();
  $id = bp_displayed_user_id();
  $usuario = get_userdata($id);

  if(isset($usuario->feel_wc) and !empty($usuario->feel_wc)):
		$feel_wc = $usuario->feel_wc;
	else:
		$feel_wc = "";
	endif;

  echo
'<div id="contenedor_feel" class="contenedor_feel">
    <div id= "i-feel" class="columns i-feel"> '.$feel_wc;

  if(bp_is_my_profile()){
    echo ' <a id="edit-feel" class="edit-feel btn btn-xs btn-default"><span class=" fa fa-pencil-square-o"></span> </a>';
  }

  echo '</div>
  </div>';
}

add_action('bp_after_member_header', 'i_feel_act');



function boton_regalo(){
  // global $current_user;
  // get_currentuserinfo();
  // $id = bp_displayed_user_id();
  // $usuario = get_userdata($id);
  //
  // if(isset($usuario->feel_wc) and !empty($usuario->feel_wc)):
	// 	$feel_wc = $usuario->feel_wc;
	// else:
	// 	$feel_wc = "";
	// endif;


  if(!bp_is_my_profile()){
    echo '<a id="regalo" class="btn btn-default"><span class=" fa fa-gift"></span> </a>';
  }

}

add_action('bp_after_member_header', 'boton_regalo');



?>
