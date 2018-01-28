<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';

$json = file_get_contents('php://input');

$obj = json_decode($json);
$modelo = $obj->{'modelo'};

file_put_contents("modelo.txt", $modelo);

    


    $persona = new PeopleDB();

    $mika = $persona->getdatos_coche($modelo);

    //en este momento tendremos que llamara a la funcion que lo que hara sera sumar uno a la tabla en ese determinado modelo
    
    $persona->sumar_modelo($modelo);
    
    
    $dato = $mika;
    
    //file_put_contents("dato.txt", print_r($dato, true), FILE_APPEND);
    
    
    response($code = 200, $error = "", $Exito = true, $message = "Registrado correctamente", $dato);

    



