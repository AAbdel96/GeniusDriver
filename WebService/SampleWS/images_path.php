<?php

include_once 'PeopleDB.php';
include_once 'PeopleAPI.php';
include_once 'Respuesta.php';


$json = file_get_contents('php://input');

$obj = json_decode($json);
$email = $obj->{'email'};



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $persona = new PeopleDB();

    $ret = $persona->recuperar_todas_fotos($email);
    
    echo json_encode($ret);
    
   
}
 else {
    
     echo 'Not post method';
}

