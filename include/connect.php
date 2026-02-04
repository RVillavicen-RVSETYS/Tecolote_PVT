<?php
if(!defined('INCLUDE_CHECK')) die('No se puede leer este archivo');
date_default_timezone_set('Mexico/General');

/* Database config */

$db_host		= 'localhost';
$db_user		= 'u619350364_tecolote';
$db_pass		= 'T3c0l0t3D4t4b4s3..';
$db_database	= 'u619350364_tecolote';

/* End config */

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database) or die('No se pudo realizar la conexion');
mysqli_select_db($link,$db_database);
mysqli_query($link, "SET names UTF8");
mysqli_query($link, "SET time_zone = '-06:00'");

?>
