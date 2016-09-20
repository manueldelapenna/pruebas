<?php
require("../scripts/acceso.php");


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

            <a href="agregarUsuario.php" class="btn btn-info">Agregar Usuario</a>

            <br>
            <br/>
            <?php
            $items = (isset($_GET['items'])) ? $_GET['items'] : 5;
            ?>
            <form action="verUsuarios.php" method="GET">
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
                        <th><a href="verUsuarios.php?orden=id&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">ID<?php if ($orden == 'id') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="verUsuarios.php?orden=username&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">USERNAME<?php if ($orden == 'username') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="verUsuarios.php?orden=password&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">CONTRASEÑA<?php if ($orden == 'password') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="verUsuarios.php?orden=fecha_alta&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">FECHA DE ALTA<?php if ($orden == 'fecha_alta') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="verUsuarios.php?orden=ultimo_logueo&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">ULTIMO LOGUEO<?php if ($orden == 'ultimo_logueo') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>

                    </tr>
                </thead>    
                <tbody> 

                    <?php
                    foreach (listarUsuarios($orden, $direccion, $items, $pagActual, $busqueda) as $usuario) {
                        ?>
                        <tr>
                            <td> <?php echo $usuario['id']; ?> </td>
                            <td> <?php echo ucfirst($usuario['username']); ?> </td>
                            <td> <?php echo ucfirst($usuario['password']); ?> </td>
                            <td> <?php echo formatearFechaNacimiento($usuario['fecha_alta']) ?></td>
                            <td> <?php if (is_null($usuario['ultimo_logueo'])) {
                        echo "-----";
                    } else {
                        echo formatearFechaNacimiento($usuario['ultimo_logueo']);
                    } ?></td>
                            <td><a href="verUsuario.php?id=<?php echo $usuario['id'] ?>&busqueda=<?php echo $busqueda ?>" class="btn btn-success">Ver</a></td>
                            <td> <a href="editarUsuario.php?id=<?php echo $usuario['id'] ?>&busqueda=<?php echo $busqueda; ?>" class="btn btn-primary"> Modificar</a></td>
                            <td> <form action="../functions/eliminarUsuario.php" method ="POST">
                                    <input type="hidden" value="<?php echo $usuario['id'] ?>" name="id" >
                                    <input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger">
                                </form></td>    



                        </tr>  
                        <?php
                    }

                    $total = totalUsuarios($busqueda);
                    $cantPaginas = ceil($total / $items);
                    ?>


                </tbody>
            </table>
        </div>

        <div>
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $cantPaginas; $i++) {

                    $active = ($i == $pagActual) ? "active" : "";
                    ?>
                    <li class="<?php echo $active; ?>"><a href="<?php echo "verUsuarios.php?orden=$orden&direccion=$direccion&items=$items&pagina=$i&busqueda=$busqueda" ?>"><?php echo $i ?></a></li>

<?php } ?>  

            </ul>

        </div> 
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        <script>
            $('#cantItems').change(function () {
                window.location = 'verUsuarios.php?' + '<?php echo "orden=$orden&direccion=$direccion&" ?>' + 'items=' + $(this).val();

            });
        </script>

    </body>
</html>
