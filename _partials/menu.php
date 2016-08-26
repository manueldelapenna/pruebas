<?php if (isset($_SESSION['usuario'])) { ?>
   
<ul class="nav nav-tabs">
    <li><a href = '../web/index.php'>Inicio</a></li>
     <?php if (in_array($_SESSION['usuario'], ['admin'])) { ?>
    <li><a href = '../web/listado.php'>Personas</a></li>
    
    <?php } ?> 
     
    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administracion<span class="caret"></span></a>
          <ul class="dropdown-menu">
      <li><a href = '../web/agregarGrupo.php'>Agregar Grupo</a></li>
      <li><a href = '../web/agregarPermiso.php'>Agregar Permisos</a></li>
      <li><a href = '../web/agregarUsuario.php'>Agregar Usuarios</a></li>
    </ul>
  </li>
  <li><a href = '../scripts/logout.php'>Log Out</a></li>
</ul>
   
<?php } ?>