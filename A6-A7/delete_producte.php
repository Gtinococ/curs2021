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

    <a href="edituser.php?emailc=<?=$_SESSION['login']?>">Edita les teves dades</a>

    <?php

        $bd_user = getUserData($_SESSION["login"]);
        $bd_user_id = $bd_user["id"];
        echo $bd_user_id;
        

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producte_id = test_input($_REQUEST["id"]);
          
          if(isAdmin($_SESSION["login"])){

              $conn = connectDB('localhost', 'acustodio', 'acustodio', 'acustodio_a6');
              $sql = "select * from usuarios  ";
              $resultado = $conn->query($sql);
              if (!$resultado) {
                die("error ejecutando la consulta:".$conn->error);
              }
              
                
                
                while($usuari=$resultado->fetch_assoc()){
                  echo $usuari["nom"].",".$usuari["email"]."<a href=\"edituser.php?emailc=".$usuari["email"]."\">[E]</a><a onclick=\"return confirm('Are you sure?')\" href=\"delete.php?id=".$usuari["id"]."\">[D]</a><br/>";


                }
          }
          //DELETE DE PRODUCTOS
          $conn = connectDB('localhost', 'acustodio', 'acustodio', 'acustodio_a6');
          $sql = "delete from productes where id=$producte_id ";
          if (!$conn->query($sql)) {
            die("error ejecutando la consulta:".$conn->error);
        }
        }

    ?>
        <div id="plantilla">
            <form action="delete_producte.php" method="post">
            id del producte: <input type="text" name="id"></input>
            <button type="submit" name="boton">Borrar</button>
            </form>
        </div>

      <div id="productos">
                <?php
                  //PRINTEAR PRODUCTOS
                  $conn = connectDB('localhost', 'acustodio', 'acustodio', 'acustodio_a6');
                  $sql = "select * from productes where usuario_id='$bd_user_id'";
                  
                  if (!$resultado=$conn->query($sql)) {
                    die("error ejecutando la consulta:".$conn->error);
                  }else{
                    while($lista_productes = $resultado->fetch_assoc()){

                      echo $lista_productes['id'];
                      echo "-";
                      echo $lista_productes['nom'];
                      echo "-";
                      echo $lista_productes['descripcio'];
                      echo "-";
                      echo $lista_productes['preu'];
                      echo "<br>";
                      echo "</br>";
                    }
                  }
                ?>
      </div>
  </body>
</html>