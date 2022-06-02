<?php
include ('functions.php');
$conexion = conexion_db();
?>
<!DOCTYPE html>
<html><meta charset="UTF-8">
    <body>
        <header>
            <title>Categorías</title>
            <p>Usuario: <!-- poner correo del usuario --> <a href='categorias.php'>Home</a> <a href='carrito.php'>Ver carrito</a> <a href='logout.php'>Cerrar sesión</a></p>
            <hr> 
            <h1>Lista de categorías</h1>
        </header>
        <?php
        obtener_categorias($conexion);
        ?>           
    </body>
</html>