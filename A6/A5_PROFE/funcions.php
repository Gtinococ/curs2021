<?php


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function connectDB($server,$user,$pass,$db){
    $conn = new mysqli($server,$user,$pass,$db);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function isAdmin($email){


  $admin=false;
  $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
  $sql = "select * from usuaris where email='$email'  and rols_id=1 ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    $admin=true;

  }
  
  return $admin;

}

function getUserData($email){

  $usuari;
  $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
  $sql = "select * from usuaris where email='$email'  ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    
    
    $usuari = $resultado->fetch_assoc();
   

  }
  
  return $usuari;

}


 
function generate_string( $strength = 16) {
     $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}




function userExists($email){

  $exists=false;
  $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
  $sql = "select * from usuaris where email='$email'  ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    
    
    $exists=true;
   

  }
  
  return $exists;

}

function deleteUser($id){



  $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
  $sql = "delete from usuaris where id=$id ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;



}

function updatePasswordUser($email,$password){



  $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
  $sql = "update usuaris set password=md5('$password') where email='$email' ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;



}

function updateUser($nom,$email,$password,$id){



  $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
  $sql = "update usuaris set nom='$nom',email='$email',password=md5('$password') where id=$id ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;



}

function addUser($nom,$email,$password){



  $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
  $sql = "insert into usuaris (email,password,nom) values ('$email',md5('$password'),'$nom')  ";
  if (!$conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  return true;



}
/**
 * return true si email existeix
 * return false si email no existeix
 */
function checkIfEmailExists($email){


  $resultat=false;
  $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
  $sql = "select * from usuaris where email='$email'  ";
  if (!$resultado = $conn->query($sql)) {
    die("error ejecutando la consulta:".$conn->error);
  }
  if ($resultado->num_rows == 1) {
    $resultat=true;
  }
  
  return $resultat;


}
/**
 * 
 * return true usuari i pasword correcte
 * return false cas contrari
 */
function validaUsuari($email,$password){

    $resultat=false;
    $conn = connectDB('localhost', 'javi', 'javi', 'javi_a5');
    $sql = "select * from usuaris where email='$email' and password='$password' ";
    if (!$resultado = $conn->query($sql)) {
      die("error ejecutando la consulta:".$conn->error);
    }
    if ($resultado->num_rows == 1) {
      $resultat=true;
    }
    
    return $resultat;

}

?>