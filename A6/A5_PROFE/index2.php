<?php

$conn = new mysqli('localhost', 'javi', 'javi', 'javi_a5');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$email="javipj@gmail.com";
$pass="123456";


$sql = "SELECT * FROM usuaris where email='$email' and password=md5('$pass') ";


   
   
if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
}
echo $resultado->num_rows."<br>";
if ($resultado->num_rows >= 0) {

    while ($usuari = $resultado->fetch_assoc()) {
       echo $usuari["id"].",".$usuari["nom"].",".$usuari["email"].",".$usuari["password"]."<br>";
        
    }



}


$resultado->free();
$conn->close();



?>


hola