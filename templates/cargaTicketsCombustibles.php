<?php
define('INCLUDE_CHECK', 1);

require('../include/connect.php');
require('../include/connect_mvc.php');
require('../Models/Mdl_RendimientoCombustible.php');
$debug=0;

$fechaInicial = (!empty($_POST['fStart'])) ? $_POST['fStart'] : '';
$fechaFinal = (!empty($_POST['fEnd'])) ? $_POST['fEnd'] : '';
$operador = (!empty($_POST['operador'])) ? $_POST['operador'] : '';
$dateActual = date('m-Y');

$filtradoMes = ($fechaInicial != '' and $fechaFinal != '') ? "DATE_FORMAT(cgcomb.fechaReg, '%Y-%m-%d') BETWEEN '$fechaInicial'
 AND '$fechaFinal'" : "DATE_FORMAT(cgcomb.fechaReg, '%m-%Y') = '$dateActual'";
$filtradoOperador = $operador != '' ? 'op.id="' . $operador . '"' : '1=1';

$obj_rendimiento= new Rendimiento($debug, $idUserReg=0);


$sql = "SELECT cgcomb.*, gas.nombre AS Gasolinera, catcomb.nombre AS Combustible, op.nombre as Operador, ope.nombre as 
		Operador2, gas.credito AS gasCredito, av.idVehiculo AS idVehiculo, DATE_FORMAT(cgcomb.fechaReg, '%Y-%m-%d') AS f_fechaReg
		FROM cargacombustible cgcomb
		LEFT JOIN gasolineras gas on cgcomb.idGasolinera = gas.id
		LEFT JOIN catcombustibles catcomb ON cgcomb.idCatCombustible = catcomb.id
		LEFT JOIN viajes vjs ON cgcomb.idViaje = vjs.id
		LEFT JOIN asignavehiculos av ON vjs.idAsignaVehiculo = av.id
		LEFT JOIN operadores op ON av.idOperador = op.id
		LEFT JOIN vehiculos ve ON ve.id = cgcomb.idVehiculoPersonal
		LEFT JOIN asignavehiculos ave ON ve.id = ave.idVehiculo  AND ave.estatus='1'
		LEFT JOIN operadores ope ON ave.idOperador = ope.id
		WHERE $filtradoMes AND $filtradoOperador
		ORDER BY cgcomb.id DESC";
	//	echo $sql;
$res = mysqli_query($link, $sql) or die('<p class="text-danger">Notifica al Administrador de este Problema.' . mysqli_error($link) . '</p>');
?>
<div class="table-responsive">
	<table id="listadoDeTickets" class="table table-striped table-hover">
		<thead>
			<tr>
				<th>Folio</th>
				<th>Gasolinera</th>
				<th>Crédito</th>
				<th>Operador</th>
				<th>Combustible</th>
				<th>Litros</th>
				<th>Kilometraje</th>
				<th>Rendimiento</th>
				<th>KM. Recorridos</th>

				<th>Fecha</th>
				<th>Comprobación</th>
				<th>Reimprimir Ticket</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$cont = 0;
			while ($dat = mysqli_fetch_array($res)) {
				$cont++;
			/*	echo 'Folio:'.$dat['id'];

				echo 'Vehiculo:'.$dat['idVehiculo'];
				echo 'Fecha Reg:'.$dat['f_fechaReg'];*/

				$estatus = ($dat['estatus'] == 1) ? '<center class="text-success"  data-toggle="tooltip" data-placement="top"
				 title="" data-original-title="Registrado"><i class="md md-file-upload"></i></center>' : '<center class="text-danger"
				  data-toggle="tooltip" data-placement="top" title="" data-original-title="Sin Registrar"><i class="md md-close"></i></center>';

				$gastoFac = (isset($dat['idFactura']) and $dat['idFactura'] >= 1) ?
					'<button type="button" class="btn btn-icon-toggle text-success" data-toggle="modal" data-target="#cargaFac"
				 onclick="muestraFactura(' . $dat['id'] . ')"><i class="fa fa-copy" data-toggle="tooltip" data-placement="top" 
				 data-original-title="Mostrar Comprobante"></i></button>' :
					'<button type="button" class="btn btn-icon-toggle text-info" data-toggle="modal" data-target="#cargaFac" 
				onclick="cargaFactura(' . $dat['id'] . ')"><i class="glyphicon glyphicon-cloud-upload" data-toggle="tooltip" 
				data-placement="top" data-original-title="Subir Comprobante"></i></button>';

				$estatusText = ($dat['estatus'] == 1) ? '' : 'class="text-danger"';
				$comprobante = ($dat['doctoComprobante'] != '') ? '<i class="fa fa-check">' : '<i class="fa fa-close">';
				$estatusColor = ($dat['doctoComprobante'] != '') ? 'text-success' : '';
				$fecha = $dat['fechaReg'];
				if ($dat['gasCredito'] == 1) {
					$mensaje = 'Sí';
				} else {
					$mensaje = 'No';
				}
				$nomOperador = ($dat['Operador'] == '') ? $dat['Operador2'] : $dat['Operador'];
				$rendimiento=($dat['idVehiculoPersonal']=='' OR $dat['idVehiculoPersonal']=='0')?number_format($obj_rendimiento->rendimientoXVehiculo($dat['idVehiculo'], $dat['fechaReg'], $dat['fechaReg'], $dat['id']),2,'.',"'"):'N/A';
				$kmRecorridos=($dat['idVehiculoPersonal']=='' OR $dat['idVehiculoPersonal']=='0')?number_format($obj_rendimiento->calculoKilometraje($dat['id'], $dat['idVehiculo']),2,'.',"'"):'N/A';

				echo '
				<tr ' . $estatusText . '>
					<td>' . $dat['id'] . '</td>
					<td>' . $dat['Gasolinera'] . '</td>
					<td>' . $mensaje . '</td>
					<td>' . $nomOperador . '</td>
					<td>' . $dat['Combustible'] . '</td>
					<td>' . $dat['cant'] . '</td>
					<td>' . number_format($dat['kilometraje'], 0, '', "'") . '</td>
					<td>' . $rendimiento. '</td>
					
					<td>' . $kmRecorridos. '</td>


					<td>' . $dat['fechaReg'] . '</td>
					<td class="col-lg-1 text-center ' . $estatusColor . '" id="mttoEstatus' . $dat['id'] . '">' . $estatus . '</td>
					<td class="text-center">
						<form method="POST" action="funciones/reimprimeTicketCombustible.php" target="_blank">
						<input type="hidden" value="' . $dat['id'] . '" name="ident">
							<button type="submit" class="btn btn-icon-toggle" class="btn btn-icon-toggle text-default" 
							data-toggle="tooltip" data-placement="top" data-original-title="Reimprimir Ticket."><i class="fa fa-file-pdf-o"></i></button>
						</form>
					</td>
				</tr>';
			}
			?>
		</tbody>
	</table>
</div>
<!--end .table-responsive -->
<script>
	$('#listadoDeTickets').DataTable({
		dom: 'Bfrtip',
		"order": [
			[0, "desc"]
		], //or asc
		"iDisplayLength": 10,
		"language": {
			"lengthMenu": '_MENU_ entradas por página',
			"info": "Mostrando páginas _PAGE_ de _PAGES_",
			"sInfo": "Mostrando _START_ al _END_ de _TOTAL_ entradas",
			"sInfoEmpty": "Mostrando 0 al 0 de 0 entradas",
			"infoFiltered": " - filtrado de _MAX_ registros",
			"sInfoFiltered": "(filtrado de _MAX_ entradas totales.)",
			"zeroRecords": "No hay registros que mostrar.",
			"search": '<i class="fa fa-search"></i>',
			"paginate": {
				"previous": '<i class="fa fa-angle-left"></i> Atrás   ',
				"next": '   Siguiente <i class="fa fa-angle-right"></i>'
			}
		},
		buttons: [
			'copy', 'csv', 'excel', 'print',
			{
				extend: 'pdfHtml5',
				orientation: 'landscape',
				pageSize: 'LEGAL',
			}
		]
	});

	$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary text-white mr-1');
</script>