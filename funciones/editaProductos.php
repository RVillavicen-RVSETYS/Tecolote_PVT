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

if (!isset($_POST['ident']) AND $_POST['ident'] > 0) {
  errorBD('Problema de Falta de Datos. Notifica a tu Administrador');
}

$iden = $_POST['ident'];
$depto = (isset($_POST['editdepto']) AND $_POST['editdepto'] > 0) ? $_POST['editdepto'] : '' ;
$nombre = (isset($_POST['editnombre'])) ? $_POST['editnombre'] : '' ;
$idMarca = (isset($_POST['editmarca']) AND $_POST['editmarca'] > 0) ? $_POST['editmarca'] : '' ;
$idModelo = (isset($_POST['editmodelo']) AND $_POST['editmodelo'] > 0) ? $_POST['editmodelo'] : '' ;
$serie = (isset($_POST['editserie']) AND $_POST['editserie'] > 0) ? '1' : '0' ;
$preserie = (isset($_POST['editpreserie']) AND $serie > 0) ? $_POST['editpreserie'] : '' ;
$minimo = (isset($_POST['editminimo'])) ? $_POST['editminimo'] : '0' ;
$maximo = (isset($_POST['editmaximo'])) ? $_POST['editmaximo'] : '' ;
$estatus = (isset($_POST['editestatus'])) ? $_POST['editestatus'] : '0' ;
$baja = (isset($_SESSION['editbaja'])) ? $_SESSION['editbaja'] : '1' ;
$userReg = $_SESSION['ATZident'];


$sql="UPDATE productos SET idDepto = '$depto', nombre = '$nombre', idCatMarca = '$idMarca', idCatSubMarca = '$idModelo',
preSerie = '$preserie', serieAuto = '$serie', min = '$minimo', max = '$maximo', estatus = '$estatus',
reqBaja = '$baja', fechaReg=NOW(), idUserReg = '$userReg' WHERE id='$iden'";

$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));

$_SESSION['ATZmsjSuccesAdminAltaProductos'] = 'El Producto <b>'.$nombre.'</b> se a Modificado Corrrectamente'.$error.'.';

if (isset($_FILES["foto"])) {
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
    echo '<br>'.$sql.'<br>';
    mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));
  }
}
header('location: ../Admin/adminProductos.php');




function errorBD($error){
  $_SESSION['ATZmsjAdminAltaProductos'] = $error;
  echo 'cayo: '.$error;
  header('location: ../Admin/adminProductos.php');
  exit(0);
}
?>
