<?php

require(dirname(__FILE__).'/../../functions/funciones.php');


try {
    if(!isset($_POST['id'])){
        throw new Exception("No hay id definido");
    }
    $id = $_POST['id'];

    $pdo = conectar();

    $statement = $pdo->prepare("DELETE FROM permisos
                            WHERE id = :id");
    $statement->bindParam(":id", $id);
    $statement->execute();
    $result = ['code' => 200, 'message' => 'El permiso se elimino correctamente'];
} catch (Exception $e) {
    $result = ['code' => 500, 'message' => 'Error al eliminar permiso: ' . $e->getMessage()];
}

header('Content-Type: application/json'); 
echo json_encode($result);
