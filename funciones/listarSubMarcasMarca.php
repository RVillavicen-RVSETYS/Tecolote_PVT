<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT nombre AS subMarcas, id
      FROM catsubmarcas
      WHERE idCatMarca='$id'";
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
      <td class="text-center" colspan="3">No ha registrado ninguna SubMarca a esta Marca.</td>
    </tr>';
}

$count = 0;
while ($dat = mysqli_fetch_array($result)) {
  $count++;
  echo '
      <tr id="filaMarca'.$dat['id'].'">
        <td>'.$count.'</td>
        <td>'.$dat['subMarcas'].'</td>
        <td class="text-right">
          <button type="button" onclick="quitaSubMarca('.$dat['id'].');" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Registro"><i class="fa fa-trash-o"></i></button>
        </td>
      </tr>';
}

echo '
  </tbody>
</table>
<input type="hidden" name="identMarca" id="identMarca" value="'.$id.'">';
?>
<script>
function quitaSubMarca(ident){
  $.post("../funciones/borrarSubmarcaMarca.php",
    { ident:ident },
      function(respuesta){
        if (respuesta == 1) {
          notificaSuc('Se a Borrado Correctamente.');
          $("#filaMarca"+ident).remove();
        } else {
          notificaBad('No se pudo borrar el Usuario');
        }
      });
}
</script>
