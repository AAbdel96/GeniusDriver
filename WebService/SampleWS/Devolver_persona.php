<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';



$json = file_get_contents('php://input');

$obj = json_decode($json);
$email = $obj->{'email'};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
    $persona = new PeopleDB();
    $people2 = $persona->getPeople_by_email($email);
    
    
    //cogeremos el nombre que esta en la primera posicion del array people2  
    $nombre = $people2[0]["name"];
    $contrasena = $people2[0]["contrasena"];
    $email_2 = $people2[0]["email"];
    $dato = array('email' => $email_2, 'contrasena' => md5($contrasena), 'name' => $nombre);
    
    response($code = 200, $error = "",  $Exito = true, $message = "Usuario enviado correctamente!", $dato);

} 

?>
