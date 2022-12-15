<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

/*
echo '<br>---------------------------Cont de SESSION y POST-----------------------<br>SESSION:';
print_r($_SESSION);
echo '<br><br>POST';
print_r($_POST);
echo '<br><br>FILE';
print_r($_FILES);
echo "<br>----------------------------------------------------------------------<br>";
*/

if (!isset($_POST['ident']) AND $_POST['ident'] > 0) {
  errorBD('Problema de Falta de Datos. Notifica a tu Administrador');
}

$iden = (isset($_POST['ident']) AND $_POST['ident'] > 0) ? $_POST['ident'] : '' ;
$precio = (isset($_POST['precio']) AND $_POST['precio'] > 0) ? $_POST['precio'] : '' ;

if ($iden == '' || $precio == '') {
  errorBD('Lo sentimos, debe ingresar un precio');
}

$sql="UPDATE stocks SET precio = '$precio' WHERE id='$iden'";
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));

$_SESSION['ATZmsjSuccessAdminDetalleInventario'] = 'El Precio se a Modificado Corrrectamente.';

header('location: ../Encargado/adminDetalleInventario.php');


function errorBD($error){
  $_SESSION['ATZmsjAdminDetalleInventario'] = $error;
#  echo 'cayo: '.$error;
  header('location: ../Encargado/adminDetalleInventario.php');
#  exit(0);
}
?>
