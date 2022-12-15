<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$nombre = (isset($_POST['nombreMtto'])) ? $_POST['nombreMtto'] : '' ;
$userReg = $_SESSION['ATZident'];

if ($nombre == '') {
  errorBD('Hay un Error debes registrar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {

  $sql = "SELECT * FROM cattipomttos WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant >= 1) {
    errorBD('Ya hay un Tipo de Mantenimiento con el Nombre: <b>'.$nombre.'</b>.');
  } else {

    $sql="INSERT INTO cattipomttos(nombre, estatus, idUserReg, fechaReg) VALUES('$nombre','1','$userReg',NOW())";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

    $_SESSION['ATZmsjSuccesAdminMtto'] = 'Tu Mantenimiento <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Admin/catTipoMttos.php');
  }
}

function errorBD($error){
  $_SESSION['ATZmsjAdminMtto'] = $error;
  //echo 'cayo';
  header('location: ../Admin/catTipoMttos.php');
  exit(0);
}
?>
