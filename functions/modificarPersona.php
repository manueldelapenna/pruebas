<?php

include 'funciones.php';
$fecha_nacimiento = $_POST['nacimiento'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$id = $_POST['id'];
$errores = validarPersona($dni, $nombre, $apellido, $fecha_nacimiento);

if (count($errores) == 0) {
    $pdo = conectar();
    $statement = $pdo->prepare('UPDATE personas set nombre= :nombre, apellido= :apellido,dni = :dni, fecha_nacimiento= :fecha_nacimiento WHERE id= :id');
    $statement->bindParam(':fecha_nacimiento', desformatearFechaNacimiento($fecha_nacimiento));
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':apellido', $apellido);
    $statement->bindParam(':dni', $dni);
    $statement->bindParam(':id', $id);
    $statement->execute();
    
    $mensaje = "La persona ha sido modificada satisfactoriamente";
    header("Location: ../web/exito.php?mensaje=$mensaje");
} else {
    $mensajes = implode('<br>', $errores);
    header("Location: ../web/formModificarPersona.php?id=$id&&mensaje=$mensajes");
}