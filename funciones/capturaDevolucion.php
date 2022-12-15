<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

#print_r($_POST);
$ident = (isset($_POST['idProducto'])) ? $_POST['idProducto'] : '' ;
$descDevuelve = (isset($_POST['descDevuelve'])) ? $_POST['descDevuelve'] : '' ;
$cont = (isset($_POST['cont'])) ? $_POST['cont'] : '' ;
$cont = ($cont == '') ? 0 : $cont ;
$cantidad = max($ident);
$conta=0;
$numero=0;
$conta += $cont;
$conta += $cantidad;
$muestra = '';
#echo '<br>ident : '.$ident;
#echo '<br>conta: '.$conta;
if ($ident == '') {
errorBD('Debe ingresar un número de serie');
}
for ($i=0; $i <= $conta; $i++) {

  if (isset($ident[$i]) != '') {
    $muestra .= $ident[$i].',';
    $valor[$numero]=$ident[$i];
    $numero++;
  }
}
$muestra = trim($muestra,",");
#echo '<br>muestra: '.$muestra;
$cantidad=count($numero);
$sql="UPDATE stocks SET estatus = '1', idAsignaVehiculo = '0' WHERE id IN ($muestra)";
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
#echo '<br>sql: '.$sql;

for($i=0; $i <= $cantidad; $i++){
$sql2="UPDATE detasigna SET idDevolucion = '$valor[$i]', posicionAnterior = posicion, posicion = '0', idStock = '0', descDevuelve ='$descDevuelve' WHERE idStock = $valor[$i]";
if ($valor[$i] != '') {
  $result2=mysqli_query($link,$sql2) or die(errorBD('Problemas al guardar los Datos. '));
#  echo '<br>sql2'.$sql2.'<br>';
}

}
$_SESSION['ATZmsjSuccesDevoluciones'] = 'La Devolución se a Realizado Corrrectamente.';
header('location: ../Encargado/devoluciones.php');

function errorBD($error){
  $_SESSION['ATZmsjDevoluciones'] = $error;
  header('location: ../Encargado/devoluciones.php');
  exit(0);
}
?>
