<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
  $ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';
  if ($ident == '') {
    echo '<option>No hubo ninguna coincidencia.</option>';
  } else {
    $sql="SELECT * FROM detVentas
    where idVenta = $ident
    ORDER BY idVenta ASC";
    $res=mysqli_query($link,$sql) or die('<option>Notifica al Administrador.'.$ident.'</option>');

    while ($dat = mysqli_fetch_array($res)) {
      echo $dat['direccionDest'];
    }
  }




 ?>
