<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('../assets/scripts/cadenas.php');
require_once('../assets/scripts/Thumb.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$nombre = (isset($_POST['name'])) ? $_POST['name'] : '' ;
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '' ;
$estado = (isset($_POST['edo'])) ? $_POST['edo'] : '' ;
$municipio = (isset($_POST['municipio'])) ? $_POST['municipio'] : '' ;
$direccion = (isset($_POST['dir'])) ? $_POST['dir'] : '' ;
$personal = (isset($_POST['personal'])) ? $_POST['personal'] : '' ;
$corporativo = (isset($_POST['corporativo'])) ? $_POST['corporativo'] : '' ;
$imss = (isset($_POST['imss'])) ? $_POST['imss'] : '' ;
$telEmergencia = (isset($_POST['telEmergencia'])) ? $_POST['telEmergencia'] : '' ;
$contEmergencia = (isset($_POST['contEmergencia'])) ? $_POST['contEmergencia'] : '' ;
$vigencia = (isset($_POST['vigencia'])) ? $_POST['vigencia'] : '' ;
$fechaNac = (isset($_POST['fechaNac'])) ? $_POST['fechaNac'] : '' ;
$fechaIngreso = (isset($_POST['fechaIngreso'])) ? $_POST['fechaIngreso'] : '' ;
$curp = (isset($_POST['curp'])) ? $_POST['curp'] : '' ;
$sangre = (isset($_POST['sangre'])) ? $_POST['sangre'] : '' ;
#$doctoIne = (isset($_POST['doctoIne'])) ? $_POST['doctoIne'] : '' ;
#$doctoCurp = (isset($_POST['doctoCurp'])) ? $_POST['doctoCurp'] : '' ;
#$doctoDomicilio = (isset($_POST['doctoDomicilio'])) ? $_POST['doctoDomicilio'] : '' ;
#$doctoLicencia = (isset($_POST['doctoLicencia'])) ? $_POST['doctoLicencia'] : '' ;
#$doctoImss = (isset($_POST['doctoImss'])) ? $_POST['doctoImss'] : '' ;
$bonoAnt = (isset($_POST['bonoAnt']) && $_POST['bonoAnt'] == '1') ? $_POST['bonoAnt'] : 0 ;
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '' ;
$userReg = $_SESSION['ATZident'];
#print_r($_POST);
#echo '<br>'.$nombre.'<br>';
#echo $apellidos.'<br>';
#echo $estado.'<br>';
#echo $municipio.'<br>';
#echo $direccion.'<br>';
#echo $personal.'<br>';
#echo $corporativo.'<br>';
#echo $imss.'<br>';
#echo $telEmergencia.'<br>';
#echo $contEmergencia.'<br>';
#echo $vigencia.'<br>';
#echo $fechaNac.'<br>';
#echo $fechaIngreso.'<br>';
#echo $curp.'<br>';
#echo $sangre.'<br>';
#echo '<br>Archivos: ';
#print_r($_FILES);
#echo '<br><br>';

#$matriz = array('doctoIne', 'doctoCurp', 'doctoImss', 'doctoLicencia', 'doctoDomicilio');
#$matrizName = array('INE', 'CURP', 'IMSS', 'LICENCIA', 'COMPROBANTE-DOM');

$sql = "UPDATE operadores SET   nombre = '$nombre', apellidos = '$apellidos', idCatEstado = '$estado',
idCatMunicipio = '$municipio', direccion = '$direccion', telPersonal = '$personal', telCorporativo = '$corporativo',
noImss = '$imss', telEmergencia = '$telEmergencia', contEmergencia = '$contEmergencia', caduLicencia = '$vigencia',
fechaNac = '$fechaNac', fechaIngreso = '$fechaIngreso', bonoAntiguedad = '$bonoAnt', curp = '$curp', tipoSangre = '$sangre', estatus = '$estatus' WHERE id = '$ident'";
echo '<br><br>'.$sql.'<br><br>';
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));

$newID = $ident;

//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
/*$matriz = array('doctoIne', 'doctoCurp', 'doctoImss', 'doctoLicencia', 'doctoDomicilio');
$matrizName = array('INE', 'CURP', 'IMSS', 'LICENCIA', 'COMPROBANTE-DOM');
$cont=0;
$varError=0;
$contError= '';

$nombreComp = $nombre.' '.$apellidos;
$name = eliminar_simbolos($nombreComp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Operadores/ID-'.$newID.'/';
$carpeta = '../doctos/Operadores/ID-'.$newID.'/';
if (!file_exists($carpeta)) {
  mkdir($carpeta, 0777, true);
}

$carpetaOrig = $carpeta.'original/';
if (!file_exists($carpetaOrig)) {
    mkdir($carpetaOrig, 0777, true);
}

while ($cont <= 4) {
  $mat = $matriz[$cont];
  $nameMatriz = $matrizName[$cont];
  if ($_FILES[$mat]["error"]>0) {
    $varError ++;
    $contError .= "No se ha cargado el documento <b>".$mat."</b>.<br>";

  }else{

    $archivo = $_FILES[$mat]['name'];
    $valores = explode(".", $archivo);
    $extension = $valores[count($valores)-1];
    $date=date('Ymdhis');
    $fileName = 'ID'.$newID.'-'.$nameMatriz.'-'.$name.'-'.$date;
    $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

    $url = $carpeta.$fileName;
    $urlReg = $carpetaAlm.$fileName;


    //--------------------------Se mueven Archivos para trabajarlos ------------------------------
    move_uploaded_file($_FILES[$mat]['tmp_name'], $url);
  }
  $cont++;
}

$sql = "UPDATE operadores SET $mat = '$urlReg' WHERE id = '$newID'";
echo '<br>'.$sql.'<br>';
mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));*/

#--------------------------------------------------------------------------------------------------------------------------------
//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('doctoIne', 'doctoCurp', 'doctoImss', 'doctoLicencia', 'doctoDomicilio');
$matrizName = array('INE', 'CURP', 'IMSS', 'LICENCIA', 'COMPROBANTE-DOM');
$cont=0;
$varError=0;
$contError= '';

$nombreComp = $nombre.' '.$apellidos;
$name = eliminar_simbolos($nombreComp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Operadores/ID-'.$newID.'/';
$carpeta = '../doctos/Operadores/ID-'.$newID.'/';
if (!file_exists($carpeta)) {
  mkdir($carpeta, 0777, true);
}

$carpetaOrig = $carpeta.'original/';
if (!file_exists($carpetaOrig)) {
    mkdir($carpetaOrig, 0777, true);
}

while ($cont <= 4) {
  $mat = $matriz[$cont];
  $nameMatriz = $matrizName[$cont];
  if ($_FILES[$mat]["error"]>0) {
    $varError ++;
    $contError .= "No se ha cargado el documento <b>".$mat."</b>.<br>";

  }else{

    $archivo = $_FILES[$mat]['name'];
    $valores = explode(".", $archivo);
    $extension = $valores[count($valores)-1];

    $date=date('Ymdhis');
    $fileName = 'ID'.$newID.'-'.$nameMatriz.'-'.$name.'-'.$date;
    $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

    $url = $carpeta.$fileName;
    $urlReg = $carpetaAlm.$fileName;


    //--------------------------Se mueven Archivos para trabajarlos ------------------------------
    move_uploaded_file($_FILES[$mat]['tmp_name'], $url);

    $sql = "UPDATE operadores SET $mat = '$urlReg' WHERE id = '$newID'";
    echo '<br>$sql4: '.$sql.'<br>';
    mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));
  }
  $cont++;
}


#--------------------------------------------------------------------------------------------------------------------------------
//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('fotos');
$matrizName = array('FOTO');
$matrizName1 = array('FOTO-OPERADOR');
$cont=0;
$varError=0;
$contError= '';

$noEmp  = $nombre.' '.$apellidos;
$name = eliminar_simbolos($noEmp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Operadores/ID-'.$newID.'/';
$carpeta = '../doctos/Operadores/ID-'.$newID.'/';
if (!file_exists($carpeta)) {
mkdir($carpeta, 0777, true);
}

$carpetaOrig = $carpeta.'original/';
if (!file_exists($carpetaOrig)) {
mkdir($carpetaOrig, 0777, true);
}

#=======================================================================================

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

$sql = "UPDATE operadores SET $mat = '$urlReg' WHERE id = '$newID'";
echo '<br>sql5: '.$sql.'<br>';
mysqli_query($link, $sql) or die(errorCarga('<b>No se pudo cargar la Imagen</b>.'));

}



$_SESSION['ATZmsjSuccesEncargadoOperadores'] = 'Tu Operador <b>'.$nombre.'</b> se a modificado Corrrectamente.';
header('location: ../Encargado/operadores.php');




function errorBD($error){
  $_SESSION['ATZmsjEncargadoOperadores'] = $error;
header('location: ../Encargado/operadores.php');
exit(0);
}

?>
