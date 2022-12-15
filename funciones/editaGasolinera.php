<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '' ;
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '' ;
$municipio = (isset($_POST['municipio'])) ? $_POST['municipio'] : '' ;
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '' ;
$referencia = (isset($_POST['referencia'])) ? $_POST['referencia'] : '' ;
$rfc = (isset($_POST['rfc'])) ? $_POST['rfc'] : '' ;
$estatus = (isset($_POST['Estatus'])) ? $_POST['Estatus'] : '' ;
$credito = (isset($_POST['credito'])) ? $_POST['credito'] : '' ;
$userReg = $_SESSION['ATZident'];
print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion


$sql="UPDATE gasolineras SET nombre = '$nombre', credito = '$credito', idCatEstado = '$estado', idCatMunicipio = '$municipio', direccion = '$direccion', rfc = '$rfc', referencia = '$referencia', estatus = '$estatus', fechaReg=NOW(), idUserReg = '$userReg' WHERE id='$ident'";
echo $sql;
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));

$_SESSION['ATZmsjSuccesEncargadoGasolineras'] = 'Tu Gasolinera <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Encargado/gasolineras.php');




function errorBD($error){
  $_SESSION['ATZmsjEncargadoGasolineras'] = $error;
header('location: ../Encargado/gasolineras.php');
exit(0);
}
?>
