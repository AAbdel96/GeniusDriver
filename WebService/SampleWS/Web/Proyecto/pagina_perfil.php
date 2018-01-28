<?php
include_once '../../PeopleDB.php';
include_once '../../Respuesta.php';
session_start();


if (!isset($_SESSION['login_user'])) {

    echo "<script>alert('Tieenes que iniciar sesion!');
                window.location.href='pagina_login.php';
                </script>";
} else if (isset($_POST['guardar'])) {

   
    
    $persona_aux = new PeopleDB();

    $ret= $persona_aux->devolver_pass($_SESSION['login_user']);

    
  
   
    
    if($ret[0]["contrasena"] == $_POST['contrasena']){
        
        echo "<script>alert('Cambios guardados!');
                window.location.href='pagina_perfil.php';
                </script>";
            
        $people = $persona_aux->cambiar_datos_persona_web($_POST['nombre'], $_POST['apellidos'], $_POST['email'],$_POST['contrasena'], $_POST['provincia'], $_POST['codigo_postal'], $_POST['pais'], $_POST['telefono'], $_SESSION['login_user']);
    }
    
    else if ($ret[0]["contrasena"] != $_POST['contrasena'] ){
        
         $people = $persona_aux->cambiar_datos_persona_web($_POST['nombre'], $_POST['apellidos'], $_POST['email'], md5($_POST['contrasena']), $_POST['provincia'], $_POST['codigo_postal'], $_POST['pais'], $_POST['telefono'], $_SESSION['login_user']);
         
         echo "<script>alert('Cambios guardados!');
                window.location.href='pagina_perfil.php';
                </script>";
    }
    
    
     
     
     
} else if (isset($_POST['cancelar'])) {

    header("Location: pagina_usuario.php");
} else {

    $persona = new PeopleDB();
    $people = $persona->get_all_by_email($_SESSION['login_user']);

    file_put_contents("datos_perfil.txt", print_r($people, true), FILE_APPEND);

    $name = $people[0]["name"];
    $apellidos = $people[0]["apellidos"];
    $email = $people[0]["email"];
    $confirmar_email = $people[0]["email"];
    $contrasena = $people[0]["contrasena"];
    $confirmar_contrasena = $people[0]["contrasena"];
    $provincia = $people[0]["provincia"];
    $codigo_postal = $people[0]["codigo_postal"];
    $pais = $people[0]["pais"];
    $telefono = $people[0]["telefono"];
}
?>



<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/index_usuario.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>Genius Driver - Perfil usuario</title>
        <!-- InstanceEndEditable -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/estilos_plantilla.css" />
        <link rel="stylesheet" type="text/css" href="css/estilos_icono.css" />

        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="js/menu_index.js"></script>
        <script type="text/javascript" src="js/boton_arriba.js"></script>
        <!-- InstanceBeginEditable name="head" -->
        <link rel="stylesheet" type="text/css" href="css/estilos_perfil.css">
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
                <a href="pagina_index.php" class="enlace-salir">Salir</a>
            </nav>
        </header>

        <section id="contenido-principal">
            <span class="boton-arriba icon-eject"></span>
            <!-- InstanceBeginEditable name="cuerpo" -->
            <article id="perfil">
                <h1 class="titulo-perfil">Perfil Usuario</h1>

                <form method="POST" action="pagina_perfil.php">

                    <div class="columna-principal-perfil">
                        <div class="columna-uno-perfil">
                            <label class="label-titulo">Nombre</label>
                            <input type="text" name="nombre" class="login-input" placeholder="Nombre" value="<?php echo $name ?>" autofocus>
                        </div>

                        <div class="columna-dos-perfil">
                            <label class="label-titulo">Apellidos</label>
                            <input type="text" name="apellidos" class="login-input" placeholder="Apellidos" value="<?php echo $apellidos ?>">
                        </div>
                    </div>

                    <div class="columna-principal-perfil">
                        <div class="columna-uno-perfil">
                            <label class="label-titulo">Correo electrónico</label>
                            <input type="email" name="email" class="login-input" placeholder="Correo" value="<?php echo $email ?>">
                        </div>

                        <div class="columna-dos-perfil">
                            <label class="label-titulo">Confirmar correo electrónico</label>
                            <input type="email" name="email2" class="login-input" placeholder="Confirmar correo" value="<?php echo $confirmar_email ?>">
                        </div>
                    </div>

                    <div class="columna-principal-perfil">
                        <div class="columna-uno-perfil">
                            <label class="label-titulo">Contraseña</label>
                            <input type="password" name="contrasena" class="login-input" placeholder="Contraseña" value="<?php echo $contrasena ?>">
                        </div>

                        <div class="columna-dos-perfil">
                            <label class="label-titulo">Confirmar contraseña</label>
                            <input type="password" name="confirmar_contrasena" class="login-input" placeholder="Confirmar contraseña" value="<?php echo $confirmar_contrasena ?>">
                        </div>
                    </div>

                    <div class="columna-principal-perfil">
                        <div class="columna-uno-perfil">
                            <label class="label-titulo">Provincia</label>
                            <input type="text" name="provincia" class="login-input" placeholder="Provincia" value="<?php echo $provincia ?>">               
                        </div>

                        <div class="columna-dos-perfil">
                            <label class="label-titulo">Código Postal</label>
                            <input type="text" name="codigo_postal" class="login-input" placeholder="Codigo postal" value="<?php echo $codigo_postal ?>">
                        </div>
                    </div>

                    <div class="columna-principal-perfil">
                        <div class="columna-uno-perfil">
                            <label class="label-titulo">País</label>
                            <input type="text" name="pais" class="login-input" placeholder="Pais" value="<?php echo $pais ?>">
                        </div>

                        <div class="columna-dos-perfil">
                            <label class="label-titulo">Teléfono</label>
                            <input type="tel" name="telefono" class="login-input" placeholder="Telefono de contacto" value="<?php echo $telefono ?>">               
                        </div>
                    </div>

                    <div class="botones-perfil">
                        <input type="submit" value="Guardar" class="boton-guardar" name="guardar">
                        <input type="submit" value="Cancelar" class="boton-cancelar" name="cancelar">
                    </div>
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