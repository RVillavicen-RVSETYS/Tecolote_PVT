<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$campo = (isset($_POST['campo']) AND $_POST['campo'] >= 1) ? $_POST['campo'] : '' ;


$sql="SELECT * FROM ventas WHERE id='$id'";
#echo $sql;
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

#print_r($_POST);
#error_reporting(E_ALL); //muestra todos los errores encontrados en la página

$dat=mysqli_fetch_array($result);
#echo '<br>Campo: '.$campo.'<br>';
$ext1 = $dat['extension0'];
$ext2 = $dat['extension1'];

#echo '<br>url doctoCarga: ../'.$dat['doctoCarga'].'<br>';
if ($ext1 == 'pdf' && $campo == '1') {
    echo '
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="verPDFTitle">Docto de Carga</h4>
      </div>
      <div class="modal-body" id="verPDFBody">PDF de Carga
          <embed class="height-12" src="../'.$dat['doctoCarga'].'" width="100%" height="100%"  type="application/pdf">
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>';
}elseif ($ext2 == 'pdf' && $campo == '2') {

  echo '
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="verPDFTitle">Docto de Entrega</h4>
  </div>
  <div class="modal-body" id="verPDFBody">PDF de Entrega
  <embed class="height-12" src="../'.$dat['doctoEntrega'].'" width="100%" height="100%"  type="application/pdf">
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
  </div>';
} elseif ($ext1 != 'pdf' && $campo == '1') {
          echo '<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="verPDFTitle">Docto de Carga</h4>
                </div>
                <div class="modal-body" id="verPDFBody">Imagen de Carga
                  <img src="../'.$dat['doctoCarga'].'" class="height-12" width="100%" height="100%">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                </div>';
} elseif ($ext1 != 'pdf' && $campo == '2') {
          echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="verPDFTitle">Docto de Entrega</h4>
          </div>
          <div class="modal-body" id="verPDFBody">Imagen de Entrega
            <img src="../'.$dat['doctoEntrega'].'" class="height-12" width="100%" height="100%">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          </div>';
}else{
          echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="verPDFTitle">No hay Información</h4>
          </div>
          <div class="modal-body" id="verPDFBody">Sin Imagen
            <img src="../'.$dat['doctoEntrega'].'" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          </div>';
}



?>
