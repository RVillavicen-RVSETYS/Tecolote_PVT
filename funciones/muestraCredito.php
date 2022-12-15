<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';

if ($ident == '') {
  echo '<option> No hubo ninguna coincidencia. </option>';
} else {
  $sql= "SELECT * FROM gasolineras WHERE id = '$ident'";
  $res = mysqli_query($link, $sql) or die ('<option>Notifica al Administrador. '.$sql.'</option>');
$dat = mysqli_fetch_array($res);

  if ($dat['credito'] == 1) {
    $muestra= 'Con Crédito';
  } else {
    $muestra= 'Sin Crédito';
  }

  echo '<div>
        <h4>'.$muestra.'.</h4>
  </div>';

}


?>
