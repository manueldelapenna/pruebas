<?php

session_start();
include 'funciones.php';

$usuarioId = $_POST['id'];

$pdo = conectar();

$statement = $pdo->prepare("DELETE FROM usuarios
                             WHERE id = :usuarioId");
$statement->bindParam(":usuarioId", $usuarioId);
$statement->execute();

header("Location: ../web/verUsuarios.php");
