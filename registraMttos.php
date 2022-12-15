<?php
require_once 'seg.php';
require 'include/connect.php';
$info = new Seguridad();
$info->Acceso('registraMttos.php');
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
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/summernote/summernote.css?1425218701" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/material-design-iconic-font.min.css?1421434286" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/wizard/wizard.css?1425466601" />
		<link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/dropzone/dropzone-theme.css?1424887864" />
	    <link type="text/css" rel="stylesheet" href="assets/css/theme-2/libs/fileInput/fileInput.css" />


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
							<div class="col-lg-12">
								<div class="card ">
									<div class="card-body ">
										<div id="rootwizard1" class="form-wizard form-wizard-horizontal">
												<form class="form floating-label" action="funciones/registraMtto.php" method="POST" enctype="multipart/form-data">
														<div class="form-wizard-nav">
															<div class="progress"><div class="progress-bar progress-bar-primary"></div></div>
															<ul class="nav nav-justified">
																<li class="active"><a href="#tab1" data-toggle="tab"><span class="step">1</span> <span class="title">Datos Vehiculares</span></a></li>
																<li><a href="#tab2" data-toggle="tab"><span class="step">2</span> <span class="title">Asignacion de Servicio</span></a></li>
																<li><a href="#tab3" data-toggle="tab"><span class="step">3</span> <span class="title">Datos de Pago</span></a></li>

															</ul>
														</div><!--end .form-wizard-nav -->
														<div class="tab-content clearfix">
															<div class="tab-pane active" id="tab1">
																<div class="col-lg-2"></div>
																	<div class="col-lg-4">
																		<?php
																		require('include/connect.php');
																				$sql = "SELECT ve.*, op.nombre AS nomOpe, op.apellidos AS apeOpe, asgv.id AS idAsgVehiculo,
																									pro.nombre AS nomProd, pro.id AS idProd
																									FROM vehiculos ve
																									INNER JOIN asignavehiculos asgv ON asgv.idVehiculo = ve.id AND asgv.estatus='1'
																									LEFT JOIN operadores op ON op.id = asgv.idOperador
																									LEFT JOIN stocks stc ON stc.id = asgv.idVehiculo
																									LEFT JOIN productos pro ON pro.id = stc.idProducto
																									GROUP BY ve.id
																									ORDER BY ve.id ASC";
																				$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
																				?>
																			<div class="form-group">
																				<select id="economico" name="idAsignaVehiculo"  class="form-control" required>
																					<?php

																					echo '<option value="">&nbsp;</option>';
																					while ($dat = mysqli_fetch_array($res)) {
																						echo '<option value="'.$dat['idAsgVehiculo'].'">Placas '.$dat['placas'].' (ECO - '.$dat['noEconomico'].' '.$dat['nomOpe'].' '.$dat['apeOpe'].')</option>';
																					}
																					 ?>
																				</select>
																			<label for="economino">Selecciona el Vehículo</label>
																			</div>
																	</div>
																	<div class="col-sm-1"></div>
																	<div class="col-sm-3">
																		<div class="form-group">
																			<input type="number" name="km" onkeyup="soloNumeros(this.value, 'km')"  id="km" class="form-control" required>
																			<label for="km" class="control-label">Kilometraje del Vehículo</label>
																		</div>
																	</div>
																	<div class="row"></div>
															</div><!--end #tab1 -->
<!--	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////			-->
															<div class="tab-pane" id="tab2">
																	<div class="col-lg-3">
																		<?php
																		require('include/connect.php');
																		$sql1 = "SELECT *
																						FROM cattipomttos
																						ORDER BY id ASC";
																		$res1 = mysqli_query($link, $sql1) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
																		?>
																		<div class="form-group">
																			<select id="tipoMtto" name="tipoMtto" onchange="listarServicios(this.value);"  class="form-control" required>
																				<?php
																				echo '<option value="">&nbsp;</option>';
																				while ($dat1 = mysqli_fetch_array($res1)) {
																					echo '<option value="'.$dat1['id'].'">'.$dat1['nombre'].'</option>';
																				}
																				 ?>
																			 </select>
																			<label for="tipoMtto">Tipos de Mttos</label>
																		</div>
																	</div>
																	<div class="col-lg-1"></div>
																	<div class="col-lg-3">
																		<div class="form-group">
																				<select id="servicio" name="servicio" class="form-control" required>
																					<option value="">&nbsp;</option>
																				</select>
																				<label for="servicio">Tipo de Servicio</label>
																		</div>
																	</div>
																	<div class="col-lg-1"></div>
																	<div class="col-lg-3">
																		<?php
																		require('include/connect.php');
																		$sql3 = "SELECT *
																						FROM talleres
																						ORDER BY id ASC";
																		$res3 = mysqli_query($link, $sql3) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
																		?>
																		<div class="form-group">
																			<select id="taller" name="taller" class="form-control" required>
																				<?php

																				echo '<option value="">&nbsp;</option>';
																				while ($dat3 = mysqli_fetch_array($res3)) {
																					echo '<option value="'.$dat3['id'].'">'.$dat3['nombre'].'</option>';
																				}
																				 ?>
																				</select>
																			<label for="taller">Taller</label>
																		</div>
																	</div>

																	<div class="col-sm-3"></div>
																	<div class="col-sm-3">
																		<div class="form-group">
																			<input type="text" name="nom" id="nom" class="form-control" required>
																			<label for="nombre" class="control-label">Nombre de quien Recibe</label>
																		</div>
																	</div>
																	<div class="col-lg-1"></div>

																		<div class="col-lg-4">
																				<div class="form-group control-width-normal">
																	       	<div class="input-group date" id="demo-date-format">
																		     		<div class="input-group-content">
																								<input type="text" name="fechaEntrada" class="form-control fechado" required>
																								<label>Fecha de Entrada al Taller</label>
																						</div>
																						<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																					</div>
																				</div><!--end .form-group -->
																		</div>
																		<div></div>
																		<div class="row">

																			<!--div class="form-group">
																					<select id="productoReparado" name="productoReparado" class="form-control">
																						<option value="">&nbsp;</option>
																					</select>
																				<label for="productoReparado">Selecciona el Producto Asignado</label>
																			</div-->
																		</div>
													  </div><!--end #tab2 -->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
															<div class="tab-pane" id="tab3">
																<br/>

																<!--div class="row">
																	<div class="col-lg-5"></div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<label class="control-label"><h3 class=" text-center">Documentos</h3></label>
																		</div>
																	</div>
																</div>

																<div class="row">
																	<div class="col-lg-12">&nbsp;</div>
		                           		<div class="col-lg-1"></div>
																 	<div class="col-sm-3">
			                            	<div class="form-group">
				                             	<input type="file" name="urlPDF" id="factura"  class="form-control docto">
			                             		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Factura</p>
				                            </div>
			                            </div>
																	<div class="col-lg-1"></div>
														 			<div class="col-sm-3">
			                            	<div class="form-group">
													           	<input type="file" name="urlXML" id="xml"  class="form-control xml">
													           	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; XML</p>
												            </div>
										              </div>

																	<div class="col-lg-1"></div>
																	<div class="form-group col-sm-3">
																		<input type="file" name="doctoComprobante" id="docComp"  class="form-control docto">
																		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Comprobante/Ticket</p>
																	</div>
																</div><!	 Termina row			--->

																<div class="col-lg-12">&nbsp;</div>
																<div class="row">
																	<div class="col-lg-5"></div>
																	<div class="col-lg-2">
																		<div class="form-group">
																			<label class="control-label"><h3 class=" text-center">Evidencias</h3></label>
																		</div>
																	</div>
																</div>

																<div class="col-lg-12">&nbsp;</div>
																<div class="col-lg-5"></div>
					                      <div class="col-sm-4">
					                      	<div class="form-group">
					                 	       	<input type="file" name="fotoEntrada" id="falla" accept="image/jpeg,image/x-png" class="form-control foto">
							                      <p>Foto de falla</p>
														   		</div>
								                </div>

								                <!--div class="col-sm-4">
					                         	<div class="form-group">
								                      <input type="file" name="fotoSalida" id="concluido"  class="form-control foto">
							                        <p>Foto de Entrega</p>
													       		</div>
								                </div -->

																<div class="col-lg-12">&nbsp;</div>
																	<div class="row">
																		<div class="col-lg-5"></div>
																		<div class="col-lg-2">
																			<div class="form-group">
																				<label class="control-label"><h3 class=" text-center">Sobre el Servicio</h3></label>
																			</div>
																		</div>
																	</div>

																<!--div class="col-lg-12">&nbsp;
																</div>
																<div class="col-sm-2"></div>
																<div class="col-lg-4">
																  <div class="form-group">
																 		<div class="input-group">
																	 			<span class="input-group-addon"><i class="fa fa-usd fa-lg"></i></span>
																 			<div class="input-group-content">
																	 			<input type="number" class="form-control" id="costo" name="costo" value="">
																	 			<label for="costo">Costos:</label>
															 				</div>
														 				</div>
													 				</div><!end .form-group >
												 				</div>
-->
															<div class="row">
																<div class="col-lg-1"></div>
																<div class="col-lg-4">
																	 <div class="form-group">
																			 <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
																			 <label for="descripcion">Descripción de Servicio</label>
																	 </div>
																</div>
																<div class="col-lg-1"></div>

																<div class="col-lg-3">
																		<div class="form-group control-width-normal">
																			<div class="input-group date" id="demo-date-format">
																				<div class="input-group-content">
																						<input type="text" name="fechaEntrega" class="form-control fechado" required>
																						<label>Fecha Aproximada de Entrega</label>
																				</div>
																				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																			</div>
																		</div><!--end .form-group -->
																</div>

																<div class="col-sm-3">
 																	<div class="form-group control-width-normal">
 														         <div class="input-group" id="monto">
 																			 <div class="input-group-content">
 																				 <input type="number" step="any" name="monto" class="form-control">
 																				 <label>Costo del Mantenimiento</label>

 																			 </div>
 																		 </div>
 																	 </div><!--end .form-group -->
 																</div><!--end .col-sm-3 (costo del mtto) -->
															 </div>


																<div class="col-lg-12">&nbsp;</div>
																<div class="row">
																 	 <div class="col-sm-2"></div>
																	 <div class="col-lg-5 text-right">
																		 <button type="submit" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Cargando...">Capturar Mantenimiento</button>
																	 </div>
															 	</div>
														</div><!--end #tab3 -- >

														</div><!--end .tab-content  -->

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
		<script src="assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="assets/js/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
		<script src="assets/js/libs/d3/d3.min.js"></script>
		<script src="assets/js/libs/d3/d3.v3.js"></script>
		<script src="assets/js/libs/rickshaw/rickshaw.min.js"></script>
		<script src="assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="assets/js/libs/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="assets/js/libs/jquery-validation/dist/additional-methods.min.js"></script>
		<script src="assets/js/libs/wizard/jquery.bootstrap.wizard.min.js"></script>
		<script src="assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
		<script src="assets/js/core/source/App.js"></script>
		<script src="assets/js/core/source/AppNavigation.js"></script>
		<script src="assets/js/core/source/AppOffcanvas.js"></script>
		<script src="assets/js/core/source/AppCard.js"></script>
		<script src="assets/js/core/source/AppForm.js"></script>
		<script src="assets/js/core/source/AppNavSearch.js"></script>
		<script src="assets/js/core/source/AppVendor.js"></script>
		<script src="assets/js/core/demo/Demo.js"></script>
		<script src="assets/js/core/demo/DemoTableDynamic.js"></script>
		<script src="assets/js/core/demo/DemoFormWizard.js"></script>
		<script src="assets/js/core/demo/DemoFormComponents.js"></script>
	    <script src="assets/js/libs/fileInput/fileInput.js"></script>
		<script src="assets/js/libs/fileInput/fileInput_locale_es.js"></script>
		<script src="assets/js/libs/toastr/toastr.js"></script>
		<script src="assets/scripts/cadenas.js"></script>

		<script>
		$( document ).ready(function() {
			<?php
			if (isset( $_SESSION['ATZmsjRegistraMttos'])) {
				echo "notificaBad('".$_SESSION['ATZmsjRegistraMttos']."');";
				unset($_SESSION['ATZmsjRegistraMttos']);
			}
			if (isset( $_SESSION['ATZmsjSuccesRegistraMttos'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesRegistraMttos']."');";
				unset($_SESSION['ATZmsjSuccesRegistraMttos']);
			}
			?>
		});

		$('.fechado').datepicker({
			todayHighlight: true,
			format: "yyyy-mm-dd",
			language: "es"
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

			$(".foto").fileinput({
				showUpload: false,
				showCaption: false,
				language: 'es',
				allowedFileExtensions : ['jpg', 'jpeg','png'],
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
				$.post("funciones/listarServicios.php",
					{ ident:listServicio},
						function(resp){
						$("#servicio").html(resp);
					});
			}
/*			function listarProductoAsignado(listProducto){
				$.post("funciones/listarProductoAsignado.php",
					{ ident:listProducto},
						function(resp){
						$("#productoReparado").html(resp);
					});
			}*/
		</script>
		<!-- END JAVASCRIPT -->


	</body>
</html>
