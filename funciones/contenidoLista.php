<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
#error_reporting(E_ALL);
$datovehiculo=$_REQUEST['selVehiculo'];
#echo $datovehiculo;
#error_reporting(E_ALL);
  if ($datovehiculo == '') {
    echo 'No hubo ninguna coincidencia.';
  } else {
    $sql="SELECT	dtsg.*, pro.nombre AS nomPro, stk.noSerie AS Serie, stk.rotulado AS Rotulado, dtsg.posicion, ve.idCatTipoVehiculo AS tipo, cdpt.id AS depto
FROM	detasigna dtsg
INNER JOIN asignaciones asg ON asg.id = dtsg.idAsignacion
INNER JOIN stocks stk ON stk.id = dtsg.idStock
INNER JOIN productos pro ON pro.id = stk.idProducto
INNER JOIN asignavehiculos asve ON asve.id = asg.idAsignaVehiculo
INNER JOIN vehiculos ve ON ve.id = asve.idVehiculo
INNER JOIN operadores ope ON ope.id = asve.idOperador
LEFT JOIN catdeptos cdpt ON cdpt.id = pro.idDepto
WHERE ve.noEconomico = '$datovehiculo' AND dtsg.estatus < 4
ORDER BY pro.nombre ASC";
    #echo '<br>sql = '.$sql.'<br><br>';
    $res=mysqli_query($link,$sql) or die('<option>Notifica al Administrador.</option'.mysqli_error($link));
    #$dat = mysqli_fetch_array($res);


      $content= '

      <input type="hidden" name="vehiculo" id="vehiculo" value="'.$datovehiculo.'">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
          <th class="text-center">#</th>
            <th>Producto</th>
            <th class="text-center">No. de Serie</th>
            <th class="text-center">Rotulado</th>
            <th>Estatus</th>
            <th class="text-center">Posición</th>
            <th class="text-center">Estado</th>
          </tr>
        </thead>
        <tbody id="datosVehiculo" name="datovehiculo" value="'.$datovehiculo.'\">';

$cont = 0;
            while ($dat = mysqli_fetch_array($res)) {
              $estatusText = ($dat['estatus'] == 1) ? '' : 'class=\"text-danger\"' ;
              if ($dat['Rotulado'] > 0) {
                $rot = "Si";
              } else {
                $rot = "No";
              }

              switch ($dat['estatus']) {
                case '1':        $estat = "Bueno";          break;
                case '2':        $estat = "Regular";        break;
                case '3':        $estat = "Malo";           break;
                default:         $estat = "No Encontrado";  break;
              }

              switch ($dat['estatus']) {
                case '1':        $estadoCheck = '<div>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="1" checked><span>Bueno</span>
                    <input type="hidden" name="idStock['.$cont.']" id="idStock['.$cont.']" value="'.$dat['idStock'].'" checked>
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="2"><span>Regular</span>
                    <input type="hidden" name="idStock['.$cont.']" id="idStock['.$cont.'] value="'.$dat['idStock'].'">
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="3"><span>Malo</span>
                  </label>
                <div>';          break;

                case '2':        $estadoCheck = '<div>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="1"><span>Bueno</span>
                    <input type="hidden" name="idStock['.$cont.']" id="idStock['.$cont.']" value="'.$dat['idStock'].'">
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="2" checked><span>Regular</span>
                    <input type="hidden" name="idStock['.$cont.']" id="idStock['.$cont.'] value="'.$dat['idStock'].'" checked>
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="3"><span>Malo</span>
                  </label>
                <div>';        break;

                case '3':        $estadoCheck = '<div>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="1" ><span>Bueno</span>
                    <input type="hidden" name="idStock['.$cont.']" id="idStock['.$cont.']" value="'.$dat['idStock'].'">
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="2"><span>Regular</span>
                    <input type="hidden" name="idStock['.$cont.']" id="idStock['.$cont.'] value="'.$dat['idStock'].'" >
                  </label>
                  <label class="radio-inline radio-styled">
                    <input type="radio" name="calidad['.$cont.']" id="calidad['.$cont.']" value="3" checked><span>Malo</span>
                  </label>
                <div>';           break;
                default:         $estadoCheck = "";  break;
              }
              $dposicion = ($dat['depto'] != '2') ? '' : '<button type="button" class="btn ink-reaction btn-floating-action btn-xs btn-primary"onclick="formEditPosicion('.$dat['id'].','.$datovehiculo.')" data-toggle="modal" data-target="#formEditPosicion">'.$dat['posicion'].'</button>' ;
              $cposicion = ($dat['posicion'] < 1) ? '' : '<button type="button" class="btn ink-reaction btn-floating-action btn-xs btn-info"onclick="formCambiaPosicion('.$dat['id'].','.$datovehiculo.')" data-toggle="modal" data-target="#formCambPosicion"><i class="fa fa-refresh"></i></button>' ;
              $content .='
              <tr '.$estatusText.'>
                <td class="text-center">'.$dat['id'].'</td>
                <td>'.$dat['nomPro'].'</td>
                <td class="text-center">'.$dat['Serie'].'</td>
                <td class="text-center">'.$rot.'</td>
                <td>'.$estat.'</td>
                <td class="text-center">'.$dposicion.' '.$cposicion.'</td>
                <td class="text-center">
                  '.$estadoCheck.'
                  <input type="hidden" name="idStock['.$cont.']" id="idStock['.$cont.']" value="'.$dat['idStock'].'">
                </td>
              </tr>';
              $cont++;
            }
            $cont2=$cont-1;
        $content .= '<div class="row">
        <input type="hidden" name="cont" id="cont" value="'.$cont2.'">
        <h4 class="modal-title" id="muestraDesc"><b></b>'
        .$dat['descr'];
        '</h4>
        </div></tbody>
      </table>';
      echo $content;
    }
?>
