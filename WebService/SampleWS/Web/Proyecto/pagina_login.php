<?php
include_once '../../PeopleDB.php';
include_once '../../Respuesta.php';

session_start();




if (!(isset($_POST["email"]) && isset($_POST["contrasena"]))) {

    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    if ($email == "admin@gmail.com" && $contrasena == "admin@gmail.com") {


        $persona = new PeopleDB();
        $people = $persona->login_web($email, md5($contrasena));

        if (empty($people)) {
            echo "<script>alert('Usuario o contraseña incorrecto!');
                window.location.href='http://localhost/SampleWS/Web/login.php';
                </script>";
            exit;
        } else {

            $_SESSION['login_user'] = $email;

            //redirigimos al usuario a su pagina de inicio
            echo "<script>alert('Login correcto!');
                window.location.href='pagina_usuario.php';
                </script>";
        }
    } else if (!$_POST) {
        
    } else {
        echo "<script>alert('No has introducido todos los campos!');
        window.location.href='http://localhost/SampleWS/Web/login.php';
            </script>";
    }
}
else{
    header("Location: pagina_admin.php");
}
?>



<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/index_plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>Genius Driver - Inicio de sesion</title>
        <!-- InstanceEndEditable -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/estilos_plantilla.css" />
        <link rel="stylesheet" type="text/css" href="css/estilos_icono.css" />

        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="js/menu_index.js"></script>
        <script type="text/javascript" src="js/boton_arriba.js"></script>
        <!-- InstanceBeginEditable name="head" -->
        <link rel="stylesheet" type="text/css" href="css/estilos_formularios.css" />
        <!-- InstanceEndEditable -->
    </head>

    <body>
        <header>
            <a href="#" id="enlace-principal">
                <div class="posicion-logo"><img class="imagen-logo" src="img/logopngmini.png" /></div>
                <div class="nombre-logo">Genius Driver</div>
            </a>

            <nav id="menu-enlaces">
                <a href="pagina_index.php" class="enlaces">Inicio</a>
                <a href="" class="enlaces">Quienes somos</a>
                <div id="separacion"></div>
                <a href="pagina_login.php" class="enlaces">Login</a>
                <a href="pagina_registro.php" class="enlaces">Registro</a>
            </nav>
        </header>

        <section id="contenido-principal">
            <span class="boton-arriba icon-eject"></span>
            <!-- InstanceBeginEditable name="cuerpo" -->
            <article id="login">
                <h1>Login Usuario</h1>

                <form method="POST" action="pagina_login.php">
                    <label>Correo electronico</label>
                    <input type="email" name="email" class="recuadro-input" placeholder="Correo electronico" autofocus>

                    <label>Contraseña</label>
                    <input type="password" name="contrasena" class="recuadro-input" placeholder="Contraseña">

                    <input type="submit" name="button" class="login-button" value="Login">

                    <div class="login-perdido"><a href="recuperar_contrasena.php">¿Has olvidado la contraseña?</a></div>
                </form>
            </article>
            <!-- InstanceEndEditable -->
        </section>

        <footer>
            <section id="contenido-footer">
                <article class="columna-uno">
                    <div class="contenedor-folleto">
                        <h2 class="titulo-folleto-redes">Inscribete a nuestro boletin de noticias</h2>
                        <div class="folleto"><input class="interior-folleto" type="email" name="publicidad" size="15" maxlength="50" placeholder="Tu email" required><input class="publicidad-button" type="submit" name="publicidad" value="OK"></div>
                    </div>

                    <div class="contenedor-redes">
                        <h2 class="titulo-folleto-redes">Siguenos en las redes</h2>
                        <div class="redes-sociales">
                            <a href="#" class="facebook" title="Facebook"></a>
                            <a href="#" class="twitter" title="Twitter"></a>
                            <a href="#" class="google" title="Google+"></a>
                            <a href="#" class="youtube" title="YouTube"></a>
                            <a href="#" class="email" title="Email"></a>
                        </div>
                    </div>
                </article>

                <hr id="separator">

                <article class="columna-dos">
                    <div class="contenedor-ayuda">
                        <h2 class="titulo-ayuda-asistencia">¿Necesitas ayuda?</h2>
                        <ul class="listas">
                            <li class="listas-contenido"><a href="#">Genius Driver Asistencia</a></li>
                            <li class="listas-contenido"><a href="#">Buscar un punto de venta</a></li>
                            <li class="listas-contenido"><a href="#">Contacto</a></li>
                            <li class="listas-contenido"><a href="#">Politica de privaciadad</a></li>
                        </ul>
                    </div>
                    <div class="contenedor-asistencia">
                        <h2 class="titulo-ayuda-asistencia">Atencion al cliente</h2>
                        <ul class="listas">
                            <li class="listas-contenido"><strong>Oficinas: 91 321 39 21</strong></li>
                            <li class="listas-contenido"><small>Taller: 902 44 55 66</small></li>
                        </ul>
                    </div>
                </article>

                <article class="columna-tres">
                    <div class="derechos">Todos los derechos reservados &copy; 2017 &#8212; Desarrollado por Genius Driver Inc.</div>
                </article>
            </section>
        </footer>
    </body>
    <!-- InstanceEnd --></html>