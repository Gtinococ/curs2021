<?php
session_start();
include("funcions.php");
echo $_SESSION['preciototal'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="productos">
      <?php
        //MOSTRAR PRODUCTOS
        $conn = connectDB('localhost', 'gtinoco', 'gtinoco', 'gtinoco_productos_php');
        $sql = "select * from productes";        
        if (!$resultado=$conn->query($sql)) {
          die("error ejecutando la consulta:".$conn->error);
        }else{
          while($lista_productes = $resultado->fetch_assoc()){
            
            echo "<br>";
            echo "</br>";
            echo $lista_productes['id'];
            echo " / ";
            echo $lista_productes['nom'];
            echo " / ";
            echo $lista_productes['descripcio'];
            echo " / ";
            echo $lista_productes['preu'];
            echo "<a href='carrito_compra.php?idproducte=".$lista_productes["id"]."&preuproducte=".$lista_productes["preu"]."'>[Comprar]</a><br><br><hr>";
            echo "<br>";
            echo "</br>";
          }
        }
      ?>
    </div>
    <form action="carrito.php">
    <button>carrito</burron>
    </form>
</body>
</html>