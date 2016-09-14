<?php


include 'funciones.php';

$pdo = conectar();
$statement = $pdo->prepare("DELETE FROM personas where id= :id");
$statement->bindParam(':id', $_POST['id']);

$statement->execute();

header("Location: ../web/listado.php");