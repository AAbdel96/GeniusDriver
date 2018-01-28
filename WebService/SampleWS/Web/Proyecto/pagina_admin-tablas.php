<!DOCTYPE html>
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



        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="css/Botones.css">




        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="js/people.js"></script>
        <script type="text/javascript" src="js/cars.js"></script>
        <script type="text/javascript" src="js/images.js"></script>
        
        
        


        <!-- InstanceEndEditable -->
    </head>

    <body>
        <header>
            <a href="pagina_usuario.php" id="enlace-principal">
                <div class="posicion-logo"><img class="imagen-logo" src="img/logopngmini.png" /></div>
                <div class="nombre-logo">Genius Driver</div>
            </a>

            <nav id="menu-enlaces">
                <a href="pagina_admin.php" class="enlaces">Inicio</a>

                <a href="pagina_admin-tablas.php" class="enlaces">Tablas</a>
                <a href="pagina_admin-graficos.php" class="enlaces">Graficos</a>

                <div id="separacion"></div>
                <a href="pagina_index.php" class="enlaces">Salir</a>
            </nav>
        </header>

        <section id="contenido-principal">
            <table id="example" class="display" cellspacing="0" width="100%">

                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>localidad</th>
                        <th>Codigo postal</th>
                        <th>Pais</th>
                        <th>Telefono</th>
                        <th>Matricula</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>localidad</th>
                        <th>Codigo postal</th>
                        <th>Pais</th>
                        <th>Telefono</th>
                        <th>Matricula</th>
                    </tr>
                </tfoot>
                <tbody>


                    <?php
                    //USUARIOS
                    include_once '../../PeopleDB.php';
                    include_once '../../Respuesta.php';


                    $persona = new PeopleDB();
                    $people2 = $persona->recuperar_usuarios();



                    foreach ($people2 as $valor) {

                        echo "<tr>";
                        echo "<td>" .
                        $valor['name'] . "</td>";
                        echo "<td>" .
                        $valor["email"] . "</td>";

                        echo "<td>" .
                        $valor["provincia"] . "</td>";
                        echo "<td>" .
                        $valor["codigo_postal"] . "</td>";

                        echo "<td>" .
                        $valor["pais"] . "</font></td>";

                        echo "<td>" .
                        $valor["telefono"] . "</td>";
                        echo "<td>" .
                        $valor["Matricula"] . "</td>";

                        echo "</tr>";
                    }
                    ?>

                </tbody>
            </table>
            <br>
            <br>


            <br>
            <br>
            <table id="cars" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Matricula</th>
                        <th>Velocidad Maxima</th>
                        <th>Capacidad Bateria</th>
                        <th>Precio</th>


                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Matricula</th>
                        <th>Velocidad Maxima</th>
                        <th>Capacidad Bateria</th>
                        <th>Precio</th>
                    </tr>
                </tfoot>
                <tbody>


                    <?php
                    //USUARIOS
                    include_once '../../PeopleDB.php';
                    include_once '../../Respuesta.php';


                    $persona = new PeopleDB();
                    $people2 = $persona->recuperar_coches();

                    foreach ($people2 as $valor) {

                        echo "<tr>";
                        echo "<td>" . $valor['Modelo'] . "</td>";
                        echo "<td>" . $valor["Marca"] . "</td>";
                        echo "<td>" . $valor["Matricula"] . "</td>";
                        echo "<td>" . $valor["Vel_max"] . "</td>";
                        echo "<td>" . $valor["Cap_bateria"] . "</td>";
                        echo "<td>" . $valor["Precio"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <br>


            <br>
            <br>
            <table id="images" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Correo</th>
                        <th>Nombre de la imagen</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Correo</th>
                        <th>Nombre de la imagen</th>
                    </tr>
                </tfoot>
                <tbody>


                    <?php
                    //USUARIOS
                    include_once '../../PeopleDB.php';
                    include_once '../../Respuesta.php';


                    $persona = new PeopleDB();
                    $people2 = $persona->recuperar_imagenes();



                    foreach ($people2 as $valor) {

                        echo "<tr>";
                        echo "<td>" . $valor['id'] . "</td>";
                        echo "<td>" . $valor["email"] . "</td>";
                        echo "<td>" . $valor["nombre"] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
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