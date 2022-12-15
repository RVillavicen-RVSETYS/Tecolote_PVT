<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id=$_POST['ident'];

if ($id == '') {
    echo '<option></option>';
}
else {
  $sql="SELECT mps.id, mps.nombre AS municipio
        FROM catmunicipios mps
        WHERE mps.idCatEstado = '$id'
        ORDER BY mps.nombre ASC";
  $result=mysqli_query($link,$sql) or die('<option value="">Problemas al consultar los municipios.</option>.'.mysqli_error($link));
  while ($row=mysqli_fetch_array($result))
  {
    echo '<option value="'.$row['id'].'">'.$row['municipio'].'</option>';
  }
}

?>
