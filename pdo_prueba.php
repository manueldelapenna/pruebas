<?php
/* Conectar a una base de datos de MySQL invocando al controlador */
$dsn = 'mysql:dbname=prueba;host=127.0.0.1';
$usuario = 'root';
$contrasena = '';

try {
    $pdo = new PDO($dsn, $usuario, $contrasena);


    $statement = $pdo->prepare("SELECT * FROM personas");
    $statement->execute();
    $result = $statement->fetchAll();
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                
            </tr>
        </thead>    
        <tbody> 


            <?php foreach ($result as $usuario) { ?>
                <tr>
                    <td>  <?php echo $usuario['nombre']; ?> </td>
                    <td> <?php echo $usuario['apellido']; ?> </td>
                    <td> <?php echo $usuario['edad']; ?></td>
                   


                </tr>  

            <?php
            }
        } catch (PDOException $e) {
            echo 'Fallo la conexion: ' . $e->getMessage();
        }
        ?>
