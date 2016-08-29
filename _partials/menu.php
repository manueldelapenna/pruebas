<?php if (isset($_SESSION['usuario'])) { ?>
   
    <ul class="nav nav-tabs">
        <li><a href = '../web/index.php'>Inicio</a></li>
    <?php if (in_array($_SESSION['usuario'], ['admin'])) { ?>
                <li><a href = '../web/listado.php'>Personas</a></li>

    <?php } ?> 

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administracion<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href = '../web/agregarUsuario.php'>Agregar Usuarios</a></li>
                <li><a href = '../web/agregarGrupo.php'>Agregar Grupos</a></li>
                <li><a href = '../web/agregarPermiso.php'>Agregar Permisos</a></li>

            </ul>
        </li>
        <li><a href = '../scripts/logout.php'>Log Out</a></li>
    </ul>
<!--
    
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Menu</a>
  </div>
 
  
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Inicio</a></li>
      <li><a href="#">Enlace #2</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Menú #1 <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#">Acción #1</a></li>
          <li><a href="#">Acción #2</a></li>
          <li><a href="#">Acción #3</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #4</a></li>
          <li class="divider"></li>
          <li><a href="#">Acción #5</a></li>
        </ul>
      </li>
    </ul>
 </div>
</nav>
-->
<?php } ?>