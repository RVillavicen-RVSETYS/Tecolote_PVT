<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('catTipoMttos.php');
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

						<div class="row">
							<div class="col-md-6">
								<div class="card style-primary card-bordered">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>
										</div>
										<header><i class="fa fa-fw fa-wrench"></i> Tipos de Mantenimientos</header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright">
										<?php
											//print_r($_SESSION);
											require('../include/connect.php');
											$sql="SELECT * FROM cattipomttos ORDER BY id ASC";
											$res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
										?>
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Nombre </th>
													<th class="col-lg-1 text-center">Estado</th>
													<th class="col-lg-2 text-center">Funciones</th>
												</tr>
											</thead>
											<tbody>
													<?php
													while ($dat = mysqli_fetch_array($res)) {
														$estatus = ($dat['estatus'] == '1') ? '<i class="fa fa-check">' : '<i class="fa fa-close">';
														$estatusText = ($dat['estatus'] == '1') ? '' : 'class="text-danger"';
														$estatusColor = ($dat['estatus'] == '1') ? 'text-success' : '';
														$fecha = $dat['fecha'];
														echo '
														<tr '.$estatusText.'>
															<td id="mttoName'.$dat['id'].'">'.$dat['nombre'].'</td>
															<td class="col-lg-1 text-center '.$estatusColor.'" id="mttoEstatus'.$dat['id'].'">'.$estatus.'</td>
															<td class="text-right">
																<button type="button" class="btn btn-icon-toggle" onclick="editaMtto('.$dat['id'].')" data-toggle="modal" data-target="#formEditMtto"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
																<button type="button" class="btn btn-icon-toggle" onclick="listarServiciosMtto('.$dat['id'].')" data-toggle="tooltip" data-placement="top" data-original-title="Ver Servicios Registradas"><i class="fa fa-plus"></i></button>
															</td>
														</tr>';
													}
													?>
												<tr>
													<form class="form" role="form" action="../funciones/registraNuevoCatTipoMtto.php" method="post">
														<td colspan="2" class="form">
															<div class="form-group floating-label">
																<input type="text" class="form-control" id="newMtto" name="nombreMtto" required>
																<label for="regular2">Ingresa Nombre de la SubMtto.</label>
															</div>
														</td>
														<td colspan="3" class="text-center">
															<button type="submit" class="btn btn-flat btn-default-success ink-reaction btn-loading-state" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> CARGANDO...">
																<icon class="fa fa-paper-plane-o"></icon> Nuevo Mtto.
															</button>
														</td>
													</form>
												</tr>
											</tbody>
										</table>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<div class="col-md-6">
								<div class="card card-bordered style-primary">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>
										</div>
										<header id="tituloServicios"><i class="fa fa-fw fa-edit"></i> Servicios que forman el: </header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright">
										<div id="ServiciosMttoBody">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Nombre</th>
														<th class="text-right">Quitar</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td colspan="3">Selecciona un Mantenimiento.</td>
													</tr>
												</tbody>
											</table>
											<input type="hidden" name="identMtto" id="identMtto" value="0">
										</div>

										<div class="row">
											<form id="formNewServicio">
											<div class="col-lg-8 form">
												<div class="form-group floating-label">
													<input type="text" class="form-control" id="newServicios" name="newServicios" required>
													<label for="regular2">Ingresa Nombre de la Servicios.</label>
												</div>
											</div>
											<div class="col-lg-4 text-center">
												<button type="button" id="botonUserAsigna" onclick="asignaServiciosAMtto();" disabled class="btn btn-flat btn-default-success ink-reaction btn-loading-state" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> CARGANDO...">
													<icon class="fa fa-paper-plane-o"></icon> Nuevo Servicio.
												</button>
											</div>
											</form>
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
			<div class="modal fade" id="formEditMtto" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="m1ttoContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formModalLabel">Modificar Mantenimiento</h4>
						</div>
						<div class="modal-body">
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
		<script>
		$(document).ready(function() {
			$("#idUserasigna").prop('disabled', true);
			$("#botonUserAsigna").prop('disabled', true);

			<?php
			if (isset( $_SESSION['ATZmsjAdminMtto'])) {
				echo "notificaBad('".$_SESSION['ATZmsjAdminMtto']."');";
				unset($_SESSION['ATZmsjAdminMtto']);
			}
			if (isset( $_SESSION['ATZmsjSuccesAdminMtto'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesAdminMtto']."');";
				unset($_SESSION['ATZmsjSuccesAdminMtto']);
			}
			?>
		});

		function asignaServiciosAMtto(){
			idMtto = $("#identMtto").val();
			nameServicios = $("#newServicios").val();
				//alert(nameServicios);
			$.post("../funciones/registraNuevoServicioMtto.php",
      	{ idMtto:idMtto, nombreServicios:nameServicios},
    			function(respuesta){
						var res=respuesta.split('|');
						if (res[0] == '0') {
							alert(res);
							notificaBad(res[2]);
						} else {
							notificaSuc('Se a Cargado Correctamente.');
							listarServiciosMtto(res[1]);
							$("#formNewServicio")[0].reset();
						}
   				});
		}

		function listarServiciosMtto(ident){
			name = $("#mttoName"+ident).html();
			$("#tituloServicios").html('<i class="fa fa-fw fa-edit"></i> Servicios de: <b>'+name+'</b>');
			$.post("../funciones/listarServiciosMtto.php",
      	{ ident:ident },
    			function(respuesta){
      			$("#ServiciosMttoBody").html(respuesta);
						$("#idUserasigna").prop('disabled', false);
						$("#botonUserAsigna").prop('disabled', false);
   				});
		}

		function editaMtto(ident){
			$.post("../funciones/formEditaCatTipoMttos.php",
				{ ident:ident },
					function(respuesta){
						$("#m1ttoContent").html(respuesta);
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
		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
