<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = $_POST['idAsignacion'];
/*
echo '<br>====  $_POST  ====<br>';
print_r($_POST);
echo '<br>====  $_POST  ====<br>';
#*/

$sql="UPDATE asignavehiculos SET estatus = '2' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
#echo '<br>$sql: '.$sql.'<br>';
$_SESSION['ATZmsjSuccesEncargadoAsignaV'] = 'La desasignación se a realizado Corrrectamente.';
header('location: ../Encargado/asignaVehiculo.php');

function errorBD($error){
  $_SESSION['ATZmsjEncargadoAsignaV'] = $error;
  header('location: ../Encargado/asignaVehiculo.php');
  exit(0);
}
?>
