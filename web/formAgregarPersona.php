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

        $value_nombre = (isset($_SESSION['form_persona']['nombre'])) ? $_SESSION['form_persona']['nombre'] : "";
        $value_apellido = (isset($_SESSION['form_persona']['apellido'])) ? $_SESSION['form_persona']['apellido'] : "";
        $value_dni = (isset($_SESSION['form_persona']['dni'])) ? $_SESSION['form_persona']['dni'] : "";
        $value_nacimiento = (isset($_SESSION['form_persona']['nacimiento'])) ? $_SESSION['form_persona']['nacimiento'] : "";

        unset($_SESSION['form_persona']);
        ?>
        <div id="formAgregar" class="col-md-4 col-md-offset-4">
            <form class="form-inline " action="../functions/agregarPersona.php" method="POST"> 

                <input type="text" class="form-control" id="nombre"  placeholder="Nombre" name="nombre" value="<?php echo $value_nombre; ?>">*<br/>

                <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" value="<?php echo $value_apellido; ?>">*<br/>

                <input type="text" class="form-control" id="dni" placeholder="Documento" name="dni" sytle="margin-left: 81px;" value="<?php echo $value_dni; ?>">* ej:38706974<br/>

                <input type="text" class="form-control" id="fechaNacimiento" placeholder="Fecha de Nacimiento" name="nacimiento" value="<?php echo $value_nacimiento; ?>">* ej:21/02/1986<br/><br/>
                <input type="submit" class="btn btn-primary" value="Agregar Persona">
                <a id="volver" class="btn btn-primary">Cancelar</a>
            </form>

<?php
if (isset($_GET['mensaje'])) {
    ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $_GET['mensaje']; ?>
                </div> 
            </div>
                    <?php
                }
                $path = $rootpath . '/pruebas/_partials/footer.php';
                include_once($path);
                ?>

    </body>
</html>
