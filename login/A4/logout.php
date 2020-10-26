<?php
session_destroy();
setcookie('Ncookie', null, null); 
setcookie('Pcookie', null, null); 

header("Location: ./login.php")
?>