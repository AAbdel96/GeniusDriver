<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';

$json = file_get_contents('php://input');

$obj = json_decode($json);
$nombre = $obj->{'nombre'};
$nombre_carpeta = $obj->{'nombre_carpeta'};

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dato = array('nombre' => "", 'email' => "", 'contrasena' => "");
    
    $persona = new PeopleDB();
    
    $ret = $persona->borrar_mapa($nombre);

    if (!$ret == '1') {

        response($code = 200, $error = "", $Exito = false, $message = "ERROR!", $dato);   
    } else {
        
        $ruta = "uploads/imagenes/".$nombre_carpeta."/".$nombre;
        unlink($ruta);
        response($code = 200, $error = "", $Exito = true, $message = "Mapa borrado", $dato);
    }
} else {
    response($code = 200, $error = "", $Exito = false, $message = "ERROR", $dato);
}

?>
