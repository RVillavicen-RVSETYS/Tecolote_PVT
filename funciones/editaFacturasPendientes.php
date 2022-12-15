<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
require_once('../assets/scripts/cadenas.php');
require_once('../assets/scripts/Thumb.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$tabla = (isset($_POST['tabla'])) ? $_POST['tabla'] : '' ;
$monto = (isset($_POST['monto'])) ? $_POST['monto'] : '' ;
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '' ;

$userReg = $_SESSION['ATZident'];
print_r($_POST);
echo '<br><br>';
echo '<br>user: '.$userReg.'<br>';
echo '<br>$tabla: '.$tabla.'<br>';
print_r($_FILES);
echo '<br><br>';
switch ($tabla) {
  case '6':    $lugar='Mttos';          break;
  case '10':   $lugar='Gasolineras';    break;
  case '11':   $lugar='Compras';        break;

  default:

    break;
}

//--------------------- Obteniendo extencion del Archivo -------------------
$newID = $ident;
echo '<br>$newID:  '.$newID;
echo '<br>$lugar:  '.$lugar;
# docComp, falla, concluido,  doc, xml,
    //--------------------- Obteniendo extencion del Archivo -------------------
    //------Fotografia
    $matriz = array('doctoComprobante', 'urlPDF');
    $matrizName = array('Comprobante', 'Factura');
    $cont=0;
    $varError=0;
    $contError= '';

    $nombreComp = ''.$lugar.'-'.$newID;
    $name = eliminar_simbolos($nombreComp);

    //------ Se valida que exista La Carpeta y si no se Crea-------------------------
    $carpetaAlm = 'doctos/'.$lugar.'/Comprobantes/ID-'.$newID.'/';
    $carpeta = '../doctos/'.$lugar.'/Comprobantes/ID-'.$newID.'/';
    if (!file_exists($carpeta)) {
      mkdir($carpeta, 0777, true);
    }
$valor[0]='';$valor[1]='';
    while ($cont <= 1) {
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
$sql = "INSERT INTO facturas (doctoComprobante,urlPDF,idUserReg,fechaReg) VALUES ('$valor[0]', '$valor[1]', '$userReg', NOW())";
echo '<br>sql: '.$sql.'<br>';
  mysqli_query($link, $sql) or die(errorBD(' Pero <br><b>No se pudo cargar el Archivo PDF</b>.'));

$idFactura = mysqli_insert_id($link);
#echo '<br>$idFactura: '.$idFactura.'<br>';
switch ($tabla) {
  case '6':    $sql="UPDATE mttos SET monto = '$monto', idFactura = '$idFactura' WHERE id = '$ident'";    mysqli_query($link, $sql) or die(errorBD(' pero <br><b>No se pudo cargar la Imagen</b>.'));
  echo '<br>sql mttos: '.$sql.'<br>';                                             break;
  case '10':   $sql="UPDATE cargacombustible SET monto = '$monto', idFactura = '$idFactura', fechaCarga ='$fecha' WHERE id = '$ident'";   mysqli_query($link, $sql) or die(errorBD(' pero <br><b>No se pudo cargar la Imagen</b>.'));
  echo '<br>sql cargacombustible: '.$sql.'<br>';                    break;
  case '11':   $sql="UPDATE compras SET monto = '$monto', doctoFactura = '$idFactura', doctoComprobante = '$valor[0]' WHERE id = '$ident'";  mysqli_query($link, $sql) or die(errorBD(' pero <br><b>No se pudo cargar la Imagen</b>.'));
  echo '<br>sql compras: '.$sql.'<br>';               break;

  default:
  echo "Error";
    break;
}

$_SESSION['ATZmsjSuccesAuxiliarfacturasPendientes'] = 'Tu Factura se a modificado Corrrectamente.';
header('location: ../facturasPendientes.php');




function errorBD($error){
  $_SESSION['ATZmsjAuxiliarfacturasPendientes'] = $error;
header('location: ../facturasPendientes.php');
exit(0);
}

?>
