<?php
require_once 'seg.php';
require 'include/connect.php';
$info = new Seguridad();
$info->Acceso('ventas.php');
require_once('funciones/notificaAuxiliar.php');

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
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/material-design-iconic-font.min.css?1421434286" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/select2/select2.css?1424887856" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/multi-select/multi-select.css?1424887857" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/bootstrap-datepicker/datepicker3.css?1424887858" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/jquery-ui/jquery-ui-theme.css?1423393666" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/typeahead/typeahead.css?1424887863" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/summernote/summernote.css?1425218701" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/toastr/toastr.css" />

    <link rel="shortcut icon" href="favicon.ico">
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
								<a href="home.php">
									<img src="assets/img/texto100.png">
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
					notificaciones($link);
					?>
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<img src="assets/img/avatar1.jpg?1403934956" alt="" />
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
							<div class="col-lg-12">

								<!-- BEGIN ACTION -->
										<div class="card card-bordered style-primary">
											<div class="card-head">
												<div class="tools">
													<div class="btn-group">
														<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
													</div>
												</div>
												<header><i class="fa fa-fw fa-money "></i> Punto de Venta</header>
											</div>
											<!--end .card-head -->
											<div class="card-body style-default-bright">
												<form id="registraNuevaVenta" class="form" role="form" method="post" action="funciones/registraNuevaVenta.php">
													<div class="col-lg-3"><h4>Datos del Cliente </h4></div>
													<div class="form-group floating-label col-lg-8 align-center">
														<?php
														require('include/connect.php');
														$sql = "SELECT *
																	from clientes
																	ORDER BY nombre ASC";
														$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
														?>
														<select id="idCliente" name="idCliente" class="form-control" required>
															<?php
															echo '<option value=""></option>';
															while ($dat2 = mysqli_fetch_array($res)) {

																	echo '<option value = "'.$dat2['id'].'">'.$dat2['nombre'].'</option>';
																}

															?>
														</select>
														<label for="regular2">Ingresa el Nombre del Cliente</label>
													</div>
													<div class="col-lg-3"><h4>Datos de la carga</h4></div>
													<div class="form-group floating-label col-lg-8 align-center">
														<?php
														require('include/connect.php');
														$sql = "SELECT * FROM catmateriales WHERE estatus = '1' ORDER BY nombre ASC";
														$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
														?>
														<select id="idMaterial" name="idMaterial" class="form-control" required>
															<?php
															echo '<option value=""></option>';
															while ($dat = mysqli_fetch_array($res)) {
																echo '<option value="'.$dat['id'].'" > '.$dat['nombre'].'</option>';
															}
															?>
														</select>
														<label for="regular2">Selecciona el Material</label>
													</div>
													<div class="col-lg-1"></div>

													<div class="row">
													<div class="col-lg-3"><h4>&nbsp;&nbsp;&nbsp;Fecha de Carga del Material</h4></div>
													<div class="col-lg-3">
														<div class="form-group control-width-normal">
															<div class="input-group date" id="demo-date-format">
																<div class="input-group-content">
																	<input type="text" name="fechaCarga" id="fechaCarga" class="form-control">
																	<label>Fecha de Carga del Material</label>
																	<p class="help-block">yyyy/mm/dd</p>
																</div>
																<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
															</div>
														</div><!--end .form-group -->
													</div>


												</div>	<!-- Cierre del row		-->

													<div class="col-lg-3"><h4>Datos del destino	</h4></div>
													<div class="form-group col-sm-8">

														<div class="col-sm-12">
															<label class="col-sm-3 control-label"><h4 class="text-light">Selecciona el Tipo de Viaje</h4></label>
															<label class="radio-inline radio-styled col-sm-3">
																<input type="radio" name="tipoViaje" value="Sencillo" onclick="muestraSencillo()"><span>Viaje Sencillo</span>
															</label>
															<label class="radio-inline radio-styled col-sm-3">
																<input type="radio" name="tipoViaje" value="Redondo" onclick="muestraRedondo()"><span>Viaje Redondo</span>
															</label>
														</div><!--end .col -->

														<div class="row" id="viajeSenc">
															<div class="form-group floating-label col-sm-6 align-center">
																<?php
																$sql = "SELECT *
																				FROM rutas
																				WHERE tipoViaje ='Sencillo' AND estatus = '1'
																				GROUP BY destino1 ASC";
																$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador '.mysqli_error($link).'</p>');

																?>
																<select id="dest1" name="dest1" onchange="buscaDest2(this.value);" class="form-control text-center">
																	<option value="">&nbsp;</option>
																	<?php
																	while ($dat = mysqli_fetch_array($res)) {
																		echo '<option value="'.$dat['destino1'].'">'.$dat['destino1'].'</option>';
																	}
																	?>
																</select>
																<label for="Estatus">Seleccione el Destino1</label>
															</div>
															<div class="form-group floating-label col-sm-6 align-center">
																<select id="dest2" name="idRuta2" onchange="buscaDest1(this.value);" class="form-control text-center">
																	<option value="">&nbsp;</option>
																</select>
																<label for="Estatus">Seleccione el Destino2</label>
															</div>

														</div>

														<div class="row" id="viajeRed">
															<div class="form-group floating-label col-sm-4 align-center">
																<?php
																require('include/connect.php');
																$sql = "SELECT *
																				FROM rutas
																				WHERE tipoViaje ='Redondo' AND estatus = '1'
																				GROUP BY destino1 ASC";
																$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador '.mysqli_error($link).'</p>');

																?>
																<select id="dest11" name="dest11" onchange="buscaDest22(this.value);" class="form-control text-center" >
																	<option value="">&nbsp;</option>
																	<?php
																	while ($dat = mysqli_fetch_array($res)) {
																		echo '<option value="'.$dat['destino1'].'">'.$dat['destino1'].'</option>';

																	}
																	?>
																</select>
																<label for="Estatus">Seleccione Destino 1</label>
															</div>

															<div class="form-group floating-label col-sm-4 align-center">
																<select id="dest22" name="dest22" onchange="buscaDest33(this.value);" class="form-control text-center">
																	<option value="">&nbsp;</option>
																</select>
																<label for="dest22">Seleccione Destino 2</label>
															</div>

															<div class="form-group floating-label col-sm-4 align-center">
																<select id="dest33" name="idRuta" onchange="buscaDest332(this.value);" class="form-control text-center" >
																	<option value="">&nbsp;</option>
																</select>
																<label for="dest33">Seleccione Destino 3</label>
															</div>

															<div class="row">
																<?php
																require('include/connect.php');
																$sql = "SELECT *
																				FROM rutas
																				WHERE destino1 ='$e1' AND  destino2 ='$e2' AND  destino3 ='$e3' AND estatus = '1'
																				GROUP BY destino1 ASC";
																$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador '.mysqli_error($link).'</p>');

																?>

																<div class="col-sm-1"> Distancias:</div>
																<div class="form-group floating-label col-sm-3 align-center" id="d1">
																</div>
																<div class="form-group floating-label col-sm-4 align-center" id="d2">
																</div>
																<div class="form-group floating-label col-sm-4 align-center" id="d3">
																</div>
															</div>

														</div>

													</div><!--end .form-group -->

													<div class="row">
														<div class="col-lg-3"><h4>&nbsp;&nbsp;&nbsp;Datos del vehículo</h4></div>
														<div class="form-group floating-label col-lg-8 align-center">
															<?php
															require('include/connect.php');
															$sql = "SELECT asv.*, op.nombre AS nomOpe, op.apellidos AS apeOpe, ve.noEconomico AS noEco,asv.id AS asignaVehiculo, ve.placas AS placas
															FROM asignavehiculos asv
															INNER JOIN operadores op ON op.id = asv.idOperador
															INNER JOIN vehiculos ve ON ve.id = asv.idVehiculo
															WHERE asv.estatus = '1' AND op.estatus = '1'
															ORDER BY asv.idVehiculo ASC";
															$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
															?>
															<select id="idVehiculo" name="idVehiculo" class="form-control" required>
																<?php
																echo '<option value=""></option>';
																while ($dat = mysqli_fetch_array($res)) {
																	echo '<option value="'.$dat['asignaVehiculo'].'">Placas - '.$dat['placas'].' (ECO - '.$dat['noEco'].' '.$dat['nomOpe'].' '.$dat['apeOpe'].')</option>';
																}
																?>
															</select>
															<label for="regular2">Selecciona el Vehículo</label>
														</div>
													</div>

													<div class="row">
														<div class="col-lg-3"><h4>&nbsp;&nbsp;&nbsp;Categoría</h4></div>
														<div class="form-group floating-label col-lg-4 align-center">
															<select id="tipoVehiculo" name="tipoVehiculo" class="form-control" required>
																<option value=" "></option>
																<option value="costo">Auto/Pickup</option>
																<option value="costo2">Volteo</option>
																<option value="costo3">Sencillo</option>
																<option value="costo4">Full</option>
															</select>
															<label for="regular2">Selecciona su Categoría</label>
														</div>

														<input type="hidden" name="idRutaFin" id="idRutaFin">

													</div>
													<div class="col-lg-2"></div>

												<div class="col-lg-12 text-center">
													<br>
													<button onclick="resetFormulario()" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
													<button type="submit" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Cargando...">Agregar</button>
												</div>
											</form>
											</div><!--end .card-body -->
										</div><!--end .card -->


								<!-- END ACTION -->

							</div><!--end .col -->


						</div><!--end .row -->


					</div><!--end .section-body -->

				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->


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
		<script src="assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="assets/js/libs/jquery-ui/jquery-ui.min.js"></script>
		<script src="assets/js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="assets/js/libs/spin.js/spin.min.js"></script>
		<script src="assets/js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="assets/js/libs/select2/select2.min.js"></script>
		<script src="assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
		<script src="assets/js/libs/summernote/summernote.min.js"></script>
		<script src="assets/js/libs/multi-select/jquery.multi-select.js"></script>
		<script src="assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
		<script src="assets/js/libs/moment/moment.min.js"></script>
		<script src="assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="assets/js/libs/d3/d3.min.js"></script>
		<script src="assets/js/libs/d3/d3.v3.js"></script>
		<script src="assets/js/libs/rickshaw/rickshaw.min.js"></script>
		<script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="assets/js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="assets/js/libs/jquery-validation/dist/additional-methods.min.js"></script>
		<script src="assets/js/libs/toastr/toastr.js"></script>
		<script src="assets/js/core/source/App.js"></script>
		<script src="assets/js/core/source/AppNavigation.js"></script>
		<script src="assets/js/core/source/AppOffcanvas.js"></script>
		<script src="assets/js/core/source/AppCard.js"></script>
		<script src="assets/js/core/source/AppForm.js"></script>
		<script src="assets/js/core/source/AppNavSearch.js"></script>
		<script src="assets/js/core/source/AppVendor.js"></script>
		<script src="assets/js/core/demo/Demo.js"></script>
		<script>
		$(document).ready(function(){
			$('#viajeSenc').hide();
			$('#viajeRed').hide();

			<?php
			if (isset( $_SESSION['ATZmsjVentas'])) {
				echo "notificaBad('".$_SESSION['ATZmsjVentas']."');";
				unset($_SESSION['ATZmsjVentas']);
			}
			if (isset( $_SESSION['ATZmsjSuccesVentas'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesVentas']."');";
				unset($_SESSION['ATZmsjSuccesVentas']);
			}
			?>

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

			$('#demo-date-format').datepicker({
				autoclose: true,
				todayHighlight: true,
				format: "yyyy/mm/dd"
			});

			$('#demo-date-format2').datepicker({
				autoclose: true,
				todayHighlight: true,
				format: "yyyy/mm/dd"
			});

			$('.fechado').datepicker({
				todayHighlight: true,
				format: "yyyy-mm-dd",
				language: "es"
			});

		});
		
		function resetFormulario() {
            document.getElementById("registraNuevaVenta").reset();
        }

		function buscaDest2(ident){
			$.post("funciones/listaDestino2Senc.php",
      	{ ident:ident, tipo:'Sencillo' },
    			function(respuesta){
      			$("#dest2").html(respuesta);
   				});
					$.post("funciones/listaDestino2Senc-2.php",
		      	{ ident:ident, tipo:'Sencillo' },
		    			function(respuesta){
		      			$("#dd1").html(respuesta);
		   				});
		}


		function buscaDest1(ident){
			$('#idRutaFin').val(ident);
			var dest1 = $("#dest1").val();
			$.post("funciones/listaDestino2Senc-3.php",
      	{ dest1:dest1, ident:ident, tipo:'Sencillo' },
    			function(respuesta){
      			$("#dd2").html(respuesta);
   				});
	}

		function buscaDest22(ident){
			$.post("funciones/listaDestino2Red.php",
      	{ ident:ident, tipo:'Redondo' },
    			function(respuesta){
      			$("#dest22").html(respuesta);
   				});

					$.post("funciones/listaDestino2Red-2.php",
		      	{ ident:ident, tipo:'Redondo' },
		    			function(respuesta){
		      			$("#d1").html(respuesta);
		   				});
		}

		function buscaDest33(ident){
			var dest1 = $("#dest11").val();
			$.post("funciones/listaDestino3.php",
      	{ dest1:dest1, ident:ident, tipo:'Redondo' },
    			function(respuesta){
      			$("#dest33").html(respuesta);
   				});
					$.post("funciones/listaDestino3-2.php",
		      	{ dest1:dest1, ident:ident, tipo:'Redondo' },
		    			function(respuesta){
		      			$("#d2").html(respuesta);
		   				});
		}

		function buscaDest332(ident){
			$('#idRutaFin').val(ident);
			var dest1 = $("#dest11").val();
			var dest2 = $("#dest22").val();
			$.post("funciones/listaDestino32.php",
				{ dest1:dest1, dest2:dest2, ident:ident, tipo:'Redondo' },
					function(respuesta){
						$("#d3").html(respuesta);
					});
		}

		function muestraSencillo(){
			$('#viajeSenc').show();
			$('#viajeRed').hide();
		}

		function muestraRedondo(){
			$('#viajeSenc').hide();
			$('#viajeRed').show();
		}


		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
