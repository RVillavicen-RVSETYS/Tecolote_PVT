<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('asignaVehiculo.php');
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

						<div class="row">
							<div class="col-md-12">

								<!-- BEGIN ACTION -->
								<div class="card">
									<div class="card-body">
										<!-- BEGIN DATATABLE 1 -->
										<div class="row">
			                 <div class="col-lg-12">
			                     <h1 class="page-header">Asignación de Vehículos</h1>
			                 </div>
			                 <!-- /.col-lg-12 -->
			             </div>
			             <!-- /.row -->

			             <div class="row">
			                 <div class="col-lg-12">
			                     <div class="panel panel-default">
			                         <div class="panel-heading style-primary card-bordered text-center">
			                             Datos requeridos
			                         </div>
			                         <div class="panel-body">
			                             <div class="row">
			                             	<form role="form" action="../funciones/registraAsignaVehiculo.php" method="POST">
			                                 <div class="col-lg-12">
											 <?php
											 require('../include/connect.php');
											 //error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											 //print_r($_SESSION);			//muestra las sesiones
											 $sql="SELECT op.*, op.nombre AS nomOpe, op.apellidos AS apeOpe, op.id AS idOpera
											 			FROM operadores op
														WHERE (op.id NOT IN (SELECT asg.idOperador FROM asignavehiculos asg WHERE asg.estatus = '1')) And op.estatus='1'";
											 $res=mysqli_query($link,$sql) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');

											 $sql2="SELECT ve.*, CONCAT(ve.noEconomico, ' - ' , ctm.nombre, ' - ', ctsm.nombre) AS noEco
														FROM
															vehiculos ve
														INNER JOIN cattipovehiculos ctv ON ctv.id = ve.idCatTipoVehiculo
														INNER JOIN catmarcas ctm on ctm.id = ve.idCatMarca
														LEFT JOIN catsubmarcas ctsm on ctsm.id= ve.idCatSubmarca
															WHERE ve.id NOT IN (SELECT asg.idVehiculo FROM asignavehiculos asg WHERE asg.estatus = '1')
															AND ctv.nombre <> 'Dolly'";
											$res2=mysqli_query($link,$sql2) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');

											$sql3="SELECT ve.*, ve.noEconomico AS noDolly
														FROM vehiculos ve
														INNER JOIN cattipovehiculos ctv ON ctv.id = ve.idCatTipoVehiculo
														WHERE ve.id NOT IN (SELECT asd.idVehiculo FROM asignadolly asd) AND ctv.nombre = 'Dolly'";
										 	$res3=mysqli_query($link,$sql3) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');
											 //echo ($sql);
											 #$datovehiculo = mysqli_fetch($dat['id']);		onchange="listaCheck(this.value);"
											  ?>
											 <div class="col-sm-1 text-center" name="idOpe" value="<?=$dat['idOpera']?>">
													 <label>Selecciona Operador</label>
											 </div>
													 <div class="form-group floating-label col-lg-5">
							 							<select id="selOperador" name="selOperador" class="form-control text-center" required>
															<?php
															while ($dat = mysqli_fetch_array($res)) {
																echo '<option value="'.$dat['id'].'">'.$dat['nomOpe'].' '.$dat['apeOpe'].'</option>';
															}
															 ?>
							 							</select>
							 						</div>

													<div class="col-sm-1 text-center"  name="idVehi" value="<?=$dat2['id']?>">
															 <label>Selecciona Vehículo</label>
													 </div>
															 <div class="form-group floating-label col-lg-5">
									 							<select id="selVehiculo" name="selVehiculo" class="form-control text-center" required>
																<?php
																while ($dat2 = mysqli_fetch_array($res2)) {
																	echo '<option value="'.$dat2['id'].'">ECO - '.$dat2['noEco'].'</option>';
																}
																 ?>
									 							</select>
									 						</div>

															<div class="col-sm-1 text-center">
																	 <label>Fecha de Asignación</label>
															 </div>
														<div class="col-sm-5 form">
																<div class="form-group">
																	<div class="input-group">
																		<div class="input-group-content">
																			<input type="text" name="fechaAsigna" id="fechaAsigna" class="form-control fechado" placeholder="" required autocomplete="off">
																			<label>Fecha de Asignación</label>
																		</div>
																		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																	</div>
																</div><!--end .form-group -->
														</div>

			                                   <div class="col-lg-12">
			                                 				<div class="form-group" align="center">
			                                     			<br>
			 	                                				<button id="cargar" type="submit" class="btn btn-default style-primary card-bordered">Asignar</button>
			     	                                		<button type="reset" class="btn btn-default style-primary card-bordered">Limpiar</button>

			                                    		</div>
			                                   </div>
			                                 </div>
																		</form>
			                                 <!-- /.col-lg-8 (nested) -->

			                                 <!-- /.col-lg-4 (nested) -->

			                             </div>
			                             <!-- /.row (nested) -->



															 </div>
			                         <!-- /.panel-body -->
			                     </div>
			                     <!-- /.panel -->
			                 </div>
			                 <!-- /.col-lg-12 -->
			             </div><!--end .row -->

			            <!-- /.row -->
										<!-- END DATATABLE 1 -->
									</div><!--end .card-body -->
								</div><!--end .card -->
								<!-- END ACTION -->
							</div><!--end .col -->
						</div><!--end .row -->
						<div class="row">
							<div class="col-md-12">
								<div class="card card-bordered style-primary">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>

										</div>
									<header><i class="fa fa-fw fa-tag"></i> Lista de Vehículos Asignados para Liberar</header>
									</div><!--end .card-head -->
											<div class="card-body style-default-bright table-responsive">
												<?php
												#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
												#print_r($_SESSION);

												require('../include/connect.php');

												$sqlAsg="SELECT asgv.id, CONCAT(ope.nombre,' ',ope.apellidos) AS nomOpe,
																	CONCAT('Eco ',ve.noEconomico,' - Placas: ',ve.placas) AS dVehiculo,
																	CONCAT(ctmr.nombre,', ', ctsmr.nombre) AS modelo, asgv.fechaAsigna, ope.estatus AS estatusOpe, ve.estatus AS estatusVe, ve.tag AS veTag
																	FROM asignavehiculos asgv
																	INNER JOIN operadores ope ON ope.id = asgv.idOperador
																	INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
																	INNER JOIN catmarcas ctmr ON ctmr.id = ve.idCatMarca
																	LEFT JOIN catsubmarcas ctsmr ON ctsmr.id = ve.idCatSubmarca
																	WHERE asgv.estatus = '1'";
												//echo '<br>sql:  '.$sqlAsg.'<br>';

													$resAsg=mysqli_query($link, $sqlAsg) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
												?>

												<table class="table table-striped table-hover" id="datatable1">
											<thead>
														<tr>
															<th class="text-center">#</th>
															<th class="text-center">Operador</th>
															<th class="text-center">Vehículo</th>
															<th class="text-center">Modelo</th>
															<th class="text-center">TAG</th>
															<th class="text-center">Fecha de Asignación</th>
															<th class="text-center">Desasignar</th>
														</tr>
													</thead>
													<tbody>
														<?php
														while ($asg = mysqli_fetch_array($resAsg)) {
															$seleccion = '
															<input type="hidden" id="noAsignacion" name="idAsignacion" value="'.$asg['id'].'" >
															<button type="submit" class="btn ink-reaction btn-floating-action btn-success"><i class="fa fa-unlink"></i></button>';

															$color = ($asg['estatusOpe'] != '1' || $asg['estatusVe'] != '1') ? 'danger' : '' ;
															$tag = ($asg['veTag'] != '') ? $asg['veTag'] : 'S/R' ;

															echo '
															<tr class="'.$color.' text-'.$color.'">
																<td class="text-center" id="idAsignacion'.$asg['id'].'">'.$asg['id'].'</td>
																<td class="text-center">'.$asg['nomOpe'].'</td>
																<td class="text-center">'.$asg['dVehiculo'].'</td>
																<td class="text-center">'.$asg['modelo'].'</td>
																<td class="text-center">'.$tag.'</td>
																<td  class="text-center">'.$asg['fechaAsigna'].'</td>
																<td class="text-center">
																<form method="POST" action="../funciones/liberaAsignacion.php">
																	'.$seleccion.'
																	</td>
																</form>
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
<!-- aquí va el otro <section>
	==============================================================
</section>

-->
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->

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
			$('.txtPopOver').popover('show');

			$('.fechado').datepicker({
				todayHighlight: true,
				format: "yyyy-mm-dd",
				language: "es"
			});
			});
		<?php
		if (isset( $_SESSION['ATZmsjEncargadoAsignaV'])){
			?>
		toastr.warning('<?php echo $_SESSION['ATZmsjEncargadoAsignaV'];?>', 'Hubo un error!',{
			closeButton: true,
			timeOut: 7000,
			});
		<?php
			unset($_SESSION['ATZmsjEncargadoAsignaV']);
		}
		if (isset( $_SESSION['ATZmsjSuccesEncargadoAsignaV'])){
			?>
		toastr.success("<?php echo $_SESSION['ATZmsjSuccesEncargadoAsignaV'];?>", 'Excelente!',{
			closeButton: true,
			timeOut: 7000,
			});
		<?php
			unset($_SESSION['ATZmsjSuccesEncargadoAsignaV']);
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
