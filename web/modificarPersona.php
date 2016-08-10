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
        ?>
        <br/>
        <br/>
        <form class="form-inline centered" action="../functions/modificarPersona.php" method="POST"> 

            <input type="text" class="form-control" id="nombre"  placeholder="Nombre" name="nombre"><br/>

            <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido"><br/>
            
            <input type="text" class="form-control" id="fechaNacimiento" placeholder="Fecha de Nacimiento" name="nacimiento"><br/><br/>
            
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
