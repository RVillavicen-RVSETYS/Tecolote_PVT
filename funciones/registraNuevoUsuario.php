<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$nombre = (isset($_POST['name'])) ? $_POST['name'] : '' ;
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '' ;
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '' ;
$password1 = (isset($_POST['password1'])) ? $_POST['password1'] : '' ;
$password2 = (isset($_POST['password2'])) ? $_POST['password2'] : '' ;
$nivel = (isset($_POST['nivel'])) ? $_POST['nivel'] : '' ;
$userReg = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;
print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
//echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea

if ($nombre == '' || $apellidos == '' || $usuario == '' || $password1 == '' || $password2 == '' || $nivel == '') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
}

  $sql = "SELECT * FROM segusuarios WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 1 (nombre). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant>0) {
    errorBD('Ya se encuentra un usuario con ese nombre: <b>'.$nombre.' '.$apellidos.'<b>.');
  }

  $sql2 = "SELECT * FROM segusuarios WHERE usuario = '$usuario'";
  $result2=mysqli_query($link,$sql2) or die(errorBD('Error en la conexión 2 (usuario). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant2 = mysqli_num_rows($result2);

  if ($cant2>0) {
    errorBD('Ya se encuentra un usuario con ese nick: <b>'.$usuario.'<b>.');
  }
  else {
    $sql="INSERT INTO segusuarios (nombre,apellidos,usuario,pass,idNivel,estatus,idUserReg,fechaReg) VALUES ('$nombre','$apellidos','$usuario',MD5('$password2'),'$nivel','1','$userReg',NOW())";
echo $sql;

$result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

    $_SESSION['ATZmsjSuccesAdminUsuarios'] = 'El Usuario <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Admin/usuarios.php');
    echo "Listo";
  }



function errorBD($error){
  $_SESSION['ATZmsjAdminUsuarios'] = $error;
  //echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
  header('location: ../Admin/usuarios.php');
  exit(0);
}

?>
