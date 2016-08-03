<?php if (isset($_SESSION['usuario'])) { ?>
    <div class="container">
        <div class="btn-group" role="group" aria-label="..." data-toggle="collapse" style="margin-left: 220px;">

            <button type="button" class="btn btn-default" data-toggle="collapse" onClick="location.href = '../web/index.php'">Inicio</button>
            <?php if (in_array($_SESSION['usuario'], ['admin'])) { ?>
                <button type="button" class="btn btn-default" data-toggle="collapse" onClick="location.href = '../web/listado.php'">Mostrar Datos</button>
            <?php } ?> 
           
             <?php if (in_array($_SESSION['usuario'], ['admin', 'user'])) { ?>

                <button type="button" class="btn btn-default" data-toggle="collapse" onclick="location.href = '../web/mayor.php'" >Mayor de Edad</button>

                <button type="button" class="btn btn-default" data-toggle="collapse" onClick = "location.href = '../web/menor.php'">Menor de Edad</button>
            <?php } ?> 
            <button type="button" class="btn btn-default" data-toggle="collapse" onClick = "location.href = '../scripts/logout.php'">Log Out</button>


        </div>
    </div>    
<?php } ?>