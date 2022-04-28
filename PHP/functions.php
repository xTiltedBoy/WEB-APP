<?php

// Esta función va a abrir una conexión a la base de datos y 
// te va a devolver la variable donde se guarda la conexión
// Ej: $conexion = conexion_db(IP/Hostname, usuario, contraseña, nombre_db)

function conexion_db($hostname, $user_db, $password, $name_db){

    
    
    $conexion = new mysqli($hostname,$user_db,$password,$name_db);
    
    echo "Se esta realizando la conexión";
    
    $error = $conexion->errno;
  
    if ($error != null){
        
        echo "Error $error $conexion->error";
        
        exit();
        
    }
    else{
        
        echo "La conexión se ha realizado correctamente";
        
        
        
    }
        echo "La conexión se ha realizado correctamente";

        return $conexion;
}

// Esta función va a ejecutar una sentencia SQL y se le tiene que 
// pasar la sentencia que quieres ejecutar y la conexión a la base
// de datos 
// Ej: query_db("Sentencia a ejecutar", $conexion)

function query_db($query, $conexion){
    
    return $conexion->query($query);
    
}

function insertar_pedido(){
    // Abrir conexión con la base de datos (funcion por hacer)
    
    conexion_db("localhost", "root", "", "pedido");
    
    // Insert con los datos del pedido a la base de datos
    // Tanto a la tabla pedidos como a la tabla pedidosproductos
    
    
    
}
    

