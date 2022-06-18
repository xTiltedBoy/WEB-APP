<?php
include ('functions.php');
if($_SERVER['REQUEST_METHOD'] === "POST"){   
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $clave = md5($clave);
    comprobar_usuario($correo, $clave);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link type="text/css" rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Login</h1>
        <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
        
        <h3>Usuario:</h3>
        
        <input type="text" id="correo" name="correo"><br>
        
        <h3>Contraseña:</h3>
        
        <input type="password" id="clave" name="clave"><br><br>
        
        <input type="submit" name="enviar" value="Enviar">
        
        </form>
    </body>
</html>
