<?php

session_start();
include 'funciones.php';

$nombreUsuario = $_POST['nameUser'];
$passUsuario = $_POST['passUser'];
$grupos = $_POST['grupos'];
$permisos = $_POST['permisos'];
$email = $_POST['email'];

if ($nombreUsuario == "") {

    $mensaje = "Debe ingresar un usuario";
    header("Location: ../web/agregarPermiso.php?mensaje=$mensaje");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $mensaje = "Debe ingresar un mail correcto";
    header("Location: ../web/agregarPermiso.php?mensaje=$mensaje");
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
    $mensaje = "El usuario ha sido agregado satisfactoriamente";
    header("Location: ../web/exito.php?mensaje=$mensaje");
}

