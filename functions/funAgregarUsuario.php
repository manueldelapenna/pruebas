<?php

require(dirname(__FILE__) . '/funciones.php');


try {
    $nombreUsuario = $_POST['nameUser'];
    $passUsuario = $_POST['passUser'];
    $grupos = $_POST['grupos'];
    $permisos = $_POST['permisos'];
    $email = $_POST['email'];

    if ($nombreUsuario == "") {
        throw new Exception("El campo usuario no debe estar vacio");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Email incorrecto");
    } else {

        $pdo = conectar();
        $salt = generateSalt();
        $statement = $pdo->prepare("INSERT INTO usuarios(username,salt,password,fecha_alta) VALUE (:username,:salt,:password, :fecha_alta)");
        $statement->bindParam(':username', $nombreUsuario);
        $statement->bindParam(':salt', $salt);
        $statement->bindParam(':password', encryptPassword($salt, $passUsuario));
        $statement->bindParam(':fecha_alta', $horaActual = date('Y-m-d H:i:s'));
        $statement->execute();
        //Busco ID Usuario
        $usuarioID = $pdo->lastInsertId();
        //Armamos values de la tabla Usuarios_permisos
        foreach ($permisos as $permiso) {
            $string[] = "(" . $usuarioID . "," . $permiso . ")";
        }
        $string = implode(",", $string);

        //Asociacion entre grupos y permisos
        $statement = $pdo->prepare("INSERT INTO usuarios_permisos(user_id,permisos_id) VALUES $string");
        $statement->execute();
        //Armamos values de la tabla Usuarios_Grupos
        foreach ($grupos as $grupo) {
            $string1[] = "(" . $usuarioID . "," . $grupo . ")";
        }
        $string1 = implode(",", $string1);
        //Asociacion entre usuarios y permisos
        $statement = $pdo->prepare("INSERT INTO usuarios_grupos(user_id,group_id) VALUES $string1");
        $statement->execute();

        $result = ['code' => 200, 'message' => "El usuario ha sido agregado correctamente."];
    }
} catch (Exception $e) {
    $result = ['code' => 500, 'message' => "El usuario no se ha podido agregar." . $e->getMessage()];
}

header('Location:../web/exito.php?mensaje="'.$result['message'].'"');
