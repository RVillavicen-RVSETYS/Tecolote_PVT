<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$idMarca = (isset($_POST['idMarca'])) ? $_POST['idMarca'] : '' ;
$nombreSubMarca = (isset($_POST['nombreSubMarca'])) ? $_POST['nombreSubMarca'] : '' ;
$userReg = $_SESSION['ATZident'];

if ($nombreSubMarca == '') {
  errorBD('0|Hay un Error debes ingresar un <b>Nombre</b> para la SubMarca, inténtalo de Nuevo.');
} elseif ($idMarca == '') {
  errorBD('0|Hay un Error debes seleccionar una <b>Marca</b>, inténtalo de Nuevo.');
}else {
  $sql = "SELECT * FROM catsubmarcas WHERE nombre = '$nombreSubMarca' AND idCatMarca = '$idMarca'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant >= 1) {
    errorBD('0| <b>'.$nombreSubMarca.'</b> ya esta creado para esta Marca.');
  } else {

    $sql="INSERT INTO catsubmarcas(nombre, idCatMarca, idUserReg, fechaReg) VALUES('$nombreSubMarca','$idMarca','$userReg',NOW())";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

    $last_id = mysqli_insert_id($link);

    $fila = '
        <tr id="filaUser'.$idMarca.'">
          <td><i class="fa fa-angle-right"></i></td>
          <td>'.$nombreSubMarca.'</td>
          <td class="text-right">
            <button type="button" onclick="quitaUsuario('.$last_id.'):" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Registro"><i class="fa fa-trash-o"></i></button>
          </td>
        </tr>';

    echo '1|'.$idMarca;
  }
}

function errorBD($error){
  echo '0|'.$error;
  exit(0);
}
?>
