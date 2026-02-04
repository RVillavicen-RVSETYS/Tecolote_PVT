<?php
define('INCLUDE_CHECK', 1);
require_once('../include/connect.php');
require_once('../assets/scripts/cadenas.php');
require_once('../assets/scripts/Thumb.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$eco = (isset($_POST['noEcoVe'])) ? $_POST['noEcoVe'] : '';
$subMarca = (isset($_POST['submarca'])) ? $_POST['submarca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$poliza = (isset($_POST['poliza'])) ? $_POST['poliza'] : '';
$placas = (isset($_POST['placas'])) ? $_POST['placas'] : '';
$serie = (isset($_POST['serie'])) ? $_POST['serie'] : '';
$tag = (isset($_POST['tag'])) ? $_POST['tag'] : '';
$fechaVeri = (isset($_POST['fechaVeri'])) ? $_POST['fechaVeri'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';
$userReg = $_SESSION['ATZident'];
#print_r($_POST);
#print_r($_FILES);
#echo '<br><br>';

#$matriz = array('doctoIne', 'doctoCurp', 'doctoImss', 'doctoLicencia', 'doctoDomicilio');
#$matrizName = array('INE', 'CURP', 'IMSS', 'LICENCIA', 'COMPROBANTE-DOM');

$sql = "UPDATE vehiculos SET idCatMarca = '$marca', idCatSubMarca = '$subMarca', idPoliza = '$poliza', modelo = '$modelo', idCatTipoVehiculo = '$tipo', placas = '$placas', serie = '$serie',
  estatus = '$estatus', tag = '$tag', fechaVerificacion = '$fechaVeri' WHERE id = '$ident'";
#echo '<br><br>'.$sql.'<br><br>';
$result = mysqli_query($link, $sql) or die(errorBD('Problemas al guardar los Datos. '));

$sql2 = "UPDATE polizas SET idVehiculo = '$ident' WHERE id = '$poliza'";
#echo '<br><br>'.$sql.'<br><br>';
$result2 = mysqli_query($link, $sql2) or die(errorBD('Problemas al guardar los Datos. '));

$newID = $ident;

#--------------------------------------------------------------------------------------------------------------------------------
//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('foto');
$matrizName = array('FOTO');
$matrizName1 = array('FOTO-ECO');
$cont = 0;
$varError = 0;
$contError = '';

$noEmp  = $eco;
$name = eliminar_simbolos($noEmp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Vehiculos/ID-' . $newID . '/';
$carpeta = '../doctos/Vehiculos/ID-' . $newID . '/';
if (!file_exists($carpeta)) {
  mkdir($carpeta, 0777, true);
}

$carpetaOrig = $carpeta . 'original/';
if (!file_exists($carpetaOrig)) {
  mkdir($carpetaOrig, 0777, true);
}

#=======================================================================================

$mat = $matriz[$cont];
$nameMatriz = $matrizName[$cont];
$nameMatriz1 = $matrizName1[$cont];
if ($_FILES[$mat]["error"] > 0) {
  $varError++;
  $contError .= "No se ha cargado el documento <b>" . $mat . "</b>.<br>";
} else {

  $archivo = $_FILES[$mat]['name'];
  $valores = explode(".", $archivo);
  $extension = $valores[count($valores) - 1];

  $fileName = 'ID' . $newID . '-' . $nameMatriz1 . '-' . $name;
  $fileName = str_replace(" ", "_", $fileName) . '.' . $extension;

  $url = $carpeta . $fileName;
  $urlReg = $carpetaAlm . $fileName;

  if ($nameMatriz == 'FOTO') {
    $url = $carpeta . 'original/' . $fileName;
    $urlAvatar = $carpeta . $fileName;
  }

  //--------------------------Se mueven Archivos para trabajarlos ------------------------------
  move_uploaded_file($_FILES[$mat]['tmp_name'], $url);

  if ($nameMatriz == "FOTO") {
    $thumb = new Thumb();
    $thumb->loadImage($url);
    $thumb->save($urlAvatar, 80, false);

    echo "URL Generado: " . $urlAvatar . " <br><br>";
    $urlAvatar2 = str_replace('.' . $extension, '', $urlAvatar);
    $urlAvatar .= '.jpeg';
    $urlAvatar2 .= '.jpeg';

    echo "URL Avatar1: " . $urlAvatar . " <br>";
    echo "URL Avatar2: " . $urlAvatar2 . " <br><br>";

    rename($urlAvatar, $urlAvatar2);
    $urlReg = str_replace('../', '', $urlAvatar2);
  }

  $sql = "UPDATE vehiculos SET $mat = '$urlReg' WHERE id = '$newID'";
  #echo '<br>foto: '.$sql.'<br>';
  mysqli_query($link, $sql) or die(errorCarga('<b>No se pudo cargar la Imagen</b>.'));
}



$_SESSION['ATZmsjSuccesEncargadoVehiculos'] = 'Tu Vehículo se a modificado Corrrectamente.';
header('location: ../Encargado/vehiculos.php');




function errorBD($error)
{
  $_SESSION['ATZmsjSuccesEncargadoVehiculos'] = $error;
  header('location: ../Encargado/vehiculos.php');
  exit(0);
}
