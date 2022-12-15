<?php
require_once 'seg.php';
$info = new Seguridad();
$info->Acceso('nominaOperador.php');
require '../include/connect.php';
require_once('../funciones/notificaAdmin.php');
$debug='1';
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
            </ul>
            <!--end .dropdown-menu -->
          </li>
          <!--end .dropdown -->
        </ul>
        <!--end .header-nav-profile -->
      </div>
      <!--end #header-navbar-collapse -->
    </div>
  </header>
  <!-- END HEADER-->

  <!-- BEGIN BASE-->
  <div id="base">

    <!-- BEGIN OFFCANVAS LEFT -->
    <div class="offcanvas">
    </div>
    <!--end .offcanvas-->
    <!-- END OFFCANVAS LEFT -->

    <!-- BEGIN CONTENT-->
    <div id="content">
      <section>
        <div class="section-body">

          <!-- BEGIN INTRO -->
          <div class="row">
            <div class="col-lg-12">
              <h1 class="text-primary"><?= $info->nombrePag; ?></h1>
            </div>
            <!--end .col -->
            <div class="col-lg-5">
              <article class="margin-bottom-xxl">
                <p class="lead"><?= $info->detailPag; ?></p>
              </article>
            </div>
            <!--end .col -->
          </div>
          <!--end .row -->
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
                </div>
                <!--end .card-head -->
                <div class="card-body">
                  <?php

                  $debug = 0;
                  $fecha1 = (isset($_POST['fStart']) and $_POST['fStart'] != '') ? $_POST['fStart'] : '';
                  $fecha2 = (isset($_POST['fEnd']) and $_POST['fEnd'] != '') ? $_POST['fEnd'] : '';
                  $operador = (isset($_POST['operador']) and $_POST['operador'] != '') ? $_POST['operador'] : '';

                  if ($debug != 0) {
                    echo '<br> ############################### ENTRO A DEBUG ############################### <br>';
                    echo '<br> $_POST:<br>';
                    print_r($_POST);
                    echo '<br>';
                    echo '<br>$fecha1: ' . $fecha1;
                    echo '<br>$fecha2: ' . $fecha2;
                    echo '<br>$operador: ' . $operador;
                    echo '<br> ############################################################################# <br>';
                  }

                  ?>
                  <div class="rows">
                    <form class="form" method="post" action="nominaOperador.php">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <div class="input-daterange input-group" id="rangoFechas">
                            <div class="input-group-content">
                              <input type="text" class="form-control" name="fStart" value="<?= $fecha1; ?>" autocomplete="off" />
                              <label>Rango de Fechas</label>
                            </div>
                            <span class="input-group-addon">hasta</span>
                            <div class="input-group-content">
                              <input type="text" class="form-control" name="fEnd" value="<?= $fecha2; ?>" autocomplete="off" />
                              <div class="form-control-line"></div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-lg-offset-1 col-md-4">
                        <?php
                        require '../include/connect.php';
                        $sql = "SELECT * FROM operadores WHERE estatus = '1'";
                        $res = mysqli_query($link, $sql) or die('<span class="text-danger">Por favor notifica al Administrador</span>')
                        ?>
                        <div class="form-group">
                          <select name="operador" id="operadorFiltro" class="form-control select2-list" data-placeholder="Select an item" value="0">
                            <option value=''>Todos los Operadores (Sólo Consulta de Nóminas)</option>
                            <optgroup label="Operadores">
                              <?php
                              while ($dat = mysqli_fetch_array($res)) {
                                $active = ($operador == $dat['id']) ? 'selected' : '';
                                echo '<option value="' . $dat['id'] . '" ' . $active . '> ' . $dat['nombre'] . ' ' . $dat['apellidos'] . ' </option>';
                              }
                              ?>
                            </optgroup>
                          </select>
                          <label>Seleccione Operador</label>
                        </div>
                      </div>

                      <div class="col-lg-1">
                        <button type="submit" style="margin-top:5px;" class="btn ink-reaction btn-raised btn-primary btn-loading-state" data-loading-text="<center>-- <i class='fa fa-spinner fa-spin'></i> --</center>">Aplicar</button>
                      </div>
                    </form>
                  </div>
                </div>
                <!--end .card-body -->
              </div>
              <!--end .card -->
            </div>
            <!--end .col -->
          </div>
          <!--end .row -->
          <!-- END FILTROS -->
          <div class="col-md-12">
            <div class="card card-underline">
              <div class="card-head">
                <ul class="nav nav-tabs pull-left" data-toggle="tabs">
                  <li class="active"><a href="#nominas">Creación de Nóminas</a></li>
                  <li><a href="#conNominas">Consulta de Nóminas</a></li>
                </ul>
                <header></header>
              </div>
              <div class="card-body tab-content">
                <div class="tab-pane active" id="nominas">
                  <!-- /////////////////////////////////////////////////////////////////////////////////////// -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-bordered style-primary">
                        <div class="card-head">
                          <div class="tools">
                            <div class="btn-group">
                              <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                            </div>

                          </div>
                          <header><i class="fa fa-fw fa-tag"></i> Historial de Viajes realizados</header>
                        </div>
                        <!--end .card-head -->
                        <div class="card-body style-default-bright table-responsive">
                          <?php

                          if ($fecha1 != '' and $fecha2 != '') {
                            $filtrofecha = " AND vjs.fechaSalida BETWEEN '$fecha1' AND '$fecha2'";
                          } else {
                            $filtrofecha = '';
                          }
                          if ($operador != '') {
                            $filtroOperador = "AND asgv.idOperador = '$operador'";
                          } else {
                            $filtroOperador = '';
                          }
                          $sql = "SELECT vjs.*,op.id AS idOpe, op.nombre AS nomOpe, op.apellidos AS apeOpe,
                          ve.noEconomico AS noEco, ve.placas AS noPlacas, ru.destino1 AS d1, ru.destino2 AS d2,
                          ru.destino3 AS d3, ctmt.nombre AS nomMat, ru.pagoOperador AS pagoOpe, IFNULL(ru.extraAntiguedad, 0) AS extraAntiguedad,
                          (IFNULL(ru.extraAntiguedad,0)+ru.pagoOperador) AS totalAPagarConAnt,ru.pagoOperador AS totalAPagar,
                          vnt.peso AS pesoMat, vnt.id AS idVent,ru.tipoViaje,op.bonoAntiguedad
                          FROM ventas vnt
                          INNER JOIN viajes vjs ON vjs.idVenta = vnt.id
                          INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
                          INNER JOIN catmateriales ctmt ON ctmt.id = vnt.idCatMaterial
                          INNER JOIN operadores op ON op.id = asgv.idOperador
                          INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
                          INNER JOIN rutas ru ON ru.id = vnt.idRuta
                          WHERE vnt.idNomina IS NULL AND vnt.estatusViaje != '4' 
                                AND vnt.estatusPago != '4' $filtrofecha $filtroOperador
                          ORDER BY vnt.id DESC";
                          /**** Inicia Debug ***/
                          if ($debug == 1) {
                            $resultXquery = mysqli_query($link, $sql) or die(mysqli_error($link) . '<br>' . $sql);
                            $canInsert = mysqli_affected_rows($link);
                            echo '<br>SQL: ' . $sql . '<br>';
                            echo '<br>Cant de Registros Cargados: ' . $canInsert;
                          } else {
                            $resultXquery = mysqli_query($link, $sql) or die('Problemas al consultar Viajes Pendientes por Pagar,  notifica al administrador');
                            $canInsert = mysqli_affected_rows($link);
                          }

                          /******Finaliza Debug **/
                          if ($canInsert > 0 and $operador != '') {
                          ?>
                            <form class="form" role="form" method="post" action="../funciones/registraNuevaNomina.php">
                              <input name="idOperador" type="hidden" value="<?= $operador ?>">
                              <table id="generaNomina" class="table table-striped table-hover">
                                <thead>
                                  <tr>
                                    <th class="text-center col-xs-1">#</th>
                                    <th class="text-center">Operador</th>
                                    <th class="text-center">Vehículo</th>
                                    <th class="text-center">Viaje</th>
                                    <th class="text-center">Material Transportado</th>
                                    <th class="text-center">Peso Transportado</th>
                                    <th class="text-center">Fecha de Salida</th>
                                    <th class="text-center">Pago por Viaje</th>
                                    <th>Opciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $contador = 0;
                                  while ($nom = mysqli_fetch_array($resultXquery)) {
                                    $dest1 = substr($nom['d1'], 0, 4);
                                    $dest2 = substr($nom['d2'], 0, 4);
                                    $dest3 = substr($nom['d3'], 0, 4);
                                    $pago=$nom['bonoAntiguedad'] == '1'?$nom['totalAPagarConAnt']:$nom['totalAPagar'];
                                    $iconAntiguedad = ($nom['bonoAntiguedad'] == '1' and $nom['extraAntiguedad'] > 0) ? '<i class="md-star text-warning"></i>' : '';
                                    $tooltip = ($nom['bonoAntiguedad'] == '1' and $nom['extraAntiguedad'] > 0) ? 'data-toggle="tooltip" data-html="true" title="$' . number_format($nom['extraAntiguedad'], 2, '.', '.') . '" ' : '';
                                    if ($dest3 != '') {
                                      $ruta = $nom['tipoViaje'] . ': ' . $dest1 . '/' . $dest2 . '/' . $dest3;
                                    } else {
                                      $ruta = $nom['tipoViaje'] . ': ' . $dest1 . '/' . $dest2;
                                    }
                                    $peso = ($nom['pesoMat'] == '') ? 'S/R' : $nom['pesoMat'];
                                    echo '

                                <tr>
                                  <td class="text-center"> ' . $nom['idVent'] . ' </td>
                                  <td class="text-center"> ' . $nom['nomOpe'] . ' ' . $nom['apeOpe'] . '</td>
                                  <td class="text-center"> ECO - ' . $nom['noEco'] . ' (Placas ' . $nom['noPlacas'] . ')</td>
                                  <td class="text-center"> ' . $ruta . '</td>
                                  <td class="text-center"> ' . $nom['nomMat'] . ' </td>
                                  <td class="text-center"> ' . $peso . ' </td>
                                  <td class="text-center"> ' . $nom['fechaSalida'] . ' </td>
                                  <td class="text-center" ' . $tooltip . ' >' . $iconAntiguedad . '$ ' . number_format($pago, 2, '.', ',') . '</td>
                                  <td class="text-center">
                                    <div class="checkbox checkbox-styled">
                                      <div class="checkbox checkbox-styled checkbox-success">
                                        <label>
                                          <input type="checkbox" class="viajesSeleccionados" data-money="' . $pago . '" onclick="sumarPagos()" name="venta[]" id="viaje-' . $nom['id'] . '" value="' . $nom['idVenta'] . '">
                                        </label>
                                    </div>
                                  </td>
                                </tr>
                                ';
                                    $contador++;
                                  }
                                  $contador2 = $contador - 1;

                                  ?>
                                </tbody>
                              </table>
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-content">
                                        <input type="text" onchange="sumarPagos()" class="form-control dollar-mask" value="0" data-inputmask="'alias': 'currency'" id="bonos" name="bonos">
                                        <label for="bonos">Total de Bonos</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="motvBonos" name="motvBonos">
                                    <label for="motvBonos">Motivo de bonos</label>
                                  </div>
                                </div>
                                <div class="col-md-3" id="montoTotal">

                                </div>
                                <input type="hidden" id="pagoDeViajes" name="pagoDeViajes" value="0"></input>
                              </div>
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <div class="input-group-content">
                                        <input type="text" data-inputmask="'alias': 'currency'" onchange="sumarPagos()" value="0" class="form-control dollar-mask" id="descuentos" name="descuentos">
                                        <label for="descuentos">Total de Descuentos</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="motvDesc" name="motvDesc">
                                    <label for="motvDesc">Motivo de Descuentos</label>
                                  </div>
                                </div>

                              </div>
                              <div class="col-lg-9">
                                <div class="form-group">

                                  <textarea name="motivo" id="motivo" class="form-control" rows="1" placeholder="" required></textarea>
                                  <label for="motivo">Motivo de Nómina</label>
                                  <input type="hidden" name="cont" id="cont" value="<?= $contador2; ?>">
                                </div>
                              </div>
                              <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary"><i class="md md-send"></i> Crear Nómina</button>
                              </div>
                            </form>
                          <?php
                          } else {
                            echo ' <div class="alert alert-callout alert-success" role="alert">
                                      <strong>Sin Viajes Pendientes!</strong> El Operador no tiene viajes Pendientes.
                                    </div>
                              ';
                          }
                          ?>
                        </div>
                        <!--end .card-body -->
                      </div>
                      <!--end .card -->
                    </div>
                    <!--end .col -->
                  </div>
                  <!--end .section-body -->

                  <!-- ////////////////////////////////////////////////////////////////////////////////////// -->
                </div>
                <div class="tab-pane" id="conNominas">
                  <p>Información de las nóminas creadas.</p>
                  <!-- /////////////////////////////////////////////////////////////////////////////////////// -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card card-bordered style-primary">
                        <div class="card-head">
                          <div class="tools">
                            <div class="btn-group">
                              <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                            </div>

                          </div>
                          <header><i class="fa fa-fw fa-tag"></i> Historial de Nóminas realizadas</header>
                        </div>
                        <!--end .card-head -->
                        <div class="card-body style-default-bright table-responsive">
                          <?php
                          $filtroOperador = '';

                          if ($fecha1 != '' and $fecha2 != '') {
                            $filtrofecha = " AND nmn.fecha BETWEEN '$fecha1' AND '$fecha2'";
                          } else {
                            $filtrofecha = '';
                          }
                          if ($operador != '') {
                            $filtroOperador = "AND op.id = '$operador'";
                          } else {
                            $filtroOperador = '';
                          }

                          $sql = "SELECT nmn.*, CONCAT(op.nombre,' ',op.apellidos) AS nomOpe
                                                        FROM nomina nmn
                  																			INNER JOIN ventas vnt ON vnt.idNomina = nmn.id
                  																			INNER JOIN viajes vjs ON vjs.idVenta = vnt.id
                  																			INNER JOIN asignavehiculos asgv ON asgv.id = vjs.idAsignaVehiculo
                  																			INNER JOIN operadores op ON op.id = asgv.idOperador
                                                        WHERE nmn.estatus != '3' $filtrofecha $filtroOperador
                  																			GROUP BY nmn.id
                                                        ORDER BY nmn.id DESC";
                          $res = mysqli_query($link, $sql) or die('<span class=" text-danger">Notifica al Administrador </span>');
                          ?>

                          <table id="datatable1" class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th class="text-center col-xs-1">#</th>
                                <th>Operador</th>
                                <th>Descripción</th>
                                <th>Motivo de la Nómina</th>
                                <th class="text-center">Fecha de la Nómina</th>
                                <th class="text-center">Estatus</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              while ($con = mysqli_fetch_array($res)) {
                                switch ($con['estatus']) {
                                  case '2':
                                    $e = 'Pendiente';
                                    $color = 'default-light';
                                    break;
                                  case '1':
                                    $e = 'Pagado';
                                    $color = 'success';
                                    break;
                                  case '3':
                                    $e = 'Cancelado';
                                    $color = 'danger';
                                    break;
                                  default:
                                    $e = 'Pendiente';
                                    $color = 'default-light';
                                    break;
                                }
                                echo '
                                                <tr>
                                                  <td class="text-center col-xs-1" id="idNomina' . $con['id'] . '"> ' . $con['id'] . ' </td>
                                                  <td> ' . $con['nomOpe'] . '</td>
                                                  <td> ' . $con['descripcion'] . '</td>
                                                  <td> ' . $con['motivo'] . ' </td>
                                                  <td class="text-center"> ' . $con['fecha'] . ' </td>
                                                  <td class="text-center"> ' . $e . ' </td>
                                                  <td class="text-center">
                                                    <form method="POST" action="../funciones/reimprimeNomina.php">
                                                      <input type="hidden" value="' . $con['id'] . '" name="ident">
                                                      <button type="submit" class="btn btn-icon-toggle" class="btn btn-icon-toggle text-default" data-toggle="tooltip" data-placement="top" data-original-title="Reimprimir Nómina."><i class="fa fa-file-pdf-o"></i></button>
                                                    </form>
                                                  </td>
                                                </tr>
                                                ';
                              }
                              ?>
                            </tbody>
                          </table>

                        </div>
                        <!--end .card-body -->
                      </div>
                      <!--end .card -->
                    </div>
                    <!--end .col -->
                  </div>
                  <!--end .section-body -->

                  <!-- ////////////////////////////////////////////////////////////////////////////////////// -->
                </div>
              </div>
            </div>
            <!--end .card -->
          </div>
          <!--end .col -->


      </section>
    </div>
    <!--end #content-->

    <!-- END CONTENT -->

    <!-- BEGIN FORM MODAL MARKUP -->

    <div class="modal fade" id="formEditContacto" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" id="ventaContent">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="formModalLabel">Editar Venta</h4>
          </div>
          <div class="modal-body">
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->









    <!-- BEGIN MENUBAR-->
    <div id="menubar" class="menubar-inverse ">

      <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">

          <!-- MENU LATERAL -->
          <?= $info->generaMenuLateral(); ?>

        </ul>
        <!--end .main-menu -->
        <!-- END MAIN MENU -->

      </div>
      <!--end .menubar-scroll-panel-->
    </div>
    <!--end #menubar-->
    <!-- END MENUBAR -->


  </div>
  </div>
  <!--end #base-->
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
    $(document).ready(function() {
      $('.txtPopOver').popover('show');
      $("#bonos").inputmask();
      $("#descuentos").inputmask();
      $('#rangoFechas').datepicker({
        todayHighlight: true,
        format: "yyyy-mm-dd",
        language: "es"
      });
      $(function() {
        $('[data-toggle="tooltip"]').tooltip()
      });
      $("#operadorFiltro").val("<?=$operador?>");
      if (window.history.replaceState) { // verificamos disponibilidad
        window.history.replaceState(null, null, window.location.href);
      }
    });


    function sumarPagos() {
      let sumaViajes = 0;
      $(".viajesSeleccionados").each(function() {
        if ($(this).is(':checked')) {
          sumaViajes += parseFloat($(this).data('money'));

        }
      });
      $("#pagoDeViajes").val(sumaViajes);
      let bonos = $("#bonos").val() != '' ? $("#bonos").val() : '$ 0.00';
      let descuentos = $("#descuentos").val() != '' ? $("#descuentos").val() : '$ 0.00';
      let bonoLim = bonos != '$ 0.00' ? bonos.replace(/[$,]/g, '') : 0;
      let descuentosLim = descuentos != '$ 0.00' ? descuentos.replace(/[$,]/g, '') : 0;
      let sumaTotal = parseFloat(bonoLim) + parseFloat(sumaViajes) - parseFloat(descuentosLim);
      let total = sumaTotal.toLocaleString('en-US', {
        maximumFractionDigits: 20
      });
      let for_sumaV = sumaViajes.toLocaleString('en-US', {
        maximumFractionDigits: 20
      });
      $("#montoTotal").html('<h5>Subtotal: $ ' + for_sumaV + '</h5><h5>Bonos: ' + bonos + '</h5><h5 class="text-danger">Descuentos: ' + descuentos + '</h5><h5 class="">Total a Pagar: $ ' + total + '</h5>');
    }
    <?php
    if (isset($_SESSION['ATZmsjEncargadoConVentas'])) {
      echo "notificaBad('" . $_SESSION['ATZmsjAdminNominaOperador'] . "');";
      unset($_SESSION['ATZmsjAdminNominaOperador']);
    }
    if (isset($_SESSION['ATZmsjSuccesAdminNominaOperador'])) {
      echo "notificaSuc('" . $_SESSION['ATZmsjSuccesAdminNominaOperador'] . "');";
      unset($_SESSION['ATZmsjSuccesAdminNominaOperador']);
    }
    ?>

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
  <!-- END JAVASCRIPT -->

</body>

</html>