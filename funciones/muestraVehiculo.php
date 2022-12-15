<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
$datovehiculo=$_REQUEST['selVehiculo'];
#echo $datovehiculo;

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
    //echo '<br>sql = '.$csql.'<br><br>';
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
#    echo 'SQL: '.$msql;
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
                             <area alt="'.$articulo['1'].'" shape="circle" coords="98	314	48" title="1.- '.$articulo['1'].'" />
                             <area alt="'.$articulo['2'].'" shape="circle" coords="98	314	48" title="2.- '.$articulo['2'].'" />
                             <area alt="'.$articulo['3'].'" shape="circle" coords="662	428	48" title="3.- '.$articulo['3'].'" />
                             <area alt="'.$articulo['4'].'" shape="rect" coords="615	336	616	445" title="4.- '.$articulo['4'].'" />
                             <area alt="'.$articulo['5'].'" shape="circle" coords="662	403	48" title="5.- '.$articulo['5'].'" />
                             <area alt="'.$articulo['6'].'" shape="rect" coords="713	473	616	445" title="6.- '.$articulo['6'].'" />
                           </map>';
                            break;

      case '2':
      $muestraCamion = '<img class="img-responsive" src="../trailer/sencillo.jpeg" alt="Trailer Sencillo"  usemap="#trailerSencillo" />';
      $muestraCamion.=  '<map name="trailerSencillo">
                          <area alt="'.$articulo['1'].'" shape="circle" coords="92,	300,	34" title="1.- '.$articulo['1'].'" />
                          <area alt="'.$articulo['2'].'" shape="circle" coords="92,	384,	33" title="2.- '.$articulo['2'].'" />
                          <area alt="'.$articulo['3'].'" shape="circle" coords="324,	292,	32" title="3.- '.$articulo['3'].'" />
                          <area alt="'.$articulo['4'].'" shape="rect" coords="289,	322,	357,	347" title="4.- '.$articulo['4'].'" />
                          <area alt="'.$articulo['5'].'" shape="circle" coords="324,	375,	33" title="5.- '.$articulo['5'].'" />
                          <area alt="'.$articulo['6'].'" shape="rect" coords="292,	406,	357,	425" title="6.- '.$articulo['6'].'" />
                          <area alt="'.$articulo['7'].'" shape="circle" coords="409,	291,	32" title="7.- '.$articulo['7'].'" />
                          <area alt="'.$articulo['8'].'" shape="rect" coords="376,	321,	439,	341" title="8.- '.$articulo['8'].'" />
                          <area alt="'.$articulo['9'].'" shape="circle" coords="409,	376,	30" title="9.- '.$articulo['9'].'" />
                          <area alt="'.$articulo['10'].'" shape="rect" coords="379,	402,	438,	425" title="10.- '.$articulo['10'].'" />
                          <area alt="'.$articulo['11'].'" shape="circle" coords="620,	294,	33" title="11.- '.$articulo['11'].'" />
                          <area alt="'.$articulo['12'].'" shape="rect" coords="656,	346,	589,	324" title="12.- '.$articulo['12'].'" />
                          <area alt="'.$articulo['13'].'" shape="circle" coords="621,	377,	30" title="13.- '.$articulo['13'].'" />
                          <area alt="'.$articulo['14'].'" shape="rect" coords="588,	405,	653,	425" title="14.- '.$articulo['14'].'" />
                          <area alt="'.$articulo['15'].'" shape="circle" coords="706,	292,	32" title="15.- '.$articulo['15'].'" />
                          <area alt="'.$articulo['16'].'" shape="rect" coords="671,	321,	741,	346" title="16.- '.$articulo['16'].'" />
                          <area alt="'.$articulo['17'].'" shape="circle" coords="706,	376,	29" title="17.- '.$articulo['17'].'" />
                          <area alt="'.$articulo['18'].'" shape="rect" coords="676,	401,	737,	425" title="18.- '.$articulo['18'].'" />
                        </map>';
      break;

      case '3':
        $muestraCamion = '<img class="img-responsive" src="../trailer/full.jpeg" alt="Trailer Full" usemap="#trailerFull" />';
        $muestraCamion.=  '<map name="trailerFull">

                          <area alt="'.$articulo['1'].'" shape="circle" coords="46,	301,	19" title="1.- '.$articulo['1'].'" />
                          <area alt="'.$articulo['2'].'" shape="circle" coords="46,	352,	21" title="2.- '.$articulo['2'].'" />
                          <area alt="'.$articulo['3'].'" shape="circle" coords="191, 297,	20" title="3.- '.$articulo['3'].'" />
                          <area alt="'.$articulo['4'].'" shape="rect" coords="169,	316,	212,	327" title="4.- '.$articulo['4'].'" />
                          <area alt="'.$articulo['5'].'" shape="circle" coords="192,	349,	17" title="5.- '.$articulo['5'].'" />
                          <area alt="'.$articulo['6'].'" shape="rect" coords="173,	363,	211,	377" title="6.- '.$articulo['6'].'" />
                          <area alt="'.$articulo['7'].'" shape="circle" coords="244,	294,	19" title="7.- '.$articulo['7'].'" />
                          <area alt="'.$articulo['8'].'" shape="rect" coords="223,	311,	264,	327" title="8.- '.$articulo['8'].'" />
                          <area alt="'.$articulo['9'].'" shape="circle" coords="243,	348,	17" title="9.- '.$articulo['9'].'" />
                          <area alt="'.$articulo['10'].'" shape="rect" coords="225,	362,	264,	379" title="10.- '.$articulo['10'].'" />
                          <area alt="'.$articulo['11'].'" shape="circle" coords="374,	295,	19" title="11.- '.$articulo['11'].'" />
                          <area alt="'.$articulo['12'].'" shape="rect" coords="356,	313,	398,	328" title="12.- '.$articulo['12'].'" />
                          <area alt="'.$articulo['13'].'" shape="circle" coords="376,	348,	17" title="13.- '.$articulo['13'].'" />
                          <area alt="'.$articulo['14'].'" shape="rect" coords="357,	364,	393,	378" title="14.- '.$articulo['14'].'" />
                          <area alt="'.$articulo['15'].'" shape="circle" coords="428,	295,	20" title="15.- '.$articulo['15'].'" />
                          <area alt="'.$articulo['16'].'" shape="rect" coords="407,	314,	449,	329" title="16.- '.$articulo['16'].'" />
                          <area alt="'.$articulo['17'].'" shape="circle" coords="426,	348,	19" title="17.- '.$articulo['17'].'" />
                          <area alt="'.$articulo['18'].'" shape="rect" coords="409,	364,	447,	378" title="18.- '.$articulo['18'].'" />
                          <area alt="'.$articulo['19'].'" shape="circle" coords="516,	294,	19" title="19.- '.$articulo['19'].'" />
                          <area alt="'.$articulo['20'].'" shape="rect" coords="493,	312,	540,	328" title="20.- '.$articulo['20'].'" />
                          <area alt="'.$articulo['21'].'" shape="circle" coords="515,	350,	17" title="21.- '.$articulo['21'].'" />
                          <area alt="'.$articulo['22'].'" shape="rect" coords="497,	363,	539,	379" title="22.- '.$articulo['22'].'" />
                          <area alt="'.$articulo['23'].'" shape="circle" coords="569,	294,	19" title="23.- '.$articulo['23'].'" />
                          <area alt="'.$articulo['24'].'" shape="rect" coords="549,	310,	589,	328" title="24.- '.$articulo['24'].'" />
                          <area alt="'.$articulo['25'].'" shape="circle" coords="569,	347,	18" title="25.- '.$articulo['25'].'" />
                          <area alt="'.$articulo['26'].'" shape="rect" coords="549,	363,	589,	378" title="26.- '.$articulo['26'].'" />
                          <area alt="'.$articulo['27'].'" shape="circle" coords="699,	293,	21" title="27.- '.$articulo['27'].'" />
                          <area alt="'.$articulo['28'].'" shape="rect" coords="677,	312,	721,	327" title="28.- '.$articulo['28'].'" />
                          <area alt="'.$articulo['29'].'" shape="circle" coords="699,	347,	18" title="29.- '.$articulo['29'].'" />
                          <area alt="'.$articulo['30'].'" shape="rect" coords="679,	363,	720,	379" title="30.- '.$articulo['30'].'" />
                          <area alt="'.$articulo['31'].'" shape="circle" coords="752,	295,	19" title="31.- '.$articulo['31'].'" />
                          <area alt="'.$articulo['32'].'" shape="rect" coords="733,	311,	773,	328" title="32.- '.$articulo['32'].'" />
                          <area alt="'.$articulo['33'].'" shape="circle" coords="752,	348,	18" title="33.- '.$articulo['33'].'" />
                          <area alt="'.$articulo['34'].'" shape="rect" coords="731,	365,	771, 378" title="34.- '.$articulo['34'].'" />
                        </map>';

      break;

      default:
          echo '';
          break;
    }
    echo '</br>';
    echo $muestraCamion;
}





?>
