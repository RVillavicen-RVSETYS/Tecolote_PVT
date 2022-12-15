<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('../assets/scripts/cadenas.php');
require_once('../assets/scripts/Thumb.php');
session_start();

/*
echo '<br>---------------------------Cont de SESSION y POST-----------------------<br>SESSION:';
print_r($_SESSION);
echo '<br><br>POST';
print_r($_POST);
echo '<br><br>FILE';
print_r($_FILES);
echo "<br>----------------------------------------------------------------------<br>";
*/

$depto = (isset($_POST['depto']) AND $_POST['depto'] > 0) ? $_POST['depto'] : '' ;
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '' ;
$idMarca = (isset($_POST['marca']) AND $_POST['marca'] > 0) ? $_POST['marca'] : '' ;
$idModelo = (isset($_POST['modelo']) AND $_POST['modelo'] > 0) ? $_POST['modelo'] : '' ;
$serie = (isset($_POST['serie']) AND $_POST['serie'] > 0) ? '1' : '0' ;
$preserie = (isset($_POST['preserie']) AND $serie > 0) ? $_POST['preserie'] : '' ;
$minimo = (isset($_POST['minimo'])) ? $_POST['minimo'] : '0' ;
$maximo = (isset($_POST['maximo'])) ? $_POST['maximo'] : '' ;
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '0' ;
$baja = (isset($_SESSION['baja'])) ? $_SESSION['baja'] : '1' ;
$userReg = $_SESSION['ATZident'];

$sql="INSERT INTO productos(idDepto, nombre, idCatMarca, idCatSubMarca, preSerie, serieAuto, min, max, estatus, reqBaja, idUserReg, fechaReg)
      VALUES('$depto', '$nombre', '$idMarca', '$idModelo', '$preserie', '$serie', '$minimo', '$maximo', '$estatus', '$baja', '$userReg', NOW())";
//echo '<br>'.$sql.'<br>';
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));

$iden = mysqli_insert_id($link);
//echo 'id: '.$iden.'<br>';
$error = '';

//============================================ Carga de FOTO ====================================================
if ($_FILES["foto"]["error"] > 0 ){
  //echo "Error: " . $_FILES['foto']['error'] . "<br>";
  $error = ' pero <br><b>No se pudo cargar la Imagen</b>';

}else {
  // La Foto no Genera Error.

  //--------------------- Obteniendo extencion del Archivo -------------------
  //------Fotografia
  $archivo = $_FILES['foto']['name'];
  $valores = explode(".", $archivo);
  $extension = $valores[count($valores)-1];

  $name = eliminar_simbolos($nombre);
  $fileName = $iden.'-'.$name;
  $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

  //------ Se valida que exista La Carpeta y si no se Crea-------------------------
  $carpetaAlm = 'doctos/Productos/';
  $carpeta = '../doctos/Productos/';
  if (!file_exists($carpeta)) {
      mkdir($carpeta, 0777, true);
  }
  $carpetaOrig = '../doctos/Productos/original/';
  if (!file_exists($carpetaOrig)) {
      mkdir($carpetaOrig, 0777, true);
  }

  $url = $carpeta.'original/'.$fileName;
  $urlAvatar = $carpeta.$fileName;

  /*--------------------------Datos para Carga de Archivos Lista ------------------------------
   echo"Nombre Nuevo: " . $fileName . "<br>";
   echo"Tipo: " . $_FILES['foto']['type'] . "<br>";
   echo"Tamaño: " . ($_FILES["foto"]["size"] / 1024) . " kB<br>";
   echo"Carpeta temporal: " . $_FILES['foto']['tmp_name'] . " <br>";
   echo'<br>';

   echo"Carpeta Final: " . $carpetaAlm . " <br>";
   echo"URL Original: " . $url . " <br>";
   echo"URL Avatar: " . $urlAvatar . " <br><br>";*/

  //--------------------------Se mueven Archivos para trabajarlos ------------------------------
  move_uploaded_file($_FILES['foto']['tmp_name'], $url);

  $thumb = new Thumb();
  $thumb->loadImage($url);
  $thumb->crop(150, 150, 'center');
  $thumb->save($urlAvatar, 100, false);

  //echo"URL Generado: " . $urlAvatar . " <br><br>";
  $urlAvatar2 = str_replace('.'.$extension, '', $urlAvatar);
  $urlAvatar .= '.jpeg';
  $urlAvatar2 .= '.jpeg';

  //echo"URL Avatar1: " . $urlAvatar . " <br>";
  //echo"URL Avatar2: " . $urlAvatar2 . " <br><br>";

  rename($urlAvatar, $urlAvatar2);
  $urlReg = str_replace('../', '', $urlAvatar2);

  $sql = "UPDATE productos SET foto = '$urlReg' WHERE id = '$iden'";
  //echo '<br>'.$sql.'<br>';
  mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));
}

$_SESSION['ATZmsjSuccesAdminAltaProductos'] = 'El Producto <b>'.$nombre.'</b> se a creado Corrrectamente'.$error.'.';
header('location: ../Admin/adminProductos.php');
echo "Listo";

function errorCarga($error){
  $_SESSION['ATZmsjSuccesAdminAltaProductos'] = 'El Producto <b>'.$nombre.'</b> se a creado Corrrectamente'.$error.'.';
  echo 'cayo: '.$error;
  header('location: ../Admin/adminProductos.php');
  exit(0);
}

function errorBD($error){
  $_SESSION['ATZmsjAdminAltaProductos'] = $error;
  echo 'cayo: '.$error;
  header('location: ../Admin/adminProductos.php');
  exit(0);
}

?>
