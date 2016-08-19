<?php
require("../scripts/acceso.php");
$accesos = array("admin");
tieneAcceso($accesos);

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
            <?php if (in_array($_SESSION['usuario'], ['admin'])) { ?>
                <a href="formAgregarPersona.php" class="btn btn-info">Agregar Persona</a>
            <?php } ?>
            <?php if (in_array($_SESSION['usuario'], ['admin', 'user'])) { ?>
                <a href="mayor.php" class="btn btn-info">Mayor Edad</a>
                <a href="menor.php" class="btn btn-info">Menor Edad</a>
            <?php } ?>
            <br>
            <br/>
            <?php
            $items = (isset($_GET['items'])) ? $_GET['items'] : 5;
            ?>
            <form action="listado.php" method="GET">
            <input type="text" placeholder="Buscar" name="busqueda">
            <input type="submit" value="Buscar" class="btn btn-primary">
            </form>
            <br/><br/>
            <label>Items Pagina</label>    
            <select id="cantItems">
                <option value="5"<?php echo ($items == 5) ? "selected" : ""; ?>>5</option>
                <option value="10"<?php echo ($items == 10) ? "selected" : ""; ?>>10</option>
                <option value="20"<?php echo ($items == 20) ? "selected" : ""; ?>>20</option>
            </select>
            <?php
            $indicadorDireccion = (isset($_GET['direccion'])) ? direccionOrdenamiento($_GET['direccion']) : "ASC";
            $iconoDireccion = ($indicadorDireccion == "DESC") ? "glyphicon glyphicon-circle-arrow-up" : "glyphicon glyphicon-circle-arrow-down";
            $pagActual = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;
            $orden = (isset($_GET['orden'])) ? $_GET['orden'] : "id";
            $direccion = (isset($_GET['direccion'])) ? $_GET['direccion'] : "ASC";
            $busqueda = (isset($_GET['busqueda'])) ? $_GET['busqueda'] : "";
            ?>

            <table class="table">
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
                <tbody> 

                    <?php
                    
                    
                    foreach (listarPersonas($orden, $direccion, $items,$pagActual, $busqueda) as $usuario) {
                        ?>
                        <tr>
                            <td> <?php echo $usuario['id']; ?> </td>
                            <td> <?php echo ucfirst($usuario['nombre']); ?> </td>
                            <td> <?php echo ucfirst($usuario['apellido']); ?> </td>
                            <td> <?php echo $usuario['edad'] ?></td>
                            <td> <?php echo formatearFechaNacimiento($usuario['fecha_nacimiento']); ?></td>
                            <td> <?php echo $usuario['dni']; ?></td>
                            <td><a href="formVerPersona.php?id=<?php echo $usuario['id'] ?>&busqueda=<?php echo $busqueda?>" class="btn btn-success">Ver</a></td>
                            <td> <a href="formModificarPersona.php?id=<?php echo $usuario['id']?>&busqueda=<?php echo $busqueda; ?>" class="btn btn-primary"> Modificar</a></td>
                            <td> <form action="../functions/eliminarPersona.php" method ="POST">
                                    <input type="hidden" value="<?php echo $usuario['dni'] ?>" name="dniPersona" >
                                    <input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger">
                                </form></td>    



                        </tr>  
                        <?php
                    }

                    $total = totalPersonas($busqueda);
                    $cantPaginas = ceil($total / $items);
                    ?>


                </tbody>
            </table>
        </div>

        <div>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $cantPaginas; $i++) { 
                 
                 $active = ($i == $pagActual)?"active": ""; 
                 
                 ?>
                <li class="<?php echo $active; ?>"><a href="<?php echo "listado.php?orden=$orden&direccion=$direccion&items=$items&pagina=$i&busqueda=$busqueda"?>"><?php echo $i ?></a></li>

                <?php } ?>  

            </ul>

        </div> 
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        <script>
            $('#cantItems').change(function () {
                window.location = 'listado.php?' + '<?php echo "orden=$orden&direccion=$direccion&" ?>' + 'items=' + $(this).val();

            });
        </script>

    </body>
</html>
