<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';


$json = file_get_contents('php://input');

$obj = json_decode($json);
$email = $obj->{'email'};
$contrasena_vieja = $obj->{'contrasena_vieja'};
$confirma_nueva = $obj->{'confirma_nueva'};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $persona_aux = new PeopleDB();

    $persona = $persona_aux->getPeople($email, $contrasena_vieja);
    
    
    
    $dato = ['email' => $email, 'contrasena' => $confirma_nueva, 'name' => ''];
    
    if (empty($persona)) {
        $dato = ['email' => $email, 'contrasena' => $confirma_nueva, 'name' => ''];
        response($code = 200, $error = "", $Exito = false, $message = "Contrasena vieja incorrecta", $dato);
    } else {

        $ret = $persona_aux->update_pass($email, $confirma_nueva);

        if ($ret == '1') {
            $dato = ['email' => $email, 'contrasena' => $confirma_nueva, 'resultado' => 's'];
            response($code = 200, $error = "", $Exito = true, $message = "Cambiada", $dato);
        } else {
            $dato = ['email' => $email, 'contrasena' => $confirma_nueva_nueva, 'resultado' => 'n'];
            response($code = 200, $error = "", $Exito = true, $message = "No_cambiada", $dato);
        }
    }
} 

