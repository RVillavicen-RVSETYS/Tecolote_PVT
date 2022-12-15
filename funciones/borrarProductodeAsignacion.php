<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$idProd = (isset($_POST['idProd'])) ? $_POST['idProd'] : '' ;
$idDetAS = (isset($_POST['idDetAS'])) ? $_POST['idDetAS'] : '' ;
$idUser = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;

if ($idProd == '') {
  errorBD('inténtalo de nuevo o Notifica al Administrador.');

} else {
  $ident = base64_decode($idProd);
  $sql="UPDATE stocks SET estatus = '1' WHERE id = '$ident' ";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> 1Por favor notifica al Administrador.'.mysqli_error($link)));


  $sql="DELETE FROM detasigna WHERE idStock = '$ident' AND id = '$idDetAS' AND estatus = '1'  ";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));

  echo '1|Se ha borrado Correctamente.|'.$ident;
}

function errorBD($error){
  echo '0|'.$error;
  exit(0);
}
?>
