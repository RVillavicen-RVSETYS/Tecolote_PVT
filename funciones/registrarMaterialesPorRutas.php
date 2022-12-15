<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

#cliente, ruta, precio, material
$ruta = (isset($_POST['ruta'])) ? $_POST['ruta'] : '' ;
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '' ;
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '' ;
$material = (isset($_POST['material'])) ? $_POST['material'] : '' ;

#echo '<br>POST: <br>';
#print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)

if ($ruta == '' || $precio == '') {
  errorBD('Hay un Error, faltan datos, inténtalo de Nuevo.');
} else {

  $sql="INSERT INTO preciomateriales (idCliente, idRuta, idCatMaterial, precio)
  VALUES ('$cliente', '$ruta', '$material', '$precio')";
#  echo '<br>sql: <br>';
#  echo $sql;
#echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

  $_SESSION['ATZmsjSuccesAdminPrecioMaterialRuta'] = 'La Asignación se a creado Corrrectamente.';
  header('location: ../Admin/precioMaterialRuta.php');
  echo "Asignación realizada con éxito";

}


function errorBD($error){
  $_SESSION['ATZmsjAdminPrecioMaterialRuta'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
header('location: ../Admin/precioMaterialRuta.php');
  exit(0);
}

?>
