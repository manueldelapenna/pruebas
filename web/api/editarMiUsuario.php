<?php

require(dirname(__FILE__) . '/../../functions/funciones.php');


try {

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $idUser = $_POST['id'];
    //Password
    $salt = generateSalt();
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $changePassword = $_POST['changePassword'];


    $erroresUser = validarUsuario($username, $firstname, $lastname, $email);
    if (count($erroresUser)) {
        $result = ['code' => 500, 'message' => "No se ha podido modificar el usuario. ", 'errors' => $erroresUser];

        header('Content-Type: application/json');
        echo json_encode($result);
        exit();
    }

    $pdo = conectar();
    
    if ($changePassword) {

        $erroresPass = validarContrasenas($password, $confirmPassword);
        if (count($erroresPass)) {
            $result = ['code' => 500, 'message' => "No se ha podido modificar el usuario. ", 'errors' => $erroresPass];
            header('Content-Type: application/json');
            echo json_encode($result);
            exit();
        }
        
        
        
        $statement = $pdo->prepare("UPDATE usuarios
                            SET password = :password
                            WHERE id = :id");
        $statement->bindParam(':password', $password);
        $statement->bindParam(':id', $idUser);
        $statement->execute();
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
