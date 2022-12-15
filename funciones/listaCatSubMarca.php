<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';

if ($ident == '') {
  echo '<option> No hubo ninguna coincidencia. </option>';
} else {
  $sql= "SELECT * FROM catsubmarcas WHERE idcatmarca = '$ident' ORDER BY nombre ASC";
  $res = mysqli_query($link, $sql) or die ('<option>Notifica al Administrador.</option>');

  while ($dat = mysqli_fetch_array($res)) {
    echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
  }
}



?>
