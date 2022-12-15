<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

#print_r($_POST);
$ident = (isset($_POST['idProducto'])) ? $_POST['idProducto'] : '' ;
$descDevuelve = (isset($_POST['descBaja'])) ? $_POST['descBaja'] : '' ;
$cont = (isset($_POST['cont'])) ? $_POST['cont'] : '' ;
$cont = ($cont == '') ? 0 : $cont ;
$cantidad = max($ident);
$userReg = $_SESSION['ATZident'];
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
#echo '<br>$cantidad1: '.$cantidad;
$muestra = trim($muestra,",");
#echo '<br>muestra: '.$muestra;
$cantidad=count($numero);
#echo '<br>$cantidad: '.$cantidad;
$sql="UPDATE stocks SET estatus = '4' WHERE id IN ($muestra)";
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
#echo '<br>sql: '.$sql;

for($i=0; $i <= $cantidad; $i++){
  if ($valor[$i] == '' || $valor[$i] == '0' || $valor[$i] == 0) {

  } else {

$sql2="UPDATE detasigna SET posicionAnterior = posicion, idStock = '0', descDevuelve ='$descDevuelve', posicion = '0'  WHERE idStock = $valor[$i]";
$result2=mysqli_query($link,$sql2) or die(errorBD('Problemas al guardar los Datos. '));
#echo '<br>sql2'.$sql2.'<br>';
$sqlBajaStock ="INSERT INTO bajastock (idStock,descripcion,idUserReg,fechaReg) VALUES('$valor[$i]','$descDevuelve','$userReg',NOW())";
$res=mysqli_query($link,$sqlBajaStock) or die(errorBD('Problemas al guardar los Datos. '));
#echo '<br>$sqlBajaStock: '.$sqlBajaStock.'<br>';
}
}
$_SESSION['ATZmsjSuccessBajaDeArticulos'] = 'La Baja se a Realizado Corrrectamente.';
header('location: ../Encargado/bajaProducto.php');

function errorBD($error){
  $_SESSION['ATZmsjBajaDeArticulos'] = $error;
  header('location: ../Encargado/bajaProducto.php');
  exit(0);
}
?>
