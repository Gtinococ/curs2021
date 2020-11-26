<?php

$opcion1 = "";
$opcion2 = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $opcion1 = $_POST["I"];
    $opcion2 = $_POST["R"];

    if ($opcion1 == TRUE){

        header("Location: ./login.php");
    }

    else if ($opcion2 == TRUE){

        header("Location: ./registro.php");
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
        QUE QUIERES HACER ?
            <form enctype="multipart/form-data" action="principal.php" method="post" id="myform" name="myform">

                <br /><br /><input type="checkbox" name="I" value="FALSE" /> Iniciar Sesion<br /><br />
                <input type="checkbox" name="R" value="FALSE" /> Registrar<br /><br />
                <button id="mysubmint" type="submit">Entrar</button><br /><br />

            </form>
        </div>
    </body>
</html>