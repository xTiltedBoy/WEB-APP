<?php
include ('functions.php');

if(isset($_GET['categoria'])){
        $codigo=$_GET['categoria'];
}
comprobar_sesion();
?>
<!DOCTYPE html>
<html><meta charset="UTF-8">
    <head>
        <title>Comida</title>
    </head>
    <body>
        <header>
            <p>Usuario: <!-- poner correo del usuario --> <a href='categorias.php'>Home</a> <a href='carrito.php'>Ver carrito</a> <a href='logout.php'>Cerrar sesión</a></p><hr>
        </header>
        <?php        
        if ($codigo == 1){
            echo '<h1>Comida</h1>';
            echo '<p>Productos y descripción</p>';
        } elseif ($codigo == 2){
            echo '<h1>Bebidas sin</h1>';
            echo '<p>Bebidas y descripción</p>';
        } elseif ($codigo == 3){
            echo '<h1>Bebidas con</h1>';
            echo '<p>Bebidas y descripción</p>';
        }
        
        echo    "<table border='1'><tr><th>Nombre</th><th>Descripción</th><th>Peso</th><th>Stock</th><th>Comprar</th></tr>";
        $productos = obtener_productos($codigo);
        
        $cont = 0;
        while ($cont < count($productos)) {
        
            echo "<tr>";
                echo    "<td>";
                    echo $productos[$cont][1];
                echo    "</td>";
                echo    "<td>";
                    echo $productos[$cont][2];
                echo    "</td>";
                echo    "<td>";
                    echo $productos[$cont][3];
                echo    "</td>";
                echo    "<td>";
                    echo $productos[$cont][4];
                echo    "</td>";
                
                //La variable que lleva el número que ha seleccionado el cliente es 'numero'
                echo "<td>";
                echo    "<form method='POST' action='añadir.php'>";
                echo        "<input type='number' name='numero'>";
                echo        "<input type='submit' value='Comprar'>";
                echo    "</form>";
                echo "</td>";                   
            echo    "</tr>";
        $cont+=1;
        }
        echo    "</table>";
        
        ?>
    </body>
</html>
