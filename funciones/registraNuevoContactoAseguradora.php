<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$idAseg = (isset($_POST['idAseg'])) ? $_POST['idAseg'] : '' ;
$nameContacto = (isset($_POST['nameContacto'])) ? $_POST['nameContacto'] : '' ;
$correoContacto = (isset($_POST['correoContacto'])) ? $_POST['correoContacto'] : '' ;
$telOficina = (isset($_POST['telOficina'])) ? $_POST['telOficina'] : '' ;
$telPersonal = (isset($_POST['telPersonal'])) ? $_POST['telPersonal'] : '' ;
$userReg = $_SESSION['ATZident'];

if ($nameContacto == '') {
  errorBD('Hay un Error debes ingresar un <b>Nombre</b> para el Contacto, inténtalo de Nuevo.');
} elseif ($telOficina == '' AND $telPersonal == '' AND $correoContacto == '') {
  errorBD('Hay un Error debes ingresar al menos un telefono o un correo, inténtalo de Nuevo.');
}else {

  $sql = "SELECT * FROM contactos WHERE nombre = '$nameContacto' AND idCatTabla = '1' AND idRegistro = '$idAseg'";
  $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'));
  $cant = mysqli_num_rows($result);

  if ($cant >= 1) {
    errorBD('Ya existe un <b>'.$nameContacto.'</b> para esta Aseguradora.');
  } else {

    $sql="INSERT INTO contactos(nombre, telOf, cel, correo, idCatTabla, idRegistro) VALUES('$nameContacto','$telOficina','$telPersonal','$correoContacto', '1', '$idAseg')";
    $result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.$sql));

    echo '1|'.$idAseg;
  }
}

function errorBD($error){
  echo '0|'.$error;
  exit(0);
}
?>
