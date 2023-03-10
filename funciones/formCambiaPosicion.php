<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

/*
echo "<br>";
print_r($_POST);
echo "<br>";
*/
$id = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$datovehiculo = (isset($_POST['eco'])) ? $_POST['eco'] : '' ;

$sql="SELECT cve.id AS tipo, COUNT(comp.id) AS cantComp, ve.noEconomico
      FROM vehiculos ve
      INNER JOIN cattipovehiculos cve ON cve.id = ve.idCatTipoVehiculo
      LEFT JOIN complementos comp ON comp.idVehiculo = ve.id
      WHERE ve.noEconomico = '$datovehiculo'
      ORDER BY ve.noEconomico ASC
      limit 1";
$result=mysqli_query($link,$sql) or die('<span class="text-danger">Error al consultar los datos</span>'.mysqli_error($link));

$lugarActual = "SELECT dasg.posicion, CONCAT(pro.nombre,' (Serie: ',stk.noSerie,')') AS articulo1
      FROM detasigna dasg
			INNER JOIN stocks stk ON stk.id = dasg.idStock
			INNER JOIN productos pro ON pro.id = stk.idProducto
      WHERE dasg.id = '$id'
      limit 1";

      $resDeLugarActual = mysqli_query($link,$lugarActual) or die ('Lo sentimos por los inconvenientes, notifica a tu Administrador');
$posActual = mysqli_fetch_array($resDeLugarActual);
$lugar = ($posActual['posicion'] != '') ? $posActual['posicion'] : '' ;
$informacion = ($posActual['articulo1'] != '') ? $posActual['articulo1'] : '' ;


$dat=mysqli_fetch_array($result);
$camion = 0;
if ($dat['tipo'] == '6') {      $camion = 1;    }
elseif ($dat['tipo'] == '1' && $dat['cantComp'] < '2') {      $camion = 2;   }
elseif ($dat['tipo'] == '1' && $dat['cantComp'] == '3') {      $camion = 3;   }
else {      $camion = 4;    }
#echo 'camion: '.$camion.'<br>';
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
$mresult = mysqli_query($link,$msql) or die('Error al Cargar las coordenadas de los Art??culos Asignados, Notifica al Administrador.');
$articulo['0'] = '';
$cont = 0;
$muestraPosicion = 0;
for ($i=0; $i <= 34; $i++) {
  $articulo[$i] = '';
  $descript[$i] = '';
}
while ($mdato = mysqli_fetch_array($mresult)) {
  $contenido = ($mdato['id'] == $id) ? 'hidden' : '' ;
  $pos = ($mdato['posicion'] == $lugar) ? ' ' : '';
  $posicion = $mdato['posicion'];
  $articulo[$posicion] = $contenido.$pos;
  $descript[$posicion] = ($mdato['articulo'] != '') ? $mdato['articulo'] : '';

}

switch ($camion) {
  case '1':   $muestraPosicion = '

                         <option value="1" '.$articulo['1'].'>1 '.$descript['1'].'</option>
                         <option value="2" '.$articulo['2'].'>2 '.$descript['2'].'</option>
                         <option value="3" '.$articulo['3'].'>3 '.$descript['3'].'</option>
                         <option value="4" '.$articulo['4'].'>4 '.$descript['4'].'</option>
                         <option value="5" '.$articulo['5'].'>5 '.$descript['5'].'</option>
                         <option value="6" '.$articulo['6'].'>6 '.$descript['6'].'</option>
                       ';
                        break;

  case '2':
  $muestraPosicion = '
                      <option value="1" '.$articulo['1'].'>1 '.$descript['1'].'</option>
                      <option value="2" '.$articulo['2'].'>2 '.$descript['2'].'</option>
                      <option value="3" '.$articulo['3'].'>3 '.$descript['3'].'</option>
                      <option value="4" '.$articulo['4'].'>4 '.$descript['4'].'</option>
                      <option value="5" '.$articulo['5'].'>5 '.$descript['5'].'</option>
                      <option value="6" '.$articulo['6'].'>6 '.$descript['6'].'</option>
                      <option value="7" '.$articulo['7'].'>7 '.$descript['7'].'</option>
                      <option value="8" '.$articulo['8'].'>8 '.$descript['8'].'</option>
                      <option value="9" '.$articulo['9'].'>9 '.$descript['9'].'</option>
                      <option value="10" '.$articulo['10'].'>10 '.$descript['10'].'</option>
                      <option value="11" '.$articulo['11'].'>11 '.$descript['11'].'</option>
                      <option value="12" '.$articulo['12'].'>12 '.$descript['12'].'</option>
                      <option value="13" '.$articulo['13'].'>13 '.$descript['13'].'</option>
                      <option value="14" '.$articulo['14'].'>14 '.$descript['14'].'</option>
                      <option value="15" '.$articulo['15'].'>15 '.$descript['15'].'</option>
                      <option value="16" '.$articulo['16'].'>16 '.$descript['16'].'</option>
                      <option value="17" '.$articulo['17'].'>17 '.$descript['17'].'</option>
                      <option value="18" '.$articulo['18'].'>18 '.$descript['18'].'</option>
                    ';
  break;

  case '3':
    $muestraPosicion = '
                      <option value="1"  '.$articulo['1'].'>1 '.$descript['1'].'</option>
                      <option value="2"  '.$articulo['2'].'>2 '.$descript['2'].'</option>
                      <option value="3"  '.$articulo['3'].'>3 '.$descript['3'].'</option>
                      <option value="4"  '.$articulo['4'].'>4 '.$descript['4'].'</option>
                      <option value="5"  '.$articulo['5'].'>5 '.$descript['5'].'</option>
                      <option value="6"  '.$articulo['6'].'>6 '.$descript['6'].'</option>
                      <option value="7"  '.$articulo['7'].'>7 '.$descript['7'].'</option>
                      <option value="8"  '.$articulo['8'].'>8 '.$descript['8'].'</option>
                      <option value="9"  '.$articulo['9'].'>9 '.$descript['9'].'</option>
                      <option value="10" '.$articulo['10'].'>10 '.$descript['10'].'</option>
                      <option value="11" '.$articulo['11'].'>11 '.$descript['11'].'</option>
                      <option value="12" '.$articulo['12'].'>12 '.$descript['12'].'</option>
                      <option value="13" '.$articulo['13'].'>13 '.$descript['13'].'</option>
                      <option value="14" '.$articulo['14'].'>14 '.$descript['14'].'</option>
                      <option value="15" '.$articulo['15'].'>15 '.$descript['15'].'</option>
                      <option value="16" '.$articulo['16'].'>16 '.$descript['16'].'</option>
                      <option value="17" '.$articulo['17'].'>17 '.$descript['17'].'</option>
                      <option value="18" '.$articulo['18'].'>18 '.$descript['18'].'</option>
                      <option value="19" '.$articulo['19'].'>19 '.$descript['19'].'</option>
                      <option value="20" '.$articulo['20'].'>20 '.$descript['20'].'</option>
                      <option value="21" '.$articulo['21'].'>21 '.$descript['21'].'</option>
                      <option value="22" '.$articulo['22'].'>22 '.$descript['22'].'</option>
                      <option value="23" '.$articulo['23'].'>23 '.$descript['23'].'</option>
                      <option value="24" '.$articulo['24'].'>24 '.$descript['24'].'</option>
                      <option value="25" '.$articulo['25'].'>25 '.$descript['25'].'</option>
                      <option value="26" '.$articulo['26'].'>26 '.$descript['26'].'</option>
                      <option value="27" '.$articulo['27'].'>27 '.$descript['27'].'</option>
                      <option value="28" '.$articulo['28'].'>28 '.$descript['28'].'</option>
                      <option value="29" '.$articulo['29'].'>29 '.$descript['29'].'</option>
                      <option value="30" '.$articulo['30'].'>30 '.$descript['30'].'</option>
                      <option value="31" '.$articulo['31'].'>31 '.$descript['31'].'</option>
                      <option value="32" '.$articulo['32'].'>32 '.$descript['32'].'</option>
                      <option value="33" '.$articulo['33'].'>33 '.$descript['33'].'</option>
                      <option value="34" '.$articulo['34'].'>34 '.$descript['34'].'</option>
                    ';

  break;

  default:
       $muestraPosicion = '------';
      break;
}



?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaPosicionLabel"><b>Editar Posici??n</h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/cambiaPosicion.php">
    <div class="modal-body" id="editaPosicionBody">

      <div class="form-group">
        <div class="col-sm-3">
          <label for="depto" class="control-label">Posici??n Actual</label>
        </div>
        <div class="col-sm-9">
            <label><h4><strong><?=$lugar.' '.$informacion;?></strong></h4></label>
            <input type="hidden" name="posicionActual" id="posicionActual" value="<?=$lugar;?>">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="depto" class="control-label">Posici??n</label>
        </div>
        <div class="col-sm-9">
          <select name="posicion" id="posicion" class="form-control" placeholder="Selecciona una Posici??n" style="font-size: 1.12em" required>
            <?=$muestraPosicion;?>
         </select>
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" name="ident" value="<?=$id;?>">
        <input type="hidden" name="idVehiculo" value="<?=$datovehiculo;?>">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Modificar</button>
      </div>
  </form>
