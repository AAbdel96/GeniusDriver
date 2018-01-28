<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';


$persona = new PeopleDB();




if(isset($_POST['email'])){
    
    $correo = $_POST['email'];
   
    
    
    $people2 = $persona->delete_user($correo);
   
    if($people2){
        
        echo "OK";
    }
}
else{
     
}

