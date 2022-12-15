<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();


$ruta = (isset($_POST['ruta'])) ? $_POST['ruta'] : '' ;
$caseta = (isset($_POST['caseta'])) ? $_POST['caseta'] : '' ;
$caseta2 = (isset($_POST['caseta2'])) ? $_POST['caseta2'] : '' ;

echo '<br>POST: <br>';
print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
for ($i=0;$i<count($caseta);$i++)
{

  $sql2="SELECT * FROM rutacaseta rtcst WHERE id= '$caseta[$i]'";
        $res2=mysqli_query($link,$sql2) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');
}

if ($ruta == '') {
  errorBD('Hay un Error debes seleccionar una <b>Ruta</b>, inténtalo de Nuevo.');
} else {
# viajes --- idAsignaVehiculo, totalKilometros, fechaSalida, fechaRegreso, totalKmPerdido, totalKmPagado
for ($i=0;$i<count($caseta);$i++)
{
  $sql="INSERT INTO rutacaseta (idRuta, idCaseta,tipo)
  VALUES ('$ruta', '$caseta[$i]', '1')";
  echo '<br>Información del sql: <br>';
  echo $sql;
#echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
}
}
if ($ruta == '' || $caseta2 == '') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
} else {
# viajes --- idAsignaVehiculo, totalKilometros, fechaSalida, fechaRegreso, totalKmPerdido, totalKmPagado
for ($i=0;$i<count($caseta2);$i++)
{
  $sql="INSERT INTO rutacaseta (idRuta, idCaseta, tipo)
  VALUES ('$ruta', '$caseta2[$i]','2')";
  echo '<br>Información del sql: <br>';
  echo $sql;
#echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
}
  $_SESSION['ATZmsjSuccesAdminRutasCasetas'] = 'La Asignación se a creado Corrrectamente.';
  header('location: ../Admin/rutasCasetas.php');
  echo "Asignación realizada con éxito";
}


function errorBD($error){
  $_SESSION['ATZmsjAdminRutasCasetas'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
header('location: ../Admin/rutasCasetas.php');
  exit(0);
}

?>
