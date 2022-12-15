<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('../Admin/doctoNomina.php');
#session_start();
#print_r($_POST);

$ident = $_POST['ident'];
if ($ident != '') {
  $newID = $_POST['ident'];
#echo '<br>newID: '.$newID;
  doctoNomina($newID);
}

function errorBD($error){
  $_SESSION['ATZmsjAdminNominaOperador'] = $error;
  echo 'cayo: '.$error;
  //header('location: ../Admin/nominaOperador.php');
  exit(0);
}
?>
