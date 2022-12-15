<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();


$vehiculo = (isset($_POST['vehiculo'])) ? $_POST['vehiculo'] : '' ;
$venta = (isset($_POST['venta'])) ? $_POST['venta'] : '' ;

echo '<br>POST: <br>';
print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
for ($i=0;$i<count($venta);$i++)
{

  $sql2="SELECT * FROM ventas vnt WHERE id= '$venta[$i]'";
        $res2=mysqli_query($link,$sql2) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');
        	while ($dat2 = mysqli_fetch_array($res2)) {
            #$fechaSalida[$i] = $dat2['fechaCarga'];
            #$fechaEntrega[$i] = $dat2['fechaEntrega'];
            $Kilometraje[$i] = $dat2['11'];
            #echo "<br> venta " .$i. "---> " .$venta[$i];
            #echo "<br> salida " .$i. "---> " .$fechaSalida[$i];
            #echo "<br> entrega " .$i. "---> " .$fechaEntrega[$i];
            #echo "<br> km " .$i. "---> " .$Kilometraje[$i];
}}
#echo '<br>';
#print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
#echo '<br>Sesion: <br>';  //sirve para mostrar la siguiente información en otro parrafo
#print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
//echo '<br>$userReg: <br>';
//echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
//echo 'idOperador: '.$idOp.' ---- idVehiculo: '.$idVehi.' ---- fecha: '.$fecha.' ---- idDolly: '.$idDolly.' ---- '.'<br>';

if ($vehiculo == '' || $venta == '') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
} else {
# viajes --- idAsignaVehiculo, totalKilometros, fechaSalida, fechaRegreso, totalKmPerdido, totalKmPagado
for ($i=0;$i<count($venta);$i++)
{
  $sql="INSERT INTO viajes (idAsignaVehiculo, totalKilometros, idVenta)
  VALUES ('$vehiculo', '$Kilometraje[$i]', '$venta[$i]')";
  echo '<br>Información del sql: <br>';
  echo $sql;
#echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 2 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
}
  $_SESSION['ATZmsjSuccesEncargadoAsignaViaje'] = 'La Asignación se a creado Corrrectamente.';
  header('location: ../Encargado/asignaViajes.php');
  echo "Asignación realizada con éxito";
}


function errorBD($error){
  $_SESSION['ATZmsjEncargadoAsignaViaje'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
header('location: ../Encargado/asignaViajes.php');
  exit(0);
}

?>
