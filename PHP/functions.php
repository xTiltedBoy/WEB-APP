<?php

// Esta función va a abrir una conexión a la base de datos y te va a devolver la variable donde se guarda la conexión
// Ej: $conexion = conexion_db()

function conexion_db(){
    $hostname='localhost';
    $user_db='root'; 
    $password='';
    $name_db='pedidos';
   
    try{
     
        $conexion = new mysqli($hostname,$user_db,$password,$name_db);
        
        return $conexion;
        
    } catch (Exception $ex) {
        
        echo $ex->getMessage()." on line ".$ex->getLine();
        die();
        
    }
    
}

// Esta función va a ejecutar una sentencia SQL y se le tiene que pasar la sentencia que quieres ejecutar y la conexión a la base de datos 
// Ej: $resultado = query_db("Sentencia a ejecutar", $conexion)

function query_db($query, $conexion){
    
    // Iniciamos un bloque try para capturar la excepción en caso de que de error
    // En caso de que no se de ningun error devolvemos el resultado
    
    try{
        
        $resultado = $conexion->query($query);
        
        return $resultado;
        
    } 
    
    // En caso de que de error se devuelve ERROR
    
    catch (Exception $ex) {
          
        return "ERROR";
        
    }
    
}

    // Esta función va a insertar un pedido en la base de datos con los productos que haya en el carrito
    // Ej: $resultado = insertar_pedido($conexion)

function insertar_pedido($conexion){
    
    // Desabilitamos el AUTOCOMMIT de la base de datos
    
    $query = "SET AUTOCOMMIT=0";    
    query_db($query, $conexion);
    
    // Inicializamos las variables
    
    $usuario = $_SESSION['usuario'];
    $carrito = $_SESSION['carrito'];

    // Hacemos una SELECT para ver cual fue el último CodPed y sumarlo en 1
    
    
    
    $SELECT = "SELECT * FROM pedidos";
    
    $CodPed = query_db($SELECT, $conexion);
    $CodPed = $CodPed->num_rows;   
    $CodPed += 1;
    
    // Hacemos un INSERT con el pedido a la tabla pedidos
    
    $Date = date("Y-m-d H:i:s");
    
    $INSERT = "INSERT INTO pedidos (CodPed, Fecha, Enviado, Restaurante) VALUES ($CodPed, '$Date', 0, $usuario)";
    query_db($INSERT, $conexion);
    
    // Hacemos los INSERT con los productos y unidades en la tabla pedidosproductos
    
    foreach ($carrito as $CodProd => $Unidades){
        
        $INSERT="INSERT INTO pedidosproductos (CodPed, CodProd, Unidades) VALUES ($CodPed, $CodProd, $Unidades)";
        $resultado = query_db($INSERT, $conexion);
       
    }
    
    // Si ha dado algun error hacemos un ROLLBACK, si no hacemos un COMMIT
    
    if ($resultado === "ERROR"){
        
        $ROLLBACK = "ROLLBACK";
        query_db($ROLLBACK, $conexion);
        
        return false;
        
    }
    else{
        
        $COMMIT = "COMMIT";
        query_db($COMMIT, $conexion);
        
        return $CodPed;
        
    }
    
    // Volvemos a poner el AUTOCOMMIT
    
    $query = "SET AUTOCOMMIT=1";    
    query_db($query, $conexion);
    
}

function obtener_categorias($conexion){
    
    $query= "SELECT * from categoria";
    $resultado = query_db($query, $conexion);
    
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

function obtener_pedidos($conexion){
    
    if(isset($_GET['categoria'])){
        $familia=$_GET['categoria'];
}  
    
    if ($familia == 1){
            echo '<h1>Comida</h1>';
            echo '<p>Productos y descripción</p>';
        } elseif ($familia == 2){
            echo '<h1>Bebidas sin</h1>';
            echo '<p>Bebidas y descripción</p>';
        } elseif ($familia == 3){
            echo '<h1>Bebidas con</h1>';
            echo '<p>Bebidas y descripción</p>';
        }
    
    $query= "SELECT * from productos where CodCat='$familia'";
    $resultado = query_db($query, $conexion); 
    
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

function comprobar_usuario($correo, $clave){    
    if($correo == ''){
        echo "Error introduzca el correo.<br>";       
    }
    if($clave == ''){
        echo "Error introduzca la contraseña.<br>";
    }
    
    $conexion = conexion_db();
    $query = "SELECT * FROM restaurantes WHERE Correo = '".$correo."' AND Clave = '".$clave."'";
    $resultado = query_db($query, $conexion);
    $resultado = $resultado->num_rows;
    
    if($resultado == 1) {
       header('location: categorias.php');
       session_start();
    }
    else {
       echo "Usuario no existe"; 
    }
}
