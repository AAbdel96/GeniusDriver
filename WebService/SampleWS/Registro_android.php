<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';

$json = file_get_contents('php://input');

$obj = json_decode($json);
$nombre = $obj->{'nombre'};
$email = $obj->{'email'};
$contrasena = $obj->{'contrasena'};



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dato = array('nombre' => $nombre, 'email' => $email, 'contrasena' => md5($contrasena));
    
    $persona = new PeopleDB();

    $ret = $persona->insert_android($nombre, $email, md5($contrasena));

    if (!$ret == '1') {

        response($code = 200, $error = "", $Exito = false, $message = "ERROR,CORREO ELECTRONICO EN USO!", $dato);   
    } else {
        response($code = 200, $error = "", $Exito = true, $message = "Registrado correctamente", $dato);
    }
} else {
    response($code = 200, $error = "", $Exito = false, $message = "ERROR,CORREO ELECTRONICO EN USO!", $dato);
}

?>

