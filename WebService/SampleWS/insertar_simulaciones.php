<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';

$json = file_get_contents('php://input');

$obj = json_decode($json);
$nombre = $obj->{'nombre_imagen'};
$nombre_carpeta = $obj->{'nombre_carpeta'};




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dato = array('nombre' => "", 'email' => "", 'contrasena' => "");
    
    $persona = new PeopleDB();
    
    $ret = $persona->insert_simulacion($nombre,$nombre_carpeta);

    if (!$ret == '1') {

        response($code = 200, $error = "", $Exito = false, $message = "ERROR!", $dato);   
    } else {
        response($code = 200, $error = "", $Exito = true, $message = "Simulacion Insertada", $dato);
    }
} else {
    response($code = 200, $error = "", $Exito = false, $message = "ERROR", $dato);
}

?>