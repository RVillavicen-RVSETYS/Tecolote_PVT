<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$columna = (isset($_POST['columna'])) ? $_POST['columna'] : '';
$idRuta = (isset($_POST['idRuta'])) ? $_POST['idRuta'] : '';

//print_r($_POST);

if ($idRuta != '' AND $columna != '') {
  $sql= "SELECT SUM(cst.$columna) AS costoFinal
          FROM rutacaseta rts
          INNER JOIN casetas cst ON rts.idCaseta = cst.id
          WHERE rts.idRuta = '$idRuta'
          GROUP BY idRuta ";
  $res = mysqli_query($link, $sql) or die ('<h4>Notifica al Administrador. '.$sql.'</h4>');

  $val = mysqli_fetch_array($res);

  echo '<h4>Monto de Casetas: $ '.number_format($val['costoFinal'], 2, '.', ',').' </h4>
        <input type="hidden" name="costoCas" id="costoCas" value="'.number_format($val['costoFinal'], 2, '.', ',').'">
  ';
} else {
  echo '<h4 class="text-warning"> Faltan Datos. </h4>';
}


?>
