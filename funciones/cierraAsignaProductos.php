<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('generaTicket.php');

//print_r($_SESSION);
//echo '<br>----POST<br>';
//print_r($_POST);


$idAsignacion = (isset($_POST['idAsignacion'])) ? $_POST['idAsignacion'] : '' ;
$notas = (isset($_POST['notas'])) ? $_POST['notas'] : '' ;

if ($idAsignacion == '') {
  errorBD('inténtalo de nuevo o Notifica al Administrador.');

} else {
  $sql = "SELECT estatus
          FROM asignaciones
          WHERE id = '$idAsignacion'";
  $res = mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $estatusAsig = mysqli_fetch_array($res);

  if ($estatusAsig['estatus'] != 1) {
    ticketAsignacion($idAsignacion);

  } else {

      $sql="UPDATE
            	asignaciones asg
            	INNER JOIN detasigna dtsg on asg.id = dtsg.idAsignacion
            	INNER JOIN stocks stk ON dtsg.idStock = stk.id

            SET
            	asg.estatus = '2',
            	asg.fechaReg = NOW(),
            	dtsg.estatus = '2',
            	stk.estatus = '2',
            	stk.idAsignaVehiculo = asg.idAsignaVehiculo,
            	asg.notaAsigna = '$notas'

            WHERE
            	asg.id = '$idAsignacion'
            	AND asg.estatus = '1'
            	AND stk.estatus = '4'
            	AND dtsg.estatus = '1'";
      $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes al Actualizar la Compra.<br> Por favor notifica al Administrador.'));
      $mod = mysqli_affected_rows($link);

      if ($mod >= 1) {
         $_SESSION['SGTSSmsjSuccessAdminInventario'] = ' Tus <b>'.$mod.'</b> Productos se han registrado correctamente.';
         //header('location: ../Encargado/adminInventario.php');


         ticketAsignacion($idAsignacion);


      } else {
        errorBD('Por Favor Verifica que se hayan cargado correctamente tus Artículos. Al parecer no se Asignó ninguno');
      }

    }
  }


function errorBD($error){
  $_SESSION['SGTSSmsjAdminInventario'] = $error;
  echo 'Error: '.$error;
  //header('location: ../Encargado/adminInventario.php');
  exit(0);
}
?>
