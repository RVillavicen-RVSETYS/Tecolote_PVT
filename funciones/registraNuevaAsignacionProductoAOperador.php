<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$opAsigna = (isset($_POST['opAsigna'])) ? $_POST['opAsigna'] : '' ;
$userReg = $_SESSION['ATZident'];

print_r($_POST);
if ($opAsigna == '') {
  errorBD('Debes Seleccionar un Operador.');

}
$sql="INSERT INTO asignaciones(idAsignaVehiculo, idUserReg, fechaReg, estatus) VALUES('$opAsigna','$userReg',NOW(),'1')";

echo $sql;
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));

header('location: ../Encargado/adminInventario.php');


function errorBD($error){
  $_SESSION['SGTSSmsjAdminInventario'] = $error;
  echo 'cayo'.$error;
  //header('location: ../Encargado/adminInventario.php');
  exit(0);
}
?>
