<?php
define('INCLUDE_CHECK',1);
require_once('../assets/scripts/cadenas.php');
require_once('../assets/scripts/Thumb.php');
require_once('../include/connect.php');
session_start();


$idAsignaVehiculo = (isset($_POST['idAsignaVehiculo'])) ? $_POST['idAsignaVehiculo'] : '' ;
$km = (isset($_POST['km'])) ? $_POST['km'] : '' ;
$monto = (isset($_POST['monto'])) ? $_POST['monto'] : '' ;
$tipoMtto = (isset($_POST['tipoMtto'])) ? $_POST['tipoMtto'] : '' ;
$servicio = (isset($_POST['servicio'])) ? $_POST['servicio'] : '' ;
$taller = (isset($_POST['taller'])) ? $_POST['taller'] : '' ;
$nom = (isset($_POST['nom'])) ? $_POST['nom'] : '' ;
$fechaEntrada = (isset($_POST['fechaEntrada'])) ? $_POST['fechaEntrada'] : '' ;
$fechaEntrega = (isset($_POST['fechaEntrega'])) ? $_POST['fechaEntrega'] : '' ;
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '' ;
$debug = 0;
mysqli_autocommit($link, FALSE);
mysqli_begin_transaction($link);

#$productoReparado = (isset($_POST['productoReparado'])) ? $_POST['productoReparado'] : '' ;
$userReg = $_SESSION['ATZident'];
if ($debug == 1) {
  echo '<br>$_POST: ';
  echo '<br>';
  print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
  echo '<br>';
  echo '<br>$_SESSION:';
  echo '<br>';
  print_r($_SESSION);
  echo '<br>';
  echo '<br>$_FILES:';
  echo '<br>';
  print_r($_FILES);
  echo '<br>';
  echo '<br>$idAsignaVehiculo: '.$idAsignaVehiculo.'<br>';
  echo '<br>$km: '.$km.'<br>';
  echo '<br>$monto: '.$monto.'<br>';
  echo '<br>$tipoMtto: '.$tipoMtto.'<br>';
  echo '<br>$servicio: '.$servicio.'<br>';
  echo '<br>$taller: '.$taller.'<br>';
  echo '<br>$nom: '.$nom.'<br>';
  echo '<br>$fechaEntrada: '.$fechaEntrada.'<br>';
  echo '<br>$fechaEntrega: '.$fechaEntrega.'<br>';
  echo '<br>$descripcion: '.$descripcion.'<br>';
  echo '<br>$userReg: '.$userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
}
if ($idAsignaVehiculo == '' || $km == '' || $tipoMtto == '' || $servicio == '' || $taller == '' || $nom == '' || $fechaEntrada == '' || $fechaEntrega == '' || $descripcion == '') {
  errorBD('Hay un Error debes ingresar <b>Todos los campos</b>, inténtalo de Nuevo.');
#  echo '<br>cayo: '.$error.'<br>';   //Manda el informe de la variable error que se está presentando
} else {
    $sql="INSERT INTO mttos (monto,   km, idCatTipoMtto, idServicioMtto,   descripcion,  nombreRecibe,   fechaEntrada,  fechaEntrega , idTaller,        idAsignaVehiculo,  idUserReg,  fechaReg )
                    VALUES ('$monto','$km','$tipoMtto',   '$servicio'  ,   '$descripcion', '$nom', '$fechaEntrada',    $fechaEntrega  ,  '$taller',  '$idAsignaVehiculo', '$userReg', NOW())";
        if ($debug == 1) {
          echo '<br> sql: '.$sql.'<br>';
        }
$result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));/*.mysqli_error($link)*///)); //el .mysqli_error($link) me dice los problemas que hay
}

$idMtto = mysqli_insert_id($link);
$sql4="SELECT mttos.*, ve.noEconomico AS noEco
FROM mttos
INNER JOIN asignavehiculos asgv ON asgv.id = mttos.idAsignaVehiculo
INNER JOIN vehiculos ve ON ve.id = asgv.idVehiculo
Where mttos.id = '$idMtto'";
if ($debug == 1) {
  echo '<br> sql4: '.$sql4.'<br>';
}
$result=mysqli_query($link,$sql4) or die(errorBD('Error en la conexión 4 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));/*.mysqli_error($link)*///)); //el .mysqli_error($link) me dice los problemas que hay
$dat = mysqli_fetch_array($result);
$eco = $dat['noEco'];

#echo '<br>$idMtto:  '.$idMtto;
$newID = $idMtto;
#echo '<br>$newID:  '.$newID;

  //--------------------- Obteniendo extencion del Archivo -------------------
  //------Fotografia
  $matriz = array('fotoEntrada');
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
      if ($debug == 1) {
        echo '<br> Se carga la foto: '.$urlAvatar;
      } else {

          move_uploaded_file($_FILES[$mat]['tmp_name'], $url);

          if ($nameMatriz == "FOTO") {
            $thumb = new Thumb();
            $thumb->loadImage($url);
            $thumb->save($urlAvatar, 80, false);

    #        echo"URL Generado: " . $urlAvatar . " <br><br>";
            $urlAvatar2 = str_replace('.'.$extension, '', $urlAvatar);
            $urlAvatar .= '.jpeg';
            $urlAvatar2 .= '.jpeg';

    #        echo"URL Avatar1: " . $urlAvatar . " <br>";
    #        echo"URL Avatar2: " . $urlAvatar2 . " <br><br>";

            rename($urlAvatar, $urlAvatar2);
            $urlReg = str_replace('../', '', $urlAvatar2);

          }

        $sql = "INSERT INTO fotos (url,idTabla,tabla) VALUES ('$urlReg', '6', '$idMtto')";

        mysqli_query($link, $sql) or die(errorCarga('<b>No se pudo cargar la Imagen</b>.'));
      }

    }

      $cont++;
    }


    if ($debug == 1) {
      mysqli_rollback($link);
      echo '<br> Aquí regresa a la página registraMttos.php';
      exit(0);
    } else {
      mysqli_commit($link);
      $_SESSION['ATZmsjSuccesRegistraMttos'] = 'El Mantenimiento se a creado Corrrectamente.';
      header('location: ../registraMttos.php');
    }

#    echo "Listo";
  #}



function errorCarga($error){
  $Connection_link = $GLOBALS['link'];
  mysqli_rollback($Connection_link);
  if ($GLOBALS['debug'] == 1) {
    echo 'Entró a error con debug: El Archivo se a creado Corrrectamente'.$error;
  } else {
    $bad = 'El Archivo se a creado Corrrectamente.';
    $error = $bad.$error;
    $_SESSION['ATZmsjRegistraMttos'] = $error;
    header('location: ../registraMttos.php');
  }
#  echo 'cayo: '.$error;   //Manda el informe del error que se está presentando

  exit(0);
}

function errorBD($error){
  $Connection_link = $GLOBALS['link'];
  mysqli_rollback($Connection_link);
  if ($GLOBALS['debug'] == 1) {
    echo 'Entró a error con debug: El Archivo se a creado Corrrectamente'.$error;
  } else {
    $_SESSION['ATZmsjRegistraMttos'] = $error;
    header('location: ../registraMttos.php');
  }
  exit(0);
}
?>
