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
    echo '<br>sql = '.$csql.'<br><br>';
    $cres=mysqli_query($link,$csql) or die('Error al Cargar la Imagen del Camión, Notifica al Administrador.');
    $cdat = mysqli_fetch_array($cres);
    $camion = 0;
    if ($cdat['tipo'] == '6') {      $camion = 1;    }
    elseif ($cdat['tipo'] == '1' && $cdat['cantComp'] < '2') {      $camion = 2;   }
    elseif ($cdat['tipo'] == '1' && $cdat['cantComp'] == '3') {      $camion = 3;   }
    else {      $camion = 4;    }

    $msql ="SELECT CONCAT(pro.nombre,' (Serie: ',stk.noSerie,')') AS articulo, dasg.posicion, dasg.id
    FROM vehiculos ve
    INNER JOIN asignavehiculos av ON av.idVehiculo = ve.id
    INNER JOIN asignaciones asg ON asg.idAsignaVehiculo = av.id
    INNER JOIN detasigna dasg ON dasg.idAsignacion = asg.id
    INNER JOIN stocks stk ON stk.id = dasg.idStock
    INNER JOIN productos pro ON pro.id = stk. idProducto
    INNER JOIN cattipovehiculos cve ON cve.id = ve.idCatTipoVehiculo
    LEFT JOIN complementos comp ON comp.idVehiculo = ve.id
    WHERE ve.noEconomico = '$datovehiculo' AND dasg.posicion > '0'
    GROUP BY dasg.id
    ORDER BY dasg.posicion ASC";
    echo 'SQL: '.$msql;
    $mresult = mysqli_query($link,$msql) or die('Error al Cargar las coordenadas de los Artículos Asignados, Notifica al Administrador.');
    $articulo['0'] = '';
    $cont = 0;
    $muestraCamion = '';
    for ($i=0; $i <= 34; $i++) {
     $articulo[$i] = 'Sin Registrar';
    }
    while ($mdato = mysqli_fetch_array($mresult)) {
      $contenido = ($mdato['articulo'] == '') ? 'Sin Registrar' : $mdato['articulo'] ;
      $posicion = $mdato['posicion'];
      $articulo[$posicion] = $contenido;
    }
    switch ($camion) {
      case '1':   $muestraCamion = '<img class="img-responsive" src="../trailer/rabon.jpeg" alt="Volteo"  usemap="#Volteo" />';
        $muestraCamion.=  '<map name="Volteo">
                             <area alt="'.$articulo['1'].'" shape="circle" coords="96,306, 48" />
                             <area alt="'.$articulo['2'].'" shape="circle" coords="96,424, 48" />
                             <area alt="'.$articulo['3'].'" shape="circle" coords="660,306, 48" />
                             <area alt="'.$articulo['4'].'" shape="rect" coords="619,343,708,371" />
                             <area alt="'.$articulo['5'].'" shape="circle" coords="660,409, 48" />
                             <area alt="'.$articulo['6'].'" shape="rect" coords="619,440, 708,466" />
                           </map>';
                            break;

      case '2':
      $muestraCamion = '<img class="img-responsive" src="../trailer/sencillo.jpeg" alt="Trailer Sencillo"  usemap="#verArticulos" />';
      $muestraCamion.=  '<map name="verArticulos">
                          <area alt="'.$articulo['1'].'" shape="circle" coords="92,300,30" />
                          <area alt="'.$articulo['2'].'" shape="circle" coords="92,376,30" />
                          <area alt="'.$articulo['3'].'" shape="circle" coords="325,295,30" />
                          <area alt="'.$articulo['4'].'" shape="rect" coords="294,316,361,339" />
                          <area alt="'.$articulo['5'].'" shape="circle" coords="325,376,30" />
                          <area alt="'.$articulo['6'].'" shape="rect" coords="294,401,361,423" />
                          <area alt="'.$articulo['7'].'" shape="circle" coords="408,294,30" />
                          <area alt="'.$articulo['8'].'" shape="rect" coords="373,317,440,339" />
                          <area alt="'.$articulo['9'].'" shape="circle" coords="408,376,30" />
                          <area alt="'.$articulo['10'].'" shape="rect" coords="378,401,440,423" />
                          <area alt="'.$articulo['11'].'" shape="circle" coords="620,295,30" />
                          <area alt="'.$articulo['12'].'" shape="rect" coords="598,317,656,339" />
                          <area alt="'.$articulo['13'].'" shape="circle" coords="620,376,30" />
                          <area alt="'.$articulo['14'].'" shape="rect" coords="589,401,656,423" />
                          <area alt="'.$articulo['15'].'" shape="circle" coords="707,295,30" />
                          <area alt="'.$articulo['16'].'" shape="rect" coords="671,317,738,339" />
                          <area alt="'.$articulo['17'].'" shape="circle" coords="707,376,30" />
                          <area alt="'.$articulo['18'].'" shape="rect" coords="671,401,738,423" />
                        </map>';
      break;

      case '3':
        $muestraCamion = '<img class="img-responsive" src="../trailer/full.jpeg" alt="Trailer Full" usemap="#trailerFull" />';
        $muestraCamion.=  '<map name="trailerFull">

                          <area alt="'.$articulo['1'].'" shape="circle" coords="46,300,19" />
                          <area alt="'.$articulo['2'].'" shape="circle" coords="46,350,19" />
                          <area alt="'.$articulo['3'].'" shape="circle" coords="191,300,19" />
                          <area alt="'.$articulo['4'].'" shape="rect" coords="172,312,211,327" />
                          <area alt="'.$articulo['5'].'" shape="circle" coords="191,350,19" />
                          <area alt="'.$articulo['6'].'" shape="rect" coords="172,361,211,375" />
                          <area alt="'.$articulo['7'].'" shape="circle" coords="244,300,19" />
                          <area alt="'.$articulo['8'].'" shape="rect" coords="223,312,262,327" />
                          <area alt="'.$articulo['9'].'" shape="circle" coords="244,350,19" />
                          <area alt="'.$articulo['10'].'" shape="rect" coords="223,361,262,375" />
                          <area alt="'.$articulo['11'].'" shape="circle" coords="375,300,19" />
                          <area alt="'.$articulo['12'].'" shape="rect" coords="335,312,374,327" />
                          <area alt="'.$articulo['13'].'" shape="circle" coords="375,350,19" />
                          <area alt="'.$articulo['14'].'" shape="rect" coords="335,361,374,275" />
                          <area alt="'.$articulo['15'].'" shape="circle" coords="427,300,19" />
                          <area alt="'.$articulo['16'].'" shape="rect" coords="408,312,447,327" />
                          <area alt="'.$articulo['17'].'" shape="circle" coords="427,350,19" />
                          <area alt="'.$articulo['18'].'" shape="rect" coords="408,361,447,375" />
                          <area alt="'.$articulo['19'].'" shape="circle" coords="516,300,19" />
                          <area alt="'.$articulo['20'].'" shape="rect" coords="496,312,535,327" />
                          <area alt="'.$articulo['21'].'" shape="circle" coords="516,350,19" />
                          <area alt="'.$articulo['22'].'" shape="rect" coords="496,361,535,375" />
                          <area alt="'.$articulo['23'].'" shape="circle" coords="568,300,19" />
                          <area alt="'.$articulo['24'].'" shape="rect" coords="549,312,588,327" />
                          <area alt="'.$articulo['25'].'" shape="circle" coords="568,350,19" />
                          <area alt="'.$articulo['26'].'" shape="rect" coords="549,361,588,375" />
                          <area alt="'.$articulo['27'].'" shape="circle" coords="700,300,19" />
                          <area alt="'.$articulo['28'].'" shape="rect" coords="680,312,719,327" />
                          <area alt="'.$articulo['29'].'" shape="circle" coords="700,350,19" />
                          <area alt="'.$articulo['30'].'" shape="rect" coords="680,361,719,375" />
                          <area alt="'.$articulo['31'].'" shape="circle" coords="752,300,19" />
                          <area alt="'.$articulo['32'].'" shape="rect" coords="731,312,770,327" />
                          <area alt="'.$articulo['33'].'" shape="circle" coords="752,350,19" />
                          <area alt="'.$articulo['34'].'" shape="rect" coords="731,361,770,375" />
                        </map>';
      break;

      default:
          echo '<img class="img-responsive" src="../trailer/noimg.png" alt="Sin Registro" />';
          break;
    }
    echo '===></br>';
    echo $muestraCamion;
}





?>
