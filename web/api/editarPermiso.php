<?php

require(dirname(__FILE__).'/../../functions/funciones.php');


try {
    if (!isset($_POST['id'])) {
        throw new Exception("No hay id definido");
    }
    if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
        throw new Exception("No hay nombre definido");
    }

    $nombrePermiso = $_POST['nombre'];
    $idPermiso = $_POST['id'];

    $pdo = conectar();

    $statement = $pdo->prepare("UPDATE permisos
                            SET name = :name
                            WHERE id = :id");
    $statement->bindParam(":name", $nombrePermiso);
    $statement->bindParam(":id", $idPermiso);
    $statement->execute();
    $result = ['code' => 200, 'message' => "El permiso ha sido modificado correctamente"];
} catch (Exception $e) {
    $result = ['code' => 500, 'message' => "El permiso no se pudo modificar. " . $e->getMessage()];
}

header('Content-Type: application/json');
echo json_encode($result);
