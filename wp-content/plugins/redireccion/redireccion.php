<?php
/*
plugin name: redireccion
plugin URI: http://localhost
Description: este plugin permite la redireccion si estoy logueado al inicio y si no al home, ademas tambien muestra una ventana modal al usuario que trata de ingresar mas alla del inicio
Author: Joselyn
Author URI: http://www.codeplus.com.ve
License : GPL2
*/

/*======================================
      Condicional para redireccionar
=======================================*/

add_action('wp_ajax_ventana_modal','ventana');
add_action('wp_ajax_nopriv_ventana_modal','ventana');
add_action('template_redirect', 'redirect_members_page');

add_action('wp','modal_init');

add_action('wp','usuarios_registrados');
add_action('wp_head','window');
add_action('wp_footer','first_script');

function modal_init(){
    wp_register_script('redireccion-js',plugin_dir_url(__FILE__).'js/redireccion.js',array('jquery'));
    wp_register_script('boot_modal-js',plugin_dir_url(__FILE__).'js/bootstrap.min.js',array('jquery'));
    wp_enqueue_script('jquery');
    wp_enqueue_script('redireccion-js');
    wp_enqueue_script('boot_modal-js');

}
function redirect_members_page() {
    if ( is_page('perfil') && ! bp_is_my_profile() ) {
        $user = get_userdata( get_current_user_id() );
        wp_redirect( home_url() . '/perfil/' . $user->user_login );
        exit;
    }
}


function usuarios_registrados(){
$dir_actual = 'http://' .  $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
$dir_base = 'http://' .  $_SERVER['HTTP_HOST'];
$dir_inicio = $dir_base . "/inicio"."/";
$loged = is_user_logged_in();

  if ($loged):
    if($dir_actual == $dir_base."/"){
      wp_redirect("/inicio");
    }
  endif;

  if (!is_user_logged_in()):
    if ($dir_actual == $dir_inicio) {
      wp_redirect($dir_base);
    }
  endif;
}

function ventana(){

    if (is_user_logged_in()){
        $loged = 1;
    }else{
        $loged = 2;
    }
    echo $loged;
    exit();
}


/*==========================================
VENTANA MODAL PARA INGRESAR
============================================*/
function window(){ ?>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-body">
                <div class="account-container lightbox-inner">
                   <h3 class="uppercase"><center class="text-modal">Acceder para visualizar este perfil</center></h3>
                    <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                        <div class="hola" id="customer_login">
                            <div class="col-1 large-6 col pb-0">
                            <?php endif; ?>
                                <div class="account-login-inner">
                                    <form method="post" class="prueba">

			                             <?php do_action( 'woocommerce_login_form_start' ); ?>
			                             <p class="prueba2">
				                        <label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"    id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			                             </p>

			                             <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                        <label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
                                        </p>
                                        <?php do_action( 'woocommerce_login_form' ); ?>


                                        <p class="form-row">
                                            <?php wp_nonce_field( 'woocommerce-login' ); ?>
                                            <input type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
                                            <label for="rememberme" class="inline">
                                                <input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
                                            </label>
                                        </p>

                                        <p class="woocommerce-LostPassword lost_password">
                                            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
                                        </p>

                                        <div class="my-account-header page-title normal-title
	                                       <?php if($login_bg) echo 'dark featured-title'; ?>">

                                        <?php if($login_bg) { ?>
                                        <div class="page-title-bg fill bg-fill" <?php echo $login_bg; ?>>
                                            <div class="page-title-bg-overlay fill"></div>
                                        </div>
                                        <?php } ?>

                                                    <?php
                                        $is_facebook_login = in_array( 'nextend-facebook-connect/nextend-facebook-connect.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

                                        $login_text = flatsome_option('facebook_login_text');
                                        $login_bg = flatsome_option('facebook_login_bg');
                                        $login_bg = $login_bg ? 'style="background-image:url('.do_shortcode($login_bg).')"' : '';
                                        ?>


	                                       <div class="page-title-inner flex-row  container">
                                                <div class="flex-col flex-grow <?php if(get_theme_mod('logo_position') == 'center') { echo 'text-center'; } else {echo 'medium-text-center'; } ?>">
                                                    <?php if(is_user_logged_in()){?>
                                                        <h1 class="uppercase mb-0"><?php the_title(); ?></h1>
                                                    <?php } // Loggeed In
                                                    else { ?>


                                                    <div class="text-center social-login">
                                                    <?php if(!$is_facebook_login && !$is_google_login) echo '<h1 class="uppercase mb-0">'.get_the_title().'</h1>'; ?>

                                                    <?php if( $is_facebook_login && get_option('woocommerce_enable_myaccount_registration')=='yes' && !is_user_logged_in())  { ?>
                                                    <a href="<?php echo wp_login_url(); ?>?loginFacebook=1&redirect=<?php echo the_permalink(); ?>"
                                                    class="button social-button large facebook circle"
                                                    onclick="window.location = '<?php echo wp_login_url(); ?>?loginFacebook=1&redirect='+window.location.href; return false;"><i class="icon-facebook"></i>
                                                    <span><?php _e('Login with <strong>Facebook</strong>','flatsome'); ?></span></a>
                                                    <?php }
                                                    if($login_text) { ?><p><?php echo do_shortcode($login_text); ?></p><?php } ?>
                                                    </div>
		 	                                        <?php }?>
                                                </div>
                                            </div>
                                        </div>

			                             <?php do_action( 'woocommerce_login_form_end' ); ?>
		                          </form>
                                </div><!-- .login-inner -->
                            </div>
                        </div>

                    </div>
                    <div id="miniatura" class="photo">
                 <?php echo '<br /><a class="img_ventana">' . woocommerce_get_product_thumbnail().'</a>';?>
                    </div>
                </div>
            </div>
        </div>
</div>
<?php
}

?>
