<?php

include "functions.php";

$conexion = conexion_db();

$resultado = insertar_pedido($conexion);

if ($resultado === false){
    
    echo "Se ha producido un error al insertar el pedido";
    
}
else{
    
    echo "Pedido completado con éxito. <br><br> Código de pedido: $resultado";
    
}


