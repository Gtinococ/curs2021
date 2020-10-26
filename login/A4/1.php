<?php
session_start();


echo "que te pasa loco ".$_SESSION["username"];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>gerard</title>
    </head>
    <body>
        <div style="margin: 30px 10%;">
        Cerrar Sesion 
            <form enctype="multipart/form-data" action="logout.php" method="post" id="myform" name="myform">

                <button id="mysubmit" type="submit">Logout</button><br /><br />

            </form>
        </div>
    </body>
</html>