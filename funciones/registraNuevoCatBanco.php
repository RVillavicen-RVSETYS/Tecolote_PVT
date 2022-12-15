<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '' ;

if ($nombre == '') {
  errorBD('Hay un Error debes ingresar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {
  $sql = "SELECT * FROM catbancos WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant>0) {
      errorBD('Ya se encuentra un Banco con ese nombre: <b>'.$nombre.'<b>.');
  }
  else {
      $sql="INSERT INTO catbancos(nombre) VALUES('$nombre')";
      $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

      $_SESSION['ATZmsjSuccesAdminBancos'] = 'El Banco <b>'.$nombre.'</b> se a creado Corrrectamente.';
      header('location: ../Admin/catBancos.php');
    }
}
  function errorBD($error){
    $_SESSION['ATZmsjAdminBancos'] = $error;
    //echo 'cayo';
    header('location: ../Admin/catBancos.php');
    exit(0);
  }
?>
