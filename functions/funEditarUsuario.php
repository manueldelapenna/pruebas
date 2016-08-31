<?php

session_start();
include 'funciones.php';

$usuarioId = $_POST['usuarioId'];
$nombreUsuario = $_POST['username'];
$gruposUsuario = $_POST['grupos'];
$permisosUsuario = $_POST['permisos'];

$pdo = conectar();

//cambio el nombre del usuario
$statement = $pdo->prepare("UPDATE usuarios
                            SET username = :username
                            WHERE id = $usuarioId");
$statement->bindParam(":username", $nombreUsuario);
$statement->execute();

//borro los grupos a los que pertenece el usuario
$statement = $pdo->prepare("DELETE FROM usuarios_grupos
                            WHERE user_id = :usuarioId");
$statement->bindParam(":usuarioId", $usuarioId);
$statement->execute();

//agrego los nuevos grupos
foreach($gruposUsuario as $grupo){
    
   $string[] = "(".$grupo.",".$usuarioId.")";
}

$pegado = implode(",", $string);
$statement = $pdo->prepare("INSERT INTO usuarios_grupos(group_id,user_id) VALUE $pegado");
$statement->execute();



//Elimino los permisos que tenia
$statement = $pdo->prepare("DELETE FROM usuarios_permisos
                             WHERE user_id = $usuarioId");
$statement->execute();

//Agrego los nuevos permisos
foreach($permisosUsuario as $permiso){
    $string1[] = "(".$usuarioId.",".$permiso.")";
}
$pegado1 = implode(",", $string1);

$statement = $pdo->prepare("INSERT INTO usuarios_permisos(user_id,permisos_id) VALUE $pegado1");
$statement->execute();


$mensaje= "El usuario ha sido modificado exitosamente";

header("Location: ../web/exito.php?mensaje=$mensaje");
