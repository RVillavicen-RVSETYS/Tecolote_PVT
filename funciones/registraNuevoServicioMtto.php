<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$idMtto = (isset($_POST['idMtto'])) ? $_POST['idMtto'] : '' ;
$nombreServicios = (isset($_POST['nombreServicios'])) ? $_POST['nombreServicios'] : '' ;
$userReg = $_SESSION['ATZident'];

if ($nombreServicios == '') {
  errorBD('0|Hay un Error debes ingresar un <b>Nombre</b> para la Servicios, inténtalo de Nuevo.');
} elseif ($idMtto == '') {
  errorBD('0|Hay un Error debes seleccionar una <b>Mantenimiento</b>, inténtalo de Nuevo.');
}else {
  $sql = "SELECT * FROM catserviciosmttos WHERE nombre = '$nombreServicios' AND idCatTipoMtto = '$idMtto'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant >= 1) {
    errorBD('0| <b>'.$nombreServicios.'</b> ya esta creado para este Mantenimiento.');
  } else {

    $sql="INSERT INTO catserviciosmttos(nombre, idCatTipoMtto, idUserReg, fechaReg) VALUES('$nombreServicios','$idMtto','$userReg',NOW())";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.$sql));

    $last_id = mysqli_insert_id($link);

    $fila = '
        <tr id="filaUser'.$idMtto.'">
          <td><i class="fa fa-angle-right"></i></td>
          <td>'.$nombreServicios.'</td>
          <td class="text-right">
            <button type="button" onclick="quitaUsuario('.$last_id.'):" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Registro"><i class="fa fa-trash-o"></i></button>
          </td>
        </tr>';

    echo '1|'.$idMtto;
  }
}

function errorBD($error){
  echo '0|'.$error;
  exit(0);
}
?>
