<?php

include 'funciones.php';
 echo $_POST['personaModificada']['nombe'];
$pdo = conectar();
$statement = $pdo->prepare('UPDATE INTO personas set nombre= :nombre, apellido= :apellido, fecha_nacimiento= :fecha_nacimiento');
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];