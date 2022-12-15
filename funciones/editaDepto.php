<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = $_POST['ident'];
$nombre = $_POST['nombre'];
$estatus = $_POST['estatus'];

//print_r($_POST);

$sql="UPDATE catdeptos SET nombre = '$nombre', estatus= '$estatus' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));

$_SESSION['ATZmsjSuccesAdminCatDeptos'] = 'Tu Departamento <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Admin/catDeptos.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminCatDeptos'] = $error;
  header('location: ../Admin/catDeptos.php');
  exit(0);
}
?>
