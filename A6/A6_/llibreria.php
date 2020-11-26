<?php
    // Validacio del Email
    function validacioEmail($comprovacioEmail){
        if(!filter_var($comprovacioEmail, FILTER_VALIDATE_EMAIL)){
            return FALSE;
        }else {
            return TRUE;
        }
    }
?>