<?php
function ticketDeVentas($ident){
  require('../include/connect.php');
  #print_r($_POST);
  #echo '<br>$ident de ticketDeVentas: '.$ident;

  $sql="SELECT vnts.*, ope.nombre AS nomOpe, ope.apellidos AS apeOpe, ctm.nombre AS nomMat, clnt.nombre AS nomCliente,
	       ve.noEconomico AS noEco, ve.placas, ru.destino1 AS d1, ru.destino2 AS d2, ru.destino3 AS d3, CONCAT(usr.nombre,' ',usr.apellidos) AS autoriza
         FROM ventas vnts
         LEFT JOIN clientes clnt ON clnt.id = vnts.idCliente
         LEFT JOIN catmateriales ctm ON ctm.id = vnts.idCatMaterial
         LEFT JOIN viajes vjs ON vjs.idVenta = vnts.id
         LEFT JOIN asignavehiculos asgve ON asgve.id = vjs.idAsignaVehiculo
         LEFT JOIN operadores ope ON ope.id = asgve.idOperador
         LEFT JOIN vehiculos ve ON ve.id = asgve.idVehiculo
         LEFT JOIN rutas ru ON ru.id = vnts.idRuta
         LEFT JOIN segusuarios usr ON usr.id = vnts.idUserReg
         WHERE vnts.id = '$ident'";
#  echo $sql;
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al Consultar los Datos del Ticket.'.mysqli_error($link)));
  $var = mysqli_fetch_array($result);
  if ($var['d3']!='') {
    $ruta = $var['d1'].'-'.$var['d2'].'-'.$var['d3'];
  } else {
    $ruta = $var['d1'].'-'.$var['d2'];
  }
  switch ($var['tipo']) {
    case 'costo':
      $tipo = 'Auto/Pickup';
    break;

    case 'costo2':
      $tipo = 'Volteo';
    break;

    case 'costo3':
      $tipo = 'Sencillo';
    break;

    case 'costo4':
      $tipo = 'Full';
    break;

    default:
      $tipo = 'Faltan Datos';
      break;
  }

  echo '<table border="0" style="font-size:13px" width="270px">';
  cabeceraTkt();
  echo '<tr>
          <td colspan="2" style="font-size:14px"><br>'.$var['fechaReg'].'</td>
          <td align="right" style="font-size:17px"><br><b>Folio: '.$var['id'].'</b></td>
        </tr>
        <tr><th colspan="3" align="center" style="font-size:16px"><br>Cliente: <br>'.$var['nomCliente'].'<br></th></tr>

        <tr><th colspan="3" align="center" style="font-size:16px"><br>Detalle de la Venta</th></tr>
        <tr><td colspan="2" style="font-size:16px"><br>Destino: </td><td><br><strong>'.$ruta.'</strong></td></tr>
        <tr><td colspan="2" style="font-size:17px">Transporta: </td><td style="font-size:17px"><strong>'.$var['nomMat'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:17px">Fecha Carga: </td><td style="font-size:17px"><strong>'.$var['fechaCarga'].'</strong></td></tr>
    		<tr><td colspan="2" style="font-size:16px">Vehículo: </td><td><strong>'.$var['noEco'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:16px">Placas: </td><td><strong>'.$var['placas'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:16px">Operador: </td><td><strong>'.$var['nomOpe'].' '.$var['apeOpe'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:16px">Tipo de Vehículo: </td><td><strong>'.$tipo.'</strong></td></tr>
    		<tr><td colspan="4" align="center" style=" margin-top:15px; padding-top:50px; "><hr aling="center" size="2"></td></tr>
    		<tr><th colspan="4" align="center">Generado por: '.$var['autoriza'].'<br></th></tr>
    		<tr><td colspan="4" align="center" style=" margin-top:15px; padding-top:50px; "><hr aling="center" size="2"></td></tr>
        <tr><th colspan="4" align="center">Firma Autoriza <br></th></tr>';


}


function cabeceraTkt(){
#  if ($pag == '1') {
#    $direccion = '../ventas.php';
#  } else {
#    $direccion = '../Encargado/conVentas.php';
#  }

  echo '
		<tr>
			<th colspan="4" align="center"><a href="../ventas.php"><img class="img-circle" src="../favicon.ico" width="100px"></a></th>
		</tr>
		<tr>
    	<th colspan="4" align="center" style="font-size:18px">AUTOTEZA</th>
	  </tr>
		<tr>
    	<th colspan="4" align="center" style="font-size:12px">Axochiapan Mor. México</th>
	  </tr>
    <tr>
			<td colspan="4"></td>
		</tr>';
}

?>
