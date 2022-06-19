<?php

include 'functions.php';

comprobar_sesion();

$codigo = $_POST['codigo'];
$unidades = $_POST['unidades'];

print_r($_POST);

$total = $_SESSION['carrito'][$codigo]['unidades'] - $unidades;

if ($total <= 0){
    unset($_SESSION['carrito'][$codigo]);
}
else{
    $_SESSION['carrito'][$codigo]['unidades'] -= $unidades;
}

header('location: carrito.php');

