<?php
/* Conectar a una base de datos de MySQL invocando al controlador */
$dsn = 'mysql:dbname=prueba;host=127.0.0.1';
$usuario = 'root';
$contraseña = '';

try {
    $pdo = new PDO($dsn, $usuario, $contraseña);
	
	$nombre = 'admin';
	
	$statement = $pdo->prepare("SELECT * FROM usuarios WHERE username = :nombre");
	$statement->bindParam(':nombre', $nombre);
	$statement->execute();
	$result = $statement->fetch();
	
	var_dump($result);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

?>
