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

function ejecuta_consulta($query){
    $hostname='localhost';
    $user_db='root'; 
    $password='';
    $name_db='pedidos';
   
    try{
     
        $conexion = new mysqli($hostname,$user_db,$password,$name_db);

    } catch (Exception $ex) {
        
        echo $ex->getMessage()." on line ".$ex->getLine();
        die();
        
    }
    
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

function insertar_pedido(){
    
    // Desabilitamos el AUTOCOMMIT de la base de datos
    
    $query = "SET AUTOCOMMIT=0";    
    ejecuta_consulta($query);
    
    // Inicializamos las variables
    
    $usuario = $_SESSION['usuario'];
    $carrito = $_SESSION['carrito'];

    // Hacemos una SELECT para ver cual fue el último CodPed y sumarlo en 1
    
    
    
    $SELECT = "SELECT * FROM pedidos";
    
    $CodPed = ejecuta_consulta($SELECT);
    $CodPed = $CodPed->num_rows;   
    $CodPed += 1;
    
    // Hacemos un INSERT con el pedido a la tabla pedidos
    
    $Date = date("Y-m-d H:i:s");
    
    $INSERT = "INSERT INTO pedidos (CodPed, Fecha, Enviado, Restaurante) VALUES ($CodPed, '$Date', 0, $usuario)";
    ejecuta_consulta($INSERT);
    
    // Hacemos los INSERT con los productos y unidades en la tabla pedidosproductos
    
    foreach ($carrito as $CodProd => $Unidades){
        
        $INSERT="INSERT INTO pedidosproductos (CodPed, CodProd, Unidades) VALUES ($CodPed, $CodProd, $Unidades)";
        $resultado = ejecuta_consulta($INSERT);
       
    }
    
    // Si ha dado algun error hacemos un ROLLBACK, si no hacemos un COMMIT
    
    if ($resultado === "ERROR"){
        
        $ROLLBACK = "ROLLBACK";
        ejecuta_consulta($ROLLBACK);
        
        return false;
        
    }
    else{
        
        $COMMIT = "COMMIT";
        ejecuta_consulta($COMMITn);
        
        return $CodPed;
        
    }
    
    // Volvemos a poner el AUTOCOMMIT
    
    $query = "SET AUTOCOMMIT=1";    
    ejecuta_consulta($query);
    
}

function obtener_categorias(){    
    $query= "SELECT * from categoria";
    $resultado = ejecuta_consulta($query);
    
    if($resultado->num_rows > 0){               
        $categorias = $resultado->fetch_all();
    }
    return $categorias;
}

function obtener_productos($codigo){
    $query= "SELECT * from productos where CodCat='$codigo'";
    $resultado = ejecuta_consulta($query);
    
    //Si el número de filas es mayor que cero, hace un bucle que muestre el nombre de la tabla
    if($resultado->num_rows > 0){
        $productos = $resultado->fetch_all();
    }
    return $productos;           
}

function comprobar_usuario($correo, $clave){
    session_start();
    
    if($correo == ''){
        echo "Error introduzca el correo.<br>";       
    }
    if($clave == ''){
        echo "Error introduzca la contraseña.<br>";
    }

    $query = "SELECT * FROM restaurantes WHERE Correo = '".$correo."' AND Clave = '".$clave."'";
    $resultado = ejecuta_consulta($query);
    $resultado = $resultado->num_rows;
    
    if($resultado == 1){
       $_SESSION['correo'] = $correo;
       header('location: categorias.php');
    }
    else{
       echo "Usuario no existe";
       session_destroy();
    }
}

function comprobar_sesion(){
    session_start();
    
    $varsesion = $_SESSION['correo'];
    
    if($varsesion == null || $varsesion == "") {
        header("location: login.php");
    }
}