<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = $_POST['ident'];
$nombre = $_POST['nombre'];

//print_r($_POST);

$sql="UPDATE catbancos SET nombre = '$nombre' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die('Problemas al guardar los Datos. ');

$_SESSION['ATZmsjSuccesAdminBancos'] = 'Tu Banco <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Admin/catBancos.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminBancos'] = $error;
header('location: ../Admin/catBancos.php');
exit(0);
}
?>
