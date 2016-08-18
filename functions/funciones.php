<?php

include '../config/database.php';

function totalPersonas($busqueda) {
    $pdo = conectar();
    $statement = $pdo->prepare("SELECT count(*) as total "
                             . " FROM personas"
                             . " where nombre like '%$busqueda%' or apellido like '%$busqueda%' ");
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

?>