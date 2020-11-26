<?php
include("funcions.php");

session_start();
$error=FALSE;
$errormsg="";




if(isset($_REQUEST["okp"])){

    setcookie('politica', 1, time() + 365*24*60*60); 
    header("location:publica.php");

}

if(isset($_COOKIE["email"])){

    if(validaUsuari($_COOKIE["email"],$_COOKIE["password"])){

        $_SESSION["login"]=$_COOKIE["email"];
        header('location:privada.php');

    }else{

        setcookie('email', null, 0,'/'); 
        setcookie('password', null, 0,'/'); 

    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pass=test_input($_REQUEST["password"]);
    $email = test_input($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error=TRUE;
        $errormsg.= "Invalid email format";
    }

    $password = test_input($_POST["password"]);

    if (!preg_match("/^[a-zA-Z0-9' ]*$/",$password)) {
        $error=TRUE;
        $errormsg.=  "Only letters and numbers allowed";
    }

    if(!$error){

        if(validaUsuari($_REQUEST["email"],$_REQUEST["password"])){

            echo "Ok de autenticación";
            $_SESSION["login"]=$_REQUEST["email"];

            if(isset($_REQUEST["recorda"])){
                setcookie('email', $_REQUEST["email"], time() + 365*24*60*60,'/'); 
                setcookie('password', $_REQUEST["password"], time() + 365*24*60*60,'/'); 
            }

            header('location:privada.php');

        }else{
            echo "Error de autenticación";
            setcookie('contador', null, 0); 

        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function check(){

            if(!document.forms[0].email.value.length>0){
                alert("has d'intruduir un email");
            }else{

                location.href="recoverypassword.php?email="+document.forms[0].email.value;
            }
        } 
    </script>
</head>
<body>


<?php

if(!isset($_COOKIE["politica"])){


?>

política....<br>
<a href="?okp">Accepto</a><br>
<a href="http://www.google.com">No Accepto</a>


<?php

}else{


    
?>


    <h1><?=$errormsg?></h1>
    <form method="post">
        email:<input type="text" name="email" id=""><br>
        password: <input type="password" name="password" id="">
        autologin<input type="checkbox" name="recorda" id="">
        <input type="submit" value="envia">
    
    </form>
    <br>
    <a href="#" onclick="check();"> Regenerar password</a>
    <a href="register.php">Crear nou usuari</a>
    <?

}




?>
    <div id="productos">
        <?php
            //MORTRAR PRODUCTOS
            $conn = connectDB('localhost', 'gtinoco', 'gtinoco', 'gtinoco_productos_php');
            $sql = "select * from productes";

            if (!$resultado=$conn->query($sql)) {
            die("error ejecutando la consulta:".$conn->error);
            }else{
            while($lista_productes = $resultado->fetch_assoc()){
                echo "<br>";
                echo "</br>";
                echo $lista_productes['nom'];
                echo " / ";
                echo $lista_productes['descripcio'];
                echo " / ";
                echo $lista_productes['preu'];
                echo "<br>";
                echo "</br>";
            }
            }
        ?>
    </div>
</body>
</html>

<?php

?>