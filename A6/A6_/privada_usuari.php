<?php
    session_start();
    require "llibreria.php";

    $user = $_SESSION["id_user"];

    if($_SERVER["REQUEST_METHOD"]=='POST'){

        $conn = mysqli_connect('localhost','gtinoco','gtinoco','gtinoco_productos_php');
        if (!$conn) {
            die("Connection failed: " . $mysqli_connect_error);
        }

        //Afegir Producte

        if (isset($_REQUEST["afegirProducte"])){         
            $idP = $_POST['id'];
            $nomP = $_POST['nom'];
            $descr = $_POST['descripcio'];
            $preuP = $_POST['preu'];
            $sql = "INSERT INTO productes (id, nom, descripcio, preu, id_usuario) VALUES ($idP,'$nomP', '$descr', '$preuP', '$user')";
            $result = $conn->query($sql);
            if (!$result) {
                die("error ejecutando la consulta:".$conn->error);
              }

            $conn->close();
        }
        
        //ModificarProducte

        if (isset($_REQUEST["modificarProducte"])){

            $idP = $_POST['id'];
            $nomP = $_POST['nom'];
            $descr = $_POST['descripcio'];
            $preuP = $_POST['preu'];
            $sql = "UPDATE productes SET nom = '$nomP', descripcio = '$descr', preu = '$preuP' WHERE id= '$idP'";
            $result = $conn->query($sql);
            $conn->close();
        }

        //Eliminar Producte

        if (isset($_REQUEST["eliminarProducto"])){

            $idP = $_POST['id'];
            $sql = "DELETE FROM productes WHERE id = $idP";
            $result = $conn->query($sql);
            if (!$result) {
                die("error ejecutando la consulta:".$conn->error);
            }
            $conn->close();
        }
    }

    if (isset($_SESSION["user"])){

        //Entrar a la base de dades

        $conn = mysqli_connect('localhost', 'gtinoco', 'gtinoco', 'gtinoco_productos_php');
        if (!$conn) {
            die("Connection failed: " . $mysqli_connect_error);
        }

        // Mostra la taula de Productes

        $sql = "SELECT id, nom, descripcio, preu FROM productes WHERE id_usuario = '$user' ";
        $result = $conn->query($sql);
        if (!$result) {
            die("error ejecutando la consulta:".$conn->error);
        }

        echo "<table border=2><tr><th colspan ='4'><p><b>Els teus productes</b></p></th></tr>";
        echo "<tr><td><b>Id</b></td><td><b>Nom</b</td><td><b>Descripcio</b></td><td><b>Preu</b></td>";
        while($row = $result->fetch_assoc()) {

            echo "<tr><td>".$row["id"]."</td><td>".$row["nom"]."</td><td>".$row["descripcio"]."</td><td>".$row["preu"]."</td></tr>";
        }
        echo "</table></br>";
        $conn->close();
    }else {
        header("Location: ./login.php");    
    }

    //Logout

    if (isset($_REQUEST["logout"])){
        $_SESSION=null;
        setcookie('usercookie', null,0,'/');
        setcookie('passcookie', null,0,'/');
        session_destroy();
        header("Location: login.php");
    }
?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            
            <form action="privada_usuari.php" method="post">

                <input type="submit" name="logout" value="Log Out">
                <h3>Afegir producte</h3>
                <label>ID: </label> <input type="text" size="30" maxlength="100" name="id"/><br /><br />
                <label>Nombre: </label> <input type="text" size="30" maxlength="100" name="nom"/><br /><br />
                <label>Descripcio: </label> <input type="text" size="30" maxlength="100" name="descripcio"/><br /><br />
                <label>Preu: </label><input type="text" name="preu">
                <input type="submit" name="afegirProducte" value="Añadir Producto">

            </form>

            <form action="privada_usuari.php" method="post">

                <h3>Modificar Producte</h3>
                <p>Id del Producte a modificar: <input type="text" name="id"></p>
                <p>Nom: <input type="text" name="nom"></p>
                <p>Descripcio: <input type="text" name="descripcio"></p>
                <p>Preu: <input type="text" name="preu"></p>
                <input type="submit" name="modificarProducte" value="Modificar Producto">

            </form>

            <form action="privada_usuari.php" method="post">
            
                <h3>Eliminar Producte</h3>
                <p>Id: <input type="text" name="id"></p>
                <input type="submit" name="eliminarProducto" value="Eliminar Producto">

            </form>
        </body>
    </html>