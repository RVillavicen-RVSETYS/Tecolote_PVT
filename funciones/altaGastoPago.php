<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$viajeGasto = (isset($_POST['vGasto'])) ? $_POST['vGasto'] : '' ;
$puntoGasto = (isset($_POST['pGasto'])) ? $_POST['pGasto'] : '' ;
$dGasto = (isset($_POST['dGasto'])) ? $_POST['dGasto'] : '' ;
$precioGasto = (isset($_POST['prGasto'])) ? $_POST['prGasto'] : '' ;

$viajePago = (isset($_POST['vPago'])) ? $_POST['vPago'] : '' ;
$puntoPago = (isset($_POST['pPago'])) ? $_POST['pPago'] : '' ;
$dPago = (isset($_POST['dPago'])) ? $_POST['dPago'] : '' ;
$precioPago = (isset($_POST['prPago'])) ? $_POST['prPago'] : '' ;
$userReg = $_SESSION['ATZident'];
//print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
//echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
//print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
//echo '<br>';
//print_r($puntoGasto,$detalleGasto);
//echo '<br>';
//print_r($precioGasto);
//echo '<br>';

//echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea

#============Se compara sí los campos están vacíos========
#if ($viajeGasto == '' || $puntoGasto == '' || $descripcionGasto == '' ||
#  $precioGasto == '' || $viajePago == '' || $puntoPago == '' || $descripcionPago == '' || $precioPago == '') {
#  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
#}

//=========== Se selecciona el idDetalleViaje de la tabla 'detalleviajes' y se captura en $cons y $cons2

if ($precioGasto > 0) {
//echo $idDetalle;
//echo '<br>';
//echo $idDetalle2;
$sql2="SELECT v.*, dv.id AS dViaje
      FROM viajes v
      INNER JOIN detalleviajes dv On v.id = dv.idViaje
      WHERE dv.idViaje = '$viajeGasto'";

$res=mysqli_query($link,$sql2) or die('<option>Notifica al Administrador.</option');
$d = mysqli_fetch_array($res);
$dGasto = $d["dViaje"];
//echo '<br>';
//print_r($dGasto);
//echo '<br>';
$sql="INSERT INTO gastosextra (idViaje,idDetalleViaje,tipo,descripcion,punto,monto,estatus,idUserReg,fechaReg) VALUES ('$viajeGasto','$dGasto','1','$descripcionGasto','$puntoGasto','$precioGasto','1','$userReg',NOW())";
//echo $sql;
$result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
print_r($sql);
  $_SESSION['ATZmsjSuccesAuxiliarGastos'] = 'El Gasto se ha capturado Corrrectamente.';
header('location: ../gastos.php');
  echo "Listo";
  }

else {
  $sql2="SELECT v.*, dv.id AS dViaje
        FROM viajes v
        INNER JOIN detalleviajes dv On v.id = dv.idViaje
        WHERE dv.idViaje = '$viajePago'";

        $res=mysqli_query($link,$sql2) or die('<option>Notifica al Administrador.</option');
        $d = mysqli_fetch_array($res);
        $dPago = $d["dViaje"];
        print_r($dPago);
$sql2="INSERT INTO gastosextra (idViaje,idDetalleViaje,tipo,descripcion,punto,monto,estatus,idUserReg,fechaReg) VALUES ('$viajePago','$dPago','2','$descripcionPago','$puntoPago','$precioPago','1','$userReg',NOW())";
//echo $sql;
$result=mysqli_query($link,$sql2) or die(errorBD('Error en la conexión'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
print_r($sql2);
  $_SESSION['ATZmsjSuccesAuxiliarGastos'] = 'El Pago se ha capturado Corrrectamente.';
  header('location: ../gastos.php');
  echo "Listo";
  }


function errorBD($error){
  $_SESSION['ATZmsjAuxiliarGastos'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
  header('location: ../gastos.php');
  exit(0);
}

?>
