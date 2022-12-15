<?php

function notificaAdmin($link){

  $fechaAct=date('Y-m-d');

  $fechaInicio = strtotime ( '+15 day' , strtotime ( $fechaAct ) ) ;
  $fechaAbuscar = date ( 'Y-m-d' , $fechaInicio );

  $slqLic = "SELECT COUNT(id) AS cant FROM operadores WHERE caduLicencia BETWEEN '$fechaAct' AND '$fechaAbuscar' AND estatus = '1'";
  $resLic = mysqli_query($link,$slqLic) or die ('<p class="text-danger">Problemas al consultar las Licencias, Notifica a tu Administrador</p>');
  #echo $sqlPoliza;
  $lic = mysqli_fetch_array($resLic);
  $cantLic = 0;
  $cantLic += $lic['cant'];

  $sqlLic2 = "SELECT CONCAT(nombre,' ',apellidos) AS nomOperador, DATEDIFF(caduLicencia,now()) AS tiempo, caduLicencia
  FROM operadores WHERE caduLicencia BETWEEN '$fechaAct' AND '$fechaAbuscar' AND estatus = '1'";
  $resLic2 = mysqli_query($link,$sqlLic2) or die ('<p class="text-danger">Problemas al consultar las Licencias, Notifica a tu Administrador</p>'.mysqli_error($link));
  if ($_SESSION['ATZidNivel'] < 3 AND $cantLic > 0) {
   ?>
  <ul class="header-nav header-nav-options">
  <li class="dropdown hidden-xs">
      <a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-truck"></i><sup class="badge style-danger"><?=$cantLic;?></sup>
      </a>
      <ul class="dropdown-menu animation-expand">
        <li class="header"><center><b><h4>Licencias a vencer</h4></b></center></li>
        <?php
        while ($listaLic = mysqli_fetch_array($resLic2)) {

  echo	'<li>
          <a class="alert alert-callout alert-info" href="../Encargado/operadores.php">
            <b><h4><div class="pull-right">'.$listaLic['tiempo'].' días</div></h4></b>
            <strong>'.$listaLic['nomOperador'].'</strong><br>
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
  $fechaInicial = strtotime ( '+1 month' , strtotime ( $fechaAct ) ) ;
  $fechaBusqueda = date ( 'Y-m-d' , $fechaInicial );

  $sqlPoliza = "SELECT COUNT(id) AS cant FROM polizas WHERE fechaVence < '$fechaBusqueda' AND estatus = '1'";
  $resPoliza = mysqli_query($link,$sqlPoliza) or die ('<p class="text-danger">Problemas al consultar loas pólizas, Notifica a tu Administrador</p>');
  #echo $sqlPoliza;
  $pol = mysqli_fetch_array($resPoliza);
  $cantPolizas = 0;
  $cantPol += $pol['cant'];

  $sqlPoliza2 = "SELECT ase.nombre,COUNT(plz.id) AS cantPolizas
                  FROM polizas plz
                  INNER JOIN aseguradoras ase ON plz.idAseguradora = ase.id
                  WHERE plz.fechaVence < '$fechaBusqueda' AND plz.estatus = '1'
                  GROUP BY plz.idAseguradora";
  $resPoliza2 = mysqli_query($link,$sqlPoliza2) or die ('<p class="text-danger">Problemas al consultar loas pólizas, Notifica a tu Administrador</p>');
  if ($_SESSION['ATZidNivel'] < 3 AND $cantPol > 0) {
   ?>
  <ul class="header-nav header-nav-options">
  <li class="dropdown hidden-xs">
      <a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell"></i><sup class="badge style-danger"><?=$cantPol;?></sup>
      </a>
      <ul class="dropdown-menu animation-expand">
        <li class="header"><center><b><h4>Pólizas a vencer</h4></b></center></li>
        <?php
        while ($listPol = mysqli_fetch_array($resPoliza2)) {

  echo	'<li>
          <a class="alert alert-callout alert-info" href="../Encargado/polizas.php">
            <b><h4><div class="pull-right">'.$listPol['cantPolizas'].'</div></h4></b>
            <strong>'.$listPol['nombre'].'</strong><br>
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
