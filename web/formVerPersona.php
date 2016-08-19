<?php
require_once("../scripts/acceso.php");
require_once("../functions/funciones.php");
?>
<!DOCTYPE html>

<html>
    <head>
        <?php
        $rootpath = $_SERVER['DOCUMENT_ROOT'];

        $path = $rootpath . '/pruebas/_partials/head.php';
        include_once($path);
        ?>
    </head>
    <body>

        <?php
        $path = $rootpath . '/pruebas/_partials/header.php';
        include_once($path);

        $path = $rootpath . '/pruebas/_partials/menu.php';
        include_once($path);
        $error = "";
        $busqueda = $_GET['busqueda'];
        $id = $_GET['id'];
        $pdo = conectar();
        $statement = $pdo->prepare("SELECT * FROM personas where id = $id");
        $statement->execute();
        $result = $statement->fetchAll();
        
       
        ?>
        <br/>
        <br/>
        <form class="form-inline centered" action="../web/listado.php" method="POST"> 

            <input type="text" class="form-control" id="nombre"  placeholder="Nombre" name="nombre" value="<?php echo ucfirst($result[0]['nombre']);?>" disabled><br/>

            <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" value="<?php echo ucfirst($result[0]['apellido']);?>"disabled><br/>
            
            <input type="text" class="form-control" id="dni" placeholder="Dni" name="dni" value="<?php echo $result[0]['dni'];?>"disabled><br/>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
            <input type="text" class="form-control" id="fechaNacimiento" placeholder="Fecha de Nacimiento" name="nacimiento" value="<?php echo formatearFechaNacimiento($result[0]['fecha_nacimiento']);?>"disabled><br/><br/>
            
            <a href="listado.php?busqueda=<?php echo $busqueda;?>" class="btn btn-primary">Retornar al listado</a>
        </form>

        <div class="centered">
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        </div>
    </body>
</html>