<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT * FROM casetas WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="editaBancoLabel"><b>Editar Caseta: </b><?=$dat['nombre'];?></h4>
</div>
<form class="form-horizontal" role="form" method="post" action="../funciones/editaCaseta.php">
  <div class="modal-body" id="editaBancoBody">
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">Nombre</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="<?=$dat['nombre'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-12 text-center">
          <label for="nombre" class="control-label">Costos</label>
        </div>
        <div class="col-sm-3">
          <label for="nombre" class="control-label">Autos</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="costo" id="costo" class="form-control" placeholder="Autos" value="<?=$dat['costo'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">2, 3 y 4 Ejes</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="costo2" id="costo" class="form-control" placeholder="2, 3 y 4 Ejes" value="<?=$dat['costo2'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">5 y 6 Ejes</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="costo3" id="costo" class="form-control" placeholder="5 y 6 Ejes" value="<?=$dat['costo3'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">7, 8 y 9 Ejes</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="costo4" id="costo" class="form-control" placeholder="7, 8 y 9 Ejes" value="<?=$dat['costo4'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">Excedente Ligero</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="costo5" id="costo" class="form-control" placeholder="Excedente Ligero" value="<?=$dat['costo5'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">Excedente Carga</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="costo6" id="costo" class="form-control" placeholder="Excedente Carga" value="<?=$dat['costo6'];?>" required>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$dat['id'];?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>
