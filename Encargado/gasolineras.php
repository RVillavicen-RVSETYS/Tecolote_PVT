<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('gasolineras.php');
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
							<div class="col-lg-8">
								<article class="margin-bottom-xxl">
									<p class="lead"><?=$info->detailPag;?></p>
								</article>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

						<!-- BEGIN ACTION -->
						<div class="card">
							<div class="card-head">
								<header> Gasolineras</header>
								<div class="tools">
									<div class="btn-group" data-toggle="tooltip" data-placement="top" data-original-title="Crear nueva Gasolinera">
										<a class="btn btn-floating-action btn-primary" data-toggle="modal" data-target="#formNewGasolinera"><i class="fa fa-plus"></i></a>
									</div>
								</div>
							</div>
							<div class="card-body">
									<!-- BEGIN DATATABLE 1 -->
									<div class="row">
									<div class="col-lg-12">
									<div class="card-body table-responsive">
										<?php
											require('../include/connect.php');
											#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											#print_r($_SESSION);			//muestra las sesiones
											$sql="SELECT gas.*, ce.nombre AS nameEstado, cm.nombre AS nameMunicipio, gas.credito AS gasCredito
														FROM gasolineras gas
														INNER JOIN catestados ce ON gas.idCatEstado = ce.id
														INNER JOIN catmunicipios cm ON gas.idCatMunicipio = cm.id
														ORDER BY nombre ASC";
														//print_r($sql);
											$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
										?>
										<table id="datatable1" class="table table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Nombre de la Gasolinera</th>
													<th>Estado</th>
													<th>Municipio</th>
													<th>Dirección</th>
													<th># Cliente</th>
													<th>Crédito</th>
													<th>Estatus</th>
													<th>Editar</th>
												</tr>
											</thead>
											<tbody>
												<?php
												while ($dat = mysqli_fetch_array($res)) {
													$estatus = ($dat['estatus'] == '1') ? '<i class="fa fa-check">' : '<i class="fa fa-close">';
													$estatusText = ($dat['estatus'] == '1') ? '' : 'class="text-danger"';
													$estatusColor = ($dat['estatus'] == '1') ? 'text-success' : '';
													if ($dat['gasCredito'] == 1) {
														$mensaje= 'Sí';
													} else {
														$mensaje= 'No';
													}
													echo '
													<tr '.$estatusText.'>
														<td>'.$dat['id'].'</td>
														<td>'.$dat['nombre'].'</td>
														<td>'.$dat['nameEstado'].'</td>
														<td>'.$dat['nameMunicipio'].'</td>
														<td>'.$dat['direccion'].'</td>
														<td>'.$dat['referencia'].'</td>
														<td>'.$mensaje.'</td>
														<td class="col-lg-1 text-center '.$estatusColor.'" id="aseguradorasEstatus'.$dat['id'].'">'.$estatus.'</td>
														<td class="text-center">
															<button type="button" class="btn btn-icon-toggle" onclick="formEditGasolinera('.$dat['id'].')" data-toggle="modal" data-target="#formEditGasolinera"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
														</td>
													</tr>';
												}
												?>
											</tbody>
										</table>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->

							</div><!--end .col -->
						</div><!--end .row -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->

			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formEditGasolinera" tabindex="-1" role="dialog" aria-labelledby="formEditGasolineraLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaGasolineraContent">
					</div>
					<!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="formNewGasolinera" tabindex="-1" role="dialog" aria-labelledby="formNewGasolineraLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formModalLabel1">Crear Gasolinera</h4>
						</div>
						<form class="form-horizontal" role="form" method="post" action="../funciones/registraNuevaGasolinera.php" >
							<div class="modal-body">
								<div class="form-group">
									<div class="col-sm-3">
										<label for="newNombre" class="control-label">Nombre</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="newNombre" id="newNombre" class="form-control" placeholder="Nombre de la Gasolinera" require>
									</div>
								</div>
								<div class="form-group">
					        <div class="col-sm-3">
					          <label for="newEstado" class="control-label">Estado</label>
					        </div>
					        <div class="col-sm-9">
					          <div class="form-control">
					            <?php
					            $sql="SELECT * FROM catestados ORDER BY nombre ASC";
					            $res=mysqli_query($link,$sql) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');
					             ?>
					            <select id="newEstado" name="newEstado" onchange="newlistaCatMunicipio(this.value);" class="form-control" require>
					              <option value=""></option>
					              <?php
					              while ($dat = mysqli_fetch_array($res)) {
					                echo '
					                <option value="'.$dat['id'].'">'.$dat['nombre'].'</option>
					                ';
					              }
					               ?>
					            </select>
					          </div>
					        </div>
					      </div>
								<div class="form-group">
					        <div class="col-sm-3">
					          <label for="newMunicipio" class="control-label">Municipo</label>
					        </div>
					        <div class="col-sm-9">
					          <div class="form-control">
					            <select id="newMunicipio" name="newMunicipio" class="form-control " value="<?=$dat['idCatMunicipio'];?>" require>
					              <option value="">&nbsp;</option>
					            </select>
					          </div>
					        </div>
					      </div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="newDireccion" class="control-label">Dirección</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="newDireccion" id="newDireccion" class="form-control" placeholder="Dirección" require>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="newReferencia" class="control-label">N° Cliente	</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="newReferencia" id="newReferencia" class="form-control" placeholder="#Cliente">
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-3">
						        <label for="credito" class="control-label">Crédito</label>
						      </div>
						      <div class="col-sm-9">
						        <select id="credito" name="credito" class="form-control text-center">
						          <option value="1"> Activo </option>
						          <option value="0"> Inactivo </option>
						         </select>
						      </div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Crear</button>
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
		<script src="../assets/scripts/cadenas.js"></script>
		<script>
		function formEditGasolinera(ident){
			$("#editaGasolineraBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
			//alert('ID: '+ident);
			$.post("../funciones/formEditaGasolinera.php",
				{ ident:ident},
					function(respuesta){
						$("#editaGasolineraContent").html(respuesta);
					});
		}
		function listaCatMunicipio(ident){
			$.post("../funciones/listaCatMunicipio.php",
				{ ident:ident},
					function(respuesta){
					$("#municipio").html(respuesta);
				});
		}

		function newlistaCatMunicipio(newEstado){
			$.post("../funciones/listaCatMunicipio.php",
				{ ident:newEstado},
					function(resp){
					$("#newMunicipio").html(resp);
				});
		}
		$( document ).ready(function() {
			<?php
			if (isset( $_SESSION['ATZmsjEncargadoGasolineras'])) {
				echo "notificaBad('".$_SESSION['ATZmsjEncargadoGasolineras']."');";
				unset($_SESSION['ATZmsjEncargadoGasolineras']);
			}
			if (isset( $_SESSION['ATZmsjSuccesEncargadoGasolineras'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesEncargadoGasolineras']."');";
				unset($_SESSION['ATZmsjSuccesEncargadoGasolineras']);
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
