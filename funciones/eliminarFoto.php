<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;
$tabla = (isset($_POST['tabla'])) ? $_POST['tabla'] : '' ;
$pag = (isset($_POST['pag'])) ? $_POST['pag'] : '' ;
$mserror = (isset($_POST['mserror'])) ? $_POST['mserror'] : '' ;
$mssuccess = (isset($_POST['mssuccess'])) ? $_POST['mssuccess'] : '' ;
#print_r($_POST);
#echo '<br><br>';
$foto = ($tabla == 'operadores') ? 'fotos' : 'foto' ;
$nombre = ($tabla == 'vehiculos' || $tabla == 'complementos') ? 'noEconomico' : 'nombre' ;
$tabla2 = ucfirst($tabla);

$sql="SELECT id,$foto FROM $tabla WHERE id = '$ident'";
$result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
#echo '<br>'.$sql.'<br>';
$dato = mysqli_fetch_array($result);
if ($dato[$foto] == '') {
  errorBD('0|No se encontró ninguna Imagen Registrada');
} else {
  $carpeta = '../doctos/'.$tabla2.'/ID-'.$dato['id'];

  if(!unlink('../'.$dato[$foto])){
    errorBD('0|No se pudo borrar la Imagen');
  };
  $sql="UPDATE $tabla SET $foto = '' WHERE id = '$ident'";
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al guardar los Datos. '));
  #echo '<br>'.$sql.'<br>';
  $contenido = ' Dejará de visualizar la foto al actualizar la página';
  echo '1|'.$contenido;
  }

exit(0);

function errorBD($error){
  echo '0|'.$error;
  exit(0);
}

?>
