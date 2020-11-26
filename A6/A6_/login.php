<?php
    session_start();
    require "llibreria.php";
    //Connecio a la base de dades

    $conn = mysqli_connect('localhost', 'gtinoco', 'gtinoco', 'gtinoco_productos_php');

    if (!$conn) {
        die("Connection failed: " . $mysqli_connect_error);
    }
    

    //Entra quant fa connexio post
    if ($_SERVER['REQUEST_METHOD']=='POST'){

        $_SESSION["user"] = $_POST["mail"];
        $_SESSION["pass"] = $_POST["passwd"];

        setcookie("usercookie", sha1(md5($_SESSION["user"])), time() + 365 * 24 * 60 * 60);
        setcookie("passcookie", sha1(md5($_SESSION["pass"])), time() + 365 * 24 * 60 * 60);

        //usuari y contrasenya del phpmyadmin

        $mail = $_POST["mail"];
        $pass = $_POST["passwd"];

        $sql = "SELECT id FROM usuaris WHERE email ='$mail'";
        $result = $conn->query($sql);
        $usuari = $result->fetch_assoc();

        $_SESSION["id_user"] = $usuari["id"];

        //comprovacio de format del email

        $comprovacioEmail = validacioEmail($_SESSION["user"]);

        $sql = "SELECT * FROM usuaris WHERE email = '$mail' AND passwd = '$pass'";
	    $result = $conn->query($sql);
        if (isset($_REQUEST["login"])){
            if ($comprovacioEmail == TRUE){

                //Comproba la contrasenya i usuari del phpmyadmin amb els escrits

                if ($result->num_rows > 0){
                    $user = $result->fetch_assoc();
                    $conn->close();

                    //Depenent si ets admin o usuari entra a una pagina o una altre

                    if ($user["id_rol"]==2){
                        header("Location: privada_admin.php");
                    }else if($user["id_rol"]==1){
                        header("Location: privada_usuari.php");
                    }
                }else{
                    echo "Usuari o Contrasenya incorrecta";
                }
            }else {
                echo "Contrasenya o mail sense format indicat";
            }
        }
        //Pagina per registrar un nou usuari

        if (isset($_REQUEST["registrar"])){
            header("Location: registro.php");
        }
        //Printa els productes a la pagina principal

        $sql = "SELECT id, nom, descripcio, preu FROM productes";
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

        //Per buscar un producte de tots els productes de la base de dades

        if (isset($_REQUEST["buscar"])){
            $buscadorNombre = $_POST["buscador"];
            $sql= "SELECT id, nom, descripcio, preu, id_usuario FROM productes WHERE nom = '$buscadorNombre'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){

                // Muestra la tabla de Productos con el buscador

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
                echo "No hay productos con este nombre";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form enctype="multipart/form-data" action="login.php" method="post">

            <h2>Login</h2>

            <p>Email: <input type="text" name="mail"></p>

            <p>Contrasenya: <input type="password" name="passwd"></p>

            <p>Aceptar cookies? <input type="checkbox" name="Aceptar"></p>

            <button name="login" type="submit">Login</button>

            <button name="registrar" type="submit">Registrarse</button>

            <button name="productes" type="submit">Veure els Productes</button></br></br>
            

            <form enctype="multipart/form-data" action="login.php" method="post">

                <p>Buscador: <input type="text" name="buscador" id="buscador" placeholder="buscar">

                <input type="submit" value="buscar" name="buscar"></p>

            </form>

        </form>
    </body>
</html>