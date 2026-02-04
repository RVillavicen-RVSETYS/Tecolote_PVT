<?php

function notificaEncargado($link)
{

  $fechaAct = date('Y-m-d');

  $fechaInicio = strtotime('+15 day', strtotime($fechaAct));
  $fechaAbuscar = date('Y-m-d', $fechaInicio);

  $slqLic = "SELECT COUNT(id) AS cant FROM operadores WHERE caduLicencia BETWEEN '$fechaAct' AND '$fechaAbuscar' AND estatus = '1'";
  $resLic = mysqli_query($link, $slqLic) or die('<p class="text-danger">Problemas al consultar las Licencias, Notifica a tu Administrador</p>');
  #echo $sqlPoliza;
  $lic = mysqli_fetch_array($resLic);
  $cantLic = 0;
  $cantLic += $lic['cant'];

  $sqlLic2 = "SELECT CONCAT(nombre,' ',apellidos) AS nomOperador, DATEDIFF(caduLicencia,now()) AS tiempo, caduLicencia
  FROM operadores WHERE caduLicencia BETWEEN '$fechaAct' AND '$fechaAbuscar' AND estatus = '1'";
  $resLic2 = mysqli_query($link, $sqlLic2) or die('<p class="text-danger">Problemas al consultar las Licencias, Notifica a tu Administrador</p>' . mysqli_error($link));
  if ($_SESSION['ATZidNivel'] < 3 and $cantLic > 0) {
?>
    <ul class="header-nav header-nav-options">
      <li class="dropdown hidden-xs">
        <a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-truck"></i><sup class="badge style-danger"><?= $cantLic; ?></sup>
        </a>
        <ul class="dropdown-menu animation-expand">
          <li class="header">
            <center><b>
                <h4>Licencias a vencer</h4>
              </b></center>
          </li>
          <?php
          while ($listaLic = mysqli_fetch_array($resLic2)) {

            echo  '<li>
          <a class="alert alert-callout alert-info" href="operadores.php">
            <b><h4><div class="pull-right">' . $listaLic['tiempo'] . ' días</div></h4></b>
            <strong>' . $listaLic['nomOperador'] . '</strong><br>
          </a>
        </li>';
          }
          ?>
        </ul><!--end .dropdown-menu -->
      </li>
    </ul>
  <?php
  }

  ########################################################################################################
  $fechaInicial = strtotime('+1 month', strtotime($fechaAct));
  $fechaBusqueda = date('Y-m-d', $fechaInicial);

  $sqlPoliza = "SELECT COUNT(id) AS cant FROM polizas WHERE fechaVence < '$fechaBusqueda' AND estatus = '1'";
  $resPoliza = mysqli_query($link, $sqlPoliza) or die('<p class="text-danger">Problemas al consultar loas pólizas, Notifica a tu Administrador</p>');
  #echo $sqlPoliza;
  $pol = mysqli_fetch_array($resPoliza);
  $cantPolizas = 0;
  $cantPol += $pol['cant'];

  $sqlPoliza2 = "SELECT ase.nombre,COUNT(plz.id) AS cantPolizas
                  FROM polizas plz
                  INNER JOIN aseguradoras ase ON plz.idAseguradora = ase.id
                  WHERE plz.fechaVence < '$fechaBusqueda' AND plz.estatus = '1'
                  GROUP BY plz.idAseguradora";
  $resPoliza2 = mysqli_query($link, $sqlPoliza2) or die('<p class="text-danger">Problemas al consultar loas pólizas, Notifica a tu Administrador</p>');
  if ($_SESSION['ATZidNivel'] < 3 and $cantPol > 0) {
  ?>
    <ul class="header-nav header-nav-options">
      <li class="dropdown hidden-xs">
        <a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-bell"></i><sup class="badge style-danger"><?= $cantPol; ?></sup>
        </a>
        <ul class="dropdown-menu animation-expand">
          <li class="header">
            <center><b>
                <h4>Pólizas a vencer</h4>
              </b></center>
          </li>
          <?php
          while ($listPol = mysqli_fetch_array($resPoliza2)) {

            echo  '<li>
          <a class="alert alert-callout alert-info" href="polizas.php">
            <b><h4><div class="pull-right">' . $listPol['cantPolizas'] . '</div></h4></b>
            <strong>' . $listPol['nombre'] . '</strong><br>
          </a>
        </li>';
          }
          ?>
        </ul><!--end .dropdown-menu -->
      </li>
    </ul>
  <?php
  }



  ########################################################################################################
  $fechaInicial = strtotime('+10 Days', strtotime($fechaAct));
  $fechaBusqueda = date('Y-m-d', $fechaInicial);

  $sqlVerificacion = "SELECT COUNT( v.id ) AS 'CantVehiculos' FROM vehiculos v WHERE v.fechaVerificacion < '$fechaBusqueda' AND v.estatus = '1'";
  $respVerificacion = mysqli_query($link, $sqlVerificacion) or die('<p class="text-danger">Problemas al consultar loas pólizas, Notifica a tu Administrador</p>');
  #echo $sqlVerificacion;
  $verificacion = mysqli_fetch_array($respVerificacion);
  $cantVerificacion = 0;
  $cantVerificacion += $verificacion['CantVehiculos'];

  $sqlVerificacion2 = "SELECT  v.id AS 'CantVehiculos', v.placas AS 'Placa', DATEDIFF(v.fechaVerificacion,NOW()) AS 'DiasRest' FROM vehiculos v WHERE v.fechaVerificacion < '$fechaBusqueda' AND v.estatus = '1'";
  $respVerificacion2 = mysqli_query($link, $sqlVerificacion2) or die('<p class="text-danger">Problemas al consultar loas pólizas, Notifica a tu Administrador</p>');
  if ($_SESSION['ATZidNivel'] < 3 and $cantVerificacion > 0) {
  ?>
    <ul class="header-nav header-nav-options">
      <li class="dropdown hidden-xs">
        <a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown" aria-expanded="false">
          <i class="fa fa-calendar"></i><sup class="badge style-danger"><?= $cantVerificacion; ?></sup>
        </a>
        <ul class="dropdown-menu animation-expand">
          <li class="header">
            <center><b>
                <h4>Vehículos a Verificar</h4>
              </b></center>
          </li>
          <?php
          while ($listVehiculos = mysqli_fetch_array($respVerificacion2)) {

            echo  '<li>
          <a class="alert alert-callout alert-info" href="vehiculos.php">
            <b><h4><div class="pull-right">En ' . $listVehiculos['DiasRest'] . ' Días</div></h4></b>
            <strong>Placa: ' . $listVehiculos['Placa'] . '</strong><br>
          </a>
        </li>';
          }
          ?>
        </ul><!--end .dropdown-menu -->
      </li>
    </ul>
<?php
  }
}

?>