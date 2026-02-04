<?php
function doctoStock($ident){
require '../include/connect.php';
}

$ident = (isset($_POST['departamento'])) ? $_POST['departamento'] : '' ;
#echo '<br><br>$ident: '.$ident.'<br>';
$Val = ($ident > 0) ?  (' AND pdto.idDepto = \''.$ident.'\''): '' ;
#echo '<br><br>$Val: '.$Val.'<br>';

$sql="SELECT stk.*, pdto.nombre AS producto, dpto.nombre AS depto, cmk.nombre AS mark, csm.nombre AS submrk,
				pdto.foto
			FROM stocks stk
			INNER JOIN productos pdto ON stk.idProducto = pdto.id
			INNER JOIN catdeptos dpto ON pdto.idDepto = dpto.id
			INNER JOIN catmarcas cmk ON pdto.idCatMarca = cmk.id
			LEFT JOIN catsubmarcas csm ON pdto.idCatSubMarca = csm.id
			WHERE stk.estatus = '1' $Val
			ORDER BY pdto.idDepto,pdto.nombre ASC";
//echo $sql.'<br>';
$res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Stocks</title>

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

    <link rel="shortcut icon" href="../favicon.ico">
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>

										<!-- BEGIN INVOICE HEADER -->
										<div class="row">
										  <div class="col-lg-12">
										    <div class="card card-printable style-default-light">
										      <div class="card-head">
										        <div class="tools">
										          <div class="btn-group">
										            <a class="btn btn-floating-action btn-primary" href="javascript:void(0);" onclick="javascript:window.print();"><i class="md md-print"></i></a>
										          </div>
										        </div>
										      </div><!--end .card-head -->
										      <div class="card-body style-default-bright">

										        <!-- BEGIN INVOICE HEADER -->
										        <div class="row">
										          <div class="col-xs-8">
										          <h1 class="text-light"><i class=" text-accent-dark"> </i><img src="../favicon.ico" width="150" height="150"></h1>
										          </div>
										          <div class="col-xs-4 text-right">
										            <h1 class="text-light text-default-light">Listado de Stock</h1>
										          </div>
										        </div><!--end .row -->
										        <!-- END INVOICE HEADER -->

										        <br/>

										        <!-- BEGIN INVOICE DESCRIPTION -->
										        <div class="row">
										          <div class="col-xs-4">
										            <address>
										              <strong>TYLOG EXPRESS S DE RL DE CV
										                </strong>

										            </address>
										          </div><!--end .col -->
										          <div class="col-xs-4">
										          </div><!--end .col -->
										          <div class="col-xs-4">

										          </div><!--end .col -->
										        </div><!--end .row -->
										        <!-- END INVOICE DESCRIPTION -->

										<br/>

										<!-- BEGIN INVOICE PRODUCTS -->
										<div class="row">
											<div class="col-md-12">
													<div class="table-responsive">
														<table id="tablaProductos" class="table">
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Departamento</th>
																	<th>nombre</th>
																	<th>Marca</th>
																	<th>Modelo</th>
																	<th>Serie</th>
																	<th class="text-center">Estatus</th>
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
																	#$fecha = $dat['dateReg'];
																	echo '
																	<tr '.$estatusText.'>
																		<td>'.$cont.'</td>
																		<td>'.$dat['depto'].'</td>
																		<td>'.$dat['producto'].'</td>
																		<td>'.$dat['mark'].'</td>
																		<td>'.$dat['submrk'].'</td>
																		<td>'.$dat['noSerie'].'</td>
																		<td class="text-center"><input type="checkbox" class="form-control"></td>
																	</tr>';
																}
																?>
															</tbody>
														</table>
											</div><!--end .col -->
										</div><!--end .row -->
										<!-- END INVOICE PRODUCTS -->

									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
						</div><!--end .row -->


					</div><!--end .section-body -->

				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->


			<!-- BEGIN MENUBAR-->
			<!--div id="menubar" class="menubar-inverse ">

				<div class="menubar-scroll-panel">

					<! BEGIN MAIN MENU -->
					<!-- ul id="main-menu" class="gui-controls"-->

						<!-- MENU LATERAL -->
						<!-- ?=$info->generaMenuLateral();?>

					</ul><!end .main-menu -->
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
		<script src="../assets/js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../assets/js/libs/spin.js/spin.min.js"></script>
		<script src="../assets/js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="../assets/js/libs/jquery-knob/jquery.knob.min.js"></script>
		<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../assets/js/core/source/App.js"></script>
		<script src="../assets/js/core/source/AppNavigation.js"></script>
		<script src="../assets/js/core/source/AppOffcanvas.js"></script>
		<script src="../assets/js/core/source/AppCard.js"></script>
		<script src="../assets/js/core/source/AppForm.js"></script>
		<script src="../assets/js/core/source/AppNavSearch.js"></script>
		<script src="../assets/js/core/source/AppVendor.js"></script>
		<script src="../assets/js/core/demo/Demo.js"></script>
		<!-- END JAVASCRIPT -->

	</body>
</html>
