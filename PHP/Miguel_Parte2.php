<!DOCTYPE html>
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 5 : Programación orientada a objetos en PHP -->
<!-- Ejemplo Tienda Web: pedidos.php -->
<?php
    //Guardamos el pedido seleccionado

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
    
    //Ejecutamos el update si se ha pulsado el boton editar
    if (isset($_POST['editar']) && isset($_POST['unidades'])){
        
        $pedido = $_POST['pedido'];
        
        $unidades = $_POST['unidades'];
        $num_pedido = $_POST['pedido'];
        $codprod = $_POST['codprod'];
        
        $max = count($unidades) - 1;
        
        for ($i=0;$i<=$max;$i++){
            
            $update='update pedidosproductos set unidades='.$unidades[$i].' where codped='.$num_pedido.' and codprod="'.$codprod[$i].'"';
            
            $resultado = $conexion->query($update);
            
        }
        
        
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
        <select id="pedido" name="pedido">          
          <?php
            //Mostramos el desplegable de los pedidos
            
            $fila = $resultado->fetch_array();
          
            while ($fila != null){
              
                if ($pedido == $fila['codped']){
                    
                    echo '<option value="'.$fila['codped'].'" selected>Pedido: '.$fila['codped'].'</option>';
                    
                    $_POST['num_pedido'] = $fila['codped'];
                    
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
        
        //Mostramos la tabla
            $query = 'select producto.cod, producto.nombre_corto, pedidosproductos.unidades from producto inner join pedidosproductos on pedidosproductos.codprod=producto.cod where pedidosproductos.codped='.$pedido.'';
            
            $resultado = $conexion->query($query);  

            $fila = $resultado->fetch_array();
                
            for ($i = 1; $fila != null; $i++){
            
                echo "<tr>";
                echo '<td>'.$fila["nombre_corto"].'</td>';
                echo '<td><input type="text" name="unidades[]" value="'.$fila["unidades"].'"></td>';
                echo "</tr>";
                echo '<input type="hidden" name="codprod[]" value="'.$fila["cod"].'" >'; 
                $fila = $resultado->fetch_array();
            
            }         
        }  

        ?>
      </table>
            <input type="submit" name="editar" value="Editar">
        </form>
    <hr />
  </div>
  <br class="divisor" />
  <div id="pie">

  </div>
</div>
</body>
</html>