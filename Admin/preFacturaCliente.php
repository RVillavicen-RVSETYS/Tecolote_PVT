<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('preFacturaCliente.php');
require '../include/connect.php';
require_once('../funciones/notificaAdmin.php');
#session_start();
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
        notificaAdmin($link);
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
<!------------------------------------------------------------------->
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
                  $fecha1 = (isset($_POST['fStart']) AND $_POST['fStart'] != '') ? $_POST['fStart'] : '' ;
                  $fecha2 = (isset($_POST['fEnd']) AND $_POST['fEnd'] != '') ? $_POST['fEnd'] : '' ;
                  $cliente = (isset($_POST['cliente']) AND $_POST['cliente'] != '') ? $_POST['cliente'] : '' ;
                  ?>
                <div class="rows">
                  <form class="form" method="post" action="preFacturaCliente.php">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <div class="input-daterange input-group" id="rangoFechas">
                          <div class="input-group-content">
                            <input type="text" class="form-control" name="fStart" value="<?=$fecha1;?>" autocomplete="off"/>
                            <label>Rango de Fechas</label>
                          </div>
                          <span class="input-group-addon">hasta</span>
                          <div class="input-group-content">
                            <input type="text" class="form-control" name="fEnd" value="<?=$fecha2;?>" autocomplete="off"/>
                            <div class="form-control-line"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-offset-1 col-md-4">
                      <?php
                      require '../include/connect.php';
                      $sql = "SELECT * FROM clientes WHERE estatus = '1'";
                      $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
                      ?>
                        <div class="form-group">
                          <select name="cliente" class="form-control select2-list" data-placeholder="Select an item">
                            <optgroup label="Clientes ">
                              <?php
                              echo '<option value=""></option>';
                              while ($dat = mysqli_fetch_array($res)) {
                                $active = ($cliente == $dat['id']) ? 'selected' : '' ;
                                echo '<option value="'.$dat['id'].'" '.$active.'> '.$dat['nombre'].' '.$dat['apellidos'].' </option>';
                              }
                              ?>
                            </optgroup>
                          </select>
                          <label>Seleccione Cliente</label>
                        </div>
                      </div>

                      <div class="col-lg-1">
                        <button type="submit" style="margin-top:5px;" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class='fa fa-spinner fa-spin'></i> --</center>">Aplicar</button>
                      </div>
                    </form>
                  </div>
                </div><!--end .card-body -->
              </div><!--end .card -->
            </div><!--end .col -->
          </div><!--end .row -->
          <div class="col-md-12">
            <div class="card card-underline">
              <div class="card-head">
                <ul class="nav nav-tabs pull-left" data-toggle="tabs">
                  <li class="active"><a href="#factura">Creación de Facturas</a></li>
                  <li><a href="#conFacturas">Consulta de Facturas</a></li>
                </ul>
                <header></header>
              </div>
              <div class="card-body tab-content">
                <!-- /////////////////////////////////////////////////////////////////////////////////////// -->
                <div class="tab-pane active" id="factura">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-bordered style-primary">
                        <div class="card-head">
                          <div class="tools">
                            <div class="btn-group">
                              <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                            </div>

                          </div>
                          <header><i class="fa fa-fw fa-tag"></i> Historial de Ventas realizadas</header>
                        </div><!--end .card-head -->
                        <div class="card-body style-default-bright table-responsive">
                          <form method="post" action="../funciones/registraNuevaPrefactura.php">
                          <?php
                          $filtrofecha='';
                          $filtroCliente='';

                          if ($fecha1 != '' AND $fecha2 !='') {
                            $filtrofecha = " AND vts.fechaEntrega BETWEEN '$fecha1' AND '$fecha2'";
                          }
                          if ($cliente !=''){
                            $filtroCliente = "AND cls.id = '$cliente'";
                          }


                          $sql = "SELECT vts.id AS idVent, vts.monto, vts.peso, cls.nombre AS Cliente, DATE_FORMAT(vts.fechaEntrega, '%d %M %Y') AS fechaEntrega, rts.*
                                  FROM ventas vts
                                  LEFT JOIN clientes cls ON vts.idCliente = cls.id
                                  LEFT JOIN rutas rts ON vts.idRuta = rts.id
                                  WHERE vts.estatusViaje = '3' AND (vts.idPrefactura IS NULL OR vts.idPrefactura='') $filtroCliente $filtrofecha
                                  ";
                          $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')

                          ?>
                          <table class="table table-striped no-margin">
                            <thead>
                              <tr class="text-xlc">
                                <th class="col-lg-1 text-center"><b>#</b></th>
                                <th class="col-lg-2 text-center"><b>Fecha</b></th>
                                <th class="col-lg-3"><b>Cliente</b></th>
                                <th class="col-lg-3"><b>Detalle de Viaje </b></th>
                                <th class="col-lg-1 text-center"><b>Peso</b></th>
                                <th class="col-lg-1 text-center"><b>Monto</b></th>
                                <th class="col-lg-1 text-center"><b>Opciones</b></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if ($filtroCliente != '') {
                                // code...
                              $contador=0;
                              while ($dat = mysqli_fetch_array($res)) {
                                $dest1 = substr($dat['destino1'], 0, 4);
                                $dest2 = substr($dat['destino2'], 0, 4);
                                $dest3 = substr($dat['destino3'], 0, 4);

                                $ruta = $dat['tipoViaje'].': '.$dest1.'/'.$dest2.'/'.$dest3;
                                $peso = ($dat['peso'] == '0') ? 'S/R' : $dat['peso'] ;


                                echo '
                                <tr>
                                  <td class="text-center"> '.$dat['idVent'].' </td>
                                  <td class="text-center"> '.$dat['fechaEntrega'].' </td>
                                  <td> '.$dat['Cliente'].'</td>
                                  <td> '.$ruta.'</td>
                                  <td class="text-center"> '.$peso.'</td>
                                  <td class="text-center"> $ '.number_format($dat['monto'], 2, '.', ',').'</td>
                                  <td class="col-lg-1 text-center">
          													<div class="checkbox checkbox-styled checkbox-success">
          														<label>
          															<input type="checkbox" name="venta['.$contador.']" id="venta['.$contador.']" value="'.$dat['idVent'].'">
          														</label>
          													</div>
                                  </td>
                                </tr>
                                ';
                                $contador++;
                                    }
                                    $contador2=$contador-1;

                                  } else {
                                      echo '<tr>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                            </tr>';

                                  }

                              ?>
                            </tbody>
                          </table>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="col-lg-6 form">
                                <div class="form-group form">
                                  <textarea name="nota" id="nota" class="form-control" rows="2" placeholder="" required></textarea>
                                  <label for="nota">Nota:</label>
                                </div>
                              </div>
                               <div class="text-right"><br>

                                 <input type="hidden" name="cont" id="cont" value="<?=$contador2;?>">
                                 <div class="btn-group text-center" data-toggle="tooltip" data-placement="top" data-original-title="generar">
                                  <button type="submit"  class=" text-raigth btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class='fa fa-spinner fa-spin'></i> --</center>">Generar Prefactura</button>
                                 </div>
                               </div>
                             </div>
                           </div>
                         </form>
                        </div><!--end .card-body -->
                      </div><!--end .card-body -->
                    </div><!--end .card -->
                  </div><!--end .col -->
                </div><!--end .section-body -->
    <!-- /////////////////////////////////////////////////////////////////////////////////////// -->
    <div class="tab-pane" id="conFacturas">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-bordered style-primary">
              <div class="card-head">
                <div class="tools">
                  <div class="btn-group">
                    <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                  </div>

                </div>
                <header><i class="fa fa-fw fa-tag"></i> Historial de Prefacturas realizadas</header>
              </div><!--end .card-head -->
              <div class="card-body style-default-bright table-responsive">
                <?php
                $filtrofecha2 = '';

                if ($fecha1 != '' AND $fecha2 !='') {
                  $filtrofecha2 = " AND pref.fecha BETWEEN '2019-09-1' AND '2019-09-30'";
                }


                $sql = "SELECT *
                        FROM prefactura pref
                        WHERE pref.estatus != '3' $filtrofecha2
                        ORDER BY pref.id DESC";
                  $res = mysqli_query($link,$sql) or die('<span class=" text-danger">Notifica al Administrador </span>');
                ?>
                <table id="consultaNomina" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="text-center col-xs-1">#</th>
                      <th class="text-center">Descripción</th>
                      <th class="text-center">Motivo de la Factura</th>
                      <th class="text-center">Fecha de la Factura</th>
                      <th class="text-center">Estatus</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                        while ($con = mysqli_fetch_array($res)) {
                          switch ($con['estatus']) {
                            case '1':		$e = 'Pendiente';	$color='default-light';							break;
                            case '2':		$e = 'Pagado'; 	$color='success';											break;
                            case '3':		$e = 'Cancelado'; 	$color='danger';									break;
                            default:		$e = 'Pendiente';	$color='default-light';							break;
                          }
                          echo '
                    <tr>
                      <td class="text-center col-xs-1" id="idNomina'.$con['id'].'"> '.$con['id'].' </td>
                      <td class="text-center"> '.$con['descripcion'].'</td>
                      <td class="text-center"> '.$con['nota'].' </td>
                      <td class="text-center"> '.$con['fecha'].' </td>
                      <td class="text-center"> '.$e.' </td>
                      <td class="text-center">
                        <form method="POST" action="../funciones/reimprimePreFactura.php">
                          <input type="hidden" value="'.$con['id'].'" name="ident">
                          <button type="submit" class="btn btn-icon-toggle" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Reimprimir Factura."><i class="fa fa-file-pdf-o"></i></button>
                        </form>
                      </td>
                    </tr>
                    ';
                        }
                        ?>
                  </tbody>
                </table>

              </div><!--end .card-bofy -->
            </div><!--end .card -->
          </div><!--end .col -->
        </div><!--end .section-body -->
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////////////// -->
              </div>
            </div><!--end .card -->
          </div><!--end .col -->
<!------------------------------------------------------------------->
        </div>
      </section>
    </div><!--end #content-->
    <!-- END CONTENT -->

    <!-- BEGIN FORM MODAL MARKUP -->


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
  <script src="../assets/js/core/source/App.js"></script>
  <script src="../assets/js/core/source/AppNavigation.js"></script>
  <script src="../assets/js/core/source/AppOffcanvas.js"></script>
  <script src="../assets/js/core/source/AppCard.js"></script>
  <script src="../assets/js/core/source/AppForm.js"></script>
  <script src="../assets/js/core/source/AppNavSearch.js"></script>
  <script src="../assets/js/core/source/AppVendor.js"></script>
  <script src="../assets/js/core/demo/Demo.js"></script>
  <script src="../assets/js/core/demo/DemoTableDynamic.js"></script>
  <script src="../assets/js/libs/toastr/toastr.js"></script>
  <script>
    $(document).ready(function(){
    $('.txtPopOver').popover('show');

    $('#rangoFechas').datepicker({
      todayHighlight: true,
      format: "yyyy-mm-dd",
      language: "es"
    });

        });
        <?php
        if (isset( $_SESSION['ATZmsjAdminPreFacturaCliente'])) {
          echo "notificaBad('".$_SESSION['ATZmsjAdminPreFacturaCliente']."');";
          unset($_SESSION['ATZmsjAdminPreFacturaCliente']);
        }
        if (isset( $_SESSION['ATZmsjSuccesAdminPreFacturaCliente'])) {
          echo "notificaSuc('".$_SESSION['ATZmsjSuccesAdminPreFacturaCliente']."');";
          unset($_SESSION['ATZmsjSuccesAdminPreFacturaCliente']);
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
