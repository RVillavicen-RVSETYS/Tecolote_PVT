<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('precioMaterialRuta.php');
require '../include/connect.php';
require_once('../funciones/notificaAdmin.php');

Error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<title><?= $info->nombrePag; ?></title>

	<!-- BEGIN META -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="">
	<meta name="description" content="">
	<!-- END META -->

	<!-- BEGIN STYLESHEETS -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css' />
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

	<link rel="shortcut icon" href="../favicon.ico">
	<!-- END STYLESHEETS -->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
</head>

<body class="menubar-hoverable header-fixed me">

	<!-- BEGIN HEADER-->
	<header id="header">
		<div class="headerbar">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="headerbar-left">
				<ul class="header-nav header-nav-options">
					<li class="header-nav-brand">
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
								<?= $info->nombreUser; ?>
								<small><?= $info->nombreNivel; ?></small>
							</span>
						</a>
						<ul class="dropdown-menu animation-dock">
							<!--<li><a href="html/pages/calendar.html"><i class="fa fa-fw fa-globe"></i> Calendario</a></li>
								<li class="divider"></li>-->
							<?= $info->generaMenuUsuario(); ?>
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
							<h1 class="text-primary"><?= $info->nombrePag; ?></h1>
						</div><!--end .col -->
						<div class="col-lg-8">
							<article class="margin-bottom-xxl">
								<p class="lead"><?= $info->detailPag; ?></p>
							</article>
						</div><!--end .col -->
					</div><!--end .row -->
					<!-- END INTRO -->

					<div class="row">
						<div class="col-md-12">
							<div class="card style-primary card-bordered">
								<div class="card-head">
									<div class="tools">
										<div class="btn-group">
											<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
										</div>
									</div>
									<header><i class="fa fa-fw md-store"></i> Asignación de Precios de Material por Ruta y Cliente</header>
								</div><!--end .card-head -->
								<div class="card-body style-default-bright table-responsive">
									<form class="form-horizontal" role="form" method="post" action="../funciones/registrarMaterialesPorRutas.php">
										<div class="card-body">
											<div class="form-group">
												<div class="col-sm-2">
													<label for="ruta" class="text-left">Selecciona el Material</label>
												</div>
												<div class="col-md-3">
													<?php
													$sql = "SELECT *
																		FROM catmateriales cmat
																		WHERE cmat.estatus = 1
																		ORDER BY cmat.nombre ASC
																";
													//echo $sql;
													$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador</p>');
													?>
													<select name="material" id="material" class="form-control" required>
														<option value=""></option>
														<?php
														while ($dat = mysqli_fetch_array($res)) {
															echo '<option value="' . $dat['id'] . '">' . $dat['nombre'] . '</option>';
														}
														?>
													</select>
												</div>
												<div class="col-sm-1"></div>
												<div class="col-sm-1">
													<label>Precio por Tonelada</label>
												</div>
												<div class="col-sm-3">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-dollar"></i>
														</span>
														<input id="precio" type="text" name="precio" class="form-control" placeholder="precio">
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-2">
													<label for="ruta" class="text-left">Selecciona la Ruta</label>
												</div>
												<div class="col-md-8">
													<?php
													require('../include/connect.php');
													$sql = "SELECT *
																	FROM rutas ru
																	WHERE ru.estatus = 1
																	ORDER BY ru.tipoViaje ASC
															";
													//echo $sql;
													$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador</p>');
													?>
													<select name="ruta" id="ruta" class="form-control" required>
														<option value=""></option>
														<?php
														while ($dat = mysqli_fetch_array($res)) {
															echo '<option value="' . $dat['id'] . '">RUTA: ' . $dat['tipoViaje'] . ' --' . $dat['destino1'] . ' - ' . $dat['destino2'] . ' ' . $dat['destino3'] . '</option>';
														}
														?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<!--div class="col-md-12 text-center">
													<h4>Selecciona el Cliente</h4>
												</div><! end .col -->
												<div class="col-md-2">Selecciona el Cliente</div>
												<?php
												$sql2 = "SELECT *
																		from clientes
																		ORDER BY nombre ASC";
												$res2 = mysqli_query($link, $sql2) or die('<p class="text-danger">Notifica a tu Administrador</p>');
												?>

												<div class="col-md-8">
													<select name="cliente" id="cliente" class="form-control" required>
														<option value=""></option>
														<?php
														while ($dat2 = mysqli_fetch_array($res2)) {

															echo '<option value = "' . $dat2['id'] . '">' . $dat2['nombre'] . '</option>';
														}
														?>
														<div name="cliente"></div>
													</select>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group" align="center">
													<br>
													<button id="cargar" type="submit" class="btn btn-default style-primary card-bordered">Asignar</button>
												</div>
											</div>

										</div><!--end .row -->
									</form>
								</div><!--end .card-body -->
							</div><!--end .card -->
						</div><!--end .col -->
						<div class="col-md-12">
							<div class="card card-bordered style-primary">
								<div class="card-head">
									<div class="tools">
										<div class="btn-group">
											<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
										</div>
									</div>
									<header id="tituloContactos"><i class="fa fa-fw fa-users"></i> Precio de Materiales por Ruta </header>
								</div><!--end .card-head -->
								<div class="card-body style-default-bright">
									<?php
									#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
									require('../include/connect.php');
									/*$filtrofecha='';

															if ($ruta != '') {
															$filtroRuta ="AND ru.id = $ruta";
														}*/
									$sql = "SELECT cli.nombre AS nomCliente, ru.destino1 AS d1, ru.destino2 AS d2, ru.destino3 AS d3,
																	cmat.nombre AS nomMaterial, pmat.precio AS precioMaterial, pmat.id AS id
																	FROM preciomateriales pmat
																	INNER JOIN catmateriales cmat ON cmat.id = pmat.idCatMaterial
																	INNER JOIN rutas ru ON ru.id = pmat.idRuta
																	INNER JOIN clientes cli ON cli.id = pmat.idCliente
																	ORDER BY cli.nombre ASC";
									$res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>');
									?>
									<div id="rutaCasetaBody" class="table-responsive">
										<table class="table table-striped table-hover" id="datatable1">
											<thead>
												<tr>
													<th class="col-sm-1 text-center">#</th>
													<th class="col-sm-2 text-center">Material</th>
													<th class="text-center">Precio</th>
													<th class="col-sm-3 text-center">Cliente</th>
													<th class="col-sm-4 text-center">Ruta</th>
													<th class="text-center">Funciones</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$cont = 1;
												while ($dat = mysqli_fetch_array($res)) {
													if ($dat['d3'] != '') {
														$ruta = $dat['d1'] . '-' . $dat['d2'] . '-' . $dat['d3'];
													} else {
														$ruta = $dat['d1'] . '-' . $dat['d2'];
													}

													echo '
																	<tr>
																		<td class="col-sm-1 text-center"> ' . $dat['id'] . ' </td>
																		<td class="col-sm-2 text-center"> ' . $dat['nomMaterial'] . ' </td>
																		<td class="col-sm-1 text-center"> ' . $dat['precioMaterial'] . ' </td>
																		<td class="col-sm-3 text-center"> ' . $dat['nomCliente'] . '</td>
																		<td id="ruta' . $dat['id'] . '"  class="col-sm-4 text-center">' . $ruta . '</td>
																		<td class="text-center">
																				<button type="button" class="btn btn-icon-toggle" onclick="formEditFila(' . $dat['id'] . ')" data-toggle="modal" data-target="#formEditFila"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
																		</td>
																 </tr>
																 ';
													$cont++;
												}
												?>
											</tbody>
										</table>
									</div>

									<div class="row">

									</div>
								</div><!--end .card-body -->
							</div><!--end .card -->
						</div><!--end .col -->
					</div><!--end .row -->
				</div><!--end .section-body -->
			</section>
		</div><!--end #content-->
		<!-- END CONTENT -->

		<!-- BEGIN FORM MODAL MARKUP -->
		<div class="modal fade" id="formEditFila" tabindex="-1" role="dialog" aria-labelledby="formEditFilaLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" id='editaFilaContent'>

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
					<?= $info->generaMenuLateral(); ?>

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
	<script src="../assets/scripts/cadenas.js"></script>
	<script>
		$(document).ready(function() {
			$("#idUserasigna").prop('disabled', true);
			$("#botonUserAsigna").prop('disabled', true);


			<?php
			if (isset($_SESSION['ATZmsjAdminPrecioMaterialRuta'])) {
				echo "notificaBad('" . $_SESSION['ATZmsjAdminPrecioMaterialRuta'] . "');";
				unset($_SESSION['ATZmsjAdminPrecioMaterialRuta']);
			}
			if (isset($_SESSION['ATZmsjSuccesAdminPrecioMaterialRuta'])) {
				echo "notificaSuc('" . $_SESSION['ATZmsjSuccesAdminPrecioMaterialRuta'] . "');";
				unset($_SESSION['ATZmsjSuccesAdminPrecioMaterialRuta']);
			}
			?>
		});


		function notificaBad(cont) {
			toastr.warning(cont, 'Lo Sentimos!', {
				closeButton: true,
				timeOut: 5000,
			});
		}

		function notificaSuc(cont) {
			toastr.success(cont, 'Excelente!', {
				closeButton: true,
				timeOut: 7000,
			});
		}


		function formEditFila(ident) {
			$("#editaFilaBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
			//alert('ID: '+ident);
			$.post("../funciones/formPrecioMaterial.php", {
					ident: ident
				},
				function(respuesta) {
					$("#editaFilaContent").html(respuesta);
				});
		}
	</script>
	<!-- END JAVASCRIPT -->

</body>

</html>