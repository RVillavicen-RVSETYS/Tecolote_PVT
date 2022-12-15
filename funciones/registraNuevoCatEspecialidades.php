<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$nombre = $_POST['nombre'];

if ($nombre == '') {
  errorBD('Hay un Error debes ingresar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {
  $sql = "SELECT * FROM catespecialidades WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

if ($cant>0) {
    errorBD('Ya se encuentra un Especialidad con ese nombre: <b>'.$nombre.'<b>.');
}
else {
    $sql="INSERT INTO catespecialidades(nombre, estatus) VALUES('$nombre', '1')";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

    $_SESSION['ATZmsjSuccesAdminEspecialidades'] = 'La Especialidad <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Admin/catEspecialidades.php');
  }
}
  function errorBD($error){
    $_SESSION['ATZmsjAdminEspecialidades'] = $error;
    //echo 'cayo';
    header('location: ../Admin/catEspecialidades.php');
    exit(0);
  }
?>
