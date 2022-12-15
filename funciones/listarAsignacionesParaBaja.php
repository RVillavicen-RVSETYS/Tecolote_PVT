<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
#error_reporting(E_ALL);
#print_r($_POST);
$operador= $_POST['ident'];
$Empsql = "SELECT ope.id, CONCAT(ope.nombre,' ',ope.apellidos) AS nombreCOmp
				FROM operadores ope
				WHERE ope.id = '$operador'
				ORDER BY nombreCOmp ASC";
$Empres = mysqli_query($link, $Empsql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>'.mysqli_error($link));
$con=mysqli_fetch_array($Empres);

$sql="SELECT stk.id AS idStock, pro.nombre AS nomProd,asg.notaAsigna AS nota,stk.noSerie AS serie, CONCAT(ope.nombre,' ',ope.apellidos) AS nomCompleto, pro.foto,
				dasg.estatus AS estado, dasg.posicion
      FROM stocks stk
      INNER JOIN productos pro ON pro.id = stk.idProducto
      INNER JOIN detasigna dasg ON dasg.idStock = stk.id
      INNER JOIN asignaciones asg ON asg.id = dasg.idASignacion
      INNER JOIN asignavehiculos asgv ON asgv.id = asg.idAsignaVehiculo
			INNER JOIN operadores ope ON ope.id = asgv.idOperador
			WHERE asg.estatus = '2' AND stk.estatus = '2' AND ope.id= '$operador'
      ORDER BY stk.id ASC";
//echo '<br>sql:  '.$sql.'<br>';
  $res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.</p>');
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
          <th class="text-center">Detalle</th>
          <th class="text-center">Estado</th>
					<th class="text-center">Posición</th>
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
			$pos = ($con['posicion'] == '') ? '--' : $con['posicion'] ;
      echo '
      <tr>
        <td class="text-center" >'.$con['idStock'].'</td>
        <td><button type="button" class="btn ink-reaction btn-icon-toggle btn-primary" data-toggle="modal" data-target="#simpleModal" onclick="visualizaImg(\'../'.$foto.'\', \''.$con['nomProd'].'\');"><img class="img-circle width-1" src="../'.$foto.'" alt="IMG"></button></td>
        <td class="text-center" >'.$con['nomProd'].'</td>
        <td class="text-center" >'.$con['serie'].'</td>
        <td class="text-center" >'.$con['nota'].'</td>
        <td class="text-center" >'.$estado.'</td>
				<td class="text-center" >'.$pos.'</td>
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
