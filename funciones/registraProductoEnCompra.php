<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$idProd = (isset($_POST['regEntradaProd'])) ? $_POST['regEntradaProd'] : '' ;
$cantProd = (isset($_POST['regEntradaCant']) AND $_POST['regEntradaCant'] > 0) ? $_POST['regEntradaCant'] : '' ;
$idCompra = (isset($_POST['idCompraAct']) AND $_POST['idCompraAct'] > 0) ? $_POST['idCompraAct'] : '' ;
$userReg = $_SESSION['ATZident'];

//print_r($_POST);

if ($idProd == '' OR $cantProd == '' OR $idCompra == '') {
  errorBD('Debes seleccionar <b>Producto</b> y <b>Cantidad</b> mayor que 0, inténtalo de Nuevo.');
}

$sql = "SELECT * FROM productos WHERE id = '$idProd' LIMIT 1";
$res = mysqli_query($link, $sql) or die(errorBD('No pudimos consultar el Producto, Notifica al Administrador.'));
$result = mysqli_fetch_array($res);
$prodName = $result['nombre'];
$datoSum = 0;
$calculaSerie = $result['serieAuto'];

if ($result['estatus'] == '0') {
  echo 'No puedes seleccionar este Producto por que ya fue Desactivado por el Administrador.';
  errorBD('No puedes seleccionar este Producto por que ya fue Desactivado por el Administrador.');
}

if ($result['serieAuto'] == '0') {
  $preSerie = '';
  $serie = '';
  $rotulado = '1';
  $incSerie = '';
}else {
  $preSerie = $result['preSerie'];
  $sql = "SELECT MAX(incSerie) AS incSerie FROM detcompras WHERE idProducto = '$idProd' AND preSerie = '$preSerie'";
  echo '<br>Calcula Serie: '.$sql.'<br>';
  $res = mysqli_query($link, $sql) or die(errorBD('No pudimos consultar información del Producto, Notifica al Administrador.'));
  $dat = mysqli_fetch_array($res);
  $incSerie = ($dat['incSerie'] >= 1) ? $dat['incSerie'] : 0 ;
  $rotulado = '0';
  $datoSum = $incSerie;
}

for ($i=0; $i < $cantProd; $i++) {
  $datoSum++;
  echo '<br>El incremental = '.$datoSum.'<br>';

  if ($calculaSerie == '1'){
    $incSerie = str_pad($datoSum, 6, '0', STR_PAD_LEFT);
  }
  $serie = $preSerie.$incSerie;

  $sql="INSERT INTO detcompras(idProducto, idCompra, preSerie, incSerie, noSerie, estatus, rotulado,  idUserReg, fechaReg) VALUES('$idProd','$idCompra','$preSerie','$incSerie', '$serie','1','$rotulado','$userReg',NOW())";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));

}


$_SESSION['SGTSSmsjSuccessAdminInventario'] = 'Tu producto <b>'.$prodName.'</b> se a creado Corrrectamente.';
header('location: ../Encargado/adminInventario.php');


function errorBD($error){
  $_SESSION['SGTSSmsjAdminInventario'] = $error;
  //echo 'Cayo: '.$error;
  header('location: ../Encargado/adminInventario.php');
  exit(0);
}
?>
