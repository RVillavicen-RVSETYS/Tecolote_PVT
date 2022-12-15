<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT * FROM clientes WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<!-- END META -->
		<!-- BEGIN STYLESHEETS -->
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/upload.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileinput.css" />

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title txt-primary" id="editaClienteLabel"><b>Editar Cliente: </b><?=$dat['nombre'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaClientes.php" >
    <div class="modal-body" id="editaClienteBody">
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
          <label for="empresa" class="control-label">Empresa</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa" value="<?=$dat['empresa'];?>" required>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
          <label for="rfc" class="control-label">RFC</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="rfc" id="rfc" onkeyup="cambiaMayusculas(this.value,'rfc')" class="form-control" placeholder="RFC" value="<?=$dat['rfc'];?>" required>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
          <label for="tel" class="control-label">Teléfono</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="tel" id="tel" class="form-control" placeholder="Teléfono" value="<?=$dat['tel'];?>" required>
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



  <!-- BEGIN JAVASCRIPT -->
	<script src="../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
	<script src="../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script src="../assets/js/libs/jquery-ui/jquery-ui.min.js"></script>
	<script src="../assets/js/libs/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/libs/spin.js/spin.min.js"></script>
	<script src="../assets/js/libs/autosize/jquery.autosize.min.js"></script>
	<script src="../assets/js/libs/select2/select2.min.js"></script>
	<script src="../assets/js/libs/select2/select2_locale_es.js"></script>
	<script src="../assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="../assets/js/libs/summernote/summernote.min.js"></script>
	<script src="../assets/js/libs/multi-select/jquery.multi-select.js"></script>
	<script src="../assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
	<script src="../assets/js/libs/moment/moment.min.js"></script>
	<script src="../assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
	<script src="../assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
	<script src="../assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
	<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
	<script src="../assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
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
