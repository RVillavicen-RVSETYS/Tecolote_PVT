<?php
require_once 'seg.php';
require 'include/connect.php';
$info = new Seguridad();
$info->Acceso('gastos.php');
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
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/fileInput/fileinput.css" />

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
							<div class="col-md-12">

								<!-- BEGIN ACTION -->
								<div class="card card-responsive">
									<div class="card-body  height-6">
										<!-- BEGIN DATATABLE 1 -->
										<div class="row">
			                 <div class="col-lg-12">
			                     <h1 class="page-header">Gastos</h1>
			                 </div>
			                 <!-- /.col-lg-12 -->
			             </div>
			             <!-- /.row -->
									 <div class="row">
 			                <div class="col-lg-12">
 			                    <div class="panel panel-default">
 			                        <div class="panel-heading style-primary card-bordered">
 			                            Registro de Gastos
 			                        </div>
 			                        <div class="panel-body">
 			                            <div class="row">
 			                            	<form role="form" action="funciones/altaGastoPago.php" method="post">
 			                                <div class="col-lg-12">
 																				<div class="col-lg-3">
 																						<label>ID del viaje</label>
 																						<div class="form-group input-group">
 																								<input id="viajeGasto" name="vGasto" type="number" class="form-control" placeholder="ID">
 																						</div>
 																				</div>
 																				<div class="col-lg-1"></div>
 																				<div class="col-lg-3">
 																						<label>Lugar donde se realizó el Pago</label>
 																						<div class="form-group input-group">
 																								<input id="puntoGasto" name="pGasto" type="text" class="form-control" placeholder="Nombre del local" required>
 																						</div>
 																				</div>
 																				<div class="col-lg-4"></div>
 			                                        <div class="col-lg-6">
 			                                            <div class="form-group">
 			                                    			<label class="control-label">Describe el Pago</label>
 			                                            	<input id="descripcionGasto" name="dGasto" type="text" class="form-control" placeholder="Describe el Pago">
 			                                        	</div>
 			                                        </div>
 			                                        <div class="col-lg-3">
 			                                            <label>Costo:</label>
 			                                            <div class="form-group input-group">
 			                                            	<span class="input-group-addon"><i class="fa fa-dollar"></i>
 			                                                </span>
 			                                                <input id="precioGasto" type="number" name="prGasto" class="form-control" placeholder="Costo">
 			                                            </div>
 			                                        </div>
 			                                       <div class="col-lg-3">
 																							<form class="form" role="form" method="post">
 																								<div class="card-body">
 			                                						<div class="form-group" align="center">
 			                                    					<br>
 				                                						<button id="regGasto" type="submit" class="btn btn-default style-primary card-bordered">Enviar</button>
 			    	                                				<button type="reset" class="btn btn-default style-primary card-bordered">Limpiar</button>

 			                                   					</div>
 																								</div>
 																							</form>
 			                                    	</div>
 			                                </div></form>
 			                                <!-- /.col-lg-8 (nested) -->
 			                                <!-- /.col-lg-4 (nested) -->

 			                            </div>
 			                            <!-- /.row (nested) -->
 			                        </div>
 			                        <!-- /.panel-body -->
 			                    </div>
 			                    <!-- /.panel -->
 			                </div>
 			                <!-- /.col-lg-12 -->
 			            </div><!--end .row -->
									 <div class="row">
			                <div class="col-lg-12">
			                    <h1 class="page-header">Pagos</h1>
			                </div>
			                <!-- /.col-lg-12 -->
			            </div>
			            <div class="row">
			                <div class="col-lg-12">
			                    <div class="panel panel-default">
			                        <div class="panel-heading style-primary card-bordered">
			                            Registro de Pagos
			                        </div>
			                        <div class="panel-body">
			                            <div class="row">
			                            	<form role="form" action="funciones/altaGastoPago.php" method="post">
			                                <div class="col-lg-12">
																				<div class="col-lg-3">
																						<label>ID del viaje</label>
																						<div class="form-group input-group">
																								<input id="viajePago" name="vPago" type="number" class="form-control" placeholder="ID">
																						</div>
																				</div>
																				<div class="col-lg-1"></div>
																				<div class="col-lg-3">
																						<label>Lugar donde se realizó el Pago</label>
																						<div class="form-group input-group">
																								<input id="puntoPago" name="pPago" type="text" class="form-control" placeholder="Nombre del local" required>
																						</div>
																				</div>
																				<div class="col-lg-4"></div>
			                                        <div class="col-lg-6">
			                                            <div class="form-group">
			                                    			<label class="control-label">Describe el Pago</label>
			                                            	<input id="descripcionPago" name="dPago" type="text" class="form-control" placeholder="Describe el Pago">
			                                        	</div>
			                                        </div>
			                                        <div class="col-lg-3">
			                                            <label>Costo:</label>
			                                            <div class="form-group input-group">
			                                            	<span class="input-group-addon"><i class="fa fa-dollar"></i>
			                                                </span>
			                                                <input id="precioPago" type="number" name="prPago" class="form-control" placeholder="Costo">
			                                            </div>
			                                        </div>
			                                       <div class="col-lg-3">
																							<form class="form" role="form" method="post">
																								<div class="card-body">
			                                						<div class="form-group" align="center">
			                                    					<br>
				                                						<button id="regPago" type="submit" class="btn btn-default style-primary card-bordered">Enviar</button>
			    	                                				<button type="reset" class="btn btn-default style-primary card-bordered">Limpiar</button>

			                                   					</div>
																								</div>
																							</form>
			                                    	</div>
			                                </div></form>
			                                <!-- /.col-lg-8 (nested) -->
			                                <!-- /.col-lg-4 (nested) -->

			                            </div>
			                            <!-- /.row (nested) -->
			                        </div>
			                        <!-- /.panel-body -->
			                    </div>
			                    <!-- /.panel -->
			                </div>
			                <!-- /.col-lg-12 -->
			            </div>
										<!-- END DATATABLE 1 -->
									</div><!--end .card-body -->
								</div><!--end .card -->
								<!-- END ACTION -->
							</div><!--end .col -->
						</div><!--end .row -->
					</div><!--end .section-body -->

				</section>
<!-- aquí va el otro <section>
	==============================================================
</section>

-->
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->

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


		</div>
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
		<script src="assets/js/core/source/App.js"></script>
		<script src="assets/js/core/source/AppNavigation.js"></script>
		<script src="assets/js/core/source/AppOffcanvas.js"></script>
		<script src="assets/js/core/source/AppCard.js"></script>
		<script src="assets/js/core/source/AppForm.js"></script>
		<script src="assets/js/core/source/AppNavSearch.js"></script>
		<script src="assets/js/core/source/AppVendor.js"></script>
		<script src="assets/js/libs/fileInput/fileinput.js"></script>
		<script src="assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="assets/js/libs/toastr/toastr.js"></script>
		<script>
		$( document ).ready(function() {
			<?php
			if (isset( $_SESSION['ATZmsjAuxiliarGastos'])) {
				echo "notificaBad('".$_SESSION['ATZmsjAuxiliarGastos']."');";
				unset($_SESSION['ATZmsjAuxiliarGastos']);
			}
			if (isset( $_SESSION['ATZmsjSuccesAuxiliarGastos'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesAuxiliarGastos']."');";
				unset($_SESSION['ATZmsjSuccesAuxiliarGastos']);
			}
			?>
		});

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
