<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT *
      FROM clientes
      WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');
//echo $sql;

echo '
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css" />

<table class="table table-hover">
  <thead>
    <tr>
      <td>Nombre</td>
        <td>RFC</t>
        <td>Tel</td>
        <td>Estado</td>
        <td class="text-right">Acciones</td>
  
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
        <td>'.$dat['nombre'].'</td>
        <td>'.$dat['tel'].'</td>
        <td>'.$dat['rfc'].'</td>
        <td>'.$dat['estatus'].'</td>
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
  $.post("../funciones/borrarClientes.php",
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
