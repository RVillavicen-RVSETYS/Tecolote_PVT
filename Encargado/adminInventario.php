<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('adminInventario.php');
$idUs = $_SESSION['ATZident'];
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/select2/select2.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/material-design-iconic-font.min.css?1421434286" />
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileInput.css" />

    <link rel="shortcut icon" href="../favicon.ico">
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed full-content ">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="index.php">
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
				<section class="has-actions style-default">

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

					<!-- BEGIN INBOX -->
					<div class="section-body">
						<div class="row">

							<div class="card card-outlined style-primary">
								<div class="card-head">
									<div class="tools">
										<div class="btn-group">
											<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
										</div>
									</div>
									<header><i class="md md-add-shopping-cart"></i> Registra Compra de Productos</header>
								</div><!--end .card-head -->
								<div class="card-body">
									<div class="rows">
										<?php
										require('../include/connect.php');
										error_reporting(E_ALL); //muestra todos los errores encontrados en la página
										$sql = "SELECT *
														FROM compras
														WHERE estatus = '1' AND idUserReg = '$idUs'
														ORDER BY id DESC
														LIMIT 1	";
										$reg = mysqli_query($link, $sql) or die('<span class="text-danger"> Hay problemas al cosultar la información de compras, notifica a tu Administrador. </span>');
										$cantReg = mysqli_num_rows($reg);
										$datReg = mysqli_fetch_array($reg);
										$disabled = '';
										if ($cantReg >= 1) {
											$disabled = 'disabled';
										}
										?>
										<form class="form" method="post" action="../funciones/registraNuevaCompraProductos.php">
											<div class="col-lg-2  col-lg-offset-1">
												<div class="form-group">
													<div class="input-group date" id="demo-date-format">
														<div class="input-group-content">
															<input type="text" class="form-control fechado" name="fechaCompra" id="fechaCompra" autocomplete="off" <?='value="'.$datReg['fechaCompra'].'" '.$disabled;?> >
															<label>Fecha de Adquisición</label>
															<p class="help-block">yyyy/mm/dd</p>
														</div>
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
													</div>
												</div><!--end .form-group -->
											</div>

											<div class="col-lg-3">
												<div class="form-group">
													<?php
													$sql = "SELECT * FROM proveedores WHERE estatus = '1' ORDER BY nombre ASC";
													$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
													?>
													<select id="idProveedorCpa" name="idProveedorCpa" class="form-control" <?=$disabled;?> >

														<?php
														echo '<option value=""></option>';
														while ($dat = mysqli_fetch_array($res)) {
															$select = ($dat['id'] == $datReg['idProveedor']) ? 'selected' : '';
															echo '<option value="'.$dat['id'].'" '.$select.'> '.$dat['nombre'].'</option>';
														}
														?>
													</select>
													<label for="estatus">Selecciona el Proveedor</label>
												</div>
											</div>

											<div class="col-lg-1">
												<div class="form-group">
													<select id="formaPago" name="formaPago" class="form-control" <?=$disabled;?> >
														<option value=""></option>
														<option value="Cheque" <?=('Cheque' == $datReg['formaPago']) ? 'selected' :''; ?> > Cheque</option>
														<option value="Efectivo" <?=('Efectivo' == $datReg['formaPago']) ? 'selected' :''; ?> > Efectivo</option>
														<option value="Tarjeta" <?=('Tarjeta' == $datReg['formaPago']) ? 'selected' :''; ?> > Tarjeta</option>
														<option value="Transferencia" <?=('Transferencia' == $datReg['formaPago']) ? 'selected' :''; ?> > Transferencia</option>
													</select>
													<label for="estatus">Forma de Pago</label>
												</div>
											</div>

											<div class="col-lg-1">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-content">
															<input type="number" step="any" class="form-control" name="monto" id="monto" autocomplete="off" <?='value="'.$datReg['monto'].'" '.$disabled;?> >
															<label>Monto Total:</label>
														</div>
													</div>
												</div><!--end .form-group -->
											</div>

											<div class="col-lg-1">
												<div class="form-group">
													<div class="input-group">
														<div class="input-group-content">
															<input type="text" class="form-control" name="noCompra" id="noCompra" autocomplete="off" <?='value="'.$datReg['folio'].'" '.$disabled;?> >
															<label>Folio:</label>
														</div>
													</div>
												</div><!--end .form-group -->
											</div>

											<div class="col-lg-2 text-center">
												<?php
												if ($datReg['id'] >= 1) {
													$idComp = $datReg['id'];
													echo '<span type="button" class="btn ink-reaction btn-floating-action btn-success" disabled><i class="fa fa-check"></i></span>';
												} else {
													echo '<button type="submit" style="margin-top:5px;" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class=\'fa fa-spinner fa-spin\'></i></center>"> Registrar</button>';
												}

												?>

											</div>
										</form>
									</div>


									<div class="rows">
										<?php
										if ($cantReg >= 1) {
											echo '<form class="form" method="post" action="../funciones/registraProductoEnCompra.php">';
										}else {
											echo '<form class="form">';
										}
										?>
											<div class="col-lg-5  col-lg-offset-2 form">
												<div class="form-group">
													<select id="regEntradaProd" name="regEntradaProd"  class="form-control select2-list" required>
														<?php
														$sql = "SELECT dpto.nombre AS depto, CONCAT(pd.nombre,', ',cmrc.nombre,' - ',scmrc.nombre) AS producto, pd.id
																		FROM productos pd
																		INNER JOIN catdeptos dpto ON pd.idDepto = dpto.id
																		LEFT JOIN catmarcas cmrc ON cmrc.id = pd.idCatMarca
																		LEFT JOIN catsubmarcas scmrc ON scmrc.id = pd.idCatSubMarca
																		WHERE pd.estatus <> '0'
																		ORDER BY dpto.nombre, pd.nombre ASC";
														$prod = mysqli_query($link,$sql) or die('<option class="text-danger" value="">Notifica al Administrador</option>');

														echo '<option value="">&nbsp;</option>';
														echo '<optgroup label="Leagold">';
														$group = '';
														$op = 0;
														while ($dat = mysqli_fetch_array($prod)) {
															if ($group != $dat['depto']) {
																if ($op == 1) {
																	echo '</optgroup>';
																}

																echo '<optgroup label="'.$dat['depto'].'">';
																$group = $dat['depto'];
																$op = 1;
															}
															echo '<option value="'.$dat['id'].'">'.$dat['producto'].'</option>';
														}
														echo '</optgroup>';
														?>
													</select>
													<label for="regEntradaProd">Selecciona el Producto</label>
												</div>
											</div>

											<div class="col-lg-3 form">
												<div class="form-group">
													<input type="number" id="regEntradaCant" name="regEntradaCant" step="1" required  class="form-control">
													<label for="regEntradaCant">Ingresa la Cantidad</label>
												</div>
											</div>

											<div class="col-lg-2">
												<?php
												if ($cantReg >= 1) {
													echo '
														<input type="hidden" name="idCompraAct" id="idCompraAct" value="'.$idComp.'">
														<button type="submit" class="btn ink-reaction btn-floating-action btn-success" data-toggle="tooltip" data-placement="top" data-original-title="Registra el producto"><i class="fa fa-mail-forward" ></i></button>';
												}
												?>
											</div>
										</form>
									</div>
									<div class="rows">
										<?php
										if ($cantReg >= 1) {
											$sql = "SELECT dcp.*, CONCAT(pdt.nombre,', ',cmrc.nombre,' - ',scmrc.nombre) AS nameProd, pdt.serieAuto, pdt.preSerie
															FROM detcompras dcp
															INNER JOIN productos pdt ON dcp.idProducto = pdt.id
															LEFT JOIN catmarcas cmrc ON cmrc.id = pdt.idCatMarca
															LEFT JOIN catsubmarcas scmrc ON scmrc.id = pdt.idCatSubMarca
															WHERE
															dcp.idCompra = '$idComp'
															ORDER BY pdt.nombre, dcp.id ASC";
											$query = mysqli_query($link, $sql) or die ('<span class="text-danger">No pudimos cargar tu Información, notifica a tu Administrador.</span>'.mysqli_error($link));
											//echo $sql;
										?>
										<div class="col-lg-12">
											<div class="table-responsive no-margin">
												<table class="table table-striped no-margin">
													<thead>
														<tr class="text-ultra-bold">
															<th class="text-center">#</th>
															<th class="text-center">Cont</th>
															<th class="col-lg-4">Producto</th>
															<th class="col-lg-2">Precio</th>
															<th class="col-lg-3">No. de Serie</th>
															<th class="col-lg-1 text-center">Rotulado</th>
															<th class="text-right col-lg-1">Borrar</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$contTot = 0;
														$contProd = 0;
														$tipoProd = '';
														$contPrecios = 0;
														while ($res = mysqli_fetch_array($query)) {
															$idProd = $res['id'];
															$precioProd = ($res['precio'] == '') ? '0' : $res['precio'] ;
															$contPrecios += $precioProd;
															$color = ($contPrecios <= $datReg['monto']) ? 'text-success' : 'text-danger' ;
															$contTot++;
															//Contadores de Producto
															if ($res['idProducto'] == $tipoProd) {
																$contProd++;
															} else {
																$contProd = 1;
															}
															//Numero de Serie y si va Rotulado
															if ($res['serieAuto'] == '1') {
																$serie = '<span class=""><b>'.$res['noSerie'].'</b></span>';
																$precio = '
																	<div class="form-group  has-feedback" id="frmPrecioProd'.$idProd.'">
																		<div class="input-group">
																			<div class="input-group-content">
																				<input type="text" class="form-control" value="'.$precioProd.'" name="precioProd'.$idProd.'" id="precioProd'.$idProd.'" onchange="notificaPrecio(this.value, '.$idProd.')" required>
																				<label for="precioProd'.$idProd.'">Precio del Producto</label>
																			</div>
																		</div>
																	</div><!--end .form-group -->
																';

																if ($res['rotulado'] == '1') {
																	$rotulado = '<span class="text-success"><i class="fa fa-check" data-toggle="tooltip" data-placement="top" data-original-title="Ya a sido Rotulado"></i></span>';
																}else {
																	$rotulado = '<button type="button" class="btn ink-reaction btn-floating-action btn-xs btn-warning" id="dtnRot'.$idProd.'" onclick="marcarComoRotulado('.$idProd.')" data-toggle="tooltip" data-placement="top" data-original-title="Marcar como Rotulado"><i class="fa fa-minus" ></i></button>
																								<span id="load'.$idProd.'" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>';
																}

															} else {
																$serieReg = '';
																if ($res['noSerie'] != '') {
																	$serieReg = $res['noSerie'];
																}
																$serie = '
																	<div class="form-group  has-feedback" id="frmGrp'.$idProd.'">
																		<div class="input-group">
																			<div class="input-group-content">
																				<input type="text" class="form-control" value="'.$serieReg.'" name="serieProd'.$idProd.'" id="serieProd'.$idProd.'" onchange="notif(this.value, '.$idProd.')" required>
																				<label for="serieProd'.$idProd.'">Numero de Serie</label>
																			</div>
																		</div>
																	</div><!--end .form-group -->
																';

																$precio = '
																	<div class="form-group  has-feedback" id="frmPrecioProd'.$idProd.'">
																		<div class="input-group">
																			<div class="input-group-content">
																				<input type="text" class="form-control" value="'.$precioProd.'" name="precioProd'.$idProd.'" id="precioProd'.$idProd.'" onchange="notificaPrecio(this.value, '.$idProd.')" required>
																				<label for="precioProd'.$idProd.'">Precio del Producto</label>
																			</div>
																		</div>
																	</div><!--end .form-group -->
																';

																$rotulado = '<span class="text-success"><i class="fa fa-check" data-toggle="tooltip" data-placement="top" data-original-title="Ya a sido Rotulado"></i></span>';
															}
															$delete = '<button type="button" class="btn ink-reaction btn-icon-toggle btn-danger" onclick="borraRegistro(\''.base64_encode($idProd).'\');"><i class="md md-delete"></i></button>';

															echo '
															<tr id="trProd'.$idProd.'">
																<td class="text-center">'.$contTot.'</td>
																<td class="text-center">'.$contProd.'</td>
																<td class="col-lg-4">'.$res['nameProd'].'</td>
																<td class="col-lg-2">'.$precio.'</td>
																<td class="col-lg-3 form">'.$serie.'</td>
																<td class="col-lg-1 text-center" id="tdRotulado'.$idProd.'">'.$rotulado.'</td>
																<td class="text-right col-lg-1">'.$delete.'</td>
															</tr>';
															$tipoProd = $res['idProducto'];
														}
														?>
													</tbody>
												</table>
										<!--		<div class="col-lg-offset-5 col-lg-2">
													<div class="form-group floating-label <?=$color;?>">
														<h3>subtotal: <strong><?=$contPrecios;?></strong></h3>
													</div>
												</div>		-->
											</div><!--end .table-responsive -->
											<div class="row">
												<form class="form" method="post" action="../funciones/cierraCompraProductos.php">
													<input type="hidden" name="idCompra" value="<?=$idComp;?>">
													<div class="col-lg-8 form">
														<div class="form-group floating-label">
															<textarea name="notas" id="notas" class="form-control" rows="2" placeholder="" required></textarea>
															<label for="notas">Notas Extra</label>
														</div>
													</div>
													<div class="col-lg-4 txt-center" style="vertical-align: baseline;">
														<center><br><br>
															<button type="submit" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Cargando...">Guardar Compra</button>
														</center>
													</div>
												</form>
											</div>
										</div>
										<?php
										}
										?>
									</div>
								</div><!--end .card-body -->
							</div><!--end .card -->


							<div class="card card-outlined style-primary">
								<div class="card-head">
									<div class="tools">
										<div class="btn-group">
											<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
										</div>
									</div>
									<header><i class="md md-assignment-ind"></i> Asignar Productos a un Operador</header>
								</div><!--end .card-head -->

								<div class="card-body">
									<?php
									error_reporting(E_ALL); //muestra todos los errores encontrados en la página
									$sql = "SELECT *
													FROM asignaciones
													WHERE estatus = '1' AND idUserReg = '$idUs'
													ORDER BY id DESC
													LIMIT 1	";
									//echo 'SQL = '.$sql;
									$reg = mysqli_query($link, $sql) or die('<span class="text-danger"> Hay problemas al cosultar la información de asignaciones, notifica a tu Administrador. </span>');
									$cantAsig = mysqli_num_rows($reg);
									$datAsig = mysqli_fetch_array($reg);
									$idAsig = $datAsig['id'];
									$opAsignado = $datAsig['idAsignaVehiculo'];
									//echo '<br><br> -->'.$opAsignado;

									$disabled = '';
									if ($cantAsig >= 1) {
										$disabled = 'disabled';
									}
									?>
									<div class="rows">
										<div class="col-lg-1">
										</div>
										<div class="col-lg-4 form">
											<div class="form-group">
												<form class="form" method="post" action="../funciones/registraNuevaAsignacionProductoAOperador.php">
												<div class="input-group">
													<div class="input-group-content">
														<?php
														$sql = "SELECT avh.id, CONCAT(opr.nombre,' ',opr.apellidos) AS nombreCOmp, vhc.noEconomico, vhc.placas
																		FROM asignavehiculos avh
																		INNER JOIN operadores opr ON avh.idOperador = opr.id
																		INNER JOIN vehiculos vhc ON avh.idVehiculo = vhc.id
																		WHERE avh.estatus = '1'
																		ORDER BY nombreCOmp ASC";
														$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));

														echo '<select id="opAsigna" name="opAsigna" class="form-control" '.$disabled.'>';
														echo '<option value=""></option>';
														while ($dat = mysqli_fetch_array($res)) {
															$select = ($datAsig['idAsignaVehiculo'] == $dat['id']) ? 'selected' :'' ;
															echo '<option value="'.$dat['id'].'" '.$select.'> '.$dat['nombreCOmp'].' - ECO '.$dat['noEconomico'].' - '.$dat['placas'].'</option>';
														}
														echo '</select>';
														?>

														<label for="areaAsigna">Selecciona el Operador</label>
													</div>
													<div class="input-group-btn">
														<button type="submit" class="btn ink-reaction btn-floating-action btn-primary" <?=$disabled;?> ><i class="fa fa-check"></i></button>
													</div>
												</div>
												</form>
											</div><!--end .form-group -->
										</div>

										<form class="form" method="post" action="../funciones/cargaProductoParaNuevaAsignacion.php">

										<div class="col-lg-3 form">
											<div class="form-group">
												<select id="productoAsigna" name="productoAsigna" onchange="cambiaCant(this.value)"  class="form-control select2-list" autocomplete="off" required>
													<?php
													$sql = "SELECT  pdt.id, pdt.nombre, dpto.nombre AS depto, COUNT(stk.idProducto) AS stock
																	FROM stocks stk
																	INNER JOIN productos pdt ON stk.idProducto = pdt.id
																	INNER JOIN catdeptos dpto ON pdt.idDepto = dpto.id
																	WHERE stk.estatus = '1'
																	GROUP BY stk.idProducto
																	ORDER BY pdt.nombre";
													$prod = mysqli_query($link, $sql) or die('<option value="">Notifica a tu Administrador.</option>');

													echo '<option value="">&nbsp;</option>';
													echo '<optgroup label="Leagold">';
													$group = '';
													$op = 0;
													while ($dat = mysqli_fetch_array($prod)) {

														if ($group != $dat['depto']) {
															if ($op == 1) {
																echo '</optgroup>';
															}

															echo '<optgroup label="'.$dat['depto'].'">';
															$group = $dat['depto'];
															$op = 1;
														}
														echo '<option value="'.$dat['id'].'" data-actual="'.$dat['stock'].'">'.$dat['nombre'].'</option>';
													}
													echo '</optgroup>';
													?>
												</select>
												<label for="productoAsigna">Selecciona el Producto</label>
											</div>
										</div>

										<div class="col-lg-2 form">
											<div class="form-group">
												<select id="seriesAsignar" name="seriesAsignar[]" class="form-control select2-list" data-placeholder="Selecciona un Producto" multiple="multiple" autocomplete="off">

												</select>
												<label for="seriesAsignar">Selecciona los Productos  a Asignar</label>
											</div>
										</div>

										<div class="col-lg-2 text-center">
											<input type="hidden" name="idAsignacion" id="idAsignacion" value="<?=$idAsig;?>">
											<button type="submit" style="margin-top:5px;" id="btnAsignaProd" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class='fa fa-spinner fa-spin'></i> --</center>"> Aplicar</button>
										</div>
										</form>
									</div>



									<div class="rows">
										<div class="col-lg-12">

											<?php
											if ($cantAsig >= 1) {
												$sql = "SELECT *, stk.id AS identStock, dta.id AS detalleAs, CONCAT(prod.nombre,' (',cmrc.nombre,' - ',scmrc.nombre,')') AS nameProd
														FROM asignaciones asg
														INNER JOIN detasigna dta ON asg.id = dta.idAsignacion
														INNER JOIN stocks stk ON dta.idStock = stk.id
														INNER JOIN productos prod ON stk.idProducto = prod.id
														LEFT JOIN catmarcas cmrc ON cmrc.id = prod.idCatMarca
														LEFT JOIN catsubmarcas scmrc ON scmrc.id = prod.idCatSubMarca
														WHERE asg.idUserReg = '$idUs' AND asg.idAsignaVehiculo = '$opAsignado' AND asg.id = '$idAsig'

														ORDER BY dta.id DESC";
														//echo '<br>sql: '.$sql.'<br>';
												$query = mysqli_query($link, $sql) or die ('<span class="text-danger">No pudimos cargar tu Información, notifica a tu Administrador.</span>'.mysqli_error($link));
												//echo '<br><br>*-- '.$sql;
											?>
											<div class="table-responsive no-margin">
												<table class="table table-striped no-margin">
													<thead>
														<tr class="text-ultra-bold">
															<th class="text-center">#</th>
															<th class="text-center">Cont</th>
															<th class="col-lg-6">Producto</th>
															<th class="col-lg-3">No. de Serie</th>
															<th class="col-lg-1 text-center">Rotulado</th>
															<th class="text-right col-lg-1">Borrar</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$contTot = 0;
														$contProd = 0;
														$tipoProd = '';
														while ($res = mysqli_fetch_array($query)) {
															$idProd = $res['identStock'];
															$detalleAs = $res['detalleAs'];
															$contTot++;
															//Contadores de Producto
															if ($res['idProducto'] == $tipoProd) {
																$contProd++;
															} else {
																$contProd = 1;
															}

															//Numero de Serie y si va Rotulado
															if ($res['serieAuto'] == '1') {
																$serie = '<span class=""><b>'.$res['noSerie'].'</b></span>';
																if ($res['rotulado'] == '1') {
																	$rotulado = '<span class="text-success"><i class="fa fa-check" data-toggle="tooltip" data-placement="top" data-original-title="Ya a sido Rotulado"></i></span>';
																}else {
																	$rotulado = '<button type="button" class="btn ink-reaction btn-floating-action btn-xs btn-warning" id="dtnRot'.$idProd.'" onclick="marcarComoRotuladoAsig('.$idProd.')" data-toggle="tooltip" data-placement="top" data-original-title="Marcar como Rotulado"><i class="fa fa-minus" ></i></button>
																								<span id="load'.$idProd.'" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>';
																}

															} else {
																$serieReg = '';
																if ($res['noSerie'] != '') {
																	$serieReg = $res['noSerie'];
																}
																$serie = '
																	<div class="form-group  has-feedback" id="frmGrp'.$idProd.'">
																		<div class="input-group">
																			<div class="input-group-content">
																				<input type="text" class="form-control" value="'.$serieReg.'" name="serieProd'.$idProd.'" id="serieProd'.$idProd.'" onchange="notif(this.value, '.$idProd.')" required>
																				<label for="serieProd'.$idProd.'">Numero de Serie</label>
																			</div>
																		</div>
																	</div><!--end .form-group -->
																';
																$rotulado = '<span class="text-success"><i class="fa fa-check" data-toggle="tooltip" data-placement="top" data-original-title="Ya a sido Rotulado"></i></span>';
															}
															$delete = '<button type="button" class="btn ink-reaction btn-icon-toggle btn-danger" onclick="borraRegistroAsignacion(\''.base64_encode($idProd).'\', \''.$detalleAs.'\');"><i class="md md-delete"></i></button>';

															echo '
															<tr id="trProdAsg'.$idProd.'">
																<td class="text-center">'.$contTot.'</td>
																<td class="text-center">'.$contProd.'</td>
																<td class="col-lg-6">'.$res['nameProd'].'</td>
																<td class="col-lg-3 form">'.$serie.'</td>
																<td class="col-lg-1 text-center" id="tdRotuladoAsig'.$idProd.'">'.$rotulado.'</td>
																<td class="text-right col-lg-1">'.$delete.'</td>
															</tr>';
															$tipoProd = $res['idProducto'];
														}
														?>
													</tbody>
												</table>
											</div><!--end .table-responsive -->
											<div class="row">
												<form class="form" method="post" action="../funciones/cierraAsignaProductos.php">
													<input type="hidden" name="idAsignacion" value="<?=$idAsig;?>">
													<div class="col-lg-8 form">
														<div class="form-group floating-label">
															<textarea name="notas" id="notas" class="form-control" rows="2" placeholder="" required></textarea>
															<label for="notas">Notas Extra</label>
														</div>
													</div>
													<div class="col-lg-4 txt-center" style="vertical-align: baseline;">
														<center><br><br>
															<button type="submit" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Cargando...">Asignar Productos</button>
														</center>
													</div>
												</form>
											</div>
										</div>
										<?php
										}
										?>
									</div>

								</div><!--end .card-body -->
							</div><!--end .card -->


						</div><!--end .row -->
					</div><!--end .section-body -->
					<!-- END INBOX -->

					<!-- BEGIN SECTION ACTION -->
					<div class="section-action style-primary">
						<div class="section-floating-action-row">
							<a class="btn ink-reaction btn-floating-action btn-lg btn-accent" href="adminListadoDeArticulos.php" data-toggle="tooltip" data-placement="top" data-original-title="Ver Detalle de cada Producto.">
								<i class="md md-format-list-bulleted"></i>
							</a>&nbsp;
							<a class="btn ink-reaction btn-floating-action btn-lg btn-accent" href="adminDetalleInventario.php" data-toggle="tooltip" data-placement="top" data-original-title="Ver General de los Productos.">
								<i class="md md-assignment"></i>
							</a>
						</div>

					</div><!--end .section-action -->
					<!-- END SECTION ACTION -->

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

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">Copyright &copy; 2019</span>
						</small>
					</div>
				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->

			<!-- BEGIN OFFCANVAS RIGHT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS RIGHT -->

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
		<script src="../assets/js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.es.js"></script>
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
		<script src="../assets/js/core/demo/DemoFormComponents.js"></script>
		<script src="../assets/js/libs/toastr/toastr.js"></script>
		<script src="../assets/js/libs/fileInput/fileInput.js"></script>
		<script src="../assets/js/libs/fileInput/fileInput_locale_es.js"></script>
		<script src="../assets/scripts/cadenas.js"></script>
		<script>
	  $(document).ready(function(){
			<?php
			if ($datReg['id'] >= 1) {
				echo '
				$("#fechaCompra").prop("disabled", true);
				$("#idProveedorCpa").prop("disabled", true);
				$("#noCompra").prop("disabled", true);';
			} else {
				/*echo '
				$("#regEntradaProd").prop("disabled", true);
				$("#regEntradaCant").prop("disabled", true);
				$("#btnAsignaProd").prop("disabled", true);
				';*/
			}
			if ($cantAsig == 0) {
				echo '
				$("#productoAsigna").prop("disabled", true);
				$("#cantAsigna").prop("disabled", true)';
			}
			?>

			$('.fechado').datepicker({
				todayHighlight: true,
				format: "yyyy-mm-dd",
				language: "es"
			});

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

			$(".docto").fileinput({
	  		showUpload: false,
	  		showCaption: false,
		      language: 'es',
		      allowedFileExtensions : ['PDF'],
		      maxFileSize: 5120,
		      maxFilesNum: 1,
		  		browseClass: "btn btn-primary btn-lg",
		  		fileType: "any",
		      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
		  	});

				$('#tablaProductos').DataTable({
					"dom": "Bfrtip",
					"buttons": true,
					"order": [],
					"colVis": {
						"buttonText": "Columnas",
						"overlayFade": 0,
						"align": "right"
					},
					"language": {
						"lengthMenu": '_MENU_ entradas por pagina',
						"info": "Mostrando paginas _PAGE_ de _PAGES_",
						"sInfo": "Mostrando _START_ al _END_ de _TOTAL_ entradas",
						"sInfoEmpty": "Mostrando 0 al 0 de 0 entradas",
						"infoFiltered": " - filtrado de _MAX_ registros",
						"sInfoFiltered": "(filtrado de _MAX_ entradas totales.)",
						"zeroRecords": "No hay registros que mostrar.",
						"search": '<i class="fa fa-search"></i>',
						"paginate": {
							"previous": '<i class="fa fa-angle-left"></i>',
							"next": '<i class="fa fa-angle-right"></i>'
						}
					}
				});

			<?php
			if (isset( $_SESSION['SGTSSmsjAdminInventario'])) {
				echo "notificaBad('".$_SESSION['SGTSSmsjAdminInventario']."');";
				unset($_SESSION['SGTSSmsjAdminInventario']);
			}
			if (isset( $_SESSION['SGTSSmsjSuccessAdminInventario'])) {
				echo "notificaSuc('".$_SESSION['SGTSSmsjSuccessAdminInventario']."');";
				unset($_SESSION['SGTSSmsjSuccessAdminInventario']);
			}
			?>
	  });

		function limpiaTexto(txt){
			texto = getCadenaLimpia(txt);
			//alert(texto);
			$("#nombre").val(texto);
		}

		function notif(value, ident){
			$.post("../funciones/verificaSerieDeProductoCompra.php",
				{ noSerie:value, ident:ident},
					function(respuesta){
						var res=respuesta.split('|');
						if (res[0] == '0') {
							notificaBad(res[1]);
							$("#frmGrp"+ident).addClass("has-error");
							$("#serieProd"+ident).val('');
							$("#serieProd"+ident).prop('placeholder', value);
						} else {
							notificaSuc(res[1]);
							$("#frmGrp"+ident).addClass("has-success");
						}
					});
		}

		function notificaPrecio(value, ident){
			$.post("../funciones/verificaPrecioDeProductoCompra.php",
				{ precio:value, ident:ident},
					function(resp){
						var res=resp.split('|');
						if (res[0] == '0') {
							notificaBad(res[1]);
							$("#frmPrecioProd"+ident).addClass("has-error");
							$("#precioProd"+ident).val('');
							$("#precioProd"+ident).prop('placeholder', value);
						} else {
							notificaSuc(res[1]);
							$("#frmPrecioProd"+ident).addClass("has-success");
						}
					});
		}


		function borraRegistroAsignacion(idProd, idDetAS){
			$.post("../funciones/borrarProductodeAsignacion.php",
				{ idProd:idProd, idDetAS:idDetAS},
					function(respuesta){
						var res=respuesta.split('|');
						if (res[0] == '0') {
							notificaBad(res[1]);
						} else {
							notificaSuc(res[1]);
							$("#trProdAsg"+res[2]).remove();
						}
					});
		}

		function borraRegistro(idProd){
			$.post("../funciones/borrarProductoCompra.php",
				{ idProd:idProd},
					function(respuesta){
						var res=respuesta.split('|');
						if (res[0] == '0') {
							notificaBad(res[1]);
						} else {
							notificaSuc(res[1]);
							$("#trProd"+res[2]).remove();
						}
					});
		}

		function marcarComoRotulado(value){
			var cont = $("#tdRotulado"+value).html();
			//$(".tooltip").toggle();
			//$("#tdRotulado"+value).html('<i class="fa fa-spinner fa-spin"></i>');
			$("#dtnRot"+value).hide();
			$("#load"+value).show();
			$.post("../funciones/marcarRotuladoProductoDeCompra.php",
				{ idDetCompra:value },
					function(respuesta){
						var res=respuesta.split('|');
						if (res[0] == '0') {
							notificaBad(res[1]);
							$("#dtnRot"+value).show();
							$("#load"+value).hide();
						} else {
							$("#tdRotulado"+value).html(res[1]);
						}
					});
		}

		function marcarComoRotuladoAsig(value){
			var cont = $("#tdRotulado"+value).html();
			//$(".tooltip").toggle();
			//$("#tdRotulado"+value).html('<i class="fa fa-spinner fa-spin"></i>');
			$("#dtnRot"+value).hide();
			$("#load"+value).show();
			$.post("../funciones/marcarRotuladoProductoDeAsignacion.php",
				{ ident:value },
					function(respuesta){
						var res=respuesta.split('|');
						if (res[0] == '0') {
							notificaBad(res[1]);
							$("#dtnRotAsig"+value).show();
							$("#load"+value).hide();
						} else {
							$("#tdRotuladoAsig"+value).html(res[1]);
						}
					});
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

		function cambiaCant(ident){
			var nameProd = $('#productoAsigna option:selected').html();
			//var selected = $('#productoAsigna option:selected');
			//var extra = selected.data('actual');
			//alert(ident+'- Extra -'+extra);
			//$("#seriesAsignar").prop('placeholder', extra);
			//$("#seriesAsignar").prop('max', extra);
			$.post("../funciones/listadoDeStocksDisponibles.php",
				{ idProd:ident, nameProd:nameProd },
					function(respuesta){
						var res=respuesta.split('|');
						if (res[0] == '0') {
							$("#seriesAsignar").html('');
							$("#seriesAsignar").prop('disabled', true);
							$("#seriesAsignar").data('placeholder', res[1]);

						} else if (res[0] == '1') {
							$("#seriesAsignar").html(res[2]);
							$("#seriesAsignar").prop('disabled', false);
							$("#seriesAsignar").select2({
								placeholder: "Muestra",
								allowClear: true
							});


						} else {
							notificaBad('Hubo un conflicto, reintenta o notifica a tu Administrador.');
							$("#seriesAsignar").html('');
							$("#seriesAsignar").prop('disabled', true);
							$("#seriesAsignar").data('placeholder', 'Vuelve a seleccionar Producto.');
						}
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
