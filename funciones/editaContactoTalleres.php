<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();
$fecha = date('d-m-Y');

$ident = $_POST['ident'];
$nombre = (isset($_POST['nombre']) AND $_POST['nombre'] != '') ? $_POST['nombre'] : '';
$tel = (isset($_POST['tel']) AND $_POST['tel'] != '') ? $_POST['tel'] : '';
$cel = (isset($_POST['cel']) AND $_POST['cel'] != '') ? $_POST['cel'] : '';
$correo = (isset($_POST['correo']) AND $_POST['correo'] != '') ? $_POST['correo'] : '';

if ($nombre == '') {
  errorBD('Hay un Error, debes seleccionar un <b>Nombre</b> , inténtalo de Nuevo.');
}
//print_r($_POST);

$sql="UPDATE contactos SET nombre = '$nombre', telOf = '$tel', cel = '$cel', correo = '$correo' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

$_SESSION['ATZmsjSuccesEncargadoTalleres'] = 'Tu Contacto <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Encargado/talleres.php');

function errorBD($error){
  $_SESSION['ATZmsjEncargadoTalleres'] = $error;
header('location: ../Encargado/talleres.php');
exit(0);
}
?>
?>
