<?php

require(dirname(__FILE__) . '/../../functions/funciones.php');
if (isset($_GET['id'])) {


    $id = $_GET['id'];
    $result = getPersona($id);

    if (count($result)) {
        $resultado = ['code' => 200, 'results' => $result[0]];
    } else {
        $resultado = ['code' => 404, 'error' => 'Persona no encontrada'];
    }
} else {
    $resultado = ['code' => 500, 'error' => 'ID de persona no definido'];
}
header('Content-Type: application/json');
echo json_encode($resultado);
