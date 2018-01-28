<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';

$json = file_get_contents('php://input');

$obj = json_decode($json);
$matricula = $obj->{'matricula'};
$correo = $obj->{'correo'};


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $persona = new PeopleDB();
    $people2 = $persona->update_matricula($matricula,$correo);
    
    $dato = array('email' => "", 'contrasena' => "", 'name' => "");
    
    if($people2 == '1'){
        
        response($codse = 200, $error = "",  $Exito = true, $message = "Matricula guardada", $dato);
    }
} 

?>
