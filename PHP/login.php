<?php

if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    // Llamar función comprobar_usuario()
    
    $aviso = true;
    
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
        <?php
        // ERRORES
        
        if($aviso === true){
            
            echo "<label class='aviso'>POST</label>";
            
        }
        ?>
        
        <form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post">
        
        <h3>Usuario:</h3>
        
        <input type="text" id="usuario" name="usuario"><br>
        
        <h3>Contraseña:</h3>
        
        <input type="password" id="contraseña" name="contraseña"><br><br>
        
        <input type="submit" name="enviar" value="Enviar">
        
        </form>
    </body>
</html>
