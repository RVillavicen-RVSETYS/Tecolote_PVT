<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';
$dest1 = (isset($_POST['dest1'])) ? $_POST['dest1'] : '';
$dest2 = (isset($_POST['dest2'])) ? $_POST['dest2'] : '';
$tipoViaje = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
//print_r($_POST);

if ($ident == '' OR $tipoViaje == '' OR $dest1 == '') {
  echo '<option> '.$tipoViaje.' - '.$dest1.' </option>';
  echo '<option> No hubo ninguna coincidencia. </option>';
} else {
  $sql= "SELECT DISTINCT (dist3) FROM rutas WHERE tipoViaje = '$tipoViaje' AND id = '$ident'  ORDER BY destino3 DESC";
  $res = mysqli_query($link, $sql) or die ('<option>Notifica al Administrador. '.$sql.'</option>');

  echo '  <h4></h4>';

  $dat = mysqli_fetch_array($res);
    echo '<div>
          <h4>'.$dat['dist3'].' km.</h4>
    </div>';

}


?>
