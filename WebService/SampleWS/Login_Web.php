<?php

include_once 'PeopleDB.php';
include_once 'Respuesta.php';




if ($_POST["email"] && $_POST["contrasena"]) {

    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];


    $persona = new PeopleDB();
    $people = $persona->login_web($email, md5($contrasena));

    if (empty($people)) {
        echo "<script>alert('Usuario o contraseña incorrecto!');
                window.location.href='http://localhost/SampleWS/Web/login.php';
                </script>";
        exit;
    } else {
        //echo json_encode($people, JSON_PRETTY_PRINT);      
        header('');
    }
} else {
    echo "<script>alert('No has introducido todos los campos!');
        window.location.href='http://localhost/SampleWS/Web/login.php';
            </script>";
    
}
?>


