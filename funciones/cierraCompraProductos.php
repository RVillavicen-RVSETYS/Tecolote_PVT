<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');


//print_r($_SESSION);
//echo '<br>----POST<br>';
//print_r($_POST);


$idCompra = (isset($_POST['idCompra'])) ? $_POST['idCompra'] : '' ;
$notas = (isset($_POST['notas'])) ? $_POST['notas'] : '' ;

if ($idCompra == '') {
  errorBD('Inténtalo de nuevo o Notifica al Administrador.');

} else {
  $sql = "SELECT estatus
          FROM compras cpa
          WHERE cpa.id = '$idCompra'";
  $res = mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $estatusCpa = mysqli_fetch_array($res);

  if ($estatusCpa['estatus'] != 1) {
    errorBD('No puedes hacer modificaciones en una Compra Cerrada.');

  } else {
    $sql = "SELECT COUNT(dtcpa.id) AS sinSerie
            FROM compras cpa
            INNER JOIN detcompras dtcpa On cpa.id = dtcpa.idCompra
            WHERE cpa.id = '$idCompra' AND cpa.estatus = '1' AND dtcpa.noSerie = ''";
    $res = mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes al Consultar la Compra.<br> Por favor notifica al Administrador.'));
    $sinNoSerie = mysqli_fetch_array($res);

    if ($sinNoSerie['sinSerie'] >= 1) {
      errorBD('Te falta registrar algunos Números de serie.');

    } else {
      $sql="INSERT INTO stocks(idProducto, idCompra, preSerie, incSerie, noSerie, estatus, rotulado, idUserReg, precio, fechaReg)
            SELECT idProducto, idCompra, preSerie, incSerie, noSerie, estatus, rotulado, idUserReg, precio, NOW() AS fechaReg
            FROM detcompras
            WHERE idCompra = '$idCompra'";
      $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes al Guardar el Stock.<br> Por favor notifica al Administrador.'));
      $cantidad = mysqli_affected_rows($link);

      $sql="UPDATE compras SET estatus = '2', descripcion = '$notas' WHERE id='$idCompra'";
      $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes al Actualizar la Compra.<br> Por favor notifica al Administrador.'));
      $mod = mysqli_affected_rows($link);

      if ($mod == 1) {
         $_SESSION['SGTSSmsjSuccessAdminInventario'] = ' Tus <b>'.$cantidad.'</b> Productos se han registrado correctamente.';
         header('location: ../Encargado/adminInventario.php');
      } else {
        errorBD('Por Favor Verifica que se hayan cargado correctamente tus Articulos.');
      }

    }
  }

}

function errorBD($error){
  $_SESSION['SGTSSmsjAdminInventario'] = $error;
  //echo 'Error: '.$error;
  header('location: ../Encargado/adminInventario.php');
  exit(0);
}
?>
