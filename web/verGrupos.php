<?php
require("../scripts/acceso.php");
tieneAcceso('grupos_listar');

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
            <a href="agregarGrupo.php" class="btn btn-info">Agregar Grupo</a>
            <?php } ?>
            <br>
            <br/>
            <?php
            $items = (isset($_GET['items'])) ? $_GET['items'] : 5;
            ?>
            <form action="verGrupos.php" method="GET">
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
                        <th><a href="verGrupos.php?orden=id&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">ID<?php if ($orden == 'id') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        <th><a href="verGrupos.php?orden=name&direccion=<?php echo $indicadorDireccion; ?>&items=<?php echo $items ?>&pagina=<?php echo $pagActual ?>&busqueda=<?php echo $busqueda; ?>">Nombre<?php if ($orden == 'name') { ?><span class="<?php echo $iconoDireccion; ?>"<?php } ?></a></th>
                        
                    </tr>
                </thead>    
                <tbody> 

                    <?php
                    
                    
                    foreach (listarGrupos($orden, $direccion, $items,$pagActual, $busqueda) as $grupo) {
                        ?>
                        <tr>
                            <td> <?php echo $grupo['id']; ?> </td>
                            <td> <?php echo ucfirst($grupo['name']); ?> </td>
                            <td><a href="VerGrupo.php?grupoID=<?php echo $grupo['id'] ?>&busqueda=<?php echo $busqueda?>" class="btn btn-success">Ver</a></td>
                            <td> <a href="editarGrupo.php?grupoID=<?php echo $grupo['id']?>&busqueda=<?php echo $busqueda; ?>" class="btn btn-primary"> Modificar</a></td>
                            <td> <form action="../functions/eliminarGrupo.php" method ="POST">
                                    <input type="hidden" value="<?php echo $grupo['id'] ?>" name="id" >
                                    <input type="submit" name="eliminar" value="Eliminar" class="btn btn-danger">
                                </form></td>    



                        </tr>  
                        <?php
                    }

                    $total = totalGrupos($busqueda);
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
                <li class="<?php echo $active; ?>"><a href="<?php echo "verGrupos.php?orden=$orden&direccion=$direccion&items=$items&pagina=$i&busqueda=$busqueda"?>"><?php echo $i ?></a></li>

                <?php } ?>  

            </ul>

        </div> 
        <?php
        $path = $rootpath . '/pruebas/_partials/footer.php';
        include_once($path);
        ?>
        <script>
            $('#cantItems').change(function () {
                window.location = 'verGrupos.php?' + '<?php echo "orden=$orden&direccion=$direccion&" ?>' + 'items=' + $(this).val();

            });
        </script>

    </body>
</html>
