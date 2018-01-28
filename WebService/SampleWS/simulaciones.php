<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';


$persona = new PeopleDB();
    
    $ret = $persona->recuperar_simulaciones();
    
    echo json_encode($ret);
    
    

    $ret = $persona->eliminar_simulacione();

