<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('generaTicket.php');
session_start();

if (isset($_SESSION['newIDCarga'])) {
  $newID = $_SESSION['newIDCarga'];
  ticketCargaCombustible($newID);
}else {
  //print_r($_SESSION).'<br><br>';
#  print_r($_POST).'<br><br>';

  $vePersonal = $_POST['vePersonal'];
  $gasolinera = $_POST['gasolinera2'];
  $combustible = $_POST['combustible2'];
  $litros = $_POST['litros2'];
  $userReg = $_SESSION['ATZident'];
  $precio = '' ;

  //$res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador.</p>');

  //echo '<br>';
  $sql="INSERT INTO cargacombustible(idGasolinera, idVehiculoPersonal, idCatCombustible, cant, idUserReg, fechaReg)
        VALUES('$gasolinera', '$vePersonal', '$combustible', '$litros', '$userReg', NOW())";
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos.'.mysqli_error($link)));
#  echo '<br><br>'.$sql;

  $newID = mysqli_insert_id($link);

  $_SESSION['newIDCarga'] = $newID;

  $_SESSION['ATZmsjSuccesCargaCombustible'] = 'Se ha generado Corrrectamente la Carga.';

  ticketCargaCombustible2($newID);
}


function errorBD($error){
  $_SESSION['ATZmsjCargaCombustibles'] = $error;
  echo 'cayo: '.$error;
  //header('location: ../cargaCombustible.php');
  exit(0);
}
?>
