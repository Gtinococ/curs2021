<?php

include("contrologin.php");
include("funcions.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hola,


    <a href="edituser.php?emailc=<?=$_SESSION["login"]?>">Edita les teves dades</a>
<br>

    <?php
        if(isAdmin($_SESSION["login"])){

            $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
            $sql = "select * from usuaris  ";
            if (!$resultado = $conn->query($sql)) {
              die("error ejecutando la consulta:".$conn->error);
            }
            
              
              
              while($usuari=$resultado->fetch_assoc()){
                echo $usuari["nom"].",".$usuari["email"]."<a href=\"edituser.php?emailc=".$usuari["email"]."\">[E]</a><a onclick=\"return confirm('Are you sure?')\" href=\"delete.php?id=".$usuari["id"]."\">[D]</a><br>";


              }
             
          
          




        }

    ?>
</body>
</html>