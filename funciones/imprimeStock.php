<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('../Encargado/impresionDeStock.php');
#session_start();
#print_r($_POST);

$ident = $_POST['departamento'];
#echo '<br>$ident: '.$ident.'<br>';

if ($ident != '') {
  $newID = $ident;
#echo '<br>newID: '.$newID;
#echo '<a href="../Encargado/impresionDeStock.php?ident='.$ident.'">';
  doctoStock($newID);
}

function errorBD($error){
  $_SESSION['ATZmsjAdminInventario'] = $error;
  echo 'cayo: '.$error;
  //header('location: ../Admin/nominaOperador.php');
  exit(0);
}
?>
