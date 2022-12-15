<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('admin.php');
require '../include/connect.php';
require_once('../funciones/notificaAdmin.php');

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
	<link href='https://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css' />
	<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/bootstrap.css?1422792965" />
	<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css?1425466319" />
	<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/font-awesome.min.css?1422529194" />
	<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/material-design-iconic-font.min.css?1421434286" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

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
							<a href="home.php">
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
						</ul>
						<!--end .dropdown-menu -->
					</li>
					<!--end .dropdown -->
				</ul>
				<!--end .header-nav-profile -->
			</div>
			<!--end #header-navbar-collapse -->
		</div>
	</header>
	<!-- END HEADER-->

	<!-- BEGIN BASE-->
	<div id="base">

		<!-- BEGIN OFFCANVAS LEFT -->
		<div class="offcanvas">
		</div>
		<!--end .offcanvas-->
		<!-- END OFFCANVAS LEFT -->

		<!-- BEGIN CONTENT-->
		<div id="content">
			<section>
				<div class="row">&nbsp;</div>

				<!-- BEGIN ALERT - TIME ON SITE -->
				<div class="row">

					<!-- BEGIN ALERT - TIME ON SITE -->
					<div class="col-md-4 col-sm-4">
						<div class="card">
							<div class="card-body no-padding">
								<?php
								require('../include/connect.php');
								#error_reporting(E_ALL);
								$csql = " SELECT COUNT(cgc.idCatCombustible) AS cnt, SUM(cgc.cant) AS suma, (MONTH(NOW())-1) AS noMes
														FROM cargacombustible cgc
														INNER JOIN catcombustibles ctc ON ctc.id = cgc.idCatCombustible
														WHERE cgc.idCatCombustible = '3' 
														AND  DATE_FORMAT(cgc.fechaReg,'%m-%Y') =DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH,'%m-%Y')
														GROUP BY cgc.idCatCombustible";
								$res = mysqli_query($link, $csql) or die('<p class="text-danger">Notifica a tu Administrador</p>');
								$cargaGas = mysqli_fetch_array($res);
								switch ($cargaGas['noMes']) {
									case '1':
										$mes = 'Diésel Entregado en <strong>Enero</strong>';
										break;
									case '2':
										$mes = 'Diésel Entregado en <strong>Febrero</strong>';
										break;
									case '3':
										$mes = 'Diésel Entregado en <strong>Marzo</strong>';
										break;
									case '4':
										$mes = 'Diésel Entregado en <strong>Abril</strong>';
										break;
									case '5':
										$mes = 'Diésel Entregado en <strong>Mayo</strong>';
										break;
									case '6':
										$mes = 'Diésel Entregado en <strong>Junio</strong>';
										break;
									case '7':
										$mes = 'Diésel Entregado en <strong>Julio</strong>';
										break;
									case '8':
										$mes = 'Diésel Entregado en <strong>Agosto</strong>';
										break;
									case '9':
										$mes = 'Diésel Entregado en <strong>Septiembre</strong>';
										break;
									case '10':
										$mes = 'Diésel Entregado en <strong>Octubre</strong>';
										break;
									case '11':
										$mes = 'Diésel Entregado en <strong>Noviembre</strong>';
										break;
									case '12':
										$mes = 'Diésel Entregado en <strong>Diciembre</strong>';
										break;

									default:
										$mes = 'No hay Información en este Mes';
										break;
								}
								if ($cargaGas['suma'] > 0) {
									$diesel = $cargaGas['suma'];
								} else {
									$diesel = 0;
								}

								##################################################################
								?>
								<div class="no-margin">
									<h1 class="pull-right text-dark"><i class="fa fa-tint">&nbsp;&nbsp;</i></h1>
									<button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#modalDiesel2">
										<strong class="text-xl">
											&nbsp; <?= $diesel; ?> Lts. de Diésel<br /></strong></button>
									<span class="opacity-50"><?= $mes; ?></span>
								</div>
							</div>
							<!--end .card-body -->
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->
					<!-- END ALERT - TIME ON SITE -->

					<!-- BEGIN ALERT - TIME ON SITE -->
					<div class="col-md-4 col-sm-4">
						<div class="card">
							<div class="card-body no-padding">
								<?php
								#require('../include/connect.php');
								#error_reporting(E_ALL);
								$csql = " SELECT COUNT(cgc.idCatCombustible) AS cnt, SUM(cgc.cant) AS suma, (MONTH(NOW())-1) AS noMes
														FROM cargacombustible cgc
														INNER JOIN catcombustibles ctc ON ctc.id = cgc.idCatCombustible
														WHERE cgc.idCatCombustible = '2' 
														AND  DATE_FORMAT(cgc.fechaReg,'%m-%Y') =DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH,'%m-%Y')

														GROUP BY cgc.idCatCombustible
										";
								$res = mysqli_query($link, $csql) or die('<p class="text-danger">Notifica a tu Administrador</p>');
								$cargaGas = mysqli_fetch_array($res);
								switch ($cargaGas['noMes']) {
									case '1':
										$mes = 'Gasolina Entregada en <strong>Enero</strong>';
										break;
									case '2':
										$mes = 'Gasolina Entregada en <strong>Febrero</strong>';
										break;
									case '3':
										$mes = 'Gasolina Entregada en <strong>Marzo</strong>';
										break;
									case '4':
										$mes = 'Gasolina Entregada en <strong>Abril</strong>';
										break;
									case '5':
										$mes = 'Gasolina Entregada en <strong>Mayo</strong>';
										break;
									case '6':
										$mes = 'Gasolina Entregada en <strong>Junio</strong>';
										break;
									case '7':
										$mes = 'Gasolina Entregada en <strong>Julio</strong>';
										break;
									case '8':
										$mes = 'Gasolina Entregada en <strong>Agosto</strong>';
										break;
									case '9':
										$mes = 'Gasolina Entregada en <strong>Septiembre</strong>';
										break;
									case '10':
										$mes = 'Gasolina Entregada en <strong>Octubre</strong>';
										break;
									case '11':
										$mes = 'Gasolina Entregada en <strong>Noviembre</strong>';
										break;
									case '12':
										$mes = 'Gasolina Entregada en <strong>Diciembre</strong>';
										break;

									default:
										$mes = 'No hay Información en este Mes';
										break;
								}
								if ($cargaGas['suma'] > 0) {
									$gas = $cargaGas['suma'];
								} else {
									$gas = 0;
								}

								##################################################################
								?>
								<div class="no-margin">
									<h1 class="pull-right text-success"><i class="fa fa-tint">&nbsp;&nbsp;</i></h1>
									<button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#modalMagna2">
										<strong class="text-xl">
											&nbsp; <?= $gas; ?> Lts. de Magna<br /></strong></button>
									<span class="opacity-50"><?= $mes; ?></span>
								</div>
							</div>
							<!--end .card-body -->
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->

					<div class="col-md-4 col-sm-4">
						<div class="card">
							<div class="card-body no-padding">
								<?php
								#require('../include/connect.php');
								#error_reporting(E_ALL);
								$csql = " SELECT COUNT(cgc.idCatCombustible) AS cnt, SUM(cgc.cant) AS suma, (MONTH(NOW())-1) AS noMes
														FROM cargacombustible cgc
														INNER JOIN catcombustibles ctc ON ctc.id = cgc.idCatCombustible
														WHERE cgc.idCatCombustible = '1' 
														AND  DATE_FORMAT(cgc.fechaReg,'%m-%Y') =DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH,'%m-%Y')

														GROUP BY cgc.idCatCombustible
										";
								$res = mysqli_query($link, $csql) or die('<p class="text-danger">Notifica a tu Administrador</p>');
								$cargaGas = mysqli_fetch_array($res);
								switch ($cargaGas['noMes']) {
									case '1':
										$mes = 'Gasolina Entregada en <strong>Enero</strong>';
										break;
									case '2':
										$mes = 'Gasolina Entregada en <strong>Febrero</strong>';
										break;
									case '3':
										$mes = 'Gasolina Entregada en <strong>Marzo</strong>';
										break;
									case '4':
										$mes = 'Gasolina Entregada en <strong>Abril</strong>';
										break;
									case '5':
										$mes = 'Gasolina Entregada en <strong>Mayo</strong>';
										break;
									case '6':
										$mes = 'Gasolina Entregada en <strong>Junio</strong>';
										break;
									case '7':
										$mes = 'Gasolina Entregada en <strong>Julio</strong>';
										break;
									case '8':
										$mes = 'Gasolina Entregada en <strong>Agosto</strong>';
										break;
									case '9':
										$mes = 'Gasolina Entregada en <strong>Septiembre</strong>';
										break;
									case '10':
										$mes = 'Gasolina Entregada en <strong>Octubre</strong>';
										break;
									case '11':
										$mes = 'Gasolina Entregada en <strong>Noviembre</strong>';
										break;
									case '12':
										$mes = 'Gasolina Entregada en <strong>Diciembre</strong>';
										break;

									default:
										$mes = 'No hay Información en este Mes';
										break;
								}
								if ($cargaGas['suma'] > 0) {
									$gas = $cargaGas['suma'];
								} else {
									$gas = 0;
								}

								##################################################################
								?>
								<div class="no-margin">
									<h1 class="pull-right text-danger"><i class="fa fa-tint">&nbsp;&nbsp;</i></h1>
									<button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#modalPremium2">
										<strong class="text-xl">
											&nbsp; <?= $gas; ?> Lts. de Premium<br /></strong></button>
									<span class="opacity-50"><?= $mes; ?></span>
								</div>
							</div>
							<!--end .card-body -->
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->
					<!-- END ALERT - TIME ON SITE -->

				</div>
				<div class="row">

					<!-- BEGIN ALERT - TIME ON SITE -->
					<div class="col-md-3 col-sm-4">
						<div class="card">
							<?php
							#require('../include/connect.php');
							#error_reporting(E_ALL);
							$psql = " SELECT *
													FROM
														(SELECT stk.idProducto, pdt.nombre, COUNT(stk.idProducto) AS cantDisponible, pdt.min AS cantMinima, pdt.max AS cantMaxima, MONTH(NOW()) AS noMes
														FROM stocks stk
														INNER JOIN productos pdt ON stk.idProducto = pdt.id
														WHERE
															stk.estatus IN (4,1)
														GROUP BY stk.idProducto) AS lisProd
													WHERE
														cantDisponible <= cantMinima
									";
							$pres = mysqli_query($link, $psql) or die('<p class="text-danger">Notifica a tu Administrador</p>');
							$cantProductosConMin = mysqli_num_rows($pres);
							if ($cantProductosConMin < 1) {
								$productos = '0';
							} else {
								$productos = 'Productos ' . $cantProductosConMin;
							}
							switch ($cargaGas['noMes']) {
								case '1':
									$pmes = 'Productos Faltantes en el mes: <strong>Enero</strong>';
									break;
								case '2':
									$pmes = 'Productos Faltantes en el mes: <strong>Febrero</strong>';
									break;
								case '3':
									$pmes = 'Productos Faltantes en el mes: <strong>Marzo</strong>';
									break;
								case '4':
									$pmes = 'Productos Faltantes en el mes:  <strong>Abril</strong>';
									break;
								case '5':
									$pmes = 'Productos Faltantes en el mes:  <strong>Mayo</strong>';
									break;
								case '6':
									$pmes = 'Productos Faltantes en el mes:  <strong>Junio</strong>';
									break;
								case '7':
									$pmes = 'Productos Faltantes en el mes:  <strong>Julio</strong>';
									break;
								case '8':
									$pmes = 'Productos Faltantes en el mes:  <strong>Agosto</strong>';
									break;
								case '9':
									$pmes = 'Productos Faltantes en el mes:  <strong>Septiembre</strong>';
									break;
								case '10':
									$pmes = 'Productos Faltantes en el mes:  <strong>Octubre</strong>';
									break;
								case '11':
									$pmes = 'Productos Faltantes en el mes:  <strong>Noviembre</strong>';
									break;
								case '12':
									$pmes = 'Productos Faltantes en el mes:  <strong>Diciembre</strong>';
									break;

								default:
									$pmes = 'No hay Productos Faltantes';
									break;
							}
							?>
							<div class="card-body no-padding">
								<div class="alert alert-callout alert-info no-margin  text-right">
									<button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#simpleModal">
										<h4 class="text-xl"><?= $productos; ?></h4>
									</button>
									<span class="opacity-50"><br>Productos a Surtir</span>
								</div>
							</div>
							<!--end .card-body -->
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->
					<!-- END ALERT - TIME ON SITE -->

					<!-- BEGIN ALERT - TIME ON SITE -->
					<div class="col-md-3 col-sm-4">
						<div class="card">
							<div class="card-body no-padding">
								<?php
								#require('../include/connect.php');
								#error_reporting(E_ALL);
								$csql = " SELECT COUNT(cgc.idCatCombustible) AS cnt, SUM(cgc.cant) AS suma, MONTH(NOW()) AS noMes
														FROM cargacombustible cgc
														INNER JOIN catcombustibles ctc ON ctc.id = cgc.idCatCombustible
														WHERE cgc.idCatCombustible = '3' AND CONCAT(MONTH(cgc.fechaReg ),'-',YEAR(cgc.fechaReg )) = CONCAT(MONTH(NOW()),'-',YEAR(NOW()))
														GROUP BY cgc.idCatCombustible";
								$res = mysqli_query($link, $csql) or die('<p class="text-danger">Notifica a tu Administrador</p>');
								$cargaGas = mysqli_fetch_array($res);
								switch ($cargaGas['noMes']) {
									case '1':
										$mes = 'Diésel Entregado en <strong>Enero</strong>';
										break;
									case '2':
										$mes = 'Diésel Entregado en <strong>Febrero</strong>';
										break;
									case '3':
										$mes = 'Diésel Entregado en <strong>Marzo</strong>';
										break;
									case '4':
										$mes = 'Diésel Entregado en <strong>Abril</strong>';
										break;
									case '5':
										$mes = 'Diésel Entregado en <strong>Mayo</strong>';
										break;
									case '6':
										$mes = 'Diésel Entregado en <strong>Junio</strong>';
										break;
									case '7':
										$mes = 'Diésel Entregado en <strong>Julio</strong>';
										break;
									case '8':
										$mes = 'Diésel Entregado en <strong>Agosto</strong>';
										break;
									case '9':
										$mes = 'Diésel Entregado en <strong>Septiembre</strong>';
										break;
									case '10':
										$mes = 'Diésel Entregado en <strong>Octubre</strong>';
										break;
									case '11':
										$mes = 'Diésel Entregado en <strong>Noviembre</strong>';
										break;
									case '12':
										$mes = 'Diésel Entregado en <strong>Diciembre</strong>';
										break;

									default:
										$mes = 'No hay Información en este Mes';
										break;
								}
								if ($cargaGas['suma'] > 0) {
									$diesel = $cargaGas['suma'];
								} else {
									$diesel = 0;
								}

								##################################################################
								?>
								<div class="alert alert-callout alert-warning no-margin">
									<h1 class="pull-right text-dark"><i class="fa fa-tint"></i></h1>
									<button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#modalDiesel">
										<strong class="text-xl">
											&nbsp; <?= $diesel; ?> Lts. de Diésel<br /></strong></button>
									<span class="opacity-50"><?= $mes; ?></span>
								</div>
							</div>
							<!--end .card-body -->
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->
					<!-- END ALERT - TIME ON SITE -->

					<!-- BEGIN ALERT - TIME ON SITE -->
					<div class="col-md-3 col-sm-4">
						<div class="card">
							<div class="card-body no-padding">
								<?php
								#require('../include/connect.php');
								#error_reporting(E_ALL);
								$csql = " SELECT COUNT(cgc.idCatCombustible) AS cnt, SUM(cgc.cant) AS suma, MONTH(NOW()) AS noMes
														FROM cargacombustible cgc
														INNER JOIN catcombustibles ctc ON ctc.id = cgc.idCatCombustible
														WHERE cgc.idCatCombustible = '2' AND CONCAT(MONTH(cgc.fechaReg ),'-',YEAR(cgc.fechaReg )) = CONCAT(MONTH(NOW()),'-',YEAR(NOW()))
														GROUP BY cgc.idCatCombustible
										";
								$res = mysqli_query($link, $csql) or die('<p class="text-danger">Notifica a tu Administrador</p>');
								$cargaGas = mysqli_fetch_array($res);
								switch ($cargaGas['noMes']) {
									case '1':
										$mes = 'Gasolina Entregada en <strong>Enero</strong>';
										break;
									case '2':
										$mes = 'Gasolina Entregada en <strong>Febrero</strong>';
										break;
									case '3':
										$mes = 'Gasolina Entregada en <strong>Marzo</strong>';
										break;
									case '4':
										$mes = 'Gasolina Entregada en <strong>Abril</strong>';
										break;
									case '5':
										$mes = 'Gasolina Entregada en <strong>Mayo</strong>';
										break;
									case '6':
										$mes = 'Gasolina Entregada en <strong>Junio</strong>';
										break;
									case '7':
										$mes = 'Gasolina Entregada en <strong>Julio</strong>';
										break;
									case '8':
										$mes = 'Gasolina Entregada en <strong>Agosto</strong>';
										break;
									case '9':
										$mes = 'Gasolina Entregada en <strong>Septiembre</strong>';
										break;
									case '10':
										$mes = 'Gasolina Entregada en <strong>Octubre</strong>';
										break;
									case '11':
										$mes = 'Gasolina Entregada en <strong>Noviembre</strong>';
										break;
									case '12':
										$mes = 'Gasolina Entregada en <strong>Diciembre</strong>';
										break;

									default:
										$mes = 'No hay Información en este Mes';
										break;
								}
								if ($cargaGas['suma'] > 0) {
									$gas = $cargaGas['suma'];
								} else {
									$gas = 0;
								}

								##################################################################
								?>
								<div class="alert alert-callout alert-success no-margin">
									<h1 class="pull-right text-success"><i class="fa fa-tint"></i></h1>
									<button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#modalMagna">
										<strong class="text-xl">
											&nbsp; <?= $gas; ?> Lts. de Magna<br /></strong></button>
									<span class="opacity-50"><?= $mes; ?></span>
								</div>
							</div>
							<!--end .card-body -->
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->

					<div class="col-md-3 col-sm-4">
						<div class="card">
							<div class="card-body no-padding">
								<?php
								#require('../include/connect.php');
								#error_reporting(E_ALL);
								$csql = " SELECT COUNT(cgc.idCatCombustible) AS cnt, SUM(cgc.cant) AS suma, MONTH(NOW()) AS noMes
														FROM cargacombustible cgc
														INNER JOIN catcombustibles ctc ON ctc.id = cgc.idCatCombustible
														WHERE cgc.idCatCombustible = '1' AND CONCAT(MONTH(cgc.fechaReg ),'-',YEAR(cgc.fechaReg )) = CONCAT(MONTH(NOW()),'-',YEAR(NOW()))
														GROUP BY cgc.idCatCombustible
										";
								$res = mysqli_query($link, $csql) or die('<p class="text-danger">Notifica a tu Administrador</p>');
								$cargaGas = mysqli_fetch_array($res);
								switch ($cargaGas['noMes']) {
									case '1':
										$mes = 'Gasolina Entregada en <strong>Enero</strong>';
										break;
									case '2':
										$mes = 'Gasolina Entregada en <strong>Febrero</strong>';
										break;
									case '3':
										$mes = 'Gasolina Entregada en <strong>Marzo</strong>';
										break;
									case '4':
										$mes = 'Gasolina Entregada en <strong>Abril</strong>';
										break;
									case '5':
										$mes = 'Gasolina Entregada en <strong>Mayo</strong>';
										break;
									case '6':
										$mes = 'Gasolina Entregada en <strong>Junio</strong>';
										break;
									case '7':
										$mes = 'Gasolina Entregada en <strong>Julio</strong>';
										break;
									case '8':
										$mes = 'Gasolina Entregada en <strong>Agosto</strong>';
										break;
									case '9':
										$mes = 'Gasolina Entregada en <strong>Septiembre</strong>';
										break;
									case '10':
										$mes = 'Gasolina Entregada en <strong>Octubre</strong>';
										break;
									case '11':
										$mes = 'Gasolina Entregada en <strong>Noviembre</strong>';
										break;
									case '12':
										$mes = 'Gasolina Entregada en <strong>Diciembre</strong>';
										break;

									default:
										$mes = 'No hay Información en este Mes';
										break;
								}
								if ($cargaGas['suma'] > 0) {
									$gas = $cargaGas['suma'];
								} else {
									$gas = 0;
								}

								##################################################################
								?>
								<div class="alert alert-callout alert-danger no-margin">
									<h1 class="pull-right text-danger"><i class="fa fa-tint"></i></h1>
									<button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#modalPremium">
										<strong class="text-xl">
											&nbsp; <?= $gas; ?> Lts. de Premium<br /></strong></button>
									<span class="opacity-50"><?= $mes; ?></span>
								</div>
							</div>
							<!--end .card-body -->
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->
					<!-- END ALERT - TIME ON SITE -->

				</div>

				<!-- END ALERT - TIME ON SITE -->
				<div class="row">
					<div class="col-md-6">
						<div class="card ">
							<div class="card-head">
								<header>Información de Viajes Terminados y Viajes Pagados del Mes Actual</header>
							</div>
							<!--end .card-head -->

							<div id="graf0" class="flot height-7" data-title="Activity entry" data-color="#7dd8d2,#0aa89e"></div>

							<?php
							$vsql = "SELECT * FROM ((SELECT IF (vtsPgds.diap IS NULL, vjsTrm.diat, vtsPgds.diap) AS fechaAct,
																 vtsPgds.vtasPagadas, vjsTrm.vtasTerminadas
																FROM (SELECT vts.fechaCarga AS diap, COUNT(vts.estatusPago) AS vtasPagadas
																FROM ventas vts
																WHERE vts.estatusPago = 2 AND CONCAT(MONTH(vts.fechaCarga),'-',YEAR(vts.fechaCarga)) = CONCAT((MONTH(NOW())),'-',YEAR(NOW()))
																GROUP BY vts.fechaCarga ORDER BY vts.fechaCarga ASC) vtsPgds
																LEFT JOIN ((SELECT vjs.fechaEntrega AS diat, COUNT(vjs.estatusViaje) AS vtasTerminadas
																FROM ventas vjs
																WHERE vjs.estatusViaje = 3 AND CONCAT(MONTH(vjs.fechaEntrega),'-',YEAR(vjs.fechaEntrega)) = CONCAT((MONTH(NOW())),'-',YEAR(NOW()))
																GROUP BY vjs.fechaEntrega
																ORDER BY vjs.fechaEntrega ASC)) vjsTrm ON vtsPgds.diap = vjsTrm.diat )
																UNION
																(SELECT IF (vtsPgds.diap IS NULL, vjsTrm.diat, vtsPgds.diap) AS fechaAct,
																vtsPgds.vtasPagadas, vjsTrm.vtasTerminadas
																FROM (SELECT vts.fechaCarga AS diap, COUNT(vts.estatusPago) AS vtasPagadas
																FROM ventas vts
																WHERE vts.estatusPago = 2 AND CONCAT(MONTH(vts.fechaCarga),'-',YEAR(vts.fechaCarga)) = CONCAT((MONTH(NOW())),'-',YEAR(NOW()))
																GROUP BY vts.fechaCarga
																ORDER BY vts.fechaCarga ASC) vtsPgds
																RIGHT JOIN ((SELECT vjs.fechaEntrega AS diat, COUNT(vjs.estatusViaje) AS vtasTerminadas
																FROM ventas vjs
																WHERE vjs.estatusViaje = 3 AND CONCAT(MONTH(vjs.fechaEntrega),'-',YEAR(vjs.fechaEntrega)) = CONCAT((MONTH(NOW())),'-',YEAR(NOW()))
																GROUP BY vjs.fechaEntrega
																ORDER BY vjs.fechaEntrega ASC)) vjsTrm ON vtsPgds.diap = vjsTrm.diat)) todo ORDER BY todo.fechaAct";

							$vres = mysqli_query($link, $vsql) or die('<span class="text-danger"> Error en: </span>' . mysqli_error($link));
							?>

							<?php
							$datosGraf0 = '';
							while ($abc = mysqli_fetch_array($vres)) {
								$vnt = ($abc['vtasPagadas'] == '') ? 0 : $abc['vtasPagadas'];
								$Vjs = ($abc['vtasTerminadas'] == '') ? 0 : $abc['vtasTerminadas'];
								$fVjs = ($abc['fechaAct'] == '') ? 0 : $abc['fechaAct'];

								$datosGraf0 .= "{ Día: '" . $fVjs . "', Pagados: '" . $vnt . "', Terminados: '" . $Vjs . "'}, ";
							}
							$datosGraf0 = substr($datosGraf0, 0, -2);
							?>
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->

					<div class="col-md-6">
						<div class="card ">
							<div class="card-head">
								<header>Información de Nóminas por Pagar</header>
							</div>
							<!--end .card-head -->

							<div id="graf1" class="flot height-7" data-title="Activity entry" data-color="#7dd8d2,#0aa89e"></div>

							<?php

							$nsql = "SELECT CONCAT(op.nombre,' ',op.apellidos) AS nomComp,
																ve.noEconomico AS noEco, ru.pagoOperador AS pagoOpe
																FROM ventas vnt
																INNER JOIN viajes vjs ON vjs.idVenta = vnt.id
																INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
																INNER JOIN operadores op ON op.id = asgv.idOperador
																INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
																INNER JOIN rutas ru ON ru.id = vnt.idRuta
																WHERE vnt.estatusViaje = '3' AND CONCAT(MONTH(vnt.fechaCarga),'-',YEAR(vnt.fechaCarga)) = CONCAT((MONTH(NOW())),'-',YEAR(NOW()))
																AND (vnt.idNomina < '1' OR vnt.idNomina IS NULL)
																GROUP BY op.id
																ORDER BY vnt.id ASC";
							$nres = mysqli_query($link, $nsql) or die('<span class="text-danger"> Error en: </span>' . mysqli_error($link));

							?>

							<?php
							$datosGraf1 = '';

							while ($nom = mysqli_fetch_array($nres)) {
								$datosGraf1 .= "{ Operador: '" . $nom['nomComp'] . "', Pago: '" . $nom['pagoOpe'] . "'}, ";
							}
							$datosGraf1 = substr($datosGraf1, 0, -2);
							?>
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->

				</div>
				<!--end row -->

				<div class="row">
					<div class="col-md-12">
						<div class="card ">
							<div class="card-head">
								<header>Información de Viajes Terminados y Viajes Pagados del Mes Anterior</header>
							</div>
							<!--end .card-head -->

							<div id="graf2" class="flot height-7" data-title="Activity entry" data-color="#7dd8d2,#0aa89e"></div>

							<?php
							$vsql2 = "SELECT * FROM ((SELECT IF (vtsPgds.diap IS NULL, vjsTrm.diat, vtsPgds.diap) AS fechaAct,
																 vtsPgds.vtasPagadas, vjsTrm.vtasTerminadas
																FROM (SELECT vts.fechaCarga AS diap, COUNT(vts.estatusPago) AS vtasPagadas
																FROM ventas vts
																WHERE vts.estatusPago = 2 AND CONCAT(MONTH(vts.fechaCarga),'-',YEAR(vts.fechaCarga)) = CONCAT((MONTH(NOW())-1),'-',YEAR(NOW()))
																GROUP BY vts.fechaCarga ORDER BY vts.fechaCarga ASC) vtsPgds
																LEFT JOIN ((SELECT vjs.fechaEntrega AS diat, COUNT(vjs.estatusViaje) AS vtasTerminadas
																FROM ventas vjs
																WHERE vjs.estatusViaje = 3 AND CONCAT(MONTH(vjs.fechaEntrega),'-',YEAR(vjs.fechaEntrega)) = CONCAT((MONTH(NOW())-1),'-',YEAR(NOW()))
																GROUP BY vjs.fechaEntrega
																ORDER BY vjs.fechaEntrega ASC)) vjsTrm ON vtsPgds.diap = vjsTrm.diat )
																UNION
																(SELECT IF (vtsPgds.diap IS NULL, vjsTrm.diat, vtsPgds.diap) AS fechaAct,
																vtsPgds.vtasPagadas, vjsTrm.vtasTerminadas
																FROM (SELECT vts.fechaCarga AS diap, COUNT(vts.estatusPago) AS vtasPagadas
																FROM ventas vts
																WHERE vts.estatusPago = 2 AND CONCAT(MONTH(vts.fechaCarga),'-',YEAR(vts.fechaCarga)) = CONCAT((MONTH(NOW())-1),'-',YEAR(NOW()))
																GROUP BY vts.fechaCarga
																ORDER BY vts.fechaCarga ASC) vtsPgds
																RIGHT JOIN ((SELECT vjs.fechaEntrega AS diat, COUNT(vjs.estatusViaje) AS vtasTerminadas
																FROM ventas vjs
																WHERE vjs.estatusViaje = 3 AND CONCAT(MONTH(vjs.fechaEntrega),'-',YEAR(vjs.fechaEntrega)) = CONCAT((MONTH(NOW())-1),'-',YEAR(NOW()))
																GROUP BY vjs.fechaEntrega
																ORDER BY vjs.fechaEntrega ASC)) vjsTrm ON vtsPgds.diap = vjsTrm.diat)) todo ORDER BY todo.fechaAct";

							$vres2 = mysqli_query($link, $vsql2) or die('<span class="text-danger"> Error en: </span>' . mysqli_error($link));
							?>

							<?php
							$datosGraf2 = '';
							while ($abc2 = mysqli_fetch_array($vres2)) {
								$vnt2 = ($abc2['vtasPagadas'] == '') ? 0 : $abc2['vtasPagadas'];
								$Vjs2 = ($abc2['vtasTerminadas'] == '') ? 0 : $abc2['vtasTerminadas'];
								$fVjs2 = ($abc2['fechaAct'] == '') ? 0 : $abc2['fechaAct'];

								$datosGraf2 .= "{ Día: '" . $fVjs2 . "', Pagados: '" . $vnt2 . "', Terminados: '" . $Vjs2 . "'}, ";
							}
							$datosGraf2 = substr($datosGraf2, 0, -2);
							?>
						</div>
						<!--end .card -->
					</div>
					<!--end .col -->
				</div>
				<!--end row -->

			</section>
		</div>
		<!--end #content-->
		<!-- END CONTENT -->

		<!-- BEGIN MENUBAR-->
		<div id="menubar" class="menubar-inverse ">

			<div class="menubar-scroll-panel">

				<!-- BEGIN MAIN MENU -->
				<ul id="main-menu" class="gui-controls">

					<!-- MENU LATERAL -->
					<?= $info->generaMenuLateral(); ?>

				</ul>
				<!--end .main-menu -->
				<!-- END MAIN MENU -->

			</div>
			<!--end .menubar-scroll-panel-->
		</div>
		<!--end #menubar-->
		<!-- END MENUBAR -->

		<!-- BEGIN SIMPLE MODAL MARKUP -->
		<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="simpleModalLabel">Productos</h4>
					</div>

					<div class="modal-body">
						<?php
						require('../include/connect.php');
						//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
						//print_r($_SESSION);			//muestra las sesiones
						$sql = "SELECT *
											FROM
												(SELECT stk.idProducto, pdt.nombre, COUNT(stk.idProducto) AS cantDisponible, pdt.min AS cantMinima, pdt.max AS cantMaxima
												FROM stocks stk
												INNER JOIN productos pdt ON stk.idProducto = pdt.id
												WHERE
													stk.estatus IN (4,1)
												GROUP BY stk.idProducto) AS lisProd
											WHERE
												cantDisponible <= cantMinima";
						$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
						?>
						<div class="table-responsive">
							<table id="datatable1" class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Cantidad Actual</th>
										<th>Cantidad Mínima</th>
										<th>Cantidad Máxima</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$cont = 0;
									while ($dat = mysqli_fetch_array($res)) {
										echo '
											<tr>
												<td>' . ++$cont . '</td>
												<td>' . $dat['nombre'] . '</td>
												<td class="text-center">' . $dat['cantDisponible'] . '</td>
												<td class="text-center">' . $dat['cantMinima'] . '</td>
												<td class="text-center">' . $dat['cantMaxima'] . '</td>
											</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
						<!--end .table-responsive -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- END SIMPLE MODAL MARKUP -->


		<!-- BEGIN SIMPLE MODAL MARKUP -->
		<div class="modal fade" id="modalDiesel" tabindex="-1" role="dialog" aria-labelledby="modalDieselLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="modalDieselLabel">Desgloce del Mes de Diésel</h4>
					</div>

					<div class="modal-body">
						<?php
						require('../include/connect.php');
						//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
						//print_r($_SESSION);			//muestra las sesiones
						$dsql = "SELECT CONCAT('ECO - ',ve.noEconomico,' PLACAS: ',ve.placas,' (',op.nombre,' ',op.apellidos,')') AS nVe, SUM(carco.cant) AS lts,
								COUNT(vjs.id) AS cantViajes, (MAX(carco.kilometraje)-MIN(carco.kilometraje)) AS kilometrajeRec
																FROM cargacombustible carco
																INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
																INNER JOIN viajes vjs ON vjs.id = carco.idViaje
																INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
																INNER JOIN operadores op ON op.id = asgv.idOperador
																INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
																WHERE catco.id = 3 AND CONCAT(MONTH(carco.fechaReg ),'-',YEAR(carco.fechaReg )) = CONCAT(MONTH(NOW()),'-',YEAR(NOW()))
																GROUP BY op.id
																ORDER BY carco.idGasolinera ASC";
						$dres = mysqli_query($link, $dsql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
						?>
						<div class="table-responsive">
							<table id="datatable1" class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Vehículo</th>
										<th class="">Lts Ent.</th>
										<th class="">Viajes</th>
										<th class="">Km. Rec.</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$numRow = mysqli_num_rows($dres);

									$cont = 0;
									if ($numRow > 0) {
										while ($ddat = mysqli_fetch_array($dres)) {
											echo '
											<tr>
												<td>' . ++$cont . '</td>
												<td>' . $ddat['nVe'] . '</td>
												<td class="">' . number_format($ddat['lts'], 2, '.', ',') . '</td>
												<td class="">' . number_format($ddat['cantViajes'], 2, '.', ',') . '</td>
												<td class="">' . number_format($ddat['kilometrajeRec'], 2, '.', ',') . '</td>
											</tr>';
										}
									} else {
										echo '
										<tr>
											<td colspan="5" class="text-danger text-center">Sin Viajes Registrados...</td>
										</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
						<!--end .table-responsive -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- END SIMPLE MODAL MARKUP -->


		<!-- BEGIN SIMPLE MODAL MARKUP -->
		<div class="modal fade" id="modalMagna" tabindex="-1" role="dialog" aria-labelledby="modalMagnaLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="modalMagnaLabel">Desgloce del Mes de Magna</h4>
					</div>

					<div class="modal-body">
						<?php
						require('../include/connect.php');
						//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
						//print_r($_SESSION);			//muestra las sesiones
						$msql = "SELECT CONCAT('ECO - ',ve.noEconomico,' PLACAS: ',ve.placas,' (',op.nombre,' ',op.apellidos,')') AS nVe, SUM(carco.cant) AS lts,
											COUNT(vjs.id) AS cantViajes
																FROM cargacombustible carco
																INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
																INNER JOIN viajes vjs ON vjs.id = carco.idViaje
																INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
																INNER JOIN operadores op ON op.id = asgv.idOperador
																INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
																WHERE catco.id = 2 AND CONCAT(MONTH(carco.fechaReg ),'-',YEAR(carco.fechaReg )) = CONCAT(MONTH(NOW()),'-',YEAR(NOW()))
																GROUP BY op.id
																ORDER BY carco.idGasolinera ASC";
						$mres = mysqli_query($link, $msql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
						?>
						<div class="table-responsive">
							<table id="datatable1" class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Vehículo</th>
										<th class="">Lts Ent.</th>
										<th class="">Viajes</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$numRow = mysqli_num_rows($mres);
									$cont = 0;
									if ($numRow > 0) {
										while ($mdat = mysqli_fetch_array($mres)) {
											echo '
												<tr>
													<td>' . ++$cont . '</td>
													<td>' . $mdat['nVe'] . '</td>
													<td class="">' . number_format($mdat['lts'], 2, '.', ',') . '</td>
													<td class="">' . number_format($mdat['cantViajes'], 2, '.', ',') . '</td>
												</tr>';
										}
									} else {
										echo '
											<tr>
												<td colspan="4" class="text-danger text-center">Sin Viajes Registrados...</td>
											</tr>';
									}

									?>
								</tbody>
							</table>
						</div>
						<!--end .table-responsive -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- END SIMPLE MODAL MARKUP -->


		<!-- BEGIN SIMPLE MODAL MARKUP -->
		<div class="modal fade" id="modalPremium" tabindex="-1" role="dialog" aria-labelledby="modalPremiumLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="modalDieselLabel">Desgloce del Mes de Premium</h4>
					</div>

					<div class="modal-body">
						<?php
						require('../include/connect.php');
						//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
						//print_r($_SESSION);			//muestra las sesiones
						$psql = "SELECT CONCAT('ECO - ',ve.noEconomico,' PLACAS: ',ve.placas,' (',op.nombre,' ',op.apellidos,')') AS nVe, SUM(carco.cant) AS lts
												,COUNT(carco.id) AS cantViajes
																FROM cargacombustible carco
																INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
																INNER JOIN asignavehiculos asgv ON carco.idVehiculoPersonal = asgv.idVehiculo
																INNER JOIN operadores op ON op.id = asgv.idOperador
																INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
																WHERE catco.id = 1 AND CONCAT(MONTH(carco.fechaReg ),'-',YEAR(carco.fechaReg )) = CONCAT(MONTH(NOW()),'-',YEAR(NOW()))
																GROUP BY op.id
																ORDER BY carco.idGasolinera ASC";
						$pres = mysqli_query($link, $psql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
						?>
						<div class="table-responsive">
							<table id="datatable1" class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Vehículo</th>
										<th class="">Lts Ent.</th>
										<th class="">Viajes</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$numRow = mysqli_num_rows($pres);

									$cont = 0;
									if ($numRow > 0) {
										while ($pdat = mysqli_fetch_array($pres)) {
											echo '
											<tr>
												<td>' . ++$cont . '</td>
												<td>' . $pdat['nVe'] . '</td>
												<td class="">' . number_format($pdat['lts'], 2, '.', ',') . '</td>
												<td class="">' . $pdat['cantViajes'] . '</td>
											</tr>';
										}
									} else {
										echo '
										<tr>
											<td colspan="4" class="text-danger text-center">Sin Viajes Registrados...</td>
										</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
						<!--end .table-responsive -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" id="modalDiesel2" tabindex="-1" role="dialog" aria-labelledby="modalDieselLabel2" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="modalDieselLabel2">Desgloce del Mes de Diésel</h4>
					</div>

					<div class="modal-body">
						<?php
						require('../include/connect.php');
						//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
						//print_r($_SESSION);			//muestra las sesiones
						$dsql = "SELECT CONCAT('ECO - ',ve.noEconomico,' PLACAS: ',ve.placas,' (',op.nombre,' ',op.apellidos,')') AS nVe, SUM(carco.cant) AS lts,
						COUNT(vjs.id) AS cantViajes, (MAX(carco.kilometraje)-MIN(carco.kilometraje)) AS kilometrajeRec
											FROM cargacombustible carco
											INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
											INNER JOIN viajes vjs ON vjs.id = carco.idViaje
											INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
											INNER JOIN operadores op ON op.id = asgv.idOperador
											INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
											WHERE catco.id = 3 
											AND  DATE_FORMAT(carco.fechaReg,'%m-%Y') =DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH,'%m-%Y')
											GROUP BY op.id
											ORDER BY carco.idGasolinera ASC";
						$dres = mysqli_query($link, $dsql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
						?>
						<div class="table-responsive">
							<table id="datatable1" class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Vehículo</th>
										<th>Litros Entregados</th>
										<th>Viajes Realizados</th>
										<th>Km. Rec.</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$numRow = mysqli_num_rows($dres);
									$cont = 0;
									if ($numRow > 0) {
										while ($ddat = mysqli_fetch_array($dres)) {
											echo '
						<tr>
							<td>' . ++$cont . '</td>
							<td>' . $ddat['nVe'] . '</td>
							<td class="">' . number_format($ddat['lts'], 2, '.', ',') . '</td>
							<td class="">' . number_format($ddat['cantViajes'], 2, '.', ',') . '</td>
							<td class="">' . number_format($ddat['kilometrajeRec'], 2, '.', ',') . '</td>
						</tr>';
										}
									} else {
										echo '
								<tr>
									<td colspan="5" class="text-danger text-center">Sin Viajes Registrados...</td>
								</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
						<!--end .table-responsive -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- END SIMPLE MODAL MARKUP -->


		<!-- BEGIN SIMPLE MODAL MARKUP -->
		<div class="modal fade" id="modalMagna2" tabindex="-1" role="dialog" aria-labelledby="modalMagnaLabel2" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="modalMagnaLabel2">Desgloce del Mes de Magna</h4>
					</div>

					<div class="modal-body">
						<?php
						require('../include/connect.php');
						//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
						//print_r($_SESSION);			//muestra las sesiones
						$msql = "SELECT CONCAT('ECO - ',ve.noEconomico,' PLACAS: ',ve.placas,' (',op.nombre,' ',op.apellidos,')') AS nVe, SUM(carco.cant) AS lts,
											COUNT(vjs.id) AS cantViajes
																FROM cargacombustible carco
																INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
																INNER JOIN viajes vjs ON vjs.id = carco.idViaje
																INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
																INNER JOIN operadores op ON op.id = asgv.idOperador
																INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
																WHERE catco.id = 2 
																AND  DATE_FORMAT(carco.fechaReg,'%m-%Y') =DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH,'%m-%Y')

																GROUP BY op.id
																ORDER BY carco.idGasolinera ASC";
						$mres = mysqli_query($link, $msql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
						?>
						<div class="table-responsive">
							<table id="datatable1" class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Vehículo</th>
										<th>Litros Entregados</th>
										<th>Viajes Realizados</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$numRow = mysqli_num_rows($mres);

									$cont = 0;
									if ($numRow > 0) {
										while ($mdat = mysqli_fetch_array($mres)) {
											echo '
											<tr>
												<td>' . ++$cont . '</td>
												<td>' . $mdat['nVe'] . '</td>
												<td class="text-center">' . $mdat['lts'] . '</td>
												<td class="text-center">' . $mdat['cantViajes'] . '</td>
											</tr>';
										}
									} else {
										echo '
										<tr>
											<td colspan="4" class="text-danger text-center">Sin Viajes Registrados...</td>
										</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
						<!--end .table-responsive -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- END SIMPLE MODAL MARKUP -->


		<!-- BEGIN SIMPLE MODAL MARKUP -->
		<div class="modal fade" id="modalPremium2" tabindex="-1" role="dialog" aria-labelledby="modalPremiumLabel2" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="modalDieselLabel2">Desgloce del Mes de Premium</h4>
					</div>

					<div class="modal-body">
						<?php
						require('../include/connect.php');
						//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
						//print_r($_SESSION);			//muestra las sesiones
						$psql = "SELECT CONCAT('ECO - ',ve.noEconomico,' PLACAS: ',ve.placas,' (',op.nombre,' ',op.apellidos,')') AS nVe, SUM(carco.cant) AS lts
							,COUNT(carco.id) AS cantViajes
											FROM cargacombustible carco
											INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
											INNER JOIN asignavehiculos asgv ON carco.idVehiculoPersonal = asgv.idVehiculo
											INNER JOIN operadores op ON op.id = asgv.idOperador
											INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
											WHERE catco.id = 1 
											AND  DATE_FORMAT(carco.fechaReg,'%m-%Y') =DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH,'%m-%Y')
											GROUP BY op.id
											ORDER BY carco.idGasolinera ASC";
						$pres = mysqli_query($link, $psql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
						?>
						<div class="table-responsive">
							<table id="datatable1" class="table table-striped table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>Vehículo</th>
										<th>Litros Entregados</th>
										<th>Viajes Realizados</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$numRow = mysqli_num_rows($pres);
									$cont = 0;
									if ($numRow > 0) {
										while ($pdat = mysqli_fetch_array($pres)) {
											echo '
									<tr>
										<td>' . ++$cont . '</td>
										<td>' . $pdat['nVe'] . '</td>
										<td class="text-center">' . $pdat['lts'] . '</td>
										<td class="text-center">' . $pdat['cantViajes'] . '</td>
									</tr>';
										}
									} else {
										echo '
									<tr>
										<td colspan="4" class="text-danger text-center">Sin Viajes Registrados...</td>
									</tr>';
									}
									?>
								</tbody>
							</table>
						</div>
						<!--end .table-responsive -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- END SIMPLE MODAL MARKUP -->


	</div>
	</div>
	<!--end #base-->
	<!-- END BASE -->

	<!-- BEGIN JAVASCRIPT -->
	<script src="../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
	<script src="../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
	<script src="../assets/js/libs/bootstrap/bootstrap.min.js"></script>
	<script src="../assets/js/libs/spin.js/spin.min.js"></script>
	<script src="../assets/js/libs/autosize/jquery.autosize.min.js"></script>
	<script src="../assets/js/libs/moment/moment.min.js"></script>
	<script src="../assets/js/libs/flot/jquery.flot.min.js"></script>
	<script src="../assets/js/libs/flot/jquery.flot.time.min.js"></script>
	<script src="../assets/js/libs/flot/jquery.flot.resize.min.js"></script>
	<script src="../assets/js/libs/flot/jquery.flot.orderBars.js"></script>
	<script src="../assets/js/libs/flot/jquery.flot.pie.js"></script>
	<script src="../assets/js/libs/flot/curvedLines.js"></script>
	<script src="../assets/js/libs/jquery-knob/jquery.knob.min.js"></script>
	<script src="../assets/js/libs/sparkline/jquery.sparkline.min.js"></script>
	<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
	<script src="../assets/js/libs/d3/d3.min.js"></script>
	<script src="../assets/js/libs/d3/d3.v3.js"></script>
	<script src="../assets/js/core/source/App.js"></script>
	<script src="../assets/js/core/source/AppNavigation.js"></script>
	<script src="../assets/js/core/source/AppOffcanvas.js"></script>
	<script src="../assets/js/core/source/AppCard.js"></script>
	<script src="../assets/js/core/source/AppForm.js"></script>
	<script src="../assets/js/core/source/AppNavSearch.js"></script>
	<script src="../assets/js/core/source/AppVendor.js"></script>
	<!--script src="assets/js/core/demo/DemoCharts.js"></script -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script>
		//			Morris.Line({

		Morris.Bar({
			element: 'graf0',
			data: [
				<?= $datosGraf0; ?>
			],

			xkey: 'Día',
			ykeys: ['Pagados', 'Terminados'],
			labels: ['Pagados', 'Terminados'],
			hideHover: 'auto',
			resize: true,
			lineColors: ['blue', 'green']
		});

		Morris.Bar({
			element: 'graf1',
			data: [
				<?= $datosGraf1; ?>
			],

			xkey: 'Operador',
			ykeys: ['Pago'],
			labels: ['Pago'],
			hideHover: 'auto',
			resize: true,
		});


		Morris.Bar({
			element: 'graf2',
			data: [
				<?= $datosGraf2; ?>
			],

			xkey: 'Día',
			ykeys: ['Pagados', 'Terminados'],
			labels: ['Pagados', 'Terminados'],
			hideHover: 'auto',
			resize: true,
			lineColors: ['blue', 'green']
		});



		Morris.Line({
			element: 'grafica',
			data: [
				<?= $datosGrafica; ?>
			],

			xkey: 'Operador',
			ykeys: ['Rendimiento'],
			labels: ['Rendimiento'],
			hideHover: 'auto',
			resize: true,
		});
	</script>
	<!-- END JAVASCRIPT -->

</body>

</html>