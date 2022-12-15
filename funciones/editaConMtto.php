<?php
define('INCLUDE_CHECK',1);
include('../assets/scripts/cadenas.php');
require_once('../assets/scripts/Thumb.php');
require_once('../include/connect.php');
session_start();
$fecha = date('d-m-Y');

$ident = $_POST['ident'];
$precio = (isset($_POST['precio']) AND $_POST['precio'] != '') ? $_POST['precio'] : '';
$eco = (isset($_POST['eco']) AND $_POST['eco'] != '') ? $_POST['eco'] : '';
$fechaEntrega= (isset($_POST['fechaEntrega']) AND $_POST['fechaEntrega'] != '') ? $_POST['fechaEntrega'] : '';
$userReg = $_SESSION['ATZident'];

if ($precio == '' OR $fechaEntrega == '') {
  errorBD('Hay un Error, debes agregar un <b>Precio</b> y una <b>Fecha de Entrega</b>, inténtalo de Nuevo.');
}
#error_reporting(E_ALL);

#echo '<br>$precio: '.$precio.'<br>';

$sql="UPDATE mttos SET monto = '$precio', fechaEntrega = '$fechaEntrega' WHERE id = '$ident'";
#  echo '<br>sql:  '.$sql.'<br>';
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));


$newID = $ident;
#print_r($_POST); echo '<br><br>'; print_r($_FILES);
//--------------------- Obteniendo extencion del Archivo -------------------
//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('doctoComprobante', 'urlPDF', 'urlXML');
$matrizName = array('Comprobante', 'Factura', 'XML');
$cont = 0;
$varError=0;
$contError= '';

$nombreComp = 'Mtto-'.$eco;
$name = eliminar_simbolos($nombreComp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Mttos/Comprobantes/ID-'.$newID.'/';
$carpeta = '../doctos/Mttos/Comprobantes/ID-'.$newID.'/';
if (!file_exists($carpeta)) {
  mkdir($carpeta, 0777, true);
}
$valor[0]='';$valor[1]='';$valor[2]='';
while ($cont <= 2) {
  $mat = $matriz[$cont];
  $nameMatriz = $matrizName[$cont];
  if ($_FILES[$mat]["error"]>0) {
    $varError ++;
    $contError .= "No se ha cargado el documento <b>".$mat."</b>.<br>";

  }else{

    $archivo = $_FILES[$mat]['name'];
    $valores = explode(".", $archivo);
    $extension = $valores[count($valores)-1];

    $fileName = 'ID'.$newID.'-'.$nameMatriz.'-'.$name;
    $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

    $url = $carpeta.$fileName;
    $urlReg = $carpetaAlm.$fileName;

    //--------------------------Se mueven Archivos para trabajarlos ------------------------------
    move_uploaded_file($_FILES[$mat]['tmp_name'], $url);

$valor[$cont]=$urlReg;
}

$cont++;
}
$sql = "INSERT INTO facturas (doctoComprobante,urlPDF,urlXML,monto,idUserReg,fechaReg,fechaFac)
    VALUES ('$valor[0]', '$valor[1]', '$valor[2]', '$precio', '$userReg', NOW(), '$fechaEntrega')";
#echo '<br><br>facturas: '.$sql.'<br>';
mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));
#echo '<br>-----------------------<br>';
$idFactura = mysqli_insert_id($link);
#echo '<br>$idFactura: '.$idFactura.'<br>';

if ($_FILES[$mat]["error"]>0) {
echo "Error: " . $_FILES[$mat]['error'] . "<br>".$mat;

$error = ' pero <br><b>No se pudo cargar la Imagen</b>';

switch ($_FILES[$mat]["error"]) {
case '1':    errorBD('El Archivo Excede el Tamaño Máximo de Subida (Peso muy Grande): '.$mat);      break;
case '2':    errorBD('El Archivo Excede el Tamaño Máximo de Almacenamiento (Peso muy Grande): '.$mat);      break;
case '3':    errorBD(' El Archivo Fue Sólo Parcialmente Subido: '.$mat);      break;
case '4':    errorBD('No se Subieron Algunos Archivos: ');      break;
case '5':    errorBD('No se Subió el Archivo: '.$mat);      break;
case '6':    errorBD('Falta la Carpeta de Almacenamiento: '.$mat);      break;
case '7':    errorBD('No se Pudo Guardar el Archivo en el Disco: '.$mat);        break;
case '8':    errorBD('Una Extensión Detuvo la Subida del Archivo: '.$mat);        break;

default:
  // code...
  break;
}
} else {
echo 'La Foto no Genera Error.';
//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('url');
$matrizName = array('FOTO');
$matrizName1 = array('FOTO-ENTRADA');
$cont=0;
$varError=0;
$contError= '';

$noEmp = 'Mtto-Eco-'.$eco;
$name = eliminar_simbolos($noEmp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Mttos./Evidencias/ID-'.$newID.'/';
$carpeta = '../doctos/Mttos./Evidencias/ID-'.$newID.'/';
if (!file_exists($carpeta)) {
  mkdir($carpeta, 0777, true);
}

$carpetaOrig = $carpeta.'original/';
if (!file_exists($carpetaOrig)) {
    mkdir($carpetaOrig, 0777, true);
}

while ($cont < 1) {
  $mat = $matriz[$cont];
  $nameMatriz = $matrizName[$cont];
  $nameMatriz1 = $matrizName1[$cont];
  if ($_FILES[$mat]["error"]>0) {
    $varError ++;
    $contError .= "No se ha cargado el documento <b>".$mat."</b>.<br>";

  }else{

    $archivo = $_FILES[$mat]['name'];
    $valores = explode(".", $archivo);
    $extension = $valores[count($valores)-1];

    $fileName = 'ID'.$newID.'-'.$nameMatriz1.'-'.$name;
    $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

    $url = $carpeta.$fileName;
    $urlReg = $carpetaAlm.$fileName;

    if ($nameMatriz == 'FOTO') {
      $url = $carpeta.'original/'.$fileName;
      $urlAvatar = $carpeta.$fileName;
    }

    //--------------------------Se mueven Archivos para trabajarlos ------------------------------
    move_uploaded_file($_FILES[$mat]['tmp_name'], $url);

    if ($nameMatriz == "FOTO") {
      $thumb = new Thumb();
      $thumb->loadImage($url);
      $thumb->save($urlAvatar, 80, false);

      echo"URL Generado: " . $urlAvatar . " <br><br>";
      $urlAvatar2 = str_replace('.'.$extension, '', $urlAvatar);
      $urlAvatar .= '.jpeg';
      $urlAvatar2 .= '.jpeg';

      echo"URL Avatar1: " . $urlAvatar . " <br>";
      echo"URL Avatar2: " . $urlAvatar2 . " <br><br>";

      rename($urlAvatar, $urlAvatar2);
      $urlReg = str_replace('../', '', $urlAvatar2);

    }

    $sql = "INSERT INTO fotos (url,idTabla,tabla) VALUES ('$urlReg', '6', '$ident')";
#      echo '<br> FOTOS: '.$sql.'<br>';
    mysqli_query($link, $sql) or die(errorCarga('<b>No se pudo cargar la Imagen</b>.'));

  }

    $cont++;
}
$sql="UPDATE mttos SET idFactura = '$idFactura' WHERE id = '$ident'";
#  echo '<br>sql:  '.$sql.'<br>';
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  }



$_SESSION['ATZmsjSuccesEncargadoConMttos'] = 'Tu Mantenimiento se a modificada Correctamente.';
header('location: ../Encargado/conMttos.php');

function errorBD($error){
  $_SESSION['ATZmsjEncargadoConMttos'] = $error;
header('location: ../Encargado/conMttos.php');
  exit(0);
}
?>
