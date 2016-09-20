<?php

require(dirname(__FILE__) . '/../../functions/funciones.php');


try {

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $idUser = $_POST['id'];


    $pdo = conectar();


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Mail invalido.");
    }



    $statement = $pdo->prepare("UPDATE usuarios
                            SET username = :username, firstname = :firstname, lastname = :lastname, email= :email
                            WHERE id = :id");
    $statement->bindParam(':username', $username);
    $statement->bindParam(':firstname', $firstname);
    $statement->bindParam(':lastname', $lastname);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':id', $idUser);
    $statement->execute();

    $result = ['code' => 200, 'message' => "El usuario se ha modificado correctamente."];
} catch (Exception $e) {
    $result = ['code' => 500, 'message' => "No se ha podido modificar el usuario. " . $e->getMessage()];
}


header('Content-Type: application/json');
echo json_encode($result);
