<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$tabla = (isset($_POST['catTabla']) AND $_POST['catTabla'] >= 1) ? $_POST['catTabla'] : '' ;
$sql="SELECT *
      FROM contactos
      WHERE idRegistro='$id' AND idCatTabla = '$tabla'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');
//echo $sql;

echo '
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css" />

<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Tel. Oficina</th>
      <th>Celular</th>
      <th>Correo</th>
      <th class="text-right">Funciones</th>
    </tr>
  </thead>
  <tbody id="bodyTable">';

if (mysqli_num_rows($result) == 0) {
  echo '
    <tr>
      <td class="text-center" colspan="3">No ha registrado ningúna Contacto a este Cliente.</td>
    </tr>';
}

$count = 0;
while ($dat = mysqli_fetch_array($result)) {
  $count++;
  echo '
      <tr id="filaUser'.$dat['id'].'">
        <td>'.$count.'</td>
        <td>'.$dat['nombre'].'</td>
        <td>'.$dat['telOf'].'</td>
        <td>'.$dat['cel'].'</td>
        <td>'.$dat['correo'].'</td>
        <td class="text-right">
          <button type="button" class="btn btn-icon-toggle" onclick="editaContacto('.$dat['id'].')" data-toggle="modal" data-target="#formEditContacto"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
          <button type="button" onclick="quitaContacto('.$dat['id'].');" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Registro"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>';
}

echo '
  </tbody>
</table>
<input type="hidden" name="identMarca" id="identMarca" value="'.$id.'">';
?>
<script>
function quitaContacto(ident){
  $.post("../funciones/borrarContacto.php",
    { ident:ident },
      function(respuesta){
        if (respuesta == 1) {
          notificaSuc('Se a Borrado Correctamente.');
          $("#filaUser"+ident).remove();
        } else {
          notificaBad('No se pudo borrar el Usuario');
        }
      });
}
function editaContacto(ident){
  $.post("../funciones/formEditaContactos.php",
    { ident:ident},
      function(respuesta){
        $("#contactoContent").html(respuesta);
      });
}
</script>
