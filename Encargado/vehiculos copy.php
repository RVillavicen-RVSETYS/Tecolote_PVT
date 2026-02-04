<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('vehiculos.php');
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileinput.css" />

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
								<header><i class=""> Listado de Vehículos</header>
								<div class="tools">
									<div class="btn-group" data-toggle="tooltip" data-placement="top" data-original-title="Crear nuevo Vehiculo">
										<a class="btn btn-floating-action btn-primary" data-toggle="modal" data-target="#formNewUser"><i class="fa fa-plus"></i></a>
									</div>
								</div>
							</div>

							<div class="card-body">
								<!-- BEGIN DATATABLE 1 -->
								<div class="row">
									<div class="col-lg-12">
										<div class="card-body">
										<?php
											require('../include/connect.php');

											$sql = "SELECT MAX(noEconomico) AS ultim FROM vehiculos WHERE estatus = '1' LIMIT 1";
											$resp = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema al .</p>'.mysqli_error($link));
											$noVeh = mysqli_fetch_array($resp);
											$noTemp = $noVeh['ultim'];


											$sql="SELECT cmk.nombre AS nomMarca, ctv.nombre AS nomTipo, DATE_FORMAT(vhc.fechaReg, '%d/%m/%Y %H:%i:%s') AS dateReg, vhc.*,
											vhc.idPoliza AS vPoliza,pol.contrato AS noContrato
														FROM vehiculos vhc
														LEFT JOIN catmarcas cmk ON vhc.idCatMarca = cmk.id
														LEFT JOIN cattipovehiculos ctv ON vhc.idCatTipoVehiculo = ctv.id
														LEFT JOIN polizas pol ON pol.id = vhc.idPoliza
														ORDER BY vhc.noEconomico ASC";
											#echo $sql.'<br>';
											$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
										?>
										<div class="table-responsive">
											<table id="datatable1" class="table table-striped table-hover">
												<thead>
													<tr>
														<th>Foto</th>
														<th>No Economico</th>
														<th>Marca</th>
														<th>Modelo</th>
														<th>Tipo</th>
														<th>Placas</th>
														<th>Serie</th>
														<th>TAG</th>
														<th>Poliza</th>
														<th>Fecha Registro</th>
														<th>Estatus</th>
														<th><center>Editar</center></th>
													</tr>
												</thead>
												<tbody>
													<?php
													while ($dat = mysqli_fetch_array($res)) {
														$estatus = ($dat['estatus'] == 1) ? '<center class="text-success"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Activo"><i class="md md-done"></i></center>' : '<center class="text-danger"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Desactivado"><i class="md md-close"></i></center>' ;
														$estatusText = ($dat['estatus'] == 1) ? '' : 'class="text-danger"' ;
														$foto = ($dat['foto'] == '') ? 'assets/img/noimg.png' : $dat['foto'] ;
														$fecha = $dat['dateReg'];
														$tag = ($dat['tag'] != '') ? $dat['tag'] : 'S/R' ;
														echo '
														<tr '.$estatusText.'>
															<td><button type="button" class="btn ink-reaction btn-icon-toggle btn-primary" data-toggle="modal" data-target="#simpleModal" onclick="visualizaImg(\'../'.$foto.'\', \''.$dat['noEconomico'].'\', \''.$dat['placas'].'\');"><img class="img-circle width-1" src="../'.$foto.'" alt="IMG"></button></td>
															<td class="text-center">'.$dat['noEconomico'].'</td>
															<td>'.$dat['nomMarca'].'</td>
															<td>'.$dat['modelo'].'</td>
															<td>'.$dat['nomTipo'].'</td>
															<td>'.$dat['placas'].'</td>
															<td>'.$dat['serie'].'</td>
															<td>'.$tag.'</td>
															<td>'.$dat['noContrato'].'</td>
															<td>'.$fecha.'</td>
															<td>'.$estatus.'</td>
															<td class="text-center" width="80">
																<center>
																	<button type="button" class="btn btn-icon-toggle" onclick="formEditoperador('.$dat['id'].')" data-toggle="modal" data-target="#formEditoperador"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
																	<button type="button" class="btn btn-icon-toggle btn-primary" onclick="eliminaFoto('.$dat['id'].')"><i class="fa fa-times-circle" data-toggle="tooltip" data-placement="top" data-original-title="Elimina Fotografía"></i></button>
																</center>
															</td>
														</tr>';
													}
													?>
												</tbody>
											</table>
										</div><!--end .table-responsive -->
									</div><!--end .col -->
								</div><!--end .row -->
								<!-- END DATATABLE 1 -->
							</div><!--end .card-body -->
						</div><!--end .card -->
						<!-- END ACTION -->
				</section><!--end .section-body -->
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formNewUser" tabindex="-1" role="dialog" aria-labelledby="formNewUserLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formNewUserLabel"><b>Crear Nuevo Vehiculo</b></h4>
						</div>
						<form class="form-horizontal" role="form" method="post" action="../funciones/registraNuevoVehiculo.php" enctype="multipart/form-data">
							<div class="modal-body">
								<div class="form-group">
									<div class="col-sm-3">
										<label for="noeco" class="control-label">Numero Economico</label>
									</div>
									<div class="col-sm-9">
										<input type="number" name="noeco" id="noeco" onkeyup="soloNumeros(this.value,'noeco')" class="form-control" placeholder="Numero Economico. (Ultimo: <?=$noTemp;?>)" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="marca" class="control-label">Selecciona Marca</label>
									</div>
									<div class="col-sm-9">
										<?php
										$sql = "SELECT * FROM catmarcas WHERE idCatTabla = '4' ORDER BY nombre ASC";
										$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
										?>
										<select name="marca" id="marca" onchange="listaCatSubmarca(this.value);" class="form-control" required>
											<option>&nbsp;</option>
											<?php
											while ($dat = mysqli_fetch_array($res)) {
												echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="submarca" class="control-label">Selecciona SubMarca</label>
									</div>
									<div class="col-sm-9">
										<select name="submarca" id="submarca" class="form-control" required>
											<option value=""></option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="modelo" class="control-label">Selecciona Modelo</label>
									</div>
									<div class="col-sm-9">
										<select name="modelo" id="modelo" class="form-control" required>
											<?php
											$j = date('Y');
											$i = 1998;
											while ($i < $j) {
												$i++;
												echo '<option value="'.$i.'">'.$i.'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="nivel" class="control-label">Selecciona Tipo</label>
									</div>
									<div class="col-sm-9">
										<?php
										$sql = "SELECT * FROM cattipovehiculos ORDER BY nombre ASC";
										$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
										?>
										<select name="tipo" id="tipo" class="form-control" required>
											<?php
											while ($dat = mysqli_fetch_array($res)) {
												echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="poliza" class="control-label">Selecciona Póliza</label>
									</div>
									<div class="col-sm-9">
										<?php
										$msql3 = "SELECT pol.id,pol.contrato
	                            FROM polizas pol
	                            WHERE (ISNULL(pol.idVehiculo) AND ISNULL(idComplemento) ) OR (idVehiculo = '0' AND idComplemento = '0')
	                            OR (idVehiculo = '0' AND idComplemento IS NULL) OR (idVehiculo IS NULL AND idComplemento = '0')
	                            ORDER BY pol.contrato ASC";
	                  $resp3 = mysqli_query($link,$msql3) or die('<p class="text-danger">Notifica al Administrador</p>');
										?>
										<select name="poliza" id="poliza" class="form-control" required>
											<?php
											while ($dato3 = mysqli_fetch_array($resp3)) {
	                      echo '<option value="'.$dato3['id'].'">'.$dato3['contrato'].'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="placas" class="control-label">Placas</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="placas" id="placas" onkeyup="cambiaMay('placas');" class="form-control" placeholder="Placas" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="serie" class="control-label">Serie</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="serie" id="serie" onkeyup="cambiaMay('serie');" class="form-control" placeholder="Serie" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="noMotor" class="control-label">Numero de Motor</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="noMotor" id="noMotor" onkeyup="cambiaMay('noMotor');" class="form-control" placeholder="Numero de Motor" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="noMotor" class="control-label">TAG</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="tag" id="tag" onkeyup="cambiaMay('tag');" class="form-control" placeholder="TAG" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="nivel" class="control-label">Tipo de Combustible</label>
									</div>
									<div class="col-sm-9">
										<?php
										$sql = "SELECT * FROM catcombustibles WHERE estatus = 1 ORDER BY nombre ASC";
										$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
										?>
										<select name="combustible" id="combustible" class="form-control" required>
											<?php
											while ($dat = mysqli_fetch_array($res)) {
												echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="tanque" class="control-label">Capacidad del Tanque</label>
									</div>
									<div class="col-sm-9">
										<input type="number" name="tanque" id="tanque" class="form-control" placeholder="Capacidad en Litros" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="kmts" class="control-label">Kilometraje Actual</label>
									</div>
									<div class="col-sm-9">
										<input type="number" name="kmts" id="kmts"  class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="foto" class="control-label">Fotografia</label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="foto" id="foto"  class="form-control foto">
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="pag" value="encargado/vehiculosEnc.php">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Registrar</button>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="formEditoperador" tabindex="-1" role="dialog" aria-labelledby="formEditoperadorLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaoperadorContent">
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="verFoto" tabindex="-1" role="dialog" aria-labelledby="verFotoLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="verFotoContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="verFotoTitle"> Ver Foto</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- END FORM MODAL MARKUP -->

			<!-- BEGIN SIMPLE MODAL MARKUP -->
			<div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="simpleModalLabel">Foto</h4>
						</div>
						<div class="modal-body" id="cuerpoModal">
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
		<script src="../assets/js/libs/fileInput/fileinput.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="../assets/scripts/cadenas.js"></script>
		<script>
	  $(document).ready(function(){
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

			$('#demo-date-range').datepicker({
				todayHighlight: true,
				format: "dd/mm/yyyy"
			});

			<?php
			if (isset( $_SESSION['ATZmsjAdminAltaVehiculos'])) {
				echo "notificaBad('".$_SESSION['ATZmsjAdminAltaVehiculos']."');";
				unset($_SESSION['ATZmsjAdminAltaVehiculos']);
			}
			if (isset( $_SESSION['ATZmsjSuccesAdminAltaVehiculos'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesAdminAltaVehiculos']."');";
				unset($_SESSION['ATZmsjSuccesAdminAltaVehiculos']);
			}
			?>
	  });

		function listaCatSubmarca(ident){
			$.post("../funciones/listaCatSubMarca.php",
				{ ident:ident},
					function(respuesta){
						$("#submarca").html(respuesta);
					});
		}

		function cambiaMay(idInput){
			txt = $('#'+idInput).val();
			txt = txt.toUpperCase();
			$('#'+idInput).val(txt);
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

		function formEditoperador(ident){
			$("#editaoperadorBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
			//alert('ID: '+ident);
			$.post("../funciones/formEditaVehiculo.php",
				{ ident:ident, pag:'<?=$info->pagina;?>' },
					function(respuesta){
						$("#editaoperadorContent").html(respuesta);
					});
		}

		function visualizaImg(foto,eco,placas){
			$("#cuerpoModal").html('<img class="height-8" width="100%" height="100%" src="'+foto+'">');
			$("#simpleModalLabel").html("ECO - "+eco+" Placas: "+placas);
		}

		function eliminaFoto(ident){
			var tabla = ("vehiculos");
			var mserror = ("ATZmsjAdminAltaVehiculos");
			var mssuccess = ("ATZmsjSuccesAdminAltaVehiculos");
			var pag = ("../Encargado/vehiculos.php");
			$.post("../funciones/eliminarFoto.php",
			//alert('entro y manda estos datos: id('+ident+'), tabla('+tabla+'), pag('+pag+'), exit('+mssuccess+'), error('+mserror+')');
			{ident:ident, tabla:tabla, pag:pag, mserror:mserror, mssuccess:mssuccess},
			function(resp){
				//alert('Respuesta: '+resp);
				var res=resp.split('|');
			//	alert('res: '+res);
			if(res[0] == '0'){
					toastr.warning('¡Lo sentimos, no se pudo realizar la Eliminación!',{
					"closeButton": true,
					"timeOut": 7000
				});
			} else {
					toastr.success('¡Se ha Eliminado Correctamente!'+res[1],{
					"closeButton": true,
					"timeOut": 7000
				});
			}

			});
			}

		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
