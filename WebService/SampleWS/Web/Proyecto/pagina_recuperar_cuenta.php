<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/index_plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>Genius Driver - Recuperacion de contraseña</title>
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
            <a href="pagina_index.php" id="enlace-principal">
                <div class="posicion-logo"><img class="imagen-logo" src="img/logopngmini.png" /></div>
                <div class="nombre-logo">Genius Driver</div>
            </a>

            <nav id="menu-enlaces">
                <a href="pagina_index.php" class="enlaces">Inicio</a>
                <a href="#" class="enlaces">Quienes somos</a>
                <div id="separacion"></div>
                <a href="pagina_login.php" class="enlaces">Login</a>
                <a href="pagina_registro.php" class="enlaces">Registro</a>
            </nav>
        </header>

        <section id="contenido-principal">
            <span class="boton-arriba icon-eject"></span>
            <!-- InstanceBeginEditable name="cuerpo" -->
            <article id="recuperar-cuenta">
                <h1>Recuperación de Contraseña</h1>

                <form method="post">
                    <label>Nueva contraseña</label>
                    <input type="password" name="contra" class="recuadro-input" placeholder="Nueva contraseña" autofocus>

                    <label>Confirmar nueva contraseña</label>
                    <input type="password" name="contra2" class="recuadro-input" placeholder="Confirmar nueva contraseña">

                    <input type="submit" name="button" value="Cambiar" class="cambiar-button">
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