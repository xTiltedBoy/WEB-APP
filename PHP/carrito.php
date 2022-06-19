<?php
include ('functions.php');
comprobar_sesion();
?>
<!DOCTYPE html>
<html><meta charset="UTF-8">
    <body>
        <header>
            <title>Carrito</title>
            <p>Usuario: <?php echo $_SESSION['correo'] ?> <a href='categorias.php'>Home</a> <a href='carrito.php'>Ver carrito</a> <a href='logout.php'>Cerrar sesión</a></p>
            <hr> 
            <h1>Carrito de la compra</h1>
        </header>
        <?php
        
        echo "<table border='1'><tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Unidades</th><th>Eliminar</th></tr>";
        
        foreach ($_SESSION['carrito'] as $key => $value){
            
            echo "<tr>";
                echo    "<td>";
                    echo $_SESSION['carrito'][$key]['nombre'];
                echo    "</td>";
                echo    "<td>";
                    echo $_SESSION['carrito'][$key]['desc'];
                echo    "</td>";
                echo    "<td>";
                    echo $_SESSION['carrito'][$key]['peso'];
                echo    "</td>";
                echo    "<td>";
                    echo $_SESSION['carrito'][$key]['unidades'];
                echo    "</td>";
                echo    "<td>";
                    echo "<form method='POST' action='eliminar.php'>";
                    echo "<input type='hidden' name='codigo' value='".$key."'>";
                    echo "<input type='number' name='unidades' value='".$_SESSION['carrito'][$key]['unidades']."'>";
                    echo "<input type='submit' value='Eliminar'>";
                    echo "</form>";
                echo    "</td>";
                
        echo "</tr>";   
        }
        echo "</table>";
        
        echo "<br><hr><br>";
        
        echo "<a href='procesar_pedido.php'>Realizar pedido</a>";
        
        
        ?>           
    </body>
</html>