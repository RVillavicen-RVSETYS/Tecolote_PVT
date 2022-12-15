<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';
$dest1 = (isset($_POST['dest1'])) ? $_POST['dest1'] : '';
$tipoViaje = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';

if ($ident == '' OR $tipoViaje == '' OR $dest1 == '') {
  echo '<option> '.$tipoViaje.' - '.$dest1.' </option>';
  echo '<option> No hubo ninguna coincidencia. </option>';
} else {
  $sql= "SELECT id, destino3 FROM rutas WHERE tipoViaje = '$tipoViaje' AND destino1 = '$dest1' AND destino2 = '$ident'  ORDER BY destino3 ASC";
  $res = mysqli_query($link, $sql) or die ('<option>Notifica al Administrador. '.$sql.'</option>');

  echo '<option value=""></option>';

  while ($dat = mysqli_fetch_array($res)) {
    echo '<option value="'.$dat['id'].'">'.$dat['destino3'].'</option>';

  }
}


?>
