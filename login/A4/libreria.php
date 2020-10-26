<?php

function correo($email){

    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
        return FALSE;
    }else{
        return TRUE;
    }
}

function password($contraseña){
    if (preg_match("/^[a-zA-Z0-9]+$/", $contraseña)){
        return FALSE;
    }else{
        return TRUE;
    }
}

?>