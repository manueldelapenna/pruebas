<?php
 
function cargarDatos() {

    $personas = [];
    $persona = [];

    $persona["nombre"] = "Manuel";
    $persona["apellido"] = "Dela";
    $persona["edad"] = 30;
       
    
    $personas[] = $persona;

    $persona["nombre"] = "Tomas";
    $persona["apellido"] = "Echague";
    $persona["edad"] = 21;
        
    $personas[] = $persona;
    
    $personas[] = [
        "nombre" => "Emiliano",
        "apellido" => "Tierno",
        "edad" => 32,
    ];

    $persona["nombre"] = "Juan";
    $persona["apellido"] = "Perez";
    $persona["edad"] = 40;
    

    $personas[] = $persona;

    $persona["nombre"] = "Jose";
    $persona["apellido"] = "Sanchez";
    $persona["edad"] = 60;
    

    $personas[] = $persona;

    $persona["nombre"] = "Pepe";
    $persona["apellido"] = "Lopez";
    $persona["edad"] = 75;

    $personas[] = $persona;

    $persona["nombre"] = "Jorge";
    $persona["apellido"] = "Rodriguez";
    $persona["edad"] = 18;
    

    $personas[] = $persona;

    $persona["nombre"] = "Sebastian";
    $persona["apellido"] = "Veron";
    $persona["edad"] = 40;
    

    $personas[] = $persona;

    $persona["nombre"] = "Carlos";
    $persona["apellido"] = "Tevez";
    $persona["edad"] = 32;
    

    $personas[] = $persona;

    $persona["nombre"] = "Oscar";
    $persona["apellido"] = "Cordoba";
    $persona["edad"] = 42;
    

    $personas[] = $persona;

    $persona["nombre"] = "Roman";
    $persona["apellido"] = "Riquelme";
    $persona["edad"] = 37;
    

    $personas[] = $persona;

    $persona["nombre"] = "Martin";
    $persona["apellido"] = "Palermo";
    $persona["edad"] = 39;
    

    $personas[] = $persona;

    $persona["nombre"] = "Emanuel";
    $persona["apellido"] = "Ginobili";
    $persona["edad"] = 40;
    

    $personas[] = $persona;

    $persona["nombre"] = "Luis";
    $persona["apellido"] = "Scola";
    $persona["edad"] = 37;
    

    $personas[] = $persona;

    $persona["nombre"] = "Hernan";
    $persona["apellido"] = "Diaz";
    $persona["edad"] = 23;
    

    $personas[] = $persona;

    return $personas;
}


function MayorDeEdad($arreglo){
   
    $mayor = [];
    $mayor['edad']= -1;
    for($i=0;$i < count($arreglo); $i++){
        if($mayor['edad'] < $arreglo[$i]['edad']){
            $mayor = $arreglo[$i];
           
        }
    }
    
    return $mayor;
}

function MenorDeEdad($arreglo){
    $menor = [];
    $menor['edad']= 100;
    for($i=0;$i < count($arreglo); $i++){
        if($menor['edad'] > $arreglo[$i]['edad']){
            $menor = $arreglo[$i];
           
        }
    }
    
    return $menor;
}

function Promedio(){
    $contador = count($personas);
    $sumador = 0;
    for($i=0; $i= $contador; $i++){
        
        $sumador = $sumador + $personas[$i][edad];
    }
    $promedio = $sumador / $contador;
    return $promedio;
    
}

function AñoDeNacimiento($edad){
    
    $nacimiento = date("Y")- $edad;
    
    
    return $nacimiento;
}



function agregarUsuarios($usuario, $contrasena){
    $user= array();
    $users = obtenerUsuarios();            
    
    $user['nombre'] = $usuario;
    $user['contrasena'] = $contrasena;
    
    $users[]= $user;
    
    return $users;
    
}

function obtenerUsuarios(){
    $users = array();
    $user = [];
    
    $user['nombre']= "admin";
    $user['contrasena'] = "admin";
    
    $users[]= $user;
    
    $user['nombre']= "user";
    $user['contrasena'] = "user";
    
    $users[]= $user;
    
    $user['nombre']= "pepito";
    $user['contrasena'] = "pepito";
    
    $users[]= $user;
    
    $user['nombre']= "marcelo";
    $user['contrasena'] = "tinelli";
    
    $users[]= $user;
    
    
    
    return $users;
}


function verificarUsuario($usuario, $contrasena){

        foreach(obtenerUsuarios() as $u){
        
        if($u['nombre'] == $usuario  && $u['contrasena'] == $contrasena){
            return TRUE;
        }
        
    }
    
    return FALSE;

    
    
    
    
}

?>