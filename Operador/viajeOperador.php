<?php
require_once 'seg.php';
require '../include/connect.php';
$info = new Seguridad();
$info->Acceso('viajeOperador.php');
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


		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


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
								<a href="home.php">
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

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
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
						<?php
						if($info->Seccion(1)){

						?>
						<!-- BEGIN ACTION -->
							<div class="col-md-4 col-sm-6">
								<div class="card">
									<div class="card-body no-padding">
										<div class="alert alert-callout alert-info no-margin">
										<div class="card-head">
												<header> Grafica Aseguradoras</header>
											</div><!--end .card-head -->
											<div id="graf1" style="heigth: 50%;"  class="height-5" data-colors="#0aa89e"></div>
												<?php

												$sql = "SELECT *	FROM aseguradoras ";
												$res = mysqli_query($link, $sql) or die('<span class="text-danger"> Notifique al Adminnistrador: </span>'.mysqli_error($link));

												$datosGraf1 = '';
												while ($datGraf1 = mysqli_fetch_array($res))
												{

												 $datosGraf1 .= "{ Fecha: '".$datGraf1['fechaReg']."', Nombre: '".$datGraf1['nombre']."'}, ";
												}
												$datosGraf1 = substr($datosGraf1, 0, -2);

												#echo $datosGraf;-->

												?>

										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END ALERT - REVENUE -->



							<!-- BEGIN ALERT - VISITS -->
							<div class="col-md-4 col-sm-6">
								<div class="card">
									<div class="card-body no-padding">
										<div class="alert alert-callout alert-warning no-margin">
											<div class="card-head">
												<header>Grafica Prefactura</header>
											</div><!--end .card-head -->
											<div id="graf2" style="heigth: 30%;"  class="height-5" data-colors="#0aa89e"></div>
												<?php

												$sql = "SELECT * FROM prefactura";

												$res = mysqli_query($link, $sql) or die('<span class="text-danger"> Notifique al Adminnistrador: </span>'.mysqli_error($link));

												$datosGraf2 = '';
												while ($datGraf2 = mysqli_fetch_array($res))
												{

												 $datosGraf2 .= "{ Cliente : '".$datGraf2['cliente']."', Monto: '".$datGraf2['monto']."'}, ";
												}
												$datosGraf2= substr($datosGraf2, 0, -2);

												#echo $datosGraf;-->



												?>

										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END ALERT - VISITS -->

							<!-- BEGIN ALERT - BOUNCE RATES -->
							<!-- BEGIN ALERT - BOUNCE RATES -->
								<div class="col-md-4 col-sm-6">
								<div class="card">
									<div class="card-body no-padding">
										<div class="alert alert-callout alert-danger no-margin">
											<div class="card-head">
												<header>Grafica Usuario</header>
											</div><!--end .card-head -->
											<div id="graf3" style="heigth: 30%;"  class="height-5" data-colors="#0aa89e"></div>
												<?php

												$sql = "SELECT usu.*, niv.nombre As nom
														FROM segusuarios usu
														LEFT JOIN segniveles niv ON usu.idNivel = niv.id";
												$res = mysqli_query($link, $sql) or die('<span class="text-danger"> Notifique al Administrador: </span>'.mysqli_error($link));

												$datosGraf3 = '';
												while ($datGraf3 = mysqli_fetch_array($res))
												{

												 $datosGraf3 .= "{ Nombre: '".$datGraf3['nombre']."', Tipo: '".$datGraf3['idNivel']."'}, ";
												}
												$datosGraf3 = substr($datosGraf3, 0, -2);

												#echo $datosGraf;-->

												?>

										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END ALERT - BOUNCE RATES -->

							<!-- BEGIN ALERT - TIME ON SITE -->


						</div><!--end .row -->
						<div class="row">

							<!-- BEGIN SITE ACTIVITY -->
							<div class="col-md-9">
								<div class="card ">
									<div class="row">
										<div class="col-md-8">
											<div class="card-head">
												<header>Grafica Mttos Recurrentes</header>
											</div><!--end .card-head -->
											<div class="card-body height-8">

												<div id="graf0" class="flot height-7" data-title="Activity entry" data-color="#7dd8d2,#0aa89e"></div>
											</div><!--end .card-body -->
										</div><!--end .col -->
										<div class="col-md-4">
											<div class="card-head">
												<header>Datos</header>
											</div>
											<div class="card-body height-8">
											<?php

													$sql = "SELECT mtsr.*, ctv.nombre AS n1, ctms.nombre AS n2
														FROM mttosrecurrentes mtsr
														LEFT JOIN cattipovehiculos ctv ON mtsr.idVehiculo = ctv.id
														LEFT JOIN cattipomttos ctms ON mtsr.idTipoMtto = ctms.id";
												$res = mysqli_query($link, $sql) or die('<span class="text-danger"> Estao ya valio: </span>'.mysqli_error($link));
												?>

							                        <table class="table">
							                          <thead>
							                            <tr>
							                              <th  class="">Servico</th>

							                              <th class="col-lg-3 text-left">Recurrencia</th>


							                            </tr>
							                          </thead>

							                          <?php
												$datosGraf = '';
												while ($datGraf = mysqli_fetch_array($res))

												{
													   switch ($datgraf['recurrente']){
							                              case 1:
							                              $estado='Recurrente';
							                              break;

							                              case 2:
							                              $estado='No Recurrente';
							                              break;
							                          }
													echo '
							                            <tr>

							                              <td> '.$datGraf['n1'].' </td>
							                              <td> '.$estado.'</td>


							                            </tr>
							                            ';

												 $datosGraf .= "{ Servicio: '".$datGraf['n1']."', Recurrente: '".$datGraf['recurrente']."'}, ";
												}
												$datosGraf = substr($datosGraf, 0, -2);


												echo$datGraf['n1'];

												?>
											</table>
											</div><!--end .card-body -->
										</div><!--end .col -->
									</div><!--end .row -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END SITE ACTIVITY -->

							<!-- BEGIN SERVER STATUS -->
							<div class="col-md-3">
								<div class="card">
									<div class="card-head">
										<header class="text-primary">Server status</header>
									</div><!--end .card-head -->
									<div class="card-body height-4">
										<div class="pull-right text-center">
											<em class="text-primary">Temperature</em>
											<br/>
											<div id="serverStatusKnob" class="knob knob-shadow knob-primary knob-body-track size-2">
												<input type="text" class="dial" data-min="0" data-max="100" data-thickness=".09" value="50" data-readOnly=true>
											</div>
										</div>
									</div><!--end .card-body -->
									<div class="card-body height-4 no-padding">
										<div class="stick-bottom-left-right">
											<div id="rickshawGraph" class="height-4" data-color1="#0aa89e" data-color2="rgba(79, 89, 89, 0.2)"></div>
										</div>
									</div><!--end .card-body -->
								</div><!--end .card -->
							</div><!--end .col -->
							<!-- END SERVER STATUS -->>

						</div><!--end .row -->

						<?php
						}
						?>
					</div><!--end .section-body -->

				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->


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
		<script src="../assets/js/libs/rickshaw/rickshaw.min.js"></script>
		<script src="../assets/js/core/source/App.js"></script>
		<script src="../assets/js/core/source/AppNavigation.js"></script>
		<script src="../assets/js/core/source/AppOffcanvas.js"></script>
		<script src="../assets/js/core/source/AppCard.js"></script>
		<script src="../assets/js/core/source/AppForm.js"></script>
		<script src="../assets/js/core/source/AppNavSearch.js"></script>
		<script src="../assets/js/core/source/AppVendor.js"></script>
		<script src="../assets/js/core/demo/Demo.js"></script>
			<script src="../assets/js/core/demo/DemoCharts.js"></script>






		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

		<script>

		Morris.Bar({
		 element :'graf0',
		 data:[
		 	<?=$datosGraf;?>
		 ],

		xkey:'Servicio',
		 ykeys:['Recurrente' ],
		 labels:['Recurrente' ],
		  hideHover:'auto',
		  resize: true

		});


		Morris.Line({
		 element :'graf1',
		 data:[
		 	<?=$datosGraf1;?>
		 ],

		xkey:'Fecha',

		 ykeys:['Fecha' ],

		 labels:['Nombre' ],

		 resize: true


		});


		Morris.Bar({
		 element : 'graf2',
		 data:[
		 	<?=$datosGraf2;?>
		 ],
		 xkey:'Cliente',
		 ykeys:['Monto' ],

		 labels:['Monto' ],

		resize: true
		});

		Morris.Bar({
		 element : 'graf3',
		 data:[
		 	<?=$datosGraf3;?>
		 ],

		 xkey:'Nombre',
		 ykeys:['Tipo'],
		 labels:['Tipo'],
		 resize: true


		});


		</script>
		<!-- END JAVASCRIPT -->



	</body>
</html>
