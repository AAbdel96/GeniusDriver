<?php
include_once '../PeopleDB.php';
include_once '../PeopleAPI.php';
include_once '../Respuesta.php';



session_start();

if (isset($_POST["correo"])){
    
    
// Building headers.
$headers = array();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859';
$headers[] = 'X-Mailer: PHP/' . phpversion();


$people = new PeopleDB();

$email = $_POST['correo'];

$_SESSION['correo_recuperar'] = $email;



$ret = $people->recuperar_contrasena($email);



if (!empty($ret)) {

$mensaje = "<html>
     <head>
        <title>Restablece tu contraseña</title>
     </head>
     <body>
       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
       <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
       <p>
         <strong>Para poder cambiar la contrasña debes dirigirte a este enlace</strong><br>" . ":" . "http://localhost/SampleWS/Web/Recuperar_cuenta_enlace.php"."       
       </p>
     </body>
    </html> ";

mail($email, 'Genius Driver Inc.', $mensaje, implode(PHP_EOL, $headers));

header("Location: Contrasena_enviada.php");
} else {
echo "<script>alert('Este correo no pertenece a ninguna cuenta!');
               
                </script>";
}
}
else if (!$_POST) {
    
}
else{
    echo "<script>alert('Debes introducir un correo electronico!');
               
                </script>";
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

                <label >Introduce el correo electronico asociado a la cuenta:</label><br><br>
                <input type="text" name="correo" class="login-input" placeholder="correo electronico">
                <input type="submit" value="Enviar" class="login-button">  
            </form>
        </section>
    </body>
</html>