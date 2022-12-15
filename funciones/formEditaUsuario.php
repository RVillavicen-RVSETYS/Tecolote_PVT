<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;

$sql="SELECT * FROM segusuarios WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaUsuarioLabel"><b>Editar Usuario: </b><?=$dat['nombre'].' '.$dat['apellidos'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaUsuario.php">
    <div class="modal-body" id="editaUsuarioBody">
      <span class=""><center><b>NOTA: </b>Si no deceas cambiar la contraseña dejala en blanco.</center></span><br>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="name" class="control-label">Nombre</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" value="<?=$dat['nombre'];?>" required>
        </div>
      </div>
        <div class="form-group">
          <div class="col-sm-3">
            <label for="apellidos" class="control-label">Apellidos</label>
          </div>
          <div class="col-sm-9">
            <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" value="<?=$dat['apellidos'];?>" required>
          </div>
        </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="usuario" class="control-label">Usuario</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" value="<?=$dat['usuario'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="password1" class="control-label">Contraseña</label>
        </div>
        <div class="col-sm-9">
          <input type="password" name="password1" id="password1" class="form-control" placeholder="Contraseña">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="password2" class="control-label" >Repite Contraseña</label>
        </div>
        <div class="col-sm-9">
          <input type="password" name="password2" id="password2" class="form-control" placeholder="Contraseña" >
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nivel" class="control-label">Selecciona Nivel</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sql = "SELECT * FROM segniveles lvl
                  WHERE lvl.estatus = 1
                  ORDER BY lvl.orden ASC";
          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
          ?>
          <select name="nivel" id="nivel" class="form-control" required>
            <?php
            while ($dat1 = mysqli_fetch_array($res)) {
              $act = ($dat1['id'] == $dat['idNivel']) ? 'selected' : '' ;
              echo '<option '.$act.' value="'.$dat1['id'].'">'.$dat1['nombre'].'</option>';
            }
            ?>
          </select>
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
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$dat['id'];?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>
