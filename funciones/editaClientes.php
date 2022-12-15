<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();
$fecha = date('d-m-Y');

$ident = $_POST['ident'];
$nombre = (isset($_POST['nombre']) AND $_POST['nombre'] != '') ? $_POST['nombre'] : '';
$empresa = (isset($_POST['empresa']) AND $_POST['empresa'] != '') ? $_POST['empresa'] : '';
$rfc = (isset($_POST['rfc']) AND $_POST['rfc'] != '') ? $_POST['rfc'] : '';
$tel = (isset($_POST['tel']) AND $_POST['tel'] != '') ? $_POST['tel'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';

if ($estatus == '' OR $nombre == '' || $empresa == '') {
  errorBD('Hay un Error, debes seleccionar un <b>Nombre</b> y un <b>Estado</b> , inténtalo de Nuevo.');
}
//print_r($_POST);

$sql="UPDATE clientes SET nombre = '$nombre', empresa = '$empresa', rfc = '$rfc', tel = '$tel', estatus = '$estatus' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

$_SESSION['ATZmsjSuccesEncargadoClientes'] = 'Tu Cliente <b>'.$nombre.'</b> se a modificado Correctamente.';
header('location: ../Encargado/clientes.php');

function errorBD($error){
  $_SESSION['ATZmsjEncargadoClientes'] = $error;
  header('location: ../Encargado/clientes.php');
  exit(0);
}
?>
