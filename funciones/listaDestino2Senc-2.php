<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';
$tipoViaje = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
//print_r($_POST);

if ($ident == '' OR $tipoViaje == '') {
  echo '<h4> '.$tipoViaje.' -  </h4>';
  echo '<option> No hubo ninguna coincidencia. </option>';
} else {
  $sql= "SELECT dist1 FROM rutas WHERE tipoViaje = 'Sencillo' AND destino1 = '$ident' ORDER BY dist1 DESC";
  $res = mysqli_query($link, $sql) or die ('<h4>Notifica al Administrador. '.$sql.'</h4>');

  echo '<h4></h4>';

  $dat = mysqli_fetch_array($res);
    echo '<h4>'.$dat['dist1'].' km.</h4>';

}


?>
