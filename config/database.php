<?php

function conectar() {
    $dsn = 'mysql:dbname=prueba;host=127.0.0.1';
    $usuario = 'root';
    $contrasena = '';


    $pdo = new PDO($dsn, $usuario, $contrasena);

    return $pdo;
}

?>