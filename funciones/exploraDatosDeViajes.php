<?php
session_start();
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');

$ident = (isset($_POST['ident'])) ? $_POST['ident'] : '' ;

$sql = "SELECT vjs.*, vhs.idCatCombustible, cbt.nombre AS combustible, vhs.cantActualLts, vhs.capacidadLts, rta.litrosRequerido,
        rta.id, rta.dist1, rta.dist2, rta.dist3, avh.idOperador, vhs.id AS identVehiculo
        FROM viajes vjs
        INNER JOIN asignavehiculos avh ON vjs.idAsignaVehiculo = avh.id
        INNER JOIN vehiculos vhs ON avh.idVehiculo = vhs.id
        INNER JOIN catcombustibles cbt ON vhs.idCatCombustible = cbt.id
        INNER JOIN ventas vta ON vjs.idVenta = vta.id
        INNER JOIN rutas rta ON vta.idRuta = rta.id
        WHERE vjs.id = '$ident'
        LIMIT 1";
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));
$cantRes = mysqli_num_rows($result);
$dat = mysqli_fetch_array($result);
$idAsignaVehiculo = $dat['idAsignaVehiculo'];
$identVehiculo = $dat['identVehiculo'];

$sql2 = "SELECT cgc.id, vhc.kilometros, IFNULL(MAX(cgc.kilometraje),0) AS odometro, IF(vhc.kilometros > IFNULL(MAX(cgc.kilometraje),0),vhc.kilometros,IFNULL(MAX(cgc.kilometraje),0)) AS odoFinal
FROM vehiculos vhc
INNER JOIN asignavehiculos asgv ON vhc.id = asgv.idVehiculo
LEFT JOIN viajes vjs ON asgv.id = vjs.idAsignaVehiculo
LEFT JOIN cargacombustible cgc ON vjs.id = cgc.idViaje
WHERE vhc.id = '$identVehiculo'
GROUP BY vhc.id;";
$result2 = mysqli_query($link,$sql2) or die(errorBD('Disculpen las molestias, estamos experimentando algunos inconvenientes.<br> Por favor notifica al Administrador.'.mysqli_error($link)));
$dato = mysqli_fetch_array($result2);
$cantDatos = mysqli_num_rows($result2);


if ($cantRes >= '2' OR $cantRes == 0) {
  errorBD('Hay un problema con tu registro notifica al Administrador.');
}
$tipoCombustible = '<option value="'.$dat['idCatCombustible'].'">'.$dat['combustible'].'</option>';
$lts = $dat['cantActualLts'];
$ltsTanq = $dat['capacidadLts'];
$ltsOP = ($lts == 0) ? 1 : $lts ;
$porcentajeLts = ($ltsTanq * 100) / $ltsOP;
$ltsRuta = $dat['litrosRequerido'];
$kmtsRuta = $dat['dist1'] + $dat['dist2'] +$dat['dist3'];

$estatusGas = '<span class=""><i class="fa fa-check"></i></span> ';
$cantActualLts = '<hr>
                    '.$estatusGas.'<span><b>Actualmente Quedan:</b> '.number_format($lts).' lts. en un tanque de '.$ltsTanq.' lts. <span> <br>
                    '.$estatusGas.'<span><b>Litros Requeridos:</b> '.number_format($ltsRuta).' lts. para cubrir su Ruta. <span> <br>
                    '.$estatusGas.'<span><b>Kilometros a Recorrer:</b> '.number_format($kmtsRuta).' kmts. a recorrer en la Ruta. <span> <br>
                  <hr>';
    if ($cantDatos >= 1) {
        $kilometros = $dato['odoFinal'];
      } else {
        $kilometros = 0;
      }
echo '1|'.$tipoCombustible.'|'.$cantActualLts.'|'.$kilometros;


function errorBD($error){
  echo '0|'.$error;
  exit(0);
}
?>
