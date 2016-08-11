<?php if (isset($_SESSION['usuario'])) { ?>
   
<ul class="nav nav-tabs">
    <li><a href = '../web/index.php'>Inicio</a></li>
     <?php if (in_array($_SESSION['usuario'], ['admin'])) { ?>
    <li><a href = '../web/listado.php'>Mostrar Datos</a></li>
    <li><a href = '../web/formAgregarPersona.php'>Agregar Persona</a></li>
    <?php } ?> 
           
    <?php if (in_array($_SESSION['usuario'], ['admin', 'user'])) { ?>
    <li><a href = '../web/mayor.php'>Mayor Edad</a></li>
    <li><a href = '../web/menor.php'>Menor Edad</a></li>
    <?php } ?> 
    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administracion<span class="caret"></span></a>
          <ul class="dropdown-menu">
      <li><a href = '#'>Agregar Grupo</a></li>
      <li><a href = '#'>Agregar Permisos</a></li>
      <li><a href = '#'>Agregar Usuarios</a></li>
    </ul>
  </li>
  <li><a href = '../scripts/logout.php'>Log Out</a></li>
</ul>
   
<?php } ?>