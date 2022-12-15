<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '' ;
//print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
//echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
//print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
//echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea


if ($nombre == '') {
  errorBD('Hay un Error debes ingresar un <b>Nombre</b>, inténtalo de Nuevo.');

} else {
  $sql = "SELECT * FROM catcombustibles WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant>0) {
    errorBD('Ya se encuentra un tipo de Combustible con ese nombre: <b>'.$nombre.'<b>.');
  } else {
    $sql="INSERT INTO catcombustibles(nombre) VALUES('$nombre')";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

    $_SESSION['ATZmsjSuccesAdminTipoCombustible'] = 'El Tipo de combustible <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Admin/catCombustibles.php');
  }


}

function errorBD($error){
  $_SESSION['ATZmsjAdminTipoCombustible'] = $error;
  //echo 'cayo';
  header('location: ../Admin/catCombustibles.php');
  exit(0);
}

?>
