<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT nombre AS servicio, id
      FROM catserviciosmttos
      WHERE idCatTipoMtto='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');
//echo $sql;

echo '
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css" />

<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th class="text-right">Editar</th>
    </tr>
  </thead>
  <tbody id="bodyTable">';

if (mysqli_num_rows($result) == 0) {
  echo '
    <tr>
      <td class="text-center" colspan="3">No ha registrado ningun Servicio para este Mantenimiento.</td>
    </tr>';
}

$count = 0;
while ($dat = mysqli_fetch_array($result)) {
  $count++;
  echo '
      <tr id="filaServicio'.$dat['id'].'">
        <td>'.$count.'</td>
        <td>'.$dat['servicio'].'</td>
        <td class="text-right">
          <button type="button" onclick="quitaServicios('.$dat['id'].');" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Registro"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>';
}

echo '
  </tbody>
</table>
<input type="hidden" name="identMtto" id="identMtto" value="'.$id.'">';
?>
<script>
function quitaServicios(ident){
  $.post("../funciones/borrarServiciosMttos.php",
    { ident:ident },
      function(respuesta){
        if (respuesta == 1) {
          notificaSuc('Se a Borrado Correctamente.');
          $("#filaServicio"+ident).remove();
        } else {
          notificaBad('No se pudo borrar el Usuario');
        }
      });
}
</script>
