<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();
$nombre = $_POST['nombre'];
#print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)

if ($nombre == '') {
  errorBD('Hay un Error debes ingresar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {
  $sql = "SELECT * FROM catmateriales WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);
#echo '<br>sql: '.$sql.'<br>';
if ($cant>0) {
    errorBD('Ya se encuentra un Material con ese nombre: <b>'.$nombre.'<b>.');
}
else {
    $sql="INSERT INTO catmateriales(nombre, estatus) VALUES('$nombre', '1')";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
#echo '<br>sql: '.$sql.'<br>';
    $_SESSION['ATZmsjSuccesAdminMateriales'] = 'El Material <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Admin/catMateriales.php');
  }
}
  function errorBD($error){
    $_SESSION['ATZmsjAdminMateriales'] = $error;
    //echo 'cayo';
    header('location: ../Admin/catMateriales.php');
    exit(0);
  }
?>
