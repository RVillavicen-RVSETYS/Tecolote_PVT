<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = $_POST['ident'];
$nombre = $_POST['nombre'];

//print_r($_POST);

$sql="UPDATE catcombustibles SET nombre = '$nombre' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die('Problemas al guardar los Datos. ');

$_SESSION['ATZmsjSuccesAdminTipoCombustible'] = 'Tu Combustible <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Admin/catCombustibles.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminTipoCombustible'] = $error;
header('location: ../Admin/catCombustibles.php');
exit(0);
}
?>
