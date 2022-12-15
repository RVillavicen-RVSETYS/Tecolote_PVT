
<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;

$sql="SELECT ope.*, cedo.nombre AS nomEdo, cmun.nombre AS nomMun
      FROM operadores ope
      LEFT JOIN catestados cedo ON cedo.id = ope.idCatEstado
      LEFT JOIN catmunicipios cmun ON cmun.id = ope.idCatMunicipio
      WHERE ope.id='$id'
      ORDER BY ope.id ASC";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>'.mysqli_error($link));

$dat=mysqli_fetch_array($result);
$id2= $dat['id'];
$nombre = $dat['nombre'];
$apellidos = $dat['apellidos'];
$estado = $dat['nomEdo'];
$municipio = $dat['nomMun'];
$direccion = $dat['direccion'];
$telefono = $dat['telPersonal'];
$telCorporativo = $dat['telCorporativo'];
$noImss = $dat['noImss'];
$telEmergencia = $dat['telEmergencia'];
$contEmergencia = $dat['contEmergencia'];
$caduLicencia = $dat['caduLicencia'];
$fechaNac = $dat['fechaNac'];
$fechaIngreso = $dat['fechaIngreso'];
$fotos = $dat['fotos'];
$doctoImss = $dat['doctoImss'];
$doctoLicencia = $dat['doctoLicencia'];
$doctoDomicilio = $dat['doctoDomicilio'];
$curp = $dat['curp'];
$doctoCurp = $dat['doctoCurp'];
$sangre = $dat['tipoSangre'];
$doctoIne = $dat['doctoIne'];
$active = ($dat['estatus'] == '1') ? 'selected' : '' ;
$active2 = ($dat['estatus'] == '2') ? 'selected' : '' ;
$bonoAnt = ($dat['bonoAntiguedad'] == 1) ? 'selected' : '' ;
$idUser = $_SESSION['ATZident'];

?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaoperadorLabel" ><b>Editar Usuario: </b><?=$nombre.' '.$apellidos;?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaOperador.php" enctype="multipart/form-data">
    <div class="modal-body" id="editaoperadorBody">

      <div class="form-group">
        <div class="col-sm-3">
          <label for="name" class="control-label">Nombres</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="name" id="nombre" class="form-control" placeholder="Nombres." value="<?=$nombre;?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="apellidos" class="control-label">Apellidos</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos." value="<?=$apellidos;?>" required>
        </div>
      </div>
    <div class="form-group">
        <div class="col-sm-3">
          <label for="edo" class="control-label">Selecciona su Estado</label>
        </div>
        <div class="col-sm-9">
          <?php
          $sql2 = "SELECT * FROM catestados ORDER BY nombre ASC";
          $res2 = mysqli_query($link,$sql2) or die('<p class="text-danger">Notifica al Administrador</p>');
          ?>
          <select name="edo" id="estado" class="form-control" onchange="listaCatMunicipio(this.value);" value="<?=$estado;?>" required>
            <?php
            echo '<option value="'.$id2.'">'.$estado.'</option>';
            while ($dat2 = mysqli_fetch_array($res2)) {
              echo '<option value="'.$dat2['id'].'">'.$dat2['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="municipio" class="control-label">Selecciona su Ciudad o Municipio</label>
        </div>
        <div class="col-sm-9">
          <select name="municipio" id="municipio" class="form-control" required>
            <option value="<?=$id2?>"><?=$municipio;?></option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="dir" class="control-label">Ingresa su Dirección</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="dir" id="dir" oninput="limpiaCadena(this.value,'dir');" class="form-control" placeholder="Dirección" value="<?=$direccion;?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="telPersonal" class="control-label">Telefono Personal</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="personal" id="telPersonal" class="form-control" maxlength="10" onkeyup="soloNumeros(this.value,'telPersonal')" placeholder="Telefono Personal" value="<?=$telefono;?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="telCorporativo" class="control-label">Telefono Corporativo</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="corporativo" id="telCorporativo" class="form-control" maxlength="10" onkeyup="soloNumeros(this.value,'telCorporativo')" placeholder="Telefono Corporativo" value="<?=$telCorporativo;?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="imss" class="control-label">No. de IMSS</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="imss" id="imss" onkeyup="cambiaMayusculas(this.value,'imss')" class="form-control" placeholder="No. de IMSS" value="<?=$noImss;?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="curp" class="control-label">CURP</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="curp" id="curp" onkeyup="cambiaMayusculas(this.value,'curp')" class="form-control" placeholder="CURP" value="<?=$curp;?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="sangre" class="control-label">Tipo de Sangre</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="sangre" id="sangre" class="form-control" placeholder="Tipo de Sangre" value="<?=$sangre;?>" required>
        </div>
      </div>
      <div class="col-sm-3 text-center">
           <label>Vigencia de la Licencia</label>
      </div>
      <div class="form-group">
          <div class="col-sm-8 form">
            <div class="input-group date">
              <div class="input-group-content">
                <input type="text" class="form-control fechado" id="vigencia" name="vigencia" value="<?=$caduLicencia;?>" required>
              </div>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </div><!--end .form-group -->
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="doctoImss" class="control-label">Documentación IMSS</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="doctoImss" id="doctoImss"  class="form-control docto" value="<?=$doctoImss;?>" >
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="doctoCurp" class="control-label">Documentación CURP</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="doctoCurp" id="doctoCurp"  class="form-control docto" value="<?=$doctoCurp;?>" >
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="doctoIne" class="control-label">Documentación INE</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="doctoIne" id="doctoIne"  class="form-control docto" value="<?=$doctoIne;?>" >
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="doctoDomicilio" class="control-label">Comprobante de Domicilio</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="doctoDomicilio" id="doctoDomicilio"  class="form-control docto" value="<?=$doctoDomicilio;?>" >
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="doctoLicencia" class="control-label">Documentación Licencia</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="doctoLicencia" id="doctoLicencia"  class="form-control docto" value="<?=$doctoLicencia;?>" >
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="fotos" class="control-label">Fotografía</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="fotos" id="fotos"  class="form-control foto" value="<?=$fotos;?>" >
        </div>
      </div>
      <div class="col-sm-3 text-center">
           <label>Fecha de Nacimiento</label>
      </div>
      <div class="form-group">
          <div class="col-sm-8 form">
            <div class="input-group date">
              <div class="input-group-content">
                <input type="text" class="form-control fechado" id="fechaNac" name="fechaNac" value="<?=$fechaNac;?>" required>
              </div>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </div><!--end .form-group -->
      </div>

      <div class="col-sm-3 text-center">
           <label>Fecha de Ingreso a la Empresa</label>
      </div>
      <div class="form-group">
          <div class="col-sm-8 form">
            <div class="input-group date">
              <div class="input-group-content">
                <input type="text" class="form-control fechado" id="fechaIngreso" name="fechaIngreso" value="<?=$fechaIngreso;?>" required>
              </div>
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </div><!--end .form-group -->
      </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="telEmergencia" class="control-label">Teléfono de Emergencia</label>
      </div>
      <div class="col-sm-9">
        <input type="text" name="telEmergencia" id="telEmergencia" class="form-control" onkeyup="soloNumeros(this.value,'telEmergencia')" placeholder="Teléfono de Emergencia" value="<?=$telEmergencia;?>" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="contEmergencia" class="control-label">Contacto de Emergencia</label>
      </div>
      <div class="col-sm-9">
        <input type="text" name="contEmergencia" id="contEmergencia" class="form-control" placeholder="Contacto de Emergencia" value="<?=$contEmergencia;?>" required>
      </div>
    </div>
    <?php
    if ($idUser == 1 || $idUser == 4 || $idUser == 9) {
     ?>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="estatus" class="control-label">Bono de Antiguedad</label>
      </div>
      <div class="col-sm-9">
        <select name="bonoAnt" id="bonoAnt" class="form-control" required>
          <option value="0">No aplica</option>
          <option value="1" <?=$bonoAnt;?>>Si aplica</option>
        </select>
      </div>
    </div>
    <?php
    }
     ?>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="estatus" class="control-label">Estatus</label>
      </div>
      <div class="col-sm-9">
        <select name="estatus" id="estatus" class="form-control" required>
          <option value="0" <?=$active2;?>>Inactivo</option>
          <option value="1" <?=$active;?>>Activo</option>
        </select>
      </div>
    </div>

    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$id;?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>

  <script>
  $(document).ready(function(){

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

    $(".foto").fileinput({
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
