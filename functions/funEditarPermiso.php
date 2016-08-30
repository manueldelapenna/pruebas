<?php

session_start();
include 'funciones.php';

$nombrePermiso = $_GET['permisoName'];
$idPermiso = $_GET['permisoId'];

$pdo = conectar();

$statement = $pdo->prepare("UPDATE permisos
                            SET name = :name
                            WHERE id = :id");
$statement->bindParam(":name", $nombrePermiso);
$statement->bindParam(":id", $idPermiso);
$statement->execute();

$mensaje = "El permiso ha sido modificado exitosamente";

header("Location: ../web/exito.php?mensaje=$mensaje");
