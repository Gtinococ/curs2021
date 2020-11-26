<?php
    $user = "";
    $pass = "";  
    $error = False;
    session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $error = False;
    $user = $_POST["name"];
    $pass = $_POST["pass"];

    if ($user == "admin"){
        header("location: ./consultaAdmin.php");
    }

    else if ($error == False){
        try{
            $conn = new mysqli('localhost','gtinoco','gtinoco','gtinoco_php');

            if ($conn->connect_error){
                die("error de conexion: ".$conn->connect_error);
            }

            $sql = "SELECT * FROM usuario where nom='$user' and contrasena='$pass' ";

            if (!$resutado = $conn -> query($sql)){
                die("error ejecutando la consulta: ".$conn->error);
            }

            if (true){
                header("location: ./consulta.php");
            }

            $_SESSION["user"] = $_REQUEST["name"];
            $_SESSION["pass"] = $_REQUEST["pass"];

        }catch(mysqli_sql_exception $e) {
         $e->errorMessage();
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>gerard</title>
    </head>
    <body>
        <div style="margin: 30px 10%;">
        <h3>Inicia Sesion</h3>
            <form enctype="multipart/form-data" action="login.php" method="post" id="myform" name="myform">

                <label>Nombre</label> <input type="text" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["name"];?>" size="30" maxlength="100" name="name" id="" /><br /><br />
                
                <label>Contraseña</label> <input type="password" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["pass"];?>" size="30" maxlength="100" name="pass" id="" /><br /><br />
                
                <input type="checkbox" name="licencia" value="" require /> Aceptas que se guarden las cookies ?<br /><br />

                <button id="mysubmit" type="submit">envia</button><br /><br />

            </form>
        </div>
    </body>
</html>