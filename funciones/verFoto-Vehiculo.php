<?php
define('INCLUDE_CHECK',1);
require_once('../include/connect.php');
session_start();

$id = (isset($_POST['ident']) AND $_POST['ident'] >= 1) ? $_POST['ident'] : '' ;
#print_r($_POST);
$sqlfotos = "SELECT * FROM vehiculos ve
 WHERE ve.id ='$id'";
$resultFoto = mysqli_query($link,$sqlfotos) or die('<span class="text-danger"><center>Problemas al consultar los Datos. Notifica a tu Administrador.</center></span>');
$foto = mysqli_fetch_array($resultFoto);
#print_r($_POST);
#error_reporting(E_ALL); //muestra todos los errores encontrados en la página
?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="verFotoTitle">Foto</h4>
        </div>
        <div class="modal-body" id="verFotoBody">
          <img src="../<?=$foto['foto'];?>" class="height-12" width="100%" height="100%">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>';
