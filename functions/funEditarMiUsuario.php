<?php
session_start();
include 'funciones.php';


$username = $_POST['username'];
$idUser = $_POST['id'];
$password = $_POST['password'];

if($password = "" || $username = ""){
    $mensaje = "Debe completar los dos campos, no deben estar vacios";
 
    header("Location: ../scripts/editarMiUsuario?mensaje=$error");
}else{
$pdo = conectar();

$statement = $pdo->prepare("UPDATE usuarios
                            SET username = :username, password = :password
                            WHERE id = :id" );
$statement->bindParam(':username', $username);
$statement->bindParam(':password', $password);
$statement->bindParam(':id', $idUser);
$statement->execute();


}