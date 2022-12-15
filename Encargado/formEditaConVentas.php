<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT * FROM ventas WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
	switch ($dat['estatusPago']) {
		case '1':			$ePago = 'Pendiente';
			break;
		case '2':			$ePago = 'Pagado';
			break;
		case '3':			$ePago = 'Cancelado';
			break;
		default:			$ePago = 'Pendiente';
			break;
	}

	switch ($dat['estatusViaje']) {
		case '1':			$eViaje = 'Pendiente';
			break;
		case '2':			$eViaje = 'En Curso';
			break;
		case '3':			$eViaje = 'Terminado';
			break;
		case '4':			$eViaje = 'Cancelado';
			break;
		default:			$eViaje = 'Pendiente';
			break;
	}
	$ruta2 = $dat['idRuta'];
	$cliente2 = $dat['idCliente'];
	$material2 = $dat['idCatMaterial'];
	$sql2= "SELECT precio
	      FROM  preciomateriales pmat
	      INNER JOIN clientes cli ON cli.id = pmat.idCliente
	      INNER JOIN rutas ru ON ru.id = pmat.idRuta
	      INNER JOIN catmateriales cmat ON cmat.id = pmat.idCatMaterial
	      WHERE ru.id = '$ruta2' AND cli.id = '$cliente2' AND cmat.id = '$material2'
	        limit 1";
	$res2 = mysqli_query($link, $sql2) or die ('<h4>Notifica al Administrador. '.$sql.'</h4>');
	$precioMaterial = mysqli_fetch_array($res2);
	$pre = ($precioMaterial['precio'] == '') ? '' : $precioMaterial['precio'] ;
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title txt-primary" id="editaClienteLabel"><b>Editar Venta </b></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaConVenta.php"  enctype="multipart/form-data">
    <div class="modal-body" id="editaClienteBody">

			<div class="form-group">
        <div class="col-sm-3">
          <label for="casetas" class="control-label">Gasto en Casetas</label>
        </div>
        <div class="col-sm-9">
          <input type="number" step="any" name="casetas" id="casetas" class="form-control" placeholder="Costo de las Casetas" value="<?=$dat['casetas'];?>" required>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
          <label for="peso" class="control-label">Peso</label>
        </div>
        <div class="col-sm-9">
          <input type="number" step="any" name="peso" id="peso" class="form-control" placeholder="Peso en Toneladas" value="<?=$dat['peso'];?>" required>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
          <label for="precio" class="control-label">Precio</label>
        </div>
        <div class="col-sm-9">
          <input type="number" step="any" name="precio" id="precio" class="form-control" placeholder="Ingresa un Precio por Tonelada" value="<?=$pre;?>" required>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
          <label for="folioCarga" class="control-label">Folio de la Carga</label>
        </div>
        <div class="col-sm-9">
          <input type="number" name="folioCarga" id="folioCarga" class="form-control" placeholder="Folio de la Carga" value="<?=$dat['folioCarga'];?>" required>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
          <label for="fechaCarga" class="control-label">Fecha de Carga</label>
        </div>
        <div class="col-sm-9">
          <input type="date" name="fechaCarga" id="fechaCarga" class="form-control fechado" placeholder="Fecha de Carga" value="<?=$dat['fechaCarga'];?>" required>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
          <label for="fechaEntrega" class="control-label">Fecha de Entrega</label>
        </div>
        <div class="col-sm-9">
          <input type="date" name="fechaEntrega" id="fechaEntrega" class="form-control fechado" placeholder="Fecha de Entrega" value="<?=$dat['fechaEntrega'];?>" required>
        </div>
      </div>
			<!--	monto, peso, fechaCarga, tKilometros, ePago, eViaje		-->
			<div class="form-group">
        <div class="col-sm-3">
          <label for="viaje" class="control-label">Estatus del Viaje</label>
        </div>
        <div class="col-sm-9">
          <select class="form-control" name="viaje" value="<?=$dat['estatusViaje'];?>">
						<option value="<?=$dat['estatusViaje'];?>"><?=$eViaje;?></option>
						<option value="1">Pendiente</option>
						<option value="2">En Curso</option>
						<option value="3">Terminado</option>
						<option value="4">Cancelado</option>
          </select>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
          <label for="pago" class="control-label">Estatus del Pago</label>
        </div>
        <div class="col-sm-9">
          <select class="form-control" name="pago" value="<?=$dat['estatusPago'];?>">
						<option value="<?=$dat['estatusPago'];?>"><?=$ePago;?></option>
						<option value="2">Pagado</option>
						<option value="1">Pendiente</option>
						<option value="3">Cancelado</option>
          </select>
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
					<label for="doctoCarga" class="control-label">Documentación Carga en PDF</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="doctoCarga" id="doctoCarga"  class="form-control docto" value="<?=$dat['doctoCarga'];?>" >
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
					<label for="doctoEntrega" class="control-label">Documentación Entrega en PDF</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="doctoEntrega" id="doctoEntrega" class="form-control docto" value="<?=$dat['doctoEntrega'];?>" >
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$dat['id'];?>">
			<input type="hidden" name="ruta" id="ruta" value="<?=$dat['idRuta'];?>">
			<input type="hidden" name="cliente" id="cliente" value="<?=$dat['idCliente'];?>">
			<input type="hidden" name="material" id="material" value="<?=$dat['idCatMaterial'];?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>

	<script>
	$(".docto").fileinput({
		showUpload: false,
		showCaption: false,
		language: 'es',
		allowedFileExtensions : ['PDF','jpg','jpeg'],
		maxFileSize: 5120,
		maxFilesNum: 1,
		browseClass: "btn btn-primary btn-lg",
		fileType: "any",
		previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
	});

	$('.fechado').datepicker({
		todayHighlight: true,
		format: "yyyy-mm-dd",
		language: "es"
	});
	});
	</script>
