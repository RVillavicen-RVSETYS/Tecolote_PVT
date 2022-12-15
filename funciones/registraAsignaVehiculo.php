<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$idOp = (isset($_POST['selOperador'])) ? $_POST['selOperador'] : '' ;
$idVehi = (isset($_POST['selVehiculo'])) ? $_POST['selVehiculo'] : '' ;
$idDolly = (isset($_POST['selDolly'])) ? $_POST['selDolly'] : '' ;
$fecha = (isset($_POST['fechaAsigna'])) ? $_POST['fechaAsigna'] : '' ;
$userReg = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;
//echo '<br>POST: <br>';
//print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
//echo '<br>Sesion: <br>';  //sirve para mostrar la siguiente información en otro parrafo
//print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
//echo '<br>$userReg: <br>';
//echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
//echo 'idOperador: '.$idOp.' ---- idVehiculo: '.$idVehi.' ---- fecha: '.$fecha.' ---- idDolly: '.$idDolly.' ---- '.'<br>';

if ($idOp == '' || $idVehi == '0') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
} else {
  $sql="INSERT INTO asignavehiculos (idOperador, idVehiculo, fechaAsigna, idUserAsigna, estatus)
  VALUES ('$idOp', '$idVehi', '$fecha', '$userReg', '1')";
  //echo '<br>Información del sql: <br>';
  //echo $sql;
//echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
$result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

  $_SESSION['ATZmsjSuccesEncargadoAsignaV'] = 'La Asignación se a creado Corrrectamente.';
  header('location: ../Encargado/asignaVehiculo.php');
  echo "Asignación realizada con éxito";
}


function errorBD($error){
  $_SESSION['ATZmsjEncargadoAsignaV'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
header('location: ../Encargado/asignaVehiculo.php');
  exit(0);
}

?>
