	<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('utilidad.php');
require '../include/connect.php';
require_once('../funciones/notificaAdmin.php');

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title><?=$info->nombrePag;?></title>

		<!-- BEGIN META -->
		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->

		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/bootstrap.css?1422792965" />
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
	             <header class="text-primary"> Busqueda por: </header>
	            </div><!--end .card-head -->
	            <div class="card-body">
                <?php
                $fecha1 = (isset($_POST['fStart']) AND $_POST['fStart'] != '') ? $_POST['fStart'] : '' ;
                $fecha2 = (isset($_POST['fEnd']) AND $_POST['fEnd'] != '') ? $_POST['fEnd'] : '' ;
								$cliente = (isset($_POST['cliente']) AND $_POST['cliente'] != '') ? $_POST['cliente'] : '' ;
								$operador = (isset($_POST['operador']) AND $_POST['operador'] != '') ? $_POST['operador'] : '' ;

                ?>
                <div class="rows">
	               <form class="form" method="post" action="utilidad.php">
	                <div class="col-lg-offset-1 col-lg-4">
	                 <div class="form-group">
	                  <div class="input-daterange input-group" id="rangoFechas">
	                   <div class="input-group-content">
	                    	<input type="text" class="form-control fechado" name="fStart" autocomplete="off" value="<?=$fecha1;?>"/>
	                      <label>Rango de Fechas</label>
	                   </div>
	                   <span class="input-group-addon">hasta</span>
	                   <div class="input-group-content">
	                      <input type="text" class="form-control fechado" name="fEnd"  autocomplete="off" value="<?=$fecha2;?>"/>
	                   		<div class="form-control-line"></div>
                     </div>
                    </div>
                   </div>
                  </div>
									<div class="col-md-2">
	                    <?php
											error_reporting(E_ALL);
	                    require('../include/connect.php');
	                    $sqlCli = "SELECT * FROM clientes WHERE estatus = '1'";
	                    $resCli = mysqli_query($link, $sqlCli) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
	                    ?>
	                        <div class="form-group">
	                        <select name="cliente" class="form-control select2-list" data-placeholder="Select an item">
	                          <option value=''>Todos los Clientes</option>
	                          <optgroup label="Clientes">
	                            <?php
	                            while ($datCli = mysqli_fetch_array($resCli)) {
	                              $activeCli = ($cliente == $datCli['id']) ? 'selected' : '' ;
	                              echo '<option value="'.$datCli['id'].'" '.$activeCli.'> '.$datCli['nombre'].'</option>';
	                            }
	                            ?>
	                          </optgroup>
	                          </select>
	                        <label>Seleccione Cliente</label>
	                      </div>
	                    </div>
											<div class="col-md-2">
			                    <?php
			                    require('../include/connect.php');
			                    $sqlOpe = "SELECT op.id, CONCAT(op.nombre,' ',op.apellidos,' (Eco ',ve.noEconomico,', Placas: ',ve.placas,')') AS nomCompleto
																			FROM operadores op
																			INNER JOIN asignavehiculos asgv ON asgv.idOperador = op.id
																			INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
																			WHERE op.estatus = '1'";
			                    $resOpe = mysqli_query($link, $sqlOpe) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
			                    ?>
			                        <div class="form-group">
			                        <select name="operador" class="form-control select2-list" data-placeholder="Select an item">
			                          <option value=''>Todos los Operadores</option>
			                          <optgroup label="Operadores">
			                            <?php
			                            while ($datOpe = mysqli_fetch_array($resOpe)) {
			                              $activeOpe = ($operador == $datOpe['id']) ? 'selected' : '' ;
			                              echo '<option value="'.$datOpe['id'].'" '.$activeOpe.'> '.$datOpe['nomCompleto'].' </option>';
			                            }
			                            ?>
			                          </optgroup>
			                          </select>
			                        <label>Seleccione Operador</label>
			                      </div>
			                    </div>

	                <div class="col-md-offset-1 col-lg-2">
	                	<div class="btn-group text-center" data-toggle="tooltip" data-placement="top" data-original-title="aplicar ">
	                     <button type="submit"  class=" text-raigth btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class='fa fa-spinner fa-spin'></i> --</center>">Aplicar</button>
	                  </div>
									</div>
	               </form>
	              </div><!--end .card-body -->
              </div><!--end .card -->
             </div><!--end .col -->
					  </div>
				 	 </div>
					 <div class="row">
						 <div class="col-md-4 col-sm-7">
							 <div class="card">
								 <div class="card-body no-padding">
									 <div class="alert alert-callout alert-info no-margin">
										 <h1 class="pull-right text-info"><i class="md md-trending-up"></i></h1>
										 <strong class="text-xl"  id="sVentas">------</strong><br/>
										 <span class="opacity-50">Suma de las Ventas en el Periodo Seleccionado</span>
									 </div>
								 </div><!--end .card-body -->
							 </div><!--end .card -->
						 </div><!--end .col -->

						 <div class="col-md-4 col-sm-7">
							 <div class="card">
								 <div class="card-body no-padding">
									 <div class="alert alert-callout alert-warning no-margin">
										 <h1 class="pull-right text-warning"><i class="md md-trending-down"></i></h1>
										 <strong class="text-xl"  id="sGastos">------</strong><br/>
										 <span class="opacity-50">Suma de los Gastos en el Periodo Seleccionado</span>
									 </div>
								 </div><!--end .card-body -->
							 </div><!--end .card -->
						 </div><!--end .col -->

						 <div class="col-md-4 col-sm-7">
							 <div class="card">
								 <div class="card-body no-padding">
									 <div class="alert alert-callout alert-success no-margin">
										 <h1 class="pull-right text-success"><i class="fa fa-money"></i></h1>
										 <strong class="text-xl" id="sUtilidad">------</strong><br/>
										 <span class="opacity-50">Utilidad en el Periodo Seleccionado</span>
									 </div>
								 </div><!--end .card-body -->
							 </div><!--end .card -->
						 </div><!--end .col -->
					 </div>

						<div class="row">
	 						<div class="col-md-12">
	 							<div class="card card-bordered style-primary">
	 								<div class="card-head">
	 										<div class="tools">
	 											<div class="btn-group">
	 												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
	 											</div>
	 										</div>
	 										<header><i class="fa fa-usd"></i>&nbsp;<i class="fa fa-truck"></i> &nbsp;Viajes</header>
	 								</div><!--end .card-head -->
	 								<div class="card-body style-default-bright">

										<?php
										$filtrofecha ='AND MONTH(vnt.fechaEntrega) = MONTH(now())';
										if ($fecha1 != '' AND $fecha2 !='') {
											$filtrofecha = " AND vnt.fechaCarga BETWEEN '$fecha1' AND '$fecha2'";
											}

											$filtroCliente = ($cliente != '') ? " AND vnt.idCliente = '$cliente'" : '' ;


											$filtroOperador = ($operador != '') ? " AND op.id = '$operador'" : '' ;

											require('../include/connect.php');
											error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											$sql="SELECT vnt.id, ru.destino1 AS d1, ru.destino2 AS d2, ru.destino3 AS d3, vnt.fechaEntrega AS fecha,
														ve.noEconomico AS noEco, op.nombre AS operador, gst.monto AS gastos, crg.monto AS combustible, vnt.monto AS pVenta, vnt.casetas, cli.nombre AS nomCliente
														from ventas vnt
														INNER JOIN viajes vjs ON vjs.idVenta = vnt.id
														LEFT JOIN gastosextra gst ON gst.idViaje = vjs.id
														LEFT JOIN cargacombustible crg ON crg.idViaje = vjs.id
														INNER JOIN rutas ru ON ru.id = vnt.idRuta
														INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
														INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
														INNER JOIN operadores op ON op.id = asgv.idOperador
														LEFT JOIN clientes cli ON cli.id = vnt.idCliente
														WHERE vnt.estatusPago = '2' $filtrofecha $filtroCliente $filtroOperador
														ORDER BY vnt.fechaEntrega,vnt.id ASC";
												$res = mysqli_query($link,$sql) or die('Lo Sentimos, Error al Consultar, Notifica al Administrador');
										 ?>
										<div class="row">
											<div class="col-md-offset-1 col-md-10">
		 										<table id="datatable1" class="table table-striped table-hover">
		 											<thead>
		 												<tr>
		 													<th>#</th>
		 													<th>Viaje</th>
															<th>Cliente</th>
		 													<th class="text-center">Casetas</th>
		 													<th class="text-center">Pagos Extras</th>
		 													<th class="text-center">Combustible</th>
		 													<th class="text-center">Precio de la venta</th>
		 													<th class="text-center">Costo total del viaje</th>
		 													<th class="text-center">Utilidad</th>
		 												</tr>
		 											</thead>
		 											<tbody>
														<?php
														$tvVenta = 0;
														$tvcasetas = 0;
														$tvgastos = 0;
														$tvcombustible = 0;
														$tvUtil= 0;
														$vutil = 0;
														$vgastos = 0;
														while($viaje = mysqli_fetch_array($res)){
															$d1 = substr($viaje['d1'],0,3);
															$d2 = substr($viaje['d2'],0,3);
															$d3 = substr($viaje['d3'],0,3);
															$ruta = ($d3 == '') ? $d1.'/'.$d2 : $d1.'/'.$d2.'/'.$d3 ;
															$vcomb = ($viaje['combustible'] == '') ? '0' : $viaje['combustible'] ;
															$vcasetas = ($viaje['casetas'] == '') ? '0' : $viaje['casetas'] ;
															$vpventa = ($viaje['pVenta'] == '') ? '0' : $viaje['pVenta'] ;
															$vgast = ($viaje['gastos'] == '') ? '0' : $viaje['gastos'] ;
															$vutil = $viaje['pVenta'] - ($vcasetas + $vcomb + $vgast);
															$vgastos = ($vcasetas + $vcomb + $vgast);
															echo '<tr>
						 													<td>'.$viaje['id'].'</td>
																			<td>'.$ruta.' '.$viaje['fecha'].' (Eco - '.$viaje['noEco'].' Operador:'.$viaje['operador'].')</td>
																			<td>'.$viaje['nomCliente'].'</td>
																			<td class="text-center">'.$vcasetas.'</td>
																			<td class="text-center">'.$vgast.'</td>
																			<td class="text-center">'.$vcomb.'</td>
																			<td class="text-center">'.$vpventa.'</td>
																			<td class="text-center">'.$vgastos.'</td>
																			<td class="text-center">'.$vutil.'</td>
						 												</tr>';
																		$tvcombustible += $vcomb;
																		$tvVenta += $vpventa;
																		$tvUtil += $vutil;
																		$tvgastos += $vgastos;
																		$tvcasetas += $vcasetas;
															}
														?>
		 											</tbody>
		 										</table>
											</div>
	 									</div>
										<div class="row">
											<div class="col-md-1"></div>
												<div class="col-md-2 col-sm-2">
		 											<div class="card">
		 												<div class="card-body no-padding">
		 													<div class="warning alert-callout  no-margin">
		 														<h1 class="pull-right text-warning"><i class="fa fa-ticket">&nbsp;&nbsp;</i></h1>
		 														<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp;$ <?=number_format($tvcasetas, 2, '.', ',');?></strong><br/>
		 														<span class="opacity-50">&nbsp;&nbsp;Gasto en Casetas</span>
		 													</div>
		 												</div><!--end .card-body -->
		 											</div><!--end .card -->
		 										</div><!--end .col -->
												<div class="col-md-2 col-sm-2">
		 											<div class="card">
		 												<div class="card-body no-padding">
		 													<div class="accent accent-callout alert-accent no-margin">
		 														<h1 class="pull-right text-dark-light"><i class="fa fa-road">&nbsp;&nbsp;</i></h1>
		 														<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp;$ <?=number_format($tvgastos, 2, '.', ',');?></strong><br/>
		 														<span class="opacity-50">&nbsp;&nbsp;Gasto en viajes</span>
		 													</div>
		 												</div><!--end .card-body -->
		 											</div><!--end .card -->
		 										</div><!--end .col -->

												<div class="col-md-2 col-sm-2">
		 											<div class="card">
		 												<div class="card-body no-padding">
		 													<div class="primary primary-callout alert-primary no-margin">
		 														<h1 class="pull-right text-accent"><i class="md md-local-gas-station">&nbsp;&nbsp;</i></h1>
		 														<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp;$ <?=number_format($tvcombustible, 2, '.', ',');?></strong><br/>
		 														<span class="opacity-50">&nbsp;&nbsp;Gasto en Combustibles</span>
		 													</div>
		 												</div><!--end .card-body -->
		 											</div><!--end .card -->
		 										</div><!--end .col -->

												<div class="col-md-2 col-sm-2">
		 											<div class="card">
		 												<div class="card-body no-padding">
		 													<div class="dark dark-callout alert-dark no-margin">
		 														<h1 class="pull-right text-success"><i class="fa fa-usd">&nbsp;&nbsp;</i></h1>
		 														<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp;$ <?=number_format($tvVenta, 2, '.', ',');?></strong><br/>
		 														<span class="opacity-50">&nbsp;&nbsp;Ganancia en Ventas</span>
		 													</div>
		 												</div><!--end .card-body -->
		 											</div><!--end .card -->
		 										</div><!--end .col -->

												<div class="col-md-2 col-sm-2">
													<div class="card">
														<div class="card-body no-padding">
															<div class="success success-callout alert-success no-margin">
																<h1 class="pull-right text-success"><i class="fa fa-money">&nbsp;&nbsp;</i></h1>
																<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp;$ <?=number_format($tvUtil, 2, '.', ',');?></strong><br/>
																<span class="opacity-50">&nbsp;&nbsp;Utilidad</span>
															</div>
														</div><!--end .card-body -->
													</div><!--end .card -->
												</div><!--end .col -->
												<div class="col-md-1"></div>
										</div>


	 								</div><!--end .card -->
	 							</div><!--end .col -->
	 						</div><!--end .card -->
	 					</div><!--end .col -->

						<div class="row">
							<div class="col-md-12">
								<div class="card card-bordered style-primary">
									<div class="card-head">
											<div class="tools">
												<div class="btn-group">
													<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
												</div>
											</div>
											<header><i class="fa fa-usd"></i>&nbsp;<i class="fa fa-stack-overflow"></i> Gastos Generales</header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright">
										<?php
											require('../include/connect.php');
											error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											$filtrofecha='AND MONTH(gsts.fechaReg) = MONTH(now())';
											if ($fecha1 != '' AND $fecha2 !='') {
												$filtrofecha = "AND gsts.fechaReg BETWEEN '$fecha1' AND '$fecha2'";
												}
											$sql2="SELECT gsts.id,gsts.descripcion,gsts.tipo,gsts.punto,gsts.monto,CONCAT(usu.nombre,' ',usu.apellidos) AS nomUsu
															FROM gastosextra gsts
															INNER JOIN segusuarios usu ON usu.id = gsts.idUserReg
															INNER JOIN viajes vjs ON vjs.id = gsts.idViaje
															INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
															INNER JOIN operadores op ON op.id = asgv.idOperador
															WHERE gsts.idViaje = '' $filtrofecha $filtroOperador
															ORDER BY gsts.id ASC";
												$res2 = mysqli_query($link,$sql2) or die('Lo Sentimos, Error al Consultar, Notifica al Administrador');
										 ?>
										<div class="row col-md-offset-1 col-md-10">
	 										<table id="datatable1" class="table table-striped table-hover">
	 											<thead>
	 												<tr>
	 													<th>#</th>
	 													<th>Descripción</th>
	 													<th>Tipo</th>
	 													<th>Establecimiento</th>
														<th class="text-center">Importe</th>
	 													<th>Registró</th>
	 												</tr>
	 											</thead>
	 											<tbody>
													<?php
													$totalGastos = 0;
													while($gasto = mysqli_fetch_array($res2)){
														$tipo = ($gasto['tipo'] == 1) ? 'Gasto' : 'Pago' ;
														$lugar = ($gasto['punto'] == '') ? 'S/R' : $gasto['punto'] ;
														$desc = ($gasto['descripcion'] == '') ? 'S/R' : $gasto['descripcion'] ;
														$montoGastos = ($gasto['monto'] == 0) ? '0' : $gasto['monto'] ;
														echo '<tr>
					 													<td>'.$gasto['id'].'</td>
																		<td>'.$desc.'</td>
																		<td>'.$tipo.'</td>
																		<td>'.$lugar.'</td>
																		<td class="text-center">'.$montoGastos.'</td>
																		<td>'.$gasto['nomUsu'].'</td>
					 												</tr>';

																	$totalGastos += $montoGastos;
														}
													?>
	 											</tbody>
	 										</table>
	 									</div>
										<div class="row">
											<div class="col-md-4"></div>
											<div class="col-md-4 col-sm-4">
												<div class="card">
													<div class="card-body no-padding">
														<div class="warning alert-callout  no-margin">
															<h1 class="pull-right text-warning"><i class="md md-shop-two">&nbsp;&nbsp;</i></h1>
															<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp;$ <?=number_format($totalGastos, 2, '.', ',');?></strong><br/>
															<span class="opacity-50">&nbsp;&nbsp;Total de Gastos</span>
														</div>
													</div><!--end .card-body -->
												</div><!--end .card -->
											</div><!--end .col -->
										</div>
									</div>
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .card -->
						<div class="row">
							<div class="col-md-12">
								<div class="card card-bordered style-primary">
									<div class="card-head">
											<div class="tools">
												<div class="btn-group">
													<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
												</div>
											</div>
											<header><i class="fa fa-cart-plus"></i> Compras</header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright">
										<?php
											require('../include/connect.php');
											error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											$filtrofecha='AND MONTH(cmp.fecha) = MONTH(now())';
											if ($fecha1 != '' AND $fecha2 !='') {
												$filtrofecha = "AND cmp.fecha BETWEEN '$fecha1' AND '$fecha2'";
												}
											$sql4 ="SELECT cmp.id,cmp.folio,cmp.descripcion,COUNT(stk.idCompra) as cantidad,cmp.fechaCompra,cmp.total
															FROM compras cmp
															LEFT JOIN stocks stk ON stk.idCompra= cmp.id
															LEFT JOIN productos pro ON pro.id = stk.idProducto
															WHERE 1=1 $filtrofecha
															GROUP BY cmp.id
															ORDER BY cmp.id DESC";
												$res4 = mysqli_query($link,$sql4) or die('Lo Sentimos, Error al Consultar, Notifica al Administrador');
										 ?>
										<div class="row col-md-offset-1 col-md-10">
											<table id="datatable1" class="table table-striped table-hover">
												<thead>
													<tr>
														<th class="text-center">#</th>
														<th class="text-center">Folio</th>
														<th>Descripción</th>
														<th class="text-center">Costo</th>
														<th class="text-center">Cantidad de Artículos</th>
														<th class="text-center">Acciones</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$totalCompras = 0;
													$totalArticulos = 0;
													while($datos = mysqli_fetch_array($res4)){
														$desc3 = ($datos['descripcion'] == '') ? 'S/R' : $datos['descripcion'] ;
														$montoCompra = ($datos['total'] == 0) ? '0' : $datos['total'] ;
														echo '<tr>
																		<td class="text-center">'.$datos['id'].'</td>
																		<td class="text-center">'.$datos['folio'].'</td>
																		<td>'.$desc3.'</td>
																		<td class="text-center">'.$montoCompra.'</td>
																		<td class="text-center">'.$datos['cantidad'].'</td>
																		<td class="text-center">
																			<button type="button" class="btn btn-icon-toggle" onclick="muestraListadoCompras('.$datos['id'].')" data-toggle="modal" data-target="#formImprimeCompras"><i class="fa fa-bars" data-original-title="Mostrar Mantenimiento"></i></button>
																		</td>
																	</tr>';
																	$totalCompras += $montoCompra;
																	$totalArticulos += $datos['cantidad'];
																	#<button type="button" class="btn btn-icon-toggle" onclick="muestraListadoCompras('.$datos['id'].')" data-toggle="modal" data-target="#formImprimeCompras"><i class="fa fa-bars" data-original-title="Mostrar compras"></i></button>
														}
													?>
												</tbody>
											</table>
										</div>
										<div class="row">
											<div class="col-md-2"></div>
											<div class="col-md-4 col-sm-4">
												<div class="card">
													<div class="card-body no-padding">
														<div class="danger danger-callout alert-danger no-margin">
															<h1 class="pull-right text-danger-light"><i class="fa fa-cart-plus">&nbsp;&nbsp;</i></h1>
															<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp;$ <?=number_format($totalCompras, 2, '.', ',');?></strong><br/>
															<span class="opacity-50">&nbsp;&nbsp;Total de Compras</span>
														</div>
													</div><!--end .card-body -->
												</div><!--end .card -->
											</div><!--end .col -->
											<div class="col-md-4 col-sm-4">
												<div class="card">
													<div class="card-body no-padding">
														<div class="info info-callout alert-info no-margin">
															<h1 class="pull-right text-info"><i class="fa fa-cubes">&nbsp;&nbsp;</i></h1>
															<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp; <?=number_format($totalArticulos, 2, '.', ',');?></strong><br/>
															<span class="opacity-50">&nbsp;&nbsp;Total de Artículos</span>
														</div>
													</div><!--end .card-body -->
												</div><!--end .card -->
											</div><!--end .col -->
										</div>
									</div>
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .card -->
						<div class="row">
							<div class="col-md-12">
								<div class="card card-bordered style-primary">
									<div class="card-head">
											<div class="tools">
												<div class="btn-group">
													<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
												</div>
											</div>
											<header><i class="fa fa-wrench"></i> Mantenimientos</header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright">
										<?php
											require('../include/connect.php');
											error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											$filtrofecha='AND MONTH(m.fechaEntrega) = MONTH(now())';
											if ($fecha1 != '' AND $fecha2 !='') {
												$filtrofecha = "AND m.fechaEntrega BETWEEN '$fecha1' AND '$fecha2'";
												}
												$filtroOperador = ($operador != '') ? " AND op.id = '$operador'" : '' ;
											$sql3="SELECT m.id, CONCAT('Eco - ',ve.noEconomico,' (',op.nombre,' ',op.apellidos,')') AS nomVe, m.km,m.descripcion,m.monto
															FROM mttos m
															INNER JOIN asignavehiculos asgv ON asgv.id = m.idAsignaVehiculo
															INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
															INNER JOIN operadores op ON op.id = asgv.idOperador
															WHERE 1=1 $filtrofecha $filtroOperador
															ORDER BY m.id DESC";
												$res3 = mysqli_query($link,$sql3) or die('Lo Sentimos, Error al Consultar, Notifica al Administrador');
										 ?>
										<div class="row col-md-offset-1 col-md-10">
											<table id="datatable1" class="table table-striped table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Vehículo</th>
														<th class="text-center">Odometro</th>
														<th>Descripción</th>
														<th class="text-center">Costo</th>
														<th class="text-center">Acciones</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$totalMtto = 0;
													while($dato = mysqli_fetch_array($res3)){
														$montoMtto = ($dato['monto'] == 0) ? '0' : $dato['monto'] ;
														$desc2 = ($dato['descripcion'] == '') ? 'S/R' : $dato['descripcion'] ;
														echo '<tr>
																		<td>'.$dato['id'].'</td>
																		<td>'.$dato['nomVe'].'</td>
																		<td class="text-center">'.$dato['km'].'</td>
																		<td>'.$desc2.'</td>
																		<td class="text-center">'.$montoMtto.'</td>
																		<td class="text-center">
																			<button type="button" class="btn btn-icon-toggle" onclick="muestraListadoMttos('.$dato['id'].')" data-toggle="modal" data-target="#formImprimeMttos"><i class="fa fa-bars" data-original-title="Mostrar Mantenimiento"></i></button>
																		</td>
																	</tr>';

																	$totalMtto += $montoMtto;
														}
													?>
												</tbody>
											</table>
										</div>
										<div class="row">
											<div class="col-md-4"></div>
											<div class="col-md-4 col-sm-4">
												<div class="card">
													<div class="card-body no-padding">
														<div class="warning warning-callout alert-warning no-margin">
															<h1 class="pull-right text-warning"><i class="fa fa-gears">&nbsp;&nbsp;</i></h1>
															<strong class="text-xl">&nbsp;&nbsp;&nbsp;&nbsp;$ <?=number_format($totalMtto, 2, '.', ',');?></strong><br/>
															<span class="opacity-50">&nbsp;&nbsp;Total de Gastos en Mantenimientos</span>
														</div>
													</div><!--end .card-body -->
												</div><!--end .card -->
											</div><!--end .col -->
										</div>
									</div>
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .card -->
						<?php
						$sVentas = $sGastos = $sUtilidad = 0;
						$sVentas = $tvVenta;
						$sGastos = $tvgastos + $totalGastos + $totalCompras + $totalMtto;
						$sUtilidad = $sVentas - $sGastos;
						?>
				</div><!--end .section-body -->
			</section>
		</div><!--end #content-->
			<!-- END CONTENT -->

			<div class="modal fade" id="formImprimeMttos" tabindex="-3" role="dialog" aria-labelledby="formImprimeMttoLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaMttoContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formModalLabel1">Mantenimientos</h4>
						</div>
							<div class="modal-body table-responsive" id="listarMttos">
								Aquí irá la Información de los Mantenimientos
							</div>
					</div>
					<!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="formImprimeCompras" tabindex="-1" role="dialog" aria-labelledby="formImprimeCompraLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaCompraContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formModalLabel1">Compras</h4>
						</div>
							<div class="modal-body table-responsive" id="listarCompras">
								Aquí irá la Información de las Compras
							</div>
					</div>
					<!-- /.modal-content -->
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
		<script src="../assets/js/libs/select2/select2.min.js"></script>
		<script src="../assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
		<script src="../assets/js/libs/summernote/summernote.min.js"></script>
		<script src="../assets/js/libs/multi-select/jquery.multi-select.js"></script>
		<script src="../assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
		<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../assets/js/libs/moment/moment.min.js"></script>
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

			$('#sVentas').html('$ <?=number_format($sVentas, 2, '.', ',');?>');
			$('#sGastos').html('$ <?=number_format($sGastos, 2, '.', ',');?>');
			$('#sUtilidad').html('$ <?=number_format($sUtilidad, 2, '.', ',');?>');
		$('.txtPopOver').popover('show');

		$('#rangoFechas').datepicker({
			todayHighlight: true,
			format: "yyyy-mm-dd",
			language: "es"
		});

				});

			<?php
			if (isset( $_SESSION['ATZmsjEncargadoPolizas'])) {
				echo "notificaBad('".$_SESSION['ATZmsjEncargadoPolizas']."');";
				unset($_SESSION['ATZmsjEncargadoConVentas']);
			}
			if (isset( $_SESSION['ATZmsjSuccesEncargadoPolizas'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesEncargadoPolizas']."');";
				unset($_SESSION['ATZmsjSuccesEncargadoPolizas']);
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

			function muestraListadoCompras(ident){
				$.post("../funciones/listadoDeCompras.php",
					{ ident:ident},
						function(res){
							$("#listarCompras").html(res);
						});
			}

			function muestraListadoMttos(ident){
				$.post("../funciones/listadoDeMttos.php",
					{ ident:ident},
						function(res){
							$("#listarMttos").html(res);
						});
			}

			</script>
	</body>
</html>
