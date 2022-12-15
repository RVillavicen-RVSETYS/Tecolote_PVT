<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id=$_POST['id'];

if ($id == '') {
    echo '<option></option>';
}
else {
  $sql="SELECT gas.id, CONCAT(gas.nombre, ' - Mpo: ', mpo.nombre) AS nombre
          FROM gasolineras gas
          INNER JOIN catmunicipios mpo ON gas.idCatMunicipio = mpo.id
          WHERE gas.idCatEstado = '$id' AND estatus = 1
          ORDER BY gas.nombre, mpo.nombre ASC";
  $result=mysqli_query($link,$sql) or die('<option value="">Problemas al consultar las Gasolineras.'.mysqli_error($link).'</option>.');
  while ($row=mysqli_fetch_array($result))
  {
    echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
  }
}

?>
