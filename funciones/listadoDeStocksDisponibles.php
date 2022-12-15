<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$idProd = (isset($_POST['idProd'])) ? $_POST['idProd'] : '';
$nameProd = (isset($_POST['nameProd'])) ? $_POST['nameProd'] : '';

if ($idProd == '') {
  errorMSJ('  ');
}

$sql = "SELECT stk.id, stk.noSerie, stk.estatus
        FROM stocks stk
        WHERE stk.idProducto = '$idProd' AND stk.estatus IN ('1','4')
        ORDER BY stk.id ASC";
$res = mysqli_query($link, $sql) or die (errorBD('Problemas al listar los productos del Stock.'));
$cantRes = mysqli_num_rows($res);

if ($cantRes == 0) {
  $sql = "SELECT id
          FROM stocks
          WHERE idProducto = '$idProd' AND estatus = '4'";
  $res = mysqli_query($link, $sql) or die (errorBD('Problemas al listar los productos que se estan asignando.'));
  $cantAsignando = mysqli_num_rows($res);

  if ($cantAsignando >= 1) {
    errorMSJ('Se estan asignando '.$cantAsignando.' ultimos.');
  } else {
    errorMSJ('Ya no hay Disponibles!');
  }

}
$contenido = '<optgroup label="'.$nameProd.'">';
while ($pdt = mysqli_fetch_array($res)) {
  $estat = '';
  if ($pdt['estatus'] == '4') {
    $estat = 'disabled';
  }
  $contenido .=  '
			<option value="'.$pdt['id'].'" '.$estat.'>'.$pdt['noSerie'].'</option>';
}
$contenido .=  '
  </optgroup>';

//----------  Finaliza con Exito  -------------------------

echo '1| Selecciona los No de Serie a Asignar.|'.$contenido;


while ($dat = mysqli_fetch_array($res)) {
  echo '<option value="'.$dat['id'].'">'.$dat['destino3'].'</option>';
}

function errorMSJ($error){
  echo '0|'.$error;
  exit(0);
}

function errorBD($error){
  echo '2|'.$error;
  exit(0);
}
?>
