<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$nombre = (isset($_POST['name'])) ? $_POST['name'] : '' ;
$rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '' ;
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '' ;
$municipio = (isset($_POST['municipio'])) ? $_POST['municipio'] : '' ;
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '' ;
$banco = (isset($_POST['banco'])) ? $_POST['banco'] : '' ;
$claBe = (isset($_POST['claBe'])) ? $_POST['claBe'] : '' ;
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '' ;
$userReg = $_SESSION['ATZident'];
print_r($_POST);
echo '<br>id: '.$id.'<br>';


$sql="UPDATE proveedores SET nombre = '$nombre', rfc = '$rfc',  idEstado = '$estado', idMunicipio = '$municipio', direccion = '$direccion', idBanco = '$banco', claBe = '$claBe', estatus = '$estatus', fechaReg=NOW(), idUserReg = '$userReg' WHERE id='$id'";

$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
echo '<br>'.$sql.'<br>';



$_SESSION['ATZmsjSuccesEncargadoProveedores'] = 'Tu Proveedor <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Encargado/proveedores.php');




function errorBD($error){
  $_SESSION['ATZmsjEncargadoProveedores'] = $error;
header('location: ../Encargado/proveedores.php');
exit(0);
}
?>
