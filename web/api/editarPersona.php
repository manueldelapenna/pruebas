<?php

require(dirname(__FILE__).'/../../functions/funciones.php');


try {
    if (!isset($_POST['id'])) {
        throw new Exception("No hay id definido");
    }
    if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
        throw new Exception("No hay nombre definido");
    }

    $nombrePersona = $_POST['nombre'];
    $idPersona = $_POST['id'];

    $pdo = conectar();

    $statement = $pdo->prepare("UPDATE personas
                            SET nombre = :nombre
                            WHERE id = :id");
    $statement->bindParam(":nombre", $nombrePersona);
    $statement->bindParam(":id", $idPersona);
    $statement->execute();
    $result = ['code' => 200, 'message' => "La persona ha sido modificado correctamente"];
} catch (Exception $e) {
    $result = ['code' => 500, 'message' => "La persona no se pudo modificar. " . $e->getMessage()];
}

header('Content-Type: application/json');
echo json_encode($result);
