<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';

$json = file_get_contents('php://input');

$obj = json_decode($json);
$nombre = $obj->{'name'};
$email = $obj->{'email'};


/* @var $_SERVER type */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $persona_aux = new PeopleDB();

    $ret = $persona_aux->update_name($email, $nombre);

    $dato = array('email' => $email, 'contrasena' => md5(''), 'name' => $nombre);
    if ($ret == '1') {
        response($code = 200, $error = "", $Exito = true, $message = "Usuario enviado correctamente!", $dato);
    } else {
        response($code = 200, $error = "", $Exito = false, $message = "No se ha podido cambiar el nombre", $dato);
    }
}
?>


