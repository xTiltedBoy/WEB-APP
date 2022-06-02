<?php
include ('functions.php');
// Esta función va a abrir una conexión a la base de datos y 
// te va a devolver la variable donde se guarda la conexión
// Ej: $conexion = conexion_db(IP/Hostname, usuario, contraseña, nombre_db)
$conexion = conexion_db();

if(isset($_GET['categoria'])){
        $familia=$_GET['categoria'];
}  
?>
<!DOCTYPE html>
<html><meta charset="UTF-8">
    <head>
        <title>Comida</title>
    </head>
    <body>
        <header>
            <p>Usuario: <!-- poner correo del usuario --> <a href='categorias.php'>Home</a> <a href='carrito.php'>Ver carrito</a> <a href='logout.php'>Cerrar sesión</a></p>
            <hr> 
        </header>
        <?php
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
        ?>
        
        <?php
        //Guardamos una varible con la tabla producto
        $query= "SELECT * from productos where CodCat='$familia'";
            
        // Esta función va a ejecutar una sentencia SQL y se le tiene que 
        // pasar la sentencia que quieres ejecutar y la conexión a la base
        // de datos 
        // Ej: query_db("Sentencia a ejecutar", $conexion)
        $resultado = query_db($query, $conexion);   
        obtener_pedidos($resultado);
        ?>
    </body>
</html>