<?php
require_once 'seg.php';
require 'include/connect.php';
$info = new Seguridad();
$info->Acceso('facturasPendientes.php');
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
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/summernote/summernote.css?1425218701" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/fileInput/fileinput.css" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/toastr/toastr.css" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />



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
											$gasolinera = (isset($_POST['gasolinera']) AND $_POST['gasolinera'] != '') ? $_POST['gasolinera'] : '' ;
											?>
											<div class="rows">
												<form class="form" method="post" action="facturasPendientes.php">
													<div class="col-lg-offset-2 col-md-5">
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
													<div class="col-md-2">
					                    <?php
					                    require('include/connect.php');
					                    $sqlGas = "SELECT * FROM gasolineras WHERE estatus = '1'";
					                    $resGas = mysqli_query($link, $sqlGas) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
					                    ?>
					                      <div class="form-group">
					                        <select name="gasolinera" class="form-control select2-list" data-placeholder="Select an item">
					                          <option value=''>Todos las Gasolineras</option>
					                          <optgroup label="Gasolineras">
					                            <?php
					                            while ($datGas = mysqli_fetch_array($resGas)) {
					                              $activeGas = ($gasolinera == $datGas['id']) ? 'selected' : '' ;
					                              echo '<option value="'.$datGas['id'].'" '.$activeGas.'> '.$datGas['nombre'].'</option>';
					                            }
					                            ?>
					                          </optgroup>
				                          </select>
					                        <label>Seleccione Estación de Servicio</label>
					                      </div>
				                  </div>
													<div class="col-lg-offset-1 col-lg-2">
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
		 						 <div class="col-md-4 col-sm-7">
		 							 <div class="card">
		 								 <div class="card-body no-padding">
											 <?php
												 $filtrofecha1='';

												 if ($fecha1 != '' AND $fecha2 !='') {
												 $filtrofecha1 ="AND (cpr.fecha BETWEEN '$fecha1' AND '$fecha2')";
													}
													require 'include/connect.php';
													error_reporting(E_ALL); //muestra todos los errores encontrados en la página
													$fpcSql = "SELECT count(id) AS cCant
																								FROM compras cpr
																								WHERE ((cpr.doctoComprobante ='' AND cpr.doctoFactura='') || (cpr.doctoComprobante ='0' AND cpr.doctoFactura='0')) $filtrofecha1
																	";
														$fpcRes = mysqli_query($link, $fpcSql) or die('<span class="text-danger">Por favor notifica al Administrador</span>'.mysqli_error($link));
														$cPpgr = mysqli_fetch_array($fpcRes);
														$fpc = ($cPpgr['cCant'] == '') ? '0' : $cPpgr['cCant'] ;
											 ?>
		 									 <div class="alert alert-callout alert-info no-margin">
		 										 <h1 class="pull-right text-info"><i class="fa fa-cart-plus"></i></h1>
		 										 <strong class="text-xl"  id="sCompras"><?=$fpc;?> Facturas por Cargar</strong><br/>
		 										 <span class="opacity-50">Facturas Pendientes por Cargar en Compras</span>
		 									 </div>
		 								 </div><!--end .card-body -->
		 							 </div><!--end .card -->
		 						 </div><!--end .col -->

		 						 <div class="col-md-4 col-sm-7">
		 							 <div class="card">
		 								 <div class="card-body no-padding">
											 <?php
												 $filtrofecha2 ='';

												 if ($fecha1 != '' AND $fecha2 !='') {
												 $filtrofecha2 ="AND mtto.fechaReg BETWEEN '$fecha1' AND '$fecha2'";
													}
													$fpmSql = "SELECT count(mtto.id) AS mcant
																				FROM mttos mtto
																				LEFT JOIN cattipomttos ctmtto ON ctmtto.id = mtto.idCatTipoMtto
																				LEFT JOIN catserviciosmttos ctsrvmtto ON ctsrvmtto.id = mtto.idServicioMtto
																				WHERE (mtto.idFactura IS NULL OR mtto.idFactura='') $filtrofecha2
																				ORDER BY mtto.id, mtto.fechaReg ASC

																	";
														$fpmRes = mysqli_query($link, $fpmSql) or die('<span class="text-danger">Por favor notifica al Administrador</span>'.mysqli_error($link));
														$mPpgr = mysqli_fetch_array($fpmRes);
														$fpm = ($mPpgr['mcant'] == '') ? '0' : $mPpgr['mcant'] ;
											 ?>
		 									 <div class="alert alert-callout alert-warning no-margin">
		 										 <h1 class="pull-right text-warning"><i class="fa fa-gears"></i></h1>
		 										 <strong class="text-xl"  id="sMttos"><?=$fpm;?> Facturas por Cargar</strong><br/>
		 										 <span class="opacity-50">Facturas Pendientes por Cargar en Mantenimientos</span>
		 									 </div>
		 								 </div><!--end .card-body -->
		 							 </div><!--end .card -->
		 						 </div><!--end .col -->

		 						 <div class="col-md-4 col-sm-7">
		 							 <div class="card">
		 								 <div class="card-body no-padding">
											 <?php
												 $filtrofecha3='';

												 if ($fecha1 != '' AND $fecha2 !='') {
												 $filtrofecha3 =" AND carco.fechaReg BETWEEN '$fecha1' AND '$fecha2'";
													}
													$filtroGas = ($gasolinera != '') ? " AND gas.id = '$gasolinera'" : '' ;
													$fpgSql = "SELECT SUM(carco.cant) AS ltcant,count(carco.id) AS gcant
																FROM cargacombustible carco
																LEFT JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
																LEFT JOIN gasolineras gas ON carco.idGasolinera = gas.id
																LEFT JOIN catestados ces ON gas.idCatEstado = ces.id
																LEFT JOIN catmunicipios cmu ON gas.idCatMunicipio = cmu.id
																WHERE carco.doctoComprobante = '' AND carco.idFactura = '0' $filtrofecha3 $filtroGas
																ORDER BY carco.idGasolinera ASC
																	";
														$fpgRes = mysqli_query($link, $fpgSql) or die('<span class="text-danger">Por favor notifica al Administrador</span>'.mysqli_error($link));
														$ltsPpgr = mysqli_fetch_array($fpgRes);
														$fpglt = ($ltsPpgr['ltcant'] == '') ? '0' : $ltsPpgr['ltcant'] ;
														$fpgg = ($ltsPpgr['gcant'] == '') ? '0' : $ltsPpgr['gcant'] ;
											 ?>
		 									 <div class="alert alert-callout alert-success no-margin">
		 										 <h1 class="pull-right text-success"><i class="fa fa-tint"></i></h1>
		 										 <strong class="text-xl" id="sUtilidad"><?=$fpglt;?> (<?=$fpgg;?> Facturas por Cargar)</strong><br/>
		 										 <span class="opacity-50">Lts Pendientes por Cargar</span>
		 									 </div>
		 								 </div><!--end .card-body -->
		 							 </div><!--end .card -->
		 						 </div><!--end .col -->
		 					 </div>

							<!-- BEGIN LAYOUT LEFT ALIGNED -->
							<div class="col-md-12">
								<div class="card">
									<div class="card-head">
										<ul class="nav nav-tabs" data-toggle="tabs">
											<li class="active"><a href="#first1">Compras</a></li>
											<li><a href="#second1">Mttos</a></li>
											<li><a href="#third1">Gasolineras</a></li>

										</ul>
									</div><!--end .card-head -->
									<div class="card-body tab-content">
										<div class="tab-pane active" id="first1">
							        <div class="row">
												<div class="col-md-12">
													<div class="card-body style-default-bright table-responsive">
														 <?php
									                     $filtrofecha4='';

																			 if ($fecha1 != '' AND $fecha2 !='') {
																			 $filtrofecha4 ="AND cpr.fecha BETWEEN '$fecha1' AND '$fecha2'";
																		 		}
																			  require 'include/connect.php';
																				error_reporting(E_ALL); //muestra todos los errores encontrados en la página
																			  $sql = "SELECT cpr.*, prov.nombre AS provNombre
																								FROM compras cpr
																								LEFT JOIN proveedores prov ON cpr.idProveedor = prov.id
																								WHERE 1=1 $filtrofecha4
																								ORDER BY cpr.doctoComprobante, cpr.doctoFactura, cpr.fecha ASC
																								";
							                     		 		$res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>'.mysqli_error($link));
														 ?>
														 <table class="table table-striped table-hover laTabla">
																<thead>
																		<tr>
																			<th class="sort-numeric">#</th>
																			<th class="sort-alpha">Nombre</th>
																			<th class="text-center">Folio</th>
																			<th class="text-center">Fecha</th>
																			<th class="col-sm-2 text-center">Comprobante o Factura</th>
																			<th class="col-sm-2 text-center">Monto</th>

																		</tr>
																</thead>
																<tbody>
														 				<?php
                        								  while ($dato = mysqli_fetch_array($res)) {
																						if ($dato['doctoFactura'] == '' && $dato['doctoComprobante'] == '') {
																							$btnDoctoCompra = '<button type="button" disabled class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
																						}else {
																							$btnDoctoCompra = '<button type="button" onclick="verPDFCompra('.$dato['id'].')" data-toggle="modal" data-target="#verPDF" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
																						}
																						$compraColorText = ($dato['doctoComprobante'] == '' && $dato['doctoFactura'] == '0') ? 'text-danger' : 'text-success' ;
																						$compraColor = ($dato['doctoComprobante'] == '' && $dato['doctoFactura'] == '0') ? 'danger' : 'success' ;
																						echo '
																						<tr class="'.$compraColor.' '.$compraColorText.'">
                            								  <td> '.$dato['id'].' </td>
                            							      <td> '.$dato['provNombre'].'</td>
                            							      <td class="text-center"> '.$dato['folio'].'</td>
                            						        <td class="text-center"> '.$dato['fecha'].'</td>
                               								  <td class="col-sm-2 text-center">
                            								  		<button type="button" class="btn btn-icon-toggle text-center" onclick="formCargaFactura('.$dato['id'].',11)" data-toggle="modal" data-target="#formCargaFactura"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Carga Docto"></i></button>
																									'.$btnDoctoCompra.'
																								</td>
                            								  	<td class="col-sm-2 text-center"> '.$dato['monto'].'</td>

                           								 </tr>
                           								 ';
                          								}

                          								?>
																</tbody>
															</table>
														</div>
													</div><!--end .card -->
												</div><!--end .col -->
											</div>
										<div class="tab-pane" id="second1">
						        	<div class="row">
												<div class="col-md-12">
													<div class="card-body style-default-bright table-responsive">
														 <?php

					                     $filtrofecha5='';
															 if ($fecha1 != '' AND $fecha2 !='') {
																$filtrofecha5 ="AND mtto.fechaReg BETWEEN '$fecha1' AND '$fecha2'";
																}
															  require 'include/connect.php';
															  $sql = "SELECT mtto.*, ctmtto.nombre AS n1, ctsrvmtto.nombre AS n2, mtto.id AS idMtto
																				FROM mttos mtto
																				LEFT JOIN cattipomttos ctmtto ON ctmtto.id = mtto.idCatTipoMtto
																				LEFT JOIN catserviciosmttos ctsrvmtto ON ctsrvmtto.id = mtto.idServicioMtto
																				WHERE 1=1 $filtrofecha5
																				ORDER BY mtto.idFactura,mtto.fechaReg ASC";
			                     		 $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>');
													 	?>
														<table class="table table-striped table-hover laTabla">
															<thead>
																<tr>
																	<th class="sort-numeric">#</th>
																	<th class="sort-alpha">Nombre</th>
																	<th class="text-center">Descripcion</th>
																	<th class="text-center">Fecha</th>
																	<th class="col-sm-2 text-center">Docto Comprobante o Factura</th>
																	<th class="col-sm-2 text-center">Monto</th>

																</tr>
															</thead>
															<tbody>
															 	<?php
	              								  while ($data = mysqli_fetch_array($res)) {
																		if ($data['idFactura'] == '') {
																			$btnDoctoMtto = '<button type="button" disabled class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
																		}else {
																			$btnDoctoMtto = '<button type="button" onclick="verPDFMttos('.$data['id'].')" data-toggle="modal" data-target="#verPDF" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
																		}
																		$mttoColorText = ($data['idFactura'] == '') ? 'text-danger' : 'text-success' ;
 																	  $mttoColor = ($data['idFactura'] == '') ? 'danger' : 'success' ;
 																	echo '
 																	 <tr class="'.$mttoColor.' '.$mttoColorText.'">
	                  								  <td> '.$data['idMtto'].' </td>
	                  							      <td> '.$data['n1'].'/'.$data['n1'].'</td>
	                  							      <td class="text-center"> '.$data['descripcion'].'</td>
	                  						          <td class="text-center"> '.$data['fechaReg'].'</td>
	                     								  <td class="col-sm-2 text-center">
	                  								  <button type="button" class="btn btn-icon-toggle text-center" onclick="formCargaFactura('.$data['idMtto'].',6)" data-toggle="modal" data-target="#formCargaFactura"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Carga Docto"></i></button>
																			'.$btnDoctoMtto.'
																			</td>
	                  								  <td class="col-sm-2 text-center"> '.$data['monto'].'</td>

	                 								 </tr>
	                 								 ';
	                								}

	                          		?>
															</tbody>
														</table>
													</div>
												</div><!--end .card -->
											</div><!--end .col -->
										</div>
										<div class="tab-pane" id="third1">

										  <div class="row">
												<div class="col-md-12">
													<div class="card-body style-default-bright table-responsive">
												 		<?php
							                 $filtrofecha6='';
															 if ($fecha1 != '' AND $fecha2 !='') {
																 $filtrofecha6 ="AND carco.fechaReg BETWEEN '$fecha1' AND '$fecha2'";
															 }
															  require 'include/connect.php';
															  $sql = "SELECT carco.*, gas.nombre AS nomGasolinera, catco.nombre AS nomCombustible, ces.nombre AS nomEstado, cmu.nombre AS nomMun,
																carco.id AS idGas, CONCAT('ECO - ',ve.noEconomico,' PLACAS: ',ve.placas,' (',ope.nombre,' ',ope.apellidos,')') AS vehiculo, fact.urlPDF AS dPDF, fct.doctoComprobante AS DComprobante
																FROM cargacombustible carco
																LEFT JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
																LEFT JOIN gasolineras gas ON carco.idGasolinera = gas.id
																LEFT JOIN catestados ces ON gas.idCatEstado = ces.id
																LEFT JOIN catmunicipios cmu ON gas.idCatMunicipio = cmu.id
																INNER JOIN viajes vjs ON vjs.id = carco.idViaje
																INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
																INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
																INNER JOIN operadores ope ON ope.id = asgv.idOperador
																LEFT JOIN facturas fact ON fact.id = carco.idFactura
																LEFT JOIN facturas fct ON fct.id = carco.idFactura
																WHERE 1=1 $filtrofecha6 $filtroGas
																ORDER BY carco.doctoComprobante,carco.idFactura,carco.fechaReg ASC";

			                     		 	$res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>');
												 			?>
													<table class="table table-striped table-hover laTabla">
														<thead>
															<tr>
																<th class="sort-numeric">#</th>
																<th class="sort-alpha">Gasolinera</th>
																<th class="text-center">Lugar</th>
																<th class="text-center">Tipo de Combustible</th>
																<th class="text-center">Fecha</th>
																<th class="text-center">Vehículo</th>
																<th class="col-sm-2 text-center">Docto Factura</th>
																<th class="col-sm-2 text-center">Monto</th>
																<th class="col-sm-2 text-center">Litros</th>
															</tr>
														</thead>
														<tbody>
															 <?php
															 			$tvCombustible = 0;
		              								  while ($dat = mysqli_fetch_array($res)) {
																			$PDF = ($dat['dPDF']) ? $dat['dPDF'] : $dat['DComprobante'] ;
																			if ($PDF == '') {
																				$btnDoctoGas = '<button type="button" disabled class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
																			}else {
																				$btnDoctoGas = '<button type="button" onclick="verPDFGas('.$dat['id'].')" data-toggle="modal" data-target="#verPDF" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
																			}
																			if ($dat['doctoComprobante'] == '' && $dat['idFactura'] < '') {  			 $vlor = 1; }
																			elseif ($dat['doctoComprobante'] == '' && $dat['idFactura'] < 1) {  	 $vlor = 1;  }
																			else {	$vlor = 2;	}

																				$colorText = ($vlor == 1) ? 'text-danger' : 'text-success' ;
																				$color = ($vlor == 1) ? 'danger' : 'success' ;
		                   								 echo '
		                    								<tr class="'.$color.' '.$colorText.'">
		                    								  <td> '.$dat['idGas'].' </td>
		                    							      <td> '.$dat['nomGasolinera'].'</td>
																						<td class="text-center"> '.$dat['nomEstado'].'/'.$dat['nomMun'].'</td>
		                    							      <td class="text-center"> '.$dat['nomCombustible'].'</td>
		                   						          <td class="text-center"> '.$dat['fechaReg'].'</td>
																						<td> '.$dat['vehiculo'].'</td>
																						<td class="col-sm-2 text-center">
		                    								  		<button type="button" class="btn btn-icon-toggle text-center" onclick="formCargaFactura('.$dat['idGas'].',10)" data-toggle="modal" data-target="#formCargaFactura"><i class="fa fa-pencil text-center" data-toggle="tooltip" data-placement="top" data-original-title="Carga Docto"></i></button>
																							'.$btnDoctoGas.'
																							</td>
		                    								  	<td class="col-sm-2 text-center"> '.$dat['monto'].'</td>
																						<td class="col-sm-2 text-center"> '.$dat['cant'].'</td>
		                   								 </tr>
		                   								 ';
																			 $tvCombustible += $dat['cant'];
		                  								}

                								?>
														</tbody>
													</table>
												</div>
											</div><!--end .card -->
											<div class="col-md-offset-4 col-md-4 col-sm-4">
												<div class="card">
													<div class="card-body no-padding">
														<div class="primary primary-callout alert-primary no-margin">
															<h1 class="pull-right text-accent"><i class="md md-local-gas-station">&nbsp;&nbsp;</i></h1>
															<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp; <?=$tvCombustible;?> Lts.</strong><br/>
															<span class="opacity-50">&nbsp;&nbsp;Lts. por Pagar</span>
														</div>
													</div><!--end .card-body -->
												</div><!--end .card -->
											</div><!--end .col -->
										</div><!--end .col -->
									</div>
								</div>
							</div><!--end .card-body -->
						</div><!--end .card -->
					</div><!--end .col En sí es un ROW-->
							<!-- END LAYOUT LEFT ALIGNED -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->


			<div class="modal fade" id="formCargaFactura" tabindex="-1" role="dialog" aria-labelledby="formCargaFacturaLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="CargaFacturaContent">
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<!-- BEGIN SIMPLE MODAL MARKUP -->
			<div class="modal fade" id="verPDF" tabindex="-1" role="dialog" aria-labelledby="verPDFLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="verContentPDF">
						<div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					          <h4 class="modal-title" id="verPDFTitle">Factura</h4>
					        </div>
					        <div class="modal-body" id="verPDFBody">
										...
					        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        </div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- END SIMPLE MODAL MARKUP -->





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
		<script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
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
		<script src="assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/js/core/source/AppVendor.js"></script>
		<script src="assets/js/core/demo/Demo.js"></script>
		<script src="assets/js/core/demo/DemoTableDynamic.js"></script>
		<script src="assets/js/core/demo/DemoFormComponents.js"></script>
		<script src="assets/js/libs/fileInput/fileinput.js"></script>
		<script src="assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="assets/js/libs/toastr/toastr.js"></script>
		<script src="assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="assets/js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.es.js"></script>

		<script>
		$(document).ready(function(){
			$('.txtPopOver').popover('show');

			$('#rangoFechas').datepicker({
				todayHighlight: true,
				format: "yyyy-mm-dd",
				language: "es"
			});

		});

			$('.laTabla').DataTable({
				"dom": 'lCfrtip',
				"order": [],
				"colVis": {
					"buttonText": "Columns",
					"overlayFade": 0,
					"align": "right"
				},
				"language": {
					"lengthMenu": '_MENU_ entries per page',
					"search": '<i class="fa fa-search"></i>',
					"paginate": {
						"previous": '<i class="fa fa-angle-left"></i>',
						"next": '<i class="fa fa-angle-right"></i>'
					}
				}
			});

			<?php
			if (isset( $_SESSION['ATZmsjAuxiliarfacturasPendientes'])) {
				echo "notificaBad('".$_SESSION['ATZmsjAuxiliarfacturasPendientes']."');";
				unset($_SESSION['ATZmsjAuxiliarfacturasPendientes']);
			}
			if (isset( $_SESSION['ATZmsjSuccesAuxiliarfacturasPendientes'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesAuxiliarfacturasPendientes']."');";
				unset($_SESSION['ATZmsjSuccesAuxiliarfacturasPendientes']);
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

					function formCargaFactura(ident,tabla){
					$("#CargaFacturaBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
					//alert('ID: '+ident);
					  $.post("funciones/formCargaFactura.php",
						{ ident:ident,tabla:tabla},
							function(respuesta){
							$("#CargaFacturaContent").html(respuesta);
						});
					}

				    $(".docto").fileinput({
				      showUpload: false,
				      showCaption: false,
				      language: 'es',
				      maxFileSize: 5120,
				      maxFilesNum: 1,
				      browseClass: "btn btn-primary btn-lg",
				      fileType: "any",
				      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
				    });

			      $(".xml").fileinput({
			      showUpload: false,
			      showCaption: false,
			      language: 'es',
			      allowedFileExtensions : ['jpg', 'jpeg'],
			      maxFileSize: 5120,
			      maxFilesNum: 1,
			      browseClass: "btn btn-primary btn-lg",
			      fileType: "any"
				 		});

						function verPDFGas(ident){
							//alert('Ident: '+ident);
							$.post("funciones/verPDF-Gasolineras.php",
						 { ident:ident},
							 function(respuesta){
							 $("#verContentPDF").html(respuesta);
						 });
						}

						function verPDFMttos(ident){
							//alert('Ident: '+ident);
							$.post("funciones/verPDF-Mttos.php",
						 { ident:ident},
							 function(respuesta){
							 $("#verContentPDF").html(respuesta);
						 });
						}

						function verPDFCompra(ident){
							//alert('Ident: '+ident);
							$.post("funciones/verPDF-Compras.php",
						 { ident:ident},
							 function(respuesta){
							 $("#verContentPDF").html(respuesta);
						 });
						}

		</script>
		<!-- END JAVASCRIPT -->


	</body>
</html>
