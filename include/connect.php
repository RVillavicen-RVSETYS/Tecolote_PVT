<?php
if(!defined('INCLUDE_CHECK')) die('No se puede leer este archivo');
date_default_timezone_set('Mexico/General');

/* Database config */

$db_host        = '82.165.209.227';
$db_user        = 'RVSetysTest';
$db_pass        = 'RV53ty5.p4$$wd';
$db_database    = 'Tecolote';

/* End config */

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database) or die('No se pudo realizar la conexion');
mysqli_select_db($link,$db_database);
mysqli_query($link, "SET names UTF8");
mysqli_query($link, "SET time_zone = '-06:00'");

?>
