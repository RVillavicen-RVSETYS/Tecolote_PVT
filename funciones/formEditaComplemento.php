
<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;

$sql="SELECT comp.id AS idComplemento, comp.placas AS vePlacas, cmk.nombre AS nomMarca, csmk.nombre AS nomSubMarca,
      DATE_FORMAT(comp.fechaReg, '%d/%m/%Y %H:%i:%s') AS dateReg, comp.idPoliza AS vPoliza,pol.contrato AS noContrato, comp.estatus AS veEstatus,
      comp.idCatMarca AS catMarca, comp.idCatSubmarca AS catSubMarca, comp.modelo AS veModelo,comp.tipo AS idTipo,
      ve.id AS idVe, ve.noEconomico AS noEco,comp.serie AS serieComp
      FROM complementos comp
      LEFT JOIN catmarcas cmk ON comp.idCatMarca = cmk.id
      LEFT JOIN vehiculos ve ON ve.id = comp.idVehiculo
      LEFT JOIN catsubmarcas csmk ON comp.idCatSubMarca = csmk.id
      LEFT JOIN polizas pol ON pol.id = comp.idPoliza
      WHERE comp.id = '$id'
      ORDER BY comp.id ASC";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>'.mysqli_error($link));

$dat=mysqli_fetch_array($result);
$poliza = $dat['noContrato'];
$serie = $dat['serieComp'];
$idPoliza = $dat['vPoliza'];
$vehiculo = $dat['noEco'];
$idVehiculo = $dat['idVe'];
$id2= $dat['idComplemento'];
$idMarca = $dat['catMarca'];
$Marca = $dat['nomMarca'];
$idSubMarca = $dat['catSubMarca'];
$subMarca = $dat['nomSubMarca'];
$modelo = $dat['veModelo'];
$idTipo = $dat['idTipo'];
$placas = $dat['vePlacas'];
$estatus = $dat['veEstatus'];

?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaoperadorLabel" ><b>Editar Complemento: </b>Placas: - <?=$placas;?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaComplemento.php" enctype="multipart/form-data">
    <div class="modal-body" id="editaoperadorBody">
      <div class="form-group">
        <div class="col-sm-3">
          <label for="tipo" class="control-label">tipo</label>
        </div>
        <div class="col-sm-9">
          <select name="tipo" id="tipo" class="form-control" required>
            <?php if ($idTipo==1) {
              $tipo='Góndola';
            } else {
              $tipo='Dolly';
            }
            echo '<option value="'.$idTipo.'">'.$tipo.'</option>';
             ?>
            <option value="1">Góndola</option>
            <option value="2">Dolly</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="placas" class="control-label">Placas</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="placas" id="placas" class="form-control" placeholder="<?=$placas;?>." value="<?=$placas;?>" required>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="serie" class="control-label">Serie</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="serie" id="serie" class="form-control" placeholder="<?=$serie;?>." value="<?=$serie;?>" required>
        </div>
      </div>
      <div class="form-group">
          <div class="col-sm-3">
            <label for="marca" class="control-label">Marca</label>
          </div>
          <div class="col-sm-9">
            <?php
            $sql2 = "SELECT * FROM catmarcas WHERE idCatTabla = '4' ORDER BY nombre ASC";
            $res2 = mysqli_query($link,$sql2) or die('<p class="text-danger">Notifica al Administrador</p>');
            ?>
            <select name="marca" id="marca" class="form-control" onchange="listarCatSubMarca(this.value)" placeholder="<?=$Marca;?>." value="<?=$idMarca;?>" required>
              <?php
              echo '<option value="'.$idMarca.'">'.$Marca.'</option>';
              while ($dat2 = mysqli_fetch_array($res2)) {
                echo '<option value="'.$dat2['id'].'">'.$dat2['nombre'].'</option>';
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

              <select name="submarca" id="submarca2" class="form-control" placeholder="<?=$subMarca;?>." value="<?=$idSubMarca;?>" required>
                <option value="<?=$idSubMarca;?>"><?=$subMarca;?></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-3">
              <label for="modelo" class="control-label">Ingresa Modelo</label>
            </div>
            <div class="col-sm-9">
              <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Modelo" value="<?=$modelo;?>" required>
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
                  $resp3 = mysqli_query($link,$msql3) or die('<p class="text-danger">Notifica al Administrador</p>');
                  ?>
                  <select name="poliza" id="poliza" class="form-control" placeholder="<?=$poliza;?>." value="<?=$idPoliza;?>" required>
                    <?php
                    echo '<option value="'.$idPoliza.'">'.$poliza.'</option>';
                    while ($dato3 = mysqli_fetch_array($resp3)) {
                      echo '<option value="'.$dato3['id'].'">'.$dato3['contrato'].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>


      <div class="form-group">
        <div class="col-sm-3">
          <label for="foto" class="control-label">Fotografía</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="foto" id="foto"  class="form-control foto" value="<?=$fotos;?>" >
        </div>
      </div>
      <div class="form-group">
          <div class="col-sm-3">
            <label for="vehiculo" class="control-label">Vehículo Asignado</label>
          </div>
          <div class="col-sm-9">
            <?php
            $ysql3 = "SELECT *
                      FROM vehiculos
                      WHERE complementos < '3' OR ISNULL(complementos) OR complementos = '0'
                      ORDER BY noEconomico ASC";
            $yresp3 = mysqli_query($link,$ysql3) or die('<p class="text-danger">Notifica al Administrador</p>');
            ?>
            <select name="vehiculo" id="vehiculo" class="form-control" placeholder="<?=$vehiculo;?>." value="<?=$idVehiculo;?>" required>
              <?php
              echo '<option value="'.$idVehiculo.'">'.$vehiculo.'</option>';
              while ($ydato3 = mysqli_fetch_array($yresp3)) {
                echo '<option value="'.$ydato3['id'].'">'.$ydato3['noEconomico'].'</option>';
              }
              ?>
            </select>
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
      <input type="hidden" name="ident" value="<?=$id;?>">
      <input type="hidden" name="veAnterior" value="<?=$idVehiculo;?>">
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

    function listarCatSubMarca(ident){
      $.post("../funciones/listaCatSubMarca.php",
        { ident:ident},
          function(respuesta){
            $("#submarca2").html(respuesta);
          });
    }


    </script>
		<!-- END JAVASCRIPT -->
