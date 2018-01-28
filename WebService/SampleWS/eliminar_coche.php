<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';


$persona = new PeopleDB();



if(isset($_POST['matricula'])){
    
    $eliminar = $_POST['matricula'];
    $people2 = $persona->delete_car($eliminar);
    
}
else{
    echo"no ha llegado el mail";
}