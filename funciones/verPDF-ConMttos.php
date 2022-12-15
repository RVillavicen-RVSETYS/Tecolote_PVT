<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$campo = (isset($_POST['campo']) AND $_POST['campo'] >= 1) ? $_POST['campo'] : '' ;
#print_r($_POST);
$sql="SELECT * FROM facturas fa
INNER JOIN mttos mttos on mttos.idFactura = fa.id
 WHERE mttos.idFactura ='$id'";
#echo $sql;
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$sqlfotos = "SELECT * FROM fotos fts
            WHERE fts.idTabla = '6' AND fts.tabla = '$id'";
$resultFotos = mysqli_query($link,$sqlfotos) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');
#print_r($_POST);
#error_reporting(E_ALL); //muestra todos los errores encontrados en la página

$documentos=mysqli_fetch_array($result);
#echo '<br>Campo: '.$campo.'<br>';

switch ($campo) {
  case '1':
  echo '<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="verPDFTitle">Factura</h4>
        </div>
        <div class="modal-body" id="verPDFBody">
          <embed class="height-12" src="../'.$documentos['urlPDF'].'" width="100%" height="100%"  type="application/pdf">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>';

    break;

    case '2':
    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="verPDFTitle">XML</h4>
          </div>
          <div class="modal-body" id="verPDFBody">
            <embed class="height-12" src="../'.$documentos['urlXML'].'" width="100%" height="100%"  type="application/xml">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          </div>';

      break;
      case '3':
      echo '<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="verPDFTitle">Comprobante</h4>
            </div>
            <div class="modal-body" id="verPDFBody">
              <embed class="height-12" src="../'.$documentos['doctoComprobante'].'" width="100%" height="100%"  type="application/pdf">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>';

        break;
        case '4':
            echo '<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="verPDFTitle">Fotos</h4>
                  </div>
                  <div class="modal-body" id="verPDFBody">
                  ';
              while ($foto=mysqli_fetch_array($resultFotos)) {
                echo '
                  <img src="../'.$foto['url'].'" class="height-12" width="100%" height="100%">
                ';}
            echo '
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>';

          break;

}



?>
