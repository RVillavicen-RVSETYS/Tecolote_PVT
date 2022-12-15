<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();
$fecha = date('d-m-Y');

$ident = (isset($_POST['ident']) AND $_POST['ident'] != '') ? $_POST['ident'] : '';
$ase = (isset($_POST['ase']) AND $_POST['ase'] != '') ? $_POST['ase'] : '';
$tipoS = (isset($_POST['tipoS'])) ? $_POST['tipoS'] : '';
$con = (isset($_POST['con']) AND $_POST['con'] != '') ? $_POST['con'] : '';
$fechaCon = (isset($_POST['fechaCon']) AND $_POST['fechaCon'] != '') ? $_POST['fechaCon'] : '';
$fechave = (isset($_POST['fechave']) AND $_POST['fechave'] != '') ? $_POST['fechave'] : '';
$ve = (isset($_POST['ve']) AND $_POST['ve'] != '') ? $_POST['ve'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';
$userReg = $_SESSION['ATZident'];
//print_r($_POST);   //Sirve para mostrar los valores que uno está recibiendo del archivo anterior (formulario)
//echo '<br>';  //sirve para mostrar la siguiente información en otro parrafo
//print_r($_SESSION);    //Sirve para mostrar los valores que está recibiendo de la sesion
//echo $userReg.'<br>'; //imprime el valor de la variable $userReg y genera un salto de linea
print_r($_FILES);



  #Verifica que se hayan cargado los documentos, sino sólo manda una alerta
  $sql = "SELECT * FROM polizas WHERE contrato = '$con' ";
  $result=mysqli_query($link,$sql) or die(errorBD('Error en la conexión 1 (). Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);
  if ($cant>0) {
   errorBD('Ya se encuentra un Registro  con ese N° Poliza: <b>'.$con.'<b>.');
  }



  $sql2="INSERT INTO polizas (idAseguradora, tipoSeguro, fechaContrato, fechaVence,  contrato, idVehiculo, estatus, idUserReg,  fechaReg)
                       VALUES ('$ase',        '$tipoS',  '$fechaCon', '$fechave',     '$con',     '$ve',       '1',  '$userReg', NOW())";
    echo '<br>inserta: '.$sql.'<br>';
  $result2=mysqli_query($link,$sql2) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay
  $idPoliza = mysqli_insert_id($link);

  $sql3="UPDATE vehiculos SET idPoliza = '$idPoliza' WHERE id = '$ve' LIMIT 1";
    echo '<br>inserta: '.$sql.'<br>';
  $result3=mysqli_query($link,$sql3) or die(errorBD('Error en la conexión 3 (Inserción)'.mysqli_error($link).'. Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'/*.mysqli_error($link)*/)); //el .mysqli_error($link) me dice los problemas que hay

  /*  $newID = mysqli_insert_id($link);

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
#    echo '<br>sql2: '.$sql.'<br>';
#    mysqli_query($link, $sql) or die(errorCarga(' pero <br><b>No se pudo cargar la Imagen</b>.'));

  }
  $cont++;
}
*/

$_SESSION['ATZmsjSuccesEncargadoPolizas'] = 'Se a creado Correctamente.';
header('location: ../Encargado/polizas.php');


function errorBD($error){
  $_SESSION['ATZmsjEncargadoPolizas'] = $error;
 header('location: ../Encargado/polizas.php');
  exit(0);
}
?>
