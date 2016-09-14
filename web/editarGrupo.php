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
        <div class='container' >   
            <h2> <?php echo $obtenerGrupo[0]['name'] ?></h2>
            <div id="editarGrupo" class="col-md-12 col-md-offset-4">
                <form class="form-inline" action="../functions/funEditarGrupo.php" method="POST">
                    <input type="hidden" value="<?php echo $grupo ?>" name="grupoId">
                    <input type="text" class="form-control" value="<?php echo $obtenerGrupo[0]['name'] ?>" name="nameGroup"><br/>
                    <label>Indique los permisos</label><br/>
                    <?php
                    foreach (getPermisos() as $permiso) {

                        if (grupoTienePermiso($busquedaGrupo, $permiso['id'])) {
                            $checked = "checked";
                        } else {
                            $checked = "";
                        }
                        ?>   

                        <input type="checkbox" name="permisos[]" value="<?php echo $permiso['id'] ?>" <?php echo $checked ?>><?php echo $permiso['name'] ?><br/>

                        <?php
                    }
                    ?>


                    <input type="submit" value="Modificar Grupo" class="btn btn-info">
                    <a id="volver" class="btn btn-info">Volver</a>
                </form>
            </div>       
        </div>


        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>


    </body>
</html>