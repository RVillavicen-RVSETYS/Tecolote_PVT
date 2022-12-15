<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

print_r($_POST);

$nota = (isset($_POST['nota'])) ? $_POST['nota'] : '' ;
$fecha1 = (isset($_POST['fecha1'])) ? $_POST['fecha1'] : '' ;
$fecha2 = (isset($_POST['fecha2'])) ? $_POST['fecha2'] : '' ;
$idCliente = (isset($_POST['idCliente'])) ? $_POST['idCliente'] : '' ;
$idUser = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;


if ($idCliente == '' OR $fecha1 == '' OR $fecha2 == '') {
  errorBD('Hay un Error faltan datos que debes ingresar, intentalo de Nuevo.');

} else {

  $sql = "SELECT vts.id AS idVenta, cls.nombre AS Cliente, DATE_FORMAT(vts.fechaEntrega, '%d %M %Y') AS fechaEntrega, vts.monto
          FROM ventas vts
          LEFT JOIN clientes cls ON vts.idCliente = cls.id
          LEFT JOIN rutas rts ON vts.idRuta = rts.id
          WHERE vts.estatusViaje = '1'
          AND vts.fechaEntrega BETWEEN '$fecha1' AND '$fecha2'
           AND cls.id = '$idCliente'";
  echo '<br><br>SQL: '.$sql;
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

  $sql = "INSERT INTO prefactura(fecha, cliente, nota, monto, estatus, idUserReg, fechaReg) VALUES(NOW(),'$idCliente', '', '$nota', '1', '$idUser', NOW() )";
  $res = mysqli_query($link, $sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));

  $motoTot = 0;

  $idPreFac =mysqli_insert_id($link);
  echo 'ID Prefactura:'.$idPreFac;
  if ($idPreFac >=1) {
    while ($dat = mysqli_fetch_array($result)) {
      $var = $dat['idVenta'];
      if (isset($_POST['chk'.$var])) {
        echo '<br>Si existe el ID:'.$_POST['chk'.$var];

        $sql = "UPDATE ventas SET idPrefactura = '$idPreFac' WHERE id = '$var'";
        $res = mysqli_query($link, $sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

        $motoTot += $dat['monto'];

      }
    }
    $sql = "UPDATE prefactura SET monto = '$motoTot' WHERE id = '$idPreFac'";
    $res = mysqli_query($link, $sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

    $idPreFac = base64_encode($idPreFac);
    header('location: ../Encargado/doctoPreFactura.php?idPrefactura='.$idPreFac);

  } else {
    errorBD('Lo sentimos, no se pudo crear tu Prefactura.<br> Por favor notifica al Administrador o intentalo de Nuevo.');
  }


}

function errorBD($error){
  $_SESSION['SGTSSmsjEncargadoPreFacturaCliente'] = $error;
  echo 'cayo: '.$error;
  //header('location: ../Admin/catBancos.php');
  exit(0);
}
?>
