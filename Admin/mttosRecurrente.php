<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('mttosRecurrente.php');
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/material-design-iconic-font.min.css?1421434286" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/wizard/wizard.css?1425466601" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/dropzone/dropzone-theme.css?1424887864" />
	  <link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileinput.css" />


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
							<div class="col-lg-8">
								<article class="margin-bottom-xxl">
									<p class="lead"><?=$info->detailPag;?></p>
								</article>
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END INTRO -->

					<div class="row">
							<div class="col-lg-12">
								<div class="card ">
									<div class="card-body ">
										<div id="rootwizard1" class="form-wizard form-wizard-horizontal">
												<form class="form floating-label" action="../funciones/registraNuevoMttoRecurrente.php" method="POST">
																	<div class="form-wizard-nav">
																		<div class="progress"><div class="progress-bar progress-bar-primary"></div></div>
																		<ul class="nav nav-justified">
																			<li class="active"><a href="#tab1" data-toggle="tab"><span class="step">1</span> <span class="title">Datos Vehiculares</span></a></li>
																			<li><a href="#tab2" data-toggle="tab"><span class="step">2</span> <span class="title">Asignacion de Servicio</span></a></li>
																			<li><a href="#tab3" data-toggle="tab"><span class="step">3</span> <span class="title">Tiempo del Desarrollo</span></a></li>

																		</ul>
																	</div><!--end .form-wizard-nav -->
																	<div class="tab-content clearfix">
																		<div class="tab-pane active" id="tab1">
																			<div class="col-lg-1"></div>
																				<?php
																				require('../include/connect.php');
																				//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
																				//print_r($_SESSION);			//muestra las sesiones
																				$sql="SELECT asv.*, op.nombre AS nomOpe, op.apellidos AS apeOpe, ve.noEconomico AS noEco,asv.idVehiculo AS elVehiculo, ve.placas AS placas
																				FROM asignavehiculos asv
																				INNER JOIN operadores op ON op.id = asv.idOperador
																				INNER JOIN vehiculos ve ON ve.id = asv.idVehiculo
																				WHERE asv.estatus = '1' AND op.estatus = '1'
																				ORDER BY asv.idVehiculo ASC";
																			 $res=mysqli_query($link,$sql) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');
																				//echo ($sql);
																				#$datovehiculo = mysqli_fetch($dat['id']);		onchange="listaCheck(this.value);"
																				 ?>
																				 <div class="form-group col-md-3 text-right">
																					Selecciona el Vehículo.
																				 </div>
 																					<div class="form-group col-md-6">
 																						<select id="tipoVehiculo" name="tipoVehiculo" class="form-control text-center" required>
 																							<?php
 																							echo '<option value="">&nbsp</option>';
 																							while ($dat = mysqli_fetch_array($res)) {
 																								echo '<option value="'.$dat['elVehiculo'].'">Placas - '.$dat['placas'].' (ECO - '.$dat['noEco'].' '.$dat['nomOpe'].' '.$dat['apeOpe'].')</option>';
 																							}
 																							 ?>
 																						</select>
 																						<label for="tipoVehiculo text-center">Vehículo</label>
																						<div class="col-md-3"></div>
																						<div class="col-lg-1"></div>
																					</div>
																	</div><!--end #tab1 -->
																	<div class="tab-pane" id="tab2">
																			<br/><br/>

																			<div class="form-group col-md-2 text-right">
																			 Selecciona el tipo de Mantenimiento
																			</div>
																			<?php
																			require('../include/connect.php');
																			#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
																			#echo '<br>';
																			#print_r($_SESSION);			//muestra las sesiones
																			$sql="SELECT ctm.*
																						FROM cattipomttos ctm
																						ORDER BY ctm.id ASC";
																		 $res=mysqli_query($link,$sql) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');
																			//echo ($sql);
																			#$datovehiculo = mysqli_fetch($dat['id']);		onchange="listaCheck(this.value);"
																			 ?>
																			<div class="form-group col-md-4">
																				<select id="tipoMtto" name="tipoMtto" onchange="listarServicios(this.value);"  class="form-control text-center" required>
																					<?php
																					echo '<option value="">&nbsp</option>';
																					while ($dat = mysqli_fetch_array($res)) {
																						echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
																					}
																					 ?>
																				</select>
																			</div>
																			<div class="form-group col-md-2 text-right">
																			 Selecciona el tipo de Servicio que se le realizará al Vehículo.
																			</div>
																			<div class="form-group col-md-3">
																				<select id="servicio" name="tipoServicio" class="form-control text-center" required>
																					<option value="">&nbsp;</option>
																				</select>
																				<label for="servicio" class=" text-center">Tipo de Servicio</label>
																			</div>
																			<div class="col-md-1"></div>

																  </div><!--end #tab2 -->

																	<div class="tab-pane" id="tab3">
																			<br/><br/>

																			<div class="form-group col-md-12">
																				<div class="col-md-4"><p></p></div>
																				<div class="form-group col-md-1 text-right">
																				 Categoría:
																				</div>
																				<div class="col-sm-6 text-left">
																					<label class="radio radio-styled">
																						<input type="radio" name="categoria" value="1" required><span>Recurrente</span><br>
																					</label>
																					<label class="radio radio-styled">
																						<input type="radio" name="categoria" value="2" required><span>No Recurrente</span>
																					</label>
																				</div><!--end .col -->

																			</div><!--end .form-group -->
																			<div class="col-md-12"><p></p></div>

																			<div class="form-group col-md-2 text-right">
																			 Kilometraje del Vehículo.
																			</div>
																			<div class="form-group col-md-3">
																				<input type="text" name="km" id="km" class="form-control text-center" required>
																				<label for="km" class="control-label text-center">Kilometraje</label>
																			</div>
																			<div class="form-group col-md-2 text-right">
																			 Kilometraje recorrido del Vehículo para realizar el Mantenimiento.
																			</div>
																			<div class="form-group col-md-4">
																				<input type="text" name="rangoKm" id="rangoKm" class="form-control text-center" required>
																				<label for="rangoKm" class="control-label text-center">Kilometraje recorrido</label>
																			</div>
																			<div class="col-md-1"></div>
																			<div class="col-md-12">&nbsp;</div>
																			<div class="col-md-12">&nbsp;</div>
																			<div class="col-md-12">&nbsp;</div>
																			<div class="col-md-1"></div>
																			<div class="form-group col-md-2 text-right">
																			 Tiempo en que se realizará el Mantenimiento.
																			</div>
																			<div class="form-group col-md-3">
																				<input type="text" name="rangoTiempo" id="rangoTiempo" class="form-control text-center" required>
																				<label for="rangoTiempo" class="control-label text-center">Tiempo</label>
																			</div>

																			<div class="col-md-1"></div>
																			<div class="form-group col-md-2 text-right">
																			 Selecciona si será en Meses o Semanas.
																			</div>
																			<div class=" col-md-3">
																				<label class="form-group radio-inline radio-styled">
																					<input type="radio" name="tipoTiempo" value="1"><span>Semanas</span>
																				</label>
																				<label class="radio-inline radio-styled">
																					<input type="radio" name="tipoTiempo" value="2"><span>Meses</span>
																				</label>
																				<label class="radio-inline radio-styled">
																					<input type="radio" name="tipoTiempo" value="3"><span>Anual</span>
																				</label>
																			</div><!--end .col -->
																			<div class="col-md-12">&nbsp;</div>
																			<div class="col-md-12"></div>
																			<div class="row">
																				<div class="col-md-8"></div>
																				<div class="col-lg-4 text-center">
																					<button type="submit" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Cargando...">Crear Mantenimiento</button>
																				</div>
																			</div>

																</div><!--end #tab3 -->

																	</div><!--end .tab-content -->
																	<ul class="pager wizard">
																		<li class="previous first"><a class="btn-raised" href="javascript:void(0);">Primero</a></li>
																		<li class="previous"><a class="btn-raised" href="javascript:void(0);">Previo</a></li>
																		<li class="next"><a class="btn-raised" href="javascript:void(0);">Siguiente</a></li>
																	</ul>
											</form>
										</div><!--end #rootwizard -->
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->
						<!-- END FORM WIZARD -->

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
		<script src="../assets/js/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
		<script src="../assets/js/libs/d3/d3.min.js"></script>
		<script src="../assets/js/libs/d3/d3.v3.js"></script>
		<script src="../assets/js/libs/rickshaw/rickshaw.min.js"></script>
		<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../assets/js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="../assets/js/libs/jquery-validation/dist/additional-methods.min.js"></script>
		<script src="../assets/js/libs/wizard/jquery.bootstrap.wizard.min.js"></script>
		<script src="../assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
		<script src="../assets/js/core/source/App.js"></script>
		<script src="../assets/js/core/source/AppNavigation.js"></script>
		<script src="../assets/js/core/source/AppOffcanvas.js"></script>
		<script src="../assets/js/core/source/AppCard.js"></script>
		<script src="../assets/js/core/source/AppForm.js"></script>
		<script src="../assets/js/core/source/AppNavSearch.js"></script>
		<script src="../assets/js/core/source/AppVendor.js"></script>
		<script src="../assets/js/core/demo/Demo.js"></script>
		<script src="../assets/js/core/demo/DemoTableDynamic.js"></script>
		<script src="../assets/js/core/demo/DemoFormWizard.js"></script>
		<script src="../assets/js/core/demo/DemoFormComponents.js"></script>
	  <script src="../assets/js/libs/fileInput/fileinput.js"></script>
		<script src="../assets/js/libs/fileInput/fileinput_locale_es.js"></script>
		<script src="../assets/js/libs/toastr/toastr.js"></script>
		<script>
		$( document ).ready(function() {
			<?php
			if (isset( $_SESSION['ATZmsjAdminMttosRecurrente'])) {
				echo "notificaBad('".$_SESSION['ATZmsjAdminMttosRecurrente']."');";
				unset($_SESSION['ATZmsjAdminMttosRecurrente']);
			}
			if (isset( $_SESSION['ATZmsjSuccesAdminMttosRecurrente'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesAdminMttosRecurrente']."');";
				unset($_SESSION['ATZmsjSuccesAdminMttosRecurrente']);
			}
			?>
		});

		$(".docto").fileinput({
	  		showUpload: false,
	  		showCaption: false,
	      language: 'es',
	      allowedFileExtensions : ['PDF','XML'],
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

			function listarServicios(listServicio){
				$.post("../funciones/listarServicios.php",
					{ ident:listServicio},
						function(resp){
						$("#servicio").html(resp);
					});
			}

		</script>
		<!-- END JAVASCRIPT -->


	</body>
</html>
