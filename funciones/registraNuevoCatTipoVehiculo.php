<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '' ;
$userReg = $_SESSION['ATZident'];

if ($nombre == '') {
  errorBD('Hay un Error debes ingresar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {
  $sql = "SELECT * FROM cattipovehiculos WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant>0) {
    errorBD('Ya se encuentra un tipo de vehículo con ese nombre: <b>'.nombre.'<b>.');
  } else {
    $sql="INSERT INTO cattipovehiculos(nombre, estatus, idUserReg, fechaReg) VALUES('$nombre','1','$userReg',NOW())";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

    $_SESSION['ATZmsjSuccesAdminTipoVehiculo'] = 'El Tipo de Vehículo <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Admin/catTiposVehiculos.php');
  }


}

function errorBD($error){
  $_SESSION['ATZmsjAdminTipoVehiculo'] = $error;
  //echo 'cayo'.error;
  header('location: ../Admin/catTiposVehiculos.php');
  exit(0);
}
?>
