<?php

session_start();
include 'funciones.php';

$grupoId = $_POST['id'];

$pdo = conectar();

$statement = $pdo->prepare("DELETE FROM grupos
                             WHERE id = :grupoId");
$statement->bindParam(":grupoId", $grupoId);
$statement->execute();

header("Location: ../web/verGrupos.php");