<?php
include '../config/database.php';
$pdo = conectar();
$statement = $pdo->prepare("INSERT INTO personas(dni,nombre,apellido,edad) VALUE (:dni,:nombre, :apellido, :edad)");
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$edad = $_POST['edad'];
$statement->bindParam(':dni', $dni);
$statement->bindParam(':nombre', $nombre);
$statement->bindParam(':apellido', $apellido);
$statement->bindParam(':edad', $edad);
$statement->execute();

$mensaje = "La persona ha sido agregada satisfactoriamente";
header("Location: ../web/exito.php?mensaje=$mensaje");
?>    
