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
            <p>Usuario: <?php echo $_SESSION['correo'] ?> <a href='categorias.php'>Home</a> <a href='carrito.php'>Ver carrito</a> <a href='logout.php'>Cerrar sesión</a></p><hr>
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
                echo    "<form method='POST' action='anadir.php'>";
                echo        "<input type='hidden' name='codigo' value='".$productos[$cont][0]."'>";
                echo        "<input type='hidden' name='nombre' value='".$productos[$cont][1]."'>";
                echo        "<input type='hidden' name='desc' value='".$productos[$cont][2]."'>";
                echo        "<input type='hidden' name='peso' value='".$productos[$cont][3]."'>";
                echo        "<input type='hidden' name='stock' value='".$productos[$cont][4]."'>";
                echo        "<input type='hidden' name='codigoCat' value='".$codigo."'>";
                echo        "<input type='number' name='unidades' value='1'>";
                echo        "<input type='submit' value='Comprar'>";
                echo    "</form>";
                echo "</td>";                   
            echo    "</tr>";
        $cont+=1;
        }
        echo    "</table>";
        
        print_r($_SESSION);
        
        ?>
    </body>
</html>
