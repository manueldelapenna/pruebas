<?php
/* Conectar a una base de datos de MySQL invocando al controlador */
$dsn = 'mysql:dbname=prueba;host=127.0.0.1';
$usuario = 'root';
$contrasena = '';

try {
    $pdo = new PDO($dsn, $usuario, $contrasena);
	
	$nombre = 'admin';
	
	$statement = $pdo->prepare("SELECT * FROM usuarios WHERE username = :nombre");
	$statement->bindParam(':nombre', $nombre);
	$statement->execute();
	$result = $statement->fetch();
	
	var_dump($result);
} catch (PDOException $e) {
    echo 'Fall� la conexi�n: ' . $e->getMessage();
}

?>
