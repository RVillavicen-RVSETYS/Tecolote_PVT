<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$nombre = $_POST['nombre'];
$costo = $_POST['newc'];
$costo2 = $_POST['newc2'];
$costo3 = $_POST['newc3'];
$costo4 = $_POST['newc4'];
$costo5 = $_POST['newc5'];
$costo6 = $_POST['newc6'];

if ($nombre == '') {
  errorBD('Hay un Error debes ingresar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {
  $sql = "SELECT * FROM casetas WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

if ($cant>0) {
    errorBD('Ya se encuentra una Caseta con ese nombre: <b>'.$nombre.'<b>.');
}
else {
    $sql="INSERT INTO casetas(nombre, costo, costo2, costo3, costo4, costo5, costo6) VALUES('$nombre', '$costo', '$costo2', '$costo3', '$costo4', '$costo5', '$costo6')";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

    $_SESSION['ATZmsjSuccesAdminCatCasetas'] = 'La Caseta <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Admin/catCasetas.php');
  }
}
  function errorBD($error){
    $_SESSION['ATZmsjAdminCatCasetas'] = $error;
    //echo 'cayo';
    header('location: ../Admin/catCasetas.php');
    exit(0);
  }
?>
