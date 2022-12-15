<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;


$sql="SELECT * FROM gasolineras WHERE id='$id'";
//echo $sql.'<br><br>';
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
$id2= $dat['id'];
$nombre = $dat['nombre'];
$estado = $dat['idCatEstado'];
$municipio = $dat['idCatMunicipio'];
$direccion = $dat['direccion'];
$referencia = $dat['referencia'];
$rfc = $dat['rfc'];
$estatus = $dat['estatus'];
$credito = $dat['credito'];

if ($estatus=='1') {
  $infoEstatus = 'Activo';
} else {
  $infoEstatus = 'Inactivo';
}

//echo 'Estado: '.$estado.'<br> Municipio: '.$municipio.'<br>';

?>


  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="formEditGasolineraLabel"><b>Editar Gasolinera "</b><?=$nombre;?>"</h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaGasolinera.php">
    <div class="modal-body" id="editaGasolineraBody">
      <div class="form-group">
        <div class="col-sm-3">
          <label for="nombre" class="control-label">Nombre</label>
        </div>
        <div class="col-sm-9">
          <input type="nombre" name="nombre" id="nombre" class="form-control" placeholder="Nombre de la Gasolinera" value="<?=$nombre;?>">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="estado" class="control-label">Estado</label>
        </div>
        <div class="col-sm-9">
          <div class="form-control">
            <?php
            $sql="SELECT * FROM catestados ORDER BY nombre ASC";
            $res=mysqli_query($link,$sql) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');
             ?>
            <select id="estado" name="estado" onchange="listaCatMunicipio(this.value);" class="form-control" value="<?=$estado;?>">
              <option value=""></option>
              <?php
              while ($est = mysqli_fetch_array($res)) {
                $active = ($estado == $est['id']) ? 'selected' :'' ;
                echo '
                <option value="'.$est['id'].'" '.$active.'>'.$est['nombre'].'</option>
                ';
              }
               ?>
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="municipio" class="control-label">Municipio</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sql="SELECT * FROM catmunicipios WHERE idCatEstado = '$estado' ORDER BY nombre ASC";
          $res=mysqli_query($link,$sql) OR die('<p class="text-danger">Notifica a tu Administrador</p>');
           ?>
          <select name="municipio" id="municipio" class="form-control" required>
            <option value=""></option>
              <?php
              $active = '';
              while ($mun = mysqli_fetch_array($res)) {
                $active = ($municipio == $mun['id']) ? 'selected' :'' ;
                echo '
                <option value="'.$mun['id'].'" '.$active.'>'.$mun['nombre'].'</option>
                ';
              }
               ?>
          </select>
        </div>
      </div>
            <div class="form-group">
        <div class="col-sm-3">
          <label for="referencia" class="control-label">Dirección</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" value="<?=$direccion;?>">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="referencia" class="control-label"># Cliente	</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="referencia" id="referencia" class="form-control" placeholder="# Cliente" value="<?=$referencia;?>">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="credito" class="control-label">Crédito</label>
        </div>
        <div class="col-sm-9">
          <select class="form-control" name="credito">
            <option value="0" <?=($dat['estatus']==0) ? 'selected' : '';?> > Inactivo </option>
            <option value="1" <?=($dat['estatus']==1) ? 'selected' : '';?> > Activo </option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="estatus" class="control-label">Estatus</label>
        </div>
        <div class="col-sm-9">
          <select class="form-control" name="Estatus">
            <option value="0" <?=($dat['estatus']==0) ? 'selected' : '';?> > Inactivo </option>
            <option value="1" <?=($dat['estatus']==1) ? 'selected' : '';?> > Activo </option>
          </select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$id2;?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>
