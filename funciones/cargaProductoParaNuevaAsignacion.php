<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$idAsignacion = (isset($_POST['idAsignacion'])) ? $_POST['idAsignacion'] : '' ;
$seriesAsignar = (isset($_POST['seriesAsignar'])) ? $_POST['seriesAsignar'] : '' ;
$productoAsigna = (isset($_POST['productoAsigna'])) ? $_POST['productoAsigna'] : '' ;
$userReg = $_SESSION['ATZident'];

print_r($_POST);
$long = count($seriesAsignar);
$datos = '';

if ($idAsignacion == '' OR $idAsignacion == 0) {
  errorBD('Debes Seleccionar un Operador o Vehiculo para la asignación.');
}

if ($seriesAsignar == '') {
  errorBD('Debes seleccionar uno o mas articulos.');
}


for ($i=0; $i < $long; $i++) {
	echo $seriesAsignar[$i].'<br>';
  $idArt = $seriesAsignar[$i];
	$datos .= $seriesAsignar[$i].',';

  $SQL = " UPDATE stocks SET estatus = '4' WHERE id = $idArt ";
  $result=mysqli_query($link,$SQL) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador. '.mysqli_error($link)));
  $cantAfect = mysqli_affected_rows($link);

  $sql="INSERT INTO detasigna(idAsignacion, idStock, idUserReg, fechaReg, estatus) VALUES('$idAsignacion', '$idArt','$userReg',NOW(),'1')";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador. '.mysqli_error($link)));
  $cantAfect = mysqli_affected_rows($link);
  if ($cantAfect == 0) {
    $noLoad = $idArt.'<br>';

  } else {
    echo '* Se cargo Correctamente el: '.$idArt.'<br>';
  }

}
$datos = trim($datos, ',');
$noReg = strlen($datos);

echo 'Series que se van a asignar: '.$datos.' -- La Long es: '.strlen($datos);

header('location: ../Encargado/adminInventario.php');

function errorBD($error){
  $_SESSION['ATZmsjAdminInventario'] = $error;
  echo 'Cayo Error: '.$error;
  header('location: ../Encargado/adminInventario.php');
  exit(0);
}
?>
