<?php
require_once("../functions/funciones.php");

$items = (isset($_GET['items'])) ? $_GET['items'] : 100;

$indicadorDireccion = (isset($_GET['direccion'])) ? direccionOrdenamiento($_GET['direccion']) : "ASC";
$iconoDireccion = ($indicadorDireccion == "DESC") ? "glyphicon glyphicon-circle-arrow-up" : "glyphicon glyphicon-circle-arrow-down";
$pagActual = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$orden = (isset($_GET['orden'])) ? $_GET['orden'] : "id";
$direccion = (isset($_GET['direccion'])) ? $_GET['direccion'] : "ASC";
$busqueda = (isset($_GET['busqueda'])) ? $_GET['busqueda'] : "";

$personas = listarPersonas($orden, $direccion, $items,$pagActual, $busqueda);

$result = ['code' => 200, 'result' => $personas];

echo json_encode($result);

?>                    
        
