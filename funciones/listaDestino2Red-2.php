<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';
$tipoViaje = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
//print_r($_POST);

if ($ident == '' OR $tipoViaje == '') {
  echo '<h4>'.$tipoViaje.'</h4>';
  echo '<h4></h4>';
} else {
  $sql= "SELECT DISTINCT (dist1) FROM rutas WHERE tipoViaje = 'Redondo' AND destino1 = '$ident' ORDER BY dist1 DESC";
  $res = mysqli_query($link, $sql) or die ('<option>Notifica al Administrador. '.$sql.'</option>');

  echo '<div>
        <h4></h4>
  </div>
  <div class="form-group floating-label col-sm-4 align-center">
  <h4></h4>
  </div>';

  $dat = mysqli_fetch_array($res);
    echo '<div>
          <h4>'.$dat['dist1'].' km.</h4>
    </div>';



}


?>
