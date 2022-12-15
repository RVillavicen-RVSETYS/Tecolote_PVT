<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$nombre = (isset($_POST['newNombre'])) ? $_POST['newNombre'] : '' ;
$estado = (isset($_POST['newEstado'])) ? $_POST['newEstado'] : '' ;
$municipio = (isset($_POST['newMunicipio'])) ? $_POST['newMunicipio'] : '' ;
$direccion = (isset($_POST['newDireccion'])) ? $_POST['newDireccion'] : '' ;
$referencia = (isset($_POST['newReferencia'])) ? $_POST['newReferencia'] : '' ;
$rfc2 = (isset($_POST['newRfc'])) ? $_POST['newRfc'] : '' ;
$credito = (isset($_POST['credito'])) ? $_POST['credito'] : '' ;
$userReg = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;
print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
echo 'nombre: '.$nombre; echo '<br>'; echo 'Estado: '.$estado; echo '<br>'; echo 'municipio: '.$municipio; echo '<br>'; echo 'direccion: '.$direccion; echo '<br>'; echo 'referencia: '.$referencia; echo '<br>'; echo 'rfc: '.$rfc; echo '<br>';
echo '<br>';

$rfc=strtoupper($rfc2);
  $sql = "SELECT * FROM gasolineras WHERE nombre = '$nombre'";
  $res=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 1 (nombre). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($res);
echo 'cant: '.$cant; echo '<br>';
  if ($cant>0) {
    errorBD('Ya se encuentra una Gasolinera con ese nick: <b>'.$nombre.'<b>.');
  }
  else {
    $sql2="INSERT INTO gasolineras (nombre,idCatEstado,idCatMunicipio,direccion,referencia,rfc,estatus,idUserReg,fechaReg,credito) VALUES ('$nombre','$estado', '$municipio','$direccion','$referencia','$rfc','1','$userReg',NOW(),'$credito')";
    echo 'eeeepale: '.$sql2; echo "<br>";
  $result=mysqli_query($link,$sql2) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
  echo "gasolinera creada";


    $_SESSION['ATZmsjSuccesEncargadoGasolineras'] = 'La Gasolinera <b>'.$nombre.'</b> se a creado Corrrectamente.';
  header('location: ../Encargado/gasolineras.php');
    echo "Listo";
  }



function errorBD($error){
  $_SESSION['ATZmsjEncargadoGasolineras'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
  header('location: ../Encargado/gasolineras.php');
  exit(0);
}

?>
