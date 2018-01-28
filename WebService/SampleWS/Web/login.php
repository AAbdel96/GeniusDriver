<?php
include_once '../PeopleDB.php';
include_once '../Respuesta.php';

session_start();




if (isset($_POST["email"]) && isset($_POST["contrasena"])) {

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

        $_SESSION['login_user'] = $email;
    }
} else if (!$_POST) {
    
} else {
    echo "<script>alert('No has introducido todos los campos!');
        window.location.href='http://localhost/SampleWS/Web/login.php';
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

        <link rel="stylesheet" type="text/css" href="estilos/estilo-login_dentro.css">
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
            <form class="login" method="POST" action="login.php">

                <h1 class="login-title">Inicio de sesión</h1>
                <input type="text" name="email" class="login-input" placeholder="Correo electronico" autofocus>
                <input type="password" name = "contrasena" class="login-input" placeholder="Contraseña">
                <input type="submit" value="Entrar" class="login-button">

                <p class="login-lost"><a href="Recuperar_contrasena.php">He olvidado la contraseña?</a></p>
            </form>
        </section>
        <footer>Genius Driver Inc.</footer>
    </body>
</html>