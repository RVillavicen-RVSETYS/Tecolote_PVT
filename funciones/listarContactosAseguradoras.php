<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT *
      FROM contactos
      WHERE idRegistro = '$id' AND idCatTabla = '1'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');
//echo $sql;

echo '
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css" />

<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre y Correo</th>
      <th>Telefonos</th>
      <th class="text-right">Quitar</th>
    </tr>
  </thead>
  <tbody id="bodyTable">';

if (mysqli_num_rows($result) == 0) {
  echo '
    <tr>
      <td class="text-center" colspan="4">No ha registrado ningun Contacto para esta Aseguradora.</td>
    </tr>';
}

$count = 0;
while ($dat = mysqli_fetch_array($result)) {
  $count++;
  echo '
      <tr id="filaServicio'.$dat['id'].'">
        <td>'.$count.'</td>
        <td>'.$dat['nombre'].' <br><small><i class="md md-mail"></i> '.$dat['correo'].' </small></td>
        <td><small><i class="md md-local-phone"></i> '.$dat['telOf'].' <br><i class="md md-phone-iphone"></i>  '.$dat['cel'].'</small></td>
        <td class="text-right">
          <button type="button" onclick="quitaContactoAseguradora('.$dat['id'].');" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Registro"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>';
}

echo '
  </tbody>
</table>
<input type="hidden" name="identAseguradora" id="identAseguradora" value="'.$id.'">';
?>
<script>
function quitaServicios(ident){
  $.post("../funciones/borrarContactoAseguradora.php",
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
