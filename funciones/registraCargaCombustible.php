<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

print_r($_SESSION).'<br><br>';
print_r($_POST).'<br>';

$asignaVehiculo = $_POST['operador'];
$estado = $_POST['estado'];
$gasolinera = $_POST['gasolinera'];
$combustible = $_POST['combustible'];
$litros = $_POST['litros'];
$monto = $_POST['monto'];
$kilometros = $_POST['kilometros'];
$userReg = $_SESSION['ATZident'];
$precio = $monto/$litros;

//$res=mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador.</p>');

echo '<br>';
$sql="INSERT INTO cargacombustible(idGasolinera, idAsignaVehiculo, idCatCombustible, cant, monto, precioLitro, Kilometraje, idUserReg, fechaReg)
      VALUES('$gasolinera', '$asignaVehiculo', '$combustible', '$litros', '$monto', '$precio', '$kilometros', '$userReg', NOW())";
$result=mysqli_query($link,$sql) or die('Problemas al guardar los Datos.'.mysqli_error($link));
echo $sql;
//header('location: ../cargaCombustible.php');
?>
