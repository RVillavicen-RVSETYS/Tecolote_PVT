<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('adminProductos.php');
require '../include/connect.php';
require_once('../funciones/notificaAdmin.php');
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileinput.css" />

    <link rel="shortcut icon" href="../favicon.ico">
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed me">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="admin.php">
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
					notificaAdmin($link);
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
				<section>
					<div class="section-body">

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

						<!-- BEGIN ACTION -->
						<div class="card">
							<div class="card-head">
								<header><i class=""> Detalle de Productos</header>
								<div class="tools">
									<div class="btn-group" data-toggle="tooltip" data-placement="top" data-original-title="Crear nuevo Producto">
										<a class="btn btn-floating-action btn-primary" data-toggle="modal" data-target="#formNewProducto"><i class="fa fa-plus"></i></a>
									</div>
								</div>
							</div>

							<div class="card-body">
								<!-- BEGIN DATATABLE 1 -->
								<div class="row">
									<div class="col-lg-12">
										<div class="card-body">
										<?php
											require('../include/connect.php');
											$sql="SELECT pdto.*, pdto.nombre AS producto, dpto.nombre AS depto, cmk.nombre AS mark, csm.nombre AS submrk
														FROM productos pdto
														INNER JOIN catdeptos dpto ON pdto.idDepto = dpto.id
														INNER JOIN catmarcas cmk ON pdto.idCatMarca = cmk.id
														INNER JOIN catsubmarcas csm ON pdto.idCatSubMarca = csm.id
														ORDER BY pdto.nombre ASC";
											//echo $sql.'<br>';
											$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
										?>
										<div class="table-responsive">
											<table id="datatable1" class="table table-striped table-hover">
												<thead>
													<tr>
														<th>ID</th>
														<th>Imagen</th>
														<th>Departamento</th>
														<th>nombre</th>
														<th>Marca</th>
														<th>Modelo</th>
														<th>Folio Auto</th>
														<th>Serie</th>
														<th>Minimo</th>
														<th>Maximo</th>
														<th>Estatus</th>
														<th>Editar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													while ($dat = mysqli_fetch_array($res)) {
														$estatus = ($dat['estatus'] == 1) ? '<center class="text-success"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Activo"><i class="md md-done"></i></center>' : '<center class="text-danger"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Desactivado"><i class="md md-close"></i></center>' ;
														$estatusText = ($dat['estatus'] == 1) ? '' : 'class="text-danger"' ;
														$serie = ($dat['serieAuto'] == 1) ? 'Automatica' : 'Manual' ;
														$foto = ($dat['foto'] == '') ? '../assets/img/noimg.png' : '../'.$dat['foto'] ;
														$fecha = $dat['dateReg'];
														echo '
														<tr '.$estatusText.'>
															<td>'.$dat['id'].'</td>
															<td><img class="img-circle width-1" src="'.$foto.'" alt="" onclick="verFoto('.$dat['id'].')" data-toggle="modal" data-target="#verFoto"/></td>
															<td>'.$dat['depto'].'</td>
															<td>'.$dat['producto'].'</td>
															<td>'.$dat['mark'].'</td>
															<td>'.$dat['submrk'].'</td>
															<td>'.$serie.'</td>
															<td>'.$dat['preSerie'].'</td>
															<td>'.$dat['min'].'</td>
															<td>'.$dat['max'].'</td>
															<td>'.$estatus.'</td>
															<td class="text-center" data-toggle="tooltip" data-placement="top" data-original-title="Editar registro">
																<button type="button" class="btn btn-icon-toggle" onclick="editaProd('.$dat['id'].')" data-toggle="modal" data-target="#formEditProducto"><i class="fa fa-pencil"></i></button>
															</td>
														</tr>';
													}
													?>
												</tbody>
											</table>
										</div><!--end .table-responsive -->
									</div><!--end .col -->
								</div><!--end .row -->
								<!-- END DATATABLE 1 -->
							</div><!--end .card-body -->
						</div><!--end .card -->
						<!-- END ACTION -->
				</section><!--end .section-body -->
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

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formEditProducto" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaProdContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formEditaProdLabel">Modificar Producto: <span id="nameProdEdit"></span></h4>
						</div>
						<div class="modal-body">
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="verFoto" tabindex="-1" role="dialog" aria-labelledby="verFotoLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="verFotoContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="verFotoTitle"> Ver Foto</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- END FORM MODAL MARKUP -->

			<!-- BEGIN MENUBAR-->
			<div id="menubar" class="menubar-inverse ">

				<div class="menubar-scroll-panel">

					<!-- BEGIN MAIN MENU -->
					<ul id="main-menu" class="gui-controls">

						<!-- MENU LATERAL -->
						<?=$info->generaMenuLateral();?>

					</ul><!--end .main-menu -->
					<!-- END MAIN MENU -->

				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->


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
		<script src="../assets/js/core/source/App.js"></script>
		<script src="../assets/js/core/source/AppNavigation.js"></script>
		<script src="../assets/js/core/source/AppOffcanvas.js"></script>
		<script src="../assets/js/core/source/AppCard.js"></script>
		<script src="../assets/js/core/source/AppForm.js"></script>
		<script src="../assets/js/core/source/AppNavSearch.js"></script>
		<script src="../assets/js/core/source/AppVendor.js"></script>
		<script src="../assets/js/core/demo/Demo.js"></script>
		<script src="../assets/js/core/demo/DemoTableDynamic.js"></script>
		<script src="../assets/js/libs/toastr/toastr.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="../assets/scripts/cadenas.js"></script>
		<script>
	  $(document).ready(function(){
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


			<?php
			if (isset( $_SESSION['ATZmsjAdminAltaProductos'])) {
				echo "notificaBad('".$_SESSION['ATZmsjAdminAltaProductos']."');";
				unset($_SESSION['ATZmsjAdminAltaProductos']);
			}
			if (isset( $_SESSION['ATZmsjSuccesAdminAltaProductos'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesAdminAltaProductos']."');";
				unset($_SESSION['ATZmsjSuccesAdminAltaProductos']);
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

		function tipoSerie1(value){
			if (value == 1) {
				$("#editpreserie").prop('disabled', false);
				$("#editpreserie").prop('placeholder', 'Ingresa la Pre-Serie');
			} else {
				$("#editpreserie").prop('disabled', true);
				$("#editpreserie").val('');
				$("#editpreserie").prop('placeholder', 'Ya no se Ingresa...');
			}
		}

		function listaCatSubmarca(ident){
			$.post("../funciones/listaCatSubMarca.php",
				{ ident:ident},
					function(respuesta){
						$("#modelo").html(respuesta);
					});
		}

		function listaCatSubmarca1(ident){
			$.post("../funciones/listaCatSubMarca.php",
				{ ident:ident},
					function(respuesta){
						$("#editmodelo").html(respuesta);
					});
		}

		function editaProd(ident){
			$.post("../funciones/formEditaProductos.php",
				{ ident:ident },
					function(respuesta){
						$("#editaProdContent").html(respuesta);
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

		function verFoto(ident){
			$.post("../funciones/verFoto-Productos.php",
				{ ident:ident},
					function(respuesta){
						$("#verFotoContent").html(respuesta);
					});
		}
		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
