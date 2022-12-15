<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$nombre = (isset($_POST['nombreMarca'])) ? $_POST['nombreMarca'] : '' ;
$userReg = $_SESSION['ATZident'];
$idCatTabla = $_SESSION['ATZcampo1CatMarcas'];

if ($nombre == '') {
  errorBD('Hay un Error debes registrar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {
  $sql="INSERT INTO catmarcas(nombre, estatus, idCatTabla, idUserReg, fechaReg) VALUES('$nombre','1', '$idCatTabla', '$userReg',NOW())";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

  $_SESSION['ATZmsjSuccesAdminMarca'] = 'Tu Marca <b>'.$nombre.'</b> se a creado Corrrectamente.';
  header('location: ../Admin/catMarcas.php');
}

function errorBD($error){
  $_SESSION['ATZmsjAdminMarca'] = $error;
  //echo 'cayo';
  header('location: ../Admin/catMarcas.php');
  exit(0);
}
?>
