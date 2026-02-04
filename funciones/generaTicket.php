<?php
function ticketCargaCombustible($ident){
  require('../include/connect.php');

  $sql="SELECT vhc.id AS idVehiculoOperador,cgc.*, gsl.nombre AS nameGas, CONCAT(gsl.direccion, ', ',mpoGas.nombre, ', ',edoGas.nombre) AS dirGas, cbt.nombre AS combustible, CONCAT(opr.nombre,' ',opr.apellidos) AS nameOper,
        	vhc.noEconomico, CONCAT(usr.nombre,' ',usr.apellidos) AS autoriza
        FROM cargacombustible cgc
        LEFT JOIN gasolineras gsl ON cgc.idGasolinera = gsl.id AND gsl.estatus = '1'
        LEFT JOIN catestados edoGas ON gsl.idCatEstado = edoGas.id
        LEFT JOIN catmunicipios mpoGas ON gsl.idCatMunicipio = mpoGas.id
        LEFT JOIN catcombustibles cbt ON cgc.idCatCombustible = cbt.id AND cbt.estatus = '1'
        LEFT JOIN viajes vjs ON cgc.idViaje = vjs.id
        LEFT JOIN asignavehiculos avh ON vjs.idAsignaVehiculo = avh.id AND avh.estatus = '1'
        LEFT JOIN operadores opr ON avh.idOperador = opr.id AND opr.estatus = '1'
        LEFT JOIN vehiculos vhc ON avh.idVehiculo = vhc.id AND vhc.estatus = '1'
        LEFT JOIN segusuarios usr ON cgc.idUserReg = usr.id
        WHERE cgc.id = '$ident'";
#  echo $sql;
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al Consultar los Datos del Ticket.'.mysqli_error($link)));
  $var = mysqli_fetch_array($result);

$identVehiculo = ($var['idVehiculoPersonal'] >= '1') ? $var['idVehiculoPersonal'] : $var['idVehiculoOperador'] ;
  $sqlKm = "SELECT cgc.id, ve.id AS idVehiculoOperador, COALESCE(MAX(cgc.kilometraje)) AS kilometraje2
            FROM vehiculos ve
            INNER JOIN asignavehiculos asg ON ve.id = asg.idVehiculo
            LEFT JOIN viajes vjs ON asg.id = vjs.idAsignaVehiculo
            LEFT JOIN cargacombustible cgc ON vjs.id = cgc.idViaje
            WHERE
            ve.id = '$identVehiculo' AND cgc.id < '$ident'
            ORDER BY cgc.id DESC
            LIMIT 2";

  $resKm = mysqli_query($link,$sqlKm) or die (errorBD('Problemas al Consultar el Kilometraje.'.mysqli_error($link)));
  $datKm = mysqli_fetch_array($resKm);
    $rendimiento = $recorrido = 0;
    $odometroActual = $var['kilometraje'];
    $odometroAnterior = $datKm['kilometraje2'];

  $recorrido = $odometroActual - $odometroAnterior;
  $rendimiento = ($var['cant'] > 0 && $recorrido > 0) ? ($recorrido / $var['cant']) : 0 ;
/*
  echo 'sqlKm: <br>'.$sqlKm.'<br>';
  echo 'valores <br>';
  echo 'odometro1: '.$odometroActual.'; odometro2: '.$odometroAnterior.'; recorrido: '.$recorrido.'; Rendimiento: '.$rendimiento;
 # */
  echo '<table border="0" style="font-size:13px" width="270px">';
  cabeceraTkt();
  echo '<tr>
          <td colspan="2" style="font-size:14px"><br>'.$var['fechaReg'].'</td>
          <td align="right" style="font-size:17px"><br><b>Folio: '.$var['id'].'</b></td>
        </tr>
        <tr><th colspan="3" align="center" style="font-size:16px"><br>Gasolinera: '.$var['nameGas'].'<br>'.$var['dirGas'].'</th></tr>

        <tr><th colspan="3" align="center" style="font-size:16px"><br>Carga de Combustible</th></tr>
        <tr><td colspan="2" style="font-size:16px"><br>No Economico: </td><td><br>'.$var['noEconomico'].'</td></tr>
        <tr><td colspan="2" style="font-size:17px">Combustible: </td><td style="font-size:17px">'.$var['combustible'].'</td></tr>
        <tr><td colspan="2" style="font-size:17px">Cantidad: </td><td style="font-size:17px">'.$var['cant'].' Lts</td></tr>
    		<tr><td colspan="2" style="font-size:16px">Operador: </td><td>'.$var['nameOper'].'</td></tr>
    		<tr><td colspan="4" align="center">&nbsp;<br></td></tr>
        <tr><td colspan="2" style="font-size:16px">Odómetro <br>Anterior: </td><td>'.number_format($odometroAnterior,2,'.',',').' KM</td></tr>
        <tr><td colspan="2" style="font-size:16px">Odómetro <br>Actual: </td><td>'.number_format($odometroActual,2,'.',',').' KM</td></tr>
        <tr><td colspan="2" style="font-size:16px">Recorrido: </td><td>'.number_format($recorrido,2,'.',',').' KM</td></tr>
        <tr><td colspan="2" style="font-size:16px">Rendimiento: </td><td>'.number_format($rendimiento,2,'.',',').' KM/LT</td></tr>
        <tr><td colspan="4" align="center">&nbsp;<br></td></tr>
        <tr><td colspan="4" align="center">&nbsp;<br></td></tr>
        <tr><td colspan="4" align="center"><br><hr aling="center" size="2"></td></tr>
    		<tr><th colspan="4" align="center">Autoriza: '.$var['autoriza'].'<br></th></tr>
    		<tr><td colspan="4" align="center">&nbsp;<br></td></tr>
        <tr><td colspan="4" align="center">&nbsp;<br></td></tr>
        <tr><td colspan="4" align="center"><br><hr aling="center" size="2"></td></tr>
        <tr><th colspan="4" align="center">Operador: '.$var['nameOper'].'<br></th></tr>';

}

#############################################======================================================###########################################

function ticketCargaCombustible2($ident){
  require('../include/connect.php');

  $sql="SELECT cgc.fechaReg, cgc.id,	cgc.cant,	gsl.nombre AS nameGas,	CONCAT(gsl.direccion, ', ',	mpoGas.nombre, ', ',	edoGas.nombre	) AS dirGas,	cbt.nombre AS combustible,
        	CONCAT(opr.nombre,	' ',	opr.apellidos	) AS nameOper, CONCAT(	usr.nombre,	' ',	usr.apellidos) AS autoriza,	CONCAT(ctpv.nombre, ' Placas: ', vhc.placas) AS nomVehiculo
        FROM	cargacombustible cgc
        LEFT JOIN gasolineras gsl ON cgc.idGasolinera = gsl.id
        AND gsl.estatus = '1'
        LEFT JOIN catestados edoGas ON gsl.idCatEstado = edoGas.id
        LEFT JOIN catmunicipios mpoGas ON gsl.idCatMunicipio = mpoGas.id
        LEFT JOIN catcombustibles cbt ON cgc.idCatCombustible = cbt.id
        AND cbt.estatus = '1'
        LEFT JOIN vehiculos vhc ON cgc.idVehiculoPersonal = vhc.id
        AND vhc.estatus = '1'
        LEFT JOIN asignavehiculos avh ON vhc.id = avh.idVehiculo
        AND avh.estatus = '1'
        LEFT JOIN operadores opr ON avh.idOperador = opr.id
        AND opr.estatus = '1'

        LEFT JOIN segusuarios usr ON cgc.idUserReg = usr.id
        LEFT JOIN cattipovehiculos ctpv ON ctpv.id = vhc.idCatTipoVehiculo
        WHERE	cgc.id = '$ident'";
  #echo $sql;
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al Consultar los Datos del Ticket.'.mysqli_error($link)));
  $var = mysqli_fetch_array($result);

  echo '<table border="0" style="font-size:13px" width="270px">';
  cabeceraTkt();
  echo '<tr>
          <td colspan="2" style="font-size:14px"><br>'.$var['fechaReg'].'</td>
          <td align="right" style="font-size:17px"><br><b>Folio: '.$var['id'].'</b></td>
        </tr>
        <tr><th colspan="3" align="center" style="font-size:16px"><br>Gasolinera: '.$var['nameGas'].'<br>'.$var['dirGas'].'</th></tr>

        <tr><th colspan="3" align="center" style="font-size:16px"><br>Carga de Combustible</th></tr>
        <tr><td colspan="2" style="font-size:16px"><br>Vehículo: </td><td><br><strong>'.$var['nomVehiculo'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:17px">Combustible: </td><td style="font-size:17px"><strong>'.$var['combustible'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:17px">Cantidad: </td><td style="font-size:17px"><strong>'.$var['cant'].' Lts</strong></td></tr>
    		<tr><td colspan="2" style="font-size:16px">Operador: </td><td><strong>'.$var['nameOper'].'</strong></td></tr>
    		<tr><td colspan="4" align="center" style=" margin-top:15px; padding-top:50px; "><hr aling="center" size="2"></td></tr>
    		<tr><th colspan="4" align="center">Autoriza: '.$var['autoriza'].'<br></th></tr>
    		<tr><td colspan="4" align="center" style=" margin-top:15px; padding-top:50px; "><hr aling="center" size="2"></td></tr>
        <tr><th colspan="4" align="center">Operador: '.$var['nameOper'].'<br></th></tr>';
}
#############################################======================================================###########################################
function ticketGeneraVenta($ident){
  require('../include/connect.php');

  //print_r($_SESSION);

  $sql="SELECT vts.id AS ident, CONCAT(usr.nombre, ' ', usr.apellidos) AS usuario, vts.fechaReg, vh.noEconomico, cbt.nombre as nameCombustible,
          opr.nombre AS nameOperador, vts.fechaCarga, mtr.nombre as material, rts.*
        FROM ventas vts
        INNER JOIN clientes clt ON vts.idCliente = clt.id
        INNER JOIN segusuarios usr ON vts.idUserReg = usr.id
        INNER JOIN viajes vjs ON vts.id = vjs.idVenta
        INNER JOIN asignavehiculos asvh ON  vjs.idAsignaVehiculo = asvh.id
        INNER JOIN vehiculos vh ON asvh.idVehiculo = vh.noEconomico
        INNER JOIN catcombustibles cbt ON vh.idCatCombustible = cbt.id
        INNER JOIN operadores opr ON asvh.idOperador = opr.id
        INNER JOIN catmateriales mtr ON vts.idCatMaterial = mtr.id
        INNER JOIN rutas rts ON vts.idRuta = rts.id
        WHERE vts.id = '$ident'";
  //echo $sql;
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al Consultar los Datos del Ticket.'.mysqli_error($link)));
  $var = mysqli_fetch_array($result);
  $dest1 = substr($var['destino1'], 0, 4);
  $dest2 = substr($var['destino2'], 0, 4);
  $dest3 = substr($var['destino3'], 0, 4);

  $ruta = $var['tipoViaje'].': '.$dest1.'/'.$dest2.'/'.$dest3;

  echo '<table border="0" style="font-size:13px" width="270px">';
  cabeceraTkt();
  echo '<tr>
          <td colspan="2" style="font-size:14px"><br>'.$var['fechaReg'].'</td>
          <td align="right" style="font-size:17px"><br><b>Folio Venta: '.$var['ident'].'</b></td>
        </tr>
        <tr><th colspan="3" align="center" style="font-size:16px"><br>Datos del Cliente:</th></tr>

        <tr><td colspan="2" style="font-size:16px"><br>No Economico: </td><td><br><strong>'.$var['noEconomico'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:16px">Operador: </td><td><strong>'.$var['nameOperador'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:16px">Fecha de Carga: </td><td><strong>'.$var['fechaCarga'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:16px">Material Cargado: </td><td><strong>'.$var['material'].'</strong></td></tr>
    		<tr><td colspan="2" style="font-size:16px">Destinos: </td><td><strong>'.$ruta.'</strong></td></tr>
        <tr><td colspan="2" style="font-size:16px">Cantidad Pesada: </td><td colspan="2" align="center" style=" margin-top:15px; padding-top:50px; "><hr aling="center" size="2"></td></tr>
    		<tr><td colspan="1" style="font-size:16px; padding-top:40px; ">Autoriza: </td><td colspan="3"  style="padding-top:40px; ">'.$_SESSION['ATZnombreUser'].'</td></tr>
    		<tr><td colspan="4" align="center" style=" margin-top:15px; padding-top:50px; "><hr aling="center" size="2"></td></tr>
        <tr><th colspan="4" align="center">Operador: '.$var['nameOperador'].'<br></th></tr>';
}

#############################################======================================================###########################################

function ticketAsignacion($ident){
  require('../include/connect.php');

  //print_r($_SESSION);

  $sql="SELECT CONCAT(opr.nombre,' ',opr.apellidos) AS nameOperador, asg.fechaReg, asg.id AS ident, vhc.noEconomico
        FROM asignaciones asg
				INNER JOIN asignavehiculos asgvh ON asg.idAsignaVehiculo = asgvh.id
				INNER JOIN operadores opr ON asgvh.idOperador = opr.id
				INNER JOIN vehiculos vhc ON asgvh.idVehiculo = vhc.id
        WHERE asg.id = '$ident'";
  //echo $sql;
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al Consultar los Datos del Ticket.'.mysqli_error($link)));
  $var = mysqli_fetch_array($result);

  echo '<table border="0" style="font-size:13px" width="270px">';
  cabeceraTkt();
  echo '<tr>
          <td colspan="2" style="font-size:14px"><br>'.$var['fechaReg'].'</td>
          <td align="right" style="font-size:17px"><br><b>Folio Asignación: '.$var['ident'].'</b></td>
        </tr>
        <tr><th colspan="3" align="center" style="font-size:16px"><br>Datos del Operador:</th></tr>
        <tr><td colspan="2" style="font-size:16px"><br>No Economico: </td><td><br><strong>'.$var['noEconomico'].'</strong></td></tr>
        <tr><td colspan="2" style="font-size:16px">Operador: </td><td><strong>'.$var['nameOperador'].'</strong></td></tr>
        <tr><th colspan="3" align="center" style="font-size:16px"><br>Material Asignado</th></tr>';

  $sql="SELECT pdt.nombre AS nomPro, stk.noSerie AS numSerie
        FROM asignaciones asg
        INNER JOIN detasigna dtsg on asg.id = dtsg.idAsignacion
        INNER JOIN stocks stk ON dtsg.idStock = stk.id
        INNER JOIN productos pdt ON stk.idProducto = pdt.id
        WHERE asg.id = '$ident'";
  //echo $sql;
  $result=mysqli_query($link,$sql) or die(errorBD('Problemas al Consultar los Datos del Ticket.'.mysqli_error($link)));

  while ($prod = mysqli_fetch_array($result)) {
    echo '<tr><td colspan="2" style="font-size:16px"><br>Nombre: </td><td><br><strong>'.$prod['nomPro'].'</strong></td></tr>
    <tr><td colspan="2" style="font-size:16px">Serie: </td><td><strong>'.$prod['numSerie'].'</strong></td></tr>';
  }

  echo '

        <tr><td colspan="4" align="center" style=" margin-top:15px; padding-top:50px; "><hr aling="center" size="2"></td></tr>
    		<tr><td colspan="1" style="font-size:16px; padding-top:40px; ">Autoriza: </td><td colspan="3"  style="padding-top:40px; ">'.$_SESSION['ATZnombreUser'].'</td></tr>
    		<tr><td colspan="4" align="center" style=" margin-top:15px; padding-top:50px; "><hr aling="center" size="2"></td></tr>
        <tr><th colspan="4" align="center">Operador: '.$var['nameOperador'].'<br></th></tr>';
}


function cabeceraTkt(){
  echo '
		<tr>
			<th colspan="4" align="center"><img class="img-circle" src="../assets/img/logo.png" width="100px"></th>
		</tr>
		<tr>
    	<th colspan="4" align="center" style="font-size:18px">TECOLOTE</th>
	  </tr>
		<tr>
    	<th colspan="4" align="center" style="font-size:12px">Axochiapan Mor. México</th>
	  </tr>
    <tr>
			<td colspan="4"></td>
		</tr>';
}

?>
