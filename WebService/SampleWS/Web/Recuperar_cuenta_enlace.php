<?php
include_once '../PeopleDB.php';
include_once '../PeopleAPI.php';
include_once '../Respuesta.php';


session_start();

if (isset($_SESSION["correo_recuperar"])) {
    if (isset($_POST["contra"]) && isset($_POST["contra2"])) {

        $people = new PeopleDB();

        $contrasena = $_POST['contra'];
        $correo = $_SESSION['correo_recuperar'];
        $ret = $people->update_pass($correo, md5($contrasena));



        if ($ret == '1') {

            echo "<script>alert('Contraseña cambiada correctamente!');
               
                </script>";

            session_unset($_SESSION['correo_recuperar']);
        } else {
            echo "<script>alert('No se ha podido cambiar la contraseña!');
               
                </script>";
            
            session_unset($_SESSION['correo_recuperar']);
        }
    } else if (!$_POST) {
        
    } else {
        echo "<script>alert('Debes los dos campos');
               
                </script>";
    }
} else {
    header('Location: http://localhost/SampleWS/Web/login.php');
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Genius Driver - Login de usuario</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <link rel="stylesheet" type="text/css" href="estilos/estilos_index.css">

        <link rel="stylesheet" type="text/css" href="estilos/Recuperacion_cuenta.css">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
    </head>

    <body>
        <header>
            <a href="#"><div id="centrologo"><img src="img/logopngmini.png" width="90px" height="90px" /></div><div id="nombrelogo">Genius Driver</div></a>

            <nav>
                <a href="#" class="enlaces">Inicio</a>
                <a href="#" class="enlaces">Acerca de</a>

                <a href="#" class="enlaces">Login</a>
                <a href="#" class="enlaces">Registro</a>
            </nav>
        </header>

        <section>
            <form class="login" method="post" >

                <h1 class="login-title">Recuperación de contraseña</h1>


                <input type="text" name="contra" class="login-input" placeholder="Nueva contraseña">
                <input type="text" name="contra2" class="login-input" placeholder="Confirmar contraseña nueva">
                <input type="submit" value="Cambiar" class="login-button">  
            </form>
        </section>
    </body>
</html>