<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT * FROM catcombustibles WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaCombustibleLabel"><b>Editar Combustible: </b><?=$dat['nombre'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaCombustible.php">
    <div class="modal-body" id="editaCombustibleBody">
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">Nombre</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="<?=$dat['nombre'];?>" required>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$dat['id'];?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>
