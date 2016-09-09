<?php

session_start();
include 'funciones.php';

$usuarioId = $_POST['usuarioId'];
$Usuario = $_POST['username'];
$nombreUsuario = $_POST['firstname'];
$apellidoUsuario = $_POST['lastname'];
$email = $_POST['email'];
$gruposUsuario = isset($_POST['grupos'])?$_POST['grupos']: [];
$permisosUsuario = isset($_POST['permisos'])?$_POST['permisos']: [];
$string = [];
$string1 = [];

try{
    
$pdo = conectar();
$pdo->beginTransaction();
//cambio el usuario
$statement = $pdo->prepare("UPDATE usuarios
                            SET username = :username
                            WHERE id = $usuarioId");
$statement->bindParam(":username", $Usuario);
$statement->execute();

//cambio el firstname
$statement = $pdo->prepare("UPDATE usuarios
                            SET firstname = :firstname
                            WHERE id = $usuarioId");
$statement->bindParam(":firstname", $nombreUsuario);
$statement->execute();

//cambio el lastname
$statement = $pdo->prepare("UPDATE usuarios
                            SET lastname = :lastname
                            WHERE id = $usuarioId");
$statement->bindParam(":lastname", $apellidoUsuario);
$statement->execute();


//valido el mail
if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    //modifico email
$statement = $pdo->prepare("UPDATE usuarios
                            SET email = :email
                            WHERE id = $usuarioId");
$statement->bindParam(":email", $email);
$statement->execute();
    
}

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

$pdo->commit();
$mensaje= "El usuario ha sido modificado exitosamente";

header("Location: ../web/exito.php?mensaje=$mensaje");
}catch(Exception $e){
  echo $e->getMessage();
$pdo->rollBack();  
}