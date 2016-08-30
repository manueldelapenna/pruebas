<?php

include $_SERVER['DOCUMENT_ROOT'] . '/pruebas/config/database.php';

function actualizarUpdateId($update_id) {

    $pdo = conectar();
    $statement = $pdo->prepare("UPDATE configuracion "
            . "SET valor=$update_id "
            . "where nombre='update_id'");
    $statement->execute();
    $result = $statement->fetchColumn();


    return $result;
}

function ultimoUpdateId() {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT valor "
            . "from configuracion "
            . "where nombre='update_id'");
    $statement->execute();
    $result = $statement->fetchColumn();


    return $result;
}

function todasPersonas() {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT * from personas");
    $statement->execute();
    $result = $statement->fetchAll();


    return $result;
}

function totalPersonas($busqueda) {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT count(*) as total "
            . " FROM personas"
            . " where nombre like '%$busqueda%' or apellido like '%$busqueda%' ");
    $statement->execute();
    $result = $statement->fetchColumn();



    return $result;
}

function totalGrupos($busqueda) {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT count(*) as total 
                                FROM grupos
                                where nombre like '%$busqueda%' or apellido like '%$busqueda%' ");
    $statement->execute();
    $result = $statement->fetchColumn();



    return $result;
}

function totalPermisos($busqueda) {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT count(*) as total 
                                FROM permisos
                                where nombre like '%$busqueda%' or apellido like '%$busqueda%' ");
    $statement->execute();
    $result = $statement->fetchColumn();



    return $result;
}

function totalUsuarios($busqueda) {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT count(*) as total 
                                FROM usuarios
                                where nombre like '%$busqueda%' or apellido like '%$busqueda%' ");
    $statement->execute();
    $result = $statement->fetchColumn();



    return $result;
}

function listarPersonas($orden, $direccion, $items, $pagina, $busqueda) {

    $offset = ($pagina - 1) * $items;
    $pdo = conectar();

    if ($busqueda != "") {

        $statement = $pdo->prepare("SELECT *, TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad "
                . " FROM personas"
                . " where nombre like '%$busqueda%' or apellido like '%$busqueda%' "
                . " ORDER BY $orden $direccion "
                . " limit $items "
                . " offset $offset"
        );
    } else {
        $statement = $pdo->prepare("SELECT *, TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad "
                . " FROM personas "
                . " ORDER BY $orden $direccion "
                . " limit $items "
                . " offset $offset");
    }

    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function listarUsuarios($orden, $direccion, $items, $pagina, $busqueda) {

    $offset = ($pagina - 1) * $items;
    $pdo = conectar();

    if ($busqueda != "") {

        $statement = $pdo->prepare("SELECT * 
                                    FROM usuarios
                                    where nombre like '%$busqueda%' or apellido like '%$busqueda%' 
                                    ORDER BY $orden $direccion 
                                    LIMIT $items 
                                    OFFSET $offset"
        );
    } else {
        $statement = $pdo->prepare("SELECT *
                                    FROM usuarios 
                                    ORDER BY $orden $direccion 
                                    LIMIT $items
                                    OFFSET $offset");
    }

    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function listarGrupos($orden, $direccion, $items, $pagina, $busqueda) {

    $offset = ($pagina - 1) * $items;
    $pdo = conectar();

    if ($busqueda != "") {

        $statement = $pdo->prepare("SELECT * 
                                    FROM grupos
                                    where nombre like '%$busqueda%' or apellido like '%$busqueda%' 
                                    ORDER BY $orden $direccion 
                                    LIMIT $items 
                                    OFFSET $offset"
        );
    } else {
        $statement = $pdo->prepare("SELECT *
                                    FROM grupos
                                    ORDER BY $orden $direccion 
                                    LIMIT $items
                                    OFFSET $offset");
    }

    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function listarPermisos($orden, $direccion, $items, $pagina, $busqueda) {

    $offset = ($pagina - 1) * $items;
    $pdo = conectar();

    if ($busqueda != "") {

        $statement = $pdo->prepare("SELECT * 
                                    FROM permisos
                                    where nombre like '%$busqueda%' or apellido like '%$busqueda%' 
                                    ORDER BY $orden $direccion 
                                    LIMIT $items 
                                    OFFSET $offset"
        );
    } else {
        $statement = $pdo->prepare("SELECT *
                                    FROM permisos
                                    ORDER BY $orden $direccion 
                                    LIMIT $items
                                    OFFSET $offset");
    }

    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}


function direccionOrdenamiento($direccionActual) {  //cambia la direccion
    if ($direccionActual == "ASC") {
        return "DESC";
    } else {
        return "ASC";
    }
}

function MayorDeEdad($arreglo) {

    $mayor = [];
    $mayor['anios'] = -1;

    foreach ($arreglo as $edadPersona) {
        $funEdad = edad($edadPersona['fecha_nacimiento']);
        if ($mayor['anios'] < $funEdad) {

            $mayor = $edadPersona;
            $mayor['anios'] = $funEdad;
        }
    }

    return $mayor;
}

function MenorDeEdad($arreglo) {
    $menor = [];
    $menor['anios'] = 100;

    foreach ($arreglo as $edadPersona) {
        $funEdad = edad($edadPersona['fecha_nacimiento']);
        if ($menor['anios'] > $funEdad) {

            $menor = $edadPersona;
            $menor['anios'] = $funEdad;
        }
    }

    return $menor;
}

function Promedio() {
    $contador = count($personas);
    $sumador = 0;
    for ($i = 0; $i = $contador; $i++) {

        $sumador = $sumador + $personas[$i][edad];
    }
    $promedio = $sumador / $contador;
    return $promedio;
}

function edad($fechaNacimiento) {

    $datetime1 = new DateTime($fechaNacimiento);
    $datetime2 = new DateTime("now");
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%Y');
}

function agregarUsuarios($dni, $nombre, $apellido, $edad) {
    $pdo = conectar();

    $statement = $pdo->prepare("INSERT INTO usuarios(dni,nombre,apellido,edad) VALUE (:dni,:nombre, :apellido, :edad)");
    $statement->bindParam(':dni', $dni);
    $statement->bindParam(':nombre', $nombre);
    $statement->bindParam(':apellido', $apellido);
    $statement->bindParam(':edad', $edad);
    $statement->execute();
}

function obtenerUsuarios() {
    $pdo = conectar();

    $statement = $pdo->prepare("SELECT * FROM usuarios");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function verificarUsuario($usuario, $contrasena) {

    foreach (obtenerUsuarios() as $u) {

        if ($u['username'] == $usuario && $u['password'] == $contrasena) {
            return TRUE;
        }
    }

    return FALSE;
}

function formatearFechaNacimiento($fechaNacimiento) {

    $objeto = new DateTime($fechaNacimiento);

    $fechaNacimiento = $objeto->format("d/m/Y");
    return $fechaNacimiento;
}

function desformatearFechaNacimiento($fechaNacimiento) {
    $fecha = DateTime::createFromFormat("d/m/Y", $fechaNacimiento);

    return $fecha->format("Y-m-d");
}

function validarFecha($date) {

    $arregloFecha = explode('/', $date);

    if (count($arregloFecha) == 3) {

        if (strlen($arregloFecha[0]) == 2 &&
                strlen($arregloFecha[1]) == 2 &&
                strlen($arregloFecha[2]) == 4) {

            return TRUE;
        }
    }

    return FALSE;
}

function validarPersona($dni, $nombre, $apellido, $nacimiento) {

    $errores = array();
//validacion dni
    if (is_numeric($dni) != 1 || strlen($dni) > 8) {

        $errores['dni'] = "Dni incorrecto";
    }
//fin validacion dni
//
//validacion nombre y apellido

    if (strlen($nombre) == 0) {
        $errores['nombre'] = "Nombre es un campo obligatorio";
    } else {
        if (!soloLetras($nombre)) {
            $errores['nombre'] = "Solo se permiten letras en el campo nombre";
        }
    }

    if (strlen($apellido) == 0) {
        $errores['apellido'] = "Apellido es un campo obligatorio";
    } else {
        if (!soloLetras($apellido)) {
            $errores['apellido'] = "Solo se permiten letras en el campo apellido";
        }
    }

//fin validacion nombre y apellido
//
//validacion del año de nacimiento
    if (validarFecha($nacimiento)) {

        list($dia, $mes, $anio) = explode('/', $nacimiento);
        $nacimiento = $anio . "-" . $mes . "-" . $dia;
        $edad = edad($nacimiento);
        if ($edad < 18) {
            $errores['nacimiento'] = "La persona debe ser mayor a 18 años";
        }
    } else {

        $errores['nacimiento'] = "Fecha de nacimiento incorrecta ej: dd/mm/aaaa";
    }
//fin validacion año de nacimiento
    return $errores;
}

function soloLetras($in) {
    if (preg_match('/^([a-z ñáéíóú]{2,255})$/i', $in))
        return TRUE;
    else
        return FALSE;
}

function getPermisos() {

    $pdo = conectar();
    $statement = $pdo->prepare("SELECT *"
            . "FROM permisos");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function getGrupo($id) {

    $pdo = conectar();
    $statement = $pdo->prepare("SELECT *"
            . "FROM grupos WHERE id = $id");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function todosLosGrupos(){
   $pdo = conectar();
    $statement = $pdo->prepare("SELECT *
                                FROM grupos");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result; 
}

function getGrupoConPermisos($id) {
    //obtiene los permisos del grupo que le pasamos por parametro
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT g.id AS grupo_id, g.name AS grupo_nombre, p.id AS permiso_id, p.name AS permiso_nombre
                               FROM grupos g INNER JOIN grupos_permisos gp ON 
                                     g.id = gp.grupo_id INNER JOIN permisos p ON
                                     p.id = gp.permisos_id
                               WHERE g.id = $id");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function getUsuarioConPermisos($id){
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT u.id as usuario_id, u.username AS username, u.password AS password, p.id AS permiso_id, p.name AS permiso_nombre
                                FROM usuarios u INNER JOIN usuarios_permisos up ON
                                      u.id = up.user_id INNER JOIN permisos p ON
                                      p.id = up.permisos_id
                                WHERE u.id = $id" 
                                );
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

function getUsuarioConGrupos($id){
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT u.id AS usuario_id, u.username AS username, u.password AS password, g.id AS grupo_id, g.name AS grupo_name 
                                FROM usuarios u INNER JOIN usuarios_grupos ug ON
                                    u.id = ug.user_id INNER JOIN grupos g ON
                                    ug.group_id = g.id
                                WHERE u.id = $id");
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

function usuarioTienePermiso($permisosUsuario, $idPermiso){
    foreach($permisosUsuario as $permiso){
        if($permiso['id'] == $idPermiso){
            return TRUE;
        }
    }
    return FALSE;
}

function usuarioPerteneceGrupo($gruposUsuario, $idGrupo){
    foreach($gruposUsuario as $grupo){
        if($grupo['grupo_id'] == $idGrupo){
            return TRUE;
        }
    }
    return FALSE;
}

function getUsuario($id){
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT * 
                                FROM usuarios u
                                WHERE u.id = $id");
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
    
}


function grupoTienePermiso($permisosDeGrupos, $idPermiso) {
    foreach ($permisosDeGrupos as $aux) {
        if ($aux['permiso_id'] == $idPermiso) {
            return TRUE;
        }
    }
    return FALSE;
}

function getGrupos() {

    $pdo = conectar();
    $statement = $pdo->prepare("SELECT *
                               FROM grupos");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
}

function getPermiso($id){
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT * 
                                FROM permisos
                                WHERE id = $id");
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;
}

?>