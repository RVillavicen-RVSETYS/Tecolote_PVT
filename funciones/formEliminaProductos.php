<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;

$sql="SELECT stk.id AS idStock,pro.nombre AS nombreProd
FROM stocks stk
INNER JOIN productos pro ON  pro.id = stk.idProducto
WHERE stk.id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaProdLabel"><b>Baja de Producto: </b><?=$dat['nombreProd'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/bajaDeProductos.php" enctype="multipart/form-data">
    <div class="modal-body" id="editaProductoBody">

      <div class="form-group">
        <div class="col-sm-3">
          <label for="editnombre" class="control-label">Descripción</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción." required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="foto" class="control-label">Comprobante</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="comprobante" id="comprueba"  class="form-control foto" required>
        </div>
      </div>
    </div>

    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$dat['idStock'];?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Baja</button>
    </div>
  </form>

<script type="text/javascript">
  $("#comprueba").fileinput({
        showUpload: false,
        showCaption: false,
        language: 'es',
        allowedFileExtensions : ['jpg', 'jpge'],
        maxFileSize: 5120,
        maxFilesNum: 1,
        browseClass: "btn btn-primary btn-lg",
        fileType: "any"
      });


</script>
