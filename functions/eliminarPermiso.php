<?php

session_start();
include 'funciones.php';

$id = $_POST['id'];

$pdo = conectar();

$statement = $pdo->prepare("DELETE FROM permisos
                            WHERE id = :id");
$statement->bindParam(":id", $id);
$statement->execute();

header("Location: ../web/verPermisos.php");

