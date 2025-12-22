<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('rendimientoXlitro.php');
require '../include/connect.php';
require_once('../funciones/notificaAdmin.php');

Error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title><?= $info->nombrePag; ?></title>

  <!-- BEGIN META -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <!-- END META -->

  <!-- BEGIN STYLESHEETS -->
  <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css' />
  <link type="text/css" rel="stylesheet" href="../assets/css/theme-2/bootstrap.css?1422792965" />
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
  <link type="text/css" rel="stylesheet" href="../assets/css/theme-2/libs/morris/morris.core.css" />

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
  <header id="header">
    <div class="headerbar">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="headerbar-left">
        <ul class="header-nav header-nav-options">
          <li class="header-nav-brand">
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
                <?= $info->nombreUser; ?>
                <small><?= $info->nombreNivel; ?></small>
              </span>
            </a>
            <ul class="dropdown-menu animation-dock">
              <!--<li><a href="html/pages/calendar.html"><i class="fa fa-fw fa-globe"></i> Calendario</a></li>
              <li class="divider"></li>-->
              <?= $info->generaMenuUsuario(); ?>
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
              <h1 class="text-primary"><?= $info->nombrePag; ?></h1>
            </div><!--end .col -->
            <div class="col-lg-5">
              <article class="margin-bottom-xxl">
                <p class="lead"><?= $info->detailPag; ?></p>
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
                  $fechaAct = date('Y-m-d');
                  $fecha1 = (isset($_POST['fStart']) and $_POST['fStart'] != '') ? $_POST['fStart'] : date('Y-m-d', strtotime('-1 week', strtotime($fechaAct)));
                  $fecha2 = (isset($_POST['fEnd']) and $_POST['fEnd'] != '') ? $_POST['fEnd'] : $fechaAct;
                  $operador = (isset($_POST['operador']) and $_POST['operador'] != '') ? $_POST['operador'] : '';
                  $rendEsperado = 1.5;


                  ?>
                  <div class="rows">
                    <form class="form" method="post" action="rendimientoXlitro.php">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <div class="input-daterange input-group" id="demo-date-format">
                            <div class="input-group-content">
                              <input type="text" class="form-control fechado" name="fStart" autocomplete="off" value="<?= $fecha1; ?>" />
                              <label>Rango de Fechas</label>
                            </div>
                            <span class="input-group-addon">hasta</span>
                            <div class="input-group-content">
                              <input type="text" class="form-control fechado" name="fEnd" autocomplete="off" value="<?= $fecha2; ?>" />
                              <div class="form-control-line"></div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-lg-offset-1 col-md-4">
                        <?php
                        require('../include/connect.php');
                        $sql = "SELECT op.id, CONCAT(op.nombre,' ',op.apellidos, ' (Eco ',ve.noEconomico, ' Placas: ',ve.placas) AS nombre
                            FROM operadores op
                            INNER JOIN asignavehiculos asgv ON asgv.idOperador = op.id
                            INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
                            INNER JOIN cattipovehiculos ctpve ON ctpve.id = ve.idCatTipoVehiculo
                            WHERE op.estatus = '1' AND ctpve.id = '1,6'";
                        $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
                        ?>
                        <div class="form-group">
                          <select name="operador" class="form-control" data-placeholder="Select an item">
                            <option value=''>Selecciona un Operador Para Comenzar</option>
                            <optgroup label="Operadores">
                              <?php
                              while ($dat = mysqli_fetch_array($res)) {
                                $active = ($operador == $dat['id']) ? 'selected' : '';
                                echo '<option value="' . $dat['id'] . '" ' . $active . '> ' . $dat['nombre'] . ' ' . $dat['apellidos'] . ' </option>';
                              }
                              ?>
                            </optgroup>
                          </select>
                          <label>Selecciona un Operador Para Comenzar</label>
                        </div>
                      </div>
                      <div class="col-lg-2">
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
          <!-- END FILTROS -->
          <div class="row">
            <!-- BEGIN ALERT - TIME ON SITE -->
            <div class="col-md-offset-2 col-md-4 col-sm-4">
              <div class="card">
                <div class="card-body no-padding">
                  <?php
                  require('../include/connect.php');
                  #error_reporting(E_ALL);
                  $filtroOperador = ($operador != '') ? " AND op.id = '$operador'" : '';

                  if ($fecha1 != '' and $fecha2 != '') {
                    $filtrofecha = " AND carco.fechaReg BETWEEN '$fecha1' AND '$fecha2'";
                  } else {
                    $filtrofecha = "AND MONTH(carco.fechaReg) BETWEEN DATE_FORMAT(CURDATE(),'%Y-%m-01') AND CURDATE()";
                  }

                  $csql = " SELECT COUNT(carco.idCatCombustible) AS cnt, SUM(carco.cant) AS suma, MONTH(NOW()) AS noMes
                            FROM cargacombustible carco
                            INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
                            INNER JOIN viajes vjs ON vjs.id = carco.idViaje
                            INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
                            INNER JOIN operadores op ON op.id = asgv.idOperador
                            INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
                            WHERE catco.id = 3  $filtroOperador $filtrofecha
                            GROUP BY carco.idCatCombustible";
                  $res = mysqli_query($link, $csql) or die('<p class="text-danger">Notifica a tu Administrador</p>' . mysqli_error($link));
                  $cargaGas = mysqli_fetch_array($res);
                  $mes = 'No hay Información en este Mes';
                  $diesel = 0;
                  if (is_array($cargaGas)) {
                    switch ($cargaGas['noMes']) {
                      case '1':
                        $mes = 'Diésel Entregado en <strong>Enero</strong>';
                        break;
                      case '2':
                        $mes = 'Diésel Entregado en <strong>Febrero</strong>';
                        break;
                      case '3':
                        $mes = 'Diésel Entregado en <strong>Marzo</strong>';
                        break;
                      case '4':
                        $mes = 'Diésel Entregado en <strong>Abril</strong>';
                        break;
                      case '5':
                        $mes = 'Diésel Entregado en <strong>Mayo</strong>';
                        break;
                      case '6':
                        $mes = 'Diésel Entregado en <strong>Junio</strong>';
                        break;
                      case '7':
                        $mes = 'Diésel Entregado en <strong>Julio</strong>';
                        break;
                      case '8':
                        $mes = 'Diésel Entregado en <strong>Agosto</strong>';
                        break;
                      case '9':
                        $mes = 'Diésel Entregado en <strong>Septiembre</strong>';
                        break;
                      case '10':
                        $mes = 'Diésel Entregado en <strong>Octubre</strong>';
                        break;
                      case '11':
                        $mes = 'Diésel Entregado en <strong>Noviembre</strong>';
                        break;
                      case '12':
                        $mes = 'Diésel Entregado en <strong>Diciembre</strong>';
                        break;

                      default:
                        $mes = 'No hay Información en este Mes';
                        break;
                    }
                    if ($cargaGas['suma'] > 0) {
                      $diesel = $cargaGas['suma'];
                    } else {
                      $diesel = 0;
                    }
                  }
                  ##################################################################
                  ?>
                  <div class="alert alert-callout alert-warning no-margin">
                    <h1 class="pull-right text-dark"><i class="fa fa-tint"></i></h1>
                    <button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#modalDiesel">
                      <strong class="text-xl">
                        &nbsp; <?= number_format($diesel, 2, '.', ','); ?> Lts. de Diésel<br /></strong></button>
                    <span class="opacity-50"><?= $mes; ?></span>
                  </div>
                </div><!--end .card-body -->
              </div><!--end .card -->
            </div><!--end .col -->
            <!-- END ALERT - TIME ON SITE -->
            <!-- BEGIN ALERT - TIME ON SITE -->
            <div class="col-md-3 col-sm-4">
              <div class="card">
                <div class="card-body no-padding">
                  <div class="alert alert-callout alert-warning no-margin">
                    <h1 class="pull-right text-dark"><i class="fa fa-tint"></i></h1>
                    <button type="button" class="btn ink-reaction btn-flat btn-default-dark" data-toggle="modal" data-target="#modalGasolinera">
                      <strong class="text-xl" id="sGasolinera"> <?= number_format($diesel, 2, '.', ','); ?> Lts.</strong><br />
                      <span class="opacity-50">Gasolineras</span>
                  </div>
                </div><!--end .card-body -->
              </div><!--end .card -->
            </div><!--end .col -->
            <!-- END ALERT - TIME ON SITE -->
          </div>

          <!-- Se requiere que seleccione un operador para obtener el rendimientoXlitro -->

          <div class="row">
            <div class="col-md-12">
              <div class="card ">
                <div class="card-head">
                  <header>Gráfica de Rendimiento</header>
                </div><!--end .card-head -->

                <div id="grafica" class="flot height-7" data-title="Activity entry" data-color="#7dd8d2,#0aa89e"></div>


              </div><!--end .card -->
            </div><!--end .col -->
          </div><!--end row -->

          <!--Comienza otra Card -->

          <div class="row">
            <div class="col-md-12">
              <div class="card card-bordered style-primary">
                <div class="card-head">
                  <div class="tools">
                    <div class="btn-group">
                      <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                    </div>

                  </div>
                  <header><i class="fa fa-fw fa-tag"></i> Historial de Carga de Combustible</header>
                </div><!--end .card-head -->
                <div class="card-body style-default-bright table-responsive">
                  <?php
                  require('../include/connect.php');

                  $sql = "SELECT carco.id,CONCAT(op.nombre,' ',op.apellidos) AS nomOpe, CONCAT('Eco ',ve.noEconomico,' Placas: ',ve.placas, ', ',ctpve.nombre,', ',cmrc.nombre,' ',csmrc.nombre) AS nomVehiculo,
                              ve.capacidadLts AS lts, (ve.capacidadLts - 200) AS ltsReal, date(carco.fechaReg) AS fechaCarga, carco.cant AS cantCargada, carco.kilometraje AS odometro, carco.full
                              FROM cargacombustible carco
                              INNER JOIN viajes vjs ON vjs.id = carco.idViaje
                              INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
                              INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
                              INNER JOIN operadores op ON op.id = asgv.idOperador
                              INNER JOIN catmarcas cmrc ON cmrc.id = ve.idCatMarca
                              INNER JOIN catsubmarcas csmrc ON csmrc.id = ve.idCatSubmarca
                              INNER JOIN cattipovehiculos ctpve ON ctpve.id = ve.idCatTipoVehiculo
                              WHERE 1=1 AND (ctpve.id = '1' || ctpve.id = '6') $filtrofecha $filtroOperador";
                  #echo $sql;
                  $res = mysqli_query($link, $sql) or die('<span class=" text-danger">Notifica al Administrador </span>');
                  $datosGrafica2 = '';
                  ?>

                  <table id="datatable1" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th class="text-center col-xs-1">#</th>
                        <th>Operador (B)</th>
                        <th>Vehículo (C,D)</th>
                        <th class="text-center">Cap. de Tanque</th>
                        <th class="text-center">Reserva</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Última Carga</th>
                        <th class="text-center">Odómetro</th>
                        <th class="text-center">Km.Recorridos</th>
                        <th class="text-center">Lts. Cargados</th>
                        <th class="text-center">Lts. en Tanque (Aprox.)</th>
                        <th class="text-center">Rendimiento Aproximado</th>
                        <th class="text-center">Lts. en Tanque Real</th>
                        <th class="text-center">Lts Aprox. Necesarios por Viaje</th>
                        <th class="text-center">Rendimiento </th>
                        <th class="text-center">Rendimiento a Tanque Lleno</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      if ($operador != '') {
                        $cont = 1;
                        $reserva = 200;
                        $cont2 = 1;
                        $kmRecorrido[0] = 0;
                        $odoIN[0] = 0;
                        $odoOut[0] = 0;
                        $rendAprox = 0;
                        $acumulador = 0;
                        $acumulador2 = 0;
                        $rendReal[0] = 0;
                        $ltsEnTanque = 0;
                        $ltsEnTanqueReal[0] = 200;
                        $ltsUsados[0] = 0;
                        while ($rend = mysqli_fetch_array($res)) {
                          $conta = $cont - 1;
                          $muestraRendi = '';
                          $color = '';
                          $odoIN[$cont] = $odoOut[$conta];
                          $odoOut[$cont] = $rend['odometro'];
                          $odometroIN = ($odoIN[$cont] == '') ? $rend['odometro'] : $odoIN[$cont];
                          $kmRecorrido = $rend['odometro'] - $odometroIN;
                          $rendAprox = $kmRecorrido * $rendEsperado;
                          $ltsEnTanque = $ltsEnTanqueReal[$conta] - ($rendEsperado * $kmRecorrido);
                          $ltsEnTanqueReal[$cont] = $rend['cantCargada'] + $ltsEnTanque;
                          $rendReal[$cont] = ($rend['cantCargada'] > 0) ? $kmRecorrido / $rend['cantCargada'] : 0;
                          $ltsUsados[$cont] = $rendEsperado * $kmRecorrido;
                          $acumulador += $rendReal[$cont];
                          $acumulador2 += $rendReal[$cont];
                          $rendXfila = ($rend['cantCargada'] > 0) ? $kmRecorrido / $rend['cantCargada'] : 0;

                          if ($rend['full'] == 1) {
                            $color = 'danger';
                            $color2 = 'success';
                            $muestraRendi = ($acumulador / $cont2);
                            $cont2 = ($kmRecorrido == 0) ? 1 : 0;
                            $acumulador = 0;
                          }
                          $muestraRendi = ($muestraRendi == 0) ? '' : bcdiv($muestraRendi, '1', 4);
                          echo
                          '<tr class="' . $color2 . ' text-' . $color2 . '">
                            <th class="text-center col-xs-1">' . $cont . '</th>
                            <th>' . $rend['nomOpe'] . '1</th>
                            <th>' . $rend['nomVehiculo'] . '</th>
                            <th class="text-center">' . ($rend['lts'] - $reserva) . '</th>
                            <th class="text-center">' . $reserva . '</th>
                            <th class="text-center">' . $rend['lts'] . '</th>
                            <th class="text-center">' . $rend['fechaCarga'] . '</th>
                            <th class="text-center">' . $rend['odometro'] . '</th>
                            <th class="text-center">' . $kmRecorrido . '</th>
                            <th class="text-center">' . $rend['cantCargada'] . '</th>
                            <th class="text-center">' . $ltsEnTanque . '</th>
                            <th class="text-center">' . $rendEsperado . '</th>
                            <th class="text-center">' . $ltsEnTanqueReal[$cont] . '</th>
                            <th class="text-center">' . $ltsUsados[$cont] . '</th>
                            <th class="text-center">' . bcdiv($rendXfila, '1', 4) . '</th>
                            <th  class="text-' . $color . ' text-center"><h4><strong>' . $muestraRendi . '</strong></h4></th>
                          </tr>';

                          $datosGrafica2 .= "{ Operador: '" . $rend['nomOpe'] . "', Rendimiento: '" . $rendXfila . "' }, ";
                          $cont++;
                          $cont2++;
                        }
                        $rendimiento = ($cont > 0) ? $acumulador2 / $cont : 0;
                        if ($datosGrafica2 != '') {
                          $datosGrafica2 = substr($datosGrafica2, 0, -2);
                        }
                      }
                      ?>
                    </tbody>
                  </table>

                </div><!--end .card-body -->
              </div><!--end .card -->
            </div><!--end .col -->
          </div><!--end .section-body -->


          <!-- END CONTENT -->

          <!-- BEGIN SIMPLE MODAL MARKUP -->
          <div class="modal fade" id="modalDiesel" tabindex="-1" role="dialog" aria-labelledby="modalDieselLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="modalDieselLabel">Desgloce del Mes de Diésel</h4>
                </div>

                <div class="modal-body">
                  <?php
                  require('../include/connect.php');
                  //error_reporting(E_ALL); //muestra todos los errores encontrados en la página
                  //print_r($_SESSION);			//muestra las sesiones
                  $dsql = "SELECT CONCAT('ECO - ',ve.noEconomico,' PLACAS: ',ve.placas,' (',op.nombre,' ',op.apellidos,')') AS nVe, SUM(carco.cant) AS lts
                              FROM cargacombustible carco
                              INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
                              INNER JOIN viajes vjs ON vjs.id = carco.idViaje
                              INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
                              INNER JOIN operadores op ON op.id = asgv.idOperador
                              INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
                              WHERE catco.id = 3  $filtroOperador $filtrofecha
                              GROUP BY op.id
                              ORDER BY carco.idGasolinera ASC";
                  $dres = mysqli_query($link, $dsql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
                  ?>
                  <div class="table-responsive">
                    <table id="datatable1" class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Vehículo</th>
                          <th>
                            <center>Litros Entregados</center>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $miCont = 1;
                        while ($ddat = mysqli_fetch_array($dres)) {
                          echo '
                    <tr>
                      <td>' . $miCont . '</td>
                      <td>' . $ddat['nVe'] . '</td>
                      <td class="text-center"><center>' . number_format($ddat['lts'], 2, '.', ',') . ' Lts.</center></td>
                    </tr>';
                          $miCont++;
                        }
                        ?>
                      </tbody>
                    </table>
                  </div><!--end .table-responsive -->
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          <!-- END SIMPLE MODAL MARKUP -->

          <!-- BEGIN SIMPLE MODAL MARKUP -->
          <div class="modal fade" id="modalGasolinera" tabindex="-1" role="dialog" aria-labelledby="modalGasolineraLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="modalGasolineraLabel">Gasolineras del Mes en que Cargó Combustible</h4>
                </div>

                <div class="modal-body">
                  <?php
                  require('../include/connect.php');
                  //error_reporting(E_ALL); //muestra todos los errores encontrados en la página
                  //print_r($_SESSION);			//muestra las sesiones
                  $dsql = "SELECT gas.id, gas.nombre, SUM(carco.cant) AS lts, carco.fechaReg
																FROM cargacombustible carco
																INNER JOIN catcombustibles catco ON carco.idCatCombustible = catco.id
																INNER JOIN gasolineras gas ON gas.id = carco.idGasolinera
																INNER JOIN viajes vjs ON vjs.id = carco.idViaje
																INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
																INNER JOIN operadores op ON op.id = asgv.idOperador
																WHERE catco.id = 3 AND carco.fechaReg BETWEEN DATE_FORMAT(CURDATE(),'%Y-%m-01') AND CURDATE() $filtroOperador
																GROUP BY op.id
																ORDER BY carco.idGasolinera ASC";
                  $dres = mysqli_query($link, $dsql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
                  ?>
                  <div class="table-responsive">
                    <table id="datatable1" class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Gasolinera</th>
                          <th>
                            <center>Litros Entregados</center>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sumaLitros = 0;
                        while ($gdat = mysqli_fetch_array($dres)) {
                          echo '
                    <tr>
                      <td>' . $gdat['id'] . '</td>
                      <td>' . $gdat['nombre'] . '</td>
                      <td class="text-center"><center>' . number_format($gdat['lts'], 2, '.', ',') . ' Lts.</center></td>
                    </tr>';
                          $sumaLitros += $gdat['lts'];
                        }
                        ?>
                      </tbody>
                    </table>
                  </div><!--end .table-responsive -->
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
                <?= $info->generaMenuLateral(); ?>

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
    <script src="../assets/js/libs/select2/select2.min.js"></script>
    <script src="../assets/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="../assets/js/libs/summernote/summernote.min.js"></script>
    <script src="../assets/js/libs/multi-select/jquery.multi-select.js"></script>
    <script src="../assets/js/libs/inputmask/jquery.inputmask.bundle.min.js"></script>
    <script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
    <script src="../assets/js/libs/moment/moment.min.js"></script>
    <script src="../assets/js/libs/d3/d3.v3.js"></script>
    <script src="../assets/js/libs/rickshaw/rickshaw.min.js"></script>
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
    <script src="../assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="../assets/js/libs/bootstrap-datepicker/locales/bootstrap-datepicker.es.js"></script>
    <script src="../assets/js/libs/morris.js/morris.min.js"></script>
    <script src="../assets/js/libs/raphael/raphael-min.js"></script>
    <script>
      $(document).ready(function() {

      });

      function notificaBad(cont) {
        toastr.warning(cont, 'Lo Sentimos!', {
          closeButton: true,
          timeOut: 5000,
        });
      }

      function notificaSuc(cont) {
        toastr.success(cont, 'Excelente!', {
          closeButton: true,
          timeOut: 7000,
        });
      }
    </script>

    <script>
      Morris.Bar({
        element: 'grafica',
        data: [
          <?= $datosGrafica2; ?>
        ],

        xkey: 'Operador',
        ykeys: ['Rendimiento'],
        labels: ['Rendimiento'],
        hideHover: 'auto',
        resize: true,
      });
    </script>
</body>

</html>