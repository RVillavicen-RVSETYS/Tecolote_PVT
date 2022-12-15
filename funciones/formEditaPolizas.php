
<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;

$sql="SELECT pol.*, ase.nombre AS nomAse  FROM polizas pol
LEFT JOIN aseguradoras ase ON ase.id = pol.idAseguradora WHERE pol.id='$id' ";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>1 Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);



$ident=$id;
$ase= $dat['idAseguradora'];
$Poliza=$dat['contrato'];
$fechaCon=$dat['fechaContrato'];
$fechave=$dat['fechaVence'];
$tipo = $dat['tipoSeguro'];
$estatus = $dat['estatus'];

?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title txt-primary" id="formEditaPolizaLabel"><b>Editar Poliza </b></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" "file-data" action="../funciones/editaPoliza.php" >
    <div class="modal-body" id="editaPolizaBody">


         <div class="form-group">
        <div class="col-lg-3">
          <label for="ase" class="control-label text-left"> Aseguradora</label>
        </div>
         <div class="col-sm-9">
          <?php
          $sql = "SELECT * FROM aseguradoras ";
          $res = mysqli_query($link,$sql) or die('<p class="text-danger">Notifica al Administrador</p>');
          ?>
          <select name="ase" id="ase" class="form-control"  required>
            <?php
            while ($dat = mysqli_fetch_array($res)) {
              $activa = '';
              if ($ase == $dat['id']) {
                $activa = 'selected';
              }
              echo '<option value="'.$dat['id'].'" > '.$dat['nombre'].' </option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="banco" class="control-label">Seleccione Seguro</label>
        </div>

         <div class="col-sm-9">
          <select class="form-control" name="tipoS" required>
            <option value="1" <?=($tipo==1) ? 'selected' : '';?> > Amplia Plus </option>
            <option value="2" <?=($tipo==2) ? 'selected' : '';?> > Amplia </option>
            <option value="3" <?=($tipo==3) ? 'selected' : '';?> > Limitado </option>
            <option value="4" <?=($tipo==4) ? 'selected' : '';?> > Responsabilidad Social</option>

          </select>
        </div>
      </div>
			<div class="form-group">
				<div class="col-sm-3">
					<label for="contrato" class="control-label">N° de Póliza</label>
				</div>
				<div class="col-sm-9">
					<input type="text" name="con" id="con" class="form-control" placeholder="N° de Póliza" value="<?=$Poliza;?>" required>
				</div>
			</div>

      <div class="form-group">
        <div class="col-sm-3">
            <label for="doctoCon" class="control-label">Documentacion del Contrato</label>
        </div>
        <div class="col-sm-9">
            <input type="file" name="doctoContrato" id="doctoCon"  class="form-control docto" multiple="none" >
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
            <label for="doctoPago" class="control-label">Comprobante de Pago</label>
        </div>
        <div class="col-sm-9">
            <input type="file" name="doctoPago" id="doctoPago"  class="form-control docto" multiple="none" >
        </div>
      </div>

      <div class="form-group">
		<div class="col-sm-3">
           <label class="control-label">Fecha Contrato</label>
      </div>

        <div class="col-sm-8 form">
        <div class="input-group date">
        <div class="input-group-content">
                <input type="text" class="form-control fechado" id="eFechaCon" onchange="vaciaFecha(2);" name="fechaCon" value="<?=$fechaCon;?>"required>
              </div>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        </div><!--end .form-group -->
        </div>

        <div class="form-group">
        <div class="col-sm-3" >
           <label class="control-label" id="lblFechaVence2">Fecha Vencimiento</label>
        </div>

        <div class="col-sm-8 form">
        <div class="input-group date">
        <div class="input-group-content">
            <input type="text" class="form-control fechado" id="eFechave" name="fechave" value="<?=$fechave;?>" required>
        </div>
 	       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
        </div><!--end .form-group -->
        </div>
        <div class="form-group">
        <div class="col-sm-3">
          <label for="viaje" class="control-label">Estatus</label>
        </div>
        <div class="col-sm-9">
          <select class="form-control" name="estatus" required>

            <option value="1" <?=($estatus==1) ? 'selected' : '';?> > Activo </option>
            <option value="2" <?=($estatus==2) ? 'selected' : '';?> > Suspendido </option>
            <option value="3" <?=($estatus==3) ? 'selected' : '';?> > Cancelado </option>


          </select>
        </div>
      </div>


          </select>
        </div>
      </div>

    </div>
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$ident;?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>


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
      maxFileSize: 5120,
      maxFilesNum: 1,
      browseClass: "btn btn-primary btn-lg",
      fileType: "any",
      previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });
      $("#foto").fileinput({
      showUpload: false,
      showCaption: false,
      language: 'es',
      allowedFileExtensions : ['jpg', 'jpeg'],
      maxFileSize: 5120,
      maxFilesNum: 1,
      browseClass: "btn btn-primary btn-lg",
      fileType: "any"
	 });

	</script>
		<!-- END JAVASCRIPT -->
