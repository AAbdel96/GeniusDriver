<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';



$json = file_get_contents('php://input');

$obj = json_decode($json);
$email = $obj->{'email'};

$email_nuevo = $obj->{'email_nuevo'};





if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $persona_aux = new PeopleDB();

    $ret = $persona_aux->update_email($email, $email_nuevo);

    $dato = array('email' => $email_nuevo, 'contrasena' => md5(''), 'name' => '');
    if ($ret == '1') {

        response($code = 200, $error = "", $Exito = true, $message = "Usuario enviado correctamente!", $dato);
    } else {
        response($code = 200, $error = "", $Exito = false, $message = "No se ha podido cambiar el correo", $dato);
    }
} 

?>



