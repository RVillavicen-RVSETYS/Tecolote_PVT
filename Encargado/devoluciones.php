<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('devoluciones.php');
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
	<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileinput.css" />
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
							<?php
							require('../include/connect.php');
							$consql="SELECT usu.id, CONCAT(usu.nombre,' ',usu.apellidos) AS nombreCOmp
											FROM operadores usu
											WHERE usu.estatus = '1'
											ORDER BY nombreCOmp ASC";
							$conres=mysqli_query($link,$consql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
								// code...
								if (isset($_SESSION['ATZcampo1Operador'])) {
									$idCatTabla = $_SESSION['ATZcampo1Operador'];
									$catego = ($idCatTabla == $Empdat['id']) ? 'Operador: '.$Empdat['nombreCOmp'].'' : 'Selecciona el Operador';
									while ($Empdat=mysqli_fetch_array($conres)) {
									$catego = ($idCatTabla == $Empdat['id']) ? 'Operador: '.$Empdat['nombreCOmp'].'' : $catego;
								}
									$inputNewMarca = '';
									$btnNewMarca = 'type="submit"';
									$lanzaPopOver = '';
								} else {
									$idCatTabla = 0;
									$catego = 'Selecciona el Operador';
									$inputNewMarca = 'disabled';
									$btnNewMarca = 'type="button" disabled';
									$lanzaPopOver = '$("#seleccionaOperador").popover("show");';
								}
							?>
							<div class="col-md-12">
								<div class="card card-bordered style-primary card-underline" id="cardDevoluciones">
									<div class="card-head">
										<div class="tools">
											<?php
										  require('../include/connect.php');
										  error_reporting(E_ALL); //muestra todos los errores encontrados en la página
										  $Empsql = "SELECT usu.id, CONCAT(usu.nombre,' ',usu.apellidos) AS nombreCOmp
										          FROM operadores usu
										          WHERE usu.estatus = '1'
										          ORDER BY nombreCOmp ASC";
										  $Empres = mysqli_query($link, $Empsql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));

										  ?>
											<div class="btn-group" id="seleccionaOperador" data-toggle="popover" data-placement="top" data-content="Por favor selecciona un Operador para Comenzar." data-original-title="" title="Atención!">
													<select name="usuAsigna" id="opAsigna" class="btn ink-reaction btn-flat dropdown-toggle" onchange="lista(this.value)">
													<?php
													error_reporting(E_ALL);
													echo '<option value="">Selecciona un Operador</option>';
													while ($Empdat = mysqli_fetch_array($Empres)) {
														echo '<option class="style-default" value="'.$Empdat['id'].'">'.$Empdat['nombreCOmp'].'</option>';
												  }
													?>
												</select>
											</div><!--end .btn-group -->
										</div>



										<header><i class="fa fa-fw"></i>Devoluciones</header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright">
										<form class="form" method="post" action="../funciones/capturaDevolucion.php">
											<div id="devoluciones" class="card-body style-default-bright table-responsive">
											</div>
											<div class="col-md-6 offset-md-2 txt-Right table-responsive" style="vertical-align: baseline;">
												<center><br><br>
													<textarea id="descDevuelve" name="descDevuelve" cols="50" placeholder=" Ingresa la Descripción" required></textarea>
												</center>
											</div>
											<div class="col-md-3 txt-Right" style="vertical-align: baseline;">
												<center><br><br>
													<button type="submit" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Cargando...">Devolver</button>
												</center>
											</div>
									</form>
									</div><!--end .card-body -->
								</div><!--end .card -->
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
		<script src="../assets/scripts/cadenas.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="../assets/js/libs/toastr/toastr.js"></script>
		<script>
		$(document).ready(function(){
			<?php
			if (isset( $_SESSION['ATZmsjDevoluciones'])) {
				echo "notificaBad('".$_SESSION['ATZmsjDevoluciones']."');";
				unset($_SESSION['ATZmsjDevoluciones']);
			}
			if (isset( $_SESSION['ATZmsjSuccessBajasDevoluciones'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccessDevoluciones']."');";
				unset($_SESSION['ATZmsjSuccessDevoluciones']);
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

/////////////////Aqui se le agrega el nombre al documento
function visualizaImg(foto,nombre){
		$("#cuerpoModal").html('<img class="img-responsive" width="100%" height="100%" src="'+foto+'">');
	$("#simpleModalLabel").html(nombre);
}

function lista(ident){
	$.post("../funciones/listarAsignaciones.php",
			{ident:ident},
				function(respuesta){
				$("#devoluciones").html(respuesta);
			});
	}

		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
