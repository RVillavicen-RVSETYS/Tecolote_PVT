<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$nombre = (isset($_POST['name'])) ? $_POST['name'] : '' ;
$estado = (isset($_POST['newEdo'])) ? $_POST['newEdo'] : '' ;
$municipio = (isset($_POST['newMunicipio'])) ? $_POST['newMunicipio'] : '' ;
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '' ;
$banco = (isset($_POST['banco'])) ? $_POST['banco'] : '' ;
$claBe = (isset($_POST['claBe'])) ? $_POST['claBe'] : '' ;
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '' ;
$userReg = $_SESSION['ATZident'];

#print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
#echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
#print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
#echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
#echo '$ident: '.$ident.'<br>';
#echo '$nombre: '.$nombre.'<br>';
#echo '$rfc: '.$rfc.'<br>';
#echo '$estado: '.$estado.'<br>';
#echo '$municipio: '.$municipio.'<br>';
#echo '$direccion: '.$direccion.'<br>';
#echo '$contacto: '.$contacto.'<br>';
#echo '$banco: '.$banco.'<br>';
#echo '$claBe: '.$claBe.'<br>';
  $sql = "SELECT * FROM proveedores WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 1 (nombre). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant>0) {
    errorBD('Ya se encuentra un Proveedor con ese nombre: <b>'.$nombre.'<b>.');
  }

  else {
      $sql2="INSERT INTO proveedores (nombre,idEstado,idMunicipio,direccion,idBanco,claBe,estatus,idUserReg,fechaReg) VALUES ('$nombre','$estado', '$municipio', '$direccion',  '$banco', '$claBe', '1','$userReg',NOW())";
      echo '<br>'.$sql2.'<br>';
      $result=mysqli_query($link,$sql2) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

      $_SESSION['ATZmsjSuccesEncargadoProveedores'] = 'El Proveedor <b>'.$nombre.'</b> se a creado Corrrectamente.';
      header('location: ../Encargado/proveedores.php');
      echo "Listo";
  }


function errorBD($error){
  $_SESSION['ATZmsjEncargadoProveedores'] = $error;
header('location: ../Encargado/proveedores.php');
exit(0);
}
?>
