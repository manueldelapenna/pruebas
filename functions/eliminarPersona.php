<?php


include 'funciones.php';

$pdo = conectar();
$statement = $pdo->prepare("DELETE FROM personas where dni= :dni");
$statement->bindParam(':dni', $_POST['dniPersona']);

$statement->execute();

header("Location: ../web/listado.php");