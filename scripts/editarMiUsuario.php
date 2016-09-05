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
        ?>
        <br/>
        <br/>


        <?php
        $user = $_SESSION['usuario'];
        $password = getPasswordUsuario($user);
        $idUser = getIdUsuario($user);
        ?>

        <h2> <?php echo ucfirst($user) ?></h2>
        <div id="editarGrupo" class="col-md-12 col-md-offset-4">
            <form class="form-inline" action="../functions/funEditarMiUsuario.php" method="POST">
                <input type="text" class="form-control" value="<?php echo ucfirst($user) ?>" name="username"><br/>
                <input type="text" class="form-control" placeholder="Nueva Contraseña" name="password"><br
                    <input type="hidden" class="form-control" value="<?php echo $idUser ?>" name="id"><br/>
                <input type="submit" value="Modificar Usuario" class="btn btn-info">
                <a href="verUsuarios.php" class="btn btn-info">Volver</a>
            </form>
        </div>       
        <?php 
        if(isset($_GET['mensaje'])){
            echo $_GET['mensaje'];
        }
        
        ?>


<?php
$path = $rootpath . '/pruebas/_partials/footer.php';
include_once($path);
?>


    </body>
</html>