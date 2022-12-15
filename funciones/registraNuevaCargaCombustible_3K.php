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
  #print_r($_POST).'<br>';

  #$viaje = (isset($_POST['viaje']) AND $_POST['viaje'] != '') ? '' : '' ;
  $viaje = (isset($_POST['viaje']) AND $_POST['viaje'] != '') ? $_POST['viaje'] : '' ;
  $gasolinera = (isset($_POST['gasolinera']) AND $_POST['gasolinera'] != '') ? $_POST['gasolinera'] : '' ;
  $combustible = (isset($_POST['combustible']) AND $_POST['combustible'] != '') ? $_POST['combustible'] : '' ;
  $litros = (isset($_POST['litros']) AND $_POST['litros'] != '') ? $_POST['litros'] : '' ;
  $kilometros = (isset($_POST['kilometros']) AND $_POST['kilometros'] != '') ? $_POST['kilometros'] : '' ;
  $full = (isset($_POST['full']) AND $_POST['full'] != '') ? $_POST['full'] : '' ;
  $userReg = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;
  $precio = '' ;
  $cont = 0;
  $mensaje = '';

  if ($viaje == '') {
    ++$cont;
    $mensaje = ' el viaje,';
  }
  if ($gasolinera == '') {
    ++$cont;
    $mensaje = ' la gasolinera,';
  }
  if ($combustible == '') {
    ++$cont;
    $mensaje = ' el combustible,';
  }
  if ($litros == '') {
    ++$cont;
    $mensaje = ' los litros,';
  }
  if ($kilometros == '') {
    ++$cont;
    $mensaje = ' el kilometraje,';
  }

  $mensaje = substr($mensaje, 0, -1);
  if ($cont > 0) {
    errorBD('No se pudo realizar la carga debido a que no se recibió lo siguiente: '.$mensaje.'. <br>Verifica por favor, si el problema persiste, notifica a tu Administrador.');
  }

  //echo '<br>';
  $sql="INSERT INTO cargacombustible(idGasolinera, idViaje, idCatCombustible, cant, Kilometraje, full, idUserReg, fechaReg)
        VALUES('$gasolinera', '$viaje', '$combustible', '$litros', '$kilometros', '$full', '$userReg', NOW())";
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos.'.mysqli_error($link)));
  //echo $sql;

  $newID = mysqli_insert_id($link);

  $_SESSION['newIDCarga'] = $newID;

  $_SESSION['ATZmsjSuccesCargaCombustible'] = 'Se ha generado Corrrectamente la Carga.';

  ticketCargaCombustible($newID);
}


function errorBD($error){
  $_SESSION['ATZmsjCargaCombustibles'] = $error;
  echo 'cayo: '.$error;
  header('location: ../cargaCombustible.php');
  exit(0);
}
?>
