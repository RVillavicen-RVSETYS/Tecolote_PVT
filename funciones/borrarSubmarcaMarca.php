<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;

if ($ident == '') {
  errorBD('inténtalo de nuevo o Notifica al Administrador.');

} else {
  $sql="DELETE FROM catsubmarcas WHERE id = $ident LIMIT 1";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

  echo '1';
}

function errorBD($error){
  echo '0|'.$error;
  exit(0);
}
?>
