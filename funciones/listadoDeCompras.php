<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
#error_reporting(E_ALL);
$compra = (isset($_POST['ident'])) ? $_POST['ident'] : '';
#echo $compra;
#error_reporting(E_ALL);
  if ($compra == '') {
    echo 'No hubo ninguna coincidencia.';
  } else {
    $sql="SELECT dcmp.id, pro.nombre, dcmp.noSerie, dcmp.precio, cmp.fechaCompra
          FROM compras cmp
          INNER JOIN detcompras dcmp ON dcmp.idCompra = cmp.id
          INNER JOIN productos pro ON pro.id = dcmp.idProducto
          WHERE cmp.id = '$compra'
          ORDER BY pro.nombre ASC";
    #echo '<br>sql = '.$sql.'<br><br>';
    $res=mysqli_query($link,$sql) or die('<option>Notifica al Administrador.</option'.mysqli_error($link));
    #$dat = mysqli_fetch_array($res);


      $content= '
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Producto</th>
            <th>No. de Serie</th>
            <th>Precio</th>
            <th>Fecha de Compra</th>
          </tr>
        </thead>
        <tbody>';

            while ($dat = mysqli_fetch_array($res)) {

              $content .='
              <tr>
                <td>'.$dat['id'].'</td>
                <td>'.$dat['nombre'].'</td>
                <td>'.$dat['noSerie'].'</td>
                <td>'.$dat['precio'].'</td>
                <td>'.$dat['fechaCompra'].'</td>
              </tr>';
            }
        $content .= '</tbody>
      </table>';
      echo $content;
    }
?>
