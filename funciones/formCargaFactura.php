<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$tabla = (isset($_POST['tabla']) AND $_POST['tabla'] >= 1) ? $_POST['tabla'] : '' ;

switch ($tabla) {
  case '6':    $variable = 'mttos';               break;

  case '10':   $variable = 'cargacombustible';    break;

  case '11':    $variable = 'compras';            break;

  default:      $variable = '';                   break;
}
$sql = "SELECT monto
        FROM $variable
        WHERE id = '$id'";
$result = mysqli_query($link,$sql) or die('Error, Debes Seleccionar una Categoría.');
$abc = mysqli_fetch_array($result);
$monto = ($abc['monto'] == '') ? '' : $abc['monto'] ;
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaoperadorLabel" ><b>Carga Documento: </b></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="funciones/editaFacturasPendientes.php" enctype="multipart/form-data">
    <div class="modal-body" id="editaoperadorBody">
      <div class="form-group">
        <div class="col-sm-3 text-center control-label">
             <label>Costo:</label>
        </div>
          <div class="col-sm-8 form">
            <div class="input-group">
              <div class="input-group-content">
                <input type="number" step="any" class="form-control" id="monto" name="monto" value="<?=$monto;?>"required>
              </div>
              <span class="input-group-addon"><i class="fa fa-usd"></i></span>
            </div>
          </div><!--end .form-group -->
      </div>
      <div class="form-group">
        <div class="col-sm-3 text-center control-label">
             <label>Fecha de Carga de Documento</label>
        </div>
          <div class="col-sm-8 form">
            <div class="input-group date">
              <div class="input-group-content">
                <input type="text" class="form-control fechado" id="fecha" name="fecha" required>
              </div>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </div><!--end .form-group -->
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="doctoComprobante" class="control-label">Comprobante</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="doctoComprobante" id="doctoComprobante"  class="form-control docto">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="urlPDF" class="control-label">Factura</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="urlPDF" id="urlPDF"  class="form-control docto">
        </div>
      </div>

    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$id;?>">
      <input type="hidden" name="tabla" value="<?=$tabla;?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>


  <!-- BEGIN JAVASCRIPT -->

  <script>
  $(document).ready(function(){
    $('.txtPopOver').popover('show');

    $('.fechado').datepicker({
      todayHighlight: true,
      format: "yyyy-mm-dd",
      language: "es"
    });
    });

    $(".docto").fileinput({
      showUpload: false,
      showCaption: false,
      language: 'es',
      allowedFileExtensions : ['PDF'],
      maxFileSize: 5120,
      maxFilesNum: 1,
      browseClass: "btn btn-primary btn-lg",
      fileType: "any",
      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });
    $(".xml").fileinput({
      showUpload: false,
      showCaption: false,
      language: 'es',
      allowedFileExtensions : ['PDF'],
      maxFileSize: 5120,
      maxFilesNum: 1,
      browseClass: "btn btn-primary btn-lg",
      fileType: "any",
      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });

    </script>
		<!-- END JAVASCRIPT -->
