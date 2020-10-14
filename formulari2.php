<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Processar les dades
    
        echo  "Benvingut"." ".$_REQUEST["nombre"]."<br>";
        echo "Datos personales: "."<br>";

        if(isset($_REQUEST["sexe"])){
            echo "Sexo: ";
            print_r($_REQUEST["sexe"]);

        }
        echo "<br>"."Tipo de licencia: ";

        if(isset($_REQUEST["licencia"])){
            print_r($_REQUEST["licencia"]);

        }

        if(isset($_REQUEST["macarrones"])){
            echo "<br>"."Le gustan los macarrones ";
            print_r($_REQUEST["macarrones"]);

        }
        $dir_subido = "imatges/";
        $fichero_subido = $dir_subido . basename($_FILES['archivo']['name']);
        
        if (move_uploaded_file($_FILES['archivo']['tmp_name'],$fichero_subido)) {

            print_r("<img src=\"".$fichero_subido."\">");
        }
        else {
           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        }
    }
?>