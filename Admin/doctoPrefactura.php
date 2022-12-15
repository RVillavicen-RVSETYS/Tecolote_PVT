<?php
//define('INCLUDE_CHECK',1);
//error_reporting(E_ALL);
//require('../include/connect.php');
//session_start();
$idPreFac = (isset($_POST['ident']) AND $_POST['ident'] != '') ? $_POST['ident'] : '' ;
#echo '&nbsp;&nbsp;&nbsp;&nbsp;POST: <br>';
#echo '&nbsp;&nbsp;&nbsp;&nbsp;'.print_r($_POST);
#echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;GET: <br>';
#echo '&nbsp;&nbsp;&nbsp;&nbsp;'.print_r($_GET);
#echo '<br>';
    $sql="SELECT vts.id AS idVenta, pre.fecha AS fecha, pre.id AS idpre,  cls.nombre AS Cliente, cls.rfc AS rfcCliente, DATE_FORMAT(vts.fechaEntrega, '%d %M %Y') AS fechaEntrega, rts.*, cmts.nombre AS materiales, CONCAT(usu.nombre,' ',usu.apellidos) AS registro,
     pre.nota, pre.descripcion
      FROM ventas vts
      LEFT JOIN clientes cls ON vts.idCliente = cls.id
      LEFT JOIN catmateriales cmts ON vts.idCatMaterial = cmts.id
      LEFT JOIN rutas rts ON vts.idRuta = rts.id
      LEFT JOIN prefactura pre ON vts.idPrefactura = pre.id
      LEFT JOIN segusuarios usu ON usu.id = pre.idUserReg
      WHERE  pre.id = '$idPreFac'";
      #  echo $sql;
    $result=mysqli_query($link,$sql) or die(errorBD('Problemas al Consultar los Datos del Ticket.'.mysqli_error($link)));
    $dat = mysqli_fetch_array($result);
    $cliente = $dat['Cliente'];
    $rfcCliente = $dat['rfcCliente'];
    $factura = $_SESSION['ATZnombreUser'];
  #  echo 'factura: '.$idPreFac;
    $folio = $dat['id'];
    $fechaFolio = $dat['fecha'];
    $notaFactura = $dat['nota'];
    $describeFactura = $dat['descripcion'];

    ?>
    <!DOCTYPE html>
    <html lang="es">
    	<head>
    		<title>PreFactura</title>

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
    										        <div class="tools">
                                  <div class="btn-group">
    																<a class="btn btn-floating-action btn-primary noImpre" href="../Admin/preFacturaCliente.php"><i class="fa fa-reply noImpre"></i></a>
    										          </div>
    										          <div class="btn-group">
    										            <a class="btn btn-floating-action btn-primary" href="javascript:void(0);" onclick="javascript:window.print();"><i class="md md-print"></i></a>
    										          </div>
    										        </div>
    										      </div><!--end .card-head -->
    										      <div class="card-body style-default-bright">

    										        <!-- BEGIN INVOICE HEADER -->
    										        <div class="row">
    										      <!--
                              <div class="col-xs-8 text-right">
    										          <h1 class="text-light"><i class=" text-accent-dark"> </i><img src="../favicon.ico" width="150" height="150"></h1>
    										          </div>
                              -->
    										          <div class="col-xs-offset-8 col-xs-4 text-right">
    										            <h1 class="text-light text-default-light">Pre-Factura</h1>
                                    <h1 class="text-light"><i class=" text-accent-dark"> </i><img src="../favicon.ico" width="150" height="150"></h1>
                                    <address>
    										              <strong>AUTOTRANSPORTES ESPECIALIZADOS LA ZAFRA<br>AAOE6103114S1</strong>
    										            </address>
    										          </div>
    										        </div><!--end .row -->
    										        <!-- END INVOICE HEADER -->

    										        <br/>

    										        <!-- BEGIN INVOICE DESCRIPTION -->
    										        <div class="row">
    										          <div class="col-xs-4">
    										            <address>
    										              <strong><?=$cliente;?></strong><br>
    										              <?=$rfcCliente;?><br>
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
    										            </div>
    										          </div><!--end .col -->
    										        </div><!--end .row -->
    										        <!-- END INVOICE DESCRIPTION -->

    										<br/>

    										<!-- BEGIN INVOICE PRODUCTS -->
                        <?php
                         $sql = "SELECT vts.id AS idVenta, cls.nombre AS Cliente, rts.*,peso, estatusPago, cmts.nombre AS material, vts.monto
                                  FROM prefactura pft
                                  INNER JOIN ventas vts ON pft.id = vts.idPrefactura
                                  INNER JOIN clientes cls ON vts.idCliente = cls.id
                                  LEFT JOIN catmateriales cmts ON vts.idCatMaterial = cmts.id
                                  LEFT JOIN rutas rts ON vts.idRuta = rts.id
                                  WHERE pft.id = '$idPreFac'
                            ";


                          $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>'.mysqli_error($link));
                          ?>
    										<div class="row">
    											<div class="col-md-12">
    												<table class="table table-bordered">
    													<thead>
                                <th style="width:70px" class="text-center">#</th>

                                <th class="col-lg-3 text-left">Detalle de Viajes</th>
                                <th class="col-lg-2 text-left">Material</th>
                                <th class="">Peso</th>
                                <th class="text-left">Estatus</th>
                                <th style="width:140px" class="text-right">Monto</th>
    													</thead>
                              <tbody>
                             <?php
                             $mtoTot = 0;
                              while ($dat = mysqli_fetch_array($res)) {
                                $dest1 = substr($dat['destino1'], 0, 6);
                                $dest2 = substr($dat['destino2'], 0, 6);
                                $dest3 = substr($dat['destino3'], 0, 6);

                                $ruta = $dat['tipoViaje'].': '.$dest1.'/'.$dest2.'/'.$dest3;

                                switch ($dat['estatusPago']){
                                  case 1:
                                  $estado='Pendiente';
                                  break;

                                  case 2:
                                  $estado='Pagado';
                                  break;

                                  case 3:
                                  $estado='En Curso';
                                  break;


                                 case 4:
                                 $estado='Cancelado';
                                 break; //fin del caso 4 'cancelado'
                                 default:
                                 $estado='Pendiente';
                                 break; //fin del caso 4
                                  }


                                echo '
                                <tr>
                                  <td class="text-center"> '.$dat['idVenta'].' </td>

                                  <td> '.$ruta.'</td>
                                  <td> '.$dat['material'].' </td>
                                  <td> '.$dat['peso'].' </td>
                                  <td> '.$estado.'</td>
                                  <td class="text-right"> $ '.number_format($dat['monto'], 2, '.', ',').'</td>

                                </tr>
                                ';

                                $mtoTot += $dat['monto'];
                                $iva = $mtoTot * 0.16;

                              }

                              ?>

                                <tr>
                                  <td colspan="4" rowspan="4">
                                    <h3 class="text-light opacity-50">Notas:</h3>
                                    <a><strong><?=$describeFactura;?><br><?=$notaFactura;?></strong> </a>
                                  </td>
                                  <?php
                                  $sql="SELECT * FROM viajes";
                                  $result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

                                  $dat=mysqli_fetch_array($result);

                                  ?>


                                  <td class="text-right"><strong>Subtotal</strong></td>
                                  <td class="text-right"><a><strong>$ <?=number_format($mtoTot, 2, '.', ',');?></strong> </a></td>
                                </tr>

                                  <tr>
                                  <td class="text-right"><strong>IVA</strong></td>
                                  <td class="text-right"><a><strong>$ <?=number_format($mtoTot * 0.16, 2, '.', ',');?></strong> </a></td>
                                </tr>

                                  <tr>
                                  <td class="text-right"><strong class="text-lg text-accent">Total</strong></td>
                                  <td class="text-right"><a><strong>$ <?=number_format($mtoTot * 1.16, 2, '.', ',');?></strong> </a></td>
                                </tr>
                              </tbody>
                            </table>
    											</div><!--end .col -->
    										</div><!--end .row -->
    										<!-- END INVOICE PRODUCTS -->
                        <div class="row">&nbsp;</div>
                        <div class="row">&nbsp;</div>
                        <div class="row">&nbsp;</div>
                        <div class="row">
                          <div class="col-xs-offset-2 col-xs-3">
                                  <hr>
                          </div>
                          <div class="col-xs-2"></div>
                          <div class="col-xs-3">
                            <hr>
                          </div>
                          <div class="col-xs-2"></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-offset-2 col-xs-3">
                            <center>Cliente: <?=$cliente;?></center>
                          </div>
                          <div class="col-xs-2"></div>
                          <div class="col-xs-3">
                            <center>Pre-Factura: <?=$factura;?></center>
                          </div>
                          <div class="col-xs-2"></div>
                        </div>

            						</div><!--end .card-body -->
            					</div><!--end .card -->
            				</div><!--end .col -->
            			</div><!--end .row -->


            		</div><!--end .section-body -->

            	</section>
            </div><!--end #content-->
            <!-- END CONTENT -->

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
