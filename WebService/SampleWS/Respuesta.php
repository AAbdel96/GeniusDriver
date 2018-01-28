<?php


function response($code = 200, $error = "", $Exito = false , $message = "",$dato) {
        http_response_code($code);
        if (!empty($Exito) && !empty($message)) {
            $response = array("error" => $error , "message" => $message, "Exito" => $Exito, "dato" =>$dato);
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }
    
    
    
    
    ?>

