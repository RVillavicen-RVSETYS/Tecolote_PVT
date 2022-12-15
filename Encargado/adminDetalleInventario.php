<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('adminDetalleInventario.php');
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/select2/select2.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/material-design-iconic-font.min.css?1421434286" />
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
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/toastr/toastr.css" />
		<link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/fileInput/fileInput.css" />

    <link rel="shortcut icon" href="../favicon.ico">
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed full-content ">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="index.php">
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
					<ul class="header-nav header-nav-toggle">
						<li>
							<a class="btn btn-icon-toggle btn-default" href="#offcanvas-search" data-toggle="offcanvas" data-backdrop="false">
								<i class="fa fa-ellipsis-v"></i>
							</a>
						</li>
					</ul><!--end .header-nav-toggle -->
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
				<section class="has-actions style-default">

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

					<!-- BEGIN INBOX -->
					<div class="section-body">
						<div class="row">

						<!-- BEGIN ACTION -->
						<div class="card">
							<div class="card-head">
								<header><i class="md md-content-paste"></i> Detalle de Cada Producto</header>
								<div class="tools">
									<div class="btn-group" data-toggle="tooltip" data-placement="top" data-original-title="Crear nuevo Producto">
										<!-- <a class="btn btn-floating-action btn-primary" data-toggle="modal" data-target="#formNewProducto"><i class="fa fa-plus"></i></a> -->
									</div>
								</div>
							</div>

							<div class="card-body">
								<!-- BEGIN DATATABLE 1 -->
								<?php
								#print_r($_SESSION);
								error_reporting(E_ALL); //muestra todos los errores encontrados en la página
								require('../include/connect.php');
								$sql="SELECT stk.*, pdto.nombre AS producto, dpto.nombre AS depto, cmk.nombre AS mark, csm.nombre AS submrk,
												stk.idAsignaVehiculo, CONCAT(opr.nombre, ' ',opr.apellidos) AS nameOperador, vhc.noEconomico, pdto.foto, stk.precio AS precioProd
											FROM stocks stk
											INNER JOIN productos pdto ON stk.idProducto = pdto.id
											INNER JOIN catdeptos dpto ON pdto.idDepto = dpto.id
											INNER JOIN catmarcas cmk ON pdto.idCatMarca = cmk.id
											INNER JOIN catsubmarcas csm ON pdto.idCatSubMarca = csm.id
											LEFT JOIN asignavehiculos asgvh ON stk.idAsignaVehiculo = asgvh.id
											LEFT JOIN operadores opr ON asgvh.idOperador = opr.id
											LEFT JOIN vehiculos vhc ON asgvh.idVehiculo = vhc.id
											ORDER BY pdto.nombre ASC";
								//echo $sql.'<br>';
								$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
								?>
									<div class="table-responsive">
										<table id="listadoDeInventario" class="table table-striped table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>Departamento</th>
													<th>nombre</th>
													<th>Marca</th>
													<th>Modelo</th>
													<th>Serie</th>
													<th class="text-center">Precio</th>
													<th>Asignado a:</th>
													<th class="text-center">Rotulado</th>
													<th class="text-center">Estatus</th>
													<th>Editar</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$cont = 0;
												while ($dat = mysqli_fetch_array($res)) {
													$cont++;
													switch ($dat['estatus']) {
														case '0':
															$estatus = '<center class="text-danger"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Dado de Baja"><i class="md md-close"></i></center>';
															$estatusText = 'class="text-default-light"';
															break;

														case '1':
															$estatus = '<center class="text-success"  data-toggle="tooltip" data-placement="top" title="" data-original-title="En Bodega"><i class="md md-done"></i></center>';
															$estatusText = 'class="text-default"';
															break;

														case '2':
															$estatus = '<center class="text-info"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Asignado"><i class="fa fa-minus"></i></center>';
															$estatusText = 'class="text-default-light"';
															break;

														default:
															$estatus = '';
															$estatusText = 'class="text-default"';
															break;
													}
													$rotulos = ($dat['rotulado'] == 1) ? '<center class="text-success"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Rotulado"><i class="md md-done"></i></center>' : '<center class="text-danger"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Pendiente por Rotular"><i class="md md-close"></i></center>' ;
													$precioDeProd = ($dat['precioProd'] != 0) ? $dat['precioProd'] : 0 ;
													$eco = ($dat['noEconomico'] >= 1) ? '<b>ECO-'.str_pad($dat['noEconomico'], 4, "0", STR_PAD_LEFT).':</b> '.$dat['nameOperador'] : '' ;
													echo '
													<tr '.$estatusText.'>
														<td>'.$cont.'</td>
														<td>'.$dat['depto'].'</td>
														<td>'.$dat['producto'].'</td>
														<td>'.$dat['mark'].'</td>
														<td>'.$dat['submrk'].'</td>
														<td>'.$dat['noSerie'].'</td>
														<td class="text-center">'.$precioDeProd.'</td>
														<td>'.$eco.'</td>
														<td class="text-center">'.$rotulos.'</td>
														<td class="text-center">'.$estatus.'</td>
														<td class="text-center" data-toggle="tooltip" data-placement="top" data-original-title="Editar registro">
															<button type="button" class="btn btn-icon-toggle" onclick="editaProd('.$dat['id'].')" data-toggle="modal" data-target="#formEditProducto"><i class="fa fa-pencil"></i></button>
														</td>
													</tr>';
												}
												?>
											</tbody>
										</table>
									</div><!--end .table-responsive -->
								<!-- END DATATABLE 1 -->
							</div><!--end .card-body -->
						</div><!--end .card -->

						</div><!--end .row -->
					</div><!--end .section-body -->
					<!-- END INBOX -->

					<!-- BEGIN SECTION ACTION -->
					<div class="section-action style-primary">
						<div class="section-action-row">
						</div>
						<div class="section-floating-action-row">
							<a class="btn ink-reaction btn-floating-action btn-lg btn-accent" href="adminListadoDeArticulos.php" data-toggle="tooltip" data-placement="top" data-original-title="Ver Detalle de cada Producto.">
								<i class="md md-format-list-bulleted"></i>
							</a>&nbsp;
							<a class="btn ink-reaction btn-floating-action btn-lg btn-accent" href="adminInventario.php" data-toggle="tooltip" data-placement="top" data-original-title="Regresar a Registro y Asignación.">
								<i class="md md-reply-all"></i>
							</a>
						</div>
					</div><!--end .section-action -->
					<!-- END SECTION ACTION -->

				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<!-- BEGIN FORM MODAL MARKUP -->
			<div class="modal fade" id="formEditProducto" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content" id="editaProdContent">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="formEditaProdLabel">Modificar Producto: <span id="nameProdEdit"></span></h4>
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

					<div class="menubar-foot-panel">
						<small class="no-linebreak hidden-folded">
							<span class="opacity-75">Copyright &copy; 2019</span>
						</small>
					</div>
				</div><!--end .menubar-scroll-panel-->
			</div><!--end #menubar-->
			<!-- END MENUBAR -->

			<!-- BEGIN OFFCANVAS RIGHT -->
			<div class="offcanvas">

				<!-- BEGIN OFFCANVAS SEARCH -->
				<div id="offcanvas-search" class="offcanvas-pane width-8">
					<div class="offcanvas-head">
						<header class="text-primary">Telefonos de Contacto</header>
						<div class="offcanvas-tools">
							<a class="btn btn-icon-toggle btn-default-light pull-right" data-dismiss="offcanvas">
								<i class="md md-close"></i>
							</a>
						</div>
					</div>
					<div class="offcanvas-body no-padding">
						<ul class="list ">
							<li class="tile divider-full-bleed">
								<div class="tile-content">
									<div class="tile-text"><strong>A</strong></div>
								</div>
							</li>
						</ul>
					</div><!--end .offcanvas-body -->
				</div><!--end .offcanvas-pane -->
				<!-- END OFFCANVAS SEARCH -->


			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS RIGHT -->

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
		<script src="../assets/js/libs/select2/select2_locale_es.js"></script>
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
		<script src="../assets/js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.es.js"></script>
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
		<script src="../assets/js/core/demo/DemoFormComponents.js"></script>
		<script src="../assets/js/libs/toastr/toastr.js"></script>
		<script src="../assets/js/libs/fileInput/fileInput.js"></script>
		<script src="../assets/js/libs/fileInput/fileInput_locale_es.js"></script>
		<script src="../assets/scripts/cadenas.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
		<script>
	  $(document).ready(function(){
			<?php
			if (isset( $_SESSION['ATZmsjAdminDetalleInventario'])) {
				echo "notificaBad('".$_SESSION['ATZmsjAdminDetalleInventario']."');";
				unset($_SESSION['ATZmsjAdminDetalleInventario']);
			}
			if (isset( $_SESSION['ATZmsjSuccessAdminDetalleInventario'])) {
				echo "notificaSuc('".$_SESSION['ATZmsjSuccessAdminDetalleInventario']."');";
				unset($_SESSION['ATZmsjSuccessAdminDetalleInventario']);
			}
			?>
	  });

		// datatable1

		$('#listadoDeInventario').DataTable({
			dom: 'Bfrtip',
			"iDisplayLength": 10,
			"language": {
				"lengthMenu": '_MENU_ entradas por página',
				"info": "Mostrando páginas _PAGE_ de _PAGES_",
				"sInfo": "Mostrando _START_ al _END_ de _TOTAL_ entradas",
				"sInfoEmpty": "Mostrando 0 al 0 de 0 entradas",
				"infoFiltered": " - filtrado de _MAX_ registros",
				"sInfoFiltered": "(filtrado de _MAX_ entradas totales.)",
				"zeroRecords": "No hay registros que mostrar.",
				"search": '<i class="fa fa-search"></i>',
				"paginate": {
					"previous": '<i class="fa fa-angle-left"></i> Atrás   ',
					"next": '   Siguiente <i class="fa fa-angle-right"></i>'
				}},
			buttons: [
				'copy', 'csv', 'excel', 'print',
				{
						extend: 'pdfHtml5',
						orientation: 'landscape',
						pageSize: 'LEGAL',
				}
			]
		    });

			$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary text-white mr-1');

		function limpiaTexto(txt){
			texto = getCadenaLimpia(txt);
			//alert(texto);
			$("#nombre").val(texto);
		}

		function tipoSerie(value){
			if (value == 1) {
				$("#preserie").prop('disabled', false);
				$("#preserie").prop('placeholder', 'Ingresa la Pre-Serie');
			} else {
				$("#preserie").prop('disabled', true);
				$("#preserie").prop('placeholder', 'Ya no se Ingresa...');
			}
		}

		function listaCatSubmarca(ident){
			$.post("../funciones/listaCatSubmarca.php",
				{ ident:ident},
					function(respuesta){
						$("#modelo").html(respuesta);
					});
		}

		function btnProceso(ident){
			$("#pBtn"+ident).html('<img src="../assets/img/loading.gif" class="img-responsive" style="margin-bottom:-1em" alt="Trabajando..."/>');
			//alert('ID: '+ident);
			$.post("funciones/btnEstatusProceso.php",
				{ identif:ident },
					function(respuesta){
						$("#pBtn"+ident).html(respuesta);
						$("#pBtn"+ident).attr("data-original-title","Atendido: <?=$info->nombreUser;?>");
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

		function editaProd(ident){
			$.post("../funciones/formEditaDetalleInventario.php",
				{ ident:ident },
					function(respuesta){
						$("#editaProdContent").html(respuesta);
					});
		}

		</script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
