<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$nombre = (isset($_POST['newnombre'])) ? $_POST['newnombre'] : '' ;
$empresa = (isset($_POST['newempresa'])) ? $_POST['newempresa'] : '' ;
$tel = (isset($_POST['newtel'])) ? $_POST['newtel'] : '' ;
$rfc2 = (isset($_POST['newrfc'])) ? $_POST['newrfc'] : '' ;
$userReg = $_SESSION['ATZident'];
//print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
//echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
//print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
//echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
$rfc=strtoupper($rfc2);
if ($nombre == '' || $empresa == '' || $tel == '' || $rfc == '') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
}

  $sql = "SELECT * FROM clientes WHERE nombre = '$nombre' AND empresa = '$empresa'";
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 1 (nombre). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant>0) {
    errorBD('Ya se encuentra un Cliente con ese nombre: <b>'.$nombre.'<b> en la empresa: <b>'.$empresa.'<b>.');
  }

  else {
    $sql="INSERT INTO clientes (nombre,empresa,rfc,tel,estatus,idUserReg,fechaReg) VALUES ('$nombre','$empresa','$rfc','$tel','1','$userReg',NOW())";
//echo $sql;
$result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

    $_SESSION['ATZmsjSuccesEncargadoclientes'] = 'El Cliente <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Encargado/clientes.php');
    echo "Listo";
  }



function errorBD($error){
  $_SESSION['ATZmsjEncargadoclientes'] = $error;
  //echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
  header('location: ../Encargado/clientes.php');
  exit(0);
}

?>
