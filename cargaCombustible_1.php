<?php
require_once 'seg.php';
require 'include/connect.php';
$info = new Seguridad();
$info->Acceso('cargaCombustible.php');
require_once('funciones/notificaAuxiliar.php');
if (isset($_SESSION['newIDCarga'])) {
	unset($_SESSION['newIDCarga']);
}
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
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/toastr/toastr.css?1425466569" />

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
							<div class="col-md-8">

								<!-- BEGIN ACTION -->
								<div class="card">
									<div class="card-head">
										<header><i class=""> Tickets de Gasolina Entregados</header>
										<div class="tools">
										</div>
									</div>

									<div class="card-body  height-13">
										<!-- BEGIN DATATABLE 1 -->
										<div class="row">
											<div class="col-lg-12">
												<div class="card-body">
													<?php
														require('include/connect.php');
														$sql="SELECT cgcomb.*, gas.nombre AS Gasolinera, catcomb.nombre AS Combustible, op.nombre as Operador, ope.nombre as Operador2, gas.credito AS gasCredito
																	FROM cargacombustible cgcomb
																	LEFT JOIN gasolineras gas on cgcomb.idGasolinera = gas.id
																	LEFT JOIN catcombustibles catcomb ON cgcomb.idCatCombustible = catcomb.id
																	LEFT JOIN viajes vjs ON cgcomb.idViaje = vjs.id
																	LEFT JOIN asignavehiculos av ON vjs.idAsignaVehiculo = av.id
																	LEFT JOIN operadores op ON av.idOperador = op.id
																	LEFT JOIN vehiculos ve ON ve.id = cgcomb.idVehiculoPersonal
																	LEFT JOIN asignavehiculos ave ON ve.id = ave.idVehiculo
																	LEFT JOIN operadores ope ON ave.idOperador = ope.id
																	ORDER BY cgcomb.id DESC";
														#echo $sql;
														$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.'.mysqli_error($link).'</p>');
													?>
													<div class="table-responsive">
														<table id="datatable1" class="table table-striped table-hover">
															<thead>
																<tr>
																	<th>Folio</th>
																	<th>Gasolinera</th>
																	<th>Crédito</th>
																	<th>Operador</th>
																	<th>Combustible</th>
																	<th>Litros</th>
																	<th>Kilometraje</th>
																	<th>Fecha</th>
																	<th>Comprobación</th>
																	<th>Reimprimir Ticket</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$cont = 0;
																while ($dat = mysqli_fetch_array($res)) {
																	$cont++;
																	$estatus = ($dat['estatus'] == 1) ? '<center class="text-success"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Registrado"><i class="md md-file-upload"></i></center>' : '<center class="text-danger"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Sin Registrar"><i class="md md-close"></i></center>' ;
																	$gastoFac = (isset($dat['idFactura']) AND $dat['idFactura'] >= 1) ? '<button type="button" class="btn btn-icon-toggle text-success" data-toggle="modal" data-target="#cargaFac" onclick="muestraFactura('.$dat['id'].')"><i class="fa fa-copy" data-toggle="tooltip" data-placement="top" data-original-title="Mostrar Comprobante"></i></button>' :
																						'<button type="button" class="btn btn-icon-toggle text-info" data-toggle="modal" data-target="#cargaFac" onclick="cargaFactura('.$dat['id'].')"><i class="glyphicon glyphicon-cloud-upload" data-toggle="tooltip" data-placement="top" data-original-title="Subir Comprobante"></i></button>';
																	$estatusText = ($dat['estatus'] == 1) ? '' : 'class="text-danger"' ;
																	$comprobante = ($dat['doctoComprobante'] != '') ? '<i class="fa fa-check">' : '<i class="fa fa-close">';
																	$estatusColor = ($dat['doctoComprobante'] != '') ? 'text-success' : '';
																	$fecha = $dat['fecha'];
																	if ($dat['gasCredito'] == 1) {
																		$mensaje= 'Sí';
																	} else {
																		$mensaje= 'No';
																	}
																	$nomOperador = ($dat['Operador'] == '') ? $dat['Operador2'] : $dat['Operador'] ;

																	echo '
																	<tr '.$estatusText.'>
																		<td>'.$dat['id'].'</td>
																		<td>'.$dat['Gasolinera'].'</td>
																		<td>'.$mensaje.'</td>
																		<td>'.$nomOperador.'</td>
																		<td>'.$dat['Combustible'].'</td>
																		<td>'.$dat['cant'].'</td>
																		<td>'.number_format($dat['kilometraje'], 0, '', "'").'</td>
																		<td>'.$dat['fechaReg'].'</td>
																		<td class="col-lg-1 text-center '.$estatusColor.'" id="mttoEstatus'.$dat['id'].'">'.$estatus.'</td>
																		<td class="text-center">
																			<form method="POST" action="funciones/reimprimeTicketCombustible.php" target="_blank">
																			<input type="hidden" value="'.$dat['id'].'" name="ident">
																				<button type="submit" class="btn btn-icon-toggle" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Reimprimir Ticket."><i class="fa fa-file-pdf-o"></i></button>
																			</form>
																		</td>
																	</tr>';
																}
																?>
															</tbody>
														</table>
													</div><!--end .table-responsive -->
												</div><!--end .card-body -->
											</div><!--end .col -->
										</div><!--end .row -->
										<!-- END DATATABLE 1 -->
									</div><!--end .card-body -->
								</div><!--end .card -->
								<!-- END ACTION -->

							</div><!--end .col -->

							<div class="col-md-4">
								<div class="card">
									<div class="card-head">
										<ul class="nav nav-tabs" data-toggle="tabs">
											<li class="active"><a href="#first1">Viajes</a></li>
											<li><a href="#second1">Vehículos Personales</a></li>
										</ul>
									</div><!--end .card-head -->
									<div class="card-body tab-content">
										<div class="tab-pane active" id="first1">
							        <div class="row">
												<div class="col-md-12">
													<div class="card-body style-default-bright table-responsive">

														<div class="row">
														 <form class="form-horizontal" role="form" method="post" action="funciones/registraNuevaCargaCombustible.php">
															 <div class="card-body">
																 <div class="form-group">
																	 <div class="col-sm-3">
																		 <label for="ruta" class="text-left">Selecciona el Viaje</label>
																	 </div>
																	 <div class="col-sm-9">
																		 <?php
																		 $sql = "SELECT vjs.id, op.nombre, op.apellidos, vh.noEconomico, vh.placas, idVenta
																					 FROM viajes vjs
																					 INNER JOIN asignavehiculos av ON vjs.idAsignaVehiculo = av.id
																					 INNER JOIN operadores op ON av.idOperador = op.id
																					 INNER JOIN vehiculos vh ON av.idVehiculo = vh.id
																					 WHERE av.estatus = '1' AND vjs.estatus = '1'
																					 AND vjs.id NOT IN
																						 (SELECT cgc.idViaje FROM cargacombustible cgc GROUP BY cgc.idViaje)
																					 ORDER BY vjs.id ASC";
																		 //echo $sql;
																		 $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
																		 ?>
																		 <select name="viaje" id="viaje" class="form-control" onchange="obtenerDatosViajes(this.value);"  required>
																							 <option value=""></option>
																			 <?php
																			 while ($dat = mysqli_fetch_array($res)) {
																				 echo '<option value="'.$dat['id'].'">VIAJE: '.$dat['id'].' - ECO-'.$dat['noEconomico'].' - '.$dat['nombre'].' '.$dat['apellidos'].' (Placas: '.$dat['placas'].')</option>';
																			 }
																			 ?>
																		 </select>
																	 </div>
																 </div>
																 <div class="form-group">
																	 <div class="col-sm-3">
																		 <label for="gasolinera" class="text-left">Gasolinera</label>
																	 </div>
																	 <div class="col-sm-9">
																		 <?php
																		 $sql = "SELECT * FROM gasolineras ORDER BY nombre ASC";
																		 $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>'.$sql);
																		 ?>
																		 <select name="gasolinera" id="gasolinera" onchange="buscaCredito(this.value);" class="form-control" required>
																			 <option value="">Selecciona la Gasolinera</option>
																			 <?php
																			 while ($dat = mysqli_fetch_array($res)) {
																				 echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
																			 }
																			 ?>
																		 </select>
																	 </div>
																	 <div class="col-sm-4"></div><div class="form-group floating-label col-sm-5 align-center" id="d1"></div>
																 </div>
																 <div class="form-group">
																	 <div class="col-sm-3">
																		 <label for="combustible" class="text-left">Combustible</label>
																	 </div>
																	 <div class="col-sm-9">
																		 <?php
																		 $sql = "SELECT * FROM catcombustibles ORDER BY nombre ASC";
																		 $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador. '.mysqli_error($link).'</p>');
																		 ?>
																		 <select name="combustible" id="combustible" class="form-control"  required>
																			 <?php
																			 while ($dat = mysqli_fetch_array($res)) {
																				 echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
																			 }
																			 ?>
																		 </select>
																	 </div>
																 </div>
																 <div class="col-lg-12" id="combustiblesActuales"></div>
																 </div>


																 <div class="form-group">
																	 <div class="col-sm-3">
																		 <label for="litros" class="text-left">Litros</label>
																	 </div>
																	 <div class="col-sm-6">
																		 <div class="input-group">
																			 <div class="input-group-content">
																				 <input type="number" step="any" min="0.001" class="form-control" id="litros" name="litros" required>
																			 </div>
																			 <span class="input-group-addon">Lts.</span>
																		 </div>
																	 </div>
																	 <div class="col-sm-3">
																		 <div class="input-group">
																			 <div class="input-group-content">
																				 <div class="checkbox-inline checkbox-styled checkbox-success">
																					<label>
																						<input type="checkbox" value="1" class="form-control" id="full" name="full" checked>
																						<span>Tanque Lleno</span>
																					</label>
																				</div>
																			 </div>
																		 </div>
																	 </div>
																 </div>
																 <div class="form-group">
																	 <div class="col-sm-3">
																		 <label for="kilometros" class="text-left">Kilometraje</label>
																	 </div>
																	 <div class="col-sm-9">
																		 <div class="input-group">
																			 <div class="input-group-content">
																				 <input type="number" class="form-control" id="kilometros" min="0" name="kilometros" onkeyup="soloNumeros(this.value,'kilometros')" required>
																			 </div>
																			 <span class="input-group-addon">Km.</span>
																		 </div>
																	 </div>
																 </div>
																 <div class="form-group">
																	 <p><br><button type="submit" class="btn btn-block ink-reaction btn-primary">Registrar</button></p>
																 </div>
														 </form>
															 </div><!--end .card-body -->
														</div>
													</div><!--end .card -->
												</div><!--end .col -->
											</div>
										<div class="tab-pane" id="second1">
						        	<div class="row">
												<div class="col-md-12">
													<div class="card-body style-default-bright table-responsive">

														<div class="row">
															<form class="form-horizontal" role="form" method="post" action="funciones/registraNuevaCargaCombustible2.php">
																<div class="card-body">
																	<div class="form-group">
																		<div class="col-sm-3">
																			<label for="ruta" class="text-left">Selecciona la Persona</label>
																		</div>
																		<div class="col-sm-9">
																			<?php
																			$sql = "SELECT vh.id, CONCAT(op.nombre, ' ', op.apellidos) AS nomOpe, CONCAT( ctpv.nombre ,', Placas: ',vh.placas) AS nomVe
																						FROM operadores op
																						INNER JOIN asignavehiculos av ON op.id = av.idOperador
																						INNER JOIN vehiculos vh ON av.idVehiculo = vh.id
																						INNER JOIN cattipovehiculos ctpv ON ctpv.id = vh.idCatTipoVehiculo
																						WHERE av.estatus = '1' AND (vh.idCatTipoVehiculo = '2' OR vh.idCatTipoVehiculo = '3' OR vh.idCatTipoVehiculo = '4')
																						ORDER BY op.id ASC";
																			//echo $sql;
																			$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
																			?>
																			<select name="vePersonal" id="vePersonal" class="form-control" required>
																								<option value=""></option>
																				<?php
																				while ($dat = mysqli_fetch_array($res)) {
																					echo '<option value="'.$dat['id'].'">'.$dat['nomOpe'].' '.$dat['nomVe'].'</option>';
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-3">
																			<label for="gasolinera2" class="text-left">Gasolinera</label>
																		</div>
																		<div class="col-sm-9">
																			<?php
																			$sql = "SELECT * FROM gasolineras ORDER BY nombre ASC";
																			$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>'.$sql);
																			?>
																			<select name="gasolinera2" id="gasolinera2" onchange="buscaCredito(this.value);" class="form-control" required>
																				<option value="">Selecciona la Gasolinera</option>
																				<?php
																				while ($dat = mysqli_fetch_array($res)) {
																					echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
																				}
																				?>
																			</select>
																		</div>
																		<div class="col-sm-4"></div><div class="form-group floating-label col-sm-5 align-center" id="d1"></div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-3">
																			<label for="combustible2" class="text-left">Combustible</label>
																		</div>
																		<div class="col-sm-9">
																			<?php
																			$sql = "SELECT * FROM catcombustibles ORDER BY nombre ASC";
																			$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador. '.mysqli_error($link).'</p>');
																			?>
																			<select name="combustible2" id="combustible2" class="form-control"  required>
																				<?php
																				while ($dat = mysqli_fetch_array($res)) {
																					echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
																				}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="col-lg-12" id="combustiblesActuales"></div>
																	</div>
																	<div class="form-group">
																		<div class="col-sm-3">
																			<label for="litros2" class="text-left">Litros</label>
																		</div>
																		<div class="col-sm-9">
																			<div class="input-group">
																				<div class="input-group-content">
																					<input type="number" step="any" min="0.001" class="form-control" id="litros2" name="litros2" required>
																				</div>
																				<span class="input-group-addon">Lts.</span>
																			</div>
																		</div>
																	</div>
																	<div class="form-group">
																		<p><br><button type="submit" class="btn btn-block ink-reaction btn-primary">Registrar</button></p>
																	</div>
																</div><!--end .card-body -->
															</form>
													</div>
												</div><!--end .card -->
											</div><!--end .col -->
										</div>
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
			<div class="modal fade" id="cargaFac" tabindex="-1" role="dialog" aria-labelledby="cargaFacLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="cargaFacLabel">Carga de Factura</h4>
						</div>
						<form class="form-horizontal" role="form" method="post" action="funciones/cargaFacturaCombustible.php" enctype="multipart/form-data">
							<div class="modal-body" id="facBD">
								<p id="labelDetalleFac"></p>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="factPDF" class="control-label"><b class="text-default-dark">Sube tu PDF:</b></label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="factPDF" id="factPDF"  class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="factXML" class="control-label"><b class="text-default-dark">Sube tu XML:</b></label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="factXML" id="factXML" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input class="control-label" type="hidden" name="identCargaFactura" id="identCargaFactura" value="" >
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" id="btnCargaFactura" class="btn btn-primary btn-loading-state" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> PROCESANDO..." disabled>Subir Factura</button>
							</div>
						</form>
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
		<script src="assets/js/core/demo/Demo.js"></script>
		<script src="assets/js/core/demo/DemoTableDynamic.js"></script>
		<script src="assets/js/libs/fileInput/fileinput.js"></script>
		<script src="assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="assets/js/libs/toastr/toastr.js"></script>
		<script>
	  $(document).ready(function(){
			$("#factPDF").fileinput({
				showUpload: false,
				showCaption: false,
				language: 'es',
				allowedFileExtensions : ['pdf'],
				maxFileSize: 5120,
				maxFilesNum: 1,
				browseClass: "btn btn-primary btn-lg",
				fileType: "any",
				previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
			});

			$("#factXML").fileinput({
				showUpload: false,
				showCaption: true,
				showPreview: false,
				language: 'es',
				allowedFileExtensions : ['xml'],
				maxFileSize: 5120,
				maxFilesNum: 1,
				browseClass: "btn btn-primary btn-lg",
				fileType: "any",
				previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
			});

			<?php
			if (isset( $_SESSION['ATZmsjCargaCombustibles'])) {
				echo "notificaBad('".$_SESSION['ATZmsjCargaCombustibles']."');";
				unset($_SESSION['ATZmsjCargaCombustibles']);
			}
			if (isset( $_SESSION['ATZmsjSuccesCargaCombustible'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesCargaCombustible']."');";
				unset($_SESSION['ATZmsjSuccesCargaCombustible']);
			}
			?>
	  });

		function obtenerDatosViajes(value){
			//var idviaje = $(#"viaje option:selected").val();
			//alert('Valor: '+value+' idViaje'+idviaje);
			$.post("funciones/exploraDatosDeViajes.php",
      	{ ident:value },
    			function(respuesta){
					//	alert('respuesta: '+respuesta);
						var res=respuesta.split('|');
						if (res[0] == '1') {
							//notificaSuc('Se a Cargado Correctamente.');
							$("#combustible").html(res[1]);
							$("#combustiblesActuales").html(res[2]);
							$("#kilometros").attr({"min":res[3],"placeholder":"Debe ser mayor a: "+res[3]});
				//			alert('val '+value+'res '+res[3]);
						} else {
							notificaBad(res[1]);

						}
   				});
		}

		function buscaGasolineras(value){
			$.post("funciones/listaGasolinerasPorEstado.php",
      	{ id:value },
    			function(respuesta){
            //alert(respuesta);
      			$("#gasolinera").html(respuesta);
   				});
    }

		//----------------------Funciones para la carga de Facturas------------------------------------------
		function cargaFactura(id){
			var detalles = $('#nameTipoGasto'+id).html();
			$("#formSubeFacturaLabel").html('<p class="text-primary"><i class="fa fa-spinner fa-spin"></i> CARGANDO...</p>');
			$("#formSubeFacturaLabel").html('Subir Factura');
			$('#identCargaFactura').val(id);
			$('#labelDetalleFac').html('<p class="text-primary"> Factura de Carga #'+id+'</p>');
			$('#btnCargaFactura').attr("disabled", false);
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
		function buscaCredito(ident){
			$.post("funciones/muestraCredito.php",
				{ ident:ident },
					function(respuesta){
						$("#d1").html(respuesta);
					});
		}
		function soloNumeros(cadena, id){
			var newCadena = cadena.replace(/[^0-9]/g,'');
			//alert(newCadena);
			$("#"+id).val(newCadena);
		}
		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
