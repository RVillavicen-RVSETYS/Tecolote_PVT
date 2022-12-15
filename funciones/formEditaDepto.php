<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT * FROM catdeptos WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaDeptoLabel"><b>Editar Departamento: </b><?=$dat['nombre'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaDepto.php">
    <div class="modal-body" id="editaDeptoBody">
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">Nombre</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="<?=$dat['nombre'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="estatus" class="control-label">Estatus</label>
        </div>
        <div class="col-sm-9">
          <select class="form-control" name="estatus">
            <option value="0" <?=($dat['estatus']==0) ? 'selected' : '';?> > Inactivo </option>
            <option value="1" <?=($dat['estatus']==1) ? 'selected' : '';?> > Activo </option>
          </select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$dat['id'];?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>
