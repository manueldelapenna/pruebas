<?php

include '../config/database.php';

function listarPersonas() {

    $pdo = conectar();
    $statement = $pdo->prepare("SELECT * FROM personas");
    $statement->execute();
    $result = $statement->fetchAll();

    return $result;
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

function validarFecha($date, $format = 'd-m-Y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

?>