<?php
define('INCLUDE_CHECK',1);
include('../assets/scripts/cadenas.php');
require_once('../include/connect.php');
session_start();
$fecha = date('d-m-Y');

$ident = (isset($_POST['ident']) AND $_POST['ident'] != '') ? $_POST['ident'] : '';
$ase = (isset($_POST['ase']) AND $_POST['ase'] != '') ? $_POST['ase'] : '';
$tipoS = (isset($_POST['tipoS'])) ? $_POST['tipoS'] : '';
$con = (isset($_POST['con']) AND $_POST['con'] != '') ? $_POST['con'] : '';
$fechaCon = (isset($_POST['fechaCon']) AND $_POST['fechaCon'] != '') ? $_POST['fechaCon'] : '';
$fechaVe = (isset($_POST['fechave']) AND $_POST['fechave'] != '') ? $_POST['fechave'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';
$userReg = $_SESSION['ATZident'];
print_r($_POST);
echo '<br><br>';
print_r($_FILES);
echo '<br><br>';
/*if ($ase == '' OR $tipoS == '' OR $con == '' OR $doctoCOn == '' OR $fechaCOn == '' OR $fechaVe=='' OR $ve=='' OR $estatus=='') {
  errorBD('Hay un Error, debes seleccionar un <b>Nombre</b> y un <b>Estado</b> , inténtalo de Nuevo.');
}	*/
echo '<br>fechaCon:  '.$fechaCon.'<br>';
echo '<br>fechaVe:  '.$fechaVe.'<br>';
$sql="UPDATE polizas SET idAseguradora = '$ase', tipoSeguro = '$tipoS', contrato = '$con', fechaContrato = '$fechaCon', fechaVence = '$fechaVe', estatus = '$estatus', fechaReg=NOW(), idUserReg = '$userReg' WHERE id = '$ident'";
echo '<br>sql:  '.$sql.'<br>';

$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
$newID = $ident;

echo '<br>newID:  '.$newID.'<br>';
//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('doctoContrato');
$matrizName = array('Contrato');
$cont=0;
$varError=0;
$contError= '';

$nombreComp = 'Poliza-'.$ase;
$name = eliminar_simbolos($nombreComp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Polizas/ID-'.$newID.'/';
$carpeta = '../doctos/Polizas/ID-'.$newID.'/';
if (!file_exists($carpeta)) {
  mkdir($carpeta, 0777, true);
}

while ($cont < 1) {
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

    $sql = "UPDATE polizas SET $mat = '$urlReg' WHERE id = '$newID'";
    echo '<br>sql2: '.$sql.'<br>';
    mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));

  }
  $cont++;
}

//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('doctoPago');
$matrizName = array('ComprobanteDePago');
$cont=0;
$varError=0;
$contError= '';

$nombreComp = 'Poliza-'.$ase;
$name = eliminar_simbolos($nombreComp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Polizas/ID-'.$newID.'/';
$carpeta = '../doctos/Polizas/ID-'.$newID.'/';
if (!file_exists($carpeta)) {
  mkdir($carpeta, 0777, true);
}

while ($cont < 1) {
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

    $sql = "UPDATE polizas SET $mat = '$urlReg' WHERE id = '$newID'";
    echo '<br>sql2: '.$sql.'<br>';
    mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo capturar el archivo</b>.'));

  }
  $cont++;
}

$_SESSION['ATZmsjSuccesEncargadoPolizas'] = 'Tu Póliza se a modificado Correctamente.';
header('location: ../Encargado/polizas.php');


function errorBD($error){
  $_SESSION['ATZmsjEncargadoPolizas'] = $error;
	header('location: ../Encargado/polizas.php');
  exit(0);
}
?>
