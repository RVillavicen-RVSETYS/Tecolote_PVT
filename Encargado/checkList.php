<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('checkList.php');
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
						<div class="col-sm-2">
							<label for="Vehiculo" class="control-label">Selecciona un Veh??culo</label>
						</div>
						<?php
						require('../include/connect.php');
						//error_reporting(E_ALL); //muestra todos los errores encontrados en la p??gina
						//print_r($_SESSION);			//muestra las sesiones
						$sql="SELECT *
									FROM vehiculos ve
									INNER JOIN asignavehiculos asg ON ve.id = asg.idVehiculo AND asg.estatus = '1'
									ORDER BY ve.noEconomico ASC";
						$res=mysqli_query($link,$sql) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');
						//echo ($sql);
						#$datovehiculo = mysqli_fetch($dat['id']);		onchange="listaCheck(this.value);"
						 ?>
						<div class="form-group floating-label col-sm-5">
							<select id="Vehiculo" name="Vehiculo" class="form-control text-center">
								<?php
								while ($dat = mysqli_fetch_array($res)) {
									echo '
									<option value="'.$dat['noEconomico'].'">No ECO-'.$dat['noEconomico'].'</option>
									';
								}


								 ?>
							</select>
						</div>

						<div class="col-sm-2">
							<button type="button" class="btn btn-primary" onclick="recargarLista();"><i class="md md-search"></i>Consultar</button>
						</div>
				<!--===================================================================================-->
						<div class="col-md-12">
							<div class="card card-bordered style-primary">
								<div class="card-head">
									<div class="tools">
										<div class="btn-group">
											<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
										</div>
									</div>
									<header><i class="fa fa-fw fa-tag"></i> Datos del Veh??culo</header>
								</div><!--end .card-head -->
								<div class="card-body style-default-bright table-responsive" id="datoVehiculoContent">

								</div><!--end .card-body -->
							</div><!--end .col -->

							<div class="row">
								<div class="container">
									<center>
										<div class="card-body" id="camion">

										</div>
									</center>
								</div>
							</div>


							<div class="row">
								<div class="card card-bordered style-primary">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
											</div>
										</div>
										<header><i class="fa fa-fw fa-tag"></i> Datos del Veh??culo</header>
									</div><!--end .card-head -->
									<div class="card-body style-default-bright table-responsive">
										<form class="form" role="form" method="post" action="../funciones/registraDescripcion.php">
											<div id="listaContent" class="card-body style-default-bright table-responsive">
											</div>
											<div class="row">
												<div class="modal-header">
													<h4 class="modal-title" id="formNewUserLabel"><b>Agregar Descripci??n</b></h4>
												</div>
												<div class="col-sm-1">
													<label for="name" class="control-label">Descripci??n</label>
												</div>
												<div class="col-sm-7">
													<textarea name="descripcion" id="descripcion" cols="120"></textarea>
												</div>
											</div>
											<div class="col-sm-10" name="descVehiculo" id="descVehiculo" value="<?=$valor;?>"></div>
											<div class="col-sm-1">
												<button type="submit" class="btn btn-primary"><i class="md md-search"></i>Capturar Checklist</button>
											</div>
										</form>
									</div>
								</div>
							</div><!--end .col -->

						</div>
					</div>
				</section>
			</div>

			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formEditPosicion" tabindex="-1" role="dialog" aria-labelledby="formEditPosicionLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaPosicionContent">
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- END FORM MODAL MARKUP -->

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formCambPosicion" tabindex="-1" role="dialog" aria-labelledby="formCambiaPosicionLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="cambiaPosicionContent">
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
		<script>
		function recargarLista(){
			value = $("#Vehiculo").val();
			//alert('Valor de Value: '+value);

			$.post("../funciones/listaCheck.php",
      	{ selVehiculo:value },
    			function(respuesta){
            //alert(respuesta);
      			$("#datoVehiculoContent").html(respuesta);
   				});
<!--//////////////////////////////////////////////////-->
				//alert('Valor de Value: '+value);			muestraVehiculo

				$.post("../funciones/contenidoLista.php",
					{ selVehiculo:value },
						function(respuesta){
							//alert(respuesta);
							$("#listaContent").html(respuesta);
						});

					//alert('Valor de Value: '+value);			muestraVehiculo

					$.post("../funciones/muestraVehiculo.php",
						{ selVehiculo:value },
							function(respuesta){
								//alert(respuesta);
								$("#camion").html(respuesta);
							});

			}

			<?php
			if (isset( $_SESSION['ATZmsjEncargadoCkeckList'])) {
				echo "notificaBad('".$_SESSION['ATZmsjEncargadoCkeckList']."');";
				unset($_SESSION['ATZmsjEncargadoCkeckList']);
			}
			if (isset( $_SESSION['ATZmsjSuccesEncargadoCkeckList'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccesEncargadoCkeckList']."');";
				unset($_SESSION['ATZmsjSuccesEncargadoCkeckList']);
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

			function newDesc(){
				value = $("#Vehiculo").val();
				value2 = $("#descripcion").val();
				value3 = $("#calidad[]").val();
				value4 = $("#idStock[]").val();
				//alert('Valor de Value: '+value);

				$.post("../funciones/registraDescripcion.php",
	      	{ vehiculo:value, descripcion:value2, calidad:value3, idStock:value4},
					function(respuesta){
						//alert(respuesta);
						$("#formNewUserLabel").html(respuesta);
					});
					}

					function formEditPosicion(ident,vehiculo){
						$("#editaPosicionBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
						//alert('ID: '+ident);
						$.post("../funciones/formEditaPosicion.php",
							{ ident:ident,eco:vehiculo},
								function(respuesta){
									$("#editaPosicionContent").html(respuesta);
								});
					}

					function formCambiaPosicion(ident,vehiculo){
						$("#editaPosicionBody").html('<span class="text-default"><img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Cargando..."/></span>');
						//alert('ID: '+ident);
						$.post("../funciones/formCambiaPosicion.php",
							{ ident:ident,eco:vehiculo},
								function(respuesta){
									$("#cambiaPosicionContent").html(respuesta);
								});
					}

		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
