<?php

include "functions.php";

$resultado = insertar_pedido();

if ($resultado === false){
    
    echo "Se ha producido un error al insertar el pedido";
    
}
else{
    
    echo "Pedido completado con éxito. <br><br> Código de pedido: $resultado";
    
}


