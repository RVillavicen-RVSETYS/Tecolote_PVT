<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$nombre = (isset($_POST['nombreMtto'])) ? $_POST['nombreMtto'] : '' ;
$noEmergencia = (isset($_POST['noEmergencia'])) ? $_POST['noEmergencia'] : '' ;
$userReg = $_SESSION['ATZident'];

if ($nombre == '') {
  errorBD('Hay un Error debes registrar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {

  $sql = "SELECT * FROM aseguradoras WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant >= 1) {
    errorBD('Ya hay una Aseguradora con el Nombre: <b>'.$nombre.'</b>.');
  } else {

    $sql="INSERT INTO aseguradoras(nombre, noEmergencia, estatus, idUserReg, fechaReg) VALUES('$nombre', '$noEmergencia', '1','$userReg',NOW())";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

    $_SESSION['ATZmsjSuccesAseguradoras'] = 'Tu Aseguradora <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Admin/aseguradoras.php');
  }
}

function errorBD($error){
  $_SESSION['ATZmsjAseguradoras'] = $error;
  //echo 'cayo';
  header('location: ../Admin/aseguradoras.php');
  exit(0);
}
?>
