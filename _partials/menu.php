<?php if (isset($_SESSION['usuario'])) { ?>

    <nav class="navbar navbar-default" role="navigation">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse">
                <span class="sr-only">Desplegar navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Men&uacute;</a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="../web/index.php">Inicio</a></li>

                <li><a href="../web/listado.php">Personas</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Administracion<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="../web/verUsuarios.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Usuarios</a></li>
                        <li class="divider"></li>
                        <li><a href="../web/verGrupos.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Grupos</a></li>
                        <li class="divider"></li>
                        <li><a href="../web/verPermisos.php"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>Permisos</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="../scripts/editarMiUsuario.php">Editar Usuario</a></li>
                <li><a href="../scripts/logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>Log Out</a></li>
            </ul>
        </div>
    </nav>

<?php } ?>