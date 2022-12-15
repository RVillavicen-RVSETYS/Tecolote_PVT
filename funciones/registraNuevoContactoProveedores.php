<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = (isset($_POST['newident'])) ? $_POST['newident'] : '' ;
$tabla = (isset($_POST['newtabla'])) ? $_POST['newtabla'] : '' ;
$nombre = (isset($_POST['newnombre'])) ? $_POST['newnombre'] : '' ;
$tel = (isset($_POST['newtelOf'])) ? $_POST['newtelOf'] : '' ;
$cel = (isset($_POST['newcel'])) ? $_POST['newcel'] : '' ;
$mail = (isset($_POST['newcorreo'])) ? $_POST['newcorreo'] : '' ;
#$userReg = $_SESSION['ATZident'];
//print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
//echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
#print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
#echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea

if ($nombre == '' || $tel == '' || $cel == '') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
}

  $sql = "SELECT * FROM contactos WHERE nombre = '$nombre' AND idCatTabla = '7' AND idRegistro='$ident'";
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 1 (nombre). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant>0) {
    errorBD('Ya se encuentra un Contacto con ese nombre: <b>'.$nombre.'<b>.');
  }

  else {
    $sql="INSERT INTO contactos (nombre,telOf,cel,correo,idCatTabla,idRegistro) VALUES ('$nombre','$tel','$cel','$mail','$tabla','$ident')";
    //echo $sql;
    $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

    echo '1|'.$ident;
  }


function errorBD($error){
  echo '0| '.$error;   //Manda el informe del error que se está presentando
  exit(0);
}

?>
