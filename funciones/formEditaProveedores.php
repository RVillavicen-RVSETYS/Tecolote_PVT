<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/bootstrap.css?1422792965" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css?1425466319" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/font-awesome.min.css?1422529194" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/material-design-iconic-font.min.css?1421434286" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/select2/select2.css?1424887856" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/multi-select/multi-select.css?1424887857" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/bootstrap-datepicker/datepicker3.css?1424887858" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/jquery-ui/jquery-ui-theme.css?1423393666" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/typeahead/typeahead.css?1424887863" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/DataTables/jquery.dataTables.css?1423553989" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/summernote/summernote.css?1425218701" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileinput.css" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css" />
<?php

define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
#echo '<br>'.$id.'<br>';
#print_r($_POST);
$sql="SELECT pvd.*, mpo.nombre AS municipio, edo.nombre AS estado
      FROM proveedores pvd
      INNER JOIN catmunicipios mpo ON pvd.idMunicipio = mpo.id
      INNER JOIN catestados	edo ON pvd.idEstado = edo.id
      WHERE pvd.id = '$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
$ident= $dat['id'];
$name = $dat['nombre'];
$rfc= $dat['rfc'];
$estado = $dat['idEstado'];
$estadoName = $dat['estado'];
$municipio = $dat['idMunicipio'];
$municipioName = $dat['municipio'];
$direccion = $dat['direccion'];
$contacto= $dat['idContacto'];
$banco = $dat['idBanco'];
$claBe = $dat['claBe'];
$estatus=$dat['estatus']
?>
 <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="formEditaproveedoresLabel"><b>Editar Proveedores: </b><?=$dat['nombre'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaProveedores.php">
    <div class="modal-body" id="editaproveedoresContent">
      <div class="form-group">
        <div class="col-sm-3">
          <label for="name" class="control-label">Nombre</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" value="<?=$name;?>" required>
          <input type="hidden" name="ident" id="ident" class="form-control" value="<?=$ident;?>" >
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="estado" class="control-label">Estado</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sql = "SELECT * FROM catestados ORDER BY nombre ASC";
          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
          ?>
          <select name="estado" id="estado" class="form-control" onchange="listaCatMunicipio(this.value);" required>
            <?php
            while ($edo = mysqli_fetch_array($res)) {
              $activa = '';
              if ($estado == $edo['id']) {
              $activa = 'selected';
              }
              echo '<option value="'.$edo['id'].'" '.$activa.'>'.$edo['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="municipio" class="control-label">Municipio</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sqlMun = "SELECT * FROM catmunicipios WHERE idCatEstado = '$estado'  ORDER BY nombre ASC";
          $resMun = mysqli_query($link,$sqlMun) or die('<p class="text-danger">Notifica al Administrador'.mysqli_error($link).'</p>');
          ?>
          <select name="municipio" id="municipio" class="form-control" required>

            <?php
            while ($datMn = mysqli_fetch_array($resMun)) {
              $activa = '';
              if ($municipio == $datMn['id']) {
               $activa = 'selected';
              }
              echo '<option value="'.$datMn['id'].'" '.$activa.'>'.$datMn['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>


      <div class="form-group">
        <div class="col-sm-3">
          <label for="direccion" class="control-label">Direccion</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion" value="<?=$direccion;?>" required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="banco" class="control-label">Banco</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sql = "SELECT * FROM catbancos ORDER BY nombre ASC";
          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
          ?>
          <select name="banco" id="banco" class="form-control"  required>
            <?php
            while ($dat = mysqli_fetch_array($res)) {
              $activa = '';
              if ($banco == $dat['id']) {
                $activa = 'selected';
              }
              echo '<option value="'.$dat['id'].'" '.$activa.'>'.$dat['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>


         <div class="form-group">
          <div class="col-sm-3">
            <label for="claBe" class="control-label">ClaBe</label>
          </div>
          <div class="col-sm-9">
            <input type="text" name="claBe" id="claBe" class="form-control" onkeyup="soloNumeros(this.value,'claBe')" placeholder="claBe" value="<?=$claBe;?>" required>
          </div>
        </div>


      <div class="form-group">
        <div class="col-sm-3">
          <label for="estatus" class="control-label">Estatus</label>
        </div>

        <div class="col-sm-9">
          <select class="form-control" name="estatus">
            <option value="0" <?=($estatus==0) ? 'selected' : '';?> > Inactivo </option>
            <option value="1" <?=($estatus==1) ? 'selected' : '';?> > Activo </option>
          </select>
        </div>
      </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>



  <!-- BEGIN JAVASCRIPT -->
  <script src="../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
  <script src="../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
  <script src="../assets/js/libs/jquery-ui/jquery-ui.min.js"></script>
  <script src="../assets/js/libs/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/js/libs/spin.js/spin.min.js"></script>
  <script src="../assets/js/libs/autosize/jquery.autosize.min.js"></script>
  <script src="../assets/js/libs/select2/select2.min.js"></script>
  <script src="../assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
  <script src="../assets/js/libs/summernote/summernote.min.js"></script>
  <script src="../assets/js/libs/multi-select/jquery.multi-select.js"></script>
  <script src="../assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
  <script src="../assets/js/libs/moment/moment.min.js"></script>
  <script src="../assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
  <script src="../assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
  <script src="../assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
  <script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
  <script src="../assets/js/libs/d3/d3.min.js"></script>
  <script src="../assets/js/libs/d3/d3.v3.js"></script>
  <script src="../assets/js/libs/rickshaw/rickshaw.min.js"></script>
  <script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
  <script src="../assets/js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
  <script src="../assets/js/libs/jquery-validation/dist/additional-methods.min.js"></script>
  <script src="../assets/js/libs/toastr/toastr.js"></script>
  <script src="../assets/js/core/source/App.js"></script>
  <script src="../assets/js/core/source/AppNavigation.js"></script>
  <script src="../assets/js/core/source/AppOffcanvas.js"></script>
  <script src="../assets/js/core/source/AppCard.js"></script>
  <script src="../assets/js/core/source/AppForm.js"></script>
  <script src="../assets/js/core/source/AppNavSearch.js"></script>
  <script src="../assets/js/core/source/AppVendor.js"></script>
  <script src="../assets/js/core/demo/Demo.js"></script>
  <script src="../assets/js/core/demo/DemoTableDynamic.js"></script>
  <script src="../assets/js/core/demo/DemoFormComponents.js"></script>
  <script src="../assets/js/libs/fileInput/fileinput.js"></script>
  <script src="../assets/js/libs/fileInput/fileinput_locale_es.js"></script>
  <script src="../assets/js/libs/toastr/toastr.js"></script>
  <script src="../assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
  <script src="../assets/js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.es.js"></script>
  <script src="../assets/scripts/cadenas.js"></script>
  <script>
$(document).ready(function(){
      $('.txtPopOver').popover('show');

      $('.fechado').datepicker({
        todayHighlight: true,
        format: "yyyy-mm-dd",
        language: "es"
      });
      });


  function listaCatMunicipio(estado){
      $.post("../funciones/listaCatMunicipio.php",
        { ident:estado},
          function(respuesta){
          $("#municipio").html(respuesta);
        });
    }

    function newlistaCatMunicipio(newEstado){
      $.post("../funciones/listaCatMunicipio.php",
        { ident:newEstado},
          function(resp){
          $("#municipio").html(resp);
        });
    }

    </script>
