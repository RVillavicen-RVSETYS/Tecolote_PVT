<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = $_POST['ident'];
$ruta = (isset($_POST['edRuta'])) ? $_POST['edRuta'] : '' ;
$contacto = (isset($_POST['editaCliente'])) ? $_POST['editaCliente'] : '' ;
$precio = (isset($_POST['edPrecio'])) ? $_POST['edPrecio'] : '' ;
$material = (isset($_POST['edMaterial'])) ? $_POST['edMaterial'] : '' ;

#print_r($_POST);
#echo '<br><br>';
$sql="UPDATE preciomateriales SET idCliente = '$contacto', idRuta = '$ruta', idCatMaterial = '$material', precio = '$precio' WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die('Problemas al guardar los Datos. ');
#echo '<br>sql:'.$sql.'<br>';
$_SESSION['ATZmsjSuccesAdminPrecioMaterialRuta'] = 'Tu Material se a modificado Corrrectamente.';
header('location: ../Admin/precioMaterialRuta.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminPrecioMaterialRuta'] = $error;
header('location: ../Admin/precioMaterialRuta.php');
exit(0);
}
?>
