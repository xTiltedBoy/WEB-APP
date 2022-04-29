<?php

include "functions.php";

conexion_db("localhost", "root", "", "pedidos");

$_SESSION['usuario'] = 1;

$_SESSION['carrito'] = [
    "1" => "3",
    "3" => "2",
    "2" => "6"
];

insertar_pedido();

