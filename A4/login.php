<?php
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        include "libreria.php";
        
        $_SESSION["username"]=$_POST["name"];
        $_SESSION["password"]=$_POST["pass"];

        setcookie("Ncookie", sha1(md5($_POST["name"])), time() + 365 * 24 * 60 * 60); 
        setcookie("Pcookie", sha1(md5($_POST["pass"])), time() + 365 * 24 * 60 * 60); 

        $Valcorreo = correo($_SESSION["username"]);
        $Valpass = password($_SESSION["password"]);
        
        if ($Valcorreo = TRUE && $Valpass = TRUE){

            if ($_POST["name"] == "gerardtinoco@gmail.com" && $_POST["pass"] == "GerardT2001**" && $_POST["licencia"] == TRUE){
                
                header("Location: ./1.php");

            }else{
                echo("Datos incorrectos");
            }

        }else{
            echo("El formato escogido no es el correcto");
        }

    }

    if($_COOKIE["Ncookie"] == sha1(md5("gerardtinoco@gmail.com")) && $_COOKIE["Pcookie"] == sha1(md5("GerardT2001**"))){
        
        header("Location: ./1.php");
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
        <h3>Iniciar Sesion </h3>
            <form enctype="multipart/form-data" action="login.php" method="post" id="myform" name="myform">

                <label>Correo</label> <input type="text" value="" size="30" maxlength="100" name="name" id="" /><br /><br />
                <label>Contraseña</label> <input type="password" value="" size="30" maxlength="100" name="pass" id="" /><br /><br />
                <input type="checkbox" name="licencia" value="" require /> Aceptas que se guarden las cookies ?<br /><br />

                <button id="mysubmit" type="submit">envia</button><br /><br />

            </form>
        </div>
    </body>
</html>