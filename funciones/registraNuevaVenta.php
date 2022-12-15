<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('ticketVentas.php');
session_start();

$newID2='';
$idCliente = (isset($_POST['idCliente'])) ? $_POST['idCliente'] : '' ;
$remision = (isset($_POST['remision'])) ? $_POST['remision'] : '' ;
$tipoMaterial = (isset($_POST['idMaterial'])) ? $_POST['idMaterial'] : '' ;
$tipoViaje = (isset($_POST['tipoViaje'])) ? $_POST['tipoViaje'] : '' ;
$fechaCarga = (isset($_POST['fechaCarga'])) ? $_POST['fechaCarga'] : '' ;
$fechaDescarga = (isset($_POST['fechaDescarga'])) ? $_POST['fechaDescarga'] : '' ;
$Ruta = (isset($_POST['idRuta'])) ? $_POST['idRuta'] : '' ;
$Ruta2 = (isset($_POST['idRuta2'])) ? $_POST['idRuta2'] : '' ;
$idVehiculo = (isset($_POST['idVehiculo'])) ? $_POST['idVehiculo'] : '' ;
#$gastos = (isset($_POST['costoCas'])) ? $_POST['costoCas'] : '' ;
$tipo = (isset($_POST['tipoVehiculo'])) ? $_POST['tipoVehiculo'] : '' ;
$idUser = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;
#echo '<br> gastos: '.$gastos.'<br>';
#echo '<br> Sesion: '.$idUser.'<br> Sesion 2: '.$userReg;
#echo '<br> POST: ';
#print_r($_POST);
#echo '<br>';

$idRuta = ($Ruta == '' ) ? $Ruta2 : $Ruta ;
$sql2="SELECT * FROM ventas ve ORDER BY id DESC";
$result2=mysqli_query($link,$sql2) or die(errorBD('Lo sentimos ($result2), estamos experimentando algunos inconvenientes. <br> Por favor notifica al Administrador.'));
#echo '<br> sql2: '.$sql2.'<br>';
$dat = mysqli_fetch_array($result2);
$id=$dat['id'];
#echo '<br> id: '.$id.'<br>';
$id=$dat['id']+1;
#echo '<br> id2: '.$id.'<br>';

if ($idCliente == '' OR $tipoMaterial == '' OR $idRuta == '') {
  errorBD('Hay un Error <b>Faltan datos</b>, actualiza e inténtalo de Nuevo.');

} else {
  $sql = "SELECT * FROM rutas WHERE id = '$idRuta'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);


    $sql3="INSERT INTO viajes (idAsignaVehiculo, idVenta, fechaSalida)
          VALUES('$idVehiculo', '$id', '$fechaCarga')";
#          echo '<br> sql3: '.$sql3.'<br>';
    $result3=mysqli_query($link,$sql3) or die(errorBD('Lo sentimos ($result3), estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));


    $sql="INSERT INTO ventas(idCliente, idCatMaterial, fechaCarga, idRuta, estatusViaje, estatusPago, idUserReg, fechaReg,tipo)
    VALUES('$idCliente', '$tipoMaterial', '$fechaCarga', '$idRuta', '1', '1', '$idUser', NOW(), '$tipo')";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos ($result), estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));
#    echo '<br> sql: '.$sql.'<br>';
    #echo '<br> cliente: '.$idCliente.'<br>';

$newID2=mysqli_insert_id($link);
#echo '<br> $newID2: '.$newID2.'<br>';
#exit(0);
    $_SESSION['ATZmsjSuccesVentas'] = 'La Venta se a creado Corrrectamente.';
    #$pagina= '1';
      ticketDeVentas($newID2);
      #paginaTicket($pagina);
    #header('location: ../ventas.php');

}

  function errorBD($error){
    $_SESSION['ATZmsjVentas'] = $error;
    #echo 'cayo'.$error;
    header('location: ../ventas.php');
    exit(0);
  }
?>
