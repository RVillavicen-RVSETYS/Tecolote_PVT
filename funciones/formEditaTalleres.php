<?php

define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
#echo '<br>'.$id.'<br>';
#print_r($_POST);
$sql="SELECT tlls.*,cetd.nombre AS estado, cmpi.nombre AS municipio, esp.nombre AS espicialidad

                        FROM talleres tlls
                        LEFT JOIN catestados cetd ON tlls.idEstado= cetd.id
                        LEFT JOIN catmunicipios cmpi ON tlls.idMunicipio = cmpi.id
                        LEFT JOIN catespecialidades esp ON tlls.idCatEspecialidad = esp.id
                        WHERE  tlls.id = '$id'
                        ORDER BY id ASC";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
$ident= $id;
$name = $dat['nombre'];
$rfc= $dat['rfc'];
$estado = $dat['idEstado'];
$estadoName = $dat['estado'];
$municipio = $dat['idMunicipio'];
$municipioName = $dat['municipio'];
$direccion = $dat['direccion'];
$tel = $dat['tel'];
$refe = $dat['referencias'];
$esp = $dat['idCatEspecialidad'];
$estatus=$dat['estatus'];
?>

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

 <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="formEditTallerLabel"><b>Editar Taller: </b><?=$dat['nombre'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaTalleres.php">
    <div class="modal-body" id="editaTallerContent">
      <div class="form-group">
        <div class="col-sm-3">
          <label for="name" class="control-label">Nombre</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" value="<?=$name;?>" required>
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
              echo '<option value="'.$datMn['id'].'" >'.$datMn['nombre'].'</option>';
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
            <label for="claBe" class="control-label">Tel</label>
          </div>
          <div class="col-sm-9">
            <input type="tel" name="tel" id="tel" class="form-control" placeholder="tel" value="<?=$tel;?>" required>
          </div>
        </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="referencia" class="control-label">Referencias</label>
        </div>
        <div class="col-sm-9">
          <input name="referencia" id="referencia" class="form-control"  value="<?=$refe;?>"required></textarea>
          </div>
      </div>



         <div class="form-group">
        <div class="col-sm-3">
          <label for="especialidad" class="control-label">Especialidad</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sql = "SELECT * FROM catespecialidades ";
          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
          ?>
          <select name="especialidad" id="especialidad" class="form-control" >
            <?php
            while ($dat = mysqli_fetch_array($res)) {
              $activa = '';
              if ($esp == $dat['id']) {
                $activa = 'selected';
              }
              echo '<option value="'.$dat['id'].'" >  '.$dat['nombre'].'  </option>';
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
            <option value="0" <?=($estatus==0) ? 'selected' : '';?> > Inactivo </option>
            <option value="1" <?=($estatus==1) ? 'selected' : '';?> > Activo </option>
          </select>
        </div>
      </div>

    <div class="modal-footer">
      <input type="hidden" name="ident" id="ident" class="form-control" value="<?=$ident;?>" >
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
