<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('generaTicket.php');
session_start();
#print_r($_POST);

$ident = $_POST['ident'];
if ($ident != '') {
  $newID = $_POST['ident'];
#echo '<br>newID: '.$newID;
$sql="SELECT * FROM cargacombustible cgc WHERE cgc.id = '$newID' Limit 1";
$res = mysqli_query($link,$sql) or die(errorBD('Lo sentimos, hubo un error al consultar el ticket, consulte al Administrador'));
#echo '<br>$sql: '.$sql.'<br>';

$con = mysqli_fetch_array($res);
if ($con['idViaje'] < 1) {
#echo "Entra a IF";
  ticketCargaCombustible2($newID);
} elseif ($con['idVehiculoPersonal'] < 1) {
#echo "Entra a ELSEIF";
  ticketCargaCombustible($newID);
} else {
#  echo "Entra a ELSE";
  errorBD('Lo sentimos, no hay un ticket disponible con la información mandada, consulte al Administrador');
}


}

function errorBD($error){
  $_SESSION['ATZmsjCargaCombustibles'] = $error;
  #echo 'cayo: '.$error;
  header('location: ../cargaCombustible.php');
  exit(0);
}
?>
