<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$cont = (isset($_POST['cont'])) ? $_POST['cont'] : '' ;
$idStock = (isset($_POST['idStock'])) ? $_POST['idStock'] : '' ;
$calidad = (isset($_POST['calidad'])) ? $_POST['calidad'] : '' ;
$datovehiculo = (isset($_POST['vehiculo'])) ? $_POST['vehiculo'] : '' ;
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '' ;
$userReg = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;
print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
echo 'Vehiculo: '.$datovehiculo.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
echo 'descripcion: '.$descripcion.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
  $sql2 = "SELECT ve.*, asgv.idOperador AS opera, asgv.idVehiculo AS vehi
          FROM vehiculos ve
          INNER JOIN asignavehiculos asgv ON asgv.idVehiculo = ve.id
          WHERE ve.noEconomico = '$datovehiculo'";
  $res=mysqli_query($link,$sql2) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');
  $dat=mysqli_fetch_array($res);
  $operador= $dat['opera'];
  $vehiculo = $dat['vehi'];

if ($descripcion == '' || $datovehiculo == '') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
}
else {
  $sql1="INSERT INTO checklist (descripcion, idVehiculo, idOperador, idUserReg, fechaReg, recibeEntrega) VALUES ('$descripcion','$vehiculo','$operador','$userReg',NOW(),$userReg)";
  echo '<br>sql1: '.$sql.'<br>';
$result=mysqli_query($link,$sql1) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
$idCheckList = mysqli_insert_id($link);

for ($i=0; $i <= $cont; $i++) {
  $sql2="UPDATE detasigna SET estatus = '$calidad[$i]' WHERE idStock = '$idStock[$i]'";
  echo '<br>sql12 '.$sql2.'<br>';
    $result2=mysqli_query($link,$sql2) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
}

for ($i=0; $i <= $cont; $i++) {
  $sql3="INSERT INTO detallecheck (idCheckList, idStock, estatus) VALUES ('$idCheckList','$idStock[$i]','$calidad[$i]')";
  echo '<br>sql3: '.$sql3.'<br>';
    $result3=mysqli_query($link,$sql3) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
}
    $_SESSION['ATZmsjSuccesEncargadoCkeckList'] = 'La revisión se a Capturado Corrrectamente.';
    header('location: ../Encargado/checkList.php');
    echo "Ruta creada";
}



function errorBD($error){
  $_SESSION['ATZmsjEncargadoCkeckList'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
 header('location: ../Encargado/checkList.php');
  exit(0);
}

?>
