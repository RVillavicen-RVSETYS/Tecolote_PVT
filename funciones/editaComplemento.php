<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('../assets/scripts/cadenas.php');
require_once('../assets/scripts/Thumb.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '' ;
$vehiculo = (isset($_POST['vehiculo'])) ? $_POST['vehiculo'] : '' ;
$veAnterior = (isset($_POST['veAnterior'])) ? $_POST['veAnterior'] : '' ;
$subMarca = (isset($_POST['submarca'])) ? $_POST['submarca'] : '' ;
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '' ;
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '' ;
$poliza = (isset($_POST['poliza'])) ? $_POST['poliza'] : '' ;
$serie = (isset($_POST['serie'])) ? $_POST['serie'] : '' ;
$placas = (isset($_POST['placas'])) ? $_POST['placas'] : '' ;
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '' ;
$userReg = $_SESSION['ATZident'];
print_r($_POST);
#print_r($_FILES);
#echo '<br><br>';

#$matriz = array('doctoIne', 'doctoCurp', 'doctoImss', 'doctoLicencia', 'doctoDomicilio');
#$matrizName = array('INE', 'CURP', 'IMSS', 'LICENCIA', 'COMPROBANTE-DOM');

$sql = "UPDATE complementos SET idCatMarca = '$marca', serie = '$serie', idCatSubMarca = '$subMarca', idPoliza = '$poliza', modelo = '$modelo', tipo = '$tipo', placas = '$placas',
  estatus = '$estatus', idVehiculo = '$vehiculo' WHERE id = '$ident'";
#echo '<br><br>'.$sql.'<br><br>';

########   Consulto para obtener el número de complementos que tiene el vehículo anterior para restarlo y el actual para sumarlo
$avalor=0;
$avalor2=0;
$xsql = "SELECT * FROM vehiculos WHERE id = '$veAnterior'";
$xres = mysqli_query($link,$xsql) or die('<p class="text-danger">Notifica al Administrador</p>');
$adato=mysqli_fetch_array($xres);
$avalor2= $adato['complementos'];
echo '<br><br>$avalor2: '.$avalor2.'<br><br>';
$avalor= $avalor2 - 1;
echo '<br><br>$avalor: '.$avalor.'<br><br>';


$ysql = "SELECT * FROM vehiculos WHERE id = '$vehiculo'";
$yres = mysqli_query($link,$ysql) or die('<p class="text-danger">Notifica al Administrador</p>');
$bvalor=0;
$bvalor2=0;
$bdato=mysqli_fetch_array($yres);
$bvalor2= $bdato['complementos'];
$bvalor=$bvalor2+1;

#echo '<br><br>$bvalor2: '.$bvalor2.'<br><br>';
#echo '<br><br>$bvalor: '.$bvalor.'<br><br>';

$csql = "UPDATE vehiculos SET complementos = '$avalor' WHERE id = '$veAnterior'";
#echo '<br><br>$csql a quitar'.$csql.'<br><br>';
$cres = mysqli_query($link,$csql) or die('<p class="text-danger">Notifica al Administrador</p>');
$dsql = "UPDATE vehiculos SET complementos = '$bvalor' WHERE id = '$vehiculo'";
#echo '<br><br>$dsql a agregar'.$dsql.'<br><br>';
$dres = mysqli_query($link,$dsql) or die('<p class="text-danger">Notifica al Administrador</p>');

$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));

$sql2 = "UPDATE polizas SET idComplemento = '$ident' WHERE id = '$poliza'";
#echo '<br><br>'.$sql.'<br><br>';
$result2=mysqli_query($link,$sql2) or die(errorBD('Problemas al guardar los Datos. '));

$newID = $ident;

#--------------------------------------------------------------------------------------------------------------------------------
//--------------------- Obteniendo extencion del Archivo -------------------
//------Fotografia
$matriz = array('foto');
$matrizName = array('FOTO');
$matrizName1 = array('FOTO-Comp');
$cont=0;
$varError=0;
$contError= '';
if ($tipo==1) {
  $eco='Gondola';
} else {
  $eco='Dolly';
}

$noEmp  = $eco;
$name = eliminar_simbolos($noEmp);

//------ Se valida que exista La Carpeta y si no se Crea-------------------------
$carpetaAlm = 'doctos/Complementos/ID-'.$newID.'/';
$carpeta = '../doctos/Complementos/ID-'.$newID.'/';
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

$sql = "UPDATE complementos SET $mat = '$urlReg' WHERE id = '$newID'";
#echo '<br>foto: '.$sql.'<br>';
mysqli_query($link, $sql) or die(errorCarga('<b>No se pudo cargar la Imagen</b>.'));

}



$_SESSION['ATZmsjSuccesEncargadoComplementos'] = 'Tu Complemento se a modificado Corrrectamente.';
header('location: ../Encargado/complementos.php');




function errorBD($error){
  $_SESSION['ATZmsjSuccesEncargadoComplementos'] = $error;
header('location: ../Encargado/complementos.php');
exit(0);
}

?>
