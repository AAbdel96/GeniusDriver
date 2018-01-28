<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';




$json = file_get_contents('php://input');





if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $persona = new PeopleDB();

    $ret = $persona->get_modelos();

    file_put_contents("listado_modelos.txt", print_r($ret, true), FILE_APPEND);
    
    $dato = $ret;
    response($code = 200, $error = "", $Exito = true, $message = "ERROR,CORREO ELECTRONICO EN USO!", $dato);
}





