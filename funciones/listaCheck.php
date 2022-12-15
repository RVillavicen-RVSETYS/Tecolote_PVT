<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
$datovehiculo=$_REQUEST['selVehiculo'];
echo $datovehiculo;

  if ($datovehiculo == '') {
    echo 'No hubo ninguna coincidencia.';
  } else {
    $sql="SELECT ve.*, op.nombre AS opNombre, op.apellidos AS opApellido,
	        ve.noEconomico AS noEco, su.nombre AS nomUsu,
	        su.apellidos AS apeUsu, ve.id AS idVe
          FROM vehiculos ve
          INNER JOIN asignavehiculos av ON av.idVehiculo = ve.id
          INNER JOIN operadores op ON op.id = av.idOperador
          INNER JOIN segusuarios su ON ve.idUserReg
          WHERE ve.idUserReg = su.id AND ve.noEconomico = '$datovehiculo'
          ORDER BY ve.noEconomico ASC";
    //echo '<br>sql = '.$sql.'<br><br>';
    $res=mysqli_query($link,$sql) or die('<option>Notifica al Administrador.</option');


      $content= '<table class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>#</th>
            <th>Vehículo</th>
            <th>Operador</th>
            <th>Recibe</th>
            <th>Entrega</th>
          </tr>
        </thead>
        <tbody id="datosVehiculo" name="datovehiculo" value="'.$datovehiculo.'\">';


            while ($dat = mysqli_fetch_array($res)) {
              $estatus = ($dat['estatus'] == 1) ? '<center class=\"text-success\"  data-toggle=\"tooltip\" data-placement=\"top\"
              title=\"\" data-original-title=\"Activo\"><i class=\"md md-done\"></i></center>' : '<center class=\"text-danger\"
              data-toggle=\"tooltip\" data-placement=\"top\" title=\"\" data-original-title=\"Desactivado\"><i class=\"md md-close\"></i></center>' ;

              $estatusText = ($dat['estatus'] == 1) ? '' : 'class=\"text-danger\"' ;


              $content .='
              <tr '.$estatusText.'>
                <td>'.$dat['id'].'</td>
                <td>'.$dat['noEco'].'</td>
                <td>'.$dat['opNombre'].' '.$dat['opApellido'].'</td>
                <td>'.$dat['nomUsu'].' '.$dat['apeUsu'].'</td>
                <td>'.$dat['opNombre'].' '.$dat['opApellido'].'</td>
              </tr>';
            }

        $content .= '</tbody>
      </table>';
      echo $content;
    }
?>
