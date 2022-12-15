<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('operadores.php');
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
								<header> Operadores</header>
								<div class="tools">
									<div class="btn-group" data-toggle="tooltip" data-placement="top" data-original-title="Crear nuevo Chofer">
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
											//error_reporting(E_ALL); //muestra todos los errores encontrados en la página
											//print_r($_SESSION);			//muestra las sesiones
											$sql="SELECT op.*, ce.nombre AS estado, cm.nombre AS municipio,op.fotos AS foto
														FROM operadores op
														LEFT JOIN catestados ce ON ce.id = op.idCatEstado
														LEFT jOIN catmunicipios cm ON cm.id = op.idCatMunicipio
														ORDER BY nombre ASC";
											$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
										?>
										<div class="table-responsive">
											<table id="datatable1" class="table table-striped table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Foto</th>
														<th>Nombre</th>
														<th>Apellidos</th>
														<th>Estado</th>
														<th>Municipo</th>
														<th>Dirección</th>
														<th>Teléfonos</th>
														<th>Contacto y Teléfono de Emergencia</th>
														<th>Caducidad de Licencia</th>
														<th>Fecha de Nacimiento</th>
														<th>Fecha de ingreso</th>
														<th>IMSS</th>
														<th>Licencia</th>
														<th>Domicilio</th>
														<th>INE</th>
														<th>Doc. curp</th>
														<th>Curp</th>
														<th>Tipo de Sangre</th>
														<th>Bono de Antiguedad</th>
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
														$foto = ($dat['foto'] == '') ? 'assets/img/noimg.png' : $dat['foto'] ;
														if ($dat['doctoImss'] == '') {
															$btnDoctoImss = '<button type="button" disabled class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
														}else {
															$btnDoctoImss = '<button type="button" onclick="verPDFImss('.$dat['id'].')" data-toggle="modal" data-target="#verPDF" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
														}
														if ($dat['doctoLicencia'] == '') {
															$btnDoctoLicencia = '<button type="button" disabled class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
														}else {
															$btnDoctoLicencia = '<button type="button" onclick="verPDFLicencia('.$dat['id'].')" data-toggle="modal" data-target="#verPDF" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
														}
														if ($dat['doctoIne'] == '') {
															$btnDoctoIne = '<button type="button" disabled class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
														}else {
															$btnDoctoIne = '<button type="button" onclick="verPDFIne('.$dat['id'].')" data-toggle="modal" data-target="#verPDF" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
														}

														if ($dat['doctoDomicilio'] == '') {
															$btnDoctoDomicilio = '<button type="button" disabled class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
														}else {
															$btnDoctoDomicilio = '<button type="button" onclick="verPDFDomicilio('.$dat['id'].')" data-toggle="modal" data-target="#verPDF" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
														}
														if ($dat['doctoCurp'] == '') {
															$btnDoctoCurp = '<button type="button" disabled class="btn btn-icon-toggle text-default-light" data-toggle="tooltip" data-placement="top" data-original-title="No se ha subido ningun Documento."><i class="fa fa-file"></i></button>';
														}else {
															$btnDoctoCurp = '<button type="button" onclick="verPDFCurp('.$dat['id'].')" data-toggle="modal" data-target="#verPDF" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Ver Documento."><i class="fa fa-file-pdf-o"></i></button>';
														}
														$fechaNac = substr($dat['fechaNac'], 2, 8);
														$fechaLic = substr($dat['caduLicencia'], 2, 8);
														$fechaIng = substr($dat['fechaIngreso'], 2, 8);
														$bonoAnt = ($dat['bonoAntiguedad'] == 0) ? 'No aplica' : 'Si aplica' ;

														echo '
														<tr '.$estatusText.'>
															<td>'.$dat['id'].'</td>
															<td><button type="button" class="btn ink-reaction btn-icon-toggle btn-primary" data-toggle="modal" data-target="#simpleModal" onclick="visualizaImg(\'../'.$foto.'\', \''.$dat['nombre'].'\', \''.$dat['apellidos'].'\');"><img class="img-circle width-1" src="../'.$foto.'" alt="IMG"></button></td>
															<td>'.$dat['nombre'].'</td>
															<td>'.$dat['apellidos'].'</td>
															<td>'.$dat['estado'].'</td>
															<td>'.$dat['municipio'].'</td>
															<td>'.$dat['direccion'].'</td>
															<td>Pers: '.$dat['telPersonal'].' <br> Corp: '.$dat['telCorporativo'].'</td>
															<td>'.$dat['contEmergencia'].'<br>'.$dat['telEmergencia'].'</td>
															<td>'.$fechaLic.'</td>
															<td>'.$fechaNac.'</td>
															<td>'.$fechaIng.'</td>
															<td class="col-lg-1 text-right" id="doctoImss'.$dat['id'].'"> '.$btnDoctoImss.'</td>
															<td class="col-lg-1 text-right" id="doctoLicencia'.$dat['id'].'"> '.$btnDoctoLicencia.'</td>
															<td class="col-lg-1 text-right" id="doctoDomicilio'.$dat['id'].'"> '.$btnDoctoDomicilio.'</td>
															<td class="col-lg-1 text-right" id="doctoIne'.$dat['id'].'"> '.$btnDoctoIne.'</td>
															<td class="col-lg-1 text-right" id="doctoCurp'.$dat['id'].'"> '.$btnDoctoCurp.'</td>
															<td>CURP: '.$dat['curp'].' <br> No IMSS: '.$dat['noImss'].'</td>
															<td>'.$dat['tipoSangre'].'</td>
															<td>'.$bonoAnt.'</td>
															<td class="col-lg-1 text-center '.$estatusColor.'" id="clienteEstatus'.$dat['id'].'">'.$estatus.'</td>
															<td class="text-center" width="100">
																<button type="button" class="btn btn-icon-toggle" onclick="formEditoperador('.$dat['id'].')" data-toggle="modal" data-target="#formEditoperador"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
																<button type="button" class="btn btn-icon-toggle btn-primary" onclick="eliminaFoto('.$dat['id'].')"><i class="fa fa-times-circle" data-toggle="tooltip" data-placement="top" data-original-title="Elimina Fotografía"></i></button>
															</td>
														</tr>';
													}
													?>
												</tbody>
											</table>
										</div><!--end .table-responsive -->
									</div>
									</div><!--end .col -->
								</div><!--end .row -->
								<!-- END DATATABLE 1 -->
							</div><!--end .card-body -->
						</div><!--end .card -->
						<!-- END ACTION -->
					</div><!--end .section-body -->

				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formEditoperador" tabindex="-1" role="dialog" aria-labelledby="formEditoperadorLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaoperadorContent">
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->


			<div class="modal fade" id="formNewUser" tabindex="-1" role="dialog" aria-labelledby="formNewUserLabel"  aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formNewUserLabel"><b>Crear Operador</b></h4>
						</div>
						<form class="form-horizontal" role="form" method="post" action="../funciones/registraNuevoOperador.php" enctype="multipart/form-data">
							<div class="modal-body">
								<div class="form-group">
									<div class="col-sm-3">
										<label for="nombre" class="control-label">Nombres</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres." required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="apellidos" class="control-label">Apellidos</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos." required>
									</div>
								</div>
							<div class="form-group">
									<div class="col-sm-3">
										<label for="estado" class="control-label">Selecciona su Estado</label>
									</div>
									<div class="col-sm-9">
										<?php
										$sql = "SELECT * FROM catestados ORDER BY nombre ASC";
										$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
										?>
										<select name="newEdo" id="newEdo" class="form-control" onchange="newlistaCatMunicipio(this.value);" required>
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
					          <label for="newmunicipio" class="control-label">Municipo</label>
					        </div>
					        <div class="col-sm-9">
					          <div class="form-control">
					            <select id="newMunicipio" name="newMunicipio" class="form-control">
					              <option value="">&nbsp;</option>
					            </select>
					          </div>
					        </div>
					      </div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="direccion" class="control-label">Ingresa su Dirección</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="direccion" id="direccion" oninput="limpiaCadena(this.value,'direccion');" class="form-control" placeholder="Dirección" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="telPersonal" class="control-label">Telefono Personal</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="telPersonal" id="telPersonal" class="form-control" onkeyup="soloNumeros(this.value,'telPersonal')" maxlength="10" placeholder="Telefono Personal" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="telCorporativo" class="control-label">Telefono Corporativo</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="telCorporativo" id="telCorporativo" class="form-control" maxlength="10" onkeyup="soloNumeros(this.value,'telCorporativo')" placeholder="Telefono Corporativo" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="imss" class="control-label">No. de IMSS</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="imss" id="imss" onkeyup="cambiaMayusculas(this.value,'imss')" class="form-control" placeholder="No. de IMSS" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="curp" class="control-label">CURP</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="curp" id="curp" onkeyup="cambiaMayusculas(this.value,'curp')" class="form-control" placeholder="CURP" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="sangre" class="control-label">Tipo de Sangre</label>
									</div>
									<div class="col-sm-9">
										<input type="text" name="sangre" id="sangre" class="form-control" placeholder="Tipo de Sangre" required>
									</div>
								</div>
								<div class="col-sm-3 text-center">
					           <label class="control-label">Vigencia de la Licencia</label>
					      </div>
								<div class="form-group">
					      		<div class="col-sm-8 form">
					            <div class="input-group date">
					              <div class="input-group-content">
					                <input type="text" class="form-control fechado" id="vigencia" name="vigencia" required>
					              </div>
					              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					            </div>
					          </div><!--end .form-group -->
					      </div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="doctoImss" class="control-label">Documentación IMSS</label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="doctoImss" id="doctoImss"  class="form-control docto">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="doctoCurp" class="control-label">Documentación CURP</label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="doctoCurp" id="doctoCurp"  class="form-control docto">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="doctoIne" class="control-label">Documentación INE</label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="doctoIne" id="doctoIne"  class="form-control docto">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="doctoDomicilio" class="control-label">Comprobante de Domicilio</label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="doctoDomicilio" id="doctoDomicilio"  class="form-control docto">
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-3">
										<label for="doctoLicencia" class="control-label">Documentación Licencia</label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="doctoLicencia" id="doctoLicencia"  class="form-control docto">
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-3">
										<label for="fotos" class="control-label">Fotografía</label>
									</div>
									<div class="col-sm-9">
										<input type="file" name="fotos" id="fotos"  class="form-control foto">
									</div>
								</div>

								<div class="col-sm-3 text-center">
										 <label>Fecha de Nacimiento</label>
								</div>
								<div class="form-group">
										<div class="col-sm-8 form">
											<div class="input-group date">
												<div class="input-group-content">
													<input type="text" class="form-control fechado" id="fechaNac" name="fechaNac" required>
												</div>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div><!--end .form-group -->
								</div>

								<div class="col-sm-3 text-center">
										 <label class="control-label">Fecha de Ingreso a la Empresa</label>
								</div>
								<div class="form-group">
										<div class="col-sm-8 form">
											<div class="input-group date">
												<div class="input-group-content">
													<input type="text" class="form-control fechado" id="fechaIngreso" name="fechaIngreso" required>
												</div>
												<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
											</div>
										</div><!--end .form-group -->
								</div>

							<div class="form-group">
								<div class="col-sm-3">
									<label for="telEmergencia" class="control-label">Teléfono de Emergencia</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="telEmergencia" id="telEmergencia" class="form-control" onkeyup="soloNumeros(this.value,'telEmergencia')" placeholder="Teléfono de Emergencia" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-3">
									<label for="contEmergencia" class="control-label">Contacto de Emergencia</label>
								</div>
								<div class="col-sm-9">
									<input type="text" name="contEmergencia" id="contEmergencia" class="form-control" placeholder="Contacto de Emergencia" required>
								</div>
							</div>
							<div class="modal-footer">
								<input type="hidden" name="pag" value="encargado/choferesEnc.php">
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
		<script src="../assets/scripts/cadenas.js"></script>
		<script>
		function formEditoperador(ident){
			$("#editaoperadorBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
			//alert('ID: '+ident);
			$.post("../funciones/formEditaOperador.php",
				{ ident:ident, pag:'<?=$info->pagina;?>' },
					function(respuesta){
						$("#editaoperadorContent").html(respuesta);
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

		function listaCatMunicipio(estado){
			$.post("../funciones/listaCatMunicipio.php",
				{ ident:estado},
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

		function limpiaCadena(dat,id){
		    //alert(id);
		    dat=getCadenaLimpia(dat);
			$("#"+id).val(dat);
		}

		<?php
		//if (isset( $_SESSION['RVTmsjInfooperadors.php'])){
		if (isset( $_SESSION['ATZmsjEncargadoOperadores'])){
			?>

		toastr.warning('<?php echo $_SESSION['ATZmsjEncargadoOperadores'];?>', 'Hubo un error!',{
			closeButton: true,
			timeOut: 7000,
			});
		<?php
			unset($_SESSION['ATZmsjEncargadoOperadores']);
		}
		if (isset( $_SESSION['ATZmsjSuccesEncargadoOperadores'])){
			?>
		toastr.success("<?php echo $_SESSION['ATZmsjSuccesEncargadoOperadores'];?>", 'Excelente!',{
			closeButton: true,
			timeOut: 7000,
			});
		<?php
			unset($_SESSION['ATZmsjSuccesEncargadoOperadores']);
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

			$('#muestraoperadors').DataTable({
				"dom": "Bfrtip",
				"buttons": true,
				"order": [],
				"colVis": {
					"buttonText": "Columnas",
					"overlayFade": 0,
					"align": "right"
				},
				"language": {
					"lengthMenu": '_MENU_ entradas por pagina',
					"info": "Mostrando paginas _PAGE_ de _PAGES_",
					"sInfo": "Mostrando _START_ al _END_ de _TOTAL_ entradas",
					"sInfoEmpty": "Mostrando 0 al 0 de 0 entradas",
					"infoFiltered": " - filtrado de _MAX_ registros",
					"sInfoFiltered": "(filtrado de _MAX_ entradas totales.)",
					"zeroRecords": "No hay registros que mostrar.",
					"search": '<i class="fa fa-search"></i>',
					"paginate": {
						"previous": '<i class="fa fa-angle-left"></i>',
						"next": '<i class="fa fa-angle-right"></i>'
					}
				}
			});

			$(document).ready(function(){
				$('.txtPopOver').popover('show');

				$('.fechado').datepicker({
					todayHighlight: true,
					format: "yyyy-mm-dd",
					language: "es"
				});
				});
				function cambiaMayusculas(cadena, id){
				  var newCadena = cadena.toUpperCase();
				  //alert(newCadena);
				  $("#"+id).val(newCadena);
				}

				function soloNumeros(cadena, id){
				  var newCadena = cadena.replace(/[^0-9]/g,'');
				  //alert(newCadena);
				  $("#"+id).val(newCadena);
				}

				function verPDFImss(ident){
					$.post("../funciones/verPDF-Operadores.php",
						{ ident:ident,campo:'1' },
							function(respuesta){
								$("#verPDFContent").html(respuesta);
							});
				}
				function verPDFLicencia(ident){
					$.post("../funciones/verPDF-Operadores.php",
						{ ident:ident,campo:'2' },
							function(respuesta){
								$("#verPDFContent").html(respuesta);
							});
				}

				function verPDFDomicilio(ident){
					$.post("../funciones/verPDF-Operadores.php",
						{ ident:ident,campo:'3' },
							function(respuesta){
								$("#verPDFContent").html(respuesta);
							});
				}

				function verPDFCurp(ident){
					$.post("../funciones/verPDF-Operadores.php",
						{ ident:ident,campo:'4' },
							function(respuesta){
								$("#verPDFContent").html(respuesta);
							});
				}

				function verPDFIne(ident){
					$.post("../funciones/verPDF-Operadores.php",
						{ ident:ident,campo:'5' },
							function(respuesta){
								$("#verPDFContent").html(respuesta);
							});
				}

				function visualizaImg(foto,nombre,apellidos){
					$("#cuerpoModal").html('<img class="height-8" width="100%" height="100%" src="'+foto+'">');
					$("#simpleModalLabel").html(nombre+" "+apellidos);
				}

				function eliminaFoto(ident){
					var tabla = ("operadores");
					var mserror = ("ATZmsjAdminAltaVehiculos");
					var mssuccess = ("ATZmsjSuccesAdminAltaVehiculos");
					var pag = ("../Encargado/vehiculos.php");
					$.post("../funciones/eliminarFoto.php",
					//alert('entro y manda estos datos: id('+ident+'), tabla('+tabla+'), pag('+pag+'), exit('+mssuccess+'), error('+mserror+')');
					{ident:ident, tabla:tabla, pag:pag, mserror:mserror, mssuccess:mssuccess},
					function(resp){
						//alert('Respuesta: '+resp);
						var res=resp.split('|');
						//alert('res: '+res);
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
