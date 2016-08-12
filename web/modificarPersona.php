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
        $id = $_POST['personaModificada'];
     
       
        
        $pdo = conectar();
        $statement = $pdo->prepare("SELECT * FROM personas where id = $id");
        $statement->execute();
        $result = $statement->fetchAll();
        $_SESSION['form_persona']['nombre']= $result[0]['nombre'];
       
        ?>
        <br/>
        <br/>
        <form class="form-inline centered" action="../functions/modificarPersona.php" method="POST"> 

            <input type="text" class="form-control" id="nombre"  placeholder="Nombre" name="nombre" value="<?php echo $_SESSION['form_persona']['nombre'];?>"><br/>

            <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" value="<?php echo $result[0]['apellido'];?>"><br/>
            
            <input type="text" class="form-control" id="dni" placeholder="Dni" name="dni" value="<?php echo $result[0]['dni'];?>"><br/>
            
            <input type="text" class="form-control" id="fechaNacimiento" placeholder="Fecha de Nacimiento" name="nacimiento" value="<?php echo $result[0]['fecha_nacimiento'];?>"><br/><br/>
            
            <input type="submit" class="btn btn-primary" value="Modificar Persona">
        </form>

        <div class="centered">
        <?php
        if (isset($_GET['mensaje'])) {
            echo $_GET['mensaje'];
        }
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        </div>
    </body>
</html>
