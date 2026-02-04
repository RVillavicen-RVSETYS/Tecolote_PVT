<?php
function doctoNomina($ident){
require '../include/connect.php';
}

$ident1 = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$ident2 = (isset($_POST['ident2'])) ? $_POST['ident2'] : '' ;
#echo '<br><br>$ident: '.$ident.'<br>';
#echo '<br><br>$ident2: '.$ident2.'<br>';
$ident = ($ident1 == '') ? $ident2 : $ident1 ;

	$sql="SELECT DISTINCT(vjs.id) AS idViaje, nmn.id AS folio,nmn.fecha AS fechaFolio, vnt.*,CONCAT(op.nombre,' ',op.apellidos) AS nomOpe,
				CONCAT(ve.noEconomico, ' (Placas: ',ve.placas,')') AS nomVe, ru.destino1 AS d1, ru.destino2 AS d2,
				ru.destino3 AS d3, ctmt.nombre AS nomMat, ru.pagoOperador AS pagoOpe, vnt.peso AS pesoMat, vnt.id AS idVent,ru.tipoViaje, IF(ru.pagoOperador2 > 0,ru.pagoOperador2,0) AS pagoOpe2,op.bonoAntiguedad
				FROM ventas vnt
				INNER JOIN nomina nmn ON vnt.idNomina = nmn.id
				INNER JOIN viajes vjs ON vjs.idVenta = vnt.id
				INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
				INNER JOIN catmateriales ctmt ON ctmt.id = vnt.idCatMaterial
				INNER JOIN operadores op ON op.id = asgv.idOperador
				INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
				INNER JOIN rutas ru ON ru.id = vnt.idRuta
				WHERE nmn.id = '$ident'
				ORDER BY vnt.id ASC";
#  echo $sql;
	$result=mysqli_query($link,$sql) or die(errorBD('Problemas al Consultar los Datos del Ticket.'.mysqli_error($link)));
	$Nom = mysqli_fetch_array($result);
	$folio = $Nom['folio'];
	$fechaFolio = $Nom['fechaFolio'];
	$operador = $Nom['nomOpe'];
	$vehiculo = $Nom['nomVe'];
	mysqli_data_seek($result, 0);
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Nómina</title>

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
		<style>/*No imprime links/ hrefs  */ @media print{ a[href]:after{content:none}}</style>
		<style media="print"> .noImpre{display:"none";}</style>

		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


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
										        <div class="tools noImpre">
															<div class="btn-group">
																<a class="btn btn-floating-action btn-primary noImpre" href="../Admin/nominaOperador.php"><i class="fa fa-reply noImpre"></i></a>
										          </div>
															<div class="btn-group">
																<a class="btn btn-floating-action btn-primary noImpre" href="javascript:void(0);" onclick="javascript:window.print();"><i class="md md-print noImpre"></i></a>
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
										            <h1 class="text-light text-default-light">Nómina</h1>
										          </div>
										        </div><!--end .row -->
										        <!-- END INVOICE HEADER -->

										        <br/>

										        <!-- BEGIN INVOICE DESCRIPTION -->
										        <div class="row">
										          <div class="col-xs-4">
										            <address>
										              <strong>TYLOG EXPRESS S DE RL DE CV</strong><br>
												TEX211106SF3<br>
										            </address>
										          </div><!--end .col -->
										          <div class="col-xs-4">
										          </div><!--end .col -->
										          <div class="col-xs-4">
										            <div class="well">
										              <div class="clearfix">
										                <div class="pull-left"> Folio : </div>
										                <div class="pull-right"><?=$folio;?></div>
										              </div>
																	<div class="clearfix">
										                <div class="pull-left"> Fecha: </div>
										                <div class="pull-right"><?=$fechaFolio;?></div>
										              </div>
																	<div class="clearfix">
										                <div class="pull-left"> Operador: </div>
										                <div class="pull-right"><?=$operador;?></div>
										              </div>
																	<div class="clearfix">
										                <div class="pull-left"> Vehículo: </div>
										                <div class="pull-right">Eco <?=$vehiculo;?></div>
										              </div>
										            </div>
										          </div><!--end .col -->
										        </div><!--end .row -->
										        <!-- END INVOICE DESCRIPTION -->


										<br/>

										<!-- BEGIN INVOICE PRODUCTS -->
										<div class="row">
											<div class="col-md-12">
												<table class="table table-bordered">
													<thead>
														<th class="text-center">Fecha</th>
					                  <th class="text-center">Viaje</th>
					                  <th class="text-center">Material Transportado</th>
					                  <th class="text-center">Peso Transportado</th>
					                  <th style="width:140px" class="text-right">Precio</th>
													</thead>
													<tbody>
														<tr>
														<?php
															$totalPago=0;
							                while ($Nom = mysqli_fetch_array($result)) {
																$pagoOpe = ($Nom['bonoAntiguedad'] == '1') ? ($Nom['pagoOpe'] + $Nom['pagoOpe2']) : $Nom['pagoOpe'] ;
							                  $dest1 = substr($Nom['d1'], 0, 4);
							                  $dest2 = substr($Nom['d2'], 0, 4);
							                  $dest3 = substr($Nom['d3'], 0, 4);
							                  if ($dest3 != '') {
							                    $ruta = $Nom['tipoViaje'].': '.$dest1.'/'.$dest2.'/'.$dest3;
							                  } else {
							                    $ruta = $Nom['tipoViaje'].': '.$dest1.'/'.$dest2;
							                  }
							                  echo '
																<tr>
																  <td class="text-center"> '.$Nom['fechaCarga'].' </td>
							                    <td class="text-center"> '.$ruta.'</td>
							                    <td class="text-center"> '.$Nom['nomMat'].' </td>
							                    <td class="text-center"> '.$Nom['pesoMat'].' </td>
							                    <td class="text-right"> $ '.number_format($pagoOpe, 2, '.', ',').'</td>
																</tr>
																';
							                  $totalPago += $pagoOpe;
							                }
															?>
													</tbody>
												</table>
												<div class="col-lg-7 text-right"></div>
												<div class="col-lg-2 text-right"><h3><strong class="text-lg text-accent">Total</strong></h3></div>
												<div class="col-lg-2 text-right"><h3><strong class="text-lg text-accent"><?=number_format($totalPago, 2, '.', ',');?></strong></h3></div>
											</div><!--end .col -->
										</div><!--end .row -->
										<div class="row">&nbsp;</div>
										<div class="row">&nbsp;</div>
										<div class="row">
											<div class="col-lg-offset-4 col-lg-4">
												<hr>
											</div>
											<div class="col-lg-4">
											</div>
											<div class="col-lg-offset-4 col-lg-4">
												<center>
													Nombre y Firma del Receptor
												</center>
											</div>
										</div>
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
		<script src="../assets/js/libs/moment/moment.min.js"></script>
		<script src="../assets/js/libs/flot/jquery.flot.min.js"></script>
		<script src="../assets/js/libs/flot/jquery.flot.time.min.js"></script>
		<script src="../assets/js/libs/flot/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/libs/flot/jquery.flot.orderBars.js"></script>
		<script src="../assets/js/libs/flot/jquery.flot.pie.js"></script>
		<script src="../assets/js/libs/flot/curvedLines.js"></script>
		<script src="../assets/js/libs/jquery-knob/jquery.knob.min.js"></script>
		<script src="../assets/js/libs/sparkline/jquery.sparkline.min.js"></script>
		<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
		<script src="../assets/js/libs/d3/d3.min.js"></script>
		<script src="../assets/js/libs/d3/d3.v3.js"></script>
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
