<?php
define('INCLUDE_CHECK',1);
include('../assets/scripts/cadenas.php');
require_once('../include/connect.php');
session_start();
$fecha = date('d-m-Y');

$ident = $_POST['ident'];
$peso = (isset($_POST['peso']) AND $_POST['peso'] != '') ? $_POST['peso'] : '';
$precio = (isset($_POST['precio']) AND $_POST['precio'] != '') ? $_POST['precio'] : '';
$casetas = (isset($_POST['casetas']) AND $_POST['casetas'] != '') ? $_POST['casetas'] : '';
$folioCarga = (isset($_POST['folioCarga']) AND $_POST['folioCarga'] != '') ? $_POST['folioCarga'] : '';
$ruta = (isset($_POST['ruta']) AND $_POST['ruta'] != '') ? $_POST['ruta'] : '';
$fechaCarga = (isset($_POST['fechaCarga']) AND $_POST['fechaCarga'] != '') ? $_POST['fechaCarga'] : '';
$fechaEntrega = (isset($_POST['fechaEntrega']) AND $_POST['fechaEntrega'] != '') ? $_POST['fechaEntrega'] : '';
$viaje = (isset($_POST['viaje'])) ? $_POST['viaje'] : '';
$pago = (isset($_POST['pago'])) ? $_POST['pago'] : '';
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
$material = (isset($_POST['material'])) ? $_POST['material'] : '';
#print_r($_POST);
#error_reporting(E_ALL);

if ($peso == '' || $fechaEntrega == '' || $precio == '' || $casetas == '') {
  errorBD('Hay un Error, debes agregar un <b>Peso</b>, un <b>Precio por Tonelada</b>, el <b>Gasto en Casetas</b> y una <b>Fecha de Entrega</b>, inténtalo de Nuevo.');
}

$monto = $peso * $precio;
#echo '<br><br>monto ('.$monto.') = peso ('.$peso.') * precio ('.$precio.')<br><br>';

$sql="UPDATE ventas SET monto = '$monto', peso = '$peso', casetas = '$casetas', precioMaterial = '$precio', fechaCarga = '$fechaCarga', folioCarga = '$folioCarga' , fechaEntrega = '$fechaEntrega', estatusViaje = '$viaje', estatusPago = '$pago' WHERE id = '$ident'";
#  echo '<br>sql:  '.$sql.'<br>';
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

$sql2="UPDATE viajes SET estatus = '$viaje' WHERE idVenta = '$ident'";
#  echo '<br>sql2:  '.$sql2.'<br>';
$result2=mysqli_query($link,$sql2) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));


$newID = $ident;
#print_r($_POST); echo '<br><br>'; print_r($_FILES);
//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('doctoCarga', 'doctoEntrega');
$matrizName = array('Carga', 'Entrega');
$cont=0;
$varError=0;
$contError= '';

$nombreComp = 'Venta-'.$ruta;
$name = eliminar_simbolos($nombreComp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Ventas/ID-'.$newID.'/';
$carpeta = '../doctos/Ventas/ID-'.$newID.'/';
if (!file_exists($carpeta)) {
  mkdir($carpeta, 0777, true);
}

while ($cont <= 1) {
  $mat = $matriz[$cont];
  $nameMatriz = $matrizName[$cont];
#echo '<br>mat: '.$mat.'<br>';
  if ($_FILES[$mat]["error"]>0) {
    $varError ++;
    $contError .= "No se ha cargado el documento <b>".$mat."</b>.<br>";

  }else{

    $archivo = $_FILES[$mat]['name'];
#    echo '<br>archivo: '.$archivo.'<br>';
    $valores = explode(".", $archivo);
    $extension = $valores[count($valores)-1];

    $fileName = 'ID'.$newID.'-'.$nameMatriz;
    $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

    $url = $carpeta.$fileName;
    $urlReg = $carpetaAlm.$fileName;
    $valor[$cont]=$extension;
    $campo='extension'.$cont;
    //--------------------------Se mueven Archivos para trabajarlos ------------------------------
    move_uploaded_file($_FILES[$mat]['tmp_name'], $url);

    $sql = "UPDATE ventas SET $mat = '$urlReg', $campo ='$valor[$cont]' WHERE id = '$newID'";
#    echo '<br>sql3: '.$sql.'<br>';
    mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));

  }
  $cont++;
}

$_SESSION['ATZmsjSuccesEncargadoConVentas'] = 'Tu Venta se a modificado Correctamente.';
header('location: ../Encargado/conVentas.php');

function errorBD($error){
  $_SESSION['ATZmsjEncargadoConVentas'] = $error;
 header('location: ../Encargado/conVentas.php');
  exit(0);
}
?>
