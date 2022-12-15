<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';
$tipoViaje = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';

if ($ident == '' OR $tipoViaje == '') {
  echo '<option> '.$tipoViaje.' -  </option>';
  echo '<option> No hubo ninguna coincidencia. </option>';
} else {
  $sql= "SELECT DISTINCT(destino2) FROM rutas WHERE tipoViaje = '$tipoViaje' AND destino1 = '$ident' ORDER BY destino2 ASC";
  $res = mysqli_query($link, $sql) or die ('<option>Notifica al Administrador. '.$sql.'</option>');

  echo '<option value=""></option>';

  while ($dat = mysqli_fetch_array($res)) {
    echo '<option value="'.$dat['destino2'].'">'.$dat['destino2'].'</option>';

  }
}


?>
