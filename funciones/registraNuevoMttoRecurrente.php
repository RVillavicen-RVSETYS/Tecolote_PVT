<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

#tipoVehiculo, tipoMtto, tipoServicio, categoria1, categoria2, km, rangoKm, rantoTiempo, tipoTiempo1, tipoTiempo2, tipoTiempo3

$tipoVehiculo = (isset($_POST['tipoVehiculo'])) ? $_POST['tipoVehiculo'] : '' ;
$tipoMtto = (isset($_POST['tipoMtto'])) ? $_POST['tipoMtto'] : '' ;
$tipoServicio = (isset($_POST['tipoServicio'])) ? $_POST['tipoServicio'] : '' ;
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '' ;
$km = (isset($_POST['km'])) ? $_POST['km'] : '' ;
$rangoKm = (isset($_POST['rangoKm'])) ? $_POST['rangoKm'] : '' ;
$rangoTiempo = (isset($_POST['rangoTiempo'])) ? $_POST['rangoTiempo'] : '' ;
$tipoTiempo = (isset($_POST['tipoTiempo'])) ? $_POST['tipoTiempo'] : '' ;
$userReg = $_SESSION['ATZident'];
#print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
#echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
#print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
#echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea

if ($tipoVehiculo == '' || $tipoMtto == '' || $tipoServicio == '' || $categoria == '') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
#  echo '<br>cayo: '.$error.'<br>';   //Manda el informe de la variable error que se está presentando
} else {
    $sql="INSERT INTO mttosrecurrentes (idVehiculo, idTipoMtto, idCatServicioMtto, recurrente, tiempo, tipoTiempo, kilometraje, notRangoKilo, estatus, idUserReg, fechaReg) VALUES ('$tipoVehiculo','$tipoMtto','$tipoServicio','$categoria','$rangoTiempo','$tipoTiempo', '$km', '$rangoKm', '1', '$userReg', NOW())";
#echo '<br>sql: '.$sql.'<br>';
$result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión (Inserción) '.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

    $_SESSION['ATZmsjSuccesAdminMttosRecurrente'] = 'El Mantenimiento se a creado Corrrectamente.';
    header('location: ../Admin/mttosRecurrente.php');
    echo "Listo";
  }



function errorBD($error){
  $_SESSION['ATZmsjAdminMttosRecurrente'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
  header('location: ../Admin/mttosRecurrente.php');
  exit(0);
}

?>
