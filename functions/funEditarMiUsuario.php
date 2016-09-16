<?php
session_start();
include 'funciones.php';

$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname= $_POST['lastname'];
$email = $_POST['email'];
$idUser = $_POST['id'];
$salt = generateSalt();
$password = encryptPassword($salt,$_POST['password']);
$confirmPassword = encryptPassword($salt, $_POST['confirmPassword']);


if($password == "" || $username == ""){
    $error = "Debe completar los dos campos, no deben estar vacios";
 
    header("Location: ../scripts/editarMiUsuario?mensaje=$error");
}
if(encryptPassword($salt, $password) != $confirmPassword){
    $error= "Las contraseñas no son iguales";
    header("Location: ../scripts/editarMiUsuario?mensaje=$error");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Mail invalido";
    header("Location: ../scripts/editarMiUsuario?mensaje=$error");
    
}
else{
$pdo = conectar();

$statement = $pdo->prepare("UPDATE usuarios
                            SET username = :username, firstname = :firstname, lastname = :lastname, password = :password, email= :email
                            WHERE id = :id" );
$statement->bindParam(':username', $username);
$statement->bindParam(':password', $password);
$statement->bindParam(':firstname', $firstname);
$statement->bindParam(':lastname', $lastname);
$statement->bindParam(':email', $email);
$statement->bindParam(':id', $idUser);
$statement->execute();


}