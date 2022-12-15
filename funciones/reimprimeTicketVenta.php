<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('ticketVentas.php');
session_start();
#print_r($_POST);

$ident = $_POST['ident'];
if ($ident != '') {
  $newID = $_POST['ident'];
#echo '<br>newID: '.$newID;
  ticketDeVentas($newID);
}

function errorBD($error){
  $_SESSION['ATZmsjCargaCombustibles'] = $error;
  echo 'cayo: '.$error;
  //header('location: ../cargaCombustible.php');
  exit(0);
}
?>
