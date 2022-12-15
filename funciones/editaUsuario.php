<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$nombre = (isset($_POST['name'])) ? $_POST['name'] : '' ;
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '' ;
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '' ;
$password1 = (isset($_POST['password1'])) ? $_POST['password1'] : '' ;
$password2 = (isset($_POST['password2'])) ? $_POST['password2'] : '' ;
$nivel = (isset($_POST['nivel'])) ? $_POST['nivel'] : '' ;
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '' ;
$userReg = $_SESSION['ATZident'];
//print_r($_POST);

if ($password1 != $password2){
  $_SESSION['ATZmsjAdminUsuarios']='Las contraseña que ingreso no coinciden, intentelo de nuevo.';
  header('location: ../Admin/usuarios.php');

}

if ($password1 == '') {
  $sql="UPDATE segusuarios SET nombre = '$nombre', apellidos = '$apellidos', usuario = '$usuario', idNivel = '$nivel', estatus = '$estatus', fechaReg=NOW(), idUserReg = '$userReg' WHERE id=$ident";
} else {
  $sql="UPDATE segusuarios SET nombre = '$nombre', apellidos = '$apellidos', usuario = '$usuario', pass = MD5('$password1'), idNivel = '$nivel', estatus = '$estatus', fechaReg=NOW(), idUserReg = '$userReg' WHERE id='$ident'";
}
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));

$_SESSION['ATZmsjSuccesAdminUsuarios'] = 'Tu usuario <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Admin/usuarios.php');




function errorBD($error){
  $_SESSION['ATZmsjAdminUsuarios'] = $error;
header('location: ../Admin/usuarios.php');
exit(0);
}
?>
