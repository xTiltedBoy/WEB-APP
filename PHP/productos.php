<?php
    $conexion = new mysqli('localhost', 'root', '', 'pedidos');
    if(isset($_GET['productos'])){
        $familia=$_GET['productos'];
    }  
?>
<!DOCTYPE html>
<html><meta charset="UTF-8">
    <head>
        <title>Comida</title>
    </head>
    <body>
        <h1>Comida</h1>
        <p>Platos e ingredientes</p>
        <?php
            //Guardamos una varible con la tabla producto
            $sql= "SELECT * from producto where CodCat='$categoria'";
            
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
                <td><?php echo $filas['Comprar']?></td>
                <td>
                    <form>
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
