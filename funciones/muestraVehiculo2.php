<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
$datovehiculo=$_REQUEST['selVehiculo'];
echo $datovehiculo;

  if ($datovehiculo == '') {
    echo 'No hubo ninguna coincidencia.';
  } else {
    $csql="SELECT cve.id AS tipo, COUNT(comp.id) AS cantComp, ve.noEconomico
          FROM vehiculos ve
          INNER JOIN cattipovehiculos cve ON cve.id = ve.idCatTipoVehiculo
					LEFT JOIN complementos comp ON comp.idVehiculo = ve.id
          WHERE ve.noEconomico = '$datovehiculo'
					ORDER BY ve.noEconomico ASC
					limit 1";
    //echo '<br>sql = '.$sql.'<br><br>';
    $cres=mysqli_query($link,$csql) or die('<option>Notifica al Administrador.</option');
    $cdat = mysqli_fetch_array($cres);
    $camion = 0;
    if ($cdat['tipo'] == '6') {      $camion = 1;    }
    elseif ($cdat['tipo'] == '1' && $cdat['cantComp'] < '2') {      $camion = 2;   }
    elseif ($cdat['tipo'] == '1' && $cdat['cantComp'] == '3') {      $camion = 3;   }
    else {      $camion = 4;    }
echo '<br>Camion: '.$camion;
    switch ($camion) {
      case '1':      $contenidoCam = '<img class="img-responsive" src="../trailer/rabon.jpeg" alt="Volteo"  usemap="#verArticulos" />';                break;
      case '2':   $contenidoCam = '<img class="img-responsive" src="../trailer/sencillo.jpeg" alt="Trailer Sencillo"  usemap="#verArticulos" />';   break;
      case '3':       $contenidoCam = '<img class="img-responsive" src="../trailer/full.jpeg" alt="Trailer Full"  usemap="#verArticulos" />';           break;
      default:           $contenidoCam = '<img class="img-responsive" src="../trailer/noimg.png" alt="Sin Registro" />';       break;
    }
            }
      echo $contenidoCam;

?>
