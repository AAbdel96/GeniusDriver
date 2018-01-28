<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';


$json = file_get_contents('php://input');

$obj = json_decode($json);
$email = $obj->{'email'};
$contrasena = $obj->{'contrasena'};

file_put_contents('filename1.php', $email);
file_put_contents('filename2.php', $contrasena);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dato = array('email' => $email, 'contrasena' => md5($contrasena));

    $persona = new PeopleDB();

    $people = $persona->login_web($email, md5($contrasena));


    file_put_contents("prueba_login.txt", print_r($people, true), FILE_APPEND);

    if (empty($people)) {

        response(200, 'Error Login', $Exito = false, 'USUARIO O CONTRASEÑA INCORRECTO', $dato);
    } else {
        response($code = 200, $error = "", $Exito = true, $message = "Loggeado correctamente!", $dato);
    }
} else {
    file_put_contents('prueba_login.php', "No ha llegado el post del login");
}
?>
