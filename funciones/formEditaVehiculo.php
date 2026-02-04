<?php
define('INCLUDE_CHECK', 1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) and $_POST['ident'] >= 1) ? $_POST['ident'] : '';

$sql = "SELECT vhc.id AS idVehiculo, vhc.noEconomico AS noEco, vhc.placas AS vePlacas, cmk.nombre AS nomMarca, csmk.nombre AS nomSubMarca, ctv.nombre AS nomTipo,
      DATE_FORMAT(vhc.fechaReg, '%d/%m/%Y %H:%i:%s') AS dateReg, vhc.idPoliza AS vPoliza,pol.contrato AS noContrato, vhc.estatus AS veEstatus,
      vhc.idCatMarca AS catMarca, vhc.idCatSubmarca AS catSubMarca, vhc.modelo AS veModelo, vhc.serie AS veSerie, vhc.idCatTipoVehiculo AS idTipo,vhc.tag AS veTag, vhc.fechaVerificacion AS fechaVeri
      FROM vehiculos vhc
      LEFT JOIN catmarcas cmk ON vhc.idCatMarca = cmk.id
      LEFT JOIN catsubmarcas csmk ON vhc.idCatSubMarca = csmk.id
      LEFT JOIN cattipovehiculos ctv ON vhc.idCatTipoVehiculo = ctv.id
      LEFT JOIN polizas pol ON pol.id = vhc.idPoliza
      WHERE vhc.id = '$id'
      ORDER BY vhc.noEconomico ASC";
//echo $sql;
$result = mysqli_query($link, $sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>' . mysqli_error($link));

$dat = mysqli_fetch_array($result);
$poliza = $dat['noContrato'];
$idPoliza = $dat['vPoliza'];
$id2 = $dat['idVehiculo'];
$eco = $dat['noEco'];
$idMarca = $dat['catMarca'];
$Marca = $dat['nomMarca'];
$idSubMarca = $dat['catSubMarca'];
$subMarca = $dat['nomSubMarca'];
$modelo = $dat['veModelo'];
$idTipo = $dat['idTipo'];
$tipo = $dat['nomTipo'];
$placas = $dat['vePlacas'];
$serie = $dat['veSerie'];
$tag = $dat['veTag'];
$fechaVerificacion = $dat['fechaVeri'];
$estatus = $dat['veEstatus'];

?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="editaoperadorLabel"><b>Editar Vehículo: </b>ECO - <?= $eco; ?></h4>
</div>
<form class="form-horizontal" role="form" method="post" action="../funciones/editaVehiculo.php" enctype="multipart/form-data">
  <div class="modal-body" id="editaoperadorBody">

    <div class="form-group">
      <div class="col-sm-3">
        <label for="placas" class="control-label">Placas</label>
      </div>
      <div class="col-sm-9">
        <input type="text" name="placas" id="placas" class="form-control" placeholder="<?= $placas; ?>." value="<?= $placas; ?>" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="marca" class="control-label">Marca</label>
      </div>
      <div class="col-sm-9">
        <?php
        $sql2 = "SELECT * FROM catmarcas WHERE idCatTabla = '4' ORDER BY nombre ASC";
        $res2 = mysqli_query($link, $sql2) or die('<p class="text-danger">Notifica al Administrador</p>');
        ?>
        <select name="marca" id="marca" class="form-control" onchange="listarCatSubMarca(this.value)" placeholder="<?= $Marca; ?>." value="<?= $idMarca; ?>" required>
          <?php
          echo '<option value="' . $idMarca . '">' . $Marca . '</option>';
          while ($dat2 = mysqli_fetch_array($res2)) {
            echo '<option value="' . $dat2['id'] . '">' . $dat2['nombre'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="submarca" class="control-label">Submarca</label>
      </div>
      <div class="col-sm-9">

        <select name="submarca" id="submarca2" class="form-control" placeholder="<?= $subMarca; ?>." value="<?= $idSubMarca; ?>" required>
          <option value="<?= $idSubMarca; ?>"><?= $subMarca; ?></option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="modelo" class="control-label">Ingresa Modelo</label>
      </div>
      <div class="col-sm-9">
        <select name="modelo" id="modelo" class="form-control" required>
          <?php
          $j = date('Y');
          $i = 1998;
          while ($i < $j) {
            $i++;
            if ($i == $modelo) {
              $activado = 'selected';
            } else {
              $activado = '';
            }
            echo '<option value="' . $i . '" ' . $activado . '>' . $i . '</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="tipo" class="control-label">tipo</label>
      </div>
      <div class="col-sm-9">
        <?php
        $sql2 = "SELECT * FROM cattipovehiculos ORDER BY nombre ASC";
        $res2 = mysqli_query($link, $sql2) or die('<p class="text-danger">Notifica al Administrador</p>');
        ?>
        <select name="tipo" id="tipo" class="form-control" placeholder="<?= $tipo; ?>." value="<?= $idTipo; ?>" required>
          <?php
          echo '<option value="' . $idTipo . '">' . $tipo . '</option>';
          while ($dat2 = mysqli_fetch_array($res2)) {
            echo '<option value="' . $dat2['id'] . '">' . $dat2['nombre'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="poliza" class="control-label">Póliza</label>
      </div>
      <div class="col-sm-9">
        <?php
        $msql3 = "SELECT pol.id,pol.contrato
                            FROM polizas pol
                            WHERE (ISNULL(pol.idVehiculo) AND ISNULL(idComplemento) ) OR (idVehiculo = '0' AND idComplemento = '0')
                            OR (idVehiculo = '0' AND idComplemento IS NULL) OR (idVehiculo IS NULL AND idComplemento = '0')
                            ORDER BY pol.contrato ASC";
        $resp3 = mysqli_query($link, $msql3) or die('<p class="text-danger">Notifica al Administrador</p>');
        ?>
        <select name="poliza" id="poliza" class="form-control" placeholder="<?= $poliza; ?>." value="<?= $idPoliza; ?>" required>
          <?php
          echo '<option value="' . $idPoliza . '">' . $poliza . '</option>';
          while ($dato3 = mysqli_fetch_array($resp3)) {
            echo '<option value="' . $dato3['id'] . '">' . $dato3['contrato'] . '</option>';
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="serie" class="control-label">Ingresa Serie</label>
      </div>
      <div class="col-sm-9">
        <input type="text" name="serie" id="serie" class="form-control" placeholder="Serie" value="<?= $serie; ?>" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="tag" class="control-label">Ingresa el TAG</label>
      </div>
      <div class="col-sm-9">
        <input type="text" name="tag" id="tag" onkeyup="cambiaMay('tag');" class="form-control" placeholder="TAG" value="<?= $tag; ?>" required>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-3">
        <label for="foto" class="control-label">Fotografía</label>
      </div>
      <div class="col-sm-9">
        <input type="file" name="foto" id="foto" class="form-control foto" value="<?= $fotos; ?>">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-3">
        <label for="fechaVeri" class="control-label">Fecha De Verificación</label>
      </div>

      <div class="col-sm-9 form">
        <div class="input-group date">
          <div class="input-group-content">
            <input type="text" class="form-control fechado" id="fechaVeri" name="fechaVeri" value="<?= $fechaVerificacion ?>" autocomplete="off" required>
          </div>
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-3">
        <label for="estatus" class="control-label">Estatus</label>
      </div>
      <div class="col-sm-9">
        <select name="estatus" id="estatus" class="form-control" required>
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>
      </div>
    </div>

    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?= $id; ?>">
      <input type="hidden" name="noEcoVe" value="<?= $eco; ?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
</form>

<script>
  $(document).ready(function() {

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
    allowedFileExtensions: ['PDF'],
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
    allowedFileExtensions: ['jpg', 'jpeg'],
    maxFileSize: 5120,
    maxFilesNum: 1,
    browseClass: "btn btn-primary btn-lg",
    fileType: "any"
  });

  function listarCatSubMarca(ident) {
    $.post("../funciones/listaCatSubMarca.php", {
        ident: ident
      },
      function(respuesta) {
        $("#submarca2").html(respuesta);
      });
  }

  function cambiaMay(idInput) {
    txt = $('#' + idInput).val();
    txt = txt.toUpperCase();
    $('#' + idInput).val(txt);
  }
</script>
<!-- END JAVASCRIPT -->