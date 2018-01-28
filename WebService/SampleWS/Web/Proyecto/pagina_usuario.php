<?php
session_start();

if (!isset($_SESSION['login_user'])) {

    echo "<script>alert('Tieenes que iniciar sesion!');
                window.location.href='pagina_login.php';
                </script>";
}
?>


<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/index_usuario.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>Bienvenido a Genius Driver - Página de inicio de usuario</title>
        <!-- InstanceEndEditable -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/estilos_plantilla.css" />
        <link rel="stylesheet" type="text/css" href="css/estilos_icono.css" />

        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="js/menu_index.js"></script>
        <script type="text/javascript" src="js/boton_arriba.js"></script>

        <!-- InstanceBeginEditable name="head" -->
        <link rel="stylesheet" type="text/css" href="css/estilos_index.css" />
        <!-- InstanceEndEditable -->
    </head>

    <body>
        <header>
            <a href="pagina_usuario.php" id="enlace-principal">
                <div class="posicion-logo"><img class="imagen-logo" src="img/logopngmini.png" /></div>
                <div class="nombre-logo">Genius Driver</div>
            </a>

            <nav id="menu-enlaces">
                <a href="pagina_usuario.php" class="enlaces">Inicio</a>
                <a href="pagina_perfil.php" class="enlaces">Perfil</a>
                <a href="#" class="enlaces">Vehiculos</a>
                <a href="#" class="enlaces">Circuito</a>
                <a href="#" class="enlaces">Quienes somos</a>
                <div id="separacion"></div>
                <a href="pagina_index.php" class="enlaces">Salir</a>
            </nav>
        </header>

        <section id="contenido-principal">
            <span class="boton-arriba icon-eject"></span>
            <!-- InstanceBeginEditable name="cuerpo" -->
         	<h1>Últimas novedades en el sector automovilístico</h1>
        	<h3>La gama de coches eléctricos más novedosos en el mercado ¡YA! están disponibles para el disfrute de los amantes de la conduccion alternativa.</h3>
            
            <section id="posicion-slider">
                <div class="recuadro-slider">
                    <div class="contenido-slider">
                        <article><img src="img/img-slider1.png" alt=""></article>
                        <article><img src="img/img-slider2.png" alt=""></article>
                        <article><img src="img/img-slider3.png" alt=""></article>
                        <article><img src="img/img-slider4.png" alt=""></article>
                    </div>
                </div>
                
                <div class="btn-prev">&#10094;</div>
                <div class="btn-next">&#10095;</div>
                <script type="text/javascript" src="js/slider.js"></script>
            </section>
            
            <h1>Empresas colaboradoras</h1>
            
            <h3>Las siguientes empresas mencionadas a continuacion gracias a sus aportaciones podemos avanzar con el objetivo de nuestra idea e innovar dia a dia en las tecnicas empleadas para que Genius Driver sea una realidad.</h3>
            
            <section id="logos-empresas">
                <article class="posicion-empresas"><img class="tamano-empresas" src="img/logo-audi.png" alt=""></article>
                <article class="posicion-empresas"><img class="tamano-empresas" src="img/logo-rebault.png" alt=""></article>
                <article class="posicion-empresas"><img class="tamano-empresas" src="img/logo-seat.png" alt=""></article>
                <article class="posicion-empresas"><img class="tamano-empresas" src="img/logo-volkswagen.png" alt=""></article>
            </section>
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
                            <li class="listas-contenido"><a href="pagina_politicas.php">Politica de privaciadad</a></li>
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