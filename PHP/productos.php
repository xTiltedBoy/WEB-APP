<?php
include ('functions.php');
$conexion = conexion_db();
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
        obtener_pedidos($conexion);
        ?>
    </body>
</html>