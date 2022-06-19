<?php
include ('functions.php');
comprobar_sesion();
?>
<!DOCTYPE html>
<html><meta charset="UTF-8">
    <body>
        <header>
            <title>Categorías</title>
            <p>Usuario: <?php echo $_SESSION['correo'] ?> <a href='categorias.php'>Home</a> <a href='carrito.php'>Ver carrito</a> <a href='logout.php'>Cerrar sesión</a></p>
            <hr> 
            <h1>Lista de categorías</h1>
        </header>
        <?php
        $categorias = obtener_categorias();
        
        echo "<ul>";
        $cont = 0;
        while ($cont < count($categorias)) {
        
        echo    "<li type='disc'>";
                        
                echo "<a href='productos.php?categoria=".$categorias[$cont][0]. "'>".$categorias[$cont][1]."</a><br>";
            
        echo    "</li>";
        $cont+=1;
        }
        echo "</ul>";
        ?>           
    </body>
</html>