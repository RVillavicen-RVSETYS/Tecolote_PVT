<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT * FROM cattipomttos WHERE id='$id'";
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/bootstrap.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/font-awesome.min.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/material-design-iconic-font.min.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/jquery-ui/jquery-ui-theme.css?1423393666" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/bootstrap-tagsinput/bootstrap-tagsinput.css" />

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title txt-primary" id="editaDeptoLabel"><b>Editar el Tipo de Mtto: </b><?=$dat['nombre'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaCatTipoMttos.php" >
    <div class="modal-body" id="editaCatTipoMttoBody">
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



  <!-- BEGIN JAVASCRIPT -->
  <script src="../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
  <script src="../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
  <script src="../assets/js/libs/jquery-ui/jquery-ui.min.js"></script>
  <script src="../assets/js/libs/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/js/libs/spin.js/spin.min.js"></script>
  <script src="../assets/js/libs/autosize/jquery.autosize.min.js"></script>
  <script src="../assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
  <script src="../assets/js/libs/moment/moment.min.js"></script>
  <script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
  <script src="../assets/js/libs/input/fileinput.min.js"></script>
