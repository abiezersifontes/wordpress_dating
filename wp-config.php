<?php
/**
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'test');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'abiezer');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '21aj264363');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', '192.168.0.100');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'Xiiw<v1{#9`:9}wVfv5%BGl-a*atXr-/-=hy_m`IVb}qs~M[N&2(1m]*A8zGC<nW');
define('SECURE_AUTH_KEY', 'BJb=xoKS017=N/yl-Sb]@?>4wYr]T?q7@fzDW]izJgG`CfN[vFSGnZr>v.M/!d(;');
define('LOGGED_IN_KEY', '6`y!6P+{`#YH8f+l=-!774Pdr.Rh<e:(M;zkFNtER}`3Rs~)PnKN]lEv))h#5kmV');
define('NONCE_KEY', '3@Pf KMMGo~$xt/W,a3hmNQ[]H)2ZV{]V34q/s1]:iB3C[.m-%<pE==E#k=cc1k;');
define('AUTH_SALT', '$&s,wv2ln.%ec7QL5zKh^2qes):2V0,V+e_*OESH67^0I9Lv.Z:WdjwkYL,9TL@r');
define('SECURE_AUTH_SALT', 'vtv] c3m0Natg4dY&VQJGDg:M?-JBRenPh6H.5w#%;Z:7`5^s*UH_}zx^A{F`4^;');
define('LOGGED_IN_SALT', 'b~NiAM;OsCcE>+k`0;Ap`8m6W3p0bb/O~&=AV}v%9il)/,sJ3wCrX5^ofcrujB9:');
define('NONCE_SALT', ' )3wO7*YuSws_=V*bL{g<;6#({v>UPuFlvF}Q1[RT3$Y*9#Xb12Ev8&;]FDB@&({');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'ev7_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
