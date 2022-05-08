<?php

// Esta función va a abrir una conexión a la base de datos y 
// te va a devolver la variable donde se guarda la conexión
// Ej: $conexion = conexion_db()

function conexion_db(){
    $hostname='localhost';
    $user_db='root'; 
    $password='';
    $name_db='pedidos';
   
    $conexion = new mysqli($hostname,$user_db,$password,$name_db);
    
    $error = $conexion->errno;
  
    if ($error != null){
        
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
// Ej: $resultado = query_db("Sentencia a ejecutar", $conexion)

function query_db($query, $conexion){
    
    $resultado = $conexion->query($query);
    
    $error = $conexion->errno;
    
    if ($conexion->errno){
        
        return $error;
        
    }
    else{
        
        return $resultado;
        
    }
    
}

function insertar_pedido($conexion){
    
    // Desabilitamos el autocommit de la base de datos
    
    $query = "SET AUTOCOMMIT=0";    
    query_db($query, $conexion);
    
    // Inicializamos las variables
    
    $usuario = $_SESSION['usuario'];
    $carrito = $_SESSION['carrito'];

    // Hacemos una SELECT para ver cual fue el último CodPed y sumarlo en 1
    
    $SELECT = "SELECT MAX(CodPed) + 1 FROM pedidos";
    
    $CodPed = query_db($SELECT, $conexion);
    $CodPed = $CodPed->fetch_array();
    $CodPed = $CodPed[0];
    
    // Hacemos un INSERT con el pedido a la tabla pedidos
    
    $Date = date("Y-m-d H:i:s");
    
    $INSERT = "INSERT INTO pedidos (CodPed, Fecha, Enviado, Restaurante) VALUES ($CodPed, '$Date', 0, $usuario)";
    query_db($INSERT, $conexion);
    
    // Hacemos los INSERT con los productos y unidades en la tabla pedidosproductos
    
    foreach ($carrito as $CodProd => $Unidades){
        
        $INSERT="INSERT INTO pedidosproductos (CodPed, CodProd, Unidades) VALUES ($CodPed, $CodProd, $Unidades)";
        $resultado = query_db($INSERT, $conexion);
        
        $error = false;
        
        if (is_int($resultado) === true){
            
            $error = true;
            $codigoError += "\n$resultado";
            
        }
       
    }
    
    // Si ha dado algun error hacemos un ROLLBACK, si no hacemos un COMMIT
    
    if ($error){
        
        //$ROLLBACK = "ROLLBACK";
        //query_db($ROLLBACK, $conexion);
        
        return $codigoError;
        
    }
    else{
        
        $COMMIT = "COMMIT";
        query_db($COMMIT, $conexion);
        
        return true;
        
    }
    
    // Volvemos a poner el AUTOCOMMIT
    
    $query = "SET AUTOCOMMIT=1";    
    query_db($query, $conexion);
    
}
    

