<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
$sql="SELECT cli.nombre AS nomCliente, ru.destino1 AS d1, ru.destino2 AS d2, ru.destino3 AS d3,
				cmat.nombre AS nomMaterial, pmat.precio AS precioMaterial, pmat.id AS idPmat, pmat.idCatMaterial AS idMat,
				pmat.idCliente AS idCliente, pmat.idRuta AS idRuta
				FROM preciomateriales pmat
				INNER JOIN catmateriales cmat ON cmat.id = pmat.idCatMaterial
				INNER JOIN rutas ru ON ru.id = pmat.idRuta
				INNER JOIN clientes cli ON cli.id = pmat.idCliente
				WHERE pmat.id='$id'
				ORDER BY cli.nombre ASC
";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$dat=mysqli_fetch_array($result);
if ($dat['d3']!='') {
  $ruta = $dat['d1'].'-'.$dat['d2'].'-'.$dat['d3'];
} else {
  $ruta = $dat['d1'].'-'.$dat['d2'];
}
$id = $dat['idPmat'];
$idCliente = $dat['idCliente'];
$cliente = $dat['nomCliente'];
$idMaterial = $dat['idMat'];
$material = $dat['nomMaterial'];
$precio = $dat['precioMaterial'];
$idRuta = $dat['idRuta'];
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="editaFilaLabel"><b>Edita Material: </b><?=$material;?></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaPrecioMaterial.php">
    <div class="modal-body" id="editaFilaBody">
      <div class="form-group">
        <div class="col-sm-3">
          <label for="edMaterial" class="control-label">Nombre</label>
        </div>
        <?php
        require('../include/connect.php');
        $sql2 = "SELECT *
              FROM catmateriales cmat
              WHERE cmat.estatus = 1
              ORDER BY cmat.nombre ASC
          ";
        //echo $sql;
        $res = mysqli_query($link,$sql2) or die('<p class="text-danger">Notifica al Administrador</p>');
        ?>
        <div class="col-sm-9">
          <select name="edMaterial" id="edMaterial" class="form-control" value="<?=$idMaterial;?>">
            <?php
            echo '<option value="'.$idMaterial.'">'.$material.'</option>';
            while ($dat2 = mysqli_fetch_array($res)) {
              echo '<option value="'.$dat2['id'].'">'.$dat2['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="edPrecio" class="control-label">Precio</label>
        </div>
        <div class="col-sm-9">
          <input type="number" step="any" class="form-control" name="edPrecio" id="edPrecio" value="<?=$precio;?>" required>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="edRuta" class="control-label">Ruta</label>
        </div>
        <?php
        require('../include/connect.php');
        $sql3 = "SELECT *
              FROM rutas rut
              WHERE rut.estatus = 1
              ORDER BY rut.tipoViaje DESC,rut.destino1 ASC
          ";
        //echo $sql;
        $res3 = mysqli_query($link,$sql3) or die('<p class="text-danger">Notifica al Administrador</p>');
        ?>
        <div class="col-sm-9">
          <select name="edRuta" id="edRuta" class="form-control" value="<?=$idRuta;?>">
            <?php
            echo '<option value="'.$idRuta.'">RUTA: '.$ruta.'</option>';
            while ($dat3 = mysqli_fetch_array($res3)) {
              if ($dat3['destino3']!='') {
                $ruta2 = $dat3['destino1'].'-'.$dat3['destino2'].'-'.$dat3['destino3'];
              } else {
                $ruta2 = $dat3['destino1'].'-'.$dat3['destino2'];
              }
              echo '<option value="'.$dat3['id'].'">RUTA: '.$ruta2.'</option>';
            }
            ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-3">
          <label for="editaContacto" class="control-label">Cliente</label>
        </div>
        <?php
        require('../include/connect.php');
        $sql4 = "SELECT *
									FROM clientes
									ORDER BY nombre ASC
                  ";
        //echo $sql;
        $res4 = mysqli_query($link,$sql4) or die('<p class="text-danger">Notifica al Administrador</p>');
        ?>
        <div class="col-sm-9">
          <select name="editaCliente" id="editaCliente" class="form-control" value="<?=$idCliente;?>">
            <?php
            echo '<option value="'.$idCliente.'">'.$cliente.'</option>';
            while ($dat4 = mysqli_fetch_array($res4)) {
              echo '<option value = "'.$dat4['id'].'">'.$dat4['nombre'].'</option>';
            }
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$id;?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>
