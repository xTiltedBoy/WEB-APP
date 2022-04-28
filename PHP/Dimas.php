<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: pedidos.php -->
<?php
    //Guardamos los valores si se han introducido

    if (isset($_POST['familia'])){
    
        $cod = $_POST['codigo'];
        $nom_corto = $_POST['nombre_corto'];
        $precio = $_POST['precio'];
        $familia = $_POST['familia'];
    
    }   

    //Abrimos conexión a la base de datos

    $hostname = 'localhost';
    $user_db = 'root';
    $password = '';
    $name_db = 'dwes';

    $conexion = new mysqli($hostname,$user_db,$password,$name_db);
    
    $error = $conexion -> errno;
    
    if ($error != null){
        
        echo "Error $error $conexion->error";
        
        exit();
        
    }
    
    $query='select cod, familia from producto';
    
    $resultado = $conexion->query($query);
    
?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Dimas</title>
</head>

<body class="pagcesta">

<div id="contenedor">
  <div id="encabezado">
    
  </div>
    <div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">  
        <label>Código:</label><input type="text" name="codigo"><br>
        <label>Nombre Corto:</label><input type="text" name="nombre_corto"><br>
        <label>Precio:</label><input type="text" name="precio"><br>
        <label>Familia:</label>
        <select id="familia" name="familia">          
          <?php
            
            //Mostramos el desplegable de las familias
          
            $fila = $resultado->fetch_array();
          
            while ($fila != null){
                
                echo '<option value="'.$fila['familia'].'">'.$fila['familia'].'</option>';
                
                $fila = $resultado->fetch_array();
            }
            
            ?>         
      </select>      
      <input type="submit" name="enviar "value="Enviar">
    </form>
      
    <hr />
  </div>
  <br class="divisor" />
  <div id="pie">
         
      <?php
        
            //Insertamos los datos recogidos en la tabla producto
            
            if (isset($_POST['familia'])){
    
                $insert = 'insert into producto (cod, nombre_corto, PVP, familia) values ("'.$cod.'", "'.$nom_corto.'", "'.$precio.'", "'.$familia.'")';
            
                $conexion->query($insert);   

            }         
      
        ?>
      
  </div>
</div>
</body>
</html>