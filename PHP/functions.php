<?php

// Esta función va a abrir una conexión a la base de datos y 
// te va a devolver la variable donde se guarda la conexión
// Ej: $conexion = conexion_db(IP/Hostname, usuario, contraseña, nombre_db)

function conexion_db($hostname, $user_db, $password, $name_db){

    $conexion = new mysqli($hostname,$user_db,$password,$name_db);
    
    $error = $conexion->errno;
  
    if ($error != 0){
        
        echo "Error $error $conexion->error";
        
        exit();
        
    }
    else{
        
        return $conexion;
        
    }
}

// Esta función va a ejecutar una sentencia SQL y se le tiene que 
// pasar la sentencia que quieres ejecutar y la conexión a la base
// de datos 
// Ej: query_db("Sentencia a ejecutar", $conexion)

function query_db($query, $conexion){
    
    return $conexion->query($query);
    
}

function insertar_pedido($conexion){
    // Abrir conexión con la base de datos (funcion por hacer) 
    // Insert con los datos del pedido a la base de datos
    // Tanto a la tabla pedidos como a la tabla pedidosproductos
    
    $usuario = $_SESSION['usuario'];
    $carrito = $_SESSION['carrito'];
    
    $insert = 'INSERT INTO pedidos (Fecha, Enviado, Restaurante) VALUES ('.date("YYYY-mm-dd").', 0, '.$usuario.')';
    
    foreach ($carrito as $CodPed => $Unidades){
        
        echo "$CodPed => $Unidades<br>";
        
        $insert='INSERT INTO pedidosproductos (CodPed, CodProd, Unidades)';
            
            $resultado = $conexion->query($insert);
        
    }
    
}
    

