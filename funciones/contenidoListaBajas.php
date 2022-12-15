<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
#error_reporting(E_ALL);
#print_r($_POST);
$datovehiculo= $_POST['ident'];

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
//echo '<br>sql:  '.$sql.'<br>';
  $con=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
?>


<div><h3><?=$con['nombreCOmp'];?></h3>
</div>
<table class="table table-striped table-hover" id="datatable1">
  <thead>
        <tr>
          <th class="text-center">#</th>
          <th>Foto</th>
          <th class="text-center">Articulo</th>
          <th class="text-center">Serie</th>
          <th class="text-center">Estado</th>
          <th class="text-center">Selección</th>
        </tr>
  </thead>
  <tbody>
    <?php

    $cont = 0;
		$num=1;
    while ($con = mysqli_fetch_array($res)) {
      $foto = ($con['foto'] == '') ? 'assets/img/noimg.png' : $con['foto'] ;
      switch ($con['estado']) {
        case '1':    $estado = 'Bueno';		      break;
        case '2':    $estado = 'Regular'; 	    break;
        case '3':    $estado = 'Malo';      		break;
        default:     $estado = 'S/E';           break;
      }

      echo '
      <tr>
        <td class="text-center" >'.$con['idStock'].'</td>
        <td><button type="button" class="btn ink-reaction btn-icon-toggle btn-primary" data-toggle="modal" data-target="#simpleModal" onclick="visualizaImg(\'../'.$foto.'\', \''.$con['nomProd'].'\');"><img class="img-circle width-1" src="../'.$foto.'" alt="IMG"></button></td>
        <td class="text-center" >'.$con['nomProd'].'</td>
        <td class="text-center" >'.$con['serie'].'</td>
        <td class="text-center" >'.$estado.'</td>
        <td class="text-center" >
				<label class="checkbox-inline checkbox-styled tile-text">
	        <input type="checkbox" name="idProducto['.$cont.']" value="'.$con['idStock'].'" ><span>&nbsp;</span>
	      </label></td>
      </tr>';


      $cont++;
			$num++;
    }
    ?>
		<input type="hidden" name="cont" id="cont" value="<?=$cont;?>">
    </tbody>
</table>
