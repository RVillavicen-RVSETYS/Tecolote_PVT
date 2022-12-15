<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';
$destino1 = (isset($_POST['dest1'])) ? $_POST['dest1'] : '';
$tipoViaje = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
//print_r($_POST);

if ($destino1 == '' OR $ident == '' OR $tipoViaje == '') {
  echo '<h4> '.$tipoViaje.' -  </h4>';
  echo '<option> No hubo ninguna coincidencia. </option>';
} else {
  $sql= "SELECT DISTINCT (dist2) FROM rutas WHERE tipoViaje = '$tipoViaje' AND id = '$ident' ORDER BY dist2 DESC";
  $res = mysqli_query($link, $sql) or die ('<h4>Notifica al Administrador. '.$sql.'</h4>');

  echo '<h4></h4>';

  $dat = mysqli_fetch_array($res);
    echo '<h4>'.$dat['dist2'].' km.</h4>';

}


?>
