<?php

require_once("../../functions/funciones.php");


$items = (isset($_GET['items'])) ? $_GET['items'] : 5;
$indicadorDireccion = (isset($_GET['direccion'])) ? direccionOrdenamiento($_GET['direccion']) : "ASC";
$iconoDireccion = ($indicadorDireccion == "DESC") ? "glyphicon glyphicon-circle-arrow-up" : "glyphicon glyphicon-circle-arrow-down";
$pagActual = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
$orden = (isset($_GET['orden'])) ? $_GET['orden'] : "id";
$direccion = (isset($_GET['direccion'])) ? $_GET['direccion'] : "ASC";
$busqueda = (isset($_GET['busqueda'])) ? $_GET['busqueda'] : "";
$total = totalPermisos($busqueda);
$cantPaginas = ceil($total / $items);
$permisos = listarPermisos($orden, $direccion, $items, $pagActual, $busqueda);
var_dump($permisos);

$result = ['code'=> 200,'permisos'=> $permisos,'paginas'=> $cantPaginas];

echo json_encode($result);

?>