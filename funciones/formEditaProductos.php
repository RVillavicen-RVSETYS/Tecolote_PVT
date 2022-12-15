<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;

$sql="SELECT * FROM productos WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaProdLabel"><b>Editar Producto: </b><?=$dat['nombre'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaProductos.php" enctype="multipart/form-data">
    <div class="modal-body" id="editaProductoBody">

      <div class="form-group">
        <div class="col-sm-3">
          <label for="depto" class="control-label">Departamento</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sql = "SELECT * FROM catdeptos ORDER BY nombre ASC";
          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
          ?>
          <select name="editdepto" id="editdepto" class="form-control" placeholder="Selecciona un Departamento" required>
            <?php
            while ($dep = mysqli_fetch_array($res)) {
              $active = ($dep['id'] == $dat['idDepto']) ? 'selected' : '' ;
              echo '<option value="'.$dep['id'].'" '.$active.'>'.$dep['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editnombre" class="control-label">Nombre</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="editnombre" id="editnombre" class="form-control" placeholder="Nombre." value="<?=$dat['nombre'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editmarca" class="control-label">Selecciona la Marca</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sql = "SELECT * FROM catmarcas WHERE idCatTabla = '9' ORDER BY nombre ASC";
          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
          ?>
          <select name="editmarca" id="editmarca" onchange="listaCatSubmarca1(this.value);" class="form-control" required>
            <?php
            while ($mrk = mysqli_fetch_array($res)) {
              $active = ($mrk['id'] == $dat['idCatMarca']) ? 'selected' : '' ;
              echo '<option value="'.$mrk['id'].'" '.$active.'>'.$mrk['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editmodelo" class="control-label">Selecciona el Modelo</label>
        </div>
        <div class="col-sm-9">
          <?php
          $mrka = $dat['idCatMarca'];
          $sql = "SELECT * FROM catsubmarcas WHERE idCatMarca = '$mrka' ORDER BY nombre ASC";
          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>'.mysqli_error($link));
          ?>
          <select name="editmodelo" id="editmodelo" class="form-control" required>
            <?php
            while ($sbmrk = mysqli_fetch_array($res)) {
              $active = ($sbmrk['id'] == $dat['idCatSubMarca']) ? 'selected' : '' ;
              echo '<option value="'.$sbmrk['id'].'" '.$active.'>'.$sbmrk['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editserie" class="control-label">Tipo de Serie</label>
        </div>
        <div class="col-sm-9">
          <select name="editserie" id="editserie" class="form-control" onchange="tipoSerie1(this.value);" required>
            <option value="1">Generación Automatica</option>
            <option value="0" <?=($dat['serieAuto'] == 0)? 'selected' : '';?> >Ingreso Manual</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editpreserie" class="control-label">Pre-Serie</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="editpreserie" id="editpreserie" class="form-control" placeholder="Ingresa la Pre-Serie" <?=($dat['serieAuto'] == 0)? 'disabled' : 'value="'.$dat['preSerie'].'"';?> required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editminimo" class="control-label">Cantidad Minima</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="editminimo" id="editminimo" class="form-control" placeholder="Cantidad Minima de Stock" value="<?=$dat['min'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editmaximo" class="control-label">Cantidad Maxima</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="editmaximo" id="editmaximo" class="form-control" placeholder="Cantidad Maxima de Stock" value="<?=$dat['max'];?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editestatus" class="control-label">Selecciona el Estatus</label>
        </div>
        <div class="col-sm-9">
          <select name="editestatus" id="editestatus" class="form-control" required>
            <option value="1">Activado</option>
            <option value="0" <?=($dat['estatus'] == 0)? 'selected' : '';?> >Desactivado</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="editbaja" class="control-label">Especificar Baja</label>
        </div>
        <div class="col-sm-9">
          <select name="editbaja" id="editbaja" class="form-control" required>
            <option value="1">SI</option>
            <option value="0" <?=($dat['reqBaja'] == 0)? 'selected' : '';?> >NO</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="foto" class="control-label">Fotografia</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="foto" id="foto1"  class="form-control foto">
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$dat['id'];?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>

<script type="text/javascript">
  $("#foto1").fileinput({
        showUpload: false,
        showCaption: false,
        language: 'es',
        allowedFileExtensions : ['jpg', 'jpeg'],
        maxFileSize: 5120,
        maxFilesNum: 1,
        browseClass: "btn btn-primary btn-lg",
        fileType: "any"
      });
</script>