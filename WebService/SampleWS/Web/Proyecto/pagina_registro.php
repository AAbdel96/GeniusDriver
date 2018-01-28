<?php
include_once '../../PeopleDB.php';
include_once '../../PeopleAPI.php';
include_once '../../Respuesta.php';


$name = "";
$apellidos = "";
$telefono = "";
$codigo_postal = "";
$pais = "";
$provincia = "";
$confirmar_contrasena = "";
$email = "";
$confirmar_email = "";
$contrasena = "";


if (isset($_POST["email"]) && isset($_POST["contrasena"]) && isset($_POST["nombre"]) &&
        isset($_POST["apellidos"]) && isset($_POST["provincia"]) && isset($_POST["codigo_postal"]) && isset($_POST["pais"]) && isset($_POST["telefono"]) && isset($_POST['confirmar_contrasena']) && isset($_POST['email2']) && isset($_POST["condiciones"])) {

    $name = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $confirmar_email = $_POST['email2'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $provincia = $_POST['provincia'];
    $codigo_postal = $_POST['codigo_postal'];
    $pais = $_POST['pais'];
    $telefono = $_POST['telefono'];


    $people = new PeopleDB();

    $ret = $people->insert($name, $apellidos, $email, md5($contrasena), $provincia, $codigo_postal, $pais, $telefono);

    if ($contrasena == $confirmar_contrasena) {
        if ($email == $confirmar_email) {

            if (!$ret == '1') {

                echo "<script>alert('Correo actual en uso!');
               
                </script>";
            } else {

                $people2 = new PeopleDB;

                $date = date('Y/m/d H:i:s');

                $date_recortada = date('l', strtotime($$date));
                $ret = $people2->sumar_registro($date_recortada);
                
                 echo "<script>alert('Registrado correctamente!');
                window.location.href='pagina_login.php';
                </script>";               
            }
        } else {
            echo "<script>alert('Los correos no son iguales!');
              
                </script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no son iguales');              
                </script>";
    }
} else if (!$_POST) {
    
} else {

    if (!isset($_POST['condiciones'])) {

        echo "<script>alert('Acepta las condiciones!');              
                </script>";

        $name = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $confirmar_email = $_POST['email2'];
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $provincia = $_POST['provincia'];
        $codigo_postal = $_POST['codigo_postal'];
        $pais = $_POST['pais'];
        $telefono = $_POST['telefono'];
    } else {


        echo "<script>alert('Revisa todos los campos!');              
                </script>";

        $name = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $confirmar_email = $_POST['email2'];
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $provincia = $_POST['provincia'];
        $codigo_postal = $_POST['codigo_postal'];
        $pais = $_POST['pais'];
        $telefono = $_POST['telefono'];
    }
}
?>
<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/index_plantilla.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>Genius Driver - Registro de usuario</title>
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
                <a href="#" class="enlaces">Inicio</a>
                <a href="#" class="enlaces">Quienes somos</a>
                <div id="separacion"></div>
                <a href="#" class="enlaces">Login</a>
                <a href="#" class="enlaces">Registro</a>
            </nav>
        </header>

        <section id="contenido-principal">
            <span class="boton-arriba icon-eject"></span>
            <!-- InstanceBeginEditable name="cuerpo" -->
            <article id="registro">
                <h1>Registro Usuario</h1>

                <form method="POST" action="pagina_registro.php">

                    <label>Nombre</label>
                    <input type="text" name="nombre" class="recuadro-input" placeholder="Nombre" value="<?php echo $name ?>" autofocus>

                    <label>Apellidos</label>
                    <input type="text" name="apellidos" class="recuadro-input" placeholder="Apellidos" value="<?php echo $apellidos ?>">

                    <label>Correo electrónico</label>
                    <input type="email" name="email" class="recuadro-input" placeholder="Correo" value="<?php echo $email ?>">

                    <label>Confirmar correo electrónico</label>
                    <input type="email" name="email2" class="recuadro-input" placeholder="Confirmar correo" value="<?php echo $confirmar_email ?>">

                    <label>Contraseña</label>
                    <input type="password" name="contrasena" class="recuadro-input" placeholder="Contraseña" value="<?php echo $contrasena ?>">

                    <label>Confirmar contraseña</label>
                    <input type="password" name="confirmar_contrasena" class="recuadro-input" placeholder="Confirmar contraseña" value="<?php echo $confirmar_contrasena ?>">

                    <label>Provincia</label>
                    <input type="text" name="provincia" class="recuadro-input" placeholder="Provincia" value="<?php echo $provincia ?>">               

                    <label>Código Postal</label>
                    <input type="text" name="codigo_postal" class="recuadro-input" placeholder="Codigo postal" value="<?php echo $codigo_postal ?>">

                    <label>Pais</label>
                    <input type="text" name="pais" class="recuadro-input" placeholder="Pais" value="<?php echo $pais ?>">

                    <label>Teléfono</label>
                    <input type="tel" name="telefono" class="recuadro-input" placeholder="Telefono de contacto" value="<?php echo $telefono ?>">               

                    <div id="condiciones">
                        <label class="letra-condiciones" for="checkbox_id"><input type="checkbox" name="condiciones" class="boton-check" value="check_condiciones">He leido y acepto el <a href="#" target="_blank">"Aviso legal y la Política de Privacidad"</a> de esta página.</label>
                    </div>

                    <input type="submit" value="Entrar" class="registro-button">
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


