<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$fechaCompra = (isset($_POST['fechaCompra'])) ? $_POST['fechaCompra'] : '' ;
$formaPago = (isset($_POST['formaPago'])) ? $_POST['formaPago'] : '' ;
$monto = (isset($_POST['monto'])) ? $_POST['monto'] : '' ;
$noCompra = (isset($_POST['noCompra'])) ? $_POST['noCompra'] : '' ;
$idProveedor = (isset($_POST['idProveedorCpa'])) ? $_POST['idProveedorCpa'] : '' ;
$userReg = $_SESSION['ATZident'];

print_r($_POST);

$sql = "SELECT * FROM compras WHERE folio = '$noCompra' AND idProveedor = '$idProveedor'";
$res = mysqli_query($link, $sql) or die(errorBD('Notifica al Administrador.'));
$cant = mysqli_num_rows($res);

if ($cant >= 1) {
  errorBD('Ya hay una compra con serie <b>'.$noCompra.'</b>, de ese Proveedor.');

} else {
  $sql="INSERT INTO compras(monto, fecha, formaPago, idProveedor, folio, idUserReg, fechaReg, estatus, fechaCompra) VALUES('$monto','$fechaCompra','$formaPago','$idProveedor','$noCompra','$userReg',NOW(),'1','$fechaCompra')";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

  //echo 'Terminado';
  header('location: ../Encargado/adminInventario.php');
}

function errorBD($error){
  $_SESSION['SGTSSmsjAdminInventario'] = $error;
  //echo '<br><br>cayo: '.$error;
  header('location: ../Encargado/adminInventario.php');
  exit(0);
}
?>
