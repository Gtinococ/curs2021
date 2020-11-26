<?php
session_start();
echo ("hola: ".$_SESSION["user"]);

$name = $_SESSION["user"];
$pass = $_SESSION["pass"];



if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $newname = $_POST["name"];

    $conn = new mysqli("localhost","gtinoco","gtinoco","gtinoco_php");

    $sql = "DELETE FROM usuario WHERE nom='$newname'";
    $result = $conn -> prepare($sql);
    $result->execute();
    $conn->close();

    header("");

    if ($conn->connect_error){
        die("error de conexion: ".$conn->connect_error);
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
            <form enctype="multipart/form-data" action="consultaAdmin.php" method="post" id="myform" name="myform">

                <label>Borrar Usuario</label> <input type="text" value="" size="30" maxlength="100" name="name" id="" /><br /><br />

                <button id="mysubmit" type="submit">envia</button><br /><br />

            </form>
        </div>
    </body>
</html>