<?php
if(!defined('INCLUDE_CHECK')) die('No se puede leer este archivo');
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set('Mexico/General');
/**
 * 
 */
class conectar
{
	
	public static function conexion(){
		$link = new mysqli("localhost", "u619350364_tecolote", "T3c0l0t3D4t4b4s3..", "u619350364_tecolote");


		if ($link->connect_error) {
    		die('Error de Conexión (' . $link->connect_errno . ') '. $link->connect_error);
		}
	    /* change character set to utf8 */
		if (!$link->set_charset("utf8")) {
			printf("Error al Cargar caracter de utf8: %s\n", $link->error);
		}
		$link->query("SET lc_time_names = 'es_ES'");
		$link->query("SET time_zone = '-06:00'");

		return $link;
	}
}


