<?php
require("../scripts/acceso.php");
tieneAcceso('personas_listar');

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
        $path = $rootpath . '/pruebas/functions/funciones.php';
        include_once($path);

        $items = (isset($_GET['items'])) ? $_GET['items'] : 100;

        $indicadorDireccion = (isset($_GET['direccion'])) ? direccionOrdenamiento($_GET['direccion']) : "ASC";
        $iconoDireccion = ($indicadorDireccion == "DESC") ? "glyphicon glyphicon-circle-arrow-up" : "glyphicon glyphicon-circle-arrow-down";
        $orden = (isset($_GET['orden'])) ? $_GET['orden'] : "id";
        $direccion = (isset($_GET['direccion'])) ? $_GET['direccion'] : "DESC";
        $busqueda = (isset($_GET['busqueda'])) ? $_GET['busqueda'] : "";
        $total = totalPersonas($busqueda);
        $cantPaginas = ceil($total / $items);
        ?>

        <div>
            <?php if (in_array($_SESSION['usuario'], ['administrador'])) { ?>
                <a href="formAgregarPersona.php" class="btn btn-info">Agregar Persona</a>
            <?php } ?>
            <?php if (in_array($_SESSION['usuario'], ['administrador', 'user'])) { ?>
                <a href="mayor.php" class="btn btn-info">Mayor Edad</a>
                <a href="menor.php" class="btn btn-info">Menor Edad</a>
            <?php } ?>
            <br>
            <br/>


            <input type="text" placeholder="Buscar" id="busqueda" onkeyup="filterPerson()" name="busqueda"><br/><br/>


            <br/><br/>
            <label>Items Pagina</label>    
            <select id="cantItems">
                <option value="5"<?php echo ($items == 5) ? "selected" : ""; ?>>5</option>
                <option value="10"<?php echo ($items == 10) ? "selected" : ""; ?>>10</option>
                <option value="20"<?php echo ($items == 20) ? "selected" : ""; ?>>20</option>
            </select>
            <input type="hidden" value="<?php $orden ?>" id="ordenActual">
            <input type="hidden" value="<?php echo $direccion ?>" id="direccionActual">
            <input type="hidden" value="<?php echo $iconoDireccion ?>" id="iconoDireccion">
            <table class="table">
                <thead class="head-table">
                    <tr>
                        <th><a name="id">ID</a></th>
                        <th><a name="nombre">Nombre</a></th>
                        <th><a name="apellido">Apellido</a></th>
                        <th><a name="edad">Edad</a></th>
                        <th><a name="fecha_nacimiento">Año Nacimiento</a></th>
                        <th><a name="dni">Dni</a></th>
                    </tr>
                </thead>    
                <tbody class="body-table"> 

                </tbody>
            </table>
        </div>

        <div>
            <input type="hidden" value="1" id="paginaActual">
            <ul class="pagination">

            </ul>

        </div> 
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        <script>
            filterPerson();
            var paginaActual = 1;
            
            $('#cantItems').change(function () {
                filterPerson();

            });
        </script>

    </body>
</html>
