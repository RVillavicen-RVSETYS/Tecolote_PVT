<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();
$identif = (isset($_POST['identCargaFactura']) AND $_POST['identCargaFactura']!='') ? $_POST['identCargaFactura'] : '' ;
$userReg = $_SESSION['RVTident'];
$fechaAct = date('Y-m-d H:i:s');

print_r($_POST);
echo '<br>----Files<br>';
print_r($_FILES)['upComp'];

$sql="SELECT id
      FROM cargaCombustible
      WHERE id = '$identif'";
//echo $sql;
$result=mysqli_query($link,$sql) or die(errorBD('Lo sentimos, este sitio web está experimentando problemas al cargar tus Registros.<br> Por favor notifica al Administrador.'));
$gast = mysqli_fetch_array($result);

$cant = mysqli_num_rows($result);
 //echo '<br>Cant = '.$cant.'<br>';
if ($cant == 1) {

  //-------------------------- Trabajando con Archivo -------------------------
  if ($_FILES["factPDF"]["error"] > 0 ){
    //echo "Error: " . $_FILES['factPDF']['error'] . "<br>";
    $_SESSION['RVTmsjInfoGasto'] = 'No se pudo cargar tu PDF inténtalo nuevamente.';
    ////header('location: ../cargaCombustible.php');
  } elseif ($_FILES["factXML"]["error"] > 0 ){
    //echo "Error: " . $_FILES['factXML']['error'] . "<br>";
    $_SESSION['RVTmsjInfoGasto'] = 'No se pudo cargar tu XML inténtalo nuevamente.';
    ////header('location: ../cargaCombustible.php');
  }
  else{
    //--------------------- Obteniendo extencion del Archivo -------------------
    //------PDF
    $archivo = $_FILES['factPDF']['name'];
    $valores = explode(".", $archivo);
    $extension = $valores[count($valores)-1];

    $fileName = $gast['id'].'-FacturaPDF';
    $fileName = str_replace(" ", "_", $fileName).'.'.$extension;

    //------XML
    $archivoXML = $_FILES['factXML']['name'];
    $valoresXML = explode(".", $archivoXML);
    $extensionXML = $valoresXML[count($valoresXML)-1];

    $fileNameXML = $gast['id'].'-FacturaXML';
    $fileNameXML = str_replace(" ", "_", $fileNameXML).'.'.$extensionXML;


    //------ Se valida que exista La Carpeta y si no se Crea-------------------------
    $carpeta = '../doctos/'.$userReg.'/Info-'.$informe.'/';
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }
    $url = $carpeta.$fileName;
    $urlXML = $carpeta.$fileNameXML;

    //--------------------------Datos para Carga de Archivos Lista ------------------------------
    echo "Nombre Nuevo: " . $fileName . "<br>";
    echo "Tipo: " . $_FILES['factPDF']['type'] . "<br>";
    echo "Tamaño: " . ($_FILES["factPDF"]["size"] / 1024) . " kB<br>";
    echo "Carpeta temporal: " . $_FILES['factPDF']['tmp_name'] . " <br>";
    echo '<br><br>';
    echo "Nombre Nuevo XML: " . $fileNameXML . "<br>";
    echo "Tipo XML: " . $_FILES['factXML']['type'] . "<br>";
    echo "TamañoXML: " . ($_FILES["factXML"]["size"] / 1024) . " kB<br>";
    echo "Carpeta temporal XML: " . $_FILES['factXML']['tmp_name'] . " <br>";
    echo '<br><br>';
    echo "Carpeta Final: " . $carpeta . " <br>";
    echo "URLPDF: " . $url . " <br>";
    echo "URLXML: " . $urlXML . " <br>";

    //--------------------------Se mueven Archivos para trabajarlos ------------------------------
    move_uploaded_file($_FILES['factPDF']['tmp_name'], $url);
    move_uploaded_file($_FILES['factXML']['tmp_name'], $urlXML);


    //---------------------------------------------------------------------------------------------
    //--------------------------Comenzamos a leer el XML ------------------------------------------
    //---------------------------------------------------------------------------------------------
    $xml = simplexml_load_file($urlXML);
    $ns = $xml->getNamespaces(true);
    $xml->registerXPathNamespace('c', $ns['cfdi']);
    $xml->registerXPathNamespace('t', $ns['tfd']);


    //EMPIEZO A LEER LA INFORMACION DEL CFDI E IMPRIMIRLA
    foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante){
      $folio = (isset($cfdiComprobante['Folio'])) ? $cfdiComprobante['Folio'] : '' ;
      $monto = (isset($cfdiComprobante['Total'])) ? $cfdiComprobante['Total'] : '' ;
      $subTotal = (isset($cfdiComprobante['SubTotal'])) ? $cfdiComprobante['SubTotal'] : '' ;
      $fechaFac = (isset($cfdiComprobante['Fecha'])) ? $cfdiComprobante['Fecha'] : '' ;
      $idCatTipoMoneda = (isset($cfdiComprobante['Moneda'])) ? $cfdiComprobante['Moneda'] : '' ;
      $idCatTipoPago = (isset($cfdiComprobante['MetodoPago'])) ? $cfdiComprobante['MetodoPago'] : '' ;

      echo '<br>------------------ COMPROBANTE ---------------------------------<br>';
      echo '<b>Folio: </b>'.$cfdiComprobante['Folio'];
      echo "<br />";
      echo '<b>Version: </b>'.$cfdiComprobante['Version'];
      echo "<br />";
      echo '<b>Fecha: </b>'.$cfdiComprobante['Fecha'];
      echo "<br />";
      echo '<b>Sello: </b>'.$cfdiComprobante['Sello'];
      echo "<br />";
      echo '<b>Total: </b>'.$cfdiComprobante['Total'];
      echo "<br />";
      echo '<b>SubTotal: </b>'.$cfdiComprobante['SubTotal'];
      echo "<br />";
      echo '<b>Certificado: </b>'.$cfdiComprobante['Certificado'];
      echo "<br />";
      echo '<b>FormaDePago: </b>'.$cfdiComprobante['FormaPago'];
      echo "<br />";
      echo '<b>NoCertificado: </b>'.$cfdiComprobante['NoCertificado'];
      echo "<br />";
      echo '<b>TipoDeComprobante: </b>'.$cfdiComprobante['TipoDeComprobante'];
      echo "<br />";
      echo '<b>CondicionesDePago: </b>'.$cfdiComprobante['CondicionesDePago'];
      echo "<br />";
      echo '<b>MetodoPago: </b>'.$cfdiComprobante['MetodoPago'];
      echo "<br />";
      echo '<b>Importe: </b>'.$cfdiComprobante['Importe'];
      echo "<br />";
      echo '<b>Moneda: </b>'.$cfdiComprobante['Moneda'];
      echo "<br />";
      echo '<b>LugarExpedicion: </b>'.$cfdiComprobante['LugarExpedicion'];
      echo "<br />";
    }
    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Emisor') as $Emisor){
      $rfcemisor = (isset($Emisor['Rfc'])) ? $Emisor['Rfc'] : '' ;
      $razonSocialEm = (isset($Emisor['Nombre'])) ? $Emisor['Nombre'] : '' ;
       echo '<br>------------------ EMISOR ---------------------------------<br>';
       echo '<b>Rfc: </b>'.$Emisor['Rfc'];
       echo "<br />";
       echo '<b>Nombre: </b>'.$Emisor['Nombre'];
       echo "<br />";
       echo '<b>RegimenFiscal: </b>'.$Emisor['RegimenFiscal'];
       echo "<br />";
    }
    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor){
      $rfcreceptor = (isset($Receptor['Rfc'])) ? $Receptor['Rfc'] : '' ;
       echo '<br>------------------ RECEPTOR ---------------------------------<br>';
       echo '<b>Rfc: </b>'.$Receptor['Rfc'];
       echo "<br />";
       echo '<b>Nombre: </b>'.$Receptor['Nombre'];
       echo "<br />";
       echo '<b>UsoCFDI: </b>'.$Receptor['UsoCFDI'];
       echo "<br />";
    }
    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Conceptos//cfdi:Concepto') as $Concepto){
       echo '<br>------------------ CONCEPTO ---------------------------------<br>';
       echo "<br />";
       echo $Concepto['Unidad'];
       echo "<br />";
       echo $Concepto['Importe'];
       echo "<br />";
       echo $Concepto['Cantidad'];
       echo "<br />";
       echo $Concepto['Descripcion'];
       echo "<br />";
       echo $Concepto['ValorUnitario'];
       echo "<br />";
       echo $Concepto['Importe'];
       echo "<br />";
    }
    foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Impuestos//cfdi:Traslados//cfdi:Traslado') as $Traslado){
    $ivaPorcent = (isset($Traslado['TasaOCuota'])) ? $Traslado['TasaOCuota'] : '' ;
    $ivaMonto = (isset($Traslado['Importe'])) ? $Traslado['Importe'] : '' ;
    $idImpuesto = (isset($Traslado['Impuesto'])) ? $Traslado['Impuesto'] : '' ;
       echo '<br>------------------ TRASLADO ---------------------------------<br>';
       echo '<b>Base: </b>'.$Traslado['Base'];
       echo "<br />";
       echo '<b>Impuesto: </b>'.$Traslado['Impuesto'];
       echo "<br />";
       echo '<b>TasaOCuota: </b>'.$Traslado['TasaOCuota'];
       echo "<br />";
       echo '<b>Importe: </b>'.$Traslado['Importe'];
       echo "<br />";
    }

    //ESTA ULTIMA PARTE ES LA QUE GENERABA EL ERROR
    foreach ($xml->xpath('//t:TimbreFiscalDigital') as $tfd) {
      $folioFiscal = (isset($tfd['UUID'])) ? $tfd['UUID'] : '' ;
      $noCertificadoSAT = (isset($tfd['NoCertificadoSAT'])) ? $tfd['NoCertificadoSAT'] : '' ;
      $selloCFDI = (isset($tfd['SelloCFD'])) ? $tfd['SelloCFD'] : '' ;
      $selloSAT = (isset($tfd['SelloSAT'])) ? $tfd['SelloSAT'] : '' ;
       echo '<br>------------------ TimbreFiscalDigital ---------------------------------<br>';
       echo '<b>SelloCFD: </b>'.$tfd['SelloCFD'];
       echo "<br />";
       echo '<b>FechaTimbrado: </b>'.$tfd['FechaTimbrado'];
       echo "<br />";
       echo '<b>UUID: </b>'.$tfd['UUID'];
       echo "<br />";
       echo '<b>NoCertificadoSAT: </b>'.$tfd['NoCertificadoSAT'];
       echo "<br />";
       echo '<b>Version: </b>'.$tfd['Version'];
       echo "<br />";
       echo '<b>SelloSAT: </b>'.$tfd['SelloSAT'];
    }

    //----------------------------Verificando que no este repetida la Factura-------------------------
    $sql = "SELECT COUNT(id) AS facDuplic FROM facturas WHERE folioInt= '$folioFiscal' OR  uuid = '$uuid'";
    //$rs = mysqli_query($link, $sql) or die ('Problemas al validar duplicados: '.mysqli_error($link));
    $rs = mysqli_query($link, $sql);
    //echo 'SQL: '.$sql;
    $row = mysqli_fetch_array($rs);
    $facDuplic = $row['facDuplic'];
    echo '<br>FacDup = '.$facDuplic;

    if ($facDuplic >= 1) {
      $_SESSION['RVTmsjInfoGasto'] = 'Esta Factura ya fue Utilizada anteriormente, <b>intenta con otra Factura.</b>';
      //header('location: ../cargaCombustible.php');
    } else {

      //---------------------------------------------------------------------------------------------
      //--------------------------Comenzamos a Validar el CFDI --------------------------------------
      //---------------------------------------------------------------------------------------------
      $total = floatval($monto);
      $uuid = $folioFiscal;

      // Consulta el estado de una factura en el SAT
      // @ 2016 https://tar.mx/tema/facturacion-electronica.html
      echo "<br>--->?re=".$rfcemisor."&rr=".$rfcreceptor."&tt=".str_pad(number_format($total,6,".",""),17,0,STR_PAD_LEFT)."&id=".strtoupper($uuid)."<----<br>";

      $options=array('trace'=>true, 'stream_context'=>stream_context_create( ['http' => ['timeout'=>1] ] ));
      $client = new SoapClient("https://consultaqr.facturaelectronica.sat.gob.mx/ConsultaCFDIService.svc?wsdl",$options) or die('Tenemos Problemas para conectar con el Cliente.');
      $factura   = "?re=".$rfcemisor."&rr=".$rfcreceptor."&tt=".str_pad(number_format($total,6,".",""),17,0,STR_PAD_LEFT)."&id=".strtoupper($uuid);
      echo 'Envio: '.$factura.'<br><br>';
      $resultado = $client->Consulta(['expresionImpresa'=>$factura]);

      if ($resultado) {
        //print_r($resultado);

        //echo '<br><br>';

        $estatusValidacion = $resultado->ConsultaResult->CodigoEstatus;
        $estado = $resultado->ConsultaResult->Estado;

        //echo 'Estatus: '.$estatusValidacion.'<br>Estado: '.$estado;

        if ($estado == 'Vigente') {
          //echo "vigente";
          $validada = 1;
          $detalleValida = $estatusValidacion;
          $estadoValida = $estado;
        }else{
          //echo "Ya Valio";
          $validada = 2;
          $detalleValida = $estatusValidacion;
          $estadoValida = $estado;

          $_SESSION['RVTmsjInfoGasto'] = 'Esta factura no se puede Usar por que no paso la Validación del SAT. <br><b>'.$estatusValidacion.'</b>.';
          //header('location: ../cargaCombustible.php');
          //exit(0);
        }
      }else {
        $validada = 0;
        $detalleValida = '';
        $estadoValida = '';
      }

      //-----------------------------------------------------------------------------------------------------------------------------
      //-------------------------- Almacenamos la Informacion de Las Facturas -------------------------------------------------------
      //-----------------------------------------------------------------------------------------------------------------------------
      $sql="INSERT INTO facturas(id, rfcEmisor, rfcReceptor, monto, uuid, folioInt, urlPDF, urlXML, fechaFac,idUserReg, fechaReg)
            VALUES ('$folioFiscal','$rfcemisor', '$rfcreceptor', '$monto', '$uuid', '$folio', '$url', '$urlXML', '$fechaAct', '$userReg',NOW())";

      //echo '<br>sql: '.$sql;
      //echo "<br> id: ".$identif.'--<br>';
      mysqli_query($link,$sql) or die(errorBD('Estamos teniendo problemas al Almacenar tu Comprobante. Por Favor notifique la Administrador.'.mysqli_error($link)));

      //------------Obteniendo el ID del Comprobante---------------------
      $rs = mysqli_query($link, "SELECT MAX(id) AS id FROM facturas WHERE idUserReg = '$userReg' AND urlPDF = '$url' AND idUserReg = '$userReg'");
      if ($row = mysqli_fetch_row($rs)) {
        $id = trim($row[0]);
      }

      $sql="UPDATE cargaCombustible SET idFactura = '$id' WHERE id = '$identif' AND idUserReg = '$userReg'";
      mysqli_query($link,$sql) or die(errorBD('Estamos teniendo problemas al Registrar tu Comprobante. Por favor notifique al Administrador.'));

      if ($validada == 1) {
        $_SESSION['RVTmsjSuccesInfoGasto'] = 'Tu Factura se ha cargado y<br> se ha validado Corrrectamente ante el SAT.';
      } else {
        $_SESSION['RVTmsjSuccesInfoGasto'] = 'Tu Factura se ha cargado correctamente,<br> pero aun no ha sido Validada.';
      }

      //echo 'Ok todo chido';
        //header('location: ../cargaCombustible.php');
        exit(0);
    }
  }
}
else {
  //echo 'Problemas al Cargar Factura, Recarga el sitio e inténtalo de nuevo...<br> De lo contrario Notifica a tu Administrador.';
  $_SESSION['RVTmsjInfoGasto'] = 'No existe ese registro o recarga el sitio e inténtalo de nuevo...<br> De lo contrario Notifica a tu Administrador.';
  header('location: ../cargaCombustible.php');
}

function errorBD($error){
  $_SESSION['RVTmsjInfoGasto'] = $error;
  //header('location: ../cargaCombustible.php');
}
?>
