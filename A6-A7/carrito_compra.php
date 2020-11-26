<?php
session_start();
include("funcions.php");
$idproductes = $_REQUEST['idproducte'];
$preuproductes = $_REQUEST['preuproducte'];
$_SESSION['preciototal'] = ($_SESSION['preciototal'] + $preuproductes);
$_SESSION['arrayproductos'][] =$idproductes;
header('location: privadacompra.php');
?>