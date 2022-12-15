<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT * FROM casetas WHERE id='$id'";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaDeptoLabel"><b>Editar Caseta: </b><?=$dat['nombre'];?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaRutaCaseta.php">
    <div class="modal-body" id="editaDeptoBody">
      <?php
      error_reporting(E_ALL); //muestra todos los errores encontrados en la página
      $id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
      $sql="SELECT rtcst.*, ru.destino1 AS d1, ru.destino2 AS d2, ru.destino3 AS d3, cst.nombre AS nomCaseta
            FROM rutacaseta rtcst
            LEFT JOIN casetas cst ON cst.id = rtcst.idCaseta
            LEFT JOIN rutas ru ON ru.id = rtcst.idRuta
            WHERE rtcst.idRuta = '$id'
            ORDER BY rtcst.id";
      $result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');
      $sql2="SELECT *
              FROM casetas cst
              ORDER BY cst.nombre ASC";
      $res2=mysqli_query($link,$sql2) OR DIE ('<p class="text-danger">Notifica a tu Administrador</p>');

      $i=0;
       while ($dat = mysqli_fetch_array($result)) {
         if ($dat['d3']!='') {
           $ruta = $dat['d1'].'-'.$dat['d2'].'-'.$dat['d3'];
         } else {
           $ruta = $dat['d1'].'-'.$dat['d2'];
         }

         if ($dat['tipo']=='1') {
           $ad='Ida';
         } elseif ($dat['tipo']=='2') {
           $ad='Regreso';
         }else {
           // code...
         }

       ?>
      <div class="form-group">
        <div class="col-sm-3">
          <label for="estatus" class="control-label">Caseta de <?=$ad?></label>
        </div>
        <div class="col-sm-9">
          <select id="caseta" name="caseta[]" class="form-control" >
            <option value="<?=$dat['idCaseta'];?>"><?=$dat['nomCaseta'];?></option>
            <?php
            echo '<option value="'.$dat['idCaseta'].'">'.$dat2['nomCaseta'].'</option>';
            while ($dat2 = mysqli_fetch_array($res2)) {
              echo '
              <option value="'.$dat2['id'].'">'.$dat2['nombre'].'</option>
              ';
            }
            mysqli_data_seek($res2, 0);
             ?>
          </select>
          <div class="col-sm-1" name="caseta[]"><input type="hidden" name="id[]" value="<?=$dat['id'];?>"></div>
        </div>
      </div>
    <?php $i++; } ?>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="cont" value="<?=$i;?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>
