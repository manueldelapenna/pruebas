<?php
require_once("../scripts/acceso.php");
tieneAcceso('usuario_editar');
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
        $usuarioID = $_GET['id'];

        $permisosUsuario = getUsuarioConPermisos($usuarioID);
        $gruposUsuario = getUsuarioConGrupos($usuarioID);

        $usuario = getUsuario($usuarioID);
        ?>

        <h2> <?php echo ucfirst($usuario[0]['username']) ?></h2>
        <div id="editarGrupo" class="col-md-12 col-md-offset-4">
            <form class="form-inline" action="../functions/funEditarUsuario.php" method="POST">
                <input type="hidden" value="<?php echo $usuarioID ?>" name="usuarioId">
                <input type="text" class="form-control" value="<?php echo ucfirst($usuario[0]['username']) ?>" name="username"><br/>
                <div class="row">
                    <div class="col-sm-3">
                        <label>Indique Grupo</label><br/>
                        <?php
                        foreach (getGrupos() as $grupo) {

                            if (usuarioPerteneceGrupo($gruposUsuario, $grupo['id'])) {
                                $checked = "checked";
                            } else {
                                $checked = "";
                            }
                            ?>
                            <input type="checkbox" name="grupos[]" value="<?php echo $grupo['id'] ?>" <?php echo $checked ?>><?php echo $grupo['name'] ?><br/>  
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <label>Indique los permisos</label><br/>
                        <?php
                        foreach (getPermisos() as $permiso) {

                            if (grupoTienePermiso($permisosUsuario, $permiso['id'])) {
                                $checked = "checked";
                            } else {
                                $checked = "";
                            }
                            ?>   

                            <input type="checkbox" name="permisos[]" value="<?php echo $permiso['id'] ?>" <?php echo $checked ?>><?php echo $permiso['name'] ?><br/>

                            <?php
                        }
                        ?>
                    </div>
                </div>

                <input type="submit" value="Modificar Usuario" class="btn btn-info">
                <a id="volver" class="btn btn-info">Volver</a>
            </form>
        </div>       



        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>


    </body>
</html>