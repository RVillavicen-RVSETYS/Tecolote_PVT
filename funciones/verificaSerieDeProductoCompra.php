<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$noSerie = (isset($_POST['noSerie'])) ? $_POST['noSerie'] : '' ;
$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;

if ($noSerie == '' OR $ident =='') {
  errorBD('Ingresa un No. de Serie.');

} else {
  $sql="SELECT COUNT(dcp.id) AS Cant, cpa.folio
        FROM detcompras dcp
        INNER JOIN compras cpa ON dcp.idCompra = cpa.id
        WHERE dcp.noSerie = '$noSerie'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));
  $cantDup = mysqli_fetch_array($result);
  if ($cantDup['Cant'] >= 1) {
    errorBD('Ese No de Serie ya esta Registrado en la Compra con <b>Folio:'.$cantDup['folio'].'</b>');

  } else {
    $sql = "UPDATE detcompras SET noSerie = '$noSerie' WHERE id = $ident LIMIT 1";
    $result = mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));

    $centRes = mysqli_affected_rows($link);
    if ($centRes >= 1) {
      echo '1|Serie Registrada Correctamente';
    } else {
      echo '0|Verifica por que no se cargo el No de Serie';
    }

  }


}

function errorBD($error){
  echo '0|'.$error;
  exit(0);
}
?>
