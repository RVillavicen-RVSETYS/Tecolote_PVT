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
$tel = (isset($_POST['tel'])) ? $_POST['tel'] : '' ;
$referencia = (isset($_POST['referencia'])) ? $_POST['referencia'] : '' ;
$especialidad = (isset($_POST['especialidad'])) ? $_POST['especialidad'] : '' ;
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '' ;
$userReg = $_SESSION['ATZident'];
print_r($_POST);
echo '<br>id: '.$id.'<br>';


$sql="UPDATE talleres SET nombre = '$nombre', rfc = '$rfc',  idEstado = '$estado', idMunicipio = '$municipio', direccion = '$direccion', tel = '$tel', referencias = '$referencia', idCatEspecialidad='$especialidad', estatus = '$estatus', idUserReg = '$userReg',  fechaReg=NOW() WHERE id='$id'";

$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
echo '<br>'.$sql.'<br>';



$_SESSION['ATZmsjSuccesEncargadoTalleres'] = 'Tu Taller <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Encargado/talleres.php');




function errorBD($error){
  $_SESSION['ATZmsjEncargadoTalleres'] = $error;
header('location: ../Encargado/talleres.php');
exit(0);
}
?>
