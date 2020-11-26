<?php
    
    session_start();
    require "llibreria.php";

    $newuser = "";
    $newmail = "";
    $newpass = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){


    $newuser = $_POST["name"];
    $newmail = $_POST["correo"];
    $newpass = $_POST["pass"];
    $rol = 2;

    $_SESSION["mail"] = $_POST["correo"];
    $_SESSION["name"] = $_POST["name"];
    
    $comprovacioEmail = validacioEmail($_SESSION["mail"]);

    if ($comprovacioEmail == TRUE){
        try{
            $conn = new mysqli('localhost','gtinoco','gtinoco','gtinoco_productos_php');
            if ($conn->connect_error){
                die("error de conexion: ".$conn->connect_error);

            }
            $sql = "INSERT INTO usuaris (nom,email,passwd,id_rol) VALUES ('$newuser', '$newmail', '$newpass','$rol')";
            $result = $conn->query($sql);
            header("location: ./login.php");

        }catch(mysqli_sql_exception $a){
            $a->errorMessage();
        }
    }else{
        echo "esta mal escrito";
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
        <h3>Registrate </h3>
            <form enctype="multipart/form-data" action="registro.php" method="post" id="myform" name="myform">

                <label>Nombre</label> <input type="text" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["name"];?>" size="30" maxlength="100" name="name" id="" /><br /><br />
                
                <label>Correo</label> <input type="text" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["correo"];?>" size="30" maxlength="100" name="correo" id="" /><br /><br />
                
                <label>Contraseña</label> <input type="password" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["pass"];?>" size="30" maxlength="100" name="pass" id="" /><br /><br />
                
                <input type="checkbox" name="licencia" value="" require /> Aceptas que se guarden las cookies ?<br /><br />

                <button id="mysubmit" type="submit">envia</button><br /><br />

            </form>
        </div>
    </body>
</html>