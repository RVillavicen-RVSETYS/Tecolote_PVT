<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '' ;
$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;

if ($precio == '' OR $ident =='') {
  errorBD('Ingresa un Precio.');

} else {
    $sql = "UPDATE detcompras SET precio = '$precio' WHERE id = $ident LIMIT 1";
    $result = mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));

    $centRes = mysqli_affected_rows($link);
    if ($centRes >= 1) {
      echo '1|Serie Registrada Correctamente';
    } else {
      echo '0|Verifica por que no se cargo el No de Serie';
    }

  }


function errorBD($error){
  echo '0|'.$error;
  exit(0);
}
?>
