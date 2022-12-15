	<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('conVentas.php');
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileinput.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css" />

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
										<header class="text-primary">Busqueda por:<header>
									</div><!--end .card-head -->
									<div class="card-body">
										<?php
										$fecha1 = (isset($_POST['fStart']) AND $_POST['fStart'] != '') ? $_POST['fStart'] : '' ;
										$fecha2 = (isset($_POST['fEnd']) AND $_POST['fEnd'] != '') ? $_POST['fEnd'] : '' ;
										$estatus = (isset($_POST['estatus']) AND $_POST['estatus'] != '') ? $_POST['estatus'] : '' ;
										$estatusVent = (isset($_POST['estatusVent']) AND $_POST['estatusVent'] != '') ? $_POST['estatusVent'] : '' ;
										$material = (isset($_POST['material']) AND $_POST['material'] != '') ? $_POST['material'] : '' ;
										#print_r($_POST);
										?>

										<div class="rows">
										<form class="form" method="post" action="conVentas.php">
											<div class="col-lg-4">
	                      <div class="form-group">
	                        <div class="input-daterange input-group" id="rangoFechas">
	                          <div class="input-group-content">
	                            <input type="text" class="form-control" name="fStart" value="<?=$fecha1;?>" autocomplete="off"/>
	                            <label>Rango de Fechas</label>
	                          </div>
	                          <span class="input-group-addon">hasta</span>
	                          <div class="input-group-content">
	                            <input type="text" class="form-control" name="fEnd" value="<?=$fecha2;?>" autocomplete="off"/>
	                            <div class="form-control-line"></div>
	                          </div>
	                        </div>
	                      </div>
	                    </div>
											<div class="col-lg-2">
												<div class="form-group">
													<select id="estatus" name="estatus" class="form-control">
														<option value="0" <?=($estatus == 0) ? 'selected' : '';?>>Todos</option>
														<option value="1" <?=($estatus == 1) ? 'selected' : '';?>>Pendiente</option>
														<option value="2" <?=($estatus == 2) ? 'selected' : '';?>>En Curso</option>
														<option value="3" <?=($estatus == 3) ? 'selected' : '';?>>Terminado</option>
														<option value="4" <?=($estatus == 4) ? 'selected' : '';?>>Cancelado</option>
													</select>
													<label for="estatus">Estatus de Viaje</label>
												</div>
											</div>

											<div class="col-lg-2">
												<div class="form-group">
													<select id="estatus" name="estatusVent" class="form-control">
														<option value="0" <?=($estatusVent == 0) ? 'selected' : '';?>>Todos</option>
														<option value="1" <?=($estatusVent == 1) ? 'selected' : '';?>>Pendiente</option>
														<option value="2" <?=($estatusVent == 2) ? 'selected' : '';?>>Pagado</option>
														<option value="3" <?=($estatusVent == 3) ? 'selected' : '';?>>Cancelado</option>
													</select>
													<label for="estatus">Estatus de Ventas</label>
												</div>
											</div>
											<div class="col-lg-2">
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-usd fa-lg"></i></span>
														<?php
										        require('../include/connect.php');
										        $sql2 = "SELECT *
										              FROM catmateriales cmat
										              WHERE cmat.estatus = 1
										              ORDER BY cmat.nombre ASC
										          ";
										        //echo $sql;
										        $res = mysqli_query($link,$sql2) or die('<p class="text-danger">Notifica al Administrador</p>');
										        ?>
														<div class="input-group-content">
															<select name="material" id="Material" class="form-control" value="<?= ($material == '') ? '0' : $material ;?>">
										            <?php
										            echo '<option value="">Todos	</option>';
										            while ($dat2 = mysqli_fetch_array($res)) {
																	$matActivo = ($dat2['id'] == $material) ? 'selected' : '' ;
										              echo '<option value="'.$dat2['id'].'" '.$matActivo.'>'.$dat2['nombre'].'</option>';
										            }
										            ?>
										          </select>
															<label for="costoFil">Material:</label>
														</div>
													</div>
												</div><!--end .form-group -->
											</div>
											<div class="col-lg-1">
												<button type="submit" style="margin-top:5px;" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class='fa fa-spinner fa-spin'></i> --</center>">Aplicar</button>
											</div>
										</form>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END FILTROS -->
						<div class="col-sm-2"></div>
						<div class="col-sm-2"><h2><i class="md md-info pull-right text-success"></i>Pago Concluido</h2></div>
						<div class="col-sm-1"></div>
						<div class="col-sm-2"><h2><i class="md md-info pull-right text-accent-light"></i>Pago Pendiente</h2></div>
						<div class="col-sm-1"></div>
						<div class="col-sm-2"><h2><i class="md md-info	 pull-right text-danger"></i>Pago Cancelado</h2></div>

					  <div class="row">
							<div class="col-md-12">
								<div class="card card-bordered style-primary">
									<div class="card-head">
										<!--div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>

										</div -->
									<header><i class="fa fa-fw fa-tag"></i> Lista de Ventas</header>
									</div><!--end .card-head -->
											<div class="card-body style-default-bright table-responsive">
												<?php
												#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
												#print_r($_SESSION);

												require('../include/connect.php');
												$filtrofecha='';
												$filtroMonto='';
												$filtroEstatus='';
												$filtroEstatusVenta='';

												if ($fecha1 != '' AND $fecha2 !='') {
													$filtrofecha = "AND vnt.fechaCarga BETWEEN '$fecha1' AND '$fecha2'";
													}


												if ($estatus != '' AND $estatus >'0') {

														$filtroEstatus = " AND (vnt.estatusViaje ='$estatus')";
														}
												if ($estatusVent != '' AND $estatusVent >'0') {

														$filtroEstatusVenta = " AND (vnt.estatusPago ='$estatusVent')";
														}

						 						if ($material !='' AND $material != '0'){
														$filtroMaterial = " AND  (vnt.idCatMaterial = '$material')";
						 								}


												$sql="SELECT vnt.*, ctmat.nombre AS nomMat, clnt.nombre AS nomCliente, rut.destino1 AS d1,
															rut.destino2 AS d2, rut.destino3 AS d3, vjs.totalKilometros AS tKilometro
												FROM ventas vnt
												LEFT JOIN clientes clnt ON clnt.id = vnt.idCliente
												LEFT JOIN catmateriales ctmat ON ctmat.id = vnt.idCatMaterial
												LEFT JOIN rutas rut ON rut.id = vnt.idRuta
												LEFT JOIN viajes vjs ON vjs.idVenta = vnt.id
												WHERE 1=1 $filtrofecha $filtroEstatus $filtroEstatusVenta $filtroMaterial
												ORDER BY vnt.id DESC";
												//echo '<br>sql:  '.$sql.'<br>';

													$res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
												?>
												<table class="table table-striped table-hover" id="datatable1">
													<thead>
														<tr>
															<th class="sort-numeric">#</th>
															<th class="sort-alpha text-center">Cliente</th>
															<th class="sort-alpha">Precio de la Venta</th>
															<th class="sort-alpha">Folio de Carga</th>
															<th class="sort-alpha">Material Cargado</th>
															<th class="sort-numeric">Peso en Toneladas</th>
															<th class="sort-numeric">Precio por Tonelada</th>
															<th class="sort-numeric">Fecha de Carga de Material</th>
															<th class="sort-numeric">Docto de Carga</th>
															<th class="sort-numeric">Docto de Entrega</th>
															<th class="sort-numeric">Ruta</th>
															<th class="text-center">Gasto en Casetas</th>
															<th class="sort-numeric">Distancia</th>
															<th class="sort-alpha">Estatus De Pago</th>
															<th class="sort-alpha">Estatus De Viaje</th>
															<th class="col-lg-1 text-center">Funciones</th>
															<th class="col-lg-1 text-center">Reimprimir Ticket</th>
														</tr>
													</thead>
													<tbody>
														<?php

														while ($dat = mysqli_fetch_array($res)) {
															$estatus = ($dat['estatus'] == '1') ? '<i class="fa fa-check">' : '<i class="fa fa-close">';
															$estatusText = ($dat['estatusPago'] == '1') ? '' : 'class="text-danger"';
															$estatusColor = ($dat['estatus'] == '1') ? 'text-success' : '';
															$doctoOnClick =  ($dat['doctoCarga'] == '') ? 'disabled' : 'onclick="verPDF('.$dat['id'].')" data-toggle="modal" data-target="#verPDF"';
															$doctoMsj =  ($dat['doctoCarga'] == '') ? 'No se ha subido ningun Documento.' : 'Ver Documento.';

															if ($dat['doctoCarga'] == '') {
																$btnDoctoCarga = '<button type="button" '.$doctoOnClick.' class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
															}else {
																$btnDoctoCarga = '<button type="button" '.$doctoOnClick.' class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
															}

															$doctoOnClick2 =  ($dat['doctoEntrega'] == '') ? 'disabled' : 'onclick="verPDF2('.$dat['id'].')" data-toggle="modal" data-target="#verPDF"';
															$doctoMsj2 =  ($dat['doctoEntrega'] == '') ? 'No se ha subido ningun Documento.' : 'Ver Documento.';

															if ($dat['doctoCarga'] == '') {
																$btnDoctoEntrega = '<button type="button" '.$doctoOnClick2.' class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
															}else {
																$btnDoctoEntrega = '<button type="button" '.$doctoOnClick2.' class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
															}

															switch ($dat['estatusPago']) {
								 								case '1':		$ePago = 'Pendiente';	$color='accent-light';							break;
																case '2':		$ePago = 'Pagado'; 	$color='success';											break;
																case '3':		$ePago = 'Cancelado'; 	$color='danger';									break;
																default:		$ePago = 'Pendiente';	$color='accent-light';							break;
															}

															switch ($dat['estatusViaje']) {
																case '1':										$eViaje = 'Pendiente';											break;
																case '2':										$eViaje = 'En Curso';												break;
																case '3':										$eViaje = 'Terminado';											break;
																case '4':										$eViaje = 'Cancelado';											break;
																default:										$eViaje = 'Pendiente';											break;
															}
															if ($dat['d3']!='') {
																$ruta = $dat['d1'].'-'.$dat['d2'].'-'.$dat['d3'];
															} else {
																$ruta = $dat['d1'].'-'.$dat['d2'];
															}

															echo '
															<tr class="'.$color.' text-'.$color.'">
																<td id="idVenta'.$dat['id'].'">'.$dat['id'].'</td>
																<td id="cliente'.$dat['id'].'"> '.$dat['nomCliente'].' </td>
																<td id="monto'.$dat['id'].'">'.$dat['monto'].'</td>
																<td id="material'.$dat['id'].'">'.$dat['folioCarga'].'</td>
																<td id="material'.$dat['id'].'">'.$dat['nomMat'].'</td>
																<td id="peso'.$dat['id'].'">'.$dat['peso'].'</td>
																<td id="peso'.$dat['id'].'">'.$dat['precioMaterial'].'</td>
																<td id="fecha'.$dat['id'].'">'.$dat['fechaCarga'].'</td>
																<td class="col-lg-1 text-right" id="doctoCarga'.$dat['id'].'"> '.$btnDoctoCarga.'</td>
																<td class="col-lg-1 text-right" id="doctoEntrega'.$dat['id'].'"> '.$btnDoctoEntrega.'</td>
																<td id="ruta'.$dat['id'].'">'.$ruta.'</td>
																<td id="peso'.$dat['id'].'">'.$dat['casetas'].'</td>
																<td id="distancia'.$dat['id'].'">'.$dat['tKilometros'].'</td>
																<td id="estatusPago'.$dat['id'].'">'.$ePago.'</td>
																<td id="estatusViaje'.$dat['id'].'">'.$eViaje.'</td>
																<td class="text-right">
																	<button type="button" class="btn btn-icon-toggle" onclick="editaConsulta('.$dat['id'].')" data-toggle="modal" data-target="#formEditConsulta"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
																</td>
																<td class="text-right">
																<form method="POST" action="../funciones/reimprimeTicketVenta.php">
																	<input type="hidden" value="'.$dat['id'].'" name="ident">
																		<button type="submit" class="btn btn-icon-toggle" onclick="reimprimeTicket('.$dat['id'].')" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Reimprimir Ticket."><i class="fa fa-file-pdf-o"></i></button>
																	</td>
																</form>
															</tr>';
														}
														?>
														</tbody>
												</table>

									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
					</div>
					<!------------------------------------------------------------------------------------------------------------------------------------->
					<div class="row">
						<div class="col-md-12">
							<div class="card card-bordered style-primary">
								<div class="card-head">
									<!--div class="tools">
										<div class="btn-group">
											<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
										</div>

									</div -->
								<header><i class="fa fa-fw fa-tag"></i>Toneladas de Material por Cliente</header>
								</div><!--end .card-head -->
										<div class="card-body style-default-bright table-responsive">
											<?php
											#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											#print_r($_SESSION);

											require('../include/connect.php');

											$sql="SELECT vnt.id, vnt.idCliente, vnt.idCatMaterial, ctmat.nombre AS nomMat,
														clnt.nombre AS nomCliente, SUM(vnt.precioMaterial) AS precioMat,
														SUM(vnt.peso) AS Toneladas, vnt.idCatMaterial,CONCAT(SUBSTR(rut.destino1,1,4),'/',SUBSTR(rut.destino2,1,4)) as nRuta,SUBSTR(rut.destino3,1,4) AS nRuta2
														FROM	ventas vnt
														INNER JOIN clientes clnt ON clnt.id = vnt.idCliente
														INNER JOIN catmateriales ctmat ON ctmat.id = vnt.idCatMaterial
														INNER JOIN rutas rut ON rut.id = vnt.idRuta
														INNER JOIN viajes vjs ON vjs.idVenta = vnt.id
														WHERE	1 = 1 AND vnt.estatusViaje != 4 $filtrofecha $filtroEstatus $filtroEstatusVenta
														GROUP BY vnt.idCliente, vnt.idCatMaterial,rut.id
														ORDER BY vnt.idCliente ASC";
											//echo '<br>sql:  '.$sql.'<br>';

												$res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
											?>
											<table class="table table-striped table-hover">
												<thead>
													<tr>
														<th class="sort-numeric text-center">#</th>
														<th class="sort-alpha text-center">Cliente</th>
														<th class="sort-alpha text-center">Material Cargado</th>
														<th class="sort-alpha text-center">Destino</th>
														<th class="sort-numeric text-center">Peso en Toneladas</th>
														<th class="sort-numeric text-center">Precio</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$i = 1;
													while ($dat = mysqli_fetch_array($res)) {
														$precio = ($dat['precioMat'] == '' || $dat['precioMat'] == 0) ? 'S/R' : $dat['precioMat'] ;
														$ton = ($dat['Toneladas'] == '' || $dat['Toneladas'] == 0 ) ? 'S/R' : $dat['Toneladas'] ;
														$nRuta = ($dat['nRuta2'] == '') ? $dat['nRuta'] : ($dat['nRuta'].'/'.$dat['nRuta2']) ;
														echo '
														<tr>
															<td id="idVenta'.$dat['id'].'" class="text-center">'.$i.'</td>
															<td id="cliente'.$dat['id'].'" class="text-center"> '.$dat['nomCliente'].' </td>
															<td id="material'.$dat['id'].'" class="text-center">'.$dat['nomMat'].'</td>
															<td id="material'.$dat['id'].'" class="text-center">'.$nRuta.'</td>
															<td id="peso'.$dat['id'].'" class="text-center">'.$ton.'</td>
															<td id="peso'.$dat['id'].'" class="text-center">'.$precio.'</td>
														</tr>';
														$i++;
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
		<script src="../assets/js/libs/fileInput/fileinput.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="../assets/js/libs/toastr/toastr.js"></script>
		<script src="../assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="../assets/js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.es.js"></script>
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
					if (isset( $_SESSION['ATZmsjEncargadoConVentas'])) {
						echo "notificaBad('".$_SESSION['ATZmsjEncargadoConVentas']."');";
						unset($_SESSION['ATZmsjEncargadoConVentas']);
					}
					if (isset( $_SESSION['ATZmsjSuccesEncargadoConVentas'])) {
						echo "notificaSuc('".$_SESSION['ATZmsjSuccesEncargadoConVentas']."');";
						unset($_SESSION['ATZmsjSuccesEncargadoConVentas']);
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

					function editaConsulta(ident){
						$("#editaventaBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
						//alert('ID: '+ident);
						$.post("../funciones/formEditaConVentas.php",
							{ ident:ident},
								function(respuesta){
									$("#consultaContent").html(respuesta);
								});
					}
/////////////////Aqui se le agrega el nombre al documento
					function verPDF(ident){
						$.post("../funciones/verPDF-ConVentas.php",
							{ ident:ident,campo:'1' },
								function(respuesta){
									$("#verPDFContent").html(respuesta);
								});
					}
					function verPDF2(ident){
						$.post("../funciones/verPDF-ConVentas.php",
							{ ident:ident,campo:'2' },
								function(respuesta){
									$("#verPDFContent").html(respuesta);
								});
					}

					function preparaForm(){
						$("#factPDF").fileinput({
				      showUpload: false,
				      showCaption: false,
				      browseLabel: ' PDF &hellip;',
				      allowedFileExtensions : ['pdf'],
				      maxFileSize: 5120,
				      maxFilesNum: 1,
				      browseClass: "btn btn-primary btn-lg",
				      fileType: "PDF",
				      previewFileIcon: "<i class='fa fa-file-pdf-o'></i>"
				    });
					}
		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
