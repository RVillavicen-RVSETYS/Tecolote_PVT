<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();
$fecha = date('d-m-Y');

$ident = $_POST['ident'];
$nombre = (isset($_POST['nombre']) AND $_POST['nombre'] != '') ? $_POST['nombre'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';

if ($estatus == '' OR $nombre == '') {
  errorBD('Hay un Error, debes seleccionar un <b>Nombre</b> y un <b>Estado</b> , inténtalo de Nuevo.');
}
//print_r($_POST);

$sql="UPDATE catmarcas SET nombre = '$nombre', estatus = '$estatus' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

$_SESSION['ATZmsjSuccesAdminMarca'] = 'Tu Marca <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Admin/catMarcas.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminMarca'] = $error;
  header('location: ../Admin/catMarcas.php');
  exit(0);
}
?>
