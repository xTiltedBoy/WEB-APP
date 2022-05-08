<?php

include "functions.php";

$conexion = conexion_db();

$_SESSION['usuario'] = 1;

$_SESSION['carrito'] = [
    "1" => "3",
    "3" => "2",
    "2" => "t"
];

$resultado = insertar_pedido($conexion);

if ($resultado === true){
    
    echo "Se ha realizado con exito";
    
}
else{
    
    echo $resultado;
    
}


