<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$cont = (isset($_POST['cont'])) ? $_POST['cont'] : '' ;
$caseta = (isset($_POST['caseta'])) ? $_POST['caseta'] : '' ;
$idCaseta = (isset($_POST['id'])) ? $_POST['id'] : '' ;
print_r($_POST);

for ($i=0; $i <count($caseta); $i++) {
  // code...
$sql="UPDATE rutacaseta SET idCaseta = '$caseta[$i]' WHERE id = '$idCaseta[$i]'";
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
echo '<br>sql: '.$sql.'<br>';
}
$_SESSION['ATZmsjSuccesAdminRutasCasetas'] = 'Tu Ruta se a modificado Corrrectamente.';
header('location: ../Admin/rutasCasetas.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminRutasCasetas'] = $error;
header('location: ../Admin/rutasCasetas.php');
exit(0);
}
?>
