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

$noeco = (isset($_POST['noeco'])) ? $_POST['noeco'] : '' ;
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '' ;
$idCatSubmarca = (isset($_POST['submarca'])) ? $_POST['submarca'] : '' ;
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '' ;
$noMotor = (isset($_POST['noMotor'])) ? $_POST['noMotor'] : '' ;
$combustible = (isset($_POST['combustible'])) ? $_POST['combustible'] : '' ;
$capLts = (isset($_POST['tanque'])) ? $_POST['tanque'] : '' ;
$poliza = (isset($_POST['poliza'])) ? $_POST['poliza'] : '' ;
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '' ;
$placas = (isset($_POST['placas'])) ? $_POST['placas'] : '' ;
$serie = (isset($_POST['serie'])) ? $_POST['serie'] : '' ;
$tag = (isset($_POST['tag'])) ? $_POST['tag'] : '' ;
$kmts = (isset($_POST['kmts'])) ? $_POST['kmts'] : '' ;
$userReg = $_SESSION['ATZident'];

$sql = "SELECT * FROM vehiculos WHERE noEconomico = '$noeco'";
$result=mysqli_query($link,$sql) or die(errorBD('Error en Validación. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
$cant = mysqli_num_rows($result);

if ($cant > 0) {
  errorBD('Ya se encuentra registrado un Vehículo con el Numero Economico <b>'.$noeco.'<b>, verifica por favor.');
}

$sql="INSERT INTO vehiculos(noEconomico, idCatMarca, idCatSubmarca, modelo, noMotor, idPoliza, idCatCombustible, capacidadLts, kilometros, idCatTipoVehiculo, placas, serie, tag, idUserReg, fechaReg)
      VALUES('$noeco', '$marca', '$idCatSubmarca', '$modelo', '$noMotor', '$poliza', '$combustible', '$capLts', '$kmts', '$tipo', '$placas', '$serie', '$tag', '$userReg', NOW())";
//echo '<br>SQL: '.$sql.'<br>';
$res=mysqli_query($link, $sql) or die(errorBD('Problemas al Almacenar el Vehiculo.'));

$iden = mysqli_insert_id($link);
//echo 'id: '.$iden.'<br>';
$sql2 = "UPDATE polizas SET idVehiculo = '$iden' WHERE id = '$poliza'";
#echo '<br><br>'.$sql.'<br><br>';
$result2=mysqli_query($link,$sql2) or die(errorBD('Problemas al guardar los Datos. '));
$error = '';

$sql = "SELECT nombre FROM catmarcas WHERE id = '$marca'";
$result=mysqli_query($link,$sql) or die(errorCarga(' pero <br><b>No se pudo validar la imagen reintente subir la foto.</b>.'));
$marka = mysqli_fetch_array($result);
$mark = $marka['nombre'];

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

  $name = eliminar_simbolos($mark);
  $fileName = 'ID'.$iden.'-'.$mark.'_eco'.$noeco;
  $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

  //------ Se valida que exista La Carpeta y si no se Crea-------------------------
  $carpetaAlm = 'doctos/Vehiculos/';
  $carpeta = '../doctos/Vehiculos/';
  if (!file_exists($carpeta)) {
      mkdir($carpeta, 0777, true);
  }
  $carpetaOrig = '../doctos/Vehiculos/original/';
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
  $thumb->crop(250, 250, 'center');
  $thumb->save($urlAvatar, 100, false);

  //echo"URL Generado: " . $urlAvatar . " <br><br>";
  $urlAvatar2 = str_replace('.'.$extension, '', $urlAvatar);
  $urlAvatar .= '.jpeg';
  $urlAvatar2 .= '.jpeg';

  //echo"URL Avatar1: " . $urlAvatar . " <br>";
  //echo"URL Avatar2: " . $urlAvatar2 . " <br><br>";

  rename($urlAvatar, $urlAvatar2);
  $urlReg = str_replace('../', '', $urlAvatar2);

  $sql = "UPDATE vehiculos SET foto = '$urlReg' WHERE id = '$iden'";
  //echo '<br>'.$sql.'<br>';
  mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));
}

$_SESSION['ATZmsjSuccesAdminAltaVehiculos'] = 'El Vehículo <b>'.$noeco.'</b> se a creado Corrrectamente'.$error.'.';
header('location: ../Encargado/vehiculos.php');
echo "Listo";

function errorCarga($error){
  $_SESSION['ATZmsjSuccesAdminAltaVehiculos'] = 'El Vehículo <b>'.$noeco.'</b> se a creado Corrrectamente'.$error.'.';
  echo 'cayo: '.$error;
  header('location: ../Encargado/vehiculos.php');
  exit(0);
}


function errorBD($msj)
{
  echo '<br>** Se dispara Error: '.$msj.' **<br>';
  $_SESSION['ATZmsjInfoAltaVehiculos'] = $msj;
  header('location: ../Encargado/vehiculos.php');
  exit(0);
}
?>
