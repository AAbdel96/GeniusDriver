<?php

include_once 'PeopleDB.php';
include_once 'PeopleAPI.php';
include_once 'Respuesta.php';

if (isset($_POST["email"]) && isset($_POST["contrasena"]) && isset($_POST["nombre"]) &&
        isset($_POST["apellidos"]) && isset($_POST["localidad"]) && isset($_POST["codigo_postal"]) && isset($_POST["pais"]) && isset($_POST["telefono"]) && isset($_POST['confirmar_contrasena']) && isset($_POST['email2']) && isset($_POST["condiciones"])) {

    $name = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $confirmar_email = $_POST['email2'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $localidad = $_POST['localidad'];
    $codigo_postal = $_POST['codigo_postal'];
    $pais = $_POST['pais'];
    $telefono = $_POST['telefono'];



    $people = new PeopleDB();

    $ret = $people->insert($name, $apellidos, $email, md5($contrasena), $localidad, $codigo_postal, $pais, $telefono);

    if ($contrasena == $confirmar_contrasena) {
        if ($email == $confirmar_email) {


            if (!$ret == '1') {

                echo "<script>alert('Correo actual en uso!');
                window.location.href='http://localhost/SampleWS/Web/registro.php';
                </script>";
            } else {
                echo"Todo correcto!!";
            }
        } else {
            echo "<script>alert('Los correos no son iguales!');
               
                </script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no son iguales');              
                </script>";
    }
} else if ($_POST['test'] = 'value1') {
    
    echo "<script>alert('Rellena todos los campos');  
            
            </script>"; 
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    
    
            
} else {
    echo "<script>alert('Tienes que aceptar las condiciones!');
        
            </script>";
}
?>


