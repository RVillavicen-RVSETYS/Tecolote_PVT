	<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('conGastos.php');
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
								<a href="encargado.php">
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
							<div class="col-lg-5">
								<article class="margin-bottom-xxl">
									<p class="lead"><?=$info->detailPag;?></p>
								</article>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->
						<div class="row">
							<div class="col-md-12">
								<div class="card card-underline">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>
										</div>
										<header class="text-primary"> Busqueda por: <header>
									</div><!--end .card-head -->
									<div class="card-body">
										<?php
										$fecha1 = (isset($_POST['fStart']) AND $_POST['fStart'] != '') ? $_POST['fStart'] : '' ;
										$fecha2 = (isset($_POST['fEnd']) AND $_POST['fEnd'] != '') ? $_POST['fEnd'] : '' ;
										$ruta = (isset($_POST['ruta']) AND $_POST['ruta'] != '') ? $_POST['ruta'] : '' ;
										$tipo = (isset($_POST['tipo']) AND $_POST['tipo'] != '') ? $_POST['tipo'] : '' ;

										#print_r($_POST);
										?>

										<div class="rows">
										<form class="form" method="post" action="conGastos.php">
											<div class="col-lg-3">
												<div class="form-group">
													<div class="input-daterange input-group" id="rangoFechas">
														<div class="input-group-content">
															<input type="text" class="form-control" name="fStart" autocomplete="off"/>
															<label>Rango de Fechas</label>
														</div>
														<span class="input-group-addon">hasta</span>
														<div class="input-group-content">
															<input type="text" class="form-control" name="fEnd"  autocomplete="off"/>
															<div class="form-control-line"></div>
														</div>
													</div>
												</div>
											</div>

											 <div class="col-lg-offset-1 col-md-3">
						                    <?php
						                    require '../include/connect.php';
						                    $sql = "SELECT * FROM rutas WHERE estatus = '1'";
						                    $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
						                    ?>
						                    <div class="form-group">
						                    <select name="ruta" class="form-control select2-list" data-placeholder="">
						                      <option value="0">Todos</option>
						                      <optgroup label="Ruta">
						                        <?php
						                        while ($dat = mysqli_fetch_array($res)) {
						                          $active = ($ruta == $dat['id']) ? 'selected' : '' ;
						                         echo '<option value="'.$dat['id'].'" '.$active.'> '.$dat['destino1'].'  /'.$dat['destino2'].' / '.$dat['destino3'].'</option>';
						                        }
						                        ?>
						                      </optgroup>
						                     </select>
						                     <label>Ruta</label>
						                     </div>
						                    </div>

											<div class="col-lg-offset-1 col-lg-2">
												<div class="form-group">
													<select id="tipo" name="tipo" class="form-control">
														<option value="0" <?=($tipo == 0) ? 'selected' : '';?>>Todos</option>
														<option value="1" <?=($tipo == 1) ? 'selected' : '';?>>Pagos</option>
														<option value="2" <?=($tipo == 2) ? 'selected' : '';?>>Gastos</option>

													</select>
													<label for="tipo">Tipo</label>
												</div>
											</div>

											<div class="col-lg-offset-1 col-lg-1">
												<button type="submit" style="margin-top:5px;" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class='fa fa-spinner fa-spin'></i> --</center>">Aplicar</button>
											</div>
										</form>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END FILTROS -->


					  <div class="row">
							<div class="col-md-12">
								<div class="card card-bordered style-primary">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>

										</div>
									<header><i class="fa fa-fw fa-tag"></i> Lista de Gastos</header>
									</div><!--end .card-head -->
											<div class="card-body style-default-bright table-responsive">
												<?php
												#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
												#print_r($_SESSION);

												require('../include/connect.php');
												$filtrofecha='';
												$filtroRuta='';
												$filtroTipo='';


												if ($fecha1 != '' AND $fecha2 !='') {
													$filtrofecha = "AND gxt.fechaReg BETWEEN '$fecha1' AND '$fecha2'";
													}


												if ($ruta != '' AND $ruta >'0') {

														$filtroRuta = " AND (vnt.idRuta ='$ruta')";
														}

												if ($tipo != '' AND $tipo >'0') {

														$filtroTipo = " AND (gxt.tipo ='$tipo')";
														}



												$sql="SELECT gxt.*, rt.destino1 AS d1, rt.destino2 AS d2, rt.destino3 AS d3
													FROM gastosextra gxt
													LEFT JOIN viajes vjs ON vjs.id = gxt.idViaje
													LEFT JOIN	ventas vnt ON vnt.id = vjs.idVenta
													LEFT JOIN rutas rt ON rt.id = vnt.idRuta
												WHERE 1=1 $filtrofecha $filtroRuta $filtroTipo

													ORDER BY gxt.id ASC	";


												//echo '<br>sql:  '.$sql.'<br>';

													$res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
												?>
												<table class="table no-margin table-hover">
													<thead>
														<tr>
															<th class="sort-numeric">#</th>
															<th class="sort-alpha">Ruta</th>
															<th class="sort-alpha">Tipo</th>
															<th class="sort-numeric">Descripcion</th>
															<th class="sort-numeric">Monto</th>
															<th class="sort-alpha">Establecimiento</th>
															<th class="sort-numeric">Estatus</th>

														</tr>
													</thead>
													<tbody>
														<?php

														while ($dat = mysqli_fetch_array($res)) {


															switch ($dat['estatus']) {
								 								case '1':
								 								$estatus = 'Pagado';

																default:
																break;
															}

															switch ($dat['tipo']) {
																case '1':										$tipo = 'Pagos';											break;
																case '2':										$tipo = 'Gastos';												break;

															}
															if ($dat['d3']!='') {
																$ruta = $dat['d1'].'-'.$dat['d2'].'-'.$dat['d3'];
															} else {
																$ruta = $dat['d1'].'-'.$dat['d2'];
															}

															echo '
															<tr class="'.$color.' text-'.$color.'">
																<td id="idgastos'.$dat['id'].'">'.$dat['id'].'</td>
																<td id="ruta'.$dat['id'].'">'.$ruta.'</td>
																<td id="tipo'.$dat['id'].'">'.$tipo.'</td>
																<td id="Descripcion'.$dat['id'].'">'.$dat['descripcion'].'</td>
																<td id="Descripcion'.$dat['id'].'">'.$dat['monto'].'</td>
																<td id="punto" '.$dat['id'].'"> '.$dat['punto'].'</td>
																<td id="estatus'.$dat['id'].'">'.$estatus.'</td>



															</tr>';
														}
														?>
														</tbody>
												</table>

									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
					</div>
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->

			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->

		  <div class="modal fade" id="formEditConsulta" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="consultaContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formModalLabel">Editar Venta</h4>
						</div>
						<div class="modal-body">
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="verPDF" tabindex="-1" role="dialog" aria-labelledby="verPDFLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="verPDFContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="verPDFTitle"> Ver PDF</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

<!-- END MODAL-->


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
		<script>
			$(document).ready(function(){
			$('.txtPopOver').popover('show');

			$('#rangoFechas').datepicker({
				todayHighlight: true,
				format: "yyyy-mm-dd",
				language: "es"
			});

					});

					<?php
					if (isset( $_SESSION['ATZmsjEncargadoConGastos'])) {
						echo "notificaBad('".$_SESSION['ATZmsjEncargadoConGastos']."');";
						unset($_SESSION['ATZmsjEncargadoConVentas']);
					}
					if (isset( $_SESSION['ATZmsjSuccesEncargadoConVentas'])) {
						echo "notificaSuc('".$_SESSION['ATZmsjSuccesEncargadoConGast']."');";
						unset($_SESSION['ATZmsjSuccesEncargadoConGastos']);
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


/////////////////Aqui se le agrega el nombre al documento

		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
