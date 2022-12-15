<?php
session_start();
define('INCLUDE_CHECK',1);
require('../include/connect.php');
//print_r($_POST);

$idPreFac = (isset($_POST['ident']) AND $_POST['ident'] != '') ? $_POST['ident'] : '' ;
if ($idPreFac != '') {

  require('../Admin/doctoPrefactura.php');

}else {
  errorBD('Lo sentimos, no seleccionaste un viaje, Por favor vuelve a intentarlo');
}

function errorBD($error){
  $_SESSION['ATZmsjAdminPreFacturaCliente'] = $error;
  echo 'cayo: '.$error;
  #header('location: ../Admin/preFacturaCliente.php');
  exit(0);
}

?>
