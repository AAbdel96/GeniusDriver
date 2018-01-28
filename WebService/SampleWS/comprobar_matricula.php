<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';

$json = file_get_contents('php://input');

$obj = json_decode($json);
$correo = $obj->{'correo'};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {




    $persona = new PeopleDB();

    $mika = $persona->comprobar_matricula($correo);

    file_put_contents("list.txt", print_r($mika, true), FILE_APPEND);


    $EmptyTestArray = array_filter($mika);

    if (empty($EmptyTestArray) || $mika[0]["Matricula"] === NULL) {
        $dato = $mika;
        response($code = 200, $error = "", $Exito = true, $message = "No tiene matricula", $dato);
    } else {
        $variable = $mika[0]["Matricula"];
        
        file_put_contents("variable.txt", $variable);
        
        $mika = $persona->devolver_modelo($variable);
        
        $dato = $mika;
        file_put_contents("list.txt", print_r($mika, true), FILE_APPEND);
        
        response($code = 200, $error = "", $Exito = true, $message = "Si que tiene matricula", $dato);
    }
} else {
    
}

