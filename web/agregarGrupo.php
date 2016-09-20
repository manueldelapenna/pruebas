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

        <div id="formAgregar" class="container col-md-12 col-md-offset-4">
            <form class="form-inline" action="../functions/funAgregarGrupo.php" method="POST">
                <input type="text" class="form-control" placeholder="Nombre del grupo" name="nameGroup"><br/>
                <label>Indique los permisos</label><br/>
                <?php
                foreach (getPermisos() as $permiso) {
                    ?>   

                    <input type="checkbox" name="permisos[]" value="<?php echo $permiso['id'] ?>"><?php echo $permiso['name'] ?><br/>

                    <?php
                }
                ?>


                <input type="submit" value="Agregar Grupo" class="btn btn-info">
                <a href="index.php" class="btn btn-info">Volver a inicio</a>
            </form>
        </div>





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
