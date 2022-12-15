<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
#print_r($_POST);
$sql="SELECT fa.doctoComprobante,fa.urlPDF
FROM  mttos mttos
LEFT JOIN facturas fa on mttos.idFactura = fa.id
 WHERE mttos.id ='$id'";
#echo $sql;
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$documentos=mysqli_fetch_array($result);

$pdf = ($documentos['urlPDF'] == '') ? $documentos['doctoComprobante'] : $documentos['urlPDF'] ;
#echo '<br>Campo: '.$campo.'<br>';


  echo '<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="verPDFTitle">Docto</h4>
        </div>
        <div class="modal-body" id="verPDFBody">
          <embed class="height-12" src="'.$pdf.'" width="100%" height="100%"  type="application/pdf">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>';

?>
