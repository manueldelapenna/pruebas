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
        $grupo = $_GET['grupoID'];

        $busquedaGrupo = getGrupoConPermisos($grupo);
        $obtenerGrupo = getGrupo($grupo);
        ?>

        <h2> <?php echo ucfirst($obtenerGrupo[0]['name']) ?></h2>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Nombre Permiso</th>
                        </tr>
                    </thead>    
                    <?php
                    foreach ($busquedaGrupo as $grupo) {
                        ?>    

                        <tbody>
                            <tr>
                                <td><?php echo ucfirst($grupo['permiso_nombre']) ?></td>
                            </tr>
                        </tbody>




                        <?php
                    }
                    ?>
                </table>   
            </div>
        </div>
        <a href="verGrupos.php" class="btn btn-info">Volver</a>


        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>


    </body>
</html>