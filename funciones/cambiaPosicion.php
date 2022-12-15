<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$eco = (isset($_POST['idVehiculo'])) ? $_POST['idVehiculo'] : '' ;
$posicionActual = (isset($_POST['posicionActual'])) ? $_POST['posicionActual'] : '' ;
$posicion = (isset($_POST['posicion'])) ? $_POST['posicion'] : '' ;
/*
print_r($_POST);
echo '<br>id: '.$id.'<br>';
echo '<br>$eco: '.$eco.'<br>';
echo '<br>$posicion: '.$posicion.'<br>';
echo '<br>$posicionActual: '.$posicionActual.'<br>';
*/

if ($id == '' AND $posicion == '' AND $posicionActual == '') {
  errorBD('Debes seleccionar una Posición');
}
$consulta= "SELECT dasg.id
FROM detasigna dasg
INNER JOIN asignaciones asg ON asg.id = dasg.idAsignacion
INNER JOIN asignavehiculos asgv ON asgv.id = asg.idAsignaVehiculo
INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
WHERE dasg.posicion = '$posicion' AND ve.noEconomico = '$eco' LIMIT 1";

$resultado = mysqli_query($link,$consulta) or die(errorBD('Lo Sentimos, no se pudo encontrar la información deseada, Notifique a su Administrador'));
$dato = mysqli_fetch_array($resultado);
$id2 = ($dato['id'] == '') ? '' : $dato['id'] ;
#echo '<br>$id2: '.$id2.'<br>';

$sql="UPDATE detasigna SET posicion = '$posicion' WHERE id='$id'";
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
#echo '<br>sql: '.$sql.'<br>';

if ($id2 != '') {
  $sql2="UPDATE detasigna SET posicion = '$posicionActual' WHERE id='$id2'";
    $result2=mysqli_query($link,$sql2) or die(errorBD('Problemas al guardar los Datos. '));
#echo '<br>sql2: '.$sql2.'<br>';
}




$_SESSION['ATZmsjSuccesEncargadoCkeckList'] = 'El Cambio se ha Realizado Corrrectamente.';
  header('location: ../Encargado/checkList.php');




function errorBD($error){
  $_SESSION['ATZmsjEncargadoCkeckList'] = $error;
  header('location: ../Encargado/checkList.php');
exit(0);
}
?>
