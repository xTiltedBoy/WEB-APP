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
            $sql= "SELECT * from productos where CodCat='$familia'";
            
            //Guardamos en una varible una consulta a la tabla producto
            $resultado=$conexion->query($sql);
            
        ?>
        <table><tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Stock</th><th>Comprar</th></tr>
        <?php
            //Si el número de filas es mayor que cero, hace un bucle que muestre el nombre de la tabla
            if($resultado->num_rows > 0){
                while($filas = $resultado->fetch_array()){
        ?>
            <tr>
                <td><?php echo $filas['Nombre']?></td>
                <td><?php echo $filas['Descripcion']?></td>
                <td><?php echo $filas['Peso']?></td>
                <td><?php echo $filas['Stock']?></td>
                <?php echo $filas['Comprar']?>
                
                <!-- La variable que lleva el número que ha seleccionado el cliente es 'numero' -->
                <td>
                    <form method='POST' action='añadir.php'>
                        <input type='number' name='numero'>
                        <input type='submit' value='Comprar'>
                    </form>
                </td> 
        <?php       
                }
            }
        ?>                    
            </tr>
        </table>
    </body>
</html>