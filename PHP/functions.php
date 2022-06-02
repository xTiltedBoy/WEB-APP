<?php

// Esta función va a abrir una conexión a la base de datos y 
// te va a devolver la variable donde se guarda la conexión
// Ej: $conexion = conexion_db(IP/Hostname, usuario, contraseña, nombre_db)

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
// Ej: query_db("Sentencia a ejecutar", $conexion)

function query_db($query, $conexion){
    
    $resultado = $conexion->query($query);
    
    $error = $conexion->errno;
    
    if ($error != null){
        
        return $error;
        
    }
    else{
        
        return $resultado;
        
    }
    
}

function insertar_pedido($conexion){
    
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
    
    foreach ($carrito as $CodProd => $Unidades){
        
        $INSERT="INSERT INTO pedidosproductos (CodPed, CodProd, Unidades) VALUES ($CodPed, $CodProd, $Unidades)";
        $resultado = query_db($INSERT, $conexion);
        
        
        $contador = 0;
        
        if (is_int($resultado) === true){
            
            $contador += 1;
            $codigo_error = $resultado;
            
        }
       
    }
    
    if ($contador > 0){
        
        return $codigo_error;
        
    }
    else{
        
        return true;
        
    }
    
}

function obtener_categorias($resultado){
    
    if($resultado->num_rows > 0){
                while($filas = $resultado->fetch_array()){
        
        echo "<ul>";
        echo    "<li type='disc'>";
                  
                    echo "<a href='productos.php?categoria=".$filas['CodCat']. "'>".$filas['Nombre']."</a><br>";
            
        echo    "</li>";
        echo "</ul>";
        
                }
            }       
}

function obtener_pedidos($resultado){
    
    echo "<table><tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Stock</th><th>Comprar</th></tr>";

            //Si el número de filas es mayor que cero, hace un bucle que muestre el nombre de la tabla
            if($resultado->num_rows > 0){
                while($filas = $resultado->fetch_array()){
        
            echo "<tr>";
            echo    "<td>";
                    echo $filas['Nombre'];
            echo    "</td>";
            echo    "<td>";
                    echo $filas['Descripcion'];
            echo    "</td>";
            echo    "<td>";
                    echo $filas['Peso'];
            echo    "</td>";
            echo    "<td>";
                    echo $filas['Stock'];
            echo    "</td>";
            
                echo $filas['Comprar'];
                
                //La variable que lleva el número que ha seleccionado el cliente es 'numero'
                echo "<td>";
                echo    "<form method='POST' action='añadir.php'>";
                echo        "<input type='number' name='numero'>";
                echo        "<input type='submit' value='Comprar'>";
                echo    "</form>";
                echo "</td>";
              
                }
            }
                           
        echo    "</tr>";
        echo    "</table>";

}