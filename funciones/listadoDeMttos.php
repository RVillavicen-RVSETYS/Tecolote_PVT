<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
#error_reporting(E_ALL);
$mtto = (isset($_POST['ident'])) ? $_POST['ident'] : '';
#echo $compra;
#error_reporting(E_ALL);
  if ($mtto == '') {
    echo 'No hubo ninguna coincidencia.';
  } else {
    $sql="SELECT m.id, CONCAT('Eco - ',ve.noEconomico,', Placas: ',ve.placas) AS vehiculo, CONCAT(ope.nombre,' ',ope.apellidos) AS operador,ctm.nombre AS mtto, csm.nombre AS servicio, pro.nombre AS reparado, m.km,
t.nombre AS taller, m.nombreRecibe, m.descripcion, m.monto, m.fechaEntrega
FROM mttos m
INNER JOIN cattipomttos ctm ON ctm.id = m.idCatTipoMtto
INNER JOIN catserviciosmttos csm on csm.id = m.idServicioMtto
LEFT JOIN stocks stk ON stk.id = m.idStockReparado
LEFT JOIN productos pro ON pro.id = stk.idProducto
INNER JOIN talleres t ON t.id = m.idTaller
INNER JOIN asignavehiculos asgv ON asgv.id = m.idAsignaVehiculo
INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
INNER JOIN operadores ope ON ope.id = asgv.idOperador
WHERE m.id = '$mtto'";
    #echo '<br>sql = '.$sql.'<br><br>';
    $res=mysqli_query($link,$sql) or die('<option>Notifica al Administrador.</option'.mysqli_error($link));
    #$dat = mysqli_fetch_array($res);


      $content= '

      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th>Vehículo</th>
            <th>Operador</th>
            <th>Mantenimiento</th>
            <th>Servicio</th>
            <th class="text-center">Kilometraje</th>
            <th>Taller</th>
            <th>Recibió</th>
            <th>Descripción</th>
            <th class="text-center">Costo</th>
            <th class="text-center">Fecha de Entrega</th>
          </tr>
        </thead>
        <tbody>';

            while ($dat = mysqli_fetch_array($res)) {

              $content .='
              <tr>
                <td>'.$dat['id'].'</td>
                <td>'.$dat['vehiculo'].'</td>
                <td>'.$dat['operador'].'</td>
                <td>'.$dat['mtto'].'</td>
                <td>'.$dat['servicio'].'</td>
                <td>'.$dat['km'].'</td>
                <td>'.$dat['taller'].'</td>
                <td>'.$dat['nombreRecibe'].'</td>
                <td>'.$dat['descripcion'].'</td>
                <td>'.$dat['monto'].'</td>
                <td>'.$dat['fechaEntrega'].'</td>
              </tr>';
            }
        $content .= '</tbody>
      </table>';
      echo $content;
    }
?>
