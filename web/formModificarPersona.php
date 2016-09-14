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
        $id = $_GET['id'];
        $pdo = conectar();
        $statement = $pdo->prepare("SELECT * FROM personas where id = $id");
        $statement->execute();
        $result = $statement->fetchAll();
        
       
        ?>
        <br/>
        <br/>
        <form class="form-inline centered" action="../functions/modificarPersona.php" method="POST"> 

            <input type="text" class="form-control" id="nombre"  placeholder="Nombre" name="nombre" value="<?php echo $result[0]['nombre'];?>"><br/>

            <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" value="<?php echo $result[0]['apellido'];?>"><br/>
            
            <input type="text" class="form-control" id="dni" placeholder="Dni" name="dni" value="<?php echo $result[0]['dni'];?>"><br/>
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
            <input type="text" class="form-control" id="fechaNacimiento" placeholder="Fecha de Nacimiento" name="nacimiento" value="<?php echo formatearFechaNacimiento($result[0]['fecha_nacimiento']);?>"><br/><br/>
            
            <input type="submit" class="btn btn-primary" value="Modificar Persona">
            <a href="listado.php" class="btn btn-primary">Cancelar</a>
        </form>

        <?php
        if (isset($_GET['mensaje'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_GET['mensaje']; ?>
            </div> 
         <?php
        }
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        
    </body>
</html>
