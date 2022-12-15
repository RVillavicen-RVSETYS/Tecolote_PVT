<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$posicion = (isset($_POST['posicion'])) ? $_POST['posicion'] : '' ;
print_r($_POST);
echo '<br>id: '.$id.'<br>';
echo '<br>$posicion: '.$posicion.'<br>';

if ($id == '' AND $posicion == '') {
  errorBD('Debes seleccionar una Posición');
}

$sql="UPDATE detasigna SET posicion = '$posicion' WHERE id='$id'";

  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
echo '<br>'.$sql.'<br>';



$_SESSION['ATZmsjSuccesEncargadoCkeckList'] = 'La Posición <b>'.$nombre.'</b> se a modificado Corrrectamente.';
  header('location: ../Encargado/checkList.php');




function errorBD($error){
  $_SESSION['ATZmsjEncargadoCkeckList'] = $error;
  header('location: ../Encargado/checkList.php');
exit(0);
}
?>
