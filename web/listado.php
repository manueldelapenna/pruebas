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
        ?>

        <div>
            <?php if (in_array($_SESSION['usuario'], ['administrador'])) { ?>
                <a href="formAgregarPersona.php" class="btn btn-info">Agregar Persona</a>
            <?php } ?>
            <?php if (in_array($_SESSION['usuario'], ['admin', 'user'])) { ?>
                <a href="mayor.php" class="btn btn-info">Mayor Edad</a>
                <a href="menor.php" class="btn btn-info">Menor Edad</a>
            <?php } ?>
            <br>
            <br/>

            <form action="listado.php" method="GET">
                <input type="text" placeholder="Buscar" id="busqueda" name="busqueda"onclick="filterPerson()">
                <input type="submit" value="Buscar" class="btn btn-primary">
            </form>
            <br/><br/>
            <label>Items Pagina</label>    
            <select id="cantItems">
                <option value="5"<?php echo ($items == 5) ? "selected" : ""; ?>>5</option>
                <option value="10"<?php echo ($items == 10) ? "selected" : ""; ?>>10</option>
                <option value="20"<?php echo ($items == 20) ? "selected" : ""; ?>>20</option>
            </select>

            <table class="table" style="display:none">
                <thead>
                    <tr>
                        <th><a href="listado.php?orden=id&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">ID<?php if ($orden == 'id') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="listado.php?orden=nombre&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">Nombre<?php if ($orden == 'nombre') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="listado.php?orden=apellido&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">Apellido<?php if ($orden == 'apellido') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="listado.php?orden=edad&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">Edad<?php if ($orden == 'edad') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="listado.php?orden=fecha_nacimiento&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">Año Nacimiento<?php if ($orden == 'fecha_nacimiento') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="listado.php?orden=dni&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">Dni<?php if ($orden == 'dni') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                    </tr>
                </thead>    
                <tbody id="listadoBody"> 

                </tbody>
            </table>
        </div>

        <div>
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $cantPaginas; $i++) {

                    $active = ($i == $pagActual) ? "active" : "";
                    ?>
                    <li class="<?php echo $active; ?>"><a href="<?php echo "listado.php?orden=$orden&direccion=$direccion&items=$items&pagina=$i&busqueda=$busqueda" ?>"><?php echo $i ?></a></li>

                <?php } ?>  

            </ul>

        </div> 
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        <script>
            filterPerson();
            $('#cantItems').change(function () {
                window.location = 'listado.php?' + '<?php echo "orden=$orden&direccion=$direccion&" ?>' + 'items=' + $(this).val();

            });
        </script>

    </body>
</html>
