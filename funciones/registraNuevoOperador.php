<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('../assets/scripts/cadenas.php');
require_once('../assets/scripts/Thumb.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '' ;
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '' ;
$estado = (isset($_POST['newEdo'])) ? $_POST['newEdo'] : '' ;
$municipio = (isset($_POST['newMunicipio'])) ? $_POST['newMunicipio'] : '' ;
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '' ;
$telPersonal = (isset($_POST['telPersonal'])) ? $_POST['telPersonal'] : '' ;
$telCorporativo = (isset($_POST['telCorporativo'])) ? $_POST['telCorporativo'] : '' ;
$imss = (isset($_POST['imss'])) ? $_POST['imss'] : '' ;
$telEmergencia = (isset($_POST['telEmergencia'])) ? $_POST['telEmergencia'] : '' ;
$contEmergencia = (isset($_POST['contEmergencia'])) ? $_POST['contEmergencia'] : '' ;
$vigencia = (isset($_POST['vigencia'])) ? $_POST['vigencia'] : '' ;
$fechaNac = (isset($_POST['fechaNac'])) ? $_POST['fechaNac'] : '' ;
$fechaIngreso = (isset($_POST['fechaIngreso'])) ? $_POST['fechaIngreso'] : '' ;
$curp = (isset($_POST['curp'])) ? $_POST['curp'] : '' ;
$sangre = (isset($_POST['sangre'])) ? $_POST['sangre'] : '' ;
$doctoIne = (isset($_POST['doctoIne'])) ? $_POST['doctoIne'] : '' ;
$doctoCurp = (isset($_POST['doctoCurp'])) ? $_POST['doctoCurp'] : '' ;
$doctoDomicilio = (isset($_POST['doctoDomicilio'])) ? $_POST['doctoDomicilio'] : '' ;
$doctoLicencia = (isset($_POST['doctoLicencia'])) ? $_POST['doctoLicencia'] : '' ;
$doctoImss = (isset($_POST['doctoImss'])) ? $_POST['doctoImss'] : '' ;
$userReg = (isset($_SESSION['ATZident'])) ? $_SESSION['ATZident'] : '' ;

#print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
#echo '<br><br>';  //sirve para mostrar la siguiente información en otro parrafo
#print_r($_SESSION);
#echo '<br><br>';    //Sirve para mostrar los valores que está recibiendo de la sesion
#echo $userReg.'<br><br>'; //imprime el valor de la variable $userReg y genera un salto de linea
#print_r($_FILES);
#echo '<br><br>';

  #Verifica que se hayan cargado los documentos, sino sólo manda una alerta
  $sql = "SELECT * FROM operadores WHERE nombre = '$nombre' AND apellidos = '$apellidos'";
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 1 (nombre). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
#  echo '<br>sql: '.$sql.'<br>';
  $cant = mysqli_num_rows($result);
  if ($cant>0) {
    errorBD('Ya se encuentra un usuario con ese nombre: <b>'.$nombre.' '.$apellidos.'<b>.');
  }

  $sql2 = "SELECT * FROM operadores WHERE curp = '$curp'";
  $result2=mysqli_query($link,$sql2) or die(errorBD('Error en la conexión 2 (curp). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant2 = mysqli_num_rows($result2);
#echo '<br>sql2: '.$sql2.'<br>';
  if ($cant2>0) {
    errorBD('Ya se encuentra un usuario con esa CURP: <b>'.$curp.'<b>.');
  }
  else {

    $sql="INSERT INTO operadores (nombre, apellidos, direccion, telPersonal, telCorporativo, noImss, telEmergencia, contEmergencia,
    caduLicencia, idCatEstado, idCatMunicipio, fechaNac, fechaIngreso, curp, tipoSangre, estatus, idUserReg,  fechaReg) VALUES ('$nombre',
      '$apellidos', '$direccion', '$telPersonal', '$telCorporativo', '$imss',
    '$telEmergencia', '$contEmergencia', '$vigencia', '$estado', '$municipio', '$fechaNac', '$fechaIngreso', '$curp', '$sangre',
     '1', '$userReg', NOW())";
  #  echo '<br>sql3: '.$sql.'<br>';
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

    $newID = mysqli_insert_id($link);

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

        $fileName = 'ID'.$newID.'-'.$nameMatriz.'-'.$name;
        $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

        $url = $carpeta.$fileName;
        $urlReg = $carpetaAlm.$fileName;


        //--------------------------Se mueven Archivos para trabajarlos ------------------------------
        move_uploaded_file($_FILES[$mat]['tmp_name'], $url);

        $sql = "UPDATE operadores SET $mat = '$urlReg' WHERE id = '$newID'";
        #echo '<br>$sql4: '.$sql.'<br>';
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


    if ($varError >= 1) {
      $_SESSION['ATZmsjEncargadoOperadores'] = $contError;
    }

    $_SESSION['ATZmsjSuccesEncargadoOperadores'] = 'El Operador <b>'.$nombre.'</b> se a creado Corrrectamente.';
    header('location: ../Encargado/operadores.php');
    echo "Listo";
  }

function errorBD($error){
  $_SESSION['ATZmsjEncargadoOperadores'] = $error;
  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando
  header('location: ../Encargado/operadores.php');
  exit(0);
}

?>
