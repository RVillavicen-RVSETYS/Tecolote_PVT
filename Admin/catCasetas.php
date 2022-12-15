	<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('catCasetas.php');
require '../include/connect.php';
require_once('../funciones/notificaAdmin.php');

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
								<a href="admin.php">
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
				<!--===================================================================================-->
						<div class="col-md-12">
							<div class="card card-bordered style-primary">
								<div class="card-head">
									<div class="tools">
										<div class="btn-group">
											<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
										</div>
									</div>
									<header><i class="fa fa-fw md-store"></i> Captura la Caseta</header>
								</div><!--end .card-head -->
								<div class="card-body style-default-bright">
									<form class="form" role="form" action="../funciones/registraNuevaCaseta.php" method="post">
										<div class="row">
											<div class="form-group floating-label col-lg-12">
												<div class="col-sm-2"></div>
												<div class="col-sm-2">
								          <label for="nombre"><h4>Nombre de la Caseta</h4></label>
								        </div>
												<div class="col-sm-5">
													<input type="text" class="form-control" id="newCaseta" name="nombre">
												</div>
											</div>
										</div>
										 	<div class="row">
												<div class="col-sm-12 text-center">
								          <label for="nombre"><h4>Costos</h4></label>
								        </div>
											</div>
											<div class="row">
												<div class="col-sm-2 text-center">
								          <label for="nombre"><h4>Autos</h4></label>
								        </div>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="newc" name="newc">
												</div>

												<div class="col-sm-2 text-center">
								          <label for="nombre"><h4>2, 3 y 4 Ejes</h4></label>
								        </div>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="newc2" name="newc2">
												</div>

												<div class="col-sm-2 text-center">
								          <label for="nombre"><h4>5 y 6 Ejes</h4></label>
								        </div>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="newc3" name="newc3">
												</div>
											</div>
											<div class="row">
												<div class="col-sm-2 text-center">
								          <label for="nombre"><h4>7, 8 y 9 Ejes</h4></label>
								        </div>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="newc4" name="newc4">
												</div>

												<div class="col-sm-2 text-center">
								          <label for="nombre"><h4>Excedente Ligero</h4></label>
								        </div>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="newc5" name="newc5">
												</div>

												<div class="col-sm-2 text-center">
								          <label for="nombre"><h4>Excedente Carga</h4></label>
								        </div>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="newc6" name="newc6">
												</div>
											</div>

									<div class="row">
										<div class="col-sm-4"></div>
										<div class="col-lg-4 text-center">
											<button type="submit" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Cargando...">Agregar Caseta</button>
										</div>
										<div class="col-sm-4"></div>
										</div>
									</form>
								</div><!--end .card-body -->
							</div><!--end .col -->

							<div class="col-lg-12">
								<div id="infoCasetas" name="infoCasetas" class="card-body style-default-bright table-responsive">
									<?php
										require('../include/connect.php');
										$sql="SELECT *
													FROM casetas cs
													ORDER BY nombre ASC";
										$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
										//echo $sql;
									?>
									<table class="table no-margin table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th class="text-center">Nombre</th>
												<th class="text-center">Autos</th>
												<th class="text-center">Camión 2, 3 y 4 Ejes</th>
												<th class="text-center">Camión 5 y 6 Ejes</th>
												<th class="text-center">Camión 7, 8 y 9 Ejes</th>
												<th class="text-center">Eje Excedente Ligero</th>
												<th class="text-center">Eje Excelente Carga</th>
												<th class="col-lg-2 text-right">Editar</th>
											</tr>

										</thead>
										<tbody>
											<?php
											$count = 0;
											while ($dat = mysqli_fetch_array($res)) {
												$count++;
												echo '
												<tr class="">
													<td>'.$count.'</td>
													<td class="text-center"><center>'.$dat['nombre'].'</center></td>
													<td class="text-center"><center>$ '.$dat['costo'].'</center></td>
													<td class="text-center"><center>$ '.$dat['costo2'].'</td>
													<td class="text-center">$ '.$dat['costo3'].'</td>
													<td class="text-center">$ '.$dat['costo4'].'</td>
													<td class="text-center">$ '.$dat['costo5'].'</td>
													<td class="text-center">$ '.$dat['costo6'].'</td>
													<td class="text-right">
														<button type="button" class="btn btn-icon-toggle" onclick="formEditCaseta('.$dat['id'].')" data-toggle="modal" data-target="#formEditCaseta"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
													</td>
												</tr>';
											}
											?>
										</tbody>
									</table>
								</div>

							</div><!--end .col -->
							<div class="col-lg-2"></div>

					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->

			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formEditCaseta" tabindex="-1" role="dialog" aria-labelledby="formEditCasetaLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaCasetaContent">
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
		<script src="../assets/js/libs/toastr/toastr.js"></script>
		<script>
		function formEditCaseta(ident){
			$("#editaCasetaBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
			//alert('ID: '+ident);
			$.post("../funciones/formEditaCaseta.php",
				{ ident:ident},
					function(respuesta){
						$("#editaCasetaContent").html(respuesta);
					});
		}

		<?php
		if (isset( $_SESSION['ATZmsjAdminCatCasetas'])) {
			echo "notificaBad('".$_SESSION['ATZmsjAdminCatCasetas']."');";
			unset($_SESSION['ATZmsjAdminCatCasetas']);
		}
		if (isset( $_SESSION['ATZmsjSuccesAdminCatCasetas'])) {
			echo "notificaSuc('".$_SESSION['ATZmsjSuccesAdminCatCasetas']."');";
			unset($_SESSION['ATZmsjSuccesAdminCatCasetas']);
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

		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
