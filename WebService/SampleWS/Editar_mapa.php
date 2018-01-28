<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';

$json = file_get_contents('php://input');

$obj = json_decode($json);
$nombre = $obj->{'nombre'};
$nombre_carpeta = $obj->{'nombre_carpeta'};
$nuevo_nombre = $obj->{'nuevo_nombre'};

$nuevo_nombre = $nuevo_nombre.".jpeg";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dato = array('nombre' => "", 'email' => "", 'contrasena' => "");
    
    $persona = new PeopleDB();
    
    $ret = $persona->update_map($nombre, $nuevo_nombre);

    if (!$ret == '1') {

        response($code = 200, $error = "", $Exito = false, $message = "ERROR!", $dato);   
    } else {
        
        $ruta = "uploads/imagenes/".$nombre_carpeta."/".$nombre;
        $nueva_ruta = "uploads/imagenes/".$nombre_carpeta."/".$nuevo_nombre;
        rename($ruta, $nueva_ruta);
        response($code = 200, $error = "", $Exito = true, $message = "Mapa editado", $dato);
    }
} else {
    response($code = 200, $error = "", $Exito = false, $message = "ERROR", $dato);
}

?>