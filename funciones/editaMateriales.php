<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = $_POST['ident'];
$nombre = $_POST['nombre'];
$estatus = $_POST['estatus'];
#print_r($_POST);
#echo '<br>estatus: '.$estatus.'<br>';

$sql="UPDATE catmateriales SET nombre = '$nombre', estatus = '$estatus' WHERE id = '$ident'";
#echo '<br>sql: '.$sql;
$result=mysqli_query($link,$sql) or die('Problemas al guardar los Datos. ');

$_SESSION['ATZmsjSuccesAdminMateriales'] = 'Tu Material <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Admin/catMateriales.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminMateriales'] = $error;
header('location: ../Admin/catMateriales.php');
exit(0);
}
?>
