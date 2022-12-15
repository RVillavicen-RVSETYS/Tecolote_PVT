<?php
session_start();
$identif = (isset($_GET['identif']) AND $_GET['identif'] >= 0) ? $_GET['identif'] : '' ;

$_SESSION['ATZcampo1CatMarcas'] = $identif;

header('location: ../Admin/catMarcas.php');

?>
