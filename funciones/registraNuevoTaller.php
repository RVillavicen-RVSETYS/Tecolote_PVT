<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$nombre = (isset($_POST['name'])) ? $_POST['name'] : '' ;
$estado = (isset($_POST['newEdo'])) ? $_POST['newEdo'] : '' ;
$municipio = (isset($_POST['newMunicipio'])) ? $_POST['newMunicipio'] : '' ;
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '' ;
$tel = (isset($_POST['tel'])) ? $_POST['tel'] : '' ;
$tel = (isset($_POST['tel'])) ? $_POST['tel'] : '' ;
$referencia = (isset($_POST['referencia'])) ? $_POST['referencia'] : '' ;
$especialidad = (isset($_POST['especialidad'])) ? $_POST['especialidad'] : '' ;
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '' ;
$userReg = $_SESSION['ATZident'];
$rfc=strtoupper($rfc2);
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
#echo '$tel: '.$tel.'<br>';
#echo '$referencia: '.$referencia.'<br>';
#echo '$especialidad' .$especialidad. '<br>';

  $sql = "SELECT * FROM talleres WHERE nombre = '$nombre'";
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 1 (nombre). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant>0) {
    errorBD('Ya se encuentra un Taller con ese nombre: <b>'.$nombre.'<b>.');
  }

  else {
      $sql2="INSERT INTO talleres (nombre, idEstado,idMunicipio,direccion,tel,referencias,idCatEspecialidad,estatus,idUserReg,fechaReg) VALUES ('$nombre', '$estado', '$municipio', '$direccion',  '$tel','referencia', '$especialidad', '1','$userReg',NOW())";
      echo '<br>'.$sql2.'<br>';
      $result=mysqli_query($link,$sql2) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

      $_SESSION['ATZmsjSuccesEncargadoTalleres'] = 'El Taller <b>'.$nombre.'</b> se a creado Corrrectamente.';
      header('location: ../Encargado/talleres.php');
      echo "Listo";
  }


function errorBD($error){
  $_SESSION['ATZmsjEncargadoTalleres'] = $error;
header('location: ../Encargado/talleres.php');
exit(0);
}
?>
