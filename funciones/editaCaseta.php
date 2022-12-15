<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = $_POST['ident'];
$nombre = $_POST['nombre'];
$costo = $_POST['costo'];
$costo2 = $_POST['costo2'];
$costo3 = $_POST['costo3'];
$costo4 = $_POST['costo4'];
$costo5 = $_POST['costo5'];
$costo6 = $_POST['costo6'];

//print_r($_POST);

$sql="UPDATE casetas SET nombre = '$nombre', costo = '$costo', costo2 = '$costo2', costo3 = '$costo3', costo4 = '$costo4', costo5 = '$costo5', costo6 = '$costo6' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die('Problemas al guardar los Datos. ');

$_SESSION['ATZmsjSuccesAdminCatCasetas'] = 'Tu Caseta <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Admin/catCasetas.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminCatCasetas'] = $error;
header('location: ../Admin/catCasetas.php');
exit(0);
}
?>
