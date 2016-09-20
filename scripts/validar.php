<?php

require_once '../functions/funciones.php';
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$error = "";
if ($usuario == "" || $contrasena == "") {
    $error = 'Debe completar todos los campos';
    header("Location: ../web/index.php?error=$error");
    exit();
}


if (verificarUsuario($usuario, $contrasena)) {
    session_start();
    $_SESSION['usuario'] = $usuario;
    $day = date('d/m/Y h:i:s', time());
    $pdo = conectar();
    $statement = $pdo->prepare("UPDATE usuarios
                                    SET ultimo_logueo = :ultimo_logueo
                                    WHERE username = :username");
    $statement->bindParam(':ultimo_logueo', $day, PDO::PARAM_STR);
    $statement->bindParam(':username', $usuario);
    $statement->execute();

    header("Location: ../web/index.php");
    exit();
} else {
    $error = "No existe el usuario";
    header("Location: ../web/index.php?error=$error");

    exit();
}
?>
