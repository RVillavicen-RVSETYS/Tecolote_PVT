	<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('conMttos.php');
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
										$taller = (isset($_POST['taller']) AND $_POST['taller'] != '') ? $_POST['taller'] : '' ;
										$tipo = (isset($_POST['tipo']) AND $_POST['tipo'] != '') ? $_POST['tipo'] : '' ;

										#print_r($_POST);
										?>

										<div class="rows">
										<form class="form" method="post" action="conMttos.php">
											<div class="col-lg-4">
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

											 <div class="col-lg-offset-1 col-md-2">
						                    <?php
						                    require '../include/connect.php';
						                    $sql = "SELECT * FROM talleres WHERE estatus = '1'";
						                    $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
						                    ?>
						                    <div class="form-group">
						                    <select name="taller" class="form-control select2-list" data-placeholder="">
						                       <option value="0">Todos</option>
						                      <optgroup label="Talleres">
						                        <?php
						                        while ($dat = mysqli_fetch_array($res)) {
						                          $active = ($taller == $dat['id']) ? 'selected' : '' ;
						                         echo '<option value="'.$dat['id'].'" '.$active.'> '.$dat['nombre'].' </option>';
						                        }
						                        ?>
						                      </optgroup>
						                     </select>
						                     <label>Seleccione Taller</label>
						                     </div>
						                    </div>


											 <div class="col-lg-offset-1 col-md-2">
						                    <?php
						                    require '../include/connect.php';
						                    $sql = "SELECT asgv.id AS ident, ve.noEconomico AS noEco, ve.placas AS noPlacas
													FROM vehiculos ve
													INNER JOIN asignavehiculos asgv ON asgv.idVehiculo = ve.id
													WHERE '1' = '1' AND asgv.estatus = '1' ";
						                    $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')

						                    ?>
						                    <div class="form-group">
						                    <select name="tipo" class="form-control select2-list" data-placeholder="">
						                       <option value="0">Todos</option>
						                      <optgroup label="	Servicio">
						                        <?php
						                        while ($dat = mysqli_fetch_array($res)) {
						                          $active = ($mttos == $dat['ident']) ? 'selected' : '' ;
						                         echo '<option value="'.$dat['ident'].'" '.$active.'> '.$dat['noEco'].' ('.$dat['noPlacas'].')</option>';
						                        }
						                        ?>
						                      </optgroup>
						                     </select>
						                     <label>Seleccione Vehículo</label>
						                     </div>
						                    </div>

											<div class="col-lg-offset-1 col-lg-1">
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
							<div class="col-md-12">
								<div class="card card-bordered style-primary">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>

										</div>
									<header><i class="fa fa-fw fa-tag"></i> Lista de Mantenimientos</header>
									</div><!--end .card-head -->
											<div class="card-body style-default-bright table-responsive">
												<?php
												#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
												#print_r($_SESSION);

												require('../include/connect.php');
												$filtrofecha='';
												$filtroTaller='';
												$filtroTipo='';


											if ($fecha1 != '' AND $fecha2 !='') {
													$filtrofecha = "AND mts.fechaReg BETWEEN '$fecha1' AND '$fecha2'";
													}


												if ($taller != '' AND $taller >'0') {

														$filtroTaller = " AND ( mts.idTaller  ='$taller')";
														}

												if ($tipo != '' AND $tipo >'0') {

														$filtroTipo = " AND ( asv.id ='$tipo')";
														}



												$sql="SELECT mts.*, ctm.nombre AS tipoMtto, ctsm.nombre AS tipoServicio, prd.nombre AS pro, fct.urlXML AS xml, fct.urlPDF AS pdf, fct.doctoComprobante AS doctoComprobante,
															tlls.nombre AS nomTaller, asv.id AS asgV, vh.modelo AS modelo, csm.nombre, CONCAT('ECO - ',vh.noEconomico, ' (', vh.placas, ')') AS veh, fts.url AS fotoMtto, mts.monto AS mtMonto
															FROM mttos mts
															LEFT JOIN cattipomttos ctm ON mts.idCatTipoMtto = ctm.id
															LEFT JOIN catserviciosmttos ctsm ON mts.idServicioMtto = ctsm.id
															LEFT JOIN stocks sks ON mts.idStockReparado = sks.id
															LEFT JOIN productos prd ON sks.idProducto = prd.id
															LEFT JOIN facturas fct ON mts.idFactura = fct.id
															LEFT JOIN talleres tlls ON mts.idTaller = tlls.id
															LEFT JOIN asignavehiculos asv ON mts.idAsignaVehiculo = asv.id
															LEFT JOIN vehiculos vh ON asv.idVehiculo = vh.id
															LEFT JOIN catmarcas ctms ON vh.idCatMarca = ctms.id
															LEFT JOIN catsubmarcas csm ON vh.idCatSubmarca = csm.id
															LEFT JOIN fotos fts ON fts.tabla = mts.id AND fts.idTabla = 6
															WHERE 1 = 1 $filtrofecha $filtroTaller $filtroTipo
															GROUP BY mts.id
															ORDER BY id ASC";
												//echo '<br>sql:  '.$sql.'<br>';

													$res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
												?>

												<table class="table table-striped table-hover" id="datatable1">
											<thead>
														<tr>
															<th class="text-center">#</th>
															<th class="text-center">Tipo Mtto</th>
															<th class="text-center">Servicio Mtto</th>
															<th class="text-center">Descripción</th>
															<th class="text-center">Monto</th>
															<th class="text-center">Foto de Entrada a Taller</th>
															<th class="text-center">Comprobante</th>
															<th class="text-center">Factura</th>
															<th class="text-center">XML</th>
															<th class="text-center">Taller</th>
															<th class="text-center">Vehículo</th>
															<th class="text-center col-lg-1">Funciones</th>
														</tr>
													</thead>
													<tbody>
														<?php
														while ($con = mysqli_fetch_array($res)) {

															$doctoOnClick =  ($con['doctoComprobante'] == '') ? 'disabled' : 'onclick="verARCHIVO('.$con['id'].',3)" data-toggle="modal" data-target="#verPDF"';
															$doctoMsj =  ($con['doctoComprobante'] == '') ? 'No se ha subido ningun Documento.' : 'Ver Documento.';
															$pdfOnClick =  ($con['pdf'] == '') ? 'disabled' : 'onclick="verARCHIVO('.$con['id'].',1)" data-toggle="modal" data-target="#verPDF"';
															$pdfMsj =  ($con['pdf'] == '') ? 'No se ha subido ningun Documento.' : 'Ver Documento.';
															$xmlOnClick =  ($con['xml'] == '') ? 'disabled' : 'onclick="verARCHIVO('.$con['id'].',2)" data-toggle="modal" data-target="#verPDF"';
															$xmlMsj =  ($con['xml'] == '') ? 'No se ha subido ningun Documento.' : 'Ver Documento.';
															$fotoOnClick =  ($con['fotoMtto'] == '') ? 'disabled' : 'onclick="verARCHIVO('.$con['id'].',4)" data-toggle="modal" data-target="#verPDF"';
															$fotoMsj =  ($con['fotoMtto'] == '') ? 'No se ha subido ningun Documento.' : 'Ver Documento.';

															if ($con['doctoComprobante'] == '') {
																$btnDoctoComprobante = '<button type="button" '.$doctoOnClick.' class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
															}else {
																$btnDoctoComprobante = '<button type="button" '.$doctoOnClick.' class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
															}
															if ($con['pdf'] == '') {
																$btnDoctoPDF = '<button type="button" '.$pdfOnClick.' class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
															}else {
																$btnDoctoPDF = '<button type="button" '.$pdfOnClick.' class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
															}
															if ($con['xml'] == '') {
																$btnDoctoXML = '<button type="button" '.$xmlOnClick.' class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
															}else {
																$btnDoctoXML = '<button type="button" '.$xmlOnClick.' class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
															}
															if ($con['fotoMtto'] == '') {
																$btnFoto = '<button type="button" '.$fotoOnClick.' class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
															}else {
																$btnFoto = '<button type="button" '.$fotoOnClick.' class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
															}
															if ($con['mtMonto'] > 0) {
																$monto = $con['mtMonto'];
															} else {
																$monto = 'S/R';
															}


															echo '
															<tr class="'.$color.' text-'.$color.'">
																<td class="text-center" id="id'.$con['id'].'">'.$con['id'].'</td>
																<td class="text-center" id="tmtto'.$con['id'].'">'.$con['tipoMtto'].'</td>
																<td class="text-center" id="Servicio'.$con['id'].'">'.$con['tipoServicio'].'</td>
																<td class="text-center" id="Descripcion" '.$con['id'].'"> '.$con['descripcion'].'</td>
																<td class="text-center" id="monto'.$con['id'].'">'.$monto.'</td>
																<td class="col-lg-1 text-center" id="doctoCarga'.$con['id'].'"> '.$btnFoto.'</td>
																<td class="col-lg-1 text-center" '.$con['id'].'"> '.$btnDoctoComprobante.'</td>
																<td class="col-lg-1 text-center" '.$con['id'].'"> '.$btnDoctoPDF.'</td>
																<td class="col-lg-1 text-center" '.$con['id'].'"> '.$btnDoctoXML.'</td>
																<td class="text-center" id="taller" '.$con['id'].'"> '.$con['nomTaller'].'</td>
																<td class="text-center" id="vehiculo'.$con['id'].'">'.$con['veh'].'</td>
																<td class="col-lg-1 text-center">
																	<button type="button" class="btn btn-icon-toggle" onclick="editaConsulta('.$con['id'].')" data-toggle="modal" data-target="#formEditConsulta"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
																</td>
															</tr>';
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
			<div class="modal fade" id="verPDF" tabindex="-1" role="dialog" aria-labelledby="verPDFLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="verPDFContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="verPDFTitle"> Ver ARCHIVO</h4>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="formEditConsulta" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="consultaMttosContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formModalLabel">Editar Mantenimiento</h4>
						</div>
						<div class="modal-body">
						</div>
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
		<script src="../assets/scripts/cadenas.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="../assets/js/libs/toastr/toastr.js"></script>
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
				if (isset( $_SESSION['ATZmsjEncargadoConMttos'])) {
					echo "notificaBad('".$_SESSION['ATZmsjEncargadoConMttos']."');";
					unset($_SESSION['ATZmsjEncargadoConMttos']);
				}
				if (isset( $_SESSION['ATZmsjSuccesEncargadoConMttos'])) {
					echo "notificaSuc('".$_SESSION['ATZmsjSuccesEncargadoConMttos']."');";
					unset($_SESSION['ATZmsjSuccesEncargadoConMttos']);
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


/////////////////Aqui se le agrega el nombre al documento
			function verARCHIVO(ident,campo){
				$.post("../funciones/verPDF-ConMttos.php",
					{ ident:ident,campo:campo },
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
			function editaConsulta(ident){
				$("#editaventaBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
				//alert('ID: '+ident);
				$.post("../funciones/formEditaConMttos.php",
					{ ident:ident},
						function(respuesta){
							$("#consultaMttosContent").html(respuesta);
						});
			}
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

			$(".foto").fileinput({
				showUpload: false,
				showCaption: false,
				language: 'es',
				allowedFileExtensions : ['jpg', 'jpeg'],
				maxFileSize: 5120,
				maxFilesNum: 1,
				browseClass: "btn btn-primary btn-lg",
				fileType: "any"
			});
			$(".xml").fileinput({
		  		showUpload: false,
		  		showCaption: false,
		      language: 'es',
		      allowedFileExtensions : ['XML'],
		      maxFileSize: 5120,
		      maxFilesNum: 1,
		  		browseClass: "btn btn-primary btn-lg",
		  		fileType: "any",
		      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
		  	});
		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
