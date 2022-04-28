<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: pedidos.php -->
<?php
    //Guardamos los valores si se han introducido

    if (isset($_POST['pedido'])){
    
        $pedido = $_POST['pedido'];
    
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
    
    $query ='select codped from pedidos';
    $resultado = $conexion->query($query);
   
?>

<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Miguel Parte 1</title>
</head>

<body class="pagcesta">

<div id="contenedor">
  <div id="encabezado">
    
  </div>
    <div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">  
        <select id="familia" name="pedido">          
          <?php
            
            //Mostramos el desplegable de las familias
          
            $fila = $resultado->fetch_array();
          
            while ($fila != null){
              
                if ($pedido == $fila['codped']){
                    
                    echo '<option value="'.$fila['codped'].'" selected>Pedido: '.$fila['codped'].'</option>';
                    
                }
                else{
                    
                    echo '<option value="'.$fila['codped'].'">Pedido: '.$fila['codped'].'</option>';
                    
                }
  
                $fila = $resultado->fetch_array();
            }
            
            ?>         
      </select>      
      <input type="submit" name="enviar "value="Enviar">
 
        <?php if (isset($_POST['pedido'])){ ?>

          <table border="1">
          <tr>
            
                <th>Nombre Corto</th>
                
                <th>Unidades</th>
            
            </tr>
                  
        <?php
            
            $query = 'select producto.nombre_corto, pedidosproductos.unidades from producto inner join pedidosproductos on pedidosproductos.codprod=producto.cod where pedidosproductos.codped='.$pedido.'';
            
            $resultado = $conexion->query($query);  

            $fila = $resultado->fetch_array();
                
            for ($i = 1; $fila != null; $i++){
            
                echo "<tr>";
                echo '<td>'.$fila["nombre_corto"].'</td>';
                echo '<td>'.$fila["unidades"].'</td>';
                echo "</tr>";
            
                $fila = $resultado->fetch_array();
            
            }         
        }  
      
        ?>
      </table>
      </form>
    <hr />
  </div>
  <br class="divisor" />
  <div id="pie">
      
      
      
  </div>
</div>
</body>
</html>

