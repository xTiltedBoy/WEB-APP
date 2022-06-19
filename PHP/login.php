<?php
include ('functions.php');
if($_SERVER['REQUEST_METHOD'] === "POST"){   
    $correo = $_POST['correo'];
    $clave = md5($_POST['clave']);
    $resultado = comprobar_usuario($correo, $clave);
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
            
        <?php 
        
        if($_SERVER['REQUEST_METHOD'] === "POST"){  

            if ($resultado === "PARAMETROS"){
                echo "<label class='aviso'>Introduce el Usuario y la Clave</label>";
            }    
            elseif ($resultado === "USUARIO"){
                echo "<label class='aviso'>Usuario o Clave no validos</label>";
            }
        }
        
        ?>
        
        <h3>Usuario:</h3>
        
        <input type="text" id="correo" name="correo"><br>
        
        <h3>Contraseña:</h3>
        
        <input type="password" id="clave" name="clave"><br><br>
        
        <input type="submit" name="enviar" value="Enviar">
        
        </form>
    </body>
</html>
