<?php
include ('functions.php');
// Esta función va a abrir una conexión a la base de datos y 
// te va a devolver la variable donde se guarda la conexión
// Ej: $conexion = conexion_db(IP/Hostname, usuario, contraseña, nombre_db)
conexion_db();
?>

<!DOCTYPE html>
<html><meta charset="UTF-8">
    <head>
        
    </head>
    <body>
        <header>
            <title>Categorías</title>
            <p>Usuario: <!-- poner correo del usuario --> <a href='categorias.php'>Home</a> <a href='carrito.php'>Ver carrito</a> <a href='logout.php'>Cerrar sesión</a></p>
            <hr> 
            <h1>Lista de categorías</h1>
        </header>
        <?php
            //Guardamos una varible con la tabla familia
            $sql= "SELECT * from categoria";
            
            //Guardamos en una varible una consulta a la tabla familia
            $resultado=$conexion->query($sql);
            
            //Si el número de filas es mayor que cero, hace un bucle que muestre el nombre de la tabla
            if($resultado->num_rows > 0){
                while($filas = $resultado->fetch_array()){
        ?>
        <ul>
            <li type='disc'>
            <?php        
                    echo "<a href='productos.php?categoria=".$filas['CodCat']. "'>".$filas['Nombre']."</a><br>";
            ?>
            </li>
        </ul>   
        <?php
                }
            }
        ?>
            
    </body>
</html>