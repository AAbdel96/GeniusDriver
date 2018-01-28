<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';


$persona = new PeopleDB();



if(isset($_POST['id'])){
    
    $eliminar = $_POST['id'];
    $people2 = $persona->delete_image($eliminar);
    
}
else{
    
}