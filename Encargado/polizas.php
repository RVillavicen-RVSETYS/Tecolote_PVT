	<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('polizas.php');
require '../include/connect.php';
require_once('../funciones/notificaEncargado.php');

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title><?=$info->nombrePag;?></title>

		<!-- BEGIN META -->
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/summernote/summernote.css?1425218701" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileinput.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css?1425466569" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/DataTables/extensions/dataTables.tableTools.css?1423553990" />


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
										#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
										$ase = (isset($_POST['ase']) AND $_POST['ase'] != '') ? $_POST['ase'] : '' ;
										$seguro = (isset($_POST['seguro']) AND $_POST['seguro'] != '') ? $_POST['seguro'] : '' ;
										$ve = (isset($_POST['ve']) AND $_POST['ve'] != '') ? $_POST['ve'] : '' ;
										$comp = (isset($_POST['comp']) AND $_POST['comp'] != '') ? $_POST['comp'] : '' ;


										?>
										<div class="rows">

											<div class="col-lg-1">
												<button type="submit" style="margin-top:5px;" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class='fa fa-spinner fa-spin'></i> --</center>" data-toggle="modal" data-target="#formNewPoliza">Nueva Poliza</button>
									        </div>
										<form class="form" method="post" action="polizas.php">

											<div class="col-lg-offset-1 col-md-2">
						                    <?php
						                    require '../include/connect.php';
						                    $sql = "SELECT * FROM aseguradoras WHERE estatus = '1'";
						                    $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
						                    ?>
						                    <div class="form-group">
						                    <select name="ase" class="form-control select2-list" data-placeholder="">
						                      <option></option>
						                      <optgroup label="Aseguradoras">
						                        <?php
						                        while ($dat = mysqli_fetch_array($res)) {
						                          $active = ($ase == $dat['id']) ? 'selected' : '' ;
						                          echo '<option value="'.$dat['id'].'" '.$active.'> '.$dat['nombre'].' </option>';
						                        }
						                        ?>
						                      </optgroup>
						                     </select>
						                     <label>Seleccione Aseguradora</label>
						                     </div>
						                    </div>

										    <div class="col-lg-1"></div>
											<div class="col-lg-1">
												<div class="form-group">
													<select id="seguro" name="seguro" class="form-control">
														<option value="0" <?=($estatus == 0) ? 'selected' : '';?>>Todos</option>
														<option value="1" <?=($estatus == 1) ? 'selected' : '';?>>Amplia Plus</option>
														<option value="2" <?=($estatus == 2) ? 'selected' : '';?>>Amplia</option>
														<option value="3" <?=($estatus == 3) ? 'selected' : '';?>>Limitado</option>
														<option value="4" <?=($estatus == 4) ? 'selected' : '';?>>Responsabilidad Civil</option>
													</select>
													<label for="Estatus">Tipo de Seguro</label>
												</div>
											</div>


											<div class="col-lg-offset-1 col-md-2">
															 <?php
															 require '../include/connect.php';
															 $sql = "SELECT * FROM vehiculos WHERE estatus = '1'";
															 $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
															 ?>
													<div class="form-group">
															 <select name="ve" class="form-control select2-list" data-placeholder="">
																	 <option></option>
																	 <optgroup label="Vehiculos">
																		 <?php
																		 while ($dat = mysqli_fetch_array($res)) {
																			 $active = ($ve == $dat['id']) ? 'selected' : '' ;
																			echo '<option value="'.$dat['id'].'" '.$active.'> Eco'.$dat['noEconomico'].' /Mod '.$dat['modelo'].' </option>';
																		 }
																		 ?>
																	 </optgroup>
															 </select>
															 <label>Seleccione Vehiculo</label>
													</div>
											</div>
											<div class="col-lg-offset-1 col-md-1">
															 <?php
															 require '../include/connect.php';
															 $csql = "SELECT * FROM complementos WHERE estatus = '1'";
															 $cres = mysqli_query($link, $csql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
															 ?>
													<div class="form-group">
															 <select name="comp" class="form-control select2-list" data-placeholder="">
																	 <option></option>
																	 <optgroup label="Complementos">
																		 <?php
																		 while ($cdat = mysqli_fetch_array($cres)) {
																			 $active = ($comp == $cdat['id']) ? 'selected' : '' ;
																			echo '<option value="'.$cdat['id'].'" '.$active.'> Placas: '.$cdat['placas'].'</option>';
																		 }
																		 ?>
																	 </optgroup>
															 </select>
															 <label>Seleccione Complemento</label>
													</div>
											</div>

											<div class="text-right">
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
										<!--div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>

									</div-->
									<header><i class="fa fa-fw fa-tag"></i> Lista de Polizas</header>
								</div><!--end .card-head -->
											<div class="card-body style-default-bright table-responsive">
												 <?php
							                      $filtroAse='';
							                      $filtroSeguro='';
							                      $filtroVe='';

							                      if ($ase != '' ) {
							                        $filtroAse = "AND pls.idAseguradora = '$ase'";
							                      }


							                      if ($seguro != '' AND $seguro >'0') {

													$filtroSeguro = " AND (pls.tipoSeguro ='$seguro')";
												}

												 if ($ve !='' AND $ve >'0'){
												 	$filtroVe = " AND  (vhs.id = '$ve')";
												 }

												  require '../include/connect.php';

            						$sql = "SELECT pls.*, DATE_FORMAT(pls.fechaVence, '%d %M %Y') AS fechaVe, DATE_FORMAT(pls.fechaContrato, '%d %M %Y') AS fechaCon, asd.nombre AS aseguradoraName, asd.noEmergencia,  CONCAT('No ECO',vhs.noEconomico,'(',mrk.nombre,'/',sbmk.nombre,'/',vhs.modelo,')') AS ve,
														cont.nombre AS nomContacto, CONCAT('Placas: ',comp.placas) AS placaComp,DATEDIFF(pls.fechaVence,NOW()) AS dias
														FROM polizas pls
														LEFT JOIN aseguradoras asd ON pls.idAseguradora = asd.id
														LEFT JOIN vehiculos vhs ON pls.idVehiculo = vhs.id
														LEFT JOIN catmarcas mrk ON vhs.idCatMarca = mrk.id
														LEFT JOIN catsubmarcas sbmk ON vhs.idCatSubmarca = sbmk.id
														LEFT JOIN complementos comp ON comp.id = pls.idComplemento
														LEFT JOIN contactos cont ON cont.idRegistro = asd.id AND cont.idCatTabla = '1'
														WHERE 1=1 $filtroAse $filtroSeguro $filtroVe
														ORDER BY pls.id DESC";
					              $res = mysqli_query($link, $sql) or die ('<span class="text-danger">Por favor notifica al Administrador</span>');
											#	echo $sql;
												 ?>
												<table class="table table-striped table-hover" id="datatable1">
													<thead>
														<tr>
															<th class="sort-numeric">#</th>
															<th class="sort-alpha">Aseguradora</th>
															<th class="sort-numeric">N° Emergencia</th>
															<th class="">Contacto</th>
															<th class="sort-alpha">Tipo de seguro</th>
															<th class="">N° Poliza</th>
															<th class="">Vehiculo</th>
															<th class="">Complemento</th>
															<th class="">Fecha de Contrato</th>
															<th class="text-center">Fecha de Vencimiento</th>
															<th class="text-center">Documentacion</th>
															<th class="text-center">Comprobante de Pago</th>
															<th class="">Estatus</th>
															<th class="">Opciones</th>
														</tr>
													</thead>
													<tbody>
														 <?php

              								  while ($dat = mysqli_fetch_array($res)) {

																	if ($dat['dias'] < 30 && $dat['estatus'] == 1) {
																		$colorFila = 'class="info"';
																	} elseif ($dat['dias'] < 30 && $dat['estatus'] == 2) {
																		$colorFila = 'class="warning"';
																	} elseif ($dat['dias'] < 30 && $dat['estatus'] == 3) {
																		$colorFila = 'class="danger"';
																		#$colorFila = 'style="background-color:red; color:white;"';
																	} else {
																		$colorFila = '';
																	}

		                            switch ($dat['tipoSeguro']){
		                              case 1:   $estado='Amplia Plus';      				break;
		                              case 2:   $estado='Amplia';           				break;
		                              case 3:   $estado='Limitado';         				break;
		                              case 4:   $estado='Responsabilidad Civil';  	break; //fin del caso 4 'cancelado'

		                              }
		                            switch ($dat['estatus']){
		                              case 1:   $estatus='Activo';    		break;
		                              case 2:   $estatus='Suspendido';  	break;
		                              case 3:   $estatus='Cancelado';     break;
														   		}
																	$doctoOnClick =  ($dat['doctoContrato'] == '') ? 'disabled' : 'onclick="verPDF('.$dat['id'].')" data-toggle="modal" data-target="#verPDF"';
																	$doctoMsj =  ($dat['doctoContrato'] == '') ? 'No se ha subido ningun Documento.' : 'Ver Documento.';

									                if ($dat['doctoContrato'] == '') {
																		$btnDoctoCarga = '<button type="button" '.$doctoOnClick.' class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="'.$doctoMsj.'"><i class="fa fa-file"></i></button>';
																	}else {
																		$btnDoctoCarga = '<button type="button" '.$doctoOnClick.' class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="'.$doctoMsj.'"><i class="fa fa-file-pdf-o"></i></button>';
																	}

																	$comproOnClick =  ($dat['doctoPago'] == '') ? 'disabled' : 'onclick="verPDF2('.$dat['id'].')" data-toggle="modal" data-target="#verPDF"';
																	$doctoMsj2 =  ($dat['doctoPago'] == '') ? 'No se ha subido ningun Comprobante de Pago.' : 'Ver Comprobante.';

									                if ($dat['doctoPago'] == '') {
																		$btnCargaComprobante = '<button type="button" '.$comproOnClick.' class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="'.$doctoMsj2.'"><i class="fa fa-file"></i></button>';
																	}else {
																		$btnCargaComprobante = '<button type="button" '.$comproOnClick.' class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="'.$doctoMsj2.'"><i class="fa fa-file-pdf-o"></i></button>';
																	}

               								 echo '
                								<tr '.$colorFila.'>
                								  <td> '.$dat['id'].' </td>
              							      <td> '.$dat['aseguradoraName'].'</td>
              							      <td> '.$dat['noEmergencia'].'</td>
              							      <td> '.$dat['nomContacto'].'</td>
              							   	  <td> '.$estado.'</td>
                							 	  <td> '.$dat['contrato'].' </td>
                							 	  <td> '.$dat['ve'].'</td>
																	<td> '.$dat['placaComp'].'</td>
                								  <td> '.$dat['fechaCon'].'</td>
                 								  <td class="text-center"> '.$dat['fechaVe'].'</td>
                 								  <td class="col-lg-1 text-center" '.$dat['id'].'"> '.$btnDoctoCarga.'</td>
																	<td class="col-lg-1 text-center" '.$dat['id'].'"> '.$btnCargaComprobante.'</td>
                									<td> '.$estatus.'</td>
	                								<td>
	                								 <button type="button" class="btn btn-icon-toggle text-center" onclick="formEditaPoliza('.$dat['id'].')" data-toggle="modal" data-target="#formEditaPoliza"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
	                								 <!-- button type="button" onclick="quitaPolizas('.$dat['id'].');" class="btn btn-icon-toggle" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar Registro"><i class="fa fa-trash-o"></i></button -->
	                								</td>
               								 </tr>
               								 ';
              								}

                          								?>
														</tbody>
												</table>

									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->

			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->

			<div class="modal fade" id="formEditaPoliza" tabindex="-1" role="dialog" aria-labelledby="formEditaPolizaLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaPolizaContent">
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="formNewPoliza" tabindex="-1" role="dialog" aria-labelledby="formNewPolizaLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formNewPolizaLabel"><b>Agregar Poliza</b></h4>
						</div>
							<form class="form-horizontal" role="form" method="post" action="../funciones/registraNuevoPoliza.php" enctype="multipart/form-data">
								<div class="modal-body">

							<div class="form-group">
					        <div class="col-sm-3">
					        <label for="ase" class="control-label">Seleccione Aseguradora</label>
					        </div>
					        <div class="col-sm-9">
				          <?php
				          $sql = "SELECT * FROM aseguradoras WHERE estatus= '1'";
				          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
				          ?>
				          <select name="ase" id="ase" class="form-control"  required>
										<option value="0"></option>
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
				          <label for="banco" class="control-label">Seleccione Seguro</label>
				        </div>

				         <div class="col-sm-9">
				          <select class="form-control" name="tipoS" required>
											<option value="0"></option>
											<option value="1">Amplia Plus</option>
											<option value="2">Amplia</option>
											<option value="3">Limitado</option>
											<option value="4">Responsailidad Social</option>

				          </select>
				        </div>
				      </div>

				       <div class="form-group">
				        <div class="col-sm-3">
				          <label for="contrato" class="control-label">N° Poliza</label>
				        </div>
				        <div class="col-sm-9">
				          <input type="text" name="con" id="con"  class="form-control"  required>
				        </div>
				        </div>

				      	<div class="form-group">
						    <div class="col-sm-3">
				           <label class="control-label">Fecha Contrato</label>
				      </div>

				        <div class="col-sm-9 form">
				        <div class="input-group date">
				        <div class="input-group-content">
				                <input type="text" class="form-control fechado" onchange="vaciaFecha(1);" id="fechaCon" name="fechaCon" required>
				              </div>
				              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				        </div>
				        </div><!--end .form-group -->
				        </div>

				        <div class="form-group">
				        <div class="col-sm-3" >
				           <label class="control-label">Fecha Vencimiento</label>
				        </div>

				        <div class="col-sm-9 form">
				        <div class="input-group date">
				        <div class="input-group-content">
				            <input type="text" class="form-control fechado" id="fechave" name="fechave" required>
				        </div>
				 	       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				        </div>
				        </div><!--end .form-group -->
				        </div>

						  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Registrar</button>
							</div>
						</div>
					</form>
	</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<div class="modal fade" id="verPDF" tabindex="-1" role="dialog" aria-labelledby="verPDFLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content" id="verPDFContent">
			</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
	<div class="modal fade" id="verPDF" tabindex="-1" role="dialog" aria-labelledby="verPDFLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="verPDFContent">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="verPDFTitle"> Ver PDF</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
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
		<script src="../assets/js/libs/DataTables/jquery.dataTables.min.js"></script>
		<script src="../assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js"></script>
		<script src="../assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
		<script>
		<?php
			if (isset( $_SESSION['ATZmsjEncargadoPolizas'])) {
				echo "notificaBad('".$_SESSION['ATZmsjEncargadoPolizas']."');";
				unset($_SESSION['ATZmsjEncargadoConVentas']);
			}
			if (isset( $_SESSION['ATZmsjSuccesEncargadoPolizas'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesEncargadoPolizas']."');";
				unset($_SESSION['ATZmsjSuccesEncargadoPolizas']);
			}
			?>

		function formEditaPoliza(ident){
			$("#editaPolizaBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
			//alert('ID: '+ident);
			$.post("../funciones/formEditaPolizas.php",
				{ ident:ident},
					function(respuesta){
						$("#editaPolizaContent").html(respuesta);
					});
		}

		function quitaPolizas(ident){
 		 $.post("../funciones/borrarPolizas.php",
  		  { ident:ident },
      function(respuesta){
        if (respuesta == 1) {
          notificaSuc('Se a Borrado Correctamente.');
          $("#filaUser"+ident).remove();
        } else {
          notificaBad('No se pudo borrar el Usuario');
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

			$(document).ready(function(){
			    $('.txtPopOver').popover('show');

			    $('.fechado').datepicker({
			      todayHighlight: true,
			      format: "yyyy-mm-dd",
			      language: "es"
			    });

			    $(".docto").fileinput({
			      showUpload: false,
			      showCaption: false,
			      language: 'es',
			      maxFileSize: 5120,
			      maxFilesNum: 1,
			      browseClass: "btn btn-primary btn-lg",
			      fileType: "any",
			      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
			    });
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

					 function verPDF(ident){
					 $.post("../funciones/verPDF-Polizas.php",
						 { ident:ident },
							 function(respuesta){
								 $("#verPDFContent").html(respuesta);
							 });
				 }

				 function verPDF2(ident){
				 $.post("../funciones/verPDF-ComprobantePolizas.php",
					 { ident:ident },
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

					function vaciaFecha(tipo){
						if (tipo == 1) {
//							var fechaVen = $("#fechaCon").val();
							$("#fechave").val('');
						} else {
	//						var fechaVen2 = $("#eFechaCon").val();
							$("#eFechave").val('');
						}
					}


		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
