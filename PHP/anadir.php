<?php

include 'functions.php';

comprobar_sesion();

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$desc = $_POST['desc'];
$peso = $_POST['peso'];
$unidades = $_POST['unidades'];

if (isset($_SESSION['carrito'][$codigo])){
    $_SESSION['carrito'][$codigo]['unidades'] += $unidades;
}
else{
    $_SESSION['carrito'][$codigo]['nombre'] = $nombre;
    $_SESSION['carrito'][$codigo]['desc'] = $desc;
    $_SESSION['carrito'][$codigo]['peso'] = $peso;
    $_SESSION['carrito'][$codigo]['unidades'] = $unidades;
}
header('location: productos.php?categoria='.$_POST['codigoCat'].'');
