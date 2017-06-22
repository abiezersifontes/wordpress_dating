<?php

add_action('wp_head','window');
add_action('wp_ajax_ventana_modal','ventana');
add_action('wp_ajax_nopriv_ventana_modal','ventana');
/*----------------------------------------------------------------------------------
                            Formulario de Busqueda
------------------------------------------------------------------------------------*/
function busq(){

?>
	<div class="header-search-form-wrapper html" style="position:relative;">
		<div class="searchform-wrapper ux-search-box relative form-flat is-normal">
<form method="get" class="searchform1" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" role="search">

		<div class="flex-row" style="position: absolute; left: -230px; top: -20px; width:200px;">
			<div class="flex-col flex-grow">
			  <input type="search" class="search-field1 mb-0" name="nombre" value="" placeholder="Buscar" autocomplete="off">
		    <input type="hidden" name="post_type" value="product">
		  </div><!-- .flex-col -->
			<div class="flex-col">
				<!--<button type="submit" class="ux-search-submit submit-button secondary button icon mb-0">-->
        <button type="submit" class="ux-search-submit submit-button1 secondary button icon mb-0">
					<i class="icon-search"></i>
        </button>
			</div><!-- .flex-col -->
		</div><!-- .flex-row -->



		<div class="live-search-results" style="position: absolute; left: -230px; top: 20px; width:200px;">
			<div class="autocomplete-suggestions" style="display: none;">
				<div id="autocompletar" class="autocomplete-suggestion" data-index="0"><div class="search-name">No results</div>
			</div>
		</div>
	</div>
</form>
</div>
</div>

<!--<div id="autocompletar"></div>-->
<!--</li>-->
<?php
}
/*-------------------------------------------------------------------------------------*/

/*---------------------------------------
    Agregar campos al formulario de perfil
---------------------------------------*/
function agrega_mi_campo_personalizado( $checkout ) {
	$wc = new WC_Checkout;
	global $current_user;
	get_currentuserinfo();
	if(!isset($current_user->product_id) and empty($current_user->product_id)):
		if(isset($current_user->preferencia) and !empty($current_user->preferencia)):
			$preferencia_wc = $current_user->preferencia;
		else:
			$preferencia_wc = "";
		endif;

			$numero_wc = $current_user->numero;

			if(isset($current_user->nacionalidad_wc) and !empty($current_user->nacionalidad_wc)):
				$nacionalidad_wc = $current_user->nacionalidad_wc;
			else:
				$nacionalidad_wc = "";
			endif;

				$cant_hijos_wc = $current_user->cant_hijos_wc;

			if(isset($current_user->ocupacion_wc) and !empty($current_user->ocupacion_wc)):
				$ocupacion_wc = $current_user->ocupacion_wc;
			else:
				$ocupacion_wc = "";
			endif;

				$edad_wc = $current_user->edad_wc;

			$all_intereses = array(
				'Viajes',
				'Musica',
				'Deportes',
				'Lectura',
				'Cocina',
				'Compras',
				'Animales',
				'Fotografia',
				'Paseos',
				'Teatro',
				'Informatica',
				'Museos',
				'Coches',
				'Television',
				'Bricolaje',
				'Pintura',
				'Danza',
				'Decoracion',
				'Videojuegos',
				'Jardineria',
				'Escritura',
				'Juegos_de_mesa',
				'Arte',
				'Cine',
				'Salir_con_amigos',
				'Pesca',
				'Cata_de_vinos',
				'Cantar',
				'Instrumento_musical');


			if(isset($current_user->pareja_ideal_wc) and !empty($current_user->pareja_ideal_wc)):
				$pareja_ideal_wc = $current_user->pareja_ideal_wc;
			else:
				$pareja_ideal_wc = "";
			endif;

			if(isset($current_user->fotografia_wc) and !empty($current_user->fotografia_wc))
				$fotografia_ck = "checked";
			else{
				$fotografia_ck = "";
			}

			if(isset($current_user->conducir_wc) and !empty($current_user->conducir_wc))
				$conducir_ck = "checked";
			else{
				$conducir_ck = "";
			}

			if(isset($current_user->comprar_wc) and !empty($current_user->comprar_wc))
				$comprar_ck = "checked";
			else{
				$comprar_ck = "";
			}

			if(isset($current_user->viajar_wc) and !empty($current_user->viajar_wc))
				$viajar_ck = "checked";
			else{
				$viajar_ck = "";
			}

			if(isset($current_user->deportes_wc) and !empty($current_user->deportes_wc))
				$deportes_ck = "checked";
			else{
				$deportes_ck = "";
			}

			if(isset($current_user->mirar_tv_wc) and !empty($current_user->mirar_tv_wc))
				$mirar_tv_ck = "checked";
			else{
				$mirar_tv_ck = "";
			}

			if(isset($current_user->musica_wc) and !empty($current_user->musica_wc))
				$musica_ck = "checked";
			else{
				$musica_ck = "";
			}

			if(isset($current_user->leer_wc) and !empty($current_user->leer_wc))
				$leer_ck = "checked";
			else{
				$leer_ck = "";
			}

				echo '<p class="form-row form-row " id="preferencia_field">
					<label for="preferencia" class="">Preferencia</label>
					<select name="preferencia" id="preferencia" class="select " data-allow_clear="true" data-placeholder="Elige una opción">';

				if($preferencia_wc == "h_b_m"){
					echo '<option value="h_b_m" selected>Hombre buscando mujer</option>
					<option value="h_b_h" >Hombre buscando hombre</option>
					<option value="m_b_h" >Mujer buscando hombre</option>
					<option value="m_b_m" >Mujer buscando mujer</option>';
				}elseif($preferencia_wc == "h_b_h"){
					echo '<option value="h_b_m" >Hombre buscando mujer</option>
					<option value="h_b_h" selected>Hombre buscando hombre</option>
					<option value="m_b_h" >Mujer buscando hombre</option>
					<option value="m_b_m" >Mujer buscando mujer</option>';
				}elseif($preferencia_wc == "m_b_h"){
					echo '<option value="h_b_m" >Hombre buscando mujer</option>
					<option value="h_b_h" >Hombre buscando hombre</option>
					<option value="m_b_h" selected>Mujer buscando hombre</option>
					<option value="m_b_m" >Mujer buscando mujer</option>';
				}elseif($preferencia_wc == "m_b_m"){
					echo '<option value="h_b_m" >Hombre buscando mujer</option>
					<option value="h_b_h" >Hombre buscando hombre</option>
					<option value="m_b_h" >Mujer buscando hombre</option>
					<option value="m_b_m" selected>Mujer buscando mujer</option>';
				}else{
					echo '<option value="h_b_m" >Hombre buscando mujer</option>
					<option value="h_b_h" >Hombre buscando hombre</option>
					<option value="m_b_h" >Mujer buscando hombre</option>
					<option value="m_b_m" >Mujer buscando mujer</option>';
				}

				echo '</select>
				</p>';

				echo '<p class="form-row form-row " id="numero_field">
				<label for="numero" class="">Número celular</label>
				<input type="tel"  name="numero" id="numero" placeholder="ej. 58 0123456789" value="'.$numero_wc.'" pattern="[0-9]{12}">
				</p>';

				echo '<p class="form-row form-row " id="nacionalidad_wc_field">
				<label for="nacionalidad_wc" class="">Nacionalidad</label>
				<input type="text" class="input-text " name="nacionalidad_wc" id="nacionalidad_wc" placeholder="Introduzca su nacionalidad" value="'.$nacionalidad_wc.'">
				</p>';

				echo '<p class="form-row form-row " id="cant_hijos_wc_field">
				<label for="cant_hijos_wc" class="">Hijos</label>
				<input type="number" name="cant_hijos_wc" id="cant_hijos_wc" placeholder="Introduzca cantidad de hijos" value="'.$cant_hijos_wc.'">
				</p>';

				echo '<p class="form-row form-row " id="ocupacion_wc_field">
				<label for="ocupacion_wc" class="">Ocupación</label>
				<input type="text" name="ocupacion_wc" id="ocupacion_wc" placeholder="Introduzca su ocupación" value="'.$ocupacion_wc.'">
				</p>';

				echo '<p class="form-row form-row " id="edad_wc_field">
				<label for="edad_wc" class="">Edad</label>
				<input type="number" min="0" name="edad_wc" id="edad_wc" placeholder="Introduzca su edad" value="'.$edad_wc.'" >
				</p>';

				echo '<div class="row" >';
				echo '<div class="columns medium-2"><label> '.__('Intereses: ').'</label></div>';
				echo '<div class="columns medium-4"><br><br>';

				$intereses_ant = $current_user->intereses;
				$count = 0;
				foreach ($all_intereses as $key => $inte) {
					$check = 0;
					if($count > 15){
						echo '</div><div class="columns medium-4"><br><br>';
						$count = 0;
					}
					if(!empty($intereses_ant)):
						foreach ($intereses_ant as  $inte_ant) {
							if($inte == $inte_ant){
									echo '<label class="checkbox"><input type="checkbox" class="input-checkbox " name="'.$inte.'" id="'.$inte.'" value="'.$inte.'"checked>&nbsp '.str_replace("_"," ",$inte).'</label>';
									$check = 1;
							}
						}
					endif;

						if($check != 1):
							echo '<label class="checkbox"><input type="checkbox" class="input-checkbox " name="'.$inte.'" id="'.$inte.'" value="'.$inte.'">&nbsp '.str_replace("_"," ",$inte).'</label>';
						endif;
					$count++;
				}


				echo '</div></div>';

				echo '<p class="form-row form-row " id="pareja_ideal_wc_field">
					<label for="pareja_ideal_wc" class="">Pareja ideal </label>
					<textarea name="pareja_ideal_wc" class="input-text " id="pareja_ideal_wc" placeholder="Describa a su pareja soñada" rows="2" cols="5">'. $pareja_ideal_wc .'</textarea>
				</p>';
			else:
				$id_post = $current_user->product_id;

				campo_editar($id_post, "preferencia","Preferencia","select",array("h_b_m" => "Hombre Buscando Mujer", "h_b_h" => "Hombre Buscando Hombre", "m_b_h" => "Mujer Buscando Hombre", "m_b_m" => "Mujer Buscando Mujer") );
				campo_editar($id_post, "edad", "Edad", "text");
				campo_editar($id_post, "nivel_de_estudios", "Nivel de estudios", "select", array("Estudios_basicos" => "estudios básicos", "estudios_generales" => "estudios generales", "formacion_profesional" => "Formación profesional", "estudios_universitarios" => "Estudios universitarios"));
				campo_editar($id_post, "titulo_de_estudios","Titulo de estudios", "text");
				campo_editar($id_post, "fecha_nacimiento","Fecha de Nacimiento","date");
				campo_editar($id_post, "ocupacion","Ocupación","text");
				campo_editar($id_post, "color_de_ojos","Color de ojos","select",array("Castano" => "Castaño", "Ambar" => "Ambar", "Avellana" => "Avellana", "Verde" => "Verde", "Azul" => "Azul", "Gris" => "Gris"));
				campo_editar($id_post, "bebida_favorita", "Bebida favorita","text");
				campo_editar($id_post, "color_de_cabello", "Color de cabello","text");
				campo_editar($id_post, "fuma","Fuma","select",array("Si" => "Si", "No" => "No"));
				campo_editar($id_post, "estatura", "Estatura(cm)","number");
				campo_editar($id_post, "tipo_de_cuerpo","Tipo de Cuerpo","select",array("Delgado" => "Delgado", "Atletico" => "Atlético", "Robusto" => "Robusto"));
				campo_editar($id_post, "otros_idiomas","Otros idiomas","text");
				campo_editar($id_post, "estado_civil","Estado civil","select",array("Soltero" => "Soltero", "Casado" => "Casado", "Divorciado" => "Divorciado", "Viudo" => "Viudo"));
				campo_editar($id_post, "vivo_en", "Vivo en","text");
				campo_editar($id_post, "nacionalidad","Nacionalidad","text");
				campo_editar($id_post, "hijos","Hijos","number");
				campo_editar($id_post, "musica_favorita", "Música favorita","text");
				campo_editar($id_post, "pelicula_favorita","Película favorita","text");
				campo_editar($id_post, "biografia", "Biografía","textarea");
				campo_editar($id_post, "caracter", "Caracter","textarea");
				campo_editar($id_post, "pareja_ideal", "Pareja ideal","textarea");
				campo_editar($id_post, "deporte" , "Deporte", "select", array("Si" => "Si", "No" => "No"));
				campo_editar($id_post, "deportes_que_practico", "Deportes que practico", "text");
				campo_editar($id_post, "toca_algun_instrumento", "Toca algún instrumento musical", "select", array("Si" => "Si", "No" => "No"));
				campo_editar($id_post, "cuales_instrumentos_musicales", "Cuales instrumentos musicales","text");
				campo_editar($id_post, "hobbies", "Hobbies","textarea");
				campo_editar($id_post, "comida_favorita", "Comida favorita","text");
				campo_editar($id_post, "ciudad_favorita_del_mundo", "Ciudad favorita del mundo","text");
				campo_editar($id_post, "me_gustaria", "Me gustaría","textarea");
				campo_editar($id_post, "imperfecciones", "Imperfecciones", "checkbox", array("siempre_llego_tarde" => "Siempre llego tarde", "puedo_ser_torpe" => "Puedo ser torpe","soy_sensible" => "Soy sensible","soy_un_soniador" => "Soy un soñador","soy_indeciso" => "Soy indeciso","soy_impulsivo" => "Soy impulsivo","soy_desorganizado" => "Soy desorganizado","soy_timido" => "Soy tímido","soy_hipocondriaco" => "Soy hipocondríaco"));
				campo_editar($id_post, "intereses", "Intereses", "checkbox", array(	'Viajes' => 'Viajes',	'Musica' => 'Musica',	'Deportes' => 'Deportes',	'Lectura' => 'Lectura',	'Cocina' => 'Cocina',	'Compras' => 'Compras',	'Animales' => 'Animales',	'Fotografia' => 'Fotografia',	'Paseos' => 'Paseos',	'Teatro' => 'Teatro',	'Informatica' => 'Informatica',	'Museos' => 'Museos',	'Coches' => 'Coches',	'Television' => 'Television',	'Bricolaje' => 'Bricolaje',	'Pintura' => 'Pintura',	'Danza' => 'Danza',	'Decoracion' => 'Decoracion',	'Videojuegos' => 'Videojuegos',	'Jardineria' => 'Jardineria',	'Escritura' => 'Escritura',	'Juegos_de_mesa' => 'Juegos de mesa',	'Arte' => 'Arte',	'Cine' => 'Cine',	'Salir_con_amigos' => 'Salir con amigos',	'Pesca' => 'Pesca',	'Cata_de_vinos' => 'Cata de vinos',	'Cantar' => 'Cantar',	'Instrumento_musical' => 'Instrumento musical'));

			endif;
		 }

		 function campo_editar($product_id, $campo, $label_def = "indique el nombre de su campo", $tipo, $opciones =array("Debe indicar una array con las opciones")){
			 $valor = get_post_meta($product_id,$campo);
			 if($tipo == "textarea"):
				 echo '<p class="form-row form-row" id="' . $campo . '_field">
				 <label for="' . $campo . '" class="">' . $label_def . ' </label>
				  <textarea name="' . $campo . '" class="input-text text-justify" id="' . $campo . '" placeholder="Indique su ' . str_replace("_"," ",$label_def ) . '" rows="2" cols="5">'. $valor[0] .'</textarea>
				 </p>';
			elseif($tipo == "text"):
				echo '<p class="form-row form-row " id="' . $campo . '_field">
				<label for="' . $campo . '" class="">' . $label_def . '</label>
				<input type="text" min="0" name="' . $campo . '" id="' . $campo . '" placeholder="Introduzca su ' .str_replace("_"," ", $label_def )  . '" value="'. $valor[0] .'" >
				</p>';
			elseif($tipo == "select"):
				if(isset($opciones) and !empty($opciones)):
					echo '<p class="form-row form-row " id="' . $campo . '_field">
						<label for="' . $campo . '" class="">' .   $label_def  . '</label>
						<select name="' . $campo . '" id="' . $campo . '" class="select " data-allow_clear="true" data-placeholder="Elige una opción">';
					foreach($opciones as $value => $label){
						if($value == $valor[0]){
							echo '<option value="' . $value . '" selected>' . $label . '</option>';
							continue;
						}
						echo '<option value="' . $value . '" >' .  $label . '</option>';
					}
				else:
					echo "debe indicar un campo";
				endif;
				echo '</select></p>';
		 	elseif($tipo == "date"):
				echo '<label for="' . $campo . '" >' .   $label_def  . '</label>
							<input name="' . $campo . '" value="' . $valor[0] . '" type="text" id="datepicker-md">';
			elseif($tipo == "number"):
				echo '<label for="' . $campo . '" >' .   $label_def  . '</label>
							<input name="' . $campo . '" value="' . $valor[0] . '" type="number">';

			elseif($tipo == "checkbox"):
				echo "<label>" . $label_def . "</label>";
				if(isset($opciones) and !empty($opciones)):
					echo '
					<div class="row">
						<div class="columns small-1 medium-1 large-1">

						</div>
						<div class="columns small-5 medium-5 large-5">
					';
					//declarando la mitad de la cantidad de checkboxs
					$mitad = round(count($opciones) / 2);
					//declarando contador para el primer for
					$nro_rows = 0;
					//for que recorre el total de checkboxs
					foreach($opciones as $value => $label){
						$contar = count($valor[0]);
						$nro_rows++;
						//evualndo si ya se ha llegado ala mitad
						if(($nro_rows-1) >= $mitad){
							echo '</div><div class="columns small-5 medium-5 large-5">';
							$nro_rows = 0;
						}
						//for que recorre los checkbox que se encuentran selccionados
						foreach($valor[0] as $resultado => $titulo ){
							if($value == $titulo){
								echo '<label class="checkbox">
								<input type="checkbox" class="input-checkbox " name="'.$value.'" id="'.$value.'" value="'.$value.'"checked>&nbsp '. $label . '</label>';
								break;
							}elseif($value != $titulo){
								$contar = $contar - 1;
							}

							if($contar < 1){
								echo '<label class="checkbox"><input type="checkbox" class="input-checkbox " name="'.$value.'" id="'.$value.'" value="'.$value.'">&nbsp ' . $label . '</label>';
							}

						}
					}
					echo '
						</div><!--column-->
					</div><!--row-->
					';
				else:
					echo "debe indicar un array";
				endif;


			endif;
	 	}
/*-------------------------------------
              guardar en bd
---------------------------------------*/

function my_custom_checkout_field_update_order_meta() {
  global $current_user;
  get_currentuserinfo();

		$imperfe = array("siempre_llego_tarde" => "Siempre llego tarde", "puedo_ser_torpe" => "Puedo ser torpe",
		"soy_sensible" => "Soy sensible","soy_un_soniador" => "Soy un soñador","soy_indeciso" => "Soy indeciso",
		"soy_impulsivo" => "Soy impulsivo","soy_desorganizado" => "Soy desorganizado","soy_timido" => "Soy tímido",
		"soy_hipocondriaco" => "Soy hipocondríaco");

		foreach($imperfe as $llave => $imperfe_val){
			if($_POST[$llave]){
				$imperfecciones[] = $_POST[$llave];
			}
		}

		$intere = array('Viajes', 'Musica', 'Deportes', 'Lectura', 'Cocina', 'Compras', 'Animales', 'Fotografia', 'Paseos', 'Teatro', 'Informatica', 'Museos', 'Coches', 'Television',
		'Bricolaje', 'Pintura', 'Danza', 'Decoracion', 'Videojuegos', 'Jardineria', 'Escritura', 'Juegos_de_mesa', 'Arte', 'Cine', 'Salir_con_amigos', 'Pesca', 'Cata_de_vinos',
		'Cantar', 'Instrumento_musical');

		foreach($intere as $key => $intere_val){
			if($_POST[$intere_val]){
				$intereses[] = $_POST[$intere_val];
			}
		}

		if($current_user->product_id){

			$product_int = get_field("intereses", $current_user->product_id);

			if(isset($product_int) or !empty($product_int)){
				update_post_meta( esc_attr($current_user->product_id), 'intereses', $intereses);
			}else {
				add_post_meta( esc_attr($current_user->product_id), 'intereses', $intereses);
			}

			if(isset($product_int) or !empty($product_int)){
				update_post_meta( esc_attr($current_user->product_id), 'imperfecciones', $imperfecciones);
			}else {
				add_post_meta( esc_attr($current_user->product_id), 'imperfecciones', $imperfecciones);
			}

			aniadir_campo_producto($current_user->product_id,"preferencia",$_POST['preferencia']);
			aniadir_campo_producto($current_user->product_id,"edad",$_POST['edad']);
			aniadir_campo_producto($current_user->product_id,"nivel_de_estudios",$_POST['nivel_de_estudios']);
			aniadir_campo_producto($current_user->product_id,"titulo_de_estudios",$_POST['titulo_de_estudios']);
			aniadir_campo_producto($current_user->product_id,"fecha_nacimiento",$_POST['fecha_nacimiento']);
			aniadir_campo_producto($current_user->product_id,"ocupacion",$_POST['ocupacion']);
			aniadir_campo_producto($current_user->product_id,"color_de_ojos",$_POST['color_de_ojos']);
			aniadir_campo_producto($current_user->product_id,"bebida_favorita",$_POST['bebida_favorita']);
			aniadir_campo_producto($current_user->product_id,"color_de_cabello",$_POST['color_de_cabello']);
			aniadir_campo_producto($current_user->product_id,"fuma",$_POST['fuma']);
			aniadir_campo_producto($current_user->product_id,"estatura",$_POST['estatura']);
			aniadir_campo_producto($current_user->product_id,"tipo_de_cuerpo",$_POST['tipo_de_cuerpo']);
			aniadir_campo_producto($current_user->product_id,"otros_idiomas",$_POST['otros_idiomas']);
			aniadir_campo_producto($current_user->product_id,"estado_civil",$_POST['estado_civil']);
			aniadir_campo_producto($current_user->product_id,"vivo_en",$_POST['vivo_en']);
			aniadir_campo_producto($current_user->product_id,"nacionalidad",$_POST['nacionalidad']);
			aniadir_campo_producto($current_user->product_id,"hijos",$_POST['hijos']);
			aniadir_campo_producto($current_user->product_id,"musica_favorita",$_POST['musica_favorita']);
			aniadir_campo_producto($current_user->product_id,"pelicula_favorita",$_POST['pelicula_favorita']);
			aniadir_campo_producto($current_user->product_id,"biografia",$_POST['biografia']);
			aniadir_campo_producto($current_user->product_id,"caracter",$_POST['caracter']);
			aniadir_campo_producto($current_user->product_id,"pareja_ideal",$_POST['pareja_ideal']);
			aniadir_campo_producto($current_user->product_id,"deporte",$_POST['deporte']);
			aniadir_campo_producto($current_user->product_id,"deportes_que_practico",$_POST['deportes_que_practico']);
			aniadir_campo_producto($current_user->product_id,"toca_algun_instrumento",$_POST['toca_algun_instrumento']);
			aniadir_campo_producto($current_user->product_id,"cuales_instrumentos_musicales",$_POST['cuales_instrumentos_musicales']);
			aniadir_campo_producto($current_user->product_id,"hobbies",$_POST['hobbies']);
			aniadir_campo_producto($current_user->product_id,"comida_favorita",$_POST['comida_favorita']);
			aniadir_campo_producto($current_user->product_id,"ciudad_favorita_del_mundo",$_POST['ciudad_favorita_del_mundo']);
			aniadir_campo_producto($current_user->product_id,"me_gustaria",$_POST['me_gustaria']);

		}else{

			if (isset($_POST['preferencia']) and !empty($_POST['preferencia'])):
				 if(isset($current_user->preferencia) and !empty($current_user->preferencia)){
					update_user_meta( esc_attr($current_user->id), 'preferencia', esc_attr($_POST['preferencia']));
				 }else {
					add_user_meta(esc_attr($current_user->id),'preferencia', esc_attr($_POST['preferencia']));
				 }
			endif;

			if(isset($_POST['numero']) and !empty($_POST['numero'])):
				if(isset($current_user->numero) or !empty($current_user->numero)){
					 update_user_meta( esc_attr($current_user->id), 'numero', esc_attr($_POST['numero']));
				}else {
					 add_user_meta( esc_attr($current_user->id), 'numero', esc_attr($_POST['numero']));
				}
			endif;


			if(isset($_POST['nacionalidad_wc']) and !empty($_POST['nacionalidad_wc'])):
				if(isset($current_user->nacionalidad_wc) or !empty($current_user->nacionalidad_wc)){
					 update_user_meta( esc_attr($current_user->id), 'nacionalidad_wc', esc_attr($_POST['nacionalidad_wc']));
				}else {
					 add_user_meta( esc_attr($current_user->id), 'nacionalidad_wc', esc_attr($_POST['nacionalidad_wc']));
				}
			endif;

			// if(isset($_POST['cant_hijos_wc']) and !empty($_POST['cant_hijos_wc'])):
				if(isset($current_user->cant_hijos_wc)){
					 update_user_meta( esc_attr($current_user->id), 'cant_hijos_wc', esc_attr($_POST['cant_hijos_wc']));
				}else {
					 add_user_meta( esc_attr($current_user->id), 'cant_hijos_wc', esc_attr($_POST['cant_hijos_wc']));
				}
			// endif;

			if(isset($_POST['ocupacion_wc']) and !empty($_POST['ocupacion_wc'])):
				if(isset($current_user->ocupacion_wc) or !empty($current_user->ocupacion_wc)){
					 update_user_meta( esc_attr($current_user->id), 'ocupacion_wc', esc_attr($_POST['ocupacion_wc']));
				}else {
					 add_user_meta( esc_attr($current_user->id), 'ocupacion_wc', esc_attr($_POST['ocupacion_wc']));
				}
			endif;

			if(isset($_POST['edad_wc']) and !empty($_POST['edad_wc'])):
				if(isset($current_user->edad_wc) or !empty($current_user->edad_wc)){
					 update_user_meta( esc_attr($current_user->id), 'edad_wc', esc_attr($_POST['edad_wc']));
				}else {
					 add_user_meta( esc_attr($current_user->id), 'edad_wc', esc_attr($_POST['edad_wc']));
				}
			endif;
			if(isset($current_user->intereses) or !empty($current_user->intereses)){
				update_user_meta( esc_attr($current_user->id), 'intereses', $intereses);
			}else {
				add_user_meta( esc_attr($current_user->id), 'intereses', $intereses);
			}
	 	}


}


/*-------------------------------------
---------------------------------------*/


/*-----------------------------
    Formulario de Login
-------------------------------*/

function formu_login() {
        $defaults = array(
            'message'  => 'hello',
        );
        woocommerce_login_form($defaults);
}

add_shortcode('formulogin','formu_login');

/*------------------------------
        Chequear formulario
-------------------------------*/

function wps_select_checkout_field_process() {
   global $woocommerce;
   // Check if set, if its not set add an error.
   if ($_POST['daypart'] == "blank")
    wc_add_notice( '<strong>Please select a day part under Delivery options</strong>', 'error' );
}


/*----------------------------
      Form de registro
----------------------------*/
function shortcode_register() {
    ?>
<head>
</head>
        <div id="contenido">
            <form class="registro">

            <div id="cabecera">
            <img src="/wp-content/uploads/2016/10/logo_2.png">
            </div>
            <h3 class= "titulo_reg"> UNIRSE DE MANERA SEGURA</h3>
                 <?php
	$is_facebook_login = in_array( 'nextend-facebook-connect/nextend-facebook-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
	$is_google_login = in_array( 'nextend-google-connect/nextend-google-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
?>
        <div class="text-left social-login pb-half pt-half">
	<?php
	if( $is_facebook_login && get_option('woocommerce_enable_myaccount_registration')=='yes' && !is_user_logged_in())  {
		 ?>
		<a href="<?php echo wp_login_url(); ?>?loginFacebook=1&redirect=<?php echo the_permalink(); ?>"
		class="button social-button large facebook circle"
		onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1&redirect='+window.location.href; return false;"><i class="icon-facebook"></i>
		<span><?php _e('Login with <strong>Facebook</strong>','flatsome'); ?></span></a>
	<?php
}
?>
        </div>
        <div id="cuerpo">
            <hr align="center">
            <table class="tab_registrate">
                <tr>
                    <td>
            <label for ="preference" class="label_reg">Soy</label>
                    </td>
                    <td>
        <select id="reg_preference" class="soy">
            <option value="h_b_m">Hombre buscando a mujer</option>
            <option value="h_b_h">Hombre buscando a hombre</option>
            <option value="m_b_h">Mujer buscando a hombre</option>
            <option value="m_b_m">Mujer buscando a mujer</option>
        </select>
                   <div id="mensaje1" class="errores"></div>
                    </td>
                </tr>
                <tr>
                    <td>
        <label for="text" class="label_reg">Usuario</label> </td>
                    <td>
            <input type="text" id="reg_username" class= "text_form" name="text"/>
                   <div id="mensaje2" class="errores"></div>
                    </td>
                </tr>
                <tr><td>
        <label for="text1" class="label_reg">Correo</label>
                    </td>
                    <td>
            <input type="email" id="reg_email" class="mail_reg" name="text1"/>
               <div id="mensaje3" class="errores"></div>
                </td>
                </tr>
                <tr><td>
        <label for="text2" class="label_reg">Contraseña</label>
                    </td>
                    <td>
            <input type="password" id="reg_password" class="contraseña_reg" name="text2"/>
                   <div id="mensaje4" class="errores"></div>
                    </td>
                </tr>
            </table>
            <input class="registrar" id="guardar" type="submit" name="registrarme" value="Registrarme"/>

            <div id= "pie_de_form">
            <?php
                $icon_style = get_theme_mod('account_icon_style');


                if(is_woocommerce_activated()){ ?>
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"
                        class="nav-top-link nav-top-not-logged-in  <?php if($icon_style && $icon_style !== 'image') echo get_flatsome_icon_class($icon_style, 'small'); ?>"
                        <?php if(get_theme_mod('account_login_style','lightbox') == 'lightbox') echo 'data-open="#login-form-popup"'; ?>
                      >Login
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

            ?>
            </div>
        </div>
        </form>
        </div>

    <?php
}

function window_feel(){
	global $current_user;
  get_currentuserinfo();

	if(isset($current_user->feel_wc) and !empty($current_user->feel_wc)):
		$feel_wc = $current_user->feel_wc;
	else:
		$feel_wc = "";
	endif;

echo
'<div class="modal fade"  id="feel_show" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">X</button>
		</div>
		<div class="modal-dialog">
        <div class="modal-content alt_modal">
					<div class="modal-body">
							<div class="feel_text">
									<textarea maxlength="140" name="feel_wc" class="input-text " id="feel_wc" placeholder="Comparte lo que sientes en 140 caracteres" rows="2" cols="5">'. $feel_wc .'</textarea>
							</div>
							<div id="btn_guardar">
							<center><a id="btn_guardar_feel" name="btn_guardar_feel" class="uppercase btn btn-lg btn-primary">Guardar</a></center>
							</div>
					</div>
				</div>
		</div>
 </div> ';
}

function feel_process(){

	global $current_user;
	get_currentuserinfo();
	$feel_wc = $_POST['feel_wc'];

	aniadir_campo_usuario($current_user->id,"feel_wc",$_POST['feel_wc']);

	$url = home_url() . '/perfil/' . $user->user_login;
	// return $url;
	return $feel_wc;
}

add_action('wp_ajax_feel','feel_process');
add_action('wp_ajax_nopriv_feel','feel_process');

add_action('wp_head','window_feel');
