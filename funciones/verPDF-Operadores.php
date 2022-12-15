<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$campo = (isset($_POST['campo']) AND $_POST['campo'] >= 1) ? $_POST['campo'] : '' ;

$sql="SELECT * FROM operadores WHERE id='$id'";
#echo $sql;
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

#print_r($_POST);
#error_reporting(E_ALL); //muestra todos los errores encontrados en la página

$dat=mysqli_fetch_array($result);
#echo '<br>Campo: '.$campo.'<br>';

#echo '<br>url doctoCarga: ../'.$dat['doctoCarga'].'<br>';
switch ($campo) {
  case '1':
  echo '<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="verPDFTitle">Docto de IMSS</h4>
        </div>
        <div class="modal-body" id="verPDFBody">
          <embed class="height-12" src="../'.$dat['doctoImss'].'" width="100%" height="100%"  type="application/pdf">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>';
    break;
    case '2':
    echo '<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="verPDFTitle">Docto de Licencia</h4>
          </div>
          <div class="modal-body" id="verPDFBody">
            <embed class="height-12" src="../'.$dat['doctoLicencia'].'" width="100%" height="100%"  type="application/pdf">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          </div>';
      break;
      case '3':
      echo '<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="verPDFTitle">Docto de Domicilio</h4>
            </div>
            <div class="modal-body" id="verPDFBody">
              <embed class="height-12" src="../'.$dat['doctoDomicilio'].'" width="100%" height="100%"  type="application/pdf">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>';
        break;
        case '4':
        echo '<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="verPDFTitle">Docto de CURP</h4>
              </div>
              <div class="modal-body" id="verPDFBody">
                <embed class="height-12" src="../'.$dat['doctoCurp'].'" width="100%" height="100%"  type="application/pdf">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
              </div>';
          break;
          case '5':
          echo '<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="verPDFTitle">Docto de INE</h4>
                </div>
                <div class="modal-body" id="verPDFBody">
                  <embed class="height-12" src="../'.$dat['doctoIne'].'" width="100%" height="100%"  type="application/pdf">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                </div>';
            break;

  default:
  echo '<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="verPDFTitle">Archivo no Encontrado</h4>
        </div>
        <div class="modal-body" id="verPDFBody">
          <embed class="height-12"  width="100%" height="100%"  type="application/pdf">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>';
    break;

    break;
}
        /*
        16====doctoImss
        17====doctoLicencia
        18====doctoDomicilio
        20====doctoCurp
        22====doctoIne
        */

?>
