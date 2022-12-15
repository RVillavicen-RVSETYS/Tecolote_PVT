<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;

$sql="SELECT mts.*, ctm.nombre AS tipoMtto,
	ctsm.nombre AS tipoServicio,
	prd.nombre AS pro,
	fct.urlXML AS XML,
	fct.urlPDF AS pdf,
	fct.doctoComprobante AS doctoComprobante,
	tlls.nombre AS nomTaller,
	CONCAT(
		'ECO - ',
		vh.noEconomico,
		' (',
		vh.placas,
		')'
	) AS veh,
	fts.url AS fotoMtto,
	mts.monto AS mtMonto, vh.noEconomico AS noEco
FROM
	mttos mts
INNER JOIN cattipomttos ctm ON mts.idCatTipoMtto = ctm.id
INNER JOIN catserviciosmttos ctsm ON mts.idCatTipoMtto = ctsm.id
LEFT JOIN stocks sks ON mts.idStockReparado = sks.id
LEFT JOIN productos prd ON sks.idProducto = prd.id
LEFT JOIN facturas fct ON mts.idFactura = fct.id
INNER JOIN talleres tlls ON mts.idTaller = tlls.id
INNER JOIN asignavehiculos asv ON mts.idAsignaVehiculo = asv.id
INNER JOIN vehiculos vh ON asv.idVehiculo = vh.id
LEFT JOIN fotos fts ON fts.tabla = mts.id
AND fts.idTabla = 6
WHERE	1 = 1 AND mts.id = $id
GROUP BY mts.id
ORDER BY
	mts.id ASC";
$result=mysqli_query($link,$sql) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');

$mtto=mysqli_fetch_array($result);
$eco = $mtto['noEco'];
if ($mtto['mtMonto'] > 0) {
	$monto = $mtto['mtMonto'];
} else {
	$monto = 'S/R';
}
?>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title txt-primary" id="editaClienteLabel"><b>Editar Mantenimiento <?=$mtto['tipoMtto'];?></b></h4>
  </div>
  <form class="form-horizontal" role="form" method="post" action="../funciones/editaConMtto.php"  enctype="multipart/form-data">
    <div class="modal-body" id="editaConsultaMttoBody">

			<div class="form-group">
        <div class="col-sm-3">
          <label for="peso" class="control-label">Precio del Mtto</label>
        </div>
        <div class="col-sm-9">
          <input type="number" step="any" name="precio" id="precio" class="form-control" onkeyup="soloNumeros(this.value, 'precio')" placeholder="Precio del Mantenimiento" value="<?=$monto;?>" required>
        </div>
      </div>

			<div class="form-group">
        <div class="col-sm-3">
          <label for="fechaEntrega" class="control-label">Fecha de Entrega</label>
        </div>
        <div class="col-sm-9">
          <input type="date" name="fechaEntrega" id="fechaEntrega" class="form-control fechado" placeholder="Fecha de Entrega" value="<?=$dat['fechaEntrega'];?>" required>
        </div>
      </div>
			<!--	monto, peso, fechaCarga, tKilometros, ePago, eViaje		-->
			<div class="form-group">
        <div class="col-sm-3">
					<label for="fotoEntrega" class="control-label">Foto de Entrega</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="url" id="url"  class="form-control foto">
        </div>
      </div>
			<div class="form-group">
        <div class="col-sm-3">
					<label for="doctoComprobante" class="control-label">Comprobante o Ticket</label>
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
			<div class="form-group">
        <div class="col-sm-3">
					<label for="urlXML" class="control-label">XML</label>
        </div>
        <div class="col-sm-9">
          <input type="file" name="urlXML" id="urlXML"  class="form-control xml">
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="ident" value="<?=$id;?>">
			<input type="hidden" name="eco" value="<?=$eco;?>">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-primary">Modificar</button>
    </div>
  </form>
