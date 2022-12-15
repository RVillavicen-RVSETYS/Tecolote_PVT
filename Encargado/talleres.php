<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('talleres.php');
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/upload.css" />
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
							<div class="col-md-6">
								<div class="card style-primary card-bordered">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>
										</div>
										<header><i class="fa fa-wrench"></i> Lista de Talleres</header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright table-responsive">
										<?php
											//print_r($_SESSION);
											require('../include/connect.php');
											$sql="SELECT tlls.*,cetd.nombre AS estado, cmpi.nombre AS municipio, esp.nombre AS espicialidad

												FROM talleres tlls
												LEFT JOIN catestados cetd ON tlls.idEstado= cetd.id
												LEFT JOIN catmunicipios cmpi ON tlls.idMunicipio = cmpi.id
												LEFT JOIN catespecialidades esp ON tlls.idCatEspecialidad = esp.id
												WHERE tlls.estatus = 1
												ORDER BY id ASC";
											$res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
										?>
										<table class="table table-hover table-condensed ">
											<thead>
												<tr>

														<td>Nombre</td>
														<td>Estado</td>
														<td>Municipio</td>
														<td>Direccion</td>
														<td>Tel</td>
														<td>Referencia</td>
														<td>Especialidad</td>
										         	<td class="text-center">Estado</td>
													<td class="col-lg-2">Funciones</td>
												</tr>
											</thead>
											<tbody>
													<?php
													while ($dat = mysqli_fetch_array($res)) {
														$estatus = ($dat['estatus'] == '1') ? '<i class="fa fa-check">' : '<i class="fa fa-close">';
														$estatusText = ($dat['estatus'] == '1') ? '' : 'class="text-danger"';
														$estatusColor = ($dat['estatus'] == '1') ? 'text-success' : '';
														$fecha = $dat['fecha'];
														echo '
														<tr '.$estatusText.'>


															<td id="nombre'.$dat['id'].'">'.$dat['nombre'].'</td>
															<td id="estado'.$dat['id'].'">'.$dat['estado'].'</td>
															<td id="municipio'.$dat['id'].'">'.$dat['municipio'].'</td>
															<td id="direccion'.$dat['id'].'">'.$dat['direccion'].'</td>
															<td id="tel'.$dat['id'].'">'.$dat['tel'].'</td>
															<td id="referencia'.$dat['id'].'">'.$dat['referencias'].'</td>
															<td id="especialidad'.$dat['id'].'">'.$dat['espicialidad'].'</td>
															<td class="col-lg-2 text-center '.$estatusColor.'" id="estatus'.$dat['id'].'">'.$estatus.'</td>
															<td class="">
															<button type="button" class="btn btn-icon-toggle" onclick="formEditaTaller('.$dat['id'].')" data-toggle="modal" data-target="#formEditaTaller"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar Registro"></i></button>
															<button type="button" class="btn btn-icon-toggle" onclick="listarContactos('.$dat['id'].')" data-toggle="tooltip" data-placement="top" data-original-title="Ver Contactos Registrados"><i class="fa fa-plus"></i></button>
															</td>
														</tr>';
													}
													?>


											</tbody>
											</table>
											<div colspan="3" class="text-right">
	                                        <div class="btn-group text-center" data-toggle="tooltip" data-placement="top" data-original-title="Crear nuevo ">
											<button class="btn-primary right" data-toggle="modal" data-target="#formNewUser">	<icon class="fa fa-paper-plane-o"></icon> Nuevo Taller.</button>
									</div>
								</div>

									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<div class="col-md-6">
								<div class="card card-bordered style-primary">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>
										</div>
										<header id="tituloContactos"><i class="fa fa-fw fa-users"></i> Contactos de: </header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright">
										<div id="contactosBody" class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Nombre</th>
														<th>Tel. Oficina</th>
														<th>Celular</th>
														<th>Correo</th>
														<th class="text-right">Funciones</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td colspan="3">Selecciona un Cliente.</td>
													</tr>
												</tbody>
											</table>
												<input type="hidden" name="identMarca" id="identMarca" value="0">
										</div>

										<div class="row">
											<form class="form" role="form" method="post" id="NewContacto">
											<div class="col-lg-4 form">
												<div class="form-group floating-label">
													<input type="text" class="form-control" id="newnombrecont" name="newnombrecont" required>
													<label for="regular2">Ingresa Nombre del Contacto.</label>
												</div>
											</div>
											<div class="col-lg-4 form">
												<div class="form-group floating-label">
													<input type="tel" class="form-control" id="newtelOf" name="newtelOf" onkeyup="soloNumeros(this.value, 'newtelOf')" maxlength="10" required >
													<label for="regular2">Tel. Oficina.</label>
												</div>
											</div>
											<div class="col-lg-4 form">
												<div class="form-group floating-label">
													<input type="tel" class="form-control" id="newcel" name="newcel"  onkeyup="soloNumeros(this.value, 'newcel')"  maxlength="10" required>
													<label for="regular2">Celular.</label>
												</div>
											</div>
											<div class="col-lg-4 form">
												<div class="form-group floating-label">
													<input type="text" class="form-control" id="newcorreo" name="newcorreo" required>
													<label for="regular2">Correo.</label>
												</div>
											</div>
											<div class="col-lg-4 text-center">
												<button type="button" id="botonUserAsigna" onclick="asignaSubMarcaAMarca();" disabled class="btn btn-flat btn-default-success ink-reaction btn-loading-state" data-loading-text="<i class=\'fa fa-spinner fa-spin\'></i> CARGANDO...">
													<icon class="fa fa-paper-plane-o"></icon> Nuevo Contacto.
												</button>
											</div>
										</form>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->
					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->
			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formEditaTaller" tabindex="-1" role="dialog" aria-labelledby="formEditaTallerLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaTallerContent">
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

              <div class="modal fade" id="formEditContacto" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="contactoContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formModalLabel">Modificar Contacto</h4>
						</div>
						<div class="modal-body">
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			<div class="modal fade" id="formNewUser" tabindex="-1" role="dialog" aria-labelledby="formNewUserLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formNewUserLabel"><b>Agregar Taller </b></h4>
						</div>
						<form class="form-horizontal" role="form" method="post" action="../funciones/registraNuevoTaller.php" enctype="multipart/form-data">
							<div class="modal-body">
								<div class="form-group">
		        <div class="col-sm-3">
		          <label for="name" class="control-label">Nombre</label>
		        </div>
		        <div class="col-sm-9">
		          <input type="text" name="name" id="name" class="form-control" placeholder="Nombre"  required>
		        </div>
		      </div>

		 	<div class="form-group">
			<div class="col-sm-3">
				<label for="estado" class="control-label">Estado</label>
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
		            <label for="direccion" class="control-label">Direccion</label>
		          </div>
		          <div class="col-sm-9">
		            <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Direccion"  required>
		          </div>
		        </div>

		         <div class="form-group">
		          <div class="col-sm-3">
		            <label for="tel" class="control-label">Tel</label>
		          </div>
		          <div class="col-sm-9">
		            <input type="text" name="tel" id="tel" class="form-control" placeholder="Tel"  required>
		          </div>
		        </div>


		         <div class="form-group">
		          <div class="col-sm-3">
		            <label for="referencia" class="control-label">Referencia</label>
		          </div>
		          <div class="col-sm-9">
		            <input type="text" name="referencia" id="referencia" class="form-control" placeholder="referencia"  required>
		          </div>
		        </div>

 			 <div class="form-group">
                  <div class="col-sm-3">
                    <label for="especialidad" class="control-label">Especialidad</label>
                  </div>
                  <div class="col-sm-9">
                    <?php
                    $sql = "SELECT * FROM catespecialidades ORDER BY nombre ASC";
                    $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
                    ?>
                    <select name="especialidad" id="especialidad" class="form-control" onchange="" required>
                      <option>Seleccione Opcion</option>
                      <?php
                      while ($dat = mysqli_fetch_array($res)) {
                        echo '<option value="'.$dat['id'].'">'.$dat['nombre'].'</option>';
                      }
                      ?>
                    </select>
                </div>
            </div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Registrar</button>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		</div>
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
		<script src="../assets/js/core/demo/DemoFormComponents.js"></script>
		<script src="../assets/scripts/cadenas.js"></script>

		<script >
			$(document).ready(function() {
			$("#idUserasigna").prop('disabled', true);
			$("#botonUserAsigna").prop('disabled', true);


			<?php
			if (isset( $_SESSION['ATZmsjEncargadoProvedores'])) {
				echo "notificaBad('".$_SESSION['ATZmsjEncargadoTalleres']."');";
				unset($_SESSION['ATZmsjEncargadoTalleres']);
			}
			if (isset( $_SESSION['ATZmsjSuccesEncargadoTalleres'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesEncargadoTalleres']."');";
				unset($_SESSION['ATZmsjSuccesEncargadoTalleres']);
			}
			?>
		});

		function formEditaTaller(ident){
			$("#editaTallerBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
			//alert('ID: '+ident);
			$.post("../funciones/formEditaTalleres.php",
				{ ident:ident},
					function(respuesta){
						$("#editaTallerContent").html(respuesta);
					});
		}



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

		function listarContactos(ident){
			name = $("#nombre"+ident).html();
			$("#tituloContactos").html('<i class="fa fa-fw fa-users"></i> Contactos de: <b>'+name+'</b>');
			$.post("../funciones/listarContactoTalleres.php",
      	{ ident:ident, catTabla:'3' },
    			function(respuesta){
      			$("#contactosBody").html(respuesta);
						$("#idUserasigna").prop('disabled', false);
						$("#botonUserAsigna").prop('disabled', false);
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

		function asignaSubMarcaAMarca(){
			idMarca = $("#identMarca").val();
			newnombre = $("#newnombrecont").val();
			newtelOf = $("#newtelOf").val();
			newcel = $("#newcel").val();
			newcorreo = $("#newcorreo").val();
				//alert(idMarca);
			$.post("../funciones/registraNuevoContactoTaller.php",
      	{ newident:idMarca, newnombre:newnombre, newtelOf:newtelOf, newcel:newcel, newcorreo:newcorreo, newtabla:'3'},
    			function(respuesta){
					    var res=respuesta.split('|');
						if (res[0] == '0') {
							notificaBad(res[1]);
						} else {
							notificaSuc('Se a Cargado Correctamente.');
							$("#NewContacto")[0].reset();
							listarContactos(res[1]);
						}
   				});
		}

		function soloNumeros(cadena, id){
  var newCadena = cadena.replace(/[^0-9]/g,'');
  //alert(newCadena);
  $("#"+id).val(newCadena);
}
		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
