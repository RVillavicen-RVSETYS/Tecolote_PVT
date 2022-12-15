<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('adminListadoDeArticulos.php');
require '../include/connect.php';
require_once('../funciones/notificaEncargado.php');
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title><?=$info->nombrePag;?></title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='https://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/select2/select2.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/material-design-iconic-font.min.css?1421434286" />
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileInput.css" />

    <link rel="shortcut icon" href="../favicon.ico">
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed full-content ">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="index.php">
									<img src="../assets/img/texto100.png">
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					<?php
					notificaEncargado($link);
					?>
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<img src="../assets/img/avatar1.jpg?1403934956" alt="" />
								<span class="profile-info">
									<?=$info->nombreUser;?>
									<small><?=$info->nombreNivel;?></small>
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
	              <!--<li><a href="html/pages/calendar.html"><i class="fa fa-fw fa-globe"></i> Calendario</a></li>
								<li class="divider"></li>-->
								<?=$info->generaMenuUsuario();?>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-profile -->
					<ul class="header-nav header-nav-toggle">
						<li>
							<a class="btn btn-icon-toggle btn-default" href="#offcanvas-search" data-toggle="offcanvas" data-backdrop="false">
								<i class="fa fa-ellipsis-v"></i>
							</a>
						</li>
					</ul><!--end .header-nav-toggle -->
				</div><!--end #header-navbar-collapse -->
			</div>
		</header>
		<!-- END HEADER-->

		<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->

			<!-- BEGIN CONTENT-->
			<div id="content">
				<section class="has-actions style-default">

					<!-- BEGIN INTRO -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="text-primary"><?=$info->nombrePag;?></h1>
						</div><!--end .col -->
						<div class="col-lg-8">
							<article class="margin-bottom-xxl">
								<p class="lead"><?=$info->detailPag;?></p>
							</article>
						</div><!--end .col -->
					</div><!--end .row -->
					<!-- END INTRO -->

					<!-- BEGIN INBOX -->
					<div class="section-body">
						<div class="row">

						<!-- BEGIN ACTION -->
						<div class="card">
							<div class="card-head">
								<header><i class="md md-format-list-bulleted"></i> Listado Por Articulo</header>
								<div class="tools">
									<div class="btn-group" data-toggle="tooltip" data-placement="top" data-original-title="Crear nuevo Producto">
										<a class="btn btn-floating-action btn-primary" data-toggle="modal" data-target="#formNewProducto"><i class="fa fa-plus"></i></a>
									</div>
								</div>
							</div>

							<div class="card-body">
								<!-- BEGIN DATATABLE 1 -->
								<?php
								require('../include/connect.php');
								$sql="SELECT pdt.id, dpt.nombre AS depto, pdt.nombre AS producto, mrk.nombre AS mark, sbmk.nombre AS submrk,
								COUNT(pdt.id) AS stock, pdt.min, pdt.max, pdt.estatus, pdt.foto
											FROM stocks stk
											INNER JOIN productos pdt ON stk.idProducto = pdt.id
											INNER JOIN catmarcas mrk ON pdt.idCatMarca = mrk.id
											INNER JOIN catsubmarcas sbmk ON pdt.idCatSubMarca = sbmk.id
											INNER JOIN catdeptos dpt ON pdt.idDepto = dpt.id
											GROUP BY stk.idProducto
											ORDER BY pdt.nombre ASC";
								//echo $sql.'<br>';
								$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
								?>
									<div class="table-responsive">
										<table id="listadoDeArticulos" class="table table-striped table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>Foto</th>
													<th>Departamento</th>
													<th>nombre</th>
													<th>Marca</th>
													<th>Modelo</th>
													<th>Cant. Actual</th>
													<th>Minimo</th>
													<th>Maximo</th>
													<th class="text-center">Estatus</th>
												</tr>
											</thead>
											<tbody>
												<?php
												while ($dat = mysqli_fetch_array($res)) {
													$estatus = ($dat['estatus'] >= 1) ? '<center class="text-success"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Activo"><i class="md md-done"></i></center>' : '<center class="text-danger"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Desactivado"><i class="md md-close"></i></center>' ;
													$estatusText = ($dat['estatus'] >= 1) ? '' : 'class="text-danger"' ;
													$serie = ($dat['serieAuto'] == 1) ? 'Automatica' : 'Manual' ;
													$fecha = $dat['dateReg'];
													$colorStock = ($dat['stock'] > $dat['max']) ? 'text-accent' : 'text-danger' ;
													$colorStock = ($dat['stock'] <= $dat['max'] AND $dat['stock'] >= $dat['min']) ? 'text-default' : $colorStock ;
													$foto = ($dat['foto'] == '') ? 'assets/img/noimg.png' : $dat['foto'] ;
													echo '
													<tr '.$estatusText.'>
														<td>'.$dat['id'].'</td>
														<td><button type="button" class="btn ink-reaction btn-icon-toggle btn-primary" data-toggle="modal" data-target="#simpleModal" onclick="visualizaImg(\'../'.$foto.'\', \''.$dat['producto'].'\');"><img class="img-circle width-1" src="../'.$foto.'" alt="IMG"></button></td>
														<td>'.$dat['depto'].'</td>
														<td>'.$dat['producto'].'</td>
														<td>'.$dat['mark'].'</td>
														<td>'.$dat['submrk'].'</td>
														<td class="'.$colorStock.'"><b>'.$dat['stock'].'</b></td>
														<td>'.$dat['min'].'</td>
														<td>'.$dat['max'].'</td>
														<td class="text-center">'.$estatus.'</td>
													</tr>';
												}
												?>
											</tbody>
										</table>
									</div><!--end .table-responsive -->
								<!-- END DATATABLE 1 -->
							</div><!--end .card-body -->
						</div><!--end .card -->

						</div><!--end .row -->
					</div><!--end .section-body -->
					<!-- END INBOX -->

					<!-- BEGIN SECTION ACTION -->
					<div class="section-action style-primary">
						<div class="section-action-row">
						</div>
						<div class="section-floating-action-row">
							<a class="btn ink-reaction btn-floating-action btn-lg btn-accent" data-target="#imprimeStock" data-toggle="modal"  data-original-title="Imprimir stocks.">
								<i class="md md-print"></i>
							</a>&nbsp;
							<a class="btn ink-reaction btn-floating-action btn-lg btn-accent" href="adminInventario.php" data-toggle="tooltip" data-placement="top" data-original-title="Regresar a Registro y Asignación.">
								<i class="md md-reply-all"></i>
							</a>&nbsp;
							<a class="btn ink-reaction btn-floating-action btn-lg btn-accent" href="adminDetalleInventario.php" data-toggle="tooltip" data-placement="top" data-original-title="Ver General de los Productos.">
								<i class="md md-assignment"></i>
							</a>
						</div>
					</div><!--end .section-action -->
					<!-- END SECTION ACTION -->

				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formNewProducto" tabindex="-1" role="dialog" aria-labelledby="formNewProductoLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formNewProductoLabel"><b>Crear Nuevo Producto</b></h4>
						</div>
						<form class="form-horizontal" role="form" method="post" action="../funciones/registraNuevoProducto.php" enctype="multipart/form-data">
							<div class="modal-body">
								<div class="form-group">
									<div class="col-sm-3">
										<label for="depto" class="control-label">Departamento</label>
									</div>
									<div class="col-sm-9">
										<?php
										$sql = "SELECT * FROM catdeptos ORDER BY nombre ASC";
										$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
										?>
										<select name="depto" id="depto" class="form-control" placeholder="Selecciona un Departamento" required>
											<option value=""></option>
											<?php
											while ($dat = mysqli_fetch_array($res)) {
												echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="nombre" class="control-label">Nombre del Producto</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del Producto." onkeyup="limpiaTexto(this.value);" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="marca" class="control-label">Selecciona la Marca</label>
									</div>
									<div class="col-sm-9">
										<?php
										$sql = "SELECT * FROM catmarcas WHERE idCatTabla = '9' ORDER BY nombre ASC";
										$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
										?>
										<select name="marca" id="marca" onchange="listaCatSubmarca(this.value);" class="form-control" required>
											<?php
												echo '<option></option>';
											while ($dat = mysqli_fetch_array($res)) {
												echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="modelo" class="control-label">Selecciona Modelo</label>
									</div>
									<div class="col-sm-9">
										<select name="modelo" id="modelo" class="form-control" required>
											<option value=""></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="serie" class="control-label">Tipo de Serie</label>
									</div>
									<div class="col-sm-9">
										<select name="serie" id="serie" class="form-control" onchange="tipoSerie(this.value);" required>
											<option value="1">Generación Automatica</option>
											<option value="0">Ingreso Manual</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="preserie" class="control-label">Pre-Serie</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="preserie" id="preserie" class="form-control" placeholder="Ingresa la Pre-Serie" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="minimo" class="control-label">Cantidad Minima</label>
									</div>
									<div class="col-sm-9">
										<input type="number" name="minimo" id="minimo" class="form-control" placeholder="Cantidad Minima de Stock" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="maximo" class="control-label">Cantidad Maxima</label>
									</div>
									<div class="col-sm-9">
										<input type="number" name="maximo" id="maximo" class="form-control" placeholder="Cantidad Maxima de Stock" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="estatus" class="control-label">Selecciona el Estatus</label>
									</div>
									<div class="col-sm-9">
										<select name="estatus" id="estatus" class="form-control" required>
											<option value="1">Activado</option>
											<option value="0">Desactivado</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="baja" class="control-label">Especificar Baja</label>
									</div>
									<div class="col-sm-9">
										<select name="baja" id="baja" class="form-control" required>
											<option value="1">SI</option>
											<option value="0">NO</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="foto" class="control-label">Fotografia</label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="foto" id="foto"  class="form-control foto">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Registrar</button>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- END FORM MODAL MARKUP -->

			<!-- BEGIN SIMPLE MODAL MARKUP -->
			<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="simpleModalLabel">Foto</h4>
						</div>
						<div class="modal-body" id="cuerpoModal">
							...
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- END SIMPLE MODAL MARKUP -->

			<div class="modal fade" id="imprimeStock" tabindex="-1" role="dialog" aria-labelledby="imprimeStockLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="imprimeStockLabel">Impresión de Stocks</h4>
						</div>

						<div class="modal-body">
							<div class="form-group">
								<form class="form-horizontal" role="form" method="post" action="../funciones/imprimeStock.php">
									<div class="col-sm-3">
										<label for="editmarca" class="control-label">Seleccione el Departamento</label>
									</div>
									<div class="col-sm-9">
										<?php
											require('../include/connect.php');
											//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											//print_r($_SESSION);			//muestra las sesiones
											$sql="SELECT * FROM catdeptos WHERE estatus = '1'
											";
											$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
										?>
										<div class="form-group">
											<select name="departamento" class="form-control select2-list" data-placeholder="">
												<option value="0">Todos</option>
												<optgroup label="departamento">
													<?php
														while ($dat = mysqli_fetch_array($res)) {
															echo '<option value="'.$dat['id'].'"> '.$dat['nombre'].' </option>';
														}
													?>
												</optgroup>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
										<button type="submit" class="btn btn-primary">Imprimir</button>
									</div>
								</form>
							</div>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<!-- BEGIN MENUBAR-->
			<div id="menubar" class="menubar-inverse ">
				<div class="menubar-scroll-panel">
					<!-- BEGIN MAIN MENU -->
					<ul id="main-menu" class="gui-controls">
						<!-- MENU LATERAL -->
						<?=$info->generaMenuLateral();?>
					</ul><!--end .main-menu -->
					<!-- END MAIN MENU -->

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">Copyright &copy; 2019</span>
						</small>
					</div>
				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->

			<!-- BEGIN OFFCANVAS RIGHT -->
			<div class="offcanvas">

				<!-- BEGIN OFFCANVAS SEARCH -->
				<div id="offcanvas-search" class="offcanvas-pane width-8">
					<div class="offcanvas-head">
						<header class="text-primary">Telefonos de Contacto</header>
						<div class="offcanvas-tools">
							<a class="btn btn-icon-toggle btn-default-light pull-right" data-dismiss="offcanvas">
								<i class="md md-close"></i>
							</a>
						</div>
					</div>
					<div class="offcanvas-body no-padding">
						<ul class="list ">
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>A</strong></div>
								</div>
							</li>
						</ul>
					</div><!--end .offcanvas-body -->
				</div><!--end .offcanvas-pane -->
				<!-- END OFFCANVAS SEARCH -->


			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS RIGHT -->

		</div><!--end #base-->
		<!-- END BASE -->

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
		<script src="../assets/js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.es.js"></script>
		<script src="../assets/js/libs/d3/d3.min.js"></script>
		<script src="../assets/js/libs/d3/d3.v3.js"></script>
		<script src="../assets/js/libs/rickshaw/rickshaw.min.js"></script>
		<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../assets/js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="../assets/js/libs/jquery-validation/dist/additional-methods.min.js"></script>
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
		<script src="../assets/js/libs/toastr/toastr.js"></script>
		<script src="../assets/js/libs/fileInput/fileInput.js"></script>
		<script src="../assets/js/libs/fileInput/fileInput_locale_es.js"></script>
		<script src="../assets/scripts/cadenas.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
		<script>
	  $(document).ready(function(){
			$('.txtPopOver').popover('show');
			$("#productoAsigna").prop('disabled', true);
			$("#cantAsigna").prop('disabled', true);
			$("#regEntradaProd").prop('disabled', true);
			$("#regEntradaCant").prop('disabled', true);
			$("#btnAsignaProd").prop('disabled', true);

			$('.fechado').datepicker({
				todayHighlight: true,
				format: "yyyy-mm-dd",
				language: "es"
			});

			$("#foto").fileinput({
				showUpload: false,
				showCaption: false,
				language: 'es',
				allowedFileExtensions : ['jpg', 'jpeg'],
				maxFileSize: 5120,
				maxFilesNum: 1,
				browseClass: "btn btn-primary btn-lg",
				fileType: "any"
			});


			$('#listadoDeArticulos').DataTable({
				dom: 'Bfrtip',
				"iDisplayLength": 10,
				"language": {
					"lengthMenu": '_MENU_ entradas por página',
					"info": "Mostrando páginas _PAGE_ de _PAGES_",
					"sInfo": "Mostrando _START_ al _END_ de _TOTAL_ entradas",
					"sInfoEmpty": "Mostrando 0 al 0 de 0 entradas",
					"infoFiltered": " - filtrado de _MAX_ registros",
					"sInfoFiltered": "(filtrado de _MAX_ entradas totales.)",
					"zeroRecords": "No hay registros que mostrar.",
					"search": '<i class="fa fa-search"></i>',
					"paginate": {
						"previous": '<i class="fa fa-angle-left"></i> Atrás   ',
						"next": '   Siguiente <i class="fa fa-angle-right"></i>'
					}},
				buttons: [
					'copy', 'csv', 'excel', 'print',
					{
							extend: 'pdfHtml5',
							orientation: 'landscape',
							pageSize: 'LEGAL',
					}
				]
			    });

				$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary text-white mr-1');

			<?php
			if (isset( $_SESSION['ATZmsjAdminInventario'])) {
				echo "notificaBad('".$_SESSION['ATZmsjAdminInventario']."');";
				unset($_SESSION['ATZmsjAdminInventario']);
			}
			if (isset( $_SESSION['ATZmsjSuccessAdminInventario'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccessAdminInventario']."');";
				unset($_SESSION['ATZmsjSuccessAdminInventario']);
			}
			?>
	  });

		function limpiaTexto(txt){
			texto = getCadenaLimpia(txt);
			//alert(texto);
			$("#nombre").val(texto);
		}

		function tipoSerie(value){
			if (value == 1) {
				$("#preserie").prop('disabled', false);
				$("#preserie").prop('placeholder', 'Ingresa la Pre-Serie');
			} else {
				$("#preserie").prop('disabled', true);
				$("#preserie").prop('placeholder', 'Ya no se Ingresa...');
			}
		}

		function listaCatSubmarca(ident){
			$.post("../funciones/listaCatSubmarca.php",
				{ ident:ident},
					function(respuesta){
						$("#modelo").html(respuesta);
					});
		}

		function btnProceso(ident){
			$("#pBtn"+ident).html('<img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Trabajando..."/>');
			//alert('ID: '+ident);
			$.post("funciones/btnEstatusProceso.php",
				{ identif:ident },
					function(respuesta){
						$("#pBtn"+ident).html(respuesta);
						$("#pBtn"+ident).attr("data-original-title","Atendido: <?=$info->nombreUser;?>");
					});
		}


		function notificaBad(cont){
			toastr.warning(cont,'Lo Sentimos!',{
				closeButton: true,
				timeOut: 5000,
			});
		}

		function notificaSuc(cont){
			toastr.success(cont, 'Excelente!',{
				closeButton: true,
				timeOut: 7000,
				});
		}

		function visualizaImg(foto,nombre){
			$("#cuerpoModal").html('<img class="height-8" width="100%" height="100%" src="'+foto+'">');
			$("#simpleModalLabel").html(nombre);
		}
		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
